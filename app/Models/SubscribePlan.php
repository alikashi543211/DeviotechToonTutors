<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribePlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id',
        'user_id',
        'card_holder_name',
        'total_hour',
        'remaining_hour',
        'amount',
        'status',
    ];

    public function package()
    {
        return $this->belongsTo("App\Models\Package");
    }

    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }
}
