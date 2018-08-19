@extends('layouts.app')
@section('content')
    <h2>{{ $booking->boekert_id }} bewerken</h2>
    <form method="POST" action="{{ url("/bookings/{$booking->id}") }}" id="create-booking">
        <input name="_method" type="hidden" value="PUT">
        {{ csrf_field() }}
        <div class="row">
            <div class="col s8">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Gegevens over boeking</span>
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="date_from">Datum van</label>
                                <input id="date_from" type="text"
                                       class="datepicker {{ $errors->has('date_from') ? ' invalid' : '' }}"
                                       name="date_from" value="{{ $booking->date_from }}" required>
                            </div>
                            <div class="input-field col s6">
                                <label for="date_to">Datum tot</label>
                                <input id="date_to" type="text"
                                       class="datepicker {{ $errors->has('date_to') ? ' invalid' : '' }}" name="date_to"
                                       value="{{ $booking->date_to }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select id="type" class="{{ $errors->has('type') ? ' invalid' : '' }}" name="type"
                                        value="{{ $booking->type }}" required>
                                    <option value="chalet" <?php if ($booking->type == 'chalet'): ?>selected<?php endif; ?>>Huisje huren</option>
                                    <option value="camping" <?php if ($booking->type == 'camping'): ?>selected<?php endif; ?>>Kampeerplaats huren</option>
                                </select>
                                <label for="type">Type</label>
                            </div>
                            <div class="input-field show-on-change-type col s6" id="show-for-chalet">
                                <select id="chalet_type" class="{{ $errors->has('chalet_type') ? ' invalid' : '' }}"
                                        name="chalet_type" value="{{ $booking->chalet_type }}">
                                    <option value="chalet-4" <?php if ($booking->chalet_type == 'chalet-4'): ?>selected<?php endif; ?>>4-persoonshuisje</option>
                                    <option value="chalet-6" <?php if ($booking->chalet_type == 'chalet-6'): ?>selected<?php endif; ?>>6-persoonshuisje</option>
                                </select>
                                <label for="type">Type huisje</label>
                            </div>
                            <div class="input-field show-on-change-type col s6" id="show-for-camping"
                                 style="display: none;">
                                <select id="camping_type" class="{{ $errors->has('camping_type') ? ' invalid' : '' }}" name="camping_type" value="{{ $booking->camping_type }}">
                                    <option value="tent" <?php if ($booking->camping_type == 'tent'): ?>selected<?php endif; ?>>Tent</option>
                                    <option value="folding_car" <?php if ($booking->camping_type == 'folding_car'): ?>selected<?php endif; ?>>Vouwwagen</option>
                                    <option value="camper" <?php if ($booking->camping_type == 'camper'): ?>selected<?php endif; ?>>Camper</option>
                                    <option value="caravan" <?php if ($booking->camping_type == 'caravan'): ?>selected<?php endif; ?>>Caravan</option>
                                    <option value="other" <?php if ($booking->camping_type == 'other'): ?>selected<?php endif; ?>>Anders...</option>
                                </select>
                                <label for="type">Type huisje</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s4">
                <div class="card blue">
                    <div class="card-content white-text">
                        <span class="card-title">Wijzigingen opslaan</span>
                        <p class="with-margin">Je wijzigingen worden <strong>niet</strong> automatisch opgeslagen. Klik hieronder om je wijzigingen op te slaan.</p>
                        <p class="with-margin">
                            <button class="btn teal" type="submit">Wijzigingen opslaan</button>
                        </p>
                        <p class="smaller">
                            Laatste wijziging: {{ $booking->updated_at }}<br />
                            Aangemaakt op: {{ $booking->created_at }}
                        </p>
                    </div>
                </div>
                <div class="card amber lighten-4">
                    <div class="card-content">
                        <span class="card-title">Koppelen</span>
                        <p class="with-margin">Hieronder vind je een overzicht van <strong>de beschikbare plaatsen</strong> voor de periode
                            en het type van de boeking.</p>
                        <div class="input-field">
                            <select id="accommodation_id" class="{{ $errors->has('type') ? ' invalid' : '' }}"
                                    name="accommodation_id" value="{{ old('accommodation_id') }}" required>
                                <option>-- Maak een keuze --</option>
                                @foreach ($accommodations as $accommodation)
                                    <option value="{{ $accommodation->id }}"
                                            <?php if ($booking->accommodation_id == $accommodation->id): ?>selected<?php endif; ?>
                                            <?php if (!$accommodation->available): ?>disabled<?php endif; ?>>{{ $accommodation->name }}</option>
                                @endforeach
                            </select>
                            <label for="accommodation_id">Accommodatie</label>
                        </div>
                    </div>
                </div>
                @if (isset($booking->customer))
                    <div class="card green">
                        <div class="card-content white-text">
                            <span class="card-title">Klantgegevens</span>
                            <strong>
                                <a class="white-text" title="Klantgegevens" href="{{ url("/customers/{$booking->customer->id}/edit") }}">
                                    {{ $booking->customer->firstname }} {{ $booking->customer->lastname }} ({{ $booking->customer->country }})
                                </a>
                            </strong><br />
                            <span>{{ $booking->customer->street }} {{ $booking->customer->housenumber }}</span><br/>
                            <span>{{ $booking->customer->zipt }} {{ $booking->customer->city }}
                                ({{ $booking->customer->country }})</span><br />
                            <span><i class="material-icons tiny">call</i> {{ $booking->customer->phone }}</span><br />
                            <span><i class="material-icons tiny">email</i> {{ $booking->customer->email }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </form>
@stop
