<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'Staff';
    protected $fillable = ['name', 'ic','gender','dob','address','email','phoneNum','position','password','status'];
}
