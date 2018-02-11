@extends('layouts.web')

@section('titulo')
    Contacto
@endsection

@section('content')
    <p>Contactese para anunciar en nuestro sitio</p>
    @include('partials.alerta')
    <form action="{{ route('web.contacto.guardar') }}" method="post" name="contato">
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group col">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="form-group col">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
        </div>
        <div class="form-group">
            <label for="asunto">Asunto</label>
            <input type="text" class="form-control" id="asunto" name="asunto">
        </div>
        <div class="form-group">
            <label for="mensaje">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
@endsection