@extends('layouts.web')

@section('header')
    <meta property="og:url" content="https://mifacul.xyz/" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="MiFacul - Servicios brasileros y argentinos" />
    <meta property="og:description" content="Encuentre los servicios de comida, transporte, clases, belleza. Site creado por Brasileros para Argentinos y Brasileros" />
    <meta property="og:image" content="https://mifacul.xyz/img/favicon.png" />
@endsection

@section('titulo')
    Sitio MiFacul
@endsection

@section('content')
    <form action="{{ route('web.servicios.busca') }}" method="get">
        <div class="form-group">
            <label class="sr-only" for="busqueda">Servicio</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="q" id="busqueda" placeholder="Buscar servicios...">
                <div class="input-group-append">
                    <button style="width: 140px;" type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </form>
    <div class="row align-items-center">
        <div class="col-6 mx-auto col-md-6 order-md-2">
            <img class="img-fluid mb-3 mb-md-0" src="/img/favicon.png" alt="" width="1024" height="860">
        </div>
        <div class="col-md-6 order-md-1 text-center text-md-left pr-md-5">
            <h1 class="mb-3 bd-text-purple-bright">MiFacul</h1>
            <p class="lead">
                Un sitio completo donde usted puede encontrar servicios de todos tipos, ademas encontras unas preguntitas para entrenar para la facul!
            </p>
            <p class="lead mb-4">
                Para responder las preguntas no hace falta nada, simplesmente ingrese a la sección de preguntas.
                <br>
                Para crear servicios, comentar servicios y evaluar servicios, podes logear usando sus cuentas de Google o Facebook. En los servicios podes poner su pagina de Facebook o su numero para WhatsApp y subir una imagen para lo que quieras.
            </p>
            <div class="d-flex flex-column flex-md-row lead mb-3">
                <a href="{{ route('grupos.index') }}" class="btn btn-lg btn-outline-primary mb-3 mb-md-0 mr-md-3">Preguntas</a>
                <a href="{{ route('web.servicios.obtenerGrupos') }}" class="btn btn-lg btn-outline-primary">Servicios</a>
            </div>
            <p class="lead mb-4">
                Contactese para sugerencias y anunciar en nuestro sitio
            </p>
            <div class="d-flex flex-column flex-md-row lead mb-3">
                <a href="{{ route('web.contacto') }}" class="btn btn-lg btn-outline-primary mb-3 mb-md-0 mr-md-3">Contactar</a>
            </div>
            <p class="text-muted mb-0">
                v1.0.0
            </p>
        </div>
    </div>
@endsection