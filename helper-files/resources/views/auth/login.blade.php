@extends('auth._layout.layout')

@section('content')
<p class="login-box-msg">{{__("Prijavljivanje na SOLARIFY")}}</p>

<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="input-group mb-3">
        <input id="email" type="email" placeholder="E-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>
    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <div class="input-group mb-3">
        <input id="password" type="password" placeholder="Lozinka" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <div class="row">
        <div class="col-8">
            <div class="icheck-primary">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">
                    {{__("Zapamti me")}}
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{__("Prijavi se")}}</button>
        </div>
        <!-- /.col -->
    </div>
</form>

<p class="mb-1">
    @if (Route::has('password.request'))
    <a class="btn btn-link" href="{{ route('password.request') }}">
        {{ __('Zaboravio sam lozinku') }}
    </a>
    @endif
</p>
@endsection