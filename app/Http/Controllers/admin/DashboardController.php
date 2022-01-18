<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MeetingSession;
use Illuminate\Http\Request;
use App\Models\User;
class DashboardController extends Controller
{
    public function dashboard()
    {
        $users=User::all();
        $total_students=count($users->where('role','student'));
        $total_parents=count($users->where('role','parent'));
        $total_tutors=count($users->where('role','tutor'));
        $session=MeetingSession::limit(10)->get();
        return view('admin.dashboard.dashboard',get_defined_vars());
    }
}
