<?php
/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsumerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:consumer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('consumerDashboard');
    }
}
