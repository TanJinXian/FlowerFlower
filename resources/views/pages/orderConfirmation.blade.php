{{-- Tan Yi Ying --}}

@extends('layouts.app')

@section('content')

<script>
    function pdType() {
        if(document.getElementById('pickup').checked) {
            document.getElementById('delAdd').textContent = "";
            document.getElementById('delAdd').disabled = true;
        } else {
            document.getElementById('delAdd').disabled = false;
        } 
    }
</script>

<div class="container">
    <h2 style="text-align:center;">Order Information</h2><br />

    <div class="row">
        
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">Order Information</div>
                <div class="panel-body" style="height:375px;">
                    
                    <table>
                        <tr>
                            <td>Customer ID:</td>
                            <td>{{session('id')}}</td>
                        </tr>

                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <td>Order type:</td>
                            <td>{{$orderInfo['type']}}</td>
                        </tr>

                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <td>Pickup/Delivery Address:</td>
                            <td>{{$orderInfo['deliveryAdd']}}</td>
                        </tr>

                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <td>Pickup/Delivery Date Time:</td>
                            <td>{{$orderInfo['pdDateTime']}}</td>
                        </tr>                   
                    </table>
                    <br/><br/><br/><br/><br/><br/><br/><br/>

                    <div class="col-md-12" style="text-align:center;">
                        <form action="editOrderConfirmation" method="GET">
                            @csrf
                            <button class="btn btn-primary" type="submit" 
                            @if(Session::get('isEditable') == true) disabled @endif>Edit</button>
                        </form> 
                    </div>

                </div>                  
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">Edit Order Information</div>
                <div class="panel-body">
                
                    <form action="storeOrderInfo" method="POST">
                        @csrf
                        <table>
                            <tr>
                                <td>Customer ID:</td>
                                <td>{{session('id')}}</td>
                            </tr>

                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                    
                            <tr>
                                <td>Order Type:</td>
                                <td>
                                    <input type="radio" id="pickup" name="type" value="Pickup" onclick="pdType()"
                                    @if($orderInfo['type'] == 'Pickup') checked @endif
                                    @if(Session::get('isEditable') == false) disabled @endif/> Pickup
                                    &emsp;&emsp;
                                    <input type="radio" id="delivery" name="type" value="Delivery" onclick="pdType()"
                                    @if($orderInfo['type'] == 'Delivery') checked @endif
                                    @if(Session::get('isEditable') == false) disabled @endif/> Delivery
                                </td> 
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                    
                            <tr>
                                <td>Delivery Address:</td>
                                <td>
                                    <textarea id="delAdd" name="delAdd" rows="5" cols="30" 
                                    @if(Session::get('isEditable') == false || ($orderInfo['type'] == 'Pickup')) disabled @endif required/>{{$orderInfo['deliveryAdd']}}</textarea>
                                </td>
                            </tr>

                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                    
                            <tr>
                                <td>Pickup/Delivery Date:</td>
                                <td><input type="date" name="pdDate" value="{{substr($orderInfo['pdDateTime'], 0, 10)}}" 
                                    @if(Session::get('isEditable') == false) disabled @endif required/>
                                    <input type="time" name="pdTime" min="08:00" max="20:00" step="900" value="{{substr($orderInfo['pdDateTime'], 11, -3)}}" 
                                    @if(Session::get('isEditable') == false) disabled @endif required/><span class="validity"></span>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>(Opening hours 8am to 8pm)</td>
                            </tr>         
                        </table>
                        <br /><br />

                        <div class="col-md-12" style="text-align:center;">
                            <button class="btn btn-success" type="submit"
                            @if(Session::get('isEditable') == false) disabled @endif>Update</button>
                        </div>

                    </form> 
                </div>
            </div>
        </div> 

        <div class="col-md-12" style="text-align:center;">
            <br/>
            <form action="storeOrder" method="POST">
                @csrf
                <button class="btn btn-primary" type="submit" 
                @if(Session::get('isEditable') == true) disabled @endif>Confirm</button>
            </form>
        </div>

    </div>
</div>

@endsection