@extends('layouts.app')

@section('content')
<?php
$month = date("FY",strtotime($id));
?>
<h2>Selected Catalog is for {{$month}}</h2>
<?php
//selectedProduct
?>
<form method="post" action ="{{Route('updateMonth')}}">
{{csrf_field()}}
<input type="hidden" name="year" value="<?=$id;?>" />
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
                        <?php
                        $checking=false;
                        ?>
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
                                          @foreach($selectedProduct as $selectedProducts)
                                          <?php
                                          if($selectedProducts->id==$products->id){
                                            echo "<td><input type='checkbox' name='checkproduct$i' value='$products->id' checked></td>";
                                            $i=((int)$i+1);
                                            $checking=true;
                                          }
                                          ?>
                                          @endforeach
                                          <?php
                                          if($checking==false){
                                            echo "<td><input type='checkbox' name='checkproduct$i' value='$products->id'></td>";
                                            $i=((int)$i+1);
                                          }
                                          ?>
                        </tr>
                        @endforeach
                        
        </tbody>
                  
    </table>
    <button type="submit" class="btn btn-warning" float="left">Submit</button>
    <a href="{{action('catalogControl@index')}}" class="btn btn-warning" float="left">Back</a>
</form>

@endsection