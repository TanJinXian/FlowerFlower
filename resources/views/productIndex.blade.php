@extends('layouts.app')

@section('content')

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
                        @foreach($product as $products)
                        <tr>
                                          <td>{{$products->id}}</td>
                                          <td>{{$products->type}}</td>
                                          <td>{{$products->name}}</td>
                                          <td>{{$products->desc}}</td>
                                          <td>{{$products->status}}</td>
                                          <td>{{$products->price}}</td>
                                          <?php
                                          $date=$products->seasonPromo;
                                          $dt = new Datetime($date);
                                          $date = $dt->format('F');
                                          //echo "<td>{{"."$date"."}}</td>";
                                          ?>
                                          <td>{{$date}}</td>
        <td><a href="{{action('productControl@edit', $products->id)}}" class="btn btn-warning">Edit</a></td>
        <td>
        <form action="{{action('productControl@destroy', $products->id)}}" 
                    method="post">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
        </td>
                        </tr>
                        @endforeach
                        
                        </tbody>
                  
    </table>
    <a href="{{Route('showPartA')}}" class="btn btn-info">Back</a>
    @endsection