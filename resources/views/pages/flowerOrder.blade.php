{{-- Tan Yi Ying --}}

@extends('layouts.app')

@section('content')


@if (\Session::has('success'))
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
        @php $type = "freshFlower"; @endphp
    </div><br />
@endif

<div class="container" style="padding-top:50px">
    <h2 style="text-align:center">Flower Order</h2><br />

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li @if($type == "freshFlower") class="active" @endif><a href="#tabFreshFlower" data-toggle="tab">Fresh Flower</a></li>
                        <li @if($type == "bouquet") class="active" @endif><a href="#tabBouquet" data-toggle="tab">Bouquet</a></li>
                        <li @if($type == "floralArr") class="active" @endif><a href="#tabFloralArr" data-toggle="tab">Floral Arrangement</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">

                        <div @if($type == "freshFlower") class="tab-pane fade in active" @else class="tab-pane fade" @endif id="tabFreshFlower">
                            <form method="POST" action="{{url('flowerOrder')}}">
                                @csrf
                                <table>
                                    <tr>
                                        <td>Flower: </td>
                                        <td>
                                            <select name="productID">
                                                @foreach($productsFreshFlower as $product)
                                                    <option value="{{$product['id']}}"> P{{$product['id']}} - {{$product['name']}}
                                                    @php
                                                        $currentTime = Carbon\Carbon::now();
                                                        $currentTime->toDateTimeString();
                                                        $currentMonth = substr($currentTime, 5, 2);

                                                        $promoTime = $product['seasonPromo'];
                                                        $promotionMonth = substr($promoTime, 5, 2);
                                                    
                                                        if($currentMonth == $promotionMonth) 
                                                            echo "(Promotion)" ; 
                                                    @endphp
                                                    </option>                                           
                                                @endforeach
                                            </select>   
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                            
                                    <tr>
                                        <td>Quantity: </td>
                                        <td>
                                            <input type="number" name="quantity" min="1" max="999" value="1">
                                        </td>
                                    </tr>
                                </table>
                                <br/><br/>

                                <button class="btn btn-danger" type="button" name="back" onclick="window.location='{{url('order')}}'">Back</button>&emsp;&emsp;
                                <button class="btn btn-success" type="submit" name="addToCart">Add to Cart</button>&emsp;&emsp;
                                <button class="btn btn-primary" type="button" name="back" onclick="window.location='{{url('orderDetails')}}'">Carts</button>&emsp;&emsp;
                                <button class="glyphicon glyphicon-shopping-cart" type="button" name="back" onclick="window.location='{{url('orderDetails')}}'" style="font-size:25px;color:white;background-color:blue;border-color:blue"></button>
                            </form>
                        </div>

                        <div @if($type == "bouquet") class="tab-pane fade in active" @else class="tab-pane fade" @endif id="tabBouquet">
                            <form method="POST" action="{{url('flowerOrder')}}">
                                @csrf
                                <table>
                                    <tr>
                                        <td>Bouquet: </td>
                                        <td>
                                            <select name="productID">
                                                @foreach($productsBouquet as $product)
                                                    <option value="{{$product['id']}}">P{{$product['id']}} - {{$product['name']}}
                                                    @php
                                                        $mytime = Carbon\Carbon::now();
                                                        $mytime->toDateTimeString();
                                                        $currentMonth = substr($mytime, 5, 2);

                                                        $promoTime = $product['seasonPromo'];
                                                        $promotionMonth = substr($promoTime, 5, 2);
                                                    
                                                        if($currentMonth == $promotionMonth) 
                                                            echo "(Promotion)" ; 
                                                    @endphp
                                                    </option>
                                                @endforeach
                                            </select>   
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                            
                                    <tr>
                                        <td>Quantity:</td>
                                        <td>
                                            <input type="number" name="quantity" min="1" max="999" value="1">
                                        </td>
                                    </tr>

                                </table>
                                <br/><br/>

                                <button class="btn btn-danger" type="button" name="back" onclick="window.location='{{url('order')}}'">Back</button>&emsp;&emsp; 
                                <button class="btn btn-success" type="submit" name="addToCart">Add to Cart</button>&emsp;&emsp;
                                <button class="btn btn-primary" type="button" name="back" onclick="window.location='{{url('orderDetails')}}'">Carts</button>
                            </form>
                        </div>

                        <div @if($type == "floralArr") class="tab-pane fade in active" @else class="tab-pane fade" @endif id="tabFloralArr">
                            <form method="POST" action="{{url('flowerOrder')}}">
                                @csrf
                                <table>
                                    <tr>
                                        <td>Flower Arrangement: </td>
                                        <td>
                                            <select name="productID">
                                                @foreach($productsFloralArr as $product)
                                                    <option value="{{$product['id']}}">P{{$product['id']}} - {{$product['name']}}
                                                    @php
                                                        $mytime = Carbon\Carbon::now();
                                                        $mytime->toDateTimeString();
                                                        $currentMonth = substr($mytime, 5, 2);

                                                        $promoTime = $product['seasonPromo'];
                                                        $promotionMonth = substr($promoTime, 5, 2);
                                                    
                                                        if($currentMonth == $promotionMonth) 
                                                            echo "(Promotion)" ; 
                                                    @endphp
                                                    </option>
                                                @endforeach
                                            </select>   
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                            
                                    <tr>
                                        <td>Quantity:</td>
                                        <td>
                                            <input type="number" name="quantity" min="1" max="999" value="1">
                                        </td>
                                    </tr>

                                </table>
                                <br/><br/>

                                <button class="btn btn-danger" type="button" name="back" onclick="window.location='{{url('order')}}'">Back</button>&emsp;&emsp; 
                                <button class="btn btn-success" type="submit" name="addToCart">Add to Cart</button>&emsp;&emsp;
                                <button class="btn btn-primary" type="button" name="back" onclick="window.location='{{url('orderDetails')}}'">Carts</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
       
@endsection

