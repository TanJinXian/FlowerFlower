<?php

namespace App\lib;
use App\flowerOrder;
use App\Consumer;
use App\payment;
use DB;
use XMLWriter;

class DailyPickupReport implements ReportInterface{
    public function getXMLReport(){
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
}