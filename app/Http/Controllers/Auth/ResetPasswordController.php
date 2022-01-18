<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
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
        if (auth()->user()->role == 'admin') {
            return '/admin/dashboard';
        }
    }
}
