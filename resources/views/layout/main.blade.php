<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @php
    $meta = ['Bridge Indonesia','Bridge Gunadarma','Website Bridge Gunadarma Jakarta'];
  @endphp
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="{{ $meta[1] }}">
  <meta name="author" content="{{ $meta[1] }}">
  <meta name="keywords" content="Bridge, Olahraga Bridge, Universitas Gunadarma, Bridge Gunadarma, Bridge Indonesia, Spade Heart Club Diamond No Trump">
  <meta property="og:title" content="{{ $meta[1] }}" />
  <meta property="og:image" content="{{ asset('assets/img/bridgeug.png') }}"/>  
  <meta property="og:description" content="{{ $meta[2] }}" />
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/bridgeug.png') }}">

  <title>@yield('title')</title> 

  {{--  Page fonts & Icon --}}
  <link href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">

  {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('assets/css/bridgeug.css') }}">
  <style>
    nav{
      background-color: #ad5389;
      background-image: -webkit-linear-gradient(right, rgb(173, 83, 137), rgb(60, 16, 83));
      background-image: -o-linear-gradient(right, rgb(173, 83, 137), rgb(60, 16, 83));
      background-image: linear-gradient(to left, rgb(173, 83, 137), rgb(60, 16, 83));
      background-size: cover;
    }
    @media (min-width: 992px){
      nav{
        padding-top: 2rem!important;
        padding-bottom: 18rem!important;
        background-image: url("{{ asset('assets/img/slider_1.jpg') }}")!important;
        background-size: cover;
        background-attachment: fixed;
        /*filter: brightness(75%);*/
      }

      #about .container{
        opacity: 0.94;
      }

      #home{
        margin-top: -5px;
      }
    }
    .vertical { 
      border-left: 3px solid #C04848;
      height: 50px;
    } 
  </style>
</head>
  {{-- sidebar --}}
  <body class="bg-dark">
  <nav class="navbar navbar-expand-lg navbar-dark shadow fixed-top" id ="mainNav">
    <div class="container-fluid">
      <div class="navbar-brand">
        <a href="{{ url('/') }}"><img class="imgug" src="{{ asset('assets/img/bridgeug.png') }}"> Bridge Gunadarma</a>
      </div>
      <button class="btn-nav navbar-toggler navbar-toggler-right" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" data-toggle="collapse" data-target="#navbarNav">
        <span class ="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link-style js-scroll-trigger" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link-style js-scroll-trigger" href="#atlet">Atlet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link-style js-scroll-trigger" href="#prestasi">Prestasi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link-style js-scroll-trigger" href="#event">Event</a>
          </li>
          <li class="nav-item">
            <a class="nav-link-style js-scroll-trigger" href="#contact">Contact</a>
          </li>
          <li class="nav-item" id="login-btn">
            @if(auth()->user())
             <li class="nav-item dropdown">
                <a class="nav-link-style dropdown-toggle" data-toggle="dropdown" href="javascript:;" data-target="#account"><i class="far fa-user-circle"></i> {{auth()->user()->email}}</a>
                <div class="dropdown-menu collapse" id="account">
                  <a class="dropdown-item" href="{{ url('/dashboard') }}"><i class="fas fa-laptop"></i> Dashboard</a>
                  <a class="dropdown-item" href="{{ url('/passwordForm/'.auth()->user()->id) }}"><i class="fas fa-pen-alt"></i> Change Password</a>
                  @if (auth()->user()->role_id!=1)
                    <a class="dropdown-item" href="{{ url('/pesan/form/'.auth()->user()->id) }}"><i class="far fa-envelope"></i>&nbsp;Kirim pesan Admin</a>
                  @else
                    <a class="dropdown-item" href="{{ url('/pesan')}}"><i class="far fa-envelope"></i>&nbsp;Lihat pesan</a>
                  @endif
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
            @else
              <a class="nav-link-style js-scroll-trigger" href="{{ route('login') }}"><i class="far fa-user-circle"></i> Login</a>
            @endif
          </li>
        </ul>
      </div>
    </div>
  </nav>

  @yield('section')
  
  {{-- footer --}}
  <footer class="mt-5">
    <blockquote class="text-center col-md-6 mx-auto rounded-pill">
      <p class="py-2">&copy;2020 All Rights Reserved{{-- <a class="text-primary" href="https://www.instagram.com/edwevb" target="_blank">edwevb</a> --}}</p>
    </blockquote>
    <div class="text-center">
      <ul class="list-inline">
        <li class="list-inline-item footer-logo"><a href="{{ url('/') }}">
          <img height="175" width="auto" alt="BrigeGunadarma" src="{{ asset('assets/img/bridgeug.png') }}"></a>
        </li>
        <li class="list-inline-item">
          <div class ="vertical"></div>
        </li>
        <li class="list-inline-item footer-logo"><a target="_blank" href="https://www.gunadarma.ac.id/">
          <img height="175" width="auto" alt="UniversitasGunadarma" src="{{ asset('assets/img/ug.png') }}"></a>
        </li>
      </ul>
    </div>
  </footer>
  <a href="#" id="scroll" style="display: none;"><span></span></a>

  {{-- Page scripts --}}
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
{{--   <script src="{{ asset('assets/js/bridge/bridge-jquery.js') }}"></script>
  <script src="{{ asset('assets/js/bridge/bridge-popper.js') }}"></script>
  <script src="{{ asset('assets/js/bridge/bridge.js') }}"></script> --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="{{ asset('assets/js/bridge/bridge-home.js') }}"></script>
  @yield('script')
  </body>
</html>


