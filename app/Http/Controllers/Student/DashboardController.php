<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MeetingSession;
use App\Models\StudentProfile;
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
        if (!is_null(session('package_id'))) {
            $package_id = session('package_id');
            return redirect()->route('student.package.payment', $package_id);
        }

        $user = auth()->user();

        $session_attended = MeetingSession::where('student_id',$user->id)
            ->where('status', '2')
            ->count();
        $upcoming = TutorRequest::where('student_id',$user->id)
            ->where('status', 'approved')
            ->where('class_status', 'pending')
            ->count();
        $time = MeetingSession::where('student_id',$user->id)
            ->where('status', '2')
            ->sum('time_taken');

        $requests = TutorRequest::where('student_id', $user->id)
            ->where('status','pending')
            ->get();

        $events = [];
        $class_plan = TutorRequest::where('student_id',$user->id)
            ->where('status','approved')
            ->where('class_status', 'pending')
            ->with('tutor_user')
            ->get();

        foreach ($class_plan as $key => $value) {

            $slot = explode(', ', $value->slot);

            if ($value->tutor_user->time_zone == $user->time_zone) {
                $from = explode("-", $slot[array_key_first($slot)])[0];
                $to = explode("-", $slot[array_key_last($slot)])[1];

                if ($value->interval == "2") {
                    for ($i=0; $i < $value->no_of_weeks; $i++) {
                        if (dateAddWeek($value->active_date, $value->slot, $i) >= Carbon::now()->format('Y/m/d')) {
                            $events[] = array(
                                'id' => $value->id,
                                'name' => 'Tutoring Session',
                                'description' => 'Your class is scheduled with "'.$value->tutor_user->name.'" from '.$from.' to '.$to,
                                'date' => dateAddWeek($value->active_date, $value->slot, $i),
                                'type' => 'event'
                            );
                        }
                    }
                } else {
                    if ($value->active_date >= Carbon::now()->format('Y/m/d')) {
                        $events[] = array(
                            'id' => $value->id,
                            'name' => 'Tutoring Session',
                            'description' => 'Your class is scheduled with "'.$value->tutor_user->name.'" from '.$from.' to '.$to,
                            'date' => $value->active_date,
                            'type' => 'event'
                        );
                    }
                }
            } else {
                $from = studentTime(explode("-", $slot[array_key_first($slot)])[0]);
                $to = studentTime(explode("-", $slot[array_key_last($slot)])[1]);

                if ($value->interval == "2") {
                    for ($i=0; $i < $value->no_of_weeks; $i++) {
                        if (studentDateAddWeek($value->active_date, $value->slot, $i) >= currentDate()) {
                            $events[] = array(
                                'id' => $value->id,
                                'name' => 'Tutoring Session',
                                'description' => 'Your class is scheduled with "'.$value->tutor_user->name.'" from '.$from.' to '.$to,
                                'date' => studentDateAddWeek($value->active_date, $value->slot, $i),
                                'type' => 'event'
                            );
                        }
                    }
                } else {
                    if (studentDate($value->active_date, $value->slot) >= currentDate()) {
                        $events[] = array(
                            'id' => $value->id,
                            'name' => 'Tutoring Session',
                            'description' => 'Your class is scheduled with "'.$value->tutor_user->name.'" from '.$from.' to '.$to,
                            'date' => studentDate($value->active_date, $value->slot),
                            'type' => 'event'
                        );
                    }
                }
            }
        }
        $purchased_plan = $user->subscribe_plans->where('status','active')->first();
        // dd($events);
        return view('student.dashboard.dashboard', get_defined_vars());
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
        return view('student.review.review', get_defined_vars());
    }

    public function reviewSave(Request $req)
    {
        $req->validate([
            'review' => 'required',
        ]);
        $meeting_session_id = $req->id;

        $review = Review::create([
            'user_id' => auth()->user()->id,
            'meeting_session_id' => $meeting_session_id,
            'rating' => $req->rating,
            'review' => $req->review,
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Thankyou!, Your review has been submitted');
    }

    public function profile()
    {
        return view('student.settings.profile', get_defined_vars());
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

        Auth::login($user);

        $s_p = StudentProfile::where('user_id',$user->id)->first();
        if ($req->has('profile_photo')) {
            $photo = uploadFile($req->profile_photo, 'student/'.Str::slug($req->name), 'profile-photo');
            $s_p->profile_photo = $photo;
        }
        $s_p->phone = $req->phone;
        $s_p->save();
        return redirect()->back()->with('success','Profile Updated Successfully!');
    }
}
