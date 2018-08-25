<div class="card small lime">
    <div class="card-content white-text">
        <span class="card-title"><i class="material-icons">send</i> Snel naar boeking</span>
        <form action="{{url('bookings')}}" method="GET">
            <div class="col s10">
            <div class="input-field">
                <label for="text">Zoekterm</label>
                <input type="text" name="text" id="text">
            </div>
            </div>
            <div class="col s2 right-align">
                <div class="input-field">
                    <button type="submit" class="btn-floating lime darken-2"><i class="material-icons">search</i></button>
                </div>
            </div>
        </form>
    </div>
</div>
