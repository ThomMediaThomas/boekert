<div class="row">
    <div class="input-field col s6">
        <label for="firstname">Voornaam/voorletters</label>
        <input id="firstname" type="text" class="{{ $errors->has('firstname') ? ' invalid' : '' }}" name="firstname"
               value="{{ old('firstname') }}" required>
    </div>
    <div class="input-field col s6">
        <label for="lastname">Achternaam</label>
        <input id="lastname" type="text" class="{{ $errors->has('lastname') ? ' invalid' : '' }}" name="lastname"
               value="{{ old('lastname') }}" required>
    </div>
</div>
<div class="row">
    <div class="input-field col s9">
        <label for="street">Straatnaam</label>
        <input id="street" type="text" class="{{ $errors->has('street') ? ' invalid' : '' }}" name="street"
               value="{{ old('street') }}" required>
    </div>
    <div class="input-field col s3">
        <label for="housenumber">Huisnummer</label>
        <input id="housenumber" type="text" class="{{ $errors->has('housenumber') ? ' invalid' : '' }}"
               name="housenumber" value="{{ old('housenumber') }}" required>
    </div>
</div>
<div class="row">
    <div class="input-field col s4">
        <label for="zip">Postcode</label>
        <input id="zip" type="text" class="{{ $errors->has('zip') ? ' invalid' : '' }}" name="zip"
               value="{{ old('zip') }}" required>
    </div>
    <div class="input-field col s8">
        <label for="city">Stad</label>
        <input id="city" type="text" class="{{ $errors->has('city') ? ' invalid' : '' }}" name="city"
               value="{{ old('city') }}" required>
    </div>
</div>
<div class="row">
    <div class="input-field col s12">
        <select id="country" class="{{ $errors->has('country') ? ' invalid' : '' }}" name="country"
                value="{{ old('country') }}">
            <option value="nl">Nederland</option>
            <option value="be">België</option>
            <option value="fr">Frankrijk</option>
            <option value="de">Duitsland</option>
            <option value="uk">Engeland</option>
        </select>
        <label for="country">Land</label>
    </div>
</div>
<div class="row">
    <div class="input-field col s12">
        <label for="phone">Telefoonnummer</label>
        <input id="phone" type="text" class="{{ $errors->has('phone') ? ' invalid' : '' }}" name="phone"
               value="{{ old('phone') }}" required>
    </div>
</div>
<div class="row">
    <div class="input-field col s12">
        <label for="email">E-mailadres</label>
        <input id="email" type="text" class="{{ $errors->has('email') ? ' invalid' : '' }}" name="email"
               value="{{ old('email') }}" required>
    </div>
</div>
