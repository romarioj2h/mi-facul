@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('partials.alerta')
                <h1>Grupos
                    <a href="{{ route('admin.grupos.agregar') }}" class="btn btn-primary pull-right">Agregar</a>
                </h1>
                <table class="table table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Opciones</th>
                    </thead>
                    <tbody>
                    @foreach($grupos as $grupo)
                        <tr>
                            <td>{{ $grupo->id }}</td>
                            <td>{{ $grupo->nombre }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Acciones">
                                    <a href="{{ route('admin.grupos.editar', ['id' => $grupo->id]) }}" type="button" class="btn btn-default">Editar</a>
                                    <a href="{{ route('admin.grupos.preguntas.index', ['gruposId' => $grupo->id]) }}" type="button" class="btn btn-default">Preguntas</a>
                                </div>
                                -----
                                <a href="{{ route('admin.grupos.borrar', ['id' => $grupo->id]) }}" type="button" class="btn btn-danger">Borrar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $grupos->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection