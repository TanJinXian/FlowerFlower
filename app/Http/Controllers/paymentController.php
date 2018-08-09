<?php
/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\flowerOrder;
use App\payment;

class paymentController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = payment::find($id);
        return view('payment.paymentView', ['payment'=>$payment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->cash == 0 || empty($request->cash)|| $request->cash < $request->totalPayment){
            return view('ErrorPage.paymentError');
        }
        $payment = payment::find($id);
        $payment->status = 'paid';
        $payment->save();
        return redirect(route('staff.dashboard'))->with('status','Payment Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showOrderPaymentPickup(){
        $result = DB::table('flower_orders')
                    ->join('consumers','consumers.id','=','flower_orders.customerID')
                    ->join('payments','payments.orderID','=','flower_orders.id')
                    ->whereDate('flower_orders.created_at', DB::raw('CURDATE()'))
                    ->where('type','=','pickup')
                    ->where('payments.status','=','unpay')
                    ->get(array(
                        'flower_orders.id',
                        'custName',
                        'flower_orders.created_at',
                        'totalPayment'
                    ));

        return view('payment.pickupOrderList',['result' => $result]);
    }

    public function showOrderPaymentDelivery(){
        $result = DB::table('flower_orders')
                    ->join('consumers','consumers.id','=','flower_orders.customerID')
                    ->join('payments','payments.orderID','=','flower_orders.id')
                    ->whereDate('flower_orders.created_at', DB::raw('CURDATE()'))
                    ->where('type','=','delivery')
                    ->where('payments.status','=','unpay')
                    ->get(array(
                        'flower_orders.id',
                        'custName',
                        'deliveryAdd',
                        'totalPayment'
                    ));

        return view('payment.deliveryOrderList',['result' => $result]);
    }

    public function showPaymentForm(Request $request){
        $order = flowerOrder::find($request->$id);
        return view('payment.paymentView', ['order'=>$order]);
    }

    public function cancelOrder(Request $request){
        $payment = payment::find($id);
        $payment->status = 'cancel';
        $payment->save();
        return redirect('staff');
    }
}
