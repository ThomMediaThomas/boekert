@extends('layouts.app')
@section('content')
    <h2>Alle klanten <a href="{{url('customers/create')}}" title="Nieuwe klant maken" class="btn-floating btn-large"><i class="material-icons">add</i></a></h2>
    <table class="striped higlight sortable" id="bookings-table">
        <thead>
            <tr>
                <th># <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>voornaam <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>achternaam <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>e-mail <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>straat <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>huisnummer <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>postcode <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>stad <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>land <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>aangemaakt op <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->firstname }}</td>
                    <td>{{ $customer->lastname }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->street }}</td>
                    <td>{{ $customer->housenumber }}</td>
                    <td>{{ $customer->zip }}</td>
                    <td>{{ $customer->city }}</td>
                    <td>{{ $customer->country }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td class="action-cell">
                        <a class="btn-floating small"  href="{{ url("/customers/{$customer->id}/edit") }}" title="Klant bewerken">
                            <i class="material-icons">create</i>
                        </a>
                    </td>
                    <td class="action-cell">
                        <form action="{{ url("/customers/{$customer->id}") }}" method="POST">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn-floating small red"><i class="material-icons">delete</i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
