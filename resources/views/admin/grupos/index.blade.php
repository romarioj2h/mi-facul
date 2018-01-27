@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('partials.alerta')
                <h1>Localidades
                    {{--<a href="{{ route('admin.localidad.agregar') }}" class="btn btn-primary pull-right">Agregar</a>--}}
                </h1>
                <table class="table table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Longitud</th>
                    <th>Latitud</th>
                    <th>Opciones</th>
                    </thead>
                    <tbody>
                    @foreach($grupos as $localidad)
                        <tr>
                            <td>{{ $localidad->id }}</td>
                            <td>{{ $localidad->nombre }}</td>
                            <td>{{ $localidad->longitud }}</td>
                            <td>{{ $localidad->latitud }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Acciones">
{{--                                    <a href="{{ route('admin.localidad.editar', ['id' => $localidad->id]) }}" type="button" class="btn btn-default">Editar</a>--}}
{{--                                    <a href="{{ route('admin.localidad.puntoEvacuacion.index', ['id' => $localidad->id]) }}" type="button" class="btn btn-default">Puntos Ev.</a>--}}
                                </div>
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