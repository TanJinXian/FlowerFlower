<?php

function convertOrderToXML($orderInfoList, $orderDetailList, $productList) {
    $orderID = Session::get('orderID');
    $orderDeID = Session::get('orderDeID');
    $grandTotal = Session::get('grandTotal');
    $promoArray = Session::get('promoArray');
    $count = 0;

    $xml = new XMLWriter();

    $xml->openMemory();
    $xml->setIndent(true);
    $xml->setIndentString('    ');
    $xml->startDocument('1.0', 'UTF-8');

    if('orderSale.xsl'){ 
        $xml->writePi('xml-stylesheet', 'type="text/xsl" href="'."orderSale.xsl".'"'); 
    }

    $xml->startElement('orderInfo');
    
    foreach($orderInfoList as $orderInfo) {
        if($orderInfo['id'] == $orderID) {
            $xml->startElement('order');
            $xml->writeAttribute('id', $orderInfo->id);
            $xml->writeElement('type', $orderInfo->type);
            $xml->writeElement('deliveryAdd', $orderInfo->deliveryAdd);
            $xml->writeElement('pdDateTime', $orderInfo->pdDateTime);
            $xml->writeElement('customerID', $orderInfo->customerID);
            $xml->writeElement('status', $orderInfo->status);
            $xml->startElement('orderDetails');
            foreach($orderDetailList as $orderDetail) {
                if($orderDetail['orderID'] == $orderDeID) {
                    $xml->startElement('detail');
                    foreach($productList as $product) {
                        if($product['id'] == $orderDetail['productID']) {
                            $xml->startElement('product');
                            $xml->writeElement('productID', $product->id);
                            $xml->writeElement('unitPrice', $product->price);
                            $xml->endElement();
                            $xml->writeElement('quantity', $orderDetail->qty);                                                                                                                      
                            if($promoArray[$count]  == true) {
                                $xml->writeElement('discount', '20%');
                                $xml->writeElement('subtotal', $product->price * $orderDetail->qty * 0.8);
                            } else {
                                $xml->writeElement('discount', '0%');
                                $xml->writeElement('subtotal', $product->price * $orderDetail->qty);
                            }   
                            $count++;                                                                                          
                        }
                    }                  
                    $xml->endElement();
                }
            }
            $xml->endElement();
            $xml->writeElement('grandTotal', $grandTotal);
            $xml->endElement();
        }
    }
    $xml->endElement();
    $xml->endDocument();

    $output = $xml->outputMemory();
    
    return $output;
}