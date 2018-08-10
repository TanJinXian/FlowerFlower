@extends('layouts.app')

@section('content')


<h2>Edit Product Details</h2><br  />
      <form method="post" action="{{Route('updating',$id)}}">
      <input type="hidden" name="id" value="<?=$id;?>" />
        @csrf
        <label for="types">Product Type:</label>
        <select name="type"/>
        <?php
            $arrayType = array("Flower","bonquets", "floralArrangements");
            $selectedType = $product->type;
            
            $x=0;
            foreach($arrayType as $arrayTypes){
                if($arrayTypes==$selectedType){
                    echo "<option value =".$arrayTypes." selected=selected>".$arrayTypes."</option>";
                }
                else{
                    echo "<option value =".$arrayTypes.">".$arrayTypes."</option>";
                }
            }
            echo"</select>";
        ?>
      </p>
      <p>
        <label for="name">Product Name:</label>
        <input type="text" name="name" value="{{$product->name}}">  
      </p>
      <p>
        <label for="desc">Product desc:</label>
        <input type="text" name="desc" value="{{$product->desc}}">  
      </p>
      <p>
        <label for="price">Product price:</label>
        <input type="text" name="price" value="{{$product->price}}">  
      </p>
      <p>
      
        <label for="promo">Product season Promotion:</label>
        <select name = "promo">
        <?php
            $selectedMonth = date('F', strtotime($product->seasonPromo));
            $month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            for ($x = 0; $x < count($month); $x++) {
                if($selectedMonth==$month[$x])
                {
                    echo " <option value=" . $month[$x] . " selected=selected>" . $month[$x] . "</option>";
                }
                else{
                    echo " <option value=" . $month[$x] . ">" . $month[$x] . "</option>";
                }
                
            }
        ?>
        </select>
        <br/>
        <label>Status:</label>
        <select name="status">
            <option value ="Available">available</option>
            <option value ="OutOfStock">Out Of Stock</option>
        </select>
        <br/>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button><a href="{{Route('allProduct')}}" class="btn btn-info">back</a></button>
      </form>
@endsection