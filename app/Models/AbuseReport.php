<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbuseReport extends Model
{
    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'abuse_details',
        'abuser_nickname',
        'state',
        'abuser_full_name',
        'is_reviewed'
    ];
}
