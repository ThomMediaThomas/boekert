@extends('layouts.app')
@section('content')
    <h2>Alle boekingen <a href="{{url('bookings/create')}}" title="Nieuwe boeking maken" class="btn-floating btn-large"><i class="material-icons">add</i></a></h2>


    <table class="striped higlight" id="bookings-table">
        <thead>
            <tr>
                <th>#</th>
                <th>van</th>
                <th>tot</th>
                <th>klant</th>
                <th>type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->boekert_id }}</td>
                    <td>{{ $booking->date_from }}</td>
                    <td>{{ $booking->date_to }}</td>
                    <td>
                        <strong>
                            <a title="Stuur {{ $booking->customer->firstname }} een e-mail" href="mailto:{{ $booking->customer->email }}">
                                {{ $booking->customer->firstname }} {{ $booking->customer->lastname }}
                            </a>
                        </strong><br />
                        <span>{{ $booking->customer->street }} {{ $booking->customer->housenumber }}</span><br />
                        <span>{{ $booking->customer->zipt }} {{ $booking->customer->city }} ({{ $booking->customer->country }})</span>
                    </td>
                    <td><strong>{{ $booking->type }}</strong> | {{ $booking->camping_type }}{{ $booking->chalet_type }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
