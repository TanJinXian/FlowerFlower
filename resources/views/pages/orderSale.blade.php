@extends('layouts.app')

@section('content')

@if (\Session::has('successOrder'))
  <div class="alert alert-success">
    <p>{{ \Session::get('successOrder') }}</p>
  </div><br />
@endif 

<br/><br/>
<div class="container">
    <div class="row">
        <div class="col-md-12" style="text-align:center">
            <button class="btn btn-success" type="submit" onclick="window.location='http://localhost/FlowerFlower/storage/app/order.xml'">Sales Order</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" style="text-align:center">
            <button class="btn btn-default" type="submit" onclick="window.location='{{url('order')}}'">Back</button>
        </div>
    </div>
</div>

@endsection