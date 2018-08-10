@extends('layouts.app')

@section('content')
<h2>Creating catalog</h2>
<p>Selected year :"{{$year}}"</p>
<p>Selected month:"{{$month}}"</p>
<p>Please de-select the product do not wish to add to this month catalog</p>
<form method="post" action ="{{action('catalogControl@createMulti')}}">
{{csrf_field()}}
<input type="hidden" name="year" value="<?=$year;?>" />
<input type="hidden" name="month" value="<?=$month;?>" />
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
                                          <?php
                                          
                                          echo "<td><input type='checkbox' name='checkproduct$i' value='$products->id' checked></td>";
                                          $i=((int)$i+1);
                                          ?>
                        </tr>
                        @endforeach
                        
                        </tbody>
                  
    </table>
    <button type="submit">Submit</button><br/>
    
    <button><a href="{{Route('showPartA')}}" class="btn">back</a></button>
</form>

    


@endsection