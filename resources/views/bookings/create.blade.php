@extends('layouts.app')
@section('content')
    <h4>Nieuwe boeking</h4>
    <form method="POST" action="{{url('bookings')}}" id="create-booking">
        {{ csrf_field() }}
        <div class="card">
            <div class="card-content">
                <span class="card-title"><i class="material-icons">work</i> Gegevens over boeking</span>
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
                <span class="card-title"><i class="material-icons">hotel</i> Bezetting</span>
                <div class="row">
                    <div class="input-field col s3">
                        <i class="material-icons prefix">face</i>
                        <label for="adults">Aantal volwassenen</label>
                        <input id="adults" type="text" class="{{ $errors->has('adults') ? ' invalid' : '' }}" name="adults" value="{{ old('adults') }}" required>
                    </div>
                    <div class="input-field col s3">
                        <i class="material-icons prefix">child_care</i>
                        <label for="children">Aantal kinderen</label>
                        <input id="children" type="text" class="{{ $errors->has('children') ? ' invalid' : '' }}" name="children" value="{{ old('children') }}" required>
                    </div>
                    <div class="input-field col s3">
                        <i class="material-icons prefix">pets</i>
                        <label for="pets">Aantal honden</label>
                        <input id="pets" type="text" class="{{ $errors->has('pets') ? ' invalid' : '' }}" name="pets" value="{{ old('pets') }}" required>
                    </div>
                    <div class="input-field col s3">
                        <i class="material-icons prefix">car</i>
                        <i class="material-icons prefix">directions_car</i>
                        <label for="cars">Aantal extra auto's</label>
                        <input id="cars" type="text" class="{{ $errors->has('cars') ? ' invalid' : '' }}" name="cars" value="{{ old('cars') }}" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <span class="card-title"><i class="material-icons">account_box</i> Personalia</span>
                <?php echo View::make('customers/elements/form'); ?>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <span class="card-title"><i class="material-icons">note</i> Interne notities</span>
                <p class="with-margin"><strong>Opgelet!</strong> De notities die je hier invult zijn <u>niet</u> zichtbaar voor de klant en zijn bedoeld voor interne doeleinden.</p>
                <div class="row">
                    <div class="input-field col s12">
                        <label for="notes">Notities</label>
                        <textarea class="materialize-textarea {{ $errors->has('notes') ? ' invalid' : '' }}" id="notes" name="notes"  value="{{ old('notes') }}"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" class="btn">
    </form>
@stop
