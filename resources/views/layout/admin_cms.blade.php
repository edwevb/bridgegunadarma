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
  
  {{--  Page styles --}}
  <link rel="stylesheet" href="{{ asset('assets/css/bridgeug.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.bridge.css') }}">

  <style type="text/css">
  </style>
</head>
  {{-- sidebar --}}
  <body>
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
        <span class   ="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link-style js-scroll-trigger " href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link-style dropdown-toggle" data-toggle="dropdown" href="javascript:;" data-target="#account"><i class="far fa-user-circle"></i> {{auth()->user()->username}}</a>
            <div class="dropdown-menu collapse" id="account">
              <a class="dropdown-item" href="{{ url('/dashboard') }}"><i class="fas fa-laptop"></i> Dashboard</a>
              <a class="dropdown-item" href="{{ url('/passwordForm/'.auth()->user()->id) }}"><i class="fas fa-pen-alt"></i> Change Password</a>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="bridge-side-bg fixed-top mt-2">
    <a class="btn">
      <img class="imgug shadow rounded-circle bg-gradient-dark" src="{{ asset('assets/img/bridgeug.png') }} "data-toggle="collapse" data-target="#sidebar">
    </a>
  </div>
  @if (auth()->user()->role_id == '1')
    {{--================= start sidebar section Admin =================--}}
    <div class="content-mobile row no-gutters">
      {{-- menu sidebar --}}
      <div class="col-lg-2 mb-1">
        <div id="sidebar" class="col-lg-2 collapse show">
          <a class="font-weight-bold text-white btn btn-dark btn-lg btn-block" href="javascript:;" data-toggle="collapse" data-target="#dashboard"><i class="fa fa-list"></i> Menu</a>
          <div id="dashboard" class="collapse show">
            <li class="list-group">
              <a class="btn btn-dark btn-block text-left" href="javascript:;" data-toggle="collapse" data-target="#data"><i class="fas fa-database"></i> Data<i class="fa fa-fw fa-caret-down"></i></a>
              <ul id="data" class="collapse list-group">
                <li class="list-group">
                  <a class="btn btn-light text-left ml-2" href="{{ url('/materi') }}"><i class="fas fa-book"></i> Materi</a>
                </li>
                <li class="list-group">
                  <a class="btn btn-light text-left ml-2" href="{{ url('/history') }}"><i class="fas fa-history"></i> Pelatihan</a>
                </li>
                <li class="list-group">
                  <a class="btn btn-light text-left ml-2" href="{{ url('/atlet') }}"><i class="fas fa-users"></i> Atlet</a>
                </li>
                <li class="list-group">
                  <a class="btn btn-light text-left ml-2" href="{{ url('/prestasi') }}"><i class="fas fa-trophy"></i> Prestasi</a>
                </li>
                <li class="list-group">
                  <a class="btn btn-light text-left ml-2" href="{{ url('/event') }}"><i class="far fa-newspaper"></i> Event</a>
                </li>
              </ul>
            </li>
          </div>
          <li id="dashboard" class="list-group collapse show">
            <a class="btn btn-dark btn-block text-left" href="{{ url('/masterpoint') }}"><i class="fas fa-coins"></i> Masterpoint</a>
          </li>
          <div id="dashboard" class="collapse show">
            <li class="list-group">
              <a class="btn btn-dark btn-block text-left" href="javascript:;" data-toggle="collapse" data-target="#kas"></i><i class="fas fa-balance-scale-right"></i> Kas<i class="fa fa-fw fa-caret-down"></i></a>
              <ul id="kas" class="collapse list-group">
                <li class="list-group">
                  <a class="btn btn-light text-left ml-2" href="{{ url('/iuranSk') }}"><i class="fas fa-money-bill-wave"></i> Iuran SK</a>
                </li>
                <li class="list-group">
                  <a class="btn btn-light text-left ml-2" href="{{ url('/pengeluaran') }}"><i class="fas fa-credit-card"></i> Pengeluaran</a>
                </li>
              </ul>
            </li>
          </div>
          <li id="dashboard" class="list-group collapse show">
            <a class="btn btn-dark btn-block text-left" href="{{ url('/user') }}"><i class="fas fa-users-cog"></i> User Management</a>
          </li>
        </div>
      </div> {{-- end menu sidebar --}}
      <div class="col-lg d-flex">
        <div class="container">
          <div class="breadcrumb bg-dark">
            <small data-toggle="tooltip" data-placement="top" title="Home"><a href="{{ url('/') }}" class="text-light"><i class="fa fa-home"></i>&nbsp;Home</a></small>
            <small data-toggle="tooltip" data-placement="top" title="Dashboard"><a href="{{ url('/dashboard') }}" class="text-light ml-2"><i class="fas fa-desktop"></i>&nbsp;Dashboard</a></small>
          </div>
        </div>
      </div>
    </div> {{-- end sidebar section --}}
  @else

    {{-- =================start sidebar section user================= --}}
    <div class="content-mobile row no-gutters">
      {{-- menu sidebar --}}
      <div class="col-lg-2 mb-1">
        <div id="sidebar" class="col-lg-2 collapse show">
          <a class="opacity-1 font-weight-bold btn-dark btn-lg btn-block" href="javascript:;" data-toggle="collapse" data-target="#dashboard"><i class="fa fa-list"></i> Menu</a>
          <div id="dashboard" class="collapse">
            <li class="list-group">
              <a class="btn btn-dark btn-block text-left" href="javascript:;" data-toggle="collapse" data-target="#data"><i class="fas fa-database"></i> Data<i class="fa fa-fw fa-caret-down"></i></a>
              <ul id="data" class="collapse list-group">
                <li class="list-group">
                  <a class="btn btn-light text-left ml-2" href="{{ url('/_materi') }}"><i class="fas fa-book"></i> Materi</a>
                </li>
                <li class="list-group">
                  <a class="btn btn-light text-left ml-2" href="{{ url('/_history') }}"><i class="fas fa-history"></i> Pelatihan</a>
                </li>
              </ul>
            </li>
          </div>
          <li id="dashboard" class="list-group collapse">
            <a class="btn btn-dark btn-block text-left" href="{{ url('_masterpoint') }}"><i class="fas fa-coins"></i> Masterpoint</a>
          </li>
        </div>
      </div> {{-- end menu sidebar --}}
      <div class="col-lg d-flex">
        <div class="container-fluid">
          <div class="breadcrumb bg-dark">
            <small data-toggle="tooltip" data-placement="top" title="Home"><a href="{{ url('/') }}" class="text-light"><i class="fa fa-home"></i>&nbsp;Home</a></small>
            <small data-toggle="tooltip" data-placement="top" title="Dashboard"><a href="{{ url('/dashboard') }}" class="text-light ml-2"><i class="fas fa-desktop"></i>&nbsp;Dashboard</a></small>
          </div>
        </div>
      </div>
    </div> {{-- end sidebar section user --}} 
  @endif

  @yield('section')

  {{-- footer --}}
  <footer>

  </footer>
  

  {{-- Page scripts --}}
  <script src="{{ asset('assets/js/bridge/bridge-jquery.js') }}"></script>
  <script src="{{ asset('assets/js/bridge/bridge-popper.js') }}"></script>
  <script src="{{ asset('assets/js/bridge/bridge.js') }}"></script>

  {{-- Page plugins --}}
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  
  {{-- Page custom scripts --}}
  <script src="{{ asset('assets/js/bridge/bridgecustom.js') }}"></script>
  <script>
  </script>
  </body>
</html>


