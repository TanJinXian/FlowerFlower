@extends('layouts.app')

@section('content')


<h2>Add New Product</h2><br/>
@if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
@endif
    <form method="post" action="{{Route('CreateProduct')}}">
      @csrf
      <p>
        <label for="type">Product Type:</label>
        <select name="type">
            <option value="Flower">Flower</option>
            <option value="bonquets">Bonquets</option>
            <option value="floralArrangements">Floral Arrangements</option>
        </select>
      </p>
      <p>
        <label for="name">Product Name:</label>
        <input type="text" name="name">  
      </p>
      <p>
        <label for="desc">Product desc:</label>
        <input type="text" name="desc">  
      </p>
      <p>
        <label for="price">Product price:</label>
        <input type="text" name="price">  
      </p>
      <p>
      
        <label for="promo">Product season Promotion:</label>
        <select name = "promo">
        <?php
            $month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            for ($x = 0; $x < count($month); $x++) {
                echo " <option value=" . $month[$x] . ">" . $month[$x] . "</option>";
            }
        ?>
        </select>
      </p>
      <p>
        <button type="submit" class="btn btn-primary">Submit</button>
      </p>
      
    <button><a href="{{Route('showPartA')}}" class="btn">back</a></button>
    </form>
    
@endsection