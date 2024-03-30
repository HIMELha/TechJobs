<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index(Request $request){
        $users = User::latest()->paginate(12);
        $keywords = '';
        $location = '';
        $data['users'] = $users;
        $data['keyword'] = $keywords;
        $data['location'] = $location;
        return view('client.employers', $data);
    }

    public function viewProfile($id){
        $user = User::find($id);
        if(!$user){
            return redirect()->back()->withError('User not found');
        }
        $startDate = Carbon::now()->subDays(7)->toDateString();
        $endDate = Carbon::now()->toDateString();
        $jobs = $user->jobs()->whereBetween('created_at', [$startDate, $endDate])->get();

        $data['user'] = $user;
        $data['jobs'] = $jobs;
        return view('client.employerprofile', $data);
    }
}
