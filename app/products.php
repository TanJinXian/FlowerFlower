<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = [
        'type', 
        'name',
        'desc',
        'status',
        'price',
        'seasonPromo'
    ];
}
