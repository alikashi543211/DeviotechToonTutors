<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'meeting_session_id',
        'rating',
        'review',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function meeting_session()
    {
        return $this->belongsTo('App\Models\MeetingSession');
    }
}
