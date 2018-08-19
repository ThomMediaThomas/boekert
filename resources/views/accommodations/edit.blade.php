@extends('layouts.app')
@section('content')
    <h4>{{ $accommodation->name }} bewerken</h4>
    <form method="POST" action="{{ url("/accommodations/{$accommodation->id}") }}" id="create-accommodation">
        <input name="_method" type="hidden" value="PUT">
        {{ csrf_field() }}
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="input-field col s6">
                        <label for="name">Naam</label>
                        <input id="name" type="text" class="{{ $errors->has('name') ? ' invalid' : '' }}" name="name" value="{{ $accommodation->name }}" required>
                    </div>
                    <div class="input-field col s6">
                        <label for="field_number">Nummer</label>
                        <input id="field_number" type="text" class="{{ $errors->has('field_number') ? ' invalid' : '' }}" name="field_number" value="{{ $accommodation->field_number }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select id="type" class="{{ $errors->has('type') ? ' invalid' : '' }}" name="type" value="{{ $accommodation->type }}" required>
                            <option value="chalet">Huisje</option>
                            <option value="camping">Kampeerplaats</option>
                        </select>
                        <label for="type">Type</label>
                    </div>
                    <div class="input-field show-on-change-type col s6" id="show-for-chalet">
                        <select id="chalet_type" class="{{ $errors->has('chalet_type') ? ' invalid' : '' }}" name="chalet_type">
                            <option value="chalet-4" <?php if ($accommodation->chalet_type == 'chalet-4'): ?>selected<?php endif; ?>>4-persoonshuisje</option>
                            <option value="chalet-6" <?php if ($accommodation->chalet_type == 'chalet-6'): ?>selected<?php endif; ?>>6-persoonshuisje</option>
                        </select>
                        <label for="type">Type huisje</label>
                    </div>
                    <div class="input-field show-on-change-type col s6" id="show-for-camping" style="display: none;">
                        <select id="camping_type" class="{{ $errors->has('camping_type') ? ' invalid' : '' }}" name="camping_type">
                            <option value="all" <?php if ($accommodation->chalet_type == 'all'): ?>selected<?php endif; ?>>Alles</option>
                            <option value="tent" <?php if ($accommodation->chalet_type == 'tent'): ?>selected<?php endif; ?>>Tent</option>
                            <option value="folding_car" <?php if ($accommodation->chalet_type == 'folding_car'): ?>selected<?php endif; ?>>Vouwwagen</option>
                            <option value="camper" <?php if ($accommodation->chalet_type == 'camper'): ?>selected<?php endif; ?>>Camper</option>
                            <option value="caravan" <?php if ($accommodation->chalet_type == 'caravan'): ?>selected<?php endif; ?>>Caravan</option>
                        </select>
                        <label for="type">Type huisje</label>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" class="btn">
    </form>
@stop
