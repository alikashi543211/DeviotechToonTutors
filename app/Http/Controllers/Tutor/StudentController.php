<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Laravel\Cashier\PaymentMethod;
use App\Traits\GoogleCalendar;
use Laravel\Cashier\Cashier;
use Illuminate\Http\Request;
use App\Models\TutorRequest;
use App\Models\Transaction;
use App\Models\ClassPlan;
use App\Models\User;
use Auth;
use App\Models\SubscribePlan;

class StudentController extends Controller
{
    use GoogleCalendar;

    public function studentRequest()
    {
        $requests = TutorRequest::where('tutor_id', Auth::user()->id)->orderBy('id','DESC')->get();
        return view('tutor.student.requests', get_defined_vars());
    }

    public function studentRequestStatus($action = null, $id = null)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $t_req = TutorRequest::find($id);

        $slot = explode(', ', $t_req->slot);
        $from = explode("-", $slot[array_key_first($slot)])[0];
        $to = explode("-", $slot[array_key_last($slot)])[1];

        $params = array(
            'summary' => 'Class Plan',
            'description' => 'Your class is scheduled with "'.$t_req->student_user->name.'" from '.$from.' to '.$to,
            'start' => array(
                'dateTime' => isoFromDateTime($t_req->date, $from),
                'timeZone' => auth()->user()->time_zone,
            ),
            'end' => array(
                'dateTime' => isoToDateTime($t_req->date, $to),
                'timeZone' => auth()->user()->time_zone,
            )
        );

        // Check if student user has subscription
        if ($t_req->is_subscribed_payment == 1) {

            if ($action == "cancel") {

                $t_req = TutorRequest::find($id);
                $t_req->status = 'cancelled';
                $t_req->class_status = 'cancelled';
                $t_req->save();

                if ($t_req->interval == 2) {
                    $hours = ($t_req->time_in_min / 60) * $t_req->no_of_weeks;
                } else {
                    $hours = $t_req->time_in_min / 60;
                }

                $subscribe_plan = SubscribePlan::where('user_id',$t_req->student_id)
                    ->where('status', 'active')->first();
                $subscribe_plan->remaining_hour = $subscribe_plan->remaining_hour + $hours;
                $subscribe_plan->save();

                $msg = "Request Cancelled!";

            } else if ($action == "accept") {
                $t_req->status = "approved";
                $t_req->class_status = "pending";
                $t_req->save();

                if (!is_null(auth()->user()->calendar_id)) {
                    $client = $this->oauth();
                    $this->insertEvent($client, $params);
                }

                $msg = "Request Approved and added to Class Plan!";
            }

        } else {
            $stripe_id = Transaction::where('tutor_request_id', $id)->orderBy('id', 'DESC')->first()->stripe_id;

            if ($action == "cancel") {
                try
                {
                    $refund = \Stripe\Refund::create(['charge' => $stripe_id]);
                    TutorRequest::find($id)->update([
                        'status' => 'cancelled',
                        'class_status' => 'cancelled',
                    ]);
                }
                catch(\Stripe\Error\InvalidRequest $e)
                {
                    dd($e->getMessage());
                }
                catch(\Stripe\Error\Card $e)
                {
                    dd($e->getMessage());
                }
                $msg = "Request Cancelled!";

            } else if ($action == "accept") {
                $t_req->status = "approved";
                $t_req->class_status = "pending";
                $t_req->save();

                // $client = $this->oauth();
                // $this->insertEvent($client, $params);

                $msg = "Request Approved and added to Class Plan!";
            }
        }

        return redirect()->back()->with('success', $msg);
    }

    public function studentRequestDelete($id = null)
    {
        TutorRequest::find($id)->delete();
        return redirect()->back()->with('success', 'Student Request deleted Successfully!');
    }
}
