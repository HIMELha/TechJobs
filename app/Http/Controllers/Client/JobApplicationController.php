<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\SavedJob;
use Carbon\Carbon;

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
}
