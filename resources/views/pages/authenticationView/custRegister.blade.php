@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
            @if (session('Status'))
                <p>{{session('Status')}}</p>
            @endif
        <form class="form-horizontal" action="{{route('customer.register.submit')}}" method="POST">
            {{csrf_field()}}
                <fieldset>
                    <legend>Customer Register</legend>
                    
                    <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="custName" name="custName" placeholder="Enter Full Name">
                    </div>

                    <div class="form-group">
                            <label for="">IC Number</label>
                            <input type="text" class="form-control" id="custIC" name="custIC" placeholder="Enter IC Number">
                    </div>

                    
                    <fieldset class="form-group">
                            <legend>Gender</legend>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="custGender" id="optionsRadios1" value="male" checked="">
                                        Male
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="custGender" id="optionsRadios2" value="female">
                                        Female
                                </label>
                            </div>
                    </fieldset>

                    <div class="form-group">
                            <label for="">Dob</label>
                            <input type="text" class="form-control" id="date" name="custDob" placeholder="dd/mm/yyyy">
                    </div>

                    <div class="form-group">
                            <label for="">Address</label>
                            <textarea class="form-control" id="address"  name="address" rows="3" name="address"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>

                    
                    <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="ContactNo" placeholder="Enter Phone Number">
                    </div>
                    <div class="form-group">
                            <label for="">Company Name</label>
                            <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Enter Your Company Name">
                    </div>

                    
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                    </div>

                    <div class="form-group">
                            <label for="exampleInputPassword1">Re-enter Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"  placeholder="Password">
                            <!--name="password_confirmation"-->
                        </div>

                    <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-control" id="exampleSelect1" name='status'>
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