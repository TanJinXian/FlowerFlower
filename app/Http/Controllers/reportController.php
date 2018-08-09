<?php
/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\flowerOrder;
use App\Consumer;
use DB;
use XMLWriter;

class reportController extends Controller
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
        
        $result = \DB::table('flower_orders')
                        ->join('consumers','consumers.id','=','flower_orders.customerID')
                        ->where('flower_orders.created_at', '=', '2018-08-08 13:17:17')
                        ->get(array(
                            'flower_orders.id',
                            'custName',
                            'type'
                        ));

        //return view('pages.report.dailyOrderReport',$result);
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
        //
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
        //
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

    public function showDailySaleReport()
    {
        $results = DB::table('flower_orders')
        ->join('consumers','consumers.id','=','flower_orders.customerID')
        ->join('payments','payments.orderID','=','flower_orders.id')
        ->whereDate('flower_orders.created_at', DB::raw('CURDATE()'))
        ->where('type','=','pickup')
        ->get(array(
            'flower_orders.id',
            'custName',
            'flower_orders.created_at',
            'totalPayment'
        ));
        
        $xml = new XMLWriter();
        $xml->openURI('dailySaleReport.xml');
        //$xml->openMemory();
        $xml->startDocument();
        $xml->startElement('orderReport');
        foreach($results as $result) {
                $xml->startElement('order');
                    $xml->startElement('orderid');
                        $xml->text($result->id);
                    $xml->endElement();
                    $xml->startElement('custName');
                        $xml->text($result->custName);
                    $xml->endElement();
                    $xml->startElement('orderDate');
                        $xml->text($result->created_at);
                    $xml->endElement();
                    $xml->startElement('totalPayment');
                        $xml->text($result->totalPayment);               
                    $xml->endElement();  
        $xml->endElement();
            
        }
        $xml->endElement();
        $xml->endDocument();
        $xml->flush();            
        //$content = $xml->outputMemory();
        $xml = null;
        
        return view('pages.report.dailyOrderReport');
    }

    public function showDailyPickupReport()
    {
        $results = DB::table('flower_orders')
        ->join('consumers','consumers.id','=','flower_orders.customerID')
        ->join('payments','payments.orderID','=','flower_orders.id')
        ->whereDate('flower_orders.created_at', DB::raw('CURDATE()'))
        ->where('type','=','pickup')
        ->get(array(
            'flower_orders.id',
            'custName',
            'flower_orders.pdDateTime',
            'totalPayment'
        ));
        
        $xml = new XMLWriter();
        $xml->openURI('dailyPickupReport.xml');
        //$xml->openMemory();
        $xml->startDocument();
        $xml->startElement('orderReport');
        foreach($results as $result) {
                $xml->startElement('order');
                    $xml->startElement('orderid');
                        $xml->text($result->id);
                    $xml->endElement();
                    $xml->startElement('custName');
                        $xml->text($result->custName);
                    $xml->endElement();
                    $xml->startElement('PickupTime');
                        $xml->text($result->pdDateTime);
                    $xml->endElement();
                    $xml->startElement('totalPayment');
                        $xml->text($result->totalPayment);               
                    $xml->endElement();  
        $xml->endElement();
            
        }
        $xml->endElement();
        $xml->endDocument();
        $xml->flush();            
        //$content = $xml->outputMemory();
        $xml = null;
        
        return view('pages.report.dailyPickupReport');
    }

    public function showDailyDeliveryReport()
    {
        $results = DB::table('flower_orders')
        ->join('consumers','consumers.id','=','flower_orders.customerID')
        ->join('payments','payments.orderID','=','flower_orders.id')
        ->whereDate('flower_orders.created_at', DB::raw('CURDATE()'))
        ->where('type','=','delivery')
        ->get(array(
            'flower_orders.id',
            'custName',
            'flower_orders.deliveryAdd',
            'totalPayment'
        ));
        
        $xml = new XMLWriter();
        $xml->openURI('dailyDeliveryReport.xml');
        //$xml->openMemory();
        $xml->startDocument();
        $xml->startElement('orderReport');
        foreach($results as $result) {
                $xml->startElement('order');
                    $xml->startElement('orderid');
                        $xml->text($result->id);
                    $xml->endElement();
                    $xml->startElement('custName');
                        $xml->text($result->custName);
                    $xml->endElement();
                    $xml->startElement('DeliveryAddress');
                        $xml->text($result->deliveryAdd);
                    $xml->endElement();
                    $xml->startElement('totalPayment');
                        $xml->text($result->totalPayment);               
                    $xml->endElement();  
        $xml->endElement();
            
        }
        $xml->endElement();
        $xml->endDocument();
        $xml->flush();            
        //$content = $xml->outputMemory();
        $xml = null;
        
        return view('pages.report.dailyDeliveryReport');
    }
}
