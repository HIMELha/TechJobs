<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateJobRequest;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function createJob(){
        $categories = Category::where('status', true)->get();
        $job_types = JobType::where('status', true)->get();

        $data['categories'] = $categories;
        $data['job_types'] = $job_types;
        return view('client.create_jobs', $data);
    }

    public function storeJob(CreateJobRequest $request){
        $category = Category::find($request->category_id);

        if(!$category){
            return redirect()->back()->with('error', 'Invalid category selected');
        }

        $job_types = JobType::find($request->job_type_id);
        
        if(!$job_types){
            return redirect()->back()->with('error', 'Invalid job type selected');
        }

        Job::create($request->validated());

        return redirect()->back()->with('success', 'Job created successfully 🎉');

    }

    public function jobLists(){
        $jobs = Job::
        return view('client.job_lists');
    }
}
