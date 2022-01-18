<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutorProfile;
use App\Models\User;
use Session;
use Mail;
use Hash;
use Str;

class RegisterController extends Controller
{
    public function register(Request $req)
    {
        $password = Str::random(10);

        $req->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
        ]);

        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($password),
            'role' => 'tutor',
            'time_zone' => $req->time_zone ?? 'US/Mountain',
        ]);

        $tutor = new TutorProfile();
        $tutor->phone = $req->phone;
        $tutor->video_url = $req->video_url;
        $tutor->dob = $req->dob;
        $tutor->subjects = $req->subject;
        //$tutor->hourly_rate = $req->hourly_rate;
        $tutor->country = $req->country;
        $tutor->bio = $req->bio;
        $tutor->user_id = $user->id;
        $tutor->currently_enrolled = $user->currently_enrolled ?? '0';
        if ($req->has('profile_photo')) {
            $photo = uploadFile($req->profile_photo, 'tutor/'.Str::slug($req->name), 'profile-photo');
            $tutor->profile_photo = $photo;
        }
        if ($req->has('cover_letter')) {
            $cover_letter = uploadFile($req->cover_letter, 'tutor/'.Str::slug($req->name), 'cover-letter');
            $tutor->cover_letter = $cover_letter;
        }
        if ($req->has('resume')) {
            $resume = uploadFile($req->resume, 'tutor/'.Str::slug($req->name), 'resume');
            $tutor->resume = $resume;
        }
        $tutor->save();

        Mail::send('emails.tutor.credentials', get_defined_vars(), function ($message) use($req) {
            $message->to($req->email, $req->name);
            $message->subject('Login Credentials');
        });

        Session::put('tutor_register', '1');
        return redirect()->route('tutor.register.success');
    }

    public function success()
    {
        if (Session::get('tutor_register')) {
            Session::flush('tutor_register');
            return view('front.tutor_sucess', get_defined_vars());
        } else {
            abort(403);
        }
    }
}
