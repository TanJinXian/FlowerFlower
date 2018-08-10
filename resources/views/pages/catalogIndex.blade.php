@extends('layouts.app')

@section('content')
<h2>List of gerenated Catalog</h2>
<table>
@foreach($catalog as $catalogs)
     <tr>
     <?php
     $month = date("FY",strtotime($catalogs->Month));
     ?>
        <td>{{$month}}</td>
        <td><a href="{{action('catalogControl@show', $catalogs->Month)}}" class="btn btn-warning">View</a></td>
        <td><a href="{{action('catalogControl@edit', $catalogs->Month)}}" class="btn btn-warning">Edit</a></td>
    </tr>
@endforeach
</table>



@endsection