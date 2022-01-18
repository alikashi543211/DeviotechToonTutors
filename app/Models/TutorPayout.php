<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorPayout extends Model
{
    use HasFactory;
    protected $fillable = [
        'tutor_id',
        'meeting_session_id',
        'hours',
        'amount',
        'status',
    ];

    public function tutor()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function meeting_session()
    {
        return $this->belongsTo('App\Models\MeetingSession');
    }
}
