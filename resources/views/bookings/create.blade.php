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
                <?php echo View::make('customers/elements/form'); ?>
            </div>
        </div>
        <input type="submit" class="btn">
    </form>
@stop
