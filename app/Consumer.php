<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Consumer extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard = 'consumer';
    protected $table = 'consumers';
    protected $fillable = [
        'custName', 
        'custIC',
        'custGender',
        'custDob',
        'address',
        'email',
        'ContactNo',
        'companyName',
        'creditLimit',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
