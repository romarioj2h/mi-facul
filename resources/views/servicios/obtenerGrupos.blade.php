@extends('layouts.web')

@section('titulo')
    Categorias de servicios
@endsection

@section('content')
    @include('partials.alerta')
    <form action="{{ route('web.servicios.busca') }}" method="get">
        <div class="form-group">
            <label class="sr-only" for="busqueda">Servicio</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="q" id="busqueda" placeholder="Buscar...">
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
        @foreach($grupos as $grupo)
            <a href="{{ route('web.servicios.obtenerServicios', ['id' => $grupo->id]) }}" class="list-group-item list-group-item-action">{{ $grupo->nombre }}</a>
        @endforeach
    </div>
@endsection