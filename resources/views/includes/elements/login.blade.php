<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
    @csrf
    <div id="login-box" class="card">
        <div class="card-content">
            <span class="card-title">Inloggen</span>
            <p>Hartelijk welkom bij <strong>boekert</strong>. Vul hieronder je gegevens in om in te loggen.</p>
            <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                <label for="username">Gebruikersnaam</label>
                <input id="username" type="text" class="{{ $errors->has('username') ? ' invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                @if ($errors->has('username'))
                    <span class="helper-text" data-error="wrong">Dit veld is niet juist.</span>
                @endif
            </div>

            <div class="input-field">
                <i class="material-icons prefix">lock</i>
                <label for="password">Wachtwoord</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                <span class="helper-text" data-error="wrong">Dit veld is niet juist.</span>
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
