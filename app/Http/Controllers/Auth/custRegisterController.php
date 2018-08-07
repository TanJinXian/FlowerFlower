<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Consumer;
/**
 * Description of custRegisterController
 *
 * @author User
 */
class custRegisterController extends Controller{
    
     public function showCustRegisterForm(){
        return view('pages.authenticationView.custRegister');
    }

    public function custRegister(Request $requset){
        $requset['password'] = bcrypt($requset->password); // encrypt the user password
        Consumer::create($requset->all());
        return redirect('staff/staffLogin');
        
}
}