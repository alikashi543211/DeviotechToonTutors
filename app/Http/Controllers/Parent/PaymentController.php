<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\SubscribePlan;
use Illuminate\Http\Request;
use App\Models\TutorRequest;
use App\Models\Conversation;
use App\Models\TutorProfile;
use App\Models\Transaction;
use App\Models\Package;
use App\Models\Message;
use Auth;

class PaymentController extends Controller
{
    public function paymentForm()
    {
        $t_req = session('request_tutor');
        $rate = TutorProfile::where('user_id',$t_req->tutor_id)->first()->hourly_rate;
        return view('parent.payment', get_defined_vars());
    }

    public function paymentSave(Request $req)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        try
        {

            if (session('recurring')) {
                $id = session('recurring');
                $t_req = TutorRequest::find($id);
                $amount = TutorProfile::where('user_id', $t_req->tutor_id)->first()->hourly_rate;

                $amount_paid = $amount + $t_req->amount_paid;
                $amount_reserved = $amount - $t_req->amount_reserved;

                $charge = \Stripe\Charge::create(array(
                    "amount" => $amount * 100,
                    "currency" => "usd",
                    "description" => "Class Plan Book",
                    "source" => $req->stripeToken,
                    "capture" => false
                ));

                $t_req->amount_paid = $amount_paid ?? 0;
                $t_req->amount_reserved = $amount_reserved ?? 0;
                $t_req->payment_status = 1;
                $t_req->save();

                session()->forget('recurring');

                Transaction::create([
                    'stripe_id' => $charge->id,
                    'amount' => $amount,
                    'tutor_request_id' => $t_req->id,
                ]);

            } else {
                $t_req = session('request_tutor');
                $amount = TutorProfile::where('user_id', $t_req->tutor_id)->first()->hourly_rate;

                if ($t_req->interval == "2") {
                    $amount = $t_req->no_of_weeks * $amount;
                    $amount_paid = $amount / $t_req->no_of_weeks;
                    $amount_reserved = $amount - $amount_paid;
                } else{
                    $amount_paid = $amount;
                    $amount_reserved = 0;
                }

                $charge = \Stripe\Charge::create(array(
                    "amount" => $amount_paid * 100,
                    "currency" => "usd",
                    "description" => "Class Plan Book",
                    "source" => $req->stripeToken,
                    "capture" => false
                ));

                $tutor_request = new TutorRequest();
                $tutor_request->message = $t_req->message;
                $tutor_request->interval = $t_req->interval;
                $tutor_request->no_of_weeks = $t_req->no_of_weeks ?? null;
                $tutor_request->remaining_weeks = $t_req->no_of_weeks ?? null;
                $tutor_request->date = $t_req->date;
                $tutor_request->active_date = $t_req->date;
                $tutor_request->slot = $t_req->slot;
                $tutor_request->time_in_min = $t_req->time_in_min;
                $tutor_request->student_id = auth()->user()->id;
                $tutor_request->tutor_id = $t_req->tutor_id;
                $tutor_request->parent_student_id = $t_req->parent_student_id;
                $tutor_request->payment_status = 1;
                $tutor_request->amount = $amount ?? 0;
                $tutor_request->amount_paid = $amount_paid ?? 0;
                $tutor_request->amount_reserved = $amount_reserved ?? 0;
                $tutor_request->save();

                $conversation = Conversation::where('tutor_id', $t_req->tutor_id)->where('student_id', auth()->user()->id);
                if ($conversation->count() > 0) {
                    $message = new Message();
                    $message->conversation_id = $conversation->first()->id;
                    $message->user_id = auth()->user()->id;
                    $message->message = $t_req->message;
                    $message->ip = request()->ip();
                    $message->save();
                } else {
                    $conversation = new Conversation();
                    $conversation->tutor_id = $t_req->tutor_id;
                    $conversation->student_id = auth()->user()->id;
                    $conversation->save();

                    $message = new Message();
                    $message->conversation_id = $conversation->first()->id;
                    $message->user_id = auth()->user()->id;
                    $message->message = $t_req->message;
                    $message->ip = request()->ip();
                    $message->save();
                }

                session()->forget('request_tutor');

                Transaction::create([
                    'stripe_id' => $charge->id,
                    'amount' => $amount_paid,
                    'tutor_request_id' => $tutor_request->id,
                ]);
            }
        }
        catch(\Stripe\Error\Card $e)
        {
            dd($e->getMessage());
        }
        catch(\Stripe\Error\InvalidRequest $e)
        {
            dd($e->getMessage());
        }

        return redirect()->route('parent.dashboard')->with('success', 'Your payment have been successfully captured!');
    }
}
