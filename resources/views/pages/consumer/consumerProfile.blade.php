@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
            
        <form class="form-horizontal" action="{{route('update.profile',session('id'))}}" method="POST">
            {{csrf_field()}}
           
                <fieldset>
                    <legend>Customer Profile</legend>
                    
                    
                    <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="custName" name="custName" value="{{$consumers->custName}}">
                    </div>

                    <div class="form-group">
                            <label for="">IC Number</label>
                            <input type="text" class="form-control" id="custIC" name="custIC" value="{{$consumers->custIC}}">
                    </div>

                    
                    <fieldset class="form-group">
                            <legend>Gender</legend>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="text" class="form-control" id="custGender" name="custGender" value="{{$consumers->custGender}}">
                            </div>
                    </fieldset>

                    <div class="form-group">
                            <label for="">Dob</label>
                            <input type="text" class="form-control" id="date" name="custDob" value="{{$consumers->custDob}}">
                    </div>

                    <div class="form-group">
                            <label for="">Address</label>
                            <textarea class="form-control" id="address"  name="address" rows="3" name="address">{{$consumers->address}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="{{$consumers->email}}">
                    </div>

                    
                    <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="ContactNo" value="{{$consumers->ContactNo}}">
                    </div>
                    <div class="form-group">
                            <label for="">Company Name</label>
                            <input type="text" class="form-control" id="companyName" name="companyName" value="{{$consumers->companyName}}">
                    </div>

                    
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="{{$consumers->password}}">
                    </div>

                    

                    <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-control" id="exampleSelect1" name='status' value="{{$consumers->status}}">
                                <option>Customer</option>
                                <option>Cooperation-Consumer</option>
                            </select>
                    </div>
                   

                    <button type="submit" class="btn btn-primary btn-block">SignUp</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<!-- jquery -->
<script type="text/javascript" src="jquery-ui/external/jquery/jquery.js"></script>
<!-- jquery ui -->
<script type="text/javascript" src="jquery-ui/jquery-ui.min.js"></script>

<script type="text/javascript">
    $("#date").datepicker();
</script>

@endsection