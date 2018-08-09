<!--/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/-->

@extends('layouts.app')

@section('content')
<div class="card-body">
    @if ($result->isEmpty())
        <p class="display-9" style="text-align: center">Does not have any order in this moment</p>
    @else
<table class="table table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($result as $results)
            <tr>
                    <td>{{$results->id}}</td>
                    <td>{{$results->custName}}</td>
                    <td>{{$results->deliveryAdd}}</td>
                    <td>{{$results->totalPayment}}<td>
                    <td>
                        <a href="{{action('paymentController@edit',$results->id)}}" class="btn btn-warning">Pay</a>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection