<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = [
        'orderID', 
        'content',
        'amount',
        'status'
    ];
}
