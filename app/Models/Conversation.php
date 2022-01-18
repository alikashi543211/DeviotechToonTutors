<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $table = "conversations";

    public function student_user()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    public function tutor_user()
    {
        return $this->belongsTo('App\Models\User', 'tutor_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }
}
