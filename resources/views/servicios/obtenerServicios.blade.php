@extends('layouts.web')

@section('titulo')
    Servicios de {{ $grupo->nombre }}
@endsection

@section('content')
    <div class="list-group">
        @foreach($grupo->servicios as $servicio)
            <a href="#" class="list-group-item list-group-item-action">{{ $servicio->nombre }}</a>
        @endforeach
    </div>
@endsection