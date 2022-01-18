<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;
use App\Models\TutorProfile;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'time_zone',
        'calendar_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function tutor_profile()
    {
        return $this->hasOne('App\Models\TutorProfile', 'user_id');
    }

    public function time_tables()
    {
        return $this->hasMany('App\Models\TimeTable', 'tutor_id');
    }

    public function student_profile()
    {
        return $this->hasOne('App\Models\StudentProfile', 'user_id');
    }

    public function parent_profile()
    {
        return $this->hasOne('App\Models\ParentProfile', 'user_id');
    }

    public function student_requests()
    {
        return $this->hasMany('App\Models\TutorRequest', 'student_id');
    }

    public function tutor_requests()
    {
        return $this->hasMany('App\Models\TutorRequest', 'tutor_id');
    }

    public function parent_students()
    {
        return $this->hasMany('App\Models\ParentStudent', 'parent_id');
    }

    public function subscribe_plans()
    {
        return $this->hasMany('App\Models\SubscribePlan');
    }

}
