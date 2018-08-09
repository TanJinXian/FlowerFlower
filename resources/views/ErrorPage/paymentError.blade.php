<!--/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/-->

@extends('layouts.app')

@section('content')
<div align="center">
    <p class="display-5">Your Payment can't process due to the issue</p>
    <p class="display-10">Maybe you enter the cash less then the payment need to payment.</p>
    <a href="{{ URL::previous() }}" align="center">Back</a>
</div>
@endsection