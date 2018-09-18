@extends('layouts.app')
@section('content')
    <h4>Nieuwe accommodatie</h4>
    <form method="POST" action="{{url('accommodations')}}" id="create-accommodation">
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
        <input type="submit" class="btn">
    </form>
@stop
