<!--/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/-->
@extends('layouts.app')

@section('content')
@component('components.reportHeader', ['title' => 'Daily Pickup Report'])
@endcomponent

<div class="card-body">
    <?php
        $xsldoc = new DOMDocument();
        $xsldoc->load('dailyPickup.xsl');

        $xmldoc = new DOMDocument();
        $xmldoc->load('dailyPickupReport.xml');

        $xsl = new XSLTProcessor();
        $xsl->importStyleSheet($xsldoc);
        echo $xsl->transformToXML($xmldoc);

    ?>
    <a href="{{ URL::previous() }}" align="center">Back</a>
</div>
@endsection