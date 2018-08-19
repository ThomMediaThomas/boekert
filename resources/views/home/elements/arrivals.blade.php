<div class="card small green">
    <div class="card-content white-text">
        <span class="card-title"><i class="material-icons">mood</i> Wie komt er aan vandaag?</span>
        <table class="compact">
            <thead>
            <th>#</th>
            <th>van</th>
            <th>tot</th>
            <th>klant</th>
            </thead>
            <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>
                        <a class="white-text" href="{{ url("/bookings/{$booking->id}/edit") }}"
                           title="Boeking bewerken">{{ $booking->boekert_id }}</a>
                    </td>
                    <td>{{ $booking->date_from }}</td>
                    <td>{{ $booking->date_to }}</td>
                    <td>
                        @if (isset($booking->customer))
                            <a class="white-text" title="Klantgegevens"
                               href="{{ url("/customers/{$booking->customer->id}/edit") }}">
                                {{ $booking->customer->firstname }} {{ $booking->customer->lastname }}
                                ({{ $booking->customer->country }})
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
