<div class="card-panel filter-panel grey lighten-4">
    <form method="GET">
        <div class="row">
            <div class="input-field col s2">
                <label for="boekert_id">Boekert-id</label>
                <input id="boekert_id" type="text" class="" name="boekert_id" value="{{ isset($filter['boekert_id']) ? $filter['boekert_id'] : '' }}">
            </div>
            <div class="input-field col s2">
                <label for="date_from">Datum van</label>
                <input id="date_from" type="text" class="datepicker" name="date_from" value="{{ isset($filter['date_from']) ? $filter['date_from'] : '' }}">
            </div>
            <div class="input-field col s2">
                <label for="date_to">Datum tot</label>
                <input id="date_to" type="text" class="datepicker" name="date_to" value="{{ isset($filter['date_to']) ? $filter['date_to'] : '' }}">
            </div>
            <div class="input-field col s2">
                <label for="customer">Klant</label>
                <input id="customer" type="text" class="" name="customer" value="{{ isset($filter['customer']) ? $filter['customer'] : '' }}">
            </div>
            <div class="input-field col s2">
                <button type="submit" class="btn">Filteren</button>
            </div>
        </div>
    </form>
</div>
