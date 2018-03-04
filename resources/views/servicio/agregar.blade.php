@extends('layouts.web')

@section('titulo')
    Agregar servicio
@endsection

@section('content')
    @include('partials.alerta')
    <form action="{{ route('web.servicio.guardar') }}" method="post">
        @include('servicio.formulario')
        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
    </form>
@endsection