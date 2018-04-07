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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/materia/bootstrap.min.css">
    <link rel="stylesheet" href="/css/starability-basic.min.css">
    <link rel="stylesheet" href="/css/web.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="/js/web.js"></script>

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-3454733032130094",
            enable_page_level_ads: true
        });
    </script>
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
        .footer {
            padding: 0.5rem 2.5rem;
            border-top: .05rem solid #e5e5e5;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('web.index') }}">
            <img src="/img/favicon.png" width="30" height="30" class="d-inline-block align-top" alt="MiFacul">
            MiFacul
        </a>
        <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link @if(Route::getCurrentRoute()->getName() == 'web.index') active @endif" href="{{ route('web.index') }}">Página inicial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::getCurrentRoute()->getName() == 'grupos.index') active @endif" href="{{ route('grupos.index') }}">Preguntas Medicina</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::getCurrentRoute()->getName() == 'web.servicios.obtenerGrupos') active @endif" href="{{ route('web.servicios.obtenerGrupos') }}">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::getCurrentRoute()->getName() == 'web.contacto') active @endif" href="{{ route('web.contacto') }}">Contacto/Anuncie</a>
                </li>
                @if(\App\Services\Firebase\Autenticacion\AutenticadorHelper::estaLogueado())
                    <li class="nav-item">
                        <span class="nav-link">
                            <b>
                                {{ \App\Services\Firebase\Autenticacion\AutenticadorHelper::obtenerDatos()->nombre }}
                            </b>
                        </span>
                    </li>
                    <li class="nav-item">
                        <b>
                            <a class="nav-link" href="{{ route('web.servicios.mis') }}">Mis servicios</a>
                        </b>
                    </li>
                    <li class="nav-item">
                        <b>
                            <a class="nav-link" href="{{ route('web.logout') }}">Salir</a>
                        </b>
                    </li>
                @else
                    <li class="nav-item">
                        <b>
                            <a class="nav-link" href="{{ route('web.login.obtener') }}">Ingresar</a>
                        </b>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    @if (View::hasSection('breadcrumb'))
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @yield('breadcrumb')
            </ol>
        </nav>
    @endif
    <div class="container">
        <h3 class="text-center">@yield('titulo')</h3>
        <div class="text-center">
            <img src="/img/banner.jpg" class="img-fluid">
        </div>
        <h4 id="resultado" class="text-center text-success"></h4>
        <div class="row justify-content-md-center">
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>
    <footer class="footer">
        <p>
            <a href="{{ route('web.paginas.terminosServicio') }}">Terminos de servicio</a>
            <a class="float-right" href="#">Back to top</a>
        </p>
    </footer>
</body>
</html>