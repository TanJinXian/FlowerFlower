<?php
/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/
namespace App\Http\Controllers;
use App\Consumer;
use App\lib\proxyCreditLimit;

use Illuminate\Http\Request;
use DB;

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

    /*
    public function showDailySaleReport()
    {
        $result = DB::table('flower_orders')
                        ->join('consumers','consumers.id','=','flower_orders.customerID')
                        ->whereDate('flower_orders.created_at', DB::raw('CURDATE()'))
                        ->get(array(
                            'flower_orders.id',
                            'custName',
                            'type'
                        ));

        return view('pages.report.dailyOrderReport',['result' => $result]);
    }
    */
    public function showDailyPickupReport()
    {
        return view('pages.report.dailyPickupReport');
    }

    public function showDailyDeliveryReport()
    {
        return view('pages.report.dailyDeliveryReport');
    }

    public function showConsumer(){
        $cooperateConsumer = DB::table('consumers')
               ->where('status', '=', 'Cooperation-Consumer')
               ->get(array(
           'id'
       ));
        return view('pages.authenticationView.chooseConsumer', ['cooperateConsumer' => $cooperateConsumer]);
   }
   
   public function updateCreditLimit(Request $request){
       return $proxyCreditLimit = (new proxyCreditLimit)->editCreditLimit($request);
   }
}
