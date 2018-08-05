<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Auth;

class AuthController extends Controller
{
    public function showStaffRegisterForm(){
        return view('pages.authenticationView.staffRegister');
    }

    public function staffRegister(Request $requset){
        $requset['password'] = bcrypt($requset->password); // encrypt the user password
        Staff::create($requset->all());
        return redirect('/staffLogin');
    }

    public function showStaffLoginForm(){
        return view('pages.authenticationView.staffLogin');
    }

    public function staffLogin(Request $requset){
        
        if (Auth::attempt(['email'=>$requset->email, 'password' => $requset->password])){
            return "logged in successfully";
        }
        
        //dd($requset->all());
        return "login faile";
    }
    
}
