@extends('layouts.web')

@section('titulo')
    Categorias de servicios
@endsection

@section('content')
    <div class="list-group">
        @foreach($grupos as $grupo)
            <a href="{{ route('web.servicios.obtenerServicios', ['id' => $grupo->id]) }}" class="list-group-item list-group-item-action">{{ $grupo->nombre }}</a>
        @endforeach
    </div>
@endsection