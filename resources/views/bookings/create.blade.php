@extends('layouts.app')
@section('content')
    <h2>Nieuwe boeking</h2>
    <form method="POST" action="{{url('bookings')}}" id="create-booking">
        {{ csrf_field() }}
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
        <div class="row">
            <div class="input-field col s12">
                <label for="Customer_id">Customer_id</label>
                <input disabled="disabled" id="Customer_id" type="text" name="Customer_id" value="1" required>
            </div>
        </div>
        <input type="submit">
    </form>
@stop
