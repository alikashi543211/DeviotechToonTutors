<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SyncsWithFirebase;

class Message extends Model
{
    use SyncsWithFirebase;
    use HasFactory;

    protected $table = "messages";

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
