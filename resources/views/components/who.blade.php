@if(Auth::user()->position == 'Manager')
    <a href="{{route('manager.dailyReport')}}"><button type="button">Daily Order Received Report</button></a>

    <a href="{{route('manager.dailyPickupReport')}}"><button type="button">Daily Pickup Report</button></a>

    <a href="{{route('manager.dailyDeliveryReport')}}"><button type="button">Daily Delivery Report</button></a>

    <a href="{{route('manager.dailyReport')}}"><button type="button">Register New Staff</button></a>
@endif

@if(Auth::user()->position == 'Sale Man')
    
@endif

@if(Auth::user()->position == 'Delivery Man')
    
@endif