@extends('layouts.app')

@section('content')
<?php
//this is for product function, here have mentioned how to access to each file
?>
<a href="{{Route('creatingProduct')}}" class="btn btn-info">Create product</a>
<a href="{{Route('allProduct')}}" class="btn btn-info">show and edit and delete product</a>


<?php
//this is for catalog function, here have mentioned how to access to each file
?>
<br/>
<br/>
<br/>
<a href="{{Route('prepareCatalog')}}" class="btn btn-info">Create Catalog</a>
<a href="{{Route('showAllCatalog')}}" class="btn btn-info">Show and edit catalog</a>
<?php
//this is for xml generation function, here have mentioned how to access to each file
?>
<br/>
<br/>
<a href="{{Route('createXML')}}" class="btn btn-info">Create XML</a>

@endsection