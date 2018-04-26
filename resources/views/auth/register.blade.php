@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row center-xs middle-md">
        <div class="col-xs-11 col-md-6">
          <div class="card shadow-heavy">
            <div class="login-header">
              <h1>Register</h1>
              <span>Already have an account? <a href="{{ route('login') }}">{{ __('Log In') }}</a></span>
            </div>
            <form class="login-form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-control-square">
                    <i class="icon-user"></i>
                    <input id="first_name" placeholder="First name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>
                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-control-square">
                    <i class="icon-user"></i>
                    <input id="last_name" placeholder="Last name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>
                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-control-square">
                    <i class="icon-mail"></i>
                    <input id="email" placeholder="Enter your email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-control-square">
                    <i class="icon-locked"></i>
                    <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-control-square">
                   <i class="icon-locked"></i>
                   <input id="password_confirmation" placeholder="Confirm Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <small 
                    style="      
                        text-align: center;
                        margin-top: 1rem;
                        display: block;
                        font-size: 10px;
                        color: #333333;
                        a {
                            font-weight: 600;
                            text-decoration: none;
                            color: inherit;
                        }"
                    >
                    Dengan mendaftar Anda menyatakan bahwa Anda telah setuju dengan <a href="">Kebijakan Privasi</a>, <a href="">Syarat dan Ketentuan Penggunaan Platform</a>
                </small>
                <button type="submit" class="btn btn-block btn-primary">{{ __('Create Account') }}</button>
                <div class="or-strikeout">
                  <div class="line"></div>
                  <span>or</span>
                </div>
                <button class="btn btn-block btn-facebook">Daftar dengan Facebook</button>
            </form>
          </div>
        </div>
    </div>
</div>
@endsection
