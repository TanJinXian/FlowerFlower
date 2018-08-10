<?php

namespace App\lib;
use App\products;

class XMLgenerator implements generateXML{
    public function generatorXML(){
        $product=products::all()->where('status', 'Available');
        $xml = new \XMLWriter();
        $xml->openURI('dailySaleReport.xml');
        //$xml->openMemory();
        $xml->startDocument();
        $xml->startElement('ProductItem');
        foreach($product as $products){
            $xml->startElement('Product');
            $xml->startElement('type');
                $xml->text($products->type);
                $xml->endElement();
                $xml->startElement('id');
                $xml->text($products->id);
                $xml->endElement();
                $xml->startElement('name');
                $xml->text($products->name);
                $xml->endElement();
                $xml->startElement('desc');
                $xml->text($products->desc);
                $xml->endElement();
                $xml->startElement('price');
                $xml->text($products->price);
                $xml->endElement();
                $xml->startElement('status');
                $xml->text($products->status);
                $xml->endElement();
                $xml->startElement('seasonPromo');
                $xml->text($products->seasonPromo);
                $xml->endElement();
            $xml->endElement();
        }
        $xml->endElement();
        $xml->endDocument();
        $xml->flush();            
        //$content = $xml->outputMemory();
        $xml = null;
        
        return view('testXML');
    }
}

