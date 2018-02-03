@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('partials.alerta')
                <h1>Preguntas
                    <a href="{{ route('admin.grupos.preguntas.agregar', ['gruposId' => $grupo->id]) }}" class="btn btn-primary pull-right">Agregar</a>
                </h1>
                <table class="table table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Pregunta</th>
                    <th>Opciones</th>
                    </thead>
                    <tbody>
                    @foreach($preguntas as $pregunta)
                        <tr>
                            <td>{{ $pregunta->id }}</td>
                            <td>{{ $pregunta->pregunta }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Acciones">
                                    <a href="{{ route('admin.grupos.preguntas.editar', ['id' => $pregunta->id, 'gruposId' => $grupo->id]) }}" type="button" class="btn btn-default">Editar</a>
                                </div>
                                -----
                                <a href="{{ route('admin.grupos.preguntas.borrar', ['gruposId' => $grupo->id, 'id' => $pregunta->id]) }}" type="button" class="btn btn-danger">Borrar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $preguntas->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection