<?php

namespace App\lib;

use Illuminate\Http\Request;
use App\Consumer;

class proxyCreditLimit implements creditLimitInterface{
    public function editCreditLimit(Request $request){
        return $porxy = (new Consumer())->editCreditLimit($request);
    }
}