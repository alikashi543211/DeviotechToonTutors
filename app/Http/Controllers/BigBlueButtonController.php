<?php

namespace App\Http\Controllers;

use JoisarJignesh\Bigbluebutton\Facades\Bigbluebutton;
use App\Models\MeetingSession;
use Illuminate\Http\Request;
use App\Models\TutorRequest;
use App\Models\TutorProfile;
use App\Models\Transaction;
use App\Models\ClassPlan;
use Carbon\Carbon;
use Session;
use Mail;

class BigBlueButtonController extends Controller
{
    public function startSession($id = null)
    {
        $class_plan = TutorRequest::find($id);
        $amount = TutorProfile::where('user_id', $class_plan->tutor_id)->first()->hourly_rate;

        if ($class_plan->is_subscribed_payment) {
            if ($class_plan->interval == 2) {
                $class_plan->remaining_weeks = $class_plan->remaining_weeks - 1;
                $class_plan->save();
            }
        } else {
            $stripe_id = Transaction::where('tutor_request_id', $id)->orderBy('id', 'DESC')->first()->stripe_id;
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            try
            {
                $charge = \Stripe\Charge::retrieve($stripe_id);
                $charge_data = ['amount' => $amount * 100];
                $charge->capture($charge_data);

                if ($class_plan->interval == 2) {
                    $class_plan->remaining_weeks = $class_plan->remaining_weeks - 1;
                    $class_plan->save();
                }
            }
            catch(\Stripe\Error\InvalidRequest $e)
            {
                dd($e->getMessage());
            }
            catch(\Stripe\Error\Card $e)
            {
                dd($e->getMessage());
            }
        }

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $room_id = substr(str_shuffle($permitted_chars), 0, 10);
        $session_id = substr(str_shuffle($permitted_chars), 0, 32);


        try {
            \Bigbluebutton::create([
                'meetingID' => $room_id,
                'meetingName' => 'test meeting',
                'attendeePW' => 'attendee',
                'moderatorPW' => 'moderator',
                'endCallbackUrl'  => route('bigblue.callback'),
            ]);

            $meeting_session = MeetingSession::create([
                'session_id' => $session_id,
                'room_id' => $room_id,
                'tutor_id' => $class_plan->tutor_id,
                'student_id' => $class_plan->student_id,
                'tutor_request_id' => $class_plan->id,
                'status' => '1',
            ]);

            Mail::send('emails.student.join_session', get_defined_vars(), function ($message) use($class_plan) {
                $message->to($class_plan->student_user->email, $class_plan->student_user->name);
                $message->subject('Join Session');
            });

            session(['meeting_session_id'=>$meeting_session->id]);

            $url = \Bigbluebutton::join([
                'meetingID' => $room_id,
                'userName' => auth()->user()->name,
                'password' => 'moderator' //which user role want to join set password here
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error','Something Went Wrong, Try Again!');
        }

        return redirect()->to($url);
    }

    public function bigBlueCallback($id = null)
    {
        if (auth()->user()->role == "tutor") {
            // TutorRequest::where('tutor_id',auth()->user()->id)
            //     ->where('class_status','pending')
            //     ->update(['class_status'=>'completed']);

            $m_ses = MeetingSession::where('tutor_id', auth()->user()->id)
                ->where('status','1')
                ->first();

            $t_req = TutorRequest::find($m_ses->tutor_request_id);
            if ($t_req->interval == "1") {
                $t_req->class_status = "completed";
            } else {
                if ($t_req->remaining_weeks > 0) {
                    if ($t_req->is_subscribed_payment == 0) {
                        $t_req->payment_status = 0;
                    }
                    $t_req->active_date = Carbon::parse($t_req->active_date)->addDays(7)->timezone(auth()->user()->time_zone)->format('Y/m/d');
                } else {
                    $t_req->class_status = "completed";
                }
            }
            $t_req->save();

            $now = Carbon::now();
            $created_at = Carbon::parse($m_ses->created_at);
            $time_taken = $created_at->diffInMinutes($now);

            $m_ses->time_taken = $time_taken;
            $m_ses->ended_at = Carbon::now();
            $m_ses->status = "2";
            $m_ses->save();

            return redirect()->route('tutor.review');
        } else if(auth()->user()->role == "parent") {
            return redirect()->route('parent.review');
        } else{
            return redirect()->route('student.review');
        }
    }

    public function joinSession($id = null, $type = null)
    {
        $meeting_session = MeetingSession::where('room_id',$id)->first();
        session(['meeting_session_id'=>$meeting_session->id]);
        if ($type == "moderator") {
            $url = \Bigbluebutton::join([
                'meetingID' => $id,
                'userName' => auth()->user()->name,
                'password' => 'moderator' //which user role want to join set password here
            ]);

            return redirect()->to($url);
        } else {
            $meeting_session->student_joined = "1";
            $meeting_session->save();
            $url = \Bigbluebutton::join([
                'meetingID' => $id,
                'userName' => auth()->user()->name,
                'password' => 'attendee' //which user role want to join set password here
            ]);

            return redirect()->to($url);
        }
    }
}
