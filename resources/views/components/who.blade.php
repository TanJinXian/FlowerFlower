<!--/*
    Subject: BAIT3173 Integrative Programming
    Author: Tan Jin Xian RSD3 G7 17WMR09511
*/-->

@if(Auth::user()->position == 'Manager')

    <a href="{{route('manager.dailyReport',"saleReport")}}"><button type="button">Daily Order Received Report</button></a>
    <a href="{{route('manager.dailyPickupReport',"pickupReport")}}"><button type="button">Daily Pickup Report</button></a>
    <a href="{{route('manager.dailyDeliveryReport',"deliveryReport")}}"><button type="button">Daily Delivery Report</button></a>
    <a href="{{route('authenticationView.staffRegister')}}"><button type="button">Register New Staff</button></a>
    <a href="{{route('showPartA')}}"><button type="button">Product and Catalog Management</button></a>
    <a href="{{route('manager.CooperateConsumer')}}"><button type="button">Cooperate Consumer Invoice</button></a>
    <a href="{{route('manager.chooseConsumer')}}"><button type="button">Consumer Credit Limit</button></a>
@endif

@if(Auth::user()->position == 'Sale Preson')
    <a href="{{route('staff.payment.pickup')}}"><button type="button">Payment for customer</button></a>
@endif

@if(Auth::user()->position == 'Delivery Man')
    <a href="{{route('staff.payment.delivery')}}"><button type="button">Payment for customer</button></a>
@endif
