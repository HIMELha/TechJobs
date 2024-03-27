<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateJobRequest;
use App\Http\Requests\UpdateJobRequest;
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
        $category = Category::where('status', true)->find($request->category_id);

        if(!$category){
            return redirect()->back()->with('error', 'Invalid category selected');
        }

        $job_types = JobType::where('status', true)->find($request->job_type_id);
        
        if(!$job_types){
            return redirect()->back()->with('error', 'Invalid job type selected');
        }

        $validatedData = $request->validated();
        Job::create(array_merge($validatedData, ['user_id' => auth()->user()->id]));

        return redirect()->back()->with('success', 'Job created successfully 🎉');

    }

    public function jobLists(){
        $jobs = Job::where('user_id', auth()->user()->id)->latest()->paginate(12);


        return view('client.job_lists', ['jobs' => $jobs]);
    }



    public function editJob($id){
        $job = Job::with(['category', 'job_type'])->find($id);

        if(!$job){
            return redirect()->back()->with('error', 'Job not found');
        }

        $categories = Category::where('status', true)->get();
        $job_types = JobType::where('status', true)->get();

        $data['categories'] = $categories;
        $data['job_types'] = $job_types;
        $data['job'] = $job;
        return view('client.update_job', $data);
    }

    public function updateJob(UpdateJobRequest $request, $id){
        $job = Job::find($id);

        if(!$job){
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        $category = Category::where('status', true)->find($request->category_id);

        if(!$category){
            return redirect()->back()->with('error', 'Invalid category selected');
        }

        $job_types = JobType::where('status', true)->find($request->job_type_id);
        
        if(!$job_types){
            return redirect()->back()->with('error', 'Invalid job type selected');
        }

        $validatedData = $request->validated();
        $job->update($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully');
    }

    public function deleteJob($id){
        $job = Job::find($id);

        if(!$job){
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully');
    }
}
