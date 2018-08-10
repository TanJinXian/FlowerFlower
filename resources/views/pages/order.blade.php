{{-- Tan Yi Ying --}}

@extends('layouts.app')

@section('content')

<div class="container" style="padding-top:50px">
    <h2 style="text-align:center;">Order Types</h2><br/>

    <div class="row">
            
        <form action="orderIndex" method="POST">
            @csrf
            <div class="col-md-4">
                <div class="panel panel-default">  
                    <div class="panel-heading" style="width:100%; padding:0">
                        <input name="freshFlower" type="submit" value="Fresh Flower" class="btn btn-dark" style="width:100%"/>
                    </div>

                    <div class="panel-body" style="width:100%; padding:0">
                        <input name="freshFlower" type="image" value="Fresh Flower" src={{asset('/images/freshFlower.jpg')}} class="img-responsive" alt="Fresh Flower" style="width:100%"/> 
                    </div>
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading" style="width:100%; padding:0">
                        <input name="bouquet" type="submit" value="Bouquet" class="btn btn-dark" style="width:100%"/>
                    </div>

                    <div class="panel-body" style="width:100%; padding:0">
                        <input name="bouquet" type="image" value="Bouquet" src={{asset('/images/bouquet.jpg')}} class="img-responsive" alt="Bouquet" style="width:100%"/> 
                    </div>   
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading" style="width:100%; padding:0">
                        <input name="floralArr" type="submit"  value="Floral Arrangement" class="btn btn-dark" style="width:100%"/>
                    </div>

                    <div class="panel-body" style="width:100%; padding:0">
                        <input name="floralArr" type="image" value="Floral Arrangement" img src={{asset('/images/floralArrangement.jpg')}} class="img-responsive" alt="Floral Arrangement" style="width:100%"/> 
                    </div>
                </div>
            </div>

        </form>
    </div>    
</div>
@endsection

