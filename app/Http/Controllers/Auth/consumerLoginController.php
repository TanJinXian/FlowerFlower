<?php
/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class consumerLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:consumer', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('pages.authenticationView.custLogin');
    }

    public function login(Request $request)
    {
        //validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        //Attempt to log the user in
        if (Auth::guard('consumer')->attempt(['email'=>$request->email, 'password' => $request->password], $request->remember)){
            //if successful, then redirect to thier intended location
            return redirect()->intended(route('consumer.dashboard'))->with('status','Login Successful');
        }
        
        //if unsucessful, then redirect back to the login form with the form data
        return redirect()->back()->withInput($request->only('email','remember'));
    }

    public function logout()
    {
        Auth::guard('consumer')->logout();

        return redirect('/');
    }

}
