<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staffDashboard');
    }

    public function showDailySaleReport()
    {
        return view('pages.report.dailyOrderReport');
    }

    public function showDailyPickupReport()
    {
        return view('pages.report.dailyPickupReport');
    }

    public function showDailyDeliveryReport()
    {
        return view('pages.report.dailyDeliveryReport');
    }
}
