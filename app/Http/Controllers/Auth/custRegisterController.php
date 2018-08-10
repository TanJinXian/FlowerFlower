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

    public function custRegister(Request $request){
        $this->validate($request,['custName'=>'required|min:5|max:35',],['custName.required'=>'Enter full name']);
        $this->validate($request, ['password'=>'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',],['password.required'=>'Enter More Than 6 Character']);
        $this->validate($request,['confirmPassword'=>'required_with:password|same:password|min:6',],['confirmPassword.required'=>'Enter More Than 6 Character']);
        
        $request['password'] = bcrypt($request->password); // encrypt the user password
        Consumer::create($request->all());
        return redirect('customer/custLogin');
        
}
}