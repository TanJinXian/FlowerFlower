<?php
/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ConsumerResetPasswordNotification;

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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ConsumerResetPasswordNotification($token));
    }
}
