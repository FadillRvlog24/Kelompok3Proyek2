<link rel="stylesheet" href="{{ asset('css/registeruser.css') }}?v={{ time() }}" rel="stylesheet">
<div class="register-container">
<div class="back-btn-container">
        <a href="{{ url('/') }}" class="back-btn">
            <img src="{{ asset('images/icons8back26.png') }}" alt="Back" class="back-icon">
        </a>
    </div>
    <h1 class="register-title">{{ __('Register') }}</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="form-group">
            <button type="submit" class="btn-register">
                {{ __('Register') }}
            </button>
        </div>
    </form>
    <div class="text-center">
        <a href="{{ route('login') }}" class="login-link">{{ __('Sudah punya akun?, login disini') }}</a>
    </div>
</div>