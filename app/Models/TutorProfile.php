<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'profile_photo',
        'phone',
        'video_url',
        'dob',
        'subjects',
        'cover_letter',
        'resume',
        'currently_enrolled',
        'user_id',
        'country',
        'bio',
        'availability',
        'hourly_rate',
        'stripe_account',
        'is_boarded',
        'status',
    ];
}
