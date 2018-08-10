<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Consumer;
use App\Catalog;
use App\Products;
use App\flowerOrder;
use App\OrderDetail;
use App\FlowerOrderFactory;
use Carbon;
use Session;
use Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderIndex(Request $request)
    {      
        $customerList = consumer::all();
        Session::put('customerList', $customerList);

        $currentTime = \Carbon\Carbon::now();
        $currentTime->toDateTimeString();
        $currentYearMonth = substr($currentTime, 0, 7);

        $catalogList = Catalog::all();
        $productList = products::all();
        $matchProductID = array();
        $count = 1;

        foreach ($catalogList as $catalog) {
            if (substr($catalog['Month'], 0, 7) == $currentYearMonth) {
                foreach ($productList as $product) {
                    if ($catalog['productID'] == $product['id']) {
                        $matchProductID[$count] = $catalog['productID'];
                        $count++;
                    }
                }
            }
        }

        $matchFreshFlower = ['type' => 'Flower', 'status' => 'Available'];
        $productsFreshFlower = Products::where($matchFreshFlower)->whereIn('id', $matchProductID)->get();

        $matchBouquet = ['type' => 'bouquets', 'status' => 'Available'];
        $productsBouquet = Products::where($matchBouquet)->whereIn('id', $matchProductID)->get();

        $matchFloralArr = ['type' => 'floralArrangements', 'status' => 'Available'];
        $productsFloralArr = Products::where($matchFloralArr)->whereIn('id', $matchProductID)->get();

        if($request->get('freshFlower') == "Fresh Flower") {
            $type = "freshFlower";
        } elseif($request->get('bouquet') == "Bouquet") {
            $type = "bouquet";
        } elseif($request->get('floralArr') == "Floral Arrangement") {
            $type = "floralArr";
        }

        return view('pages.flowerOrder', compact('productsFreshFlower', 'productsBouquet', 'productsFloralArr', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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

    public function storeOrderDetails(Request $request) {       
        $orderDetails = FlowerOrderFactory::createOrderDetail();
        $orderDetails->productID = $request->get('productID');
        $orderDetails->qty = $request->get('quantity');
        
        if (Session::has('orderDetailList')) {
            $orderDetailList = Session::get('orderDetailList');
            $isFound = 'false';

            //check if productID exist in the orderDetailList, if yes, update the qty
            for ($i = 0; $i < count($orderDetailList); $i++) {
                if ($orderDetailList[$i]['productID'] == $orderDetails->productID) {
                    $orderDetailList[$i]['qty'] += $orderDetails->qty;
                    $isFound = 'true';
                    break;
                }
            }
            
            if ($isFound == 'false') {
                $count = count($orderDetailList);
                $orderDetailList[$count] = $orderDetails;
            }
                            
        } else {
            $orderDetailList = array();
            $orderDetailList[0] = $orderDetails;
        }

        Session::put('orderDetailList', $orderDetailList);
        Session::put('productList', Products::all());
        return redirect('orderDetails')->with('success', 'Information has been added');
    }

    public function deleteOrderItem($productID) {
        $orderDetailList = Session::get('orderDetailList');

        for($i = 0; $i < count($orderDetailList); $i++) {
            if($orderDetailList[$i]['productID'] == $productID) {
                array_splice($orderDetailList, $i, 1);
                break;
            }
        }

        Session::put('orderDetailList', $orderDetailList);

        return redirect('orderDetails');
    }

    public function updateOrderItem(Request $request, $productID) {
        $orderDetailList = Session::get('orderDetailList');

        for($i = 0; $i < count($orderDetailList); $i++) {
            if($orderDetailList[$i]['productID'] == $productID) {
                $orderDetailList[$i]['qty'] = $request->get('quantity');
                break;
            }
        }

        Session::put('orderDetailList', $orderDetailList);

        return redirect('orderDetails');
    }

    public function storeOrderInfo(Request $request) {
        $orderInfo = FlowerOrderFactory::createOrder();
        $orderInfo->type = $request->get('type');
        $orderInfo->deliveryAdd = $request->get('delAdd');
        $orderInfo->pdDateTime = $request->get('pdDate')." ".$request->get('pdTime').":00";

        Session::put('orderInfo', $orderInfo);
        Session::put('isEditable', false);

        return view('pages.orderConfirmation', compact('orderInfo'));
    }

    //Store into database
    public function storeOrder() {
        $orderInfo = Session::get('orderInfo');
        $orderInfo->customerID = session('id');
        $orderInfo->status = "Processing";
        $orderInfo->save();

        $orderDetailList = Session::get('orderDetailList');
        foreach ($orderDetailList as $orderDetail) {
            $orderDetail->orderID = $orderInfo['id'];
            $orderDetail->save();
        }

        $payment = FlowerOrderFactory::createPayment();
        $payment->orderID = $orderInfo['id'];
        $payment->totalPayment = Session::get('grandTotal');
        $payment->status = "Unpay";
        $payment->save();

        $customer = consumer::find(1);
        if ($customer['status'] == 'Corporate Customer') {
            $currentCL = $customer['creditLimit'];
            if ($payment['totalPayment'] < $currentCL) {
                $customer->creditLimit = $currentCL - $payment['totalPayment'];
                $customer->save();
            }
        }

        Session::put('orderID', $orderInfo['id']);
        Session::put('orderDeID', $orderDetail['orderID']);

        return redirect('orderXML');
    }

    public function convertToXML() {
        $orderInfoList = flowerOrder::all();
        $orderDetailList = orderDetail::all();
        $productList = products::all();

        $xml = convertOrderToXml($orderInfoList, $orderDetailList, $productList);

        Storage::disk('local')->put('order.xml', $xml);

        Session::forget('orderInfo');
        Session::forget('orderDetailList');
        Session::forget('isEditable');
        Session::forget('grandTotal');
        Session::forget('promoArray');

        return redirect ('saleOrder')->with('successOrder', 'Order has been placed');
    }

}
