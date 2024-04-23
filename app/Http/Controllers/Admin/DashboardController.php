<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use App\Models\JobApplication;

class DashboardController extends Controller
{
    public function index(){
        $jobs = Job::with('user', 'category', 'jobApplication')->latest()->limit(8)->get();
        $usersCount = User::count();
        $jobsCount = Job::count();
        $applicationsCount = JobApplication::count();

        return view('admin.index', compact('jobs', 'usersCount', 'jobsCount', 'applicationsCount'));
    }
}
