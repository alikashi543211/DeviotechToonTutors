<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\MeetingSession;
use App\Models\ParentProfile;
use App\Models\SubscribePlan;
use Illuminate\Http\Request;
use App\Models\TutorRequest;
use App\Models\ClassPlan;
use App\Models\Package;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use Str;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $session_attended = MeetingSession::where('student_id',auth()->user()->id)
            ->where('status', '2')
            ->count();
        $upcoming = TutorRequest::where('student_id',auth()->user()->id)
            ->where('status', 'approved')
            ->where('class_status', 'pending')
            ->count();
        $time = MeetingSession::where('student_id',auth()->user()->id)
            ->where('status', '2')
            ->sum('time_taken');

        $requests = TutorRequest::where('student_id', auth()->user()->id)
            ->where('status','pending')
            ->get();

        $events = [];
        $class_plan = TutorRequest::where('student_id',auth()->user()->id)
            ->where('status','approved')
            ->where('class_status', 'pending')
            ->get();

        foreach ($class_plan as $key => $value) {

            $slot = explode(', ', $value->slot);
            $from = parentTime(explode("-", $slot[array_key_first($slot)])[0]);
            $to = parentTime(explode("-", $slot[array_key_last($slot)])[1]);

            if ($value->interval == "2") {
                for ($i=0; $i < $value->no_of_weeks; $i++) {
                    if (parentDateAddWeek($value->active_date, $value->slot, $i) >= currentDate()) {
                        $events[] = array(
                            'id' => $value->id,
                            'name' => 'Tutoring Session',
                            'description' => 'Your class is scheduled with "'.$value->tutor_user->name.'" from '.$from.' to '.$to,
                            'date' => parentDateAddWeek($value->active_date, $value->slot, $i),
                            'type' => 'event'
                        );
                    }
                }
            } else {
                if (parentDate($value->active_date, $value->slot) >= currentDate()) {
                    $events[] = array(
                        'id' => $value->id,
                        'name' => 'Tutoring Session',
                        'description' => 'Your class is scheduled with "'.$value->tutor_user->name.'" from '.$from.' to '.$to,
                        'date' => parentDate($value->active_date, $value->slot),
                        'type' => 'event'
                    );
                }
            }
        }

        $purchased_plan = SubscribePlan::where('status','active')->first();
        // dd($events);
        return view('parent.dashboard.dashboard', get_defined_vars());
    }

    public function checkSessionStart()
    {
        $session['started'] = false;

        $ses = MeetingSession::where('student_id',auth()->user()->id)->where('status',"1")->first();
        if ($ses) {
            $session['started'] = true;
            $session['join_url'] = $ses->join_url;
            $session['tutor'] = $ses->tutor_user->name;
        }

        return response()->json($session);
    }

    public function review($id = null)
    {
        return view('parent.review.review', get_defined_vars());
    }

    public function reviewSave(Request $req)
    {
        $meeting_session_id = $req->id;

        $review = Review::create([
            'user_id' => auth()->user()->id,
            'meeting_session_id' => $meeting_session_id,
            'rating' => $req->rating,
            'review' => $req->review,
        ]);

        return redirect()->route('parent.dashboard')->with('success', 'Thankyou!, Your review has been submitted');
    }

    public function profile()
    {
        return view('parent.settings.profile', get_defined_vars());
    }

    public function profileSave(Request $req)
    {
        $req->validate([
            'password' => 'confirmed',
        ]);
        $user = User::find(auth()->user()->id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->time_zone = $req->time_zone;
        if ($req->password) {
            $user->password = bcrypt($req->password);
        }
        $user->save();

        $p_p = ParentProfile::where('user_id',$user->id)->first();
        if ($req->has('profile_photo')) {
            $photo = uploadFile($req->profile_photo, 'parent/'.Str::slug($req->name), 'profile-photo');
            $p_p->profile_photo = $photo;
        }
        $p_p->phone = $req->phone;
        $p_p->save();
        return redirect()->back()->with('success','Profile Updated Successfully!');
    }
}
