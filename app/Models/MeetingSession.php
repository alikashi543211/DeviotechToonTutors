<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'zoom_id',
        'start_url',
        'join_url',
        'tutor_id',
        'refund_request',
        'student_id',
        'time_taken',
        'ended_at',
        'status',
        'student_joined',
        'tutor_request_id'
    ];

    public function student_user()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    public function tutor_user()
    {
        return $this->belongsTo('App\Models\User', 'tutor_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function tutor_request()
    {
        return $this->belongsTo('App\Models\TutorRequest', 'tutor_request_id');
    }
}
