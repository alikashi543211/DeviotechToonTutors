<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\MeetingSession;
use Illuminate\Http\Request;
use App\Models\TutorProfile;
use App\Models\TutorRequest;
use App\Models\TutorPayout;
use App\Models\TimeTable;
use App\Models\ClassPlan;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use Mail;
use Str;

class DashboardController extends Controller
{
    public function pendingReview()
    {
        if (auth()->user()->tutor_profile->status == "approved") {
            return redirect()->route('tutor.dashboard');
        }
        return view('tutor.dashboard.pending_review');
    }

    public function dashboard()
    {

        $session_attended = MeetingSession::where('tutor_id',auth()->user()->id)
            ->where('status', '2')
            ->count();
        $requests = TutorRequest::where('tutor_id',auth()->user()->id)
            ->where('status', 'pending')
            ->count();
        $time = MeetingSession::where('tutor_id',auth()->user()->id)
            ->where('status', '2')
            ->sum('time_taken');

        $events = [];
        $class_plan = TutorRequest::where('tutor_id',auth()->user()->id)
            ->where('status','approved')
            ->where('class_status', 'pending')
            ->get();

        foreach ($class_plan as $value) {
            $slot = explode(', ', $value->slot);
            $from = explode("-", $slot[array_key_first($slot)])[0];
            $to = explode("-", $slot[array_key_last($slot)])[1];

            if ($value->interval == "2") {
                for ($i=0; $i < $value->no_of_weeks; $i++) {
                    if (dateAddWeek($value->active_date, $value->slot, $i) >= Carbon::now()->format('Y/m/d')) {
                        $events[] = array(
                            'id' => $value->id,
                            'name' => 'Tutoring Session',
                            'description' => 'Your class is scheduled with "'.$value->student_user->name.'" from '.$from.' to '.$to.'. Click To Start Zoom Session',
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
                        'description' => 'Your class is scheduled with "'.$value->student_user->name.'" from '.$from.' to '.$to.'. Click To Start Zoom Session',
                        'date' => $value->active_date,
                        'type' => 'event'
                    );
                }
            }
        }
        // dd($events);
        return view('tutor.dashboard.dashboard', get_defined_vars());
    }

    public function checkSession()
    {
        $session['time_arrived'] = false;

        $class_plan = TutorRequest::where('tutor_id',auth()->user()->id)
            ->where('active_date',Carbon::today()->format('Y/m/d'))
            ->where('status','approved')
            ->where('class_status', 'pending')
            ->get();

        foreach ($class_plan as $value) {

            $slot = explode(', ', $value->slot);
            $from = explode("-", $slot[array_key_first($slot)])[0];
            $end_time = explode("-", $slot[array_key_last($slot)])[1];

            $now = Carbon::now()->format('H:i');
            if ((teacher24Time($from) <= $now) && (teacher24Time($end_time) >= $now)) {
                $session['time_arrived'] = true;
                $session['id'] = $value->id;
                $session['start_url'] = $value->start_url;
                $session['join_url'] = $value->join_url;
                $session['payment_status'] = $value->payment_status;
                $session['name'] = $value->student_user->name;
            }
        }

        if($session['time_arrived']){
            if (!session('email_sent')) {

                Mail::send('emails.tutor.session', get_defined_vars(), function ($message) use($class_plan) {
                    $message->to(auth()->user()->email, auth()->user()->name);
                    $message->subject('Session Time Arrived');
                });
                session(['email_sent'=>true]);
            }
        } else{
            session(['email_sent'=>false]);
        }
        return response()->json($session);
    }

    public function review($id = null)
    {
        return view('tutor.review.review', get_defined_vars());
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
            'rating' => $req->rating ?? '0',
            'review' => $req->review,
        ]);

        return redirect()->route('tutor.dashboard')->with('success', 'Thankyou!, Your review has been submitted');
    }

    public function profile()
    {
        $is_closed = [];
        $from = [];
        $to = [];

        if (count(auth()->user()->time_tables) > 0) {
            foreach (auth()->user()->time_tables as $tt) {
                $is_closed[] = $tt->is_closed;
                $from[] = $tt->from;
                $to[] = $tt->to;
            }
        }

        return view('tutor.settings.profile', get_defined_vars());
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

        $t_p = TutorProfile::where('user_id',$user->id)->first();
        if ($req->has('profile_photo')) {
            $photo = uploadFile($req->profile_photo, 'tutor/'.Str::slug($req->name), 'profile-photo');
            $t_p->profile_photo = $photo;
        }
        $t_p->phone = $req->phone;
        $t_p->dob = $req->dob;
        $t_p->video_url = $req->video_url;
        //$t_p->hourly_rate = $req->hourly_rate;
        $t_p->country = $req->country;
        $t_p->bio = $req->bio;
        $t_p->save();
        return redirect()->back()->with('success','Profile Updated Successfully!');
    }

    public function timetableSave(Request $req)
    {
        $tutor = auth()->user();

        if(count($tutor->time_tables) > 0)
            $tutor->time_tables()->delete();

        $days = [
            'Monday', 'Tuesday', 'Wednesday',
            'Thursday', 'Friday', 'Saturday', 'Sunday'
        ];

        for($d=0;$d<7;$d++)
    	{
    		$tt = new TimeTable();
            $tt->tutor_id = $tutor->id;
    		$tt->day = $days[$d];
            $tt->is_closed = $req->is_closed[$d] ?? 1;
            if (isset($req->is_closed[$d])) {
                $tt->from = $req->from[$d] ?: "9:00 AM";
                $tt->to = $req->to[$d] ?: "2:00 PM";
            }
    		$tt->save();
        }

        return redirect()->back()->with('success', 'Timetable updated Successfully');
    }

    public function payout()
    {
        $payouts = TutorPayout::where('tutor_id', auth()->user()->id)->get();
        $total_hours = TutorPayout::where('tutor_id', auth()->user()->id)->sum('hours');
        $total_amount = TutorPayout::where('tutor_id', auth()->user()->id)->sum('amount');

        return view('tutor.payouts.payout', get_defined_vars());
    }

    public function chat()
    {
        return view('tutor.chat');
    }
}
