@extends('layouts.app')

@section('content')
<?php
$month = date("FY",strtotime($id));
?>
<h2>Selected Catalog is for {{$month}}</h2>
<?php
//selectedProduct
?>

<a href="{{action('catalogControl@show', $id)}}" class="btn btn-warning">Show all</a>
<a href="{{Route('ShowPromotion',$id)}}" class="btn btn-warning">Show Promo only</a>
<a href="{{Route('ShowFlower',$id)}}" class="btn btn-warning">Show Flower only</a>
<a href="{{Route('ShowBonquet',$id)}}" class="btn btn-warning">Show Bonquet only</a>
<a href="{{Route('ShowFloral',$id)}}" class="btn btn-warning">Show Floral Arrangement only</a>

    <table class="table table-striped"  > 
        <thead>

            <tr>

                <th>ID</th>
                <th>Type</th>
                        <th>name</th>
                        <th>desc</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>SeasonPromotion</th>        

                        </tr>

                        <thead>

                        <tbody>
                        <?php
                        $i=0;
                        ?>
                        @foreach($selectedProduct as $selectedProducts)
                        <tr>
                                          <td>{{$selectedProducts->id}}</td>
                                          <td>{{$selectedProducts->type}}</td>
                                          <td>{{$selectedProducts->name}}</td>
                                          <td>{{$selectedProducts->desc}}</td>
                                          <td>{{$selectedProducts->status}}</td>
                                          <td>{{$selectedProducts->price}}</td>
                                          <?php
                                          $date=$selectedProducts->seasonPromo;
                                          $dt = new Datetime($date);
                                          $date = $dt->format('F');
                                          $compare=date('F');
                                          if($compare==$date){
                                              $date="!!!PROMOTING!!!";
                                          }
                                          //echo "<td>{{"."$date"."}}</td>";
                                          ?>
                                          <td>{{$date}}</td>
                                          <?php
                                          
                                          
                                          $i=((int)$i+1);
                                          ?>
                        </tr>
                        @endforeach
                        
                        </tbody>
                  
    </table>

    @if($i==0)
        <p><h1>There have no item now</h1></p>
    @endif
    <a href="{{ URL::previous() }}" class="btn btn-warning">Back</a>
@endsection