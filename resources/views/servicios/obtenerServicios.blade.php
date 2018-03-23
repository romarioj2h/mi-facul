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
        <div class="list-group-item list-group-item-action">
            <div class="float-right">
                <a href="{{ route('web.servicios.obtenerServicios', ['id' => $grupo->id, 'order' => 'mejorEvaluado']) }}">
                    Mejor evaluado
                    <i class="fas fa-sort-numeric-up"></i>
                </a>
                <a href="{{ route('web.servicios.obtenerServicios', ['id' => $grupo->id, 'order' => 'peorEvaluado']) }}">
                    Peor evaluado
                    <i class="fas fa-sort-numeric-down"></i>
                </a>
            </div>
        </div>
        @foreach($servicios as $servicio)
            @include('partials.servicioItem')
        @endforeach
    </div>
@endsection