@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row center-xs middle-md">
      <div class="col-xs-11 col-md-6">
        <div class="card shadow-heavy">
            <div class="login-header">
              <h1>{{ __('Reset Password') }}</h1>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form class="login-form" method="POST" action="{{ route('password.email') }}">
                <p>Please enter your email address.<br>We will send reset password url into your inbox.</p>
                @csrf
                <div class="input-control-square">
                    <i class="icon-mail"></i>
                    <input id="email" placeholder="Enter your email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>    
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <button class="btn btn-block btn-primary" type="submit" class="btn btn-primary">{{ __('Send Password Reset Link') }}</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
