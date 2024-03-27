<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::where('status', true)->get();

        $jobs = Job::with(['category', 'job_type'])->where('status', true)->latest()->paginate(6);

        $data['categories'] = $categories;
        $data['jobs'] = $jobs;
        return view('client.index', $data);
    }

    public function show($id){
        $job = Job::with(['category', 'job_type'])->find($id);

        if(!$job){
            return redirect()->back()->with('error', 'Job not found');
        }

        return view('client.view_job', ['job' => $job]);
    }

    public function jobs(Request $query){
        $jobs = Job::with(['category', 'job_type'])->where('status', true)->latest()->paginate(12);
        $categories = Category::where('status', true)->latest()->paginate(10);
        $job_types = JobType::where('status', true)->latest()->paginate(10);
        $job_types = JobType::where('status', true)->latest()->paginate(10);
        
        if(isset($query)){
            $data['keyword'] = $query->keywords;
            $data['location'] = $query->location;
            $data['category_f'] = $query->category;
        }
        
        $data['jobs'] = $jobs;
        $data['job_types'] = $job_types;
        $data['categories'] = $categories;
        return view('client.find_jobs', $data);
    }

    public function getJobs(Request $request) {
        $jobs = Job::where('status', true)->with(['category', 'job_type']);

        // keyword searching
        $keyword = $request->keyword;
        if(isset($keyword)){
            $jobs = $jobs->where(function ($query) use ($keyword) {
                $query->orWhere('title', 'like', '%' . $keyword . '%');
                $query->orWhere('keywords', 'like', '%' . $keyword . '%');
            });
        }

        // location searching
        $location = $request->location;
        if(isset($location)){
            $jobs = $jobs->where(function ($query) use ($location) {
                $query->orWhere('company_location', 'like', '%' . $location . '%');
            });
        }

        // category searching
        $category = $request->category;
        if(isset($category)){
            $jobs = $jobs->where(function ($query) use ($category) {
                $checkCategory = Category::find($category);
                if($checkCategory){
                    $query->where('category_id', $category);
                }
            });
        }

        // job type searching
        $job_type = $request->job_types;
        if(isset($job_type)){
            $jobs = $jobs->where(function ($query) use ($job_type) {
                $query->whereIn('job_type_id', $job_type);
            });
        }

        // experience searching
        $experience = $request->experience;
        if(isset($experience)){
            $jobs = $jobs->where(function ($query) use ($experience) {
                $query->where('experience', $experience);
            });
        }

        // sorting
        $sort = $request->sort;

        if($sort == 'latest'){
            $jobs = $jobs->latest()->paginate(12);
        }else if($sort == 'oldest'){
            $jobs = $jobs->oldest()->paginate(12);
        }else{
            $jobs = $jobs->latest()->paginate(12);
        }
        

        if(!$jobs){
            return response()->json([
                'status' => false,
                'message' => 'No Jobs Found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'jobs' => $jobs
        ], 200);
    }


}
