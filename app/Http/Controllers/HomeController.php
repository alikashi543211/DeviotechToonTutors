<?php

namespace App\Http\Controllers;

use App\Models\TutorProfile;
use App\Models\TutorRequest;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Package;
use App\Models\User;
use Session;
use Auth;
use Zoom;
use Mail;


class HomeController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function callback()
    {
        User::create([
            'name' => 'ali',
            'email' => 'alias@gmail.com',
            'password' => '121212121',
        ]);
    }

    public function aboutUs()
    {
        return view('front.about_us');
    }

    public function ourServices()
    {
        $packages = Package::all();
        return view('front.our_services', get_defined_vars());
    }

    public function purchase($id = null)
    {
        if (Auth::check()) {
            $user = auth()->user();
            if ($user->role == "student") {
                return redirect()->route('student.package.payment', $id);
            } else {
                return redirect()->back()->with('error', 'Sorry! You are not allowed');
            }
        } else {
            session(['package_id' => $id]);
            return redirect()->route('login');
        }

        // route('student.package.payment', $item->id)
    }

    public function joinTeam()
    {
        return view('front.join_team');
    }

    public function contactUs()
    {
        return view('front.contact_us');
    }

    public function contact(Request $req)
    {
        $data=$req->all();
        Mail::send('emails.front.contact', get_defined_vars(), function ($message) {
                    $message->to("contact@toontutors.ca", "ToonTutor");
                    $message->subject('Contact message');
                });
        Session::flash("success","Thanks! we have recieved your email");
        return response()->json("Email sent successfully");
    }

    public function ourTutor(Request $request)
    {


        $list = User::where('role', 'tutor')
            ->whereHas('time_tables')
            ->whereHas('tutor_profile', function($q) use ($request){
                $q->where('status', 'approved');
            });

        if($request->get('location') && $request->get('location') != "all")
        {
            $list = $list->whereHas('tutor_profile', function($q) use ($request){
                $q->where('country', $request->location);
            });
        }

        if($request->get('subject') && $request->get('subject') != "all")
        {
            $list = $list->whereHas('tutor_profile', function($q) use ($request){
                $q->where('subjects', $request->subject);
            });
        }

        if($request->get('availablity'))
        {
            $list = $list->whereHas('tutor_profile', function($q) use ($request){
                $q->where('availablity', $request->availablity);
            });
        }

        if($request->get('search'))
        {
            $list = $list->whereHas('tutor_profile', function($q) use ($request){
                $q->orWhere('bio','like','%'.$request->search.'%');
            });
        }

        $get_data = $list->get();


        return view('front.our_tutors', get_defined_vars());
    }

    public function loadRequestForm($id = null)
    {
        return view('ajax.front.load_request_tutor', get_defined_vars());
    }

    public function buyHours()
    {
        if (Auth::User()->role == 'student') {
            return redirect()->route('student.buy.hours');
        }else if (Auth::User()->role == 'parent') {
            return redirect()->route('parent.buy.hours');
        }
    }

    public function privacy()
    {
        return view("front.privacy");
    }
}
