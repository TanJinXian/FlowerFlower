@extends('layouts.app')

@section('content')
    @component('components.reportHeader', ['title' => 'Pick Consumer'])
    @endcomponent
    <div class="card-body">
        <form class="form-horizontal" action="{{route('manager.DisplayInvoice')}}" method="POST">
           {{csrf_field()}}
        <table class="table table-striped">
            <tr>
                <td>
            <label>Select Consumer :</label>
                </td>
                <td>

                    <select name="selectedConsumer">
                @foreach($cooperateConsumer as $cooperateConsumers)
                <option value="{{$cooperateConsumers->id}}">{{$cooperateConsumers->id}}</option>
                
                  @endforeach
                    </select>

                  
                </td>
                <td>Month:</td>
                <td>  
                <select name="month">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    </select>
                    </td>
                <td><button type="submit" name="submit">Select</button></td>
                </tr>
               
            </tbody>
        </table>
        </form>
        </div>
@endsection
