@extends('layouts.app')

@section('content')
@component('components.reportHeader', ['title' => 'Invoice Detail'])
@endcomponent
<div class="card-body">
    <form method="POST" action="{{route('manager.storeInvoice')}}">
        {{csrf_field()}}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Content</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th></th>

                </tr>
            </thead>

            <tbody>
                <?php
                $x=0;
                ?>
                @foreach($invoice as $invoices)
                <tr>
                    <?php
                    
                    echo "<td><input type='text' name='orderID$x' value='$invoices->id' readonly=''></td>";
                    echo "<td><input type=‘text’ name='content$x' value='$invoices->pdDateTime' readonly=''></td>";
                    echo "<td><input type=‘text’ name='amount$x' value='$invoices->totalPayment' readonly=''></td>";
                    echo "<td><input type=‘text’ name='status$x' value='$invoices->status' readonly=''></td>";
                    $x=$x+1;
                    ?>
                    
                    
                </tr>
                @endforeach
            <?php
                    echo "<input type='hidden' name='timing' value='$x' />";
                    
                    ?>
                <tr><td><td><button type="submit" name="submit">Store</button></td></td></tr>
            </tbody>
        </table>
    </form>
</div>
@endsection
