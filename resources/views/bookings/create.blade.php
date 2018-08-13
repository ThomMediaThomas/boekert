@extends('layouts.app')
@section('content')
    <h2>Nieuwe boeking</h2>
    <form method="POST" action="{{url('bookings')}}" id="create-booking">
        {{ csrf_field() }}
        <div class="card">
            <div class="card-content">
                <span class="card-title">Gegevens over boeking</span>
                <div class="row">
                    <div class="input-field col s6">
                        <label for="date_from">Datum van</label>
                        <input id="date_from" type="text" class="datepicker {{ $errors->has('date_from') ? ' invalid' : '' }}" name="date_from" value="{{ old('date_from') }}" required>
                    </div>
                    <div class="input-field col s6">
                        <label for="date_to">Datum tot</label>
                        <input id="date_to" type="text" class="datepicker {{ $errors->has('date_to') ? ' invalid' : '' }}" name="date_to" value="{{ old('date_to') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select id="type" class="{{ $errors->has('type') ? ' invalid' : '' }}" name="type" value="{{ old('type') }}" required>
                            <option value="chalet">Huisje huren</option>
                            <option value="camping">Kampeerplaats huren</option>
                        </select>
                        <label for="type">Type</label>
                    </div>
                    <div class="input-field show-on-change-type col s6" id="show-for-chalet">
                        <select id="chalet_type" class="{{ $errors->has('chalet_type') ? ' invalid' : '' }}" name="chalet_type" value="{{ old('chalet_type') }}">
                            <option value="chalet-4">4-persoonshuisje</option>
                            <option value="chalet-6">6-persoonshuisje</option>
                        </select>
                        <label for="type">Type huisje</label>
                    </div>
                    <div class="input-field show-on-change-type col s6" id="show-for-camping" style="display: none;">
                        <select id="camping_type" class="{{ $errors->has('camping_type') ? ' invalid' : '' }}" name="camping_type" value="{{ old('camping_type') }}">
                            <option value="tent">Tent</option>
                            <option value="folding_car">Vouwwagen</option>
                            <option value="camper">Camper</option>
                            <option value="caravan">Caravan</option>
                            <option value="other">Andes...</option>
                        </select>
                        <label for="type">Type huisje</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <span class="card-title">Personalia</span>
                <div class="row">
                    <div class="input-field col s6">
                        <label for="firstname">Voornaam/voorletters</label>
                        <input id="firstname" type="text" class="{{ $errors->has('firstname') ? ' invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required>
                    </div>
                    <div class="input-field col s6">
                        <label for="lastname">Achternaam</label>
                        <input id="lastname" type="text" class="{{ $errors->has('lastname') ? ' invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s9">
                        <label for="street">Straatnaam</label>
                        <input id="street" type="text" class="{{ $errors->has('street') ? ' invalid' : '' }}" name="street" value="{{ old('street') }}" required>
                    </div>
                    <div class="input-field col s3">
                        <label for="housenumber">Huisnummer</label>
                        <input id="housenumber" type="text" class="{{ $errors->has('housenumber') ? ' invalid' : '' }}" name="housenumber" value="{{ old('housenumber') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <label for="zip">Postcode</label>
                        <input id="zip" type="text" class="{{ $errors->has('zip') ? ' invalid' : '' }}" name="zip" value="{{ old('zip') }}" required>
                    </div>
                    <div class="input-field col s8">
                        <label for="city">Stad</label>
                        <input id="city" type="text" class="{{ $errors->has('city') ? ' invalid' : '' }}" name="city" value="{{ old('city') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <select id="country" class="{{ $errors->has('country') ? ' invalid' : '' }}" name="country" value="{{ old('country') }}">
                            <option value="nl">Nederland</option>
                            <option value="be">België</option>
                            <option value="fr">Frankrijk</option>
                            <option value="de">Duitsland</option>
                            <option value="uk">Engeland</option>
                        </select>
                        <label for="country">Land</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <label for="phone">Telefoonnummer</label>
                        <input id="phone" type="text" class="{{ $errors->has('phone') ? ' invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <label for="email">E-mailadres</label>
                        <input id="email" type="text" class="{{ $errors->has('email') ? ' invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" class="btn">
    </form>
@stop
