<!--/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/-->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    {{session(['amount' => 1000])}}
                    {{session(['id' => Auth::user()->id])}}
                    @if(Auth::user()->position == 'Manager')
                        <div class="card-header">Manager Dashboard</div>
                        {{session(['position', Auth::user()->position])}}
                    @elseif(Auth::user()->position == 'Delivery Man')
                        <div class="card-header">Delivery Man Dashboard</div>
                        {{session(['position', Auth::user()->position])}}
                    @else
                        <div class="card-header">Staff Dashboard</div>
                        {{session(['position', Auth::user()->position])}}
                    @endif
                    
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome {{ Auth::user()->name }}!

                    @component('components.who')
                    @endcomponent

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
