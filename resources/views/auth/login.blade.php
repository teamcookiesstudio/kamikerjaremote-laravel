@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row center-xs middle-md">
      <div class="col-xs-11 col-md-6">
        <div class="card shadow-heavy">
            <div class="login-header">
                <h1>Login</h1>
                <span>Don't have an account? <a href="{{ route('register') }}">{{ __('Register here') }}</a></span>
            </div>
            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-control-square">
                    <i class="icon-mail"></i>
                    <input id="email" type="email" placeholder="Enter your email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>                    
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-control-square">
                    <i class="icon-locked"></i>
                    <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="login-preferences">
                    <div class="remember">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>{{ __('Remember Me') }}</input>
                    </div>
                    <a class="btn btn-simple forgot-pass" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                </div>
                <button type="submit" class="btn btn-block btn-primary">{{ __('Login') }}</button>
                <div class="or-strikeout">
                    <div class="line"></div>
                    <span>or</span>
                </div>
                <button class="btn btn-block btn-facebook">Login dengan Facebook</button>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection
