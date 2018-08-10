<?php

namespace App\lib;
use App\flowerOrder;
use App\Consumer;
use App\payment;
use DB;
use XMLWriter;

class DailyDeliveryReport implements ReportInterface{
    public function getXMLReport(){
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