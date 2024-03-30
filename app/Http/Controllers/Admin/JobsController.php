<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->with(['user', 'category', 'jobApplication'])->paginate(12);

        return view('admin.jobs', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', true)->get();
        $job_types = JobType::where('status', true)->get();

        $data['categories'] = $categories;
        $data['job_types'] = $job_types;
        return view('admin.createjob', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateJobRequest $request)
    {
        $category = Category::where('status', true)->find($request->category_id);

        if(!$category){
            return redirect()->back()->with('error', 'Invalid category selected');
        }

        $job_types = JobType::where('status', true)->find($request->job_type_id);
        
        if(!$job_types){
            return redirect()->back()->with('error', 'Invalid job type selected');
        }

        $validatedData = $request->validated();
        Job::create(array_merge($validatedData, ['user_id' => Auth::guard('admin')->user()->id]));

        return redirect()->back()->with('success', 'Job created successfully 🎉');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job = Job::with(['category', 'job_type'])->find($id);

        if(!$job){
            return redirect()->back()->with('error', 'Job not found');
        }

        $categories = Category::where('status', true)->get();
        $job_types = JobType::where('status', true)->get();

        $data['categories'] = $categories;
        $data['job_types'] = $job_types;
        $data['job'] = $job;
        return view('admin.updatejob', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, string $id)
    {
        $job = Job::find($id);

        if(!$job){
            return redirect()->route('adminjobs.index')->with('error', 'Job not found');
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

        return redirect()->route('adminjobs.index')->with('success', 'Job updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Job::find($id);

        if(!$job){
            return redirect()->route('adminjobs.index')->with('error', 'Job not found');
        }

        $job->delete();

        return redirect()->route('adminjobs.index')->with('success', 'Job deleted successfully');
    }
}
