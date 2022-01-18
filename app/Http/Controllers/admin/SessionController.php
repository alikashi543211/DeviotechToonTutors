<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MeetingSession;
use App\Models\TutorPayout;
use App\Models\SubscribePlan;
use App\Models\Transaction;
use App\Models\TutorRequest;


class SessionController extends Controller
{
    public function sessionList()
    {
    	$list=MeetingSession::all();
        return view('admin.session.list',get_defined_vars());
    }
    public function delete($id=null)
    {
    	MeetingSession::find($id)->delete();
    	return back()->with("success","Deleted successfully");
    }
    public function refund($id=null)
    {
        // dd($id);
        $meeting_session = MeetingSession::find($id);
        $meeting_session->refund_request = 3;
        $meeting_session->save();

        $tutor_request = $meeting_session->tutor_request;

        $tutor_payout = TutorPayout::where('meeting_session_id', $id)->first();
        $hours =  $tutor_payout->hours;

        if($tutor_request->is_subscribed_payment == 0) {
            $transaction = Transaction::where('tutor_request_id',$tutor_request->id)->orderBy('id', 'desc')->first();
            $stripe_id = $transaction->stripe_id;
            
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            try {
                $refund = \Stripe\Refund::create(['charge' => $stripe_id]);
            } catch(\Stripe\Error\InvalidRequest $e) {
                dd($e->getMessage());
            } catch(\Stripe\Error\Card $e) {
                dd($e->getMessage());
            }
        } else {

            $sub_plan = SubscribePlan::where('user_id',$meeting_session->student_id)->where('status','active')->first();
            $sub_plan->remaining_hour = + $hours;
            $sub_plan->save();
        }
        $tutor_payout->status = "cancelled";
        $tutor_payout->save();

        return back()->with("success","Refund successfully");
    }
}
