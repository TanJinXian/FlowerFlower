{{-- Tan Yi Ying --}}

@extends('layouts.app')

@section('content')

@if (\Session::has('success'))
  <div class="alert alert-success">
    <p>{{ \Session::get('success') }}</p>
  </div><br />
@endif

@php 
  $grandTotal = 0;
  $counter = 0; 
  $promoArray = array();
@endphp

<h2 style="text-align:center;">Order Details</h2><br />
<table class="table table-striped">
  <thead>
    <tr>
      <th>Product ID</th>
      <th>Product Type</th>
      <th>Product Name</th>
      <th>Unit Price (RM)</th>
      <th>Quantity</th>
      <th>Discount</th>
      <th>Total Price (RM)</th>
      <th colspan="2">Delete?</th>
    </tr>
  </thead>

  <tbody>
    @if (\Session::has('orderDetailList')) 
      @foreach(Session::get('orderDetailList') as $orderDetail)
        <tr>
          <td>P{{$orderDetail['productID']}}</td>
            
          @foreach(Session::get('productList') as $product)
            @if($orderDetail['productID'] == $product['id'])
              <td>{{$product['type']}}</td>
              <td>{{$product['name']}}</td>
              <td>{{number_format($product['price'], 2, '.', '')}}</td>
            @endif
          @endforeach  
          
          <td>
            <form action="{{url('updateOrderItem', $orderDetail['productID'])}}" method="POST">
              @csrf
              <input type="number" name="quantity" min="1" max="999" value="{{$orderDetail['qty']}}" style="width:4em">
              <button class="glyphicon glyphicon-edit" type="submit" style="background-color:lime;"></button>    
            </form>
          </td>

          @php           
            $currentTime = Carbon\Carbon::now();
            $currentTime->toDateTimeString();
            $currentMonth = substr($currentTime, 5, 2);
          @endphp

          @foreach(Session::get('productList') as $product)
            @if($orderDetail['productID'] == $product['id'])
              @if(substr($product['seasonPromo'], 5, 2) == $currentMonth)
                <td>20%</td>
              @else
                <td>0%</td>  
              @endif
            @endif  
          @endforeach

          @foreach(Session::get('productList') as $product)
            @php 
              $subTotal = 0;             
              $isPromo = false; 
            @endphp 
            @if($orderDetail['productID'] == $product['id'])
              @php
                if (substr($product['seasonPromo'], 5, 2) == $currentMonth) {
                  $subTotal = $product['price'] * $orderDetail['qty'] * 0.8;
                  $isPromo = true;
                } else {
                  $subTotal = $product['price'] * $orderDetail['qty'];
                }
                $promoArray[$counter] = $isPromo;
                $counter++;
                $grandTotal += $subTotal; 
              @endphp
              <td>{{number_format($subTotal, 2, '.', '')}}</td>            
            @endif
          @endforeach

          <td>
            <form action="{{url('deleteOrderItem', $orderDetail['productID'])}}" method="POST">
              @csrf
              <button class="glyphicon glyphicon-remove" type="submit" style="background-color:red;"></button>
            </form>
          </td>

        </tr>
      @endforeach

      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td style="font-weight:bold">Grand Total (RM):</td>
        <td style="font-weight:bold">{{number_format($grandTotal, 2, '.', '')}}</td>
        <td>&nbsp;</td>
        @php 
          Session::put('grandTotal', $grandTotal); 
          Session::put('promoArray', $promoArray);
        @endphp
      </tr>
    @endif
  </tbody>

</table>

<div class="col-md-12" style="text-align:center;">
  <br /><br />
  <button class="btn btn-danger" type="button" onclick="window.location='{{url('order')}}'" style="text-align:center;">Back</button>
  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;

  <button class="btn btn-primary" type="submit" style="text-align:center;"
  @foreach(Session::get('customerList') as $customer) 
    @if($customer['id'] == session('id'))
      @if($customer['status'] == 'Corporate Customer')
        @if($grandTotal > $customer['creditLimit']) 
          data-toggle="modal" data-target="#exampleModal"
        @else 
          onclick="window.location='{{url('proceedOrderInfo')}}'"    
        @endif  
      @else 
          onclick="window.location='{{url('proceedOrderInfo')}}'"        
      @endif  
    @endif
  @endforeach
  @if (!\Session::has('orderDetailList')) disabled @endif>Proceed</button>
  
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Over Credit Limit </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"> 
          {{"Your credit is over, do you want to proceed order?"}}<br/>
          {{"If yes, it would be cash on delivery or pickup."}}  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="window.location='{{url('proceedOrderInfo')}}'">Yes</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection