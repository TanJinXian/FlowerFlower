{{-- Tan Yi Ying --}}

@extends('layouts.app')

@section('content')

<div class="container">

    <div class="col-md-6 col-md-offset-3" style="padding-top:50px">

        <h2 style="text-align:center;">Order Information</h2><br />

        <script>
            function pdType() {
                if(document.getElementById('pickup').checked)
                    document.getElementById('delAdd').disabled = true;
                 else
                    document.getElementById('delAdd').disabled = false;
            }
        </script>

            <form action="storeOrderInfo" method="POST">
                @csrf
                <div class="panel panel-primary">
                    <div class="panel-body">
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
                                    <input type="radio" id="pickup" name="type" value="Pickup" checked onclick="pdType()"/>
                                    <label for="pickup">Pickup</label>
                                    &emsp;&emsp;
                                    <input type="radio" id="delivery" name="type" value="Delivery" onclick="pdType()"/>
                                    <label for="delivery">Delivery</label>
                                </td>
                            </tr>

                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>        

                            <tr>
                                <td>Delivery Address:</td>
                                <td><textarea id="delAdd" name="delAdd" rows="6" cols="33" required disabled></textarea></td>
                            </tr>

                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                            <tr>
                                <td>Pickup/Delivery Date:</td>
                                <td>
                                    @php
                                        $currentTime = Carbon\Carbon::now();
                                        $currentTime->toDateTimeString();
                                        $currentDate = substr($currentTime, 0, 10);
                                    @endphp
                                    <input type="date" name="pdDate" min="{{$currentDate}}" required/>
                                    <input type="time" name="pdTime" min="08:00" max="20:00" step="900" required/><span class="validity"></span>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>(Opening hours 8am to 8pm)</td>
                            </tr>

                        </table>
                    </div>
                </div>

                <div class="col-md-6" style="text-align:center">
                    <button class="btn btn-danger" type="button" onclick="location.href='{{url('order')}}'">Back</button>                   
                </div>  

                <div class="col-md-6" style="text-align:center">
                    <button class="btn btn-primary" type="submit">Proceed</button>  
                </div>
            </form>
            
    </div>    
</div>    
@endsection