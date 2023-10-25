<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class Sessions extends Model
{

    protected $table = 'sessions';


    protected $fillable = [
        'user_id',
        'pass',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity'
    ];

    protected $visible =  [
        'id',
        'user_id',
        'pass',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity'
    ];

}
