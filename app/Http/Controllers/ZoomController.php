<?php

namespace App\Http\Controllers;

use App\Models\MeetingSession;
use Illuminate\Http\Request;
use App\Models\TutorRequest;
use App\Models\TutorProfile;
use App\Models\Transaction;
use App\Models\TutorPayout;
use App\Models\ClassPlan;
use Carbon\Carbon;
use Session;
use Zoom;
use Mail;

class ZoomController extends Controller
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
        $session_id = substr(str_shuffle($permitted_chars), 0, 32);
        try {
            $user = Zoom::user()->first();
            $meeting = Zoom::meeting()->make([
                'userId' => auth()->user()->id,
                'topic' => 'Online Class',
                'type' => 2,
                'disable_recording' => false,
                'duration' => 1,
                'timezone' => 'Pakistan',
                'password' => '1234567890',
                'agenda' => 'Tutor arrange online class for student',
            ]);
            $meeting = $user->meetings()->save($meeting);

            $meeting_session = MeetingSession::create([
                'session_id' => $session_id,
                'zoom_id' => $meeting->id,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
                'tutor_id' => $class_plan->tutor_id,
                'student_id' => $class_plan->student_id,
                'tutor_request_id' => $class_plan->id,
                'status' => '1',
            ]);

            Mail::send('emails.student.join_session', get_defined_vars(), function ($message) use($class_plan) {
                $message->to($class_plan->student_user->email, $class_plan->student_user->name);
                $message->subject('Join Session');
            });

        } catch (\Exception $e) {
            return redirect()->back()->with('error','Something Went Wrong, Try Again!');
        }

        return redirect()->to($meeting->start_url);
    }

    public function zoomCallback(Request $req)
    {
        $id = $req['payload']['object']['id'];

        $m_ses = MeetingSession::where('zoom_id', $id)->where('status','1')->first();
        $t_req = TutorRequest::find($m_ses->tutor_request_id);
        $tutor_timezone = $t_req->tutor_user->time_zone;
        $amount = TutorProfile::where('user_id', $t_req->tutor_id)->first()->hourly_rate;
        $hours = $t_req->time_in_min / 60 ;

        if ($t_req->interval == "1") {
            $t_req->class_status = "completed";
        } else {
            if ($t_req->remaining_weeks > 0) {
                if ($t_req->is_subscribed_payment == 0) {
                    $t_req->payment_status = 0;
                }
                $t_req->active_date = Carbon::parse($t_req->active_date)->addDays(7)->format('Y/m/d');
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

        $payout = new TutorPayout();
        $payout->tutor_id = $t_req->tutor_id;
        $payout->meeting_session_id = $m_ses->id;
        $payout->hours = $hours;
        $payout->amount = $amount;
        $payout->status = "due";
        $payout->save();
    }

    public function zoomJoined(Request $req)
    {
        $id = $req['payload']['object']['id'];
        $m_ses = MeetingSession::where('zoom_id', $id)->where('status','1')->first();
        $m_ses->student_joined = "1";
        $m_ses->save();
    }
}
