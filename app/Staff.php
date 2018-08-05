<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    use Notifiable;
    protected $guard = 'staff';
    protected $table = 'Staff';
    protected $fillable = ['name', 
        'ic',
        'gender',
        'dob',
        'address',
        'email',
        'phoneNum',
        'position',
        'password',
        'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
