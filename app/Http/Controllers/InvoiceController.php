<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\invoice;
use XMLWriter;

class InvoiceController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showInvoiceContent(Request $request) {
        $selectConsumer = $request->get('selectedConsumer');
        $invoice = DB::table('flower_orders')
                ->join('payments', 'payments.orderID', '=', 'flower_orders.id')
                ->join('consumers', 'consumers.id', '=', 'flower_orders.customerID')
                ->where('consumers.status', '=', 'Cooperation-Consumer')
                ->where('consumers.id', '=', $selectConsumer)
                ->get(array(
            'flower_orders.id',
            'flower_orders.pdDateTime',
            'payments.totalPayment',
            'flower_orders.status'
        ));

        return view('pages.report.InvoiceDetail', ['invoice' => $invoice]);
    }

    public function showConsumer() {
        $cooperateConsumer = DB::table('consumers')
                ->where('status', '=', 'Cooperation-Consumer')
                ->get(array(
            'id'
        ));

        return view('pages.report.selectConsumer', ['cooperateConsumer' => $cooperateConsumer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeInvoice(Request $request) {
        for ($x = 0; $x < $_POST['timing']; $x++) {
            $invoices = new invoice();
            $invoices->orderID = $_POST['orderID' . $x];
            $invoices->content = $_POST['content' . $x];
            $invoices->amount = $_POST['amount' . $x];
            $invoices->status = $_POST['status' . $x];
            $invoices->save();
        }
        return redirect('staff/invoice/printInvoice');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPrintInvoice() {
        $cooperateConsumer = DB::table('consumers')
                ->where('status', '=', 'Cooperation-Consumer')
                ->get(array(
            'id'
        ));
        return view('pages.report.printInvoice', ['cooperateConsumer' => $cooperateConsumer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function DisplayInvoice(Request $request) {
        $selectConsumer = $request->get('selectedConsumer');
        $month = $request->get('month');
        $invoice = DB::table('invoices')
                ->join('flower_orders', 'flower_orders.id', '=', 'invoices.orderID')
                ->join('consumers', 'consumers.id', '=', 'flower_orders.customerID')
                ->where('consumers.id', '=', $selectConsumer)
                ->whereMonth('invoices.created_at','=',$month)
                ->get(array(
            'invoices.id',
            'invoices.created_at',
            'invoices.orderID',
            'invoices.content',
            'invoices.amount',
            'consumers.custName'
        ));
        $xml = new XMLWriter();
        $xml->openURI('invoice.xml');
         //$xml->openMemory();
        $xml->startDocument();
        $xml->startElement('Invoice');
        foreach($invoice as $invoices) {
                $xml->startElement('invoices');
                    $xml->startElement('invoiceID');
                        $xml->text($invoices->id);
                    $xml->endElement();
                    $xml->startElement('invoiceDate');
                        $xml->text($invoices->created_at);
                    $xml->endElement();
                    $xml->startElement('orderID');
                        $xml->text($invoices->orderID);
                    $xml->endElement();
                    $xml->startElement('orderDate');
                        $xml->text($invoices->content);               
                    $xml->endElement();  
                    $xml->startElement('amount');
                        $xml->text($invoices->amount);               
                    $xml->endElement();  
                    $xml->startElement('custName');
                        $xml->text($invoices->custName);               
                    $xml->endElement(); 
        $xml->endElement();
            
        }
        $xml->endElement();
        $xml->endDocument();
        $xml->flush();            
        //$content = $xml->outputMemory();
        $xml = null;
        return view('pages.report.Invoice');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
