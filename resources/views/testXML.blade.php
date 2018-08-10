@extends('layouts.app')

@section('content')

<?php
            $xsldoc = new DOMDocument();
            $xsldoc->load('catalog.xsl');

            $xmldoc = new DOMDocument();
            $xmldoc->load('catalog.xml');

            $xsl = new XSLTProcessor();
            $xsl->importStyleSheet($xsldoc);
            echo $xsl->transformToXML($xmldoc);
?>

@endsection