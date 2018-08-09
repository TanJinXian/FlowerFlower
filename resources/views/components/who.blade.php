<!--/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/-->

@if(Auth::user()->position == 'Manager')

    <a href="{{route('manager.dailyReport')}}"><button type="button">Daily Order Received Report</button></a>
    <a href="{{route('manager.dailyPickupReport')}}"><button type="button">Daily Pickup Report</button></a>
    <a href="{{route('manager.dailyDeliveryReport')}}"><button type="button">Daily Delivery Report</button></a>
    <a href="{{route('authenticationView.staffRegister')}}"><button type="button">Register New Staff</button></a>
@endif

@if(Auth::user()->position == 'Sale Preson')
    <a href="{{route('staff.payment.pickup')}}"><button type="button">Payment for customer</button></a>
@endif

@if(Auth::user()->position == 'Delivery Man')
    <a href="{{route('staff.payment.delivery')}}"><button type="button">Payment for customer</button></a>
@endif
