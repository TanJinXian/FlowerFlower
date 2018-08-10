<?php

namespace App\lib;

class proxyXMLgenerator implements generateXML{

    public function generatorXML(){
        return $realXmlgenerator = (new XMLgenerator)->generatorXML();
    }

}

