<div class="filter-form">
    <form method="GET">
        <div class="row">
            <div class="input-field col s2">
                <label for="name">Nama</label>
                <input id="name" type="text" placeholder="bv. Tentenveld 1" name="name" value="{{ isset($filter['name']) ? $filter['name'] : '' }}">
            </div>
            <div class="input-field col s2">
                <select id="type_id" class="{{ $errors->has('type_id') ? ' invalid' : '' }}" name="type_id" value="{{ isset($filter['type_id']) ? $filter['type_id'] : '' }}" required>
                    <option value="">-- maak een keuze --</option>
                    @foreach ($accommodation_types as $accommodation_type)
                        <option value="{{ $accommodation_type->id }}" <?php if (isset($filter['type_id']) && $filter['type_id'] == $accommodation_type->id): ?>selected<?php endif; ?>>{{ $accommodation_type->name }}</option>
                    @endforeach
                </select>
                <label for="type_id">Type</label>
            </div>
            <div class="input-field col s2">
                <select id="subtype_id" class="{{ $errors->has('subtype_id') ? ' invalid' : '' }}" name="subtype_id" value="{{ isset($filter['subtype_id']) ? $filter['subtype_id'] : '' }}" required>
                    <option value="">-- maak een keuze --</option>
                    @foreach ($accommodation_subtypes as $accommodation_subtype)
                        <option value="{{ $accommodation_subtype->id }}" <?php if (isset($filter['subtype_id']) && $filter['subtype_id'] == $accommodation_subtype->id): ?>selected<?php endif; ?>>{{ $accommodation_subtype->name }}</option>
                    @endforeach
                </select>
                <label for="subtype_id">Subype</label>
            </div>
            <div class="input-field col s2">
            </div>
            <div class="input-field col s2">
            </div>
            <div class="input-field col s2 right-align">
                <button type="submit" class="btn"><i class="material-icons">send</i></button>
                <a class="btn grey" href="/bookings"><i class="material-icons">clear</i></a>
            </div>
        </div>
    </form>
</div>
