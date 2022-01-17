<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Belajar3D</title>
    <style>
        .loginn::-webkit-input-placeholder{
            color: #8587b5;
        }
        
        /*support mozilla*/
        .loginn:-moz-input-placeholder{
            color: #8587b5;
        }
        
        /*support internet explorer*/
        .loginn:-ms-input-placeholder{
            color: #8587b5;
        }
        .btn.butlog {
            background: #d6d7e6;
        }
        .btn.butlog:hover{
            background: #aeafce;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white navbar-dark py-4 ">
  <div class="container">
  <a class="navbar-brand" href="#" style="color:#353885; font-size:25px">Belajar3D</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item @yield('menuBeranda')">
        <a class="nav-link " href="/berandaSiswa" style="color:#353885; font-size:18px">
     <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>
<div class="container mt-4" id="">
  @yield('content')
</div>
</body>
</html>
