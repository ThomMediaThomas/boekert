@extends('layouts.app')
@section('content')
    <h2>{{ $booking->boekert_id }} bewerken</h2>
    <form method="POST" action="{{ url("/bookings/{$booking->id}") }}" id="create-booking">
        <input name="_method" type="hidden" value="PUT">
        {{ csrf_field() }}
        <div class="card">
            <div class="card-content">
                <span class="card-title">Gegevens over boeking</span>
                <div class="row">
                    <div class="input-field col s6">
                        <label for="date_from">Datum van</label>
                        <input id="date_from" type="text" class="datepicker {{ $errors->has('date_from') ? ' invalid' : '' }}" name="date_from" value="{{ $booking->date_from }}" required>
                    </div>
                    <div class="input-field col s6">
                        <label for="date_to">Datum tot</label>
                        <input id="date_to" type="text" class="datepicker {{ $errors->has('date_to') ? ' invalid' : '' }}" name="date_to" value="{{ $booking->date_to }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select id="type" class="{{ $errors->has('type') ? ' invalid' : '' }}" name="type" value="{{ $booking->type }}" required>
                            <option value="chalet" <?php if ($booking->type == 'chalet'): ?>selected<?php endif; ?>>Huisje huren</option>
                            <option value="camping" <?php if ($booking->type == 'camping'): ?>selected<?php endif; ?>>Kampeerplaats huren</option>
                        </select>
                        <label for="type">Type</label>
                    </div>
                    <div class="input-field show-on-change-type col s6" id="show-for-chalet">
                        <select id="chalet_type" class="{{ $errors->has('chalet_type') ? ' invalid' : '' }}" name="chalet_type" value="{{ $booking->chalet_type }}">
                            <option value="chalet-4" <?php if ($booking->chalet_type == 'chalet-4'): ?>selected<?php endif; ?>>4-persoonshuisje</option>
                            <option value="chalet-6" <?php if ($booking->chalet_type == 'chalet-6'): ?>selected<?php endif; ?>>6-persoonshuisje</option>
                        </select>
                        <label for="type">Type huisje</label>
                    </div>
                    <div class="input-field show-on-change-type col s6" id="show-for-camping" style="display: none;">
                        <select id="camping_type" class="{{ $errors->has('camping_type') ? ' invalid' : '' }}" name="camping_type" value="{{ $booking->camping_type }}">
                            <option value="tent" <?php if ($booking->camping_type == 'tent'): ?>selected<?php endif; ?>>Tent</option>
                            <option value="folding_car" <?php if ($booking->camping_type == 'folding_car'): ?>selected<?php endif; ?>>Vouwwagen</option>
                            <option value="camper" <?php if ($booking->camping_type == 'camper'): ?>selected<?php endif; ?>>Camper</option>
                            <option value="caravan" <?php if ($booking->camping_type == 'caravan'): ?>selected<?php endif; ?>>Caravan</option>
                            <option value="other" <?php if ($booking->camping_type == 'other'): ?>selected<?php endif; ?>>Andes...</option>
                        </select>
                        <label for="type">Type huisje</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <span class="card-title">Personalia</span>
                @if (isset($booking->customer))
                    <div class="card green half">
                        <div class="card-content white-text">
                            <span class="card-title">{{ $booking->customer->firstname }} {{ $booking->customer->lastname }}</span>
                            <span>{{ $booking->customer->street }} {{ $booking->customer->housenumber }}</span><br />
                            <span>{{ $booking->customer->zipt }} {{ $booking->customer->city }} ({{ $booking->customer->country }})</span>
                        </div>
                        <div class="card-action">
                            <a href="{{ url("/customers/{$booking->customer->id}/edit") }}" title="Klant bewerken">Klant bewerken</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <input type="submit" class="btn">
    </form>
@stop
