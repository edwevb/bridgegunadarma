@extends('layouts.app')
@section('title','Login')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="text-center mb-2">
          <img height="100" width="auto" src="{{ asset('assets/img/bridgeug.png') }}" alt="Bridge Gunadarma">
        </div>
        <div class="card-borderless shadow">
          <div class="card-header bg-dark text-center rounded-top">
            <h3 class="text-white"><i class="fas fa-user-alt"></i> {{ __('Login Page') }}</h3>
          </div>
          <div class="card-body py-5">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group row text-dark">
                <label for="email" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Email') }}</label>
                <div class="col-md-8">
                  <input id="email" type="text" class="form-control rounded-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="current email" autofocus>
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row text-dark">
                <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Password') }} </label>
                <div class="col-md-8">
                  <input id="password" type="password" class="form-control rounded-0 @error('password') is-invalid  @enderror" name="password" required autocomplete="off">
                  <a type="button" class="bx-none btn-sm btn btn-light mt-1"onclick="VisiblePassword()"> <small>Show password <i class="far fa-eye"></i></small></a>
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row" hidden>
                <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                    <label class="form-check-label" for="remember">
                      {{ __('Remember Me') }}
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md offset-md-4">
                  <button type="submit" class="btn btn-sm px-5 btn-primary rounded-pill">
                    {{ __('Sign in') }} <i class="fas fa-sign-in-alt"></i>
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
        <div class="bg-dark rounded-bottom text-center p-1">
          <a href="{{ url('/') }}" type="submit" class="lead btn btn-light rounded-circle font-weight-bold py-2">
            <i class="fa fa-home fa-2x"></i>
          </a>
        </div>
        @if (session('AlertSuccess'))
          <div class="alert alert-success alert-dismissible fade show text-center mt-2" role="alert">
            <strong>{{ session('AlertSuccess') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
      </div>
    </div>
  </div>

  <script>
    function VisiblePassword() {
      var x = document.getElementById("password");
      var y = document.getElementById("confirm_password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
      if (y.type === "password") {
        y.type = "text";
      } else {
        y.type = "password";
      }
    }
  </script>
@endsection
