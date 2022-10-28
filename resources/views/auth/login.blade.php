@extends('layouts.app')

@section('content')
<div class="login-card-container">
    <div class="login-card">

        <div class="login-card-header">
            <h3 class="h3">Inicia Sesión</h3>
            <div>Por favor inicia sesión para utilizar la aplicación</div>
        </div>

        <div class="login-card-body">
            <form class="login-card-form" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-item">
                    <span class="form-item-icon material-symbols-rounded">mail</span>
                    
                        <input id="email" type="email" @error('email') class="form-control is-invalid" @enderror name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-item">
                    <span class="form-item-icon material-symbols-rounded">lock</span>

                        <input id="password" type="password" @error('password') class="form-control is-invalid" @enderror name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-item-other">
                    <div class="checkbox">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">
                            {{ __('Recuérdame') }}
                        </label>
                    </div>
                </div>

                <button type="submit">
                    {{ __('Entrar') }}
                </button>

                <div class="login-card-footer">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Olvidaste tu contraseña?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
