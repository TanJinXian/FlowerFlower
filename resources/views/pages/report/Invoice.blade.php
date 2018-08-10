@extends('layouts.app')

@section('content')
@component('components.reportHeader', ['title' => 'Invoice Detail'])
@endcomponent
<div align="center">
<?php
            $xsldoc = new DOMDocument();
            $xsldoc->load('invoice.xsl');

            $xmldoc = new DOMDocument();
            $xmldoc->load('invoice.xml');

            $xsl = new XSLTProcessor();
            $xsl->importStyleSheet($xsldoc);
            echo $xsl->transformToXML($xmldoc);

?>
</div>
@endsection
