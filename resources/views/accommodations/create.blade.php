@extends('layouts.app')
@section('content')
    <h2>Nieuwe accomodatie</h2>
    <form method="POST" action="{{url('accommodations')}}" id="create-accomodation">
        {{ csrf_field() }}
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="input-field col s6">
                        <label for="name">Naam</label>
                        <input id="name" type="text" class="{{ $errors->has('name') ? ' invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="input-field col s6">
                        <label for="field_number">Nummer</label>
                        <input id="field_number" type="text" class="{{ $errors->has('field_number') ? ' invalid' : '' }}" name="field_number" value="{{ old('field_number') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select id="type" class="{{ $errors->has('type') ? ' invalid' : '' }}" name="type" value="{{ old('type') }}" required>
                            <option value="chalet">Huisje</option>
                            <option value="camping">Kampeerplaats</option>
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
                            <option value="all">Alles</option>
                            <option value="tent">Tent</option>
                            <option value="folding_car">Vouwwagen</option>
                            <option value="camper">Camper</option>
                            <option value="caravan">Caravan</option>
                        </select>
                        <label for="type">Type huisje</label>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" class="btn">
    </form>
@stop
