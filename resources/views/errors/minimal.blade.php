<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                margin: 0;
            }
        .btn{
              display: inline-block;
              font-weight: 400;
              color: #212529;
              text-align: center;
              vertical-align: middle;
              cursor: pointer;
              -webkit-user-select: none;
              -moz-user-select: none;
              -ms-user-select: none;
              user-select: none;
              background-color: transparent;
              border: 1px solid transparent;
              padding: 0.375rem 0.75rem;
              font-size: 1rem;
              line-height: 1.5;
              border-radius: 0.25rem;
              transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }
            
            .btn-primary {
              color: #fff;
              background-color: #007bff;
              border-color: #007bff;
            }

            .btn-primary:hover {
              color: #fff;
              background-color: #0069d9;
              border-color: #0062cc;
            }

            .btn-primary:focus, .btn-primary.focus {
              color: #fff;
              background-color: #0069d9;
              border-color: #0062cc;
              box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
            }

            .m-top {
                margin-top: 100px;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="flex-center m-top">
            <img src="{{ url('/assets/img/bridgeug.png') }}" alt="Bridge Gunadarma" height="250" width="auto">
        </div>
        <div class="flex-center">
            <div class="code">
                @yield('code')
            </div>
            <div class="message" style="padding: 10px;">
                @yield('message')
            </div>
        </div>
        <div class="">
            <div class="message">
                <a href="{{ app('router')->has('home') ? route('home') : url('/') }}">
                    <button class="btn btn-primary" style="font-family: 'Trebuchet MS'; width:200px; font-weight:bold;">BACK TO HOME</button>
                </a>
            </div>
        </div>
    </body>
</html>