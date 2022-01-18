<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutorRequest;
use App\Models\TutorProfile;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use App\Models\SubscribePlan;

class TutorController extends Controller
{
    public function ourTutor(Request $request)
    {
        $list = User::where('role', 'tutor')
            ->whereHas('time_tables')
            ->whereHas('tutor_profile', function($q) use ($request){
                $q->where('status', 'approved');
            });

        if($request->get('location'))
        {
            $list = $list->whereHas('tutor_profile', function($q) use ($request){
                $q->where('country', $request->location);
            });
        }

        if($request->get('subject'))
        {
            $list = $list->whereHas('tutor_profile', function($q) use ($request){
                $q->where('subjects', $request->subject);
            });
        }

        if($request->get('availablity'))
        {
            $list = $list->whereHas('tutor_profile', function($q) use ($request){
                $q->where('availability', $request->availability);
            });
        }

        if($request->get('search'))
        {
            $list = $list->whereHas('tutor_profile', function($q) use ($request){
                $q->where('bio','like','%'.$request->search.'%');
            });
        }

        $get_data = $list->get();

        return view('parent.tutor.find_tutor', get_defined_vars());
    }

    public function loadTutorProfile($id = null)
    {
        $tutor = User::find($id);
        return view('ajax.parent.load_tutor_profile', get_defined_vars());
    }

    public function loadTutorDays($id = null)
    {
        $tutor = User::find($id);
        $time_table = $tutor->time_tables->where('is_closed',0);
        return view('ajax.parent.load_tutor_days', get_defined_vars());
    }

    public function loadTutorIntervals(Request $req,$id = null, $day = null)
    {
        $tutor = User::find($id);
        $tutor_req = TutorRequest::where('tutor_id',$id)
            ->where('status', 'approved')
            ->where('class_status', 'pending')
            ->pluck('slot')->toArray();


        $day = Carbon::parse($req->day)->format("l");
        $time_table = $tutor->time_tables->where('day',$day)->first();

        $parentStartTime = strtotime(parentTime($time_table->from));
        $parentEndTime = strtotime(parentTime($time_table->to));

        $tutorStartTime = strtotime($time_table->from);
        $tutorEndTime = strtotime($time_table->to);

        $parent_time_zone = array();
        $tutor_time_zone = array();

        for ($i = $parentStartTime; $i < $parentEndTime; $i+=1800) {
            $parent_time_zone[] = date("h:ia", $i)."-". date("h:ia", ($i+1800));
        }

        for ($i = $tutorStartTime; $i < $tutorEndTime; $i+=1800) {
            $tutor_time_zone[] = date("h:ia", $i)."-". date("h:ia", ($i+1800));
        }

        $available = array_diff($tutor_time_zone, $tutor_req);

        if (count($available) > 0) {
            return [view('ajax.parent.load_tutor_time_intervals', get_defined_vars())->render(), 200];
        } else {
            return [view('ajax.parent.load_tutor_time_intervals', get_defined_vars())->render(), 401];
        }
    }

    public function requestTutor(Request $request)
    {
        // dd($request);
        // Check if user has subscribed to package
        $has_subscription = false;
        $package = SubscribePlan::where('user_id', auth()->user()->id)->first();
        if ($package) {
            $has_subscription = true;
        } else{
            $has_subscription = false;
        }

        // dd($has_subscription);

        $tutor = User::find($request->tutor_id);
        $tutor_time_zone = User::find($request->tutor_id)->time_zone;
        $data = array();

        $slot = implode(", ", $request->slot);
        $data['message'] = $request->message;
        $data['tutor_id'] = $request->tutor_id;
        $data['parent_student_id'] = $request->parent_student_id;
        $data['interval'] = $request->interval;
        $data['no_of_weeks'] = $request->no_of_weeks ?? null;
        $data['slot'] = $slot;
        $data['date'] = teacherDate($request->date, $slot, $tutor_time_zone);

        $from = explode("-", $request->slot[array_key_first($request->slot)])[0];
        $to = explode("-", $request->slot[array_key_last($request->slot)])[1];
        $start = Carbon::parse($from);
        $end = Carbon::parse($to);
        $duration_min = $end->diffInMinutes($start);
        $data['time_in_min'] = $duration_min;


        // Calculate No of Hours
        if ($request->interval == 1) {
            $hours = $end->diffInHours($start);
        } else {
            $hours = $end->diffInHours($start) * $request->no_of_weeks;
        }


        if ($has_subscription) {
            $data['hours'] = $hours;
            if ($this->subscribedRequest((object)$data)) {
                return redirect()->route('parent.dashboard')->with('success', 'Your request has been submitted to tutor');
            } else {
                $data['has_subscription'] = true;
                session(['request_tutor' => (object)$data]);
                return redirect()->route('parent.payment.form')->with('success', 'To Complete Request Please Enter Payment Details');
            }
        } else {
            $data['has_subscription'] = false;
            session(['request_tutor' => (object)$data]);
            return redirect()->route('parent.payment.form')->with('success', 'To Complete Request Please Enter Payment Details');
        }
    }

    public function tutorRequest()
    {
        $get_data = TutorRequest::where('student_id', Auth::user()->id)->get();
        return view('parent.tutor.student_request', get_defined_vars());
    }

    public function recurringPayment($id = null)
    {
        session(['recurring' => $id]);

        return redirect()->route('parent.payment.form');
    }

    public function requestTutorStatus($action = null, $id = null)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $t_req = TutorRequest::find($id);

        $amount = TutorProfile::where('user_id', $t_req->tutor_id)->first()->hourly_rate;

        $start_time = Carbon::parse($t_req->active_date." ".explode("-", explode(", ", $t_req->slot)[0])[0])->timezone(auth()->user()->time_zone);
        $now = Carbon::now()->timezone(auth()->user()->time_zone);

        if ($t_req->is_subscribed_payment == 1) {
            if ($action == "cancel") {
                if ($start_time->diffInHours($now) < 24) {

                    $t_req->status = "cancelled";
                    $t_req->class_status = "cancelled";
                    $t_req->save();

                } else {
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
                }
                $msg = "Request Cancelled!";
            }
        } else {
            $stripe_id = Transaction::where('tutor_request_id', $id)->orderBy('id', 'DESC')->first()->stripe_id;
            if ($action == "cancel") {
                try
                {
                    if ($start_time->diffInHours($now) < 24) {
                        $charge = \Stripe\Charge::retrieve($stripe_id);
                        $charge_data = ['amount' => $amount * 100];
                        $charge->capture($charge_data);

                        $t_req->status = "cancelled";
                        $t_req->class_status = "cancelled";
                        $t_req->save();

                    } else {
                        $refund = \Stripe\Refund::create(['charge' => $stripe_id]);
                        TutorRequest::find($id)->update([
                            'status' => 'cancelled',
                            'class_status' => 'cancelled',
                        ]);
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
                $msg = "Request Cancelled!";
            }
        }
        return redirect()->back()->with('success', 'Request Cancelled');
    }

    public function subscribedRequest($data)
    {
        $remaining = SubscribePlan::where('user_id', auth()->user()->id)->where('status', 'active')->first()->remaining_hour;
        if ($data->hours > $remaining) {
            session(['request_tutor' => (object)$data]);
            return false;
        } else {
            $amount = TutorProfile::where('user_id', $data->tutor_id)->first()->hourly_rate;

            $tutor_request = new TutorRequest();
            $tutor_request->message = $data->message;
            $tutor_request->interval = $data->interval;
            $tutor_request->no_of_weeks = $data->no_of_weeks ?? null;
            $tutor_request->remaining_weeks = $data->no_of_weeks ?? null;
            $tutor_request->date = $data->date;
            $tutor_request->active_date = $data->date;
            $tutor_request->slot = $data->slot;
            $tutor_request->time_in_min = $data->time_in_min;
            $tutor_request->student_id = auth()->user()->id;
            $tutor_request->tutor_id = $data->tutor_id;
            $tutor_request->parent_student_id = $data->parent_student_id;
            $tutor_request->payment_status = 1;
            $tutor_request->amount = $amount ?? 0;
            $tutor_request->amount_paid = $amount ?? 0;
            $tutor_request->amount_reserved = 0;
            $tutor_request->is_subscribed_payment = 1;
            $tutor_request->save();

            $conversation = Conversation::where('tutor_id', $data->tutor_id)->where('student_id', auth()->user()->id);
            if ($conversation->count() > 0) {
                $message = new Message();
                $message->conversation_id = $conversation->id;
                $message->user_id = auth()->user()->id;
                $message->message = $data->message;
                $message->ip = request()->ip();
                $message->save();
            } else {
                $conversation = new Conversation();
                $conversation->tutor_id = $data->tutor_id;
                $conversation->student_id = auth()->user()->id;
                $conversation->save();

                $message = new Message();
                $message->conversation_id = $conversation->id;
                $message->user_id = auth()->user()->id;
                $message->message = $data->message;
                $message->ip = request()->ip();
                $message->save();
            }

            $subscibe_plan = SubscribePlan::where('user_id',auth()->user()->id)
                ->where('status', 'active')
                ->first();

            $subscibe_plan->remaining_hour = $subscibe_plan->remaining_hour - $data->hours;
            $subscibe_plan->save();

            session()->forget('request_tutor');
            return true;
        }
    }
}
