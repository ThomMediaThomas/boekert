@extends('layouts.app')
@section('content')
    <h4>Nieuwe boeking</h4>
    <form method="POST" action="{{url('bookings')}}" id="create-booking">
        {{ csrf_field() }}
        <div class="row">
            <div class="col s8">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title"><i class="material-icons">work</i> Gegevens over boeking</span>
                        <div class="row">
                            <div class="col s12">
                                <label>Bron</label><br />
                                <label>
                                    <input name="source" value="phone" type="radio" checked="checked"/>
                                    <span>Telefoon</span>
                                </label>
                                <label>
                                    <input name="source" value="mail" type="radio" />
                                    <span>E-mail</span>
                                </label>
                                <label>
                                    <input name="source" value="desk" type="radio" />
                                    <span>Balie</span>
                                </label>
                                <label>
                                    <input name="source" value="site" type="radio" />
                                    <span>Website</span>
                                </label>
                                <label>
                                    <input name="source" value="other" type="radio" />
                                    <span>Anders</span>
                                </label>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="date_from">Datum van</label>
                                <input id="date_from" type="text" class="datepicker {{ $errors->has('date_from') ? ' invalid' : '' }}" name="date_from" value="{{ request('date_from') ? request('date_from') : old('date_from') }}" required>
                            </div>
                            <div class="input-field col s6">
                                <label for="date_to">Datum tot</label>
                                <input id="date_to" type="text" class="datepicker {{ $errors->has('date_to') ? ' invalid' : '' }}" name="date_to" value="{{ request('date_to') ? request('date_to') : old('date_to') }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select id="type_id" class="{{ $errors->has('type_id') ? ' invalid' : '' }}" name="type_id" value="{{ old('type_id') }}" required>
                                    @foreach ($accommodation_types as $accommodation_type)
                                        <option value="{{ $accommodation_type->id }}" <?php if (old('type_id') == $accommodation_type->id): ?>selected<?php endif; ?>>{{ $accommodation_type->name }}</option>
                                    @endforeach
                                </select>
                                <label for="type">Soort</label>
                            </div>
                            <div class="input-field show-on-change-type col s6" id="show-for-1">
                                <select id="chalet_type_id" class="{{ $errors->has('chalet_type_id') ? ' invalid' : '' }}" name="chalet_type_id" value="{{ old('chalet_type_id') }}">
                                    @foreach ($accommodation_chalet_types as $accommodation_chalet_type)
                                        <option value="{{ $accommodation_chalet_type->id }}" <?php if (old('chalet_type_id') == $accommodation_chalet_type->id): ?>selected<?php endif; ?>>{{ $accommodation_chalet_type->name }}</option>
                                    @endforeach
                                </select>
                                <label for="chalet_type">Type huisje</label>
                            </div>
                            <div class="input-field show-on-change-type col s6" id="show-for-2" style="display: none;">
                                <select id="camping_type_id" class="{{ $errors->has('camping_type_id') ? ' invalid' : '' }}" name="camping_type_id" value="{{ old('camping_type_id') }}">
                                    @foreach ($accommodation_camping_types as $accommodation_camping_type)
                                        <option value="{{ $accommodation_camping_type->id }}" <?php if (old('camping_type_id') == $accommodation_camping_type->id): ?>selected<?php endif; ?>>{{ $accommodation_camping_type->name }}</option>
                                    @endforeach
                                </select>
                                <label for="camping_type">Type kampeerplaats</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title"><i class="material-icons">hotel</i> Bezetting</span>
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons prefix">face</i>
                                <label for="adults">Aantal volwassenen</label>
                                <input id="adults" type="text" class="{{ $errors->has('adults') ? ' invalid' : '' }}" name="adults" value="{{ old('adults') }}" required>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix">child_care</i>
                                <label for="children">Aantal kinderen</label>
                                <input id="children" type="text" class="{{ $errors->has('children') ? ' invalid' : '' }}" name="children" value="{{ old('children') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title"><i class="material-icons">extension</i> Extra's</span>
                        <div class="row">
                            @foreach ($extras as $extra)
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">{{ $extra->icon }}</i>
                                    <label for="children">{{ $extra->name }}</label>
                                    <input id="{{ $extra->system_name }}" type="text" class="{{ $errors->has($extra->system_name) ? ' invalid' : '' }}" name="{{ $extra->system_name }}" value="{{ old($extra->system_name) ? old($extra->system_name) : $extra->default }}" required>
                                </div>
                            @endforeach
                        </div>
                    </diV>
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
            </div>
            <div class="col s4">
                <div class="card amber lighten-4">
                    <div class="card-content">
                        <span class="card-title"><i class="material-icons">edit_location</i> Gekoppelde accommodatie</span>
                        <div class="input-field">
                            <label for="accommodation_id">Accommodatie</label>
                            <input type="text" id="accommodation_id" name="accommodation_id"  value="{{ request('accommodation_id') ? request('accommodation_id') : old('accommodation_id') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
