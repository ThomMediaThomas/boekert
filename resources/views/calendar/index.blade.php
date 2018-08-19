@extends('layouts.app-full')
@section('content')
    <h2>Kalender ({{$currentMonth}}/{{$currentYear}})</h2>
    <div class="card-panel filter-form">
        <form method="GET" action="{{ url('calendar') }}" id="filter-calendar">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s3">
                    <select id="month" class="{{ $errors->has('month') ? ' invalid' : '' }}" name="month"
                            value="{{ $currentMonth }}">
                        <option value="1" <?php if ($currentMonth == 1): ?>selected<?php endif; ?>>Januari</option>
                        <option value="2" <?php if ($currentMonth == 2): ?>selected<?php endif; ?>>Februari</option>
                        <option value="3" <?php if ($currentMonth == 3): ?>selected<?php endif; ?>>Maart</option>
                        <option value="4" <?php if ($currentMonth == 4): ?>selected<?php endif; ?>>April</option>
                        <option value="5" <?php if ($currentMonth == 5): ?>selected<?php endif; ?>>Mei</option>
                        <option value="6" <?php if ($currentMonth == 6): ?>selected<?php endif; ?>>Juni</option>
                        <option value="7" <?php if ($currentMonth == 7): ?>selected<?php endif; ?>>Juli</option>
                        <option value="8" <?php if ($currentMonth == 8): ?>selected<?php endif; ?>>Augustus</option>
                        <option value="9" <?php if ($currentMonth == 9): ?>selected<?php endif; ?>>September</option>
                        <option value="10" <?php if ($currentMonth == 10): ?>selected<?php endif; ?>>Oktober</option>
                        <option value="11" <?php if ($currentMonth == 11): ?>selected<?php endif; ?>>November</option>
                        <option value="12" <?php if ($currentMonth == 12): ?>selected<?php endif; ?>>December</option>
                    </select>
                    <label for="month">Maand</label>
                </div>
                <div class="input-field col s3">
                    <select id="year" class="{{ $errors->has('year') ? ' invalid' : '' }}" name="year" value="{{ $currentYear }}">
                        @foreach ($availableYears as $availableYear)
                            <option value="{{ $availableYear }}" <?php if ($currentYear == $availableYear): ?>selected<?php endif; ?>>{{ $availableYear }}</option>
                        @endforeach
                    </select>
                    <label for="year">Jaar</label>
                </div>
                <div class="input-field col s3"></div>
                <div class="input-field col s3">
                    <button type="submit" class="btn">Bijwerken</button>
                </div>
            </div>
        </form>
    </div>

    @foreach ($bookings as $booking)
        {{ $booking->date_from }} - {{ $booking->date_to }}<br />
    @endforeach
    <table id="calendar" class="browser-default">
        <thead>
            <th class="accommodation">Accommodatie</th>
            @foreach ($daysInMonth as $day)
                <th class="date">
                    <span>{{ $day['day_short'] }}</span>
                    <strong>{{ $day['date_short'] }}</strong>
                </th>
            @endforeach
        </thead>
        <tbody>
            @foreach ($accommodations as $accommodation)
                <tr>
                    <td class="accommodation">{{ $accommodation->name }}</td>
                    @foreach ($daysInMonth as $day)
                        <td class="date">
                            -
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
