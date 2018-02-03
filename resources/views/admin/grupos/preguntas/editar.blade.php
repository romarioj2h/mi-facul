@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('partials.alerta')
                <form action="{{ route('admin.grupos.preguntas.modificar', ['id' => Request::route('gruposId')]) }}" method="post">
                    <input name="_method" type="hidden" value="patch">
                    <input name="id" type="hidden" value="{{ $pregunta->id }}">
                    @include('admin.grupos.preguntas.formulario')
                    <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                </form>
            </div>
        </div>
    </div>
@endsection