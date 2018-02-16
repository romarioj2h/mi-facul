<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="/img/favicon.ico" />

    <title>{{ config('app.name', 'Preguntas') }}</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113894471-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-113894471-1');
    </script>

    <style>
        .jumbotron {
            padding: 2rem 1rem;
        }
        body {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <br>
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <a class="nav-link @if(Route::getCurrentRoute()->getName() == 'web.index') active @endif" href="{{ route('web.index') }}">Página inicial</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(Route::getCurrentRoute()->getName() == 'web.contacto') active @endif" href="{{ route('web.contacto') }}">Contacto/Anuncie</a>
            </li>
        </ul>
        <hr>
        <div class="jumbotron">
            <div class="text-center">
                <img src="/img/banner.jpg" class="img-fluid">
            </div>
            <h3>@yield('titulo')</h3>
            <h4 id="resultado" class="text-center text-success"></h4>
        </div>
        @yield('content')
    </div>
    <br>
    <br>
    <br>
</body>
</html>