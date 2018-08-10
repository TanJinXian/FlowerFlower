@extends('layouts.app')

@section('content')
    @component('components.reportHeader', ['title' => 'Pick Consumer'])
    @endcomponent
    <div class="card-body">
        <form class="form-horizontal" action="{{route('manager.updateCredit')}}" method="POST">
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
                <td>Set Credit Limit:</td>
                <td><input type="text" name="creditLimit"/></td>
                <td><button type="submit" name="submit">Enter</button></td>
                </tr>
               
            </tbody>
        </table>
        </form>
        </div>
@endsection
