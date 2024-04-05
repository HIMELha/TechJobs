<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index(Request $request){
        $users = User::query();
        
        $keywords = $request->query('keywords');
        if ($keywords) {
            $users->where('name', 'LIKE', "%{$keywords}%");
        }

        $location = $request->query('location');
        if ($location) {
            $users->where('about', 'LIKE', "%{$location}%");
        }

        $sort = $request->query('sort');
        if ($sort) {
            if($sort == 'latest'){
                $users = $users->latest();
            }else{
                $users = $users->oldest();
            }
        }
        
        $data['users'] = $users->paginate(12);
        $data['keyword'] = $keywords;
        $data['location'] = $location;
        $data['sort'] = $sort;
        return view('client.employers', $data);
    }

    public function viewProfile($id){
        $user = User::find($id);
        if(!$user){
            return redirect()->back()->withError('User not found');
        }
        $startDate = Carbon::now()->subDays(7)->toDateString();
        $endDate = Carbon::now()->toDateString();
        $jobs = $user->jobs()->whereBetween('created_at', [$startDate, $endDate])->paginate(3);
        $subscription = $user->subscription()->latest()->first();

        $data['user'] = $user;
        $data['jobs'] = $jobs;
        $data['subscription'] = $subscription;
        return view('client.employerprofile', $data);
    }
}
