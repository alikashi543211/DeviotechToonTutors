<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'stripe_transfer_id',
        'amount',
        'tutor_id',
    ];
}
