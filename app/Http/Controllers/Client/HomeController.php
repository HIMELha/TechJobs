<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\Page;
use App\Models\SavedJob;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        $isJobSaved = [];
        if(auth()->check()){
            $isJobSaved = SavedJob::where(['user_id' => auth()->user()->id, 'job_id' => $id])->first();
        }
    
        return view('client.view_job', ['job' => $job, 'isJobSaved' => $isJobSaved]);
    }

    public function jobs(Request $query){
        $jobs = Job::with(['category', 'job_type'])->where('status', true)->latest();
        $categories = Category::where('status', true)->latest()->paginate(10);
        $job_types = JobType::where('status', true)->latest()->paginate(10);
        $job_types = JobType::where('status', true)->latest()->paginate(10);

        $data = [
            'keyword' => $query->has('keywords') ? $query->keywords : '',
            'location' => $query->has('location') ? $query->location : '',
            'category_f' => $query->has('category') ? $query->category : ''
        ];

        $data['jobs'] = $jobs->paginate(12);
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


    public function pages($title){
        $pagee = Page::where('title', $title)->first();

        if(!$pagee){
            return redirect()->back()->withError('Page not found');
        }

        return view('client.page', compact('pagee'));
    }


    public function checkoutMembership($type){
        
        if($type == 'starter'){
            return view('client.checkout', compact('type'));
        } else if ($type == 'standard') {
            return view('client.checkout', compact('type'));
        }else{
            return view('client.checkout', compact('type'));
        }

    }


    public function storeMembership(Request $request, $type){

        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'transaction' => 'required|min:6'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }

        $alreadyAMember = Subscription::where(['user_id' => auth()->user()->id, 'type' => $type])->first();

        if($alreadyAMember){
            return redirect()->route('profile.index')->withError("You've already subscribed for The Membership");
        }

        $membership = new Subscription;
        $membership->user_id  = auth()->user()->id;
        $membership->type  = $type;
        $membership->phone  = $request->phone;
        $membership->transaction_id  = $request->transaction;
        $membership->save();

        return redirect()->route('profile.index')->withSuccess('Premium membership application submitted successfully');
    }

}
