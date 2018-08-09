<?php
/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Staff;
class staffRegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    public function showStaffRegisterForm(){
        return view('pages.authenticationView.staffRegister');
    }

    public function staffRegister(Request $requset){
        $requset['password'] = bcrypt($requset->password); // encrypt the user password
        Staff::create($requset->all());
        return redirect('staff/staffLogin');
    }
}
