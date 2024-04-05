<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(){
        $memberships = Subscription::where('status', true)->with('user')->latest()->paginate(12);

        return view('admin.membership', compact('memberships'));
    }

    public function requests(){
        $memberships = Subscription::with('user')->latest()->paginate(12);

        return view('admin.requests', compact('memberships'));
    }

    public function responseRequest($id, $type){
        $memberships = Subscription::find($id);

        if($type == 'approve'){
            $memberships->status = true;
            $memberships->save();

            return redirect()->back()->withSuccess('Membership approved successfully');
        }else{
            $memberships->delete();
            return redirect()->back()->withSuccess('Membership deleted successfully');
        }
    }
}
