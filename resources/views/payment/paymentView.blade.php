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
                    <div class="card-header" style="text-align: center">Payment</div>
                </div>
                <div class="card-body">
                <form action="{{action('paymentController@update', $payment->id)}}" method="POST">
                    @csrf
                    <input name="id" type="hidden" value="{{session('id')}}">
                    <input name="orderID" type="hidden" value="{{$payment->id}}">
                    <input name="_method" type="hidden" value="PATCH">
                    <p>
                        <label for="amount">Amount: RM</label>
                    <input type="text" name="totalPayment" value="{{$payment->totalPayment}}" id="totalPayment" disabled>
                    </p>

                    <p>
                        <label for="paymentAmount">Cash: RM</label>
                        <input type="number" name="cash" id="cash">
                    </p>
                
                <p>
                    <button type="submit" class="btn btn-danger" id="Button" disabled>Pay</button>
                </p>
                </div>
                </form>
            </div>
        </div>
</div>

<script type="text/javascript">
    window.onload=function()
{
    document.getElementById("cash").onchange=function()
    {
        var amountNeedPay = document.getElementById("totalPayment").value;
        var cash = document.getElementById("cash").value;
        if (cash == 0 || cash == null || cash === ""){
            document.getElementById("Button").disabled=false;
        }
        else if(cash>amountNeedPay)
        {
            document.getElementById("Button").disabled=true;
        }
        else if (cash == amountNeedPay)
        {
            document.getElementById("Button").disabled=true;
            
        }else{
            document.getElementById("Button").disabled=false;
        }
    }
}
</script>
@endsection