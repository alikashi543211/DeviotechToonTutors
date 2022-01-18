<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'date',
        'slot',
        'time_in_min',
        'student_id',
        'tutor_id',
        'parent_student_id',
        'status',
        'class_status',
        'interval',
        'no_of_weeks',
        'remaining_weeks',
        'active_date',
        'payment_status',
        'amount',
        'amount_paid',
        'amount_reserved',
        'is_subscribed_payment',
    ];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function student_user()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    public function tutor_user()
    {
        return $this->belongsTo('App\Models\User', 'tutor_id');
    }

    public function parent_student()
    {
        return $this->belongsTo('App\Models\ParentStudent', 'parent_student_id');
    }
}
