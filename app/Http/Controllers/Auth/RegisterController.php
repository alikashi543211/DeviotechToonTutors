<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use App\Models\ParentProfile;
use App\Models\ParentStudent;
use App\Models\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        if (auth()->user()->role == 'tutor') {
            return '/tutor/dashboard';
        }
        if (auth()->user()->role == 'student') {
            return '/student/dashboard';
        }
        if (auth()->user()->role == 'parent') {
            return '/parent/dashboard';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if ($data['role'] == "student") {
            session()->forget('parent');
            session(['student' => true]);

            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'dob' => ['required'],
                'time_zone' => ['required'],
            ]);
        }

        if ($data['role'] == "parent") {
            session()->forget('student');
            session(['parent' => true]);

            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'phone' => ['required', 'numeric'],
                'time_zone' => ['required'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if ($data['role'] == "student") {
            session()->forget('student');

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
                'time_zone' => $data['time_zone'],
            ]);

            StudentProfile::create([
                'profile_photo' => 'default.png',
                'dob' => $data['dob'],
                'user_id' => $user->id,
            ]);

            return $user;
        }

        if ($data['role'] == 'parent') {
            session()->forget('parent');

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
                'time_zone' => $data['time_zone'],
            ]);
            ParentProfile::create([
                'profile_photo' => 'default.png',
                'phone' => $data['phone'],
                'user_id' => $user->id,
            ]);

            for ($i=0; $i < sizeof($data['student_name']) ; $i++) {
                ParentStudent::create([
                    'student_name' => $data['student_name'][$i],
                    'student_dob' => $data['student_dob'][$i],
                    'parent_id' => $user->id,
                ]);
            }

            return $user;
        }
    }
}
