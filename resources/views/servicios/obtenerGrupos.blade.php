@extends('layouts.web')

@section('titulo')
    Categorias de servicios
@endsection

@section('content')
    @include('partials.alerta')
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