@extends('layouts.web')

@section('titulo')
    Editar servicio
@endsection

@section('content')
    @include('partials.alerta')
    <form action="{{ route('web.servicio.guardar') }}" method="post" enctype="multipart/form-data">
        <input name="_method" type="hidden" value="patch">
        <input name="id" type="hidden" value="{{ $servicio->id }}">
        @include('servicio.formulario')
        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
    </form>
@endsection