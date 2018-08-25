<div class="filter-form">
    <form method="GET">
        <div class="row">
            <div class="input-field col s2">
                <label for="boekert_id">Boekert-id</label>
                <input id="boekert_id" type="text" placeholder="bv. B_123456789_abcdef" name="boekert_id" value="{{ isset($filter['boekert_id']) ? $filter['boekert_id'] : '' }}">
            </div>
            <div class="input-field col s2">
                <select id="type" name="type" value="{{ isset($filter['type']) ? $filter['type'] : '' }}" required>
                    <option value="all" <?php if (isset($filter['type']) && $filter['type'] == 'all'): ?>selected<?php endif; ?>>Alles</option>
                    <option value="chalet" <?php if (isset($filter['type']) && $filter['type'] == 'chalet'): ?>selected<?php endif; ?>>Huisje</option>
                    <option value="camping" <?php if (isset($filter['type']) && $filter['type'] == 'camping'): ?>selected<?php endif; ?>>Kampeerplaats</option>
                </select>
                <label for="type">Type</label>
            </div>
            <div class="input-field col s2">
                <label for="date_from">Datum van</label>
                <input id="date_from" type="text" placeholder="bv. 01-01-2018" class="datepicker" name="date_from" value="{{ isset($filter['date_from']) ? $filter['date_from'] : '' }}">
            </div>
            <div class="input-field col s2">
                <label for="date_to">Datum tot</label>
                <input id="date_to" type="text" placeholder="bv. 01-01-2018" class="datepicker" name="date_to" value="{{ isset($filter['date_to']) ? $filter['date_to'] : '' }}">
            </div>
            <div class="input-field col s2">
                <label for="customer">Klant</label>
                <input id="customer" type="text" placeholder="bv. Peter Jansen" name="customer" value="{{ isset($filter['customer']) ? $filter['customer'] : '' }}">
            </div>
            <div class="input-field col s2 right-align">
                <button type="submit" class="btn"><i class="material-icons">send</i></button>
                <a class="btn grey" href="/bookings"><i class="material-icons">clear</i></a>
            </div>
        </div>
    </form>
</div>
