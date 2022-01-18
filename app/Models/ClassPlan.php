<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'tutor_id',
        'student_id',
        'date_time',
        'status',
    ];

    public function student_user()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    public function tutor_user()
    {
        return $this->belongsTo('App\Models\User', 'tutor_id');
    }
}
