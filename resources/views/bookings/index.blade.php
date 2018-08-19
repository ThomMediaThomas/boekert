@extends('layouts.app')
@section('content')
    <h4>Alle boekingen <a href="{{url('bookings/create')}}" title="Nieuwe boeking maken" class="btn-floating btn-large"><i class="material-icons">add</i></a></h4>
    <table class="striped higlight sortable compact" id="bookings-table">
        <thead>
            <tr>
                <th># <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>van <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>tot <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>klant <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>toegewezen <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>
                        <a href="{{ url("/bookings/{$booking->id}/edit") }}" title="Boeking bewerken">{{ $booking->boekert_id }}</a>
                        <span class="badge type type-{{ $booking->type }} subtype-{{ $booking->camping_type }}{{ $booking->chalet_type }}">
                            <strong>{{ $booking->type }}</strong> | {{ $booking->camping_type }}{{ $booking->chalet_type }}
                        </span>
                    </td>
                    <td>{{ $booking->date_from }}</td>
                    <td>{{ $booking->date_to }}</td>
                    <td>
                        @if (isset($booking->customer))
                            <a title="Klantgegevens" href="{{ url("/customers/{$booking->customer->id}/edit") }}">
                                {{ $booking->customer->firstname }} {{ $booking->customer->lastname }} ({{ $booking->customer->country }})
                            </a>
                        @endif
                    </td>
                    <td>
                        @if (isset($booking->accommodation))
                            {{ $booking->accommodation->name }} / {{ $booking->accommodation->field_number }}
                        @endif
                    </td>
                    <td class="action-cell">
                        <a class="btn-floating small" href="{{ url("/bookings/{$booking->id}/edit") }}" title="Boeking bewerken">
                            <i class="material-icons">create</i>
                        </a>
                    </td>
                    <td class="action-cell">
                        <form action="{{ url("/bookings/{$booking->id}") }}" method="POST">
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
