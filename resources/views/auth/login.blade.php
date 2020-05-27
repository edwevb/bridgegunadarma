@extends('layouts.app')
@section('title','Login')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        @if (session('AlertSuccess'))
          <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>{{ session('AlertSuccess') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="text-center mb-2">
          <a href="{{ url('/') }}"><img height="100" width="auto" src="{{ asset('assets/img/bridgeug.png') }}" alt="Bridge Gunadarma"></a>
        </div>
        <div class="card-borderless shadow">
          <div class="card-header bg-secondary text-center text-white rounded">
            <h3 class="">{{ __('Login Page') }}</h3>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right text-white">{{ __('Email') }}</label>
                <div class="col-md-6">
                  <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right text-white">{{ __('Password') }}</label>
                <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid  @enderror" name="password" required autocomplete="current-password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label text-white" for="remember">
                      {{ __('Remember Me') }}
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn px-5 btn-primary rounded-pill">
                    {{ __('Login') }}
                  </button>
                  {{-- @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                      {{ __('Forgot Your Password?') }}
                    </a>
                  @endif --}}
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
