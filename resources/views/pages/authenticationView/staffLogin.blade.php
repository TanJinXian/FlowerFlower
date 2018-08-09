<!--/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/-->

@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-lg-offset-3 col-lg-6">
                
            <form class="form-horizontal" action="{{route('staff.login.submit')}}" method="POST">
                {{csrf_field()}}
                    <fieldset>
                        <legend>Staff Login</legend>
                        
                        <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
    
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection