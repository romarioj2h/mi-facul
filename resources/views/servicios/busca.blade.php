@extends('layouts.web')

@section('titulo')
    Resultados para {{ $terminoDeBusqueda }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('web.servicios.obtenerGrupos') }}">Servicios</a></li>
    <li class="breadcrumb-item active" aria-current="page">Búsqueda</li>
@endsection

@section('content')
    <form action="{{ route('web.servicios.busca') }}" method="get">
        <div class="form-group">
            <label class="sr-only" for="busqueda">Servicio</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="q" id="busqueda" placeholder="Buscar..." value="{{ $terminoDeBusqueda }}">
                <div class="input-group-append">
                    <button style="width: 140px;" type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </form>
    <div class="list-group">
        <a href="{{ route('web.servicio.agregar') }}" class="list-group-item list-group-item-action active">
            <b>Agregar mi servicio</b>
            <i class="fas fa-plus float-right"></i>
        </a>
        <div class="list-group-item list-group-item-action">
            <div class="float-right">
                <a href="{{ route('web.servicios.busca', ['q' => $terminoDeBusqueda, 'order' => 'mejorEvaluado']) }}">
                    Mejor evaluado
                    <i class="fas fa-sort-numeric-up"></i>
                </a>
                <a href="{{ route('web.servicios.busca', ['q' => $terminoDeBusqueda, 'order' => 'peorEvaluado']) }}">
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