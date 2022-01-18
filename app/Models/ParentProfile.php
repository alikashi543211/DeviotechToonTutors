<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'profile_photo',
        'phone',
        'user_id',
    ];
}
