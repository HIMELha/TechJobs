<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\SavedJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Queue;

class JobApplicationController extends Controller
{
    public function applyJob(Request $request, $id){
        $job = Job::where('status', true)->find($id);

        if(!$job){
            return redirect()->back()->with('error', 'Job not available');
        }

        $isAlreadyApplied = JobApplication::where(['user_id' => auth()->user()->id, 'job_id' => $id])->first();
        if($isAlreadyApplied){
            return redirect()->back()->with('error', 'You have already applied for the job');
        }

        $jobApplication = JobApplication::create([
            'user_id' => auth()->user()->id,
            'job_id' => $id,
            'employer_id' => $job->user_id,
            'applied_date' => Carbon::now()
        ]);

        $employer = $jobApplication->employer;
        $title = $job->title;

        // have to work here 
        Queue::later(now(), new SendMailJob($employer, $title));

        return redirect()->back()->with('success', 'Job Application created successfully');
    }

    public function saveJob($id){
        $job = Job::where('status', true)->find($id);

        if(!$job){
            return redirect()->back()->with('error', 'Job not found');
        }

        $isAlreadySaved = SavedJob::where(['user_id' => auth()->user()->id, 'job_id' => $id])->first();
        if($isAlreadySaved){
            return redirect()->back()->with('error', 'Job already saved');
        }

        SavedJob::create([
            'user_id' => auth()->user()->id,
            'job_id' => $id
        ]);
        
        return redirect()->back()->with('success', 'Job saved');
    }

    public function deleteApplyJob($id){
        $jobApplication = JobApplication::where('user_id', auth()->user()->id)->find($id);

        if(!$jobApplication){
            return redirect()->back()->with('error', 'Job application not found');
        }

        $jobApplication->delete();
        return redirect()->back()->with('success', 'Job application deleted successfully');
    }

     

    public function deleteSavedJob($id){
        $savedJob = SavedJob::where('user_id', auth()->user()->id)->find($id);

        if(!$savedJob){
            return redirect()->back()->with('error', 'Job application not found');
        }

        $savedJob->delete();
        return redirect()->back()->with('success', 'Job removed from save list');
    }
}
