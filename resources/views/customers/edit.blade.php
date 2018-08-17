@extends('layouts.app')
@section('content')
    <h2>{{ $customer->firstname }} {{ $customer->lastname }} bewerken</h2>
    <form method="POST" action="{{ url("/customers/{$customer->id}") }}" id="create-customer">
        <input name="_method" type="hidden" value="PUT">
        {{ csrf_field() }}
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="input-field col s6">
                        <label for="firstname">Voornaam/voorletters</label>
                        <input id="firstname" type="text" class="{{ $errors->has('firstname') ? ' invalid' : '' }}" name="firstname"
                               value="{{ $customer->firstname }}" required>
                    </div>
                    <div class="input-field col s6">
                        <label for="lastname">Achternaam</label>
                        <input id="lastname" type="text" class="{{ $errors->has('lastname') ? ' invalid' : '' }}" name="lastname"
                               value="{{ $customer->lastname }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s9">
                        <label for="street">Straatnaam</label>
                        <input id="street" type="text" class="{{ $errors->has('street') ? ' invalid' : '' }}" name="street"
                               value="{{ $customer->street }}" required>
                    </div>
                    <div class="input-field col s3">
                        <label for="housenumber">Huisnummer</label>
                        <input id="housenumber" type="text" class="{{ $errors->has('housenumber') ? ' invalid' : '' }}"
                               name="housenumber" value="{{ $customer->housenumber }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <label for="zip">Postcode</label>
                        <input id="zip" type="text" class="{{ $errors->has('zip') ? ' invalid' : '' }}" name="zip"
                               value="{{ $customer->zip }}" required>
                    </div>
                    <div class="input-field col s8">
                        <label for="city">Stad</label>
                        <input id="city" type="text" class="{{ $errors->has('city') ? ' invalid' : '' }}" name="city"
                               value="{{ $customer->city }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <select id="country" class="{{ $errors->has('country') ? ' invalid' : '' }}" name="country"
                                value="{{ $customer->country }}">
                            <option value="nl" <?php if ($customer->country == 'nl'): ?>selected<?php endif; ?>>Nederland</option>
                            <option value="be" <?php if ($customer->country == 'be'): ?>selected<?php endif; ?>>België</option>
                            <option value="fr" <?php if ($customer->country == 'fr'): ?>selected<?php endif; ?>>Frankrijk</option>
                            <option value="de" <?php if ($customer->country == 'de'): ?>selected<?php endif; ?>>Duitsland</option>
                            <option value="uk" <?php if ($customer->country == 'uk'): ?>selected<?php endif; ?>>Engeland</option>
                        </select>
                        <label for="country">Land</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <label for="phone">Telefoonnummer</label>
                        <input id="phone" type="text" class="{{ $errors->has('phone') ? ' invalid' : '' }}" name="phone"
                               value="{{ $customer->phone }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <label for="email">E-mailadres</label>
                        <input id="email" type="text" class="{{ $errors->has('email') ? ' invalid' : '' }}" name="email"
                               value="{{ $customer->email }}" required>
                    </div>
                </div>

            </div>
        </div>
        <input type="submit" class="btn">
    </form>
@stop
