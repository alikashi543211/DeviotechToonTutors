<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutorProfile;
use App\Models\User;
use Mail;


class TutorController extends Controller
{
    public function tutorList()
    {
    	$list = User::where('role','tutor')->orderBy('id', 'desc')->get();
        return view('admin.tutor.list',get_defined_vars());
    }

    public function view($id = null)
    {
        $tutor = User::find($id);
        return view('admin.tutor.view', get_defined_vars());
    }

    public function status($id = null)
    {
        $user = User::find($id);
        $tutor = TutorProfile::where('user_id', $id)->first();
        if ($tutor->status == "approved") {
            $tutor->status = "pending";
        } else {
            $tutor->status = "approved";
            Mail::send('emails.tutor.account_approved', get_defined_vars(), function ($message) use($user) {
                $message->to($user->email, $user->name);
                $message->subject('Account Approved');
            });
        }
        $tutor->save();

        return redirect()->back()->with('success', 'Status Changed Successfully');
    }

    public function delete($id = null)
    {
    	$user = User::find($id);
    	$user->tutor_profile->delete();
    	$user->delete();
    	return back()->with("success","Deleted successfully");
    }
    public function setHourly(Request $request)
    {
       $t_profile = TutorProfile::find($request->tutor_profile_id);
       $t_profile->hourly_rate = $request->hourly_rate;
       $t_profile->save();
       return back()->with('success','Hourly Rate Update Successfully');
    }
}
