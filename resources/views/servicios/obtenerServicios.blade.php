@extends('layouts.web')

@section('titulo')
    Servicios de {{ $grupo->nombre }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('web.servicios.obtenerGrupos') }}">Servicios</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $grupo->nombre }}</li>
@endsection

@section('content')
    <div class="list-group">
        <a href="{{ route('web.servicio.agregar') }}" class="list-group-item list-group-item-action active">
            <b>Agregar mi servicio</b>
            <i class="fas fa-plus float-right"></i>
        </a>
        @foreach($servicios as $servicio)
            @include('partials.servicioItem')
        @endforeach
    </div>
@endsection