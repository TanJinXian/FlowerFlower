<?php

namespace App\lib;
use Illuminate\Http\Request;

interface creditLimitInterface{
    public function editCreditLimit(Request $request);
}