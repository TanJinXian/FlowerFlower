<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Staff;
class staffRegisterController extends Controller
{
    public function showStaffRegisterForm(){
        return view('pages.authenticationView.staffRegister');
    }

    public function staffRegister(Request $requset){
        $requset['password'] = bcrypt($requset->password); // encrypt the user password
        Staff::create($requset->all());
        return redirect('staff/staffLogin');
    }
}
