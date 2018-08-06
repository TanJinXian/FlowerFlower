@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    @if(Auth::user()->position == 'Manager')
                        <div class="card-header">Manager Dashboard</div>
                    @elseif(Auth::user()->position == 'Delivery Man')
                        <div class="card-header">Delivery Man Dashboard</div>
                    @else
                        <div class="card-header">Staff Dashboard</div>
                    @endif
                    
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome {{ Auth::user()->name }}!

                    @component('components.who')
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
