@extends('layouts.app')
@section('content')
    <h2>Alle klanten <a href="{{url('customers/create')}}" title="Nieuwe klant maken" class="btn-floating btn-large"><i class="material-icons">add</i></a></h2>


    <table class="striped higlight" id="bookings-table">
        <thead>
            <tr>
                <th>#</th>
                <th>voornaam</th>
                <th>achternaam</th>
                <th>e-mail</th>
                <th>straat</th>
                <th>huisnummer</th>
                <th>postcode</th>
                <th>stad</th>
                <th>land</th>
                <th>aangemaakt op</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
