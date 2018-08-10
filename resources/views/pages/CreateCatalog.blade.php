
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
        @if(Session::has('failed'))
        <div class="alert alert-success">
            <p>{{ Session::get('failed') }}</p>
        </div><br />
        @endif
            <form method="post" action ="{{action('productControl@showall')}}">
            
                {{csrf_field()}}
                <fieldset>
                    <legend>Creating Catalog</legend>
                    <p>Please select year and Month</p>
                    
                        <?php
                        $currentYear = (string)date('Y');
                        echo "<label>Please select a year</label><select name="."year"." id="."year".">";
                        for ($y = 0; $y < 4; $y++) {
                            echo " <option value=" . $currentYear . ">" . $currentYear . "</option>";
                            $currentYear = (string)((int)$currentYear+1);
                        }
                        echo "</select>";
                        echo "<label>\tPlease select a month</label><select name="."month"." id="."month".">";
                        $month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                        $currentMonth = (string) date('F');
                        echo date('F');
                        $checking = false;
                        /*
                        for ($x = 0; $x < count($month); $x++) {
                            if ($currentMonth == $month[$x])
                                $checking = true;
                            if ($checking == true)
                                echo " <option value=" . $month[$x] . ">" . $month[$x] . "</option>";
                        }
                        */
                        for ($x = 0; $x < count($month); $x++) {
                            echo " <option value=" . $month[$x] . ">" . $month[$x] . "</option>";
                        }
                        
                                        /*
                                        $productCont = new productControl();
                        $products = productCont.show();
                                        @foreach($products as $product)
                                          <tr>
                                          <td>{{$product['type']}}</td>
                                          <td>{{$product['name']}}</td>
                                          <td>{{$product['desc']}}</td>
                                          <td>{{$product['status']}}</td>
                                          <td>{{$product['price']}}</td>
                                          <td>{{$product['SeasonPromotion']}}</td>
                                          </tr>
                                          
                                        */   
                        echo "</select>";
                        ?>
                        <button type="submit">Submit</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>

@endsection