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
                    {{session(['id' => Auth::user()->id])}}
                @if(Auth::user()->companyName == NULL)
                        <div class="card-header">Customer Dashboard</div>
                    @else
                        <div class="card-header">Coporate Customer Dashboard</div>
                    @endif
                    
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome {{ Auth::user()->name }}!
                    <td><a href="{{route('orderMain')}}" class="btn btn-warning">Order</a></td>
                    @component('components.who')
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
