<link rel="stylesheet" href="{{ asset('css/loginuser.css') }}?v={{ time() }}" rel="stylesheet">
<div class="login-container">
<div class="back-btn-container">
        <a href="{{ url('/') }}" class="back-btn">
            <img src="{{ asset('images/icons8back26.png') }}" alt="Back" class="back-icon">
        </a>
    </div>
    <h1 class="login-title">{{ __('Login') }}</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="flex-between">
            <div class="remember-me">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">{{ __('Ingat kata sandi') }}</label>
            </div>

            @if (Route::has('password.request'))
                <a class="forgot-password" href="{{ route('password.request') }}">
                    {{ __('Lupa kata sandi?') }}
                </a>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn-login">
                {{ __('Login') }}
            </button>
        </div>

        <div class="text-center">
            <a class="register-link" href="{{ route('register') }}">
                {{ __('Belum punya akun?, Registrasi sekarang!') }}
            </a>
        </div>
    </form>
</div>

