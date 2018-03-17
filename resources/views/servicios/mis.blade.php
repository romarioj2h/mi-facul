@extends('layouts.web')

@section('titulo')
    Servicios de {{ \App\Services\Firebase\Autenticacion\AutenticadorHelper::obtenerDatos()->nombre }}
@endsection

@section('content')
    @include('partials.alerta')
    <div class="list-group" id="servicios">
        <a href="{{ route('web.servicio.agregar') }}" class="list-group-item list-group-item-action active">
            <b>Agregar mi servicio</b>
            <i class="fas fa-plus float-right"></i>
        </a>
        @foreach($servicios as $servicio)
            @include('partials.servicioItem')
        @endforeach
    </div>
@endsection