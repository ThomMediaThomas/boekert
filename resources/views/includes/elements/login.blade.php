<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
    @csrf
    <div id="login-box" class="card">
        <div class="card-content">
            <span class="card-title">Inloggen</span>
            <p>Hartelijk welkom bij <strong>boekert</strong>. Vul hieronder je gegevens in om in te loggen.</p>
            <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                <label for="email">E-mailadres</label>
                <input id="email" type="email" class="{{ $errors->has('email') ? ' invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="helper-text" data-error="wrong">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="input-field">
                <i class="material-icons prefix">lock</i>
                <label for="password">Wachtwoord</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                <span class="helper-text" data-error="wrong">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="input-field">
                <button class="btn" type="submit">
                    Inloggen <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
    </div>
</form>
