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
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  {{-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.bridge.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('assets/css/bridgeug.css') }}">
  
  <style>
    @media (min-width: 992px){
      nav{
        padding-top: 2rem!important;
        padding-bottom: 18rem !important;
        background-image: url("{{ asset('assets/img/slider_1.jpg') }}")!important;
        background-size: cover;
        background-attachment: fixed;
      }
    }
  </style>
</head>

  {{-- sidebar --}}
  <body class="bg-dark">
  {{-- <script>
  alert('Direkomendasikan untuk membuka halaman website ini dengan browser GOOGLE CHROME');
  </script> --}}
  {{-- Top menu --}}
  <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-dark shadow fixed-top" id ="mainNav">
    <div class="container-fluid">
      <div class="navbar-brand">
        <a href="{{ url('/') }}"><img class="imgug" src="{{ asset('assets/img/bridgeug.png') }}"> Bridge Gunadarma</a>
      </div>
        <button class ="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                <a class="nav-link-style dropdown-toggle" data-toggle="dropdown" href="javascript:;" data-target="#account"><i class="far fa-user-circle"></i> {{auth()->user()->username}}</a>
                <div class="dropdown-menu collapse" id="account">
                  <a class="dropdown-item" href="{{ url('/dashboard') }}"><i class="fas fa-laptop"></i> Dashboard</a>
                  <a class="dropdown-item" href="#"><i class="fas fa-pen-alt"></i> Change Password</a>
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
  <footer class="mb-2">
    <div id="footer" class="footer mt-5 bg-white shadow-lg col-md-4 rounded-pill mx-auto"> 
      <div class="col text-center">
        <p class="font-weight-bold py-2">2020 All Rights Reserve by Edward Evbert</p>
      </div>
    </div>
  </footer>

  <a href="#" id="scroll" style="display: none;"><span></span></a>

  {{-- Page scripts --}}
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  {{-- <script src="{{ asset('assets/js/bridge/bridge-popper.js') }}"></script>
  <script src="{{ asset('assets/js/bridge/bridge.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/js/bridge/bridge-home.js') }}"></script> --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
    //smooth scroll
    $(document).ready(function(){
      $(".js-scroll-trigger").on('click', function(event) {

        if (this.hash !== "") {
          event.preventDefault();

          var hash = this.hash;

          $('html, body').animate({
            scrollTop: $(hash).offset().top - 150
          }, 1000, function(){

            window.location.hash = hash;
          });
        }
      });
    });

    //Back to top
    $(document).ready(function(){ 
      $(window).scroll(function(){ 
          if ($(this).scrollTop() > 400) { 
              $('#scroll').fadeIn(); 
          } else { 
              $('#scroll').fadeOut(); 
          } 
      }); 
      $('#scroll').click(function(){ 
          $("html, body").animate({ scrollTop: 0 }, 600); 
          return false; 
      }); 
    });
  </script>
  </body>
</html>


