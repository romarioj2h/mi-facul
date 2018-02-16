@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('partials.alerta')
                <h1>Servicios
                    <a href="{{ route('admin.servicios.agregar') }}" class="btn btn-primary pull-right">Agregar</a>
                </h1>
                <table class="table table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Grupo</th>
                    <th>Opciones</th>
                    </thead>
                    <tbody>
                    @foreach($servicios as $servicio)
                        <tr>
                            <td>{{ $servicio->id }}</td>
                            <td>{{ $servicio->nombre }}</td>
                            <td>{{ $servicio->grupos->nombre }}</td>
                            <td>
                                <a href="{{ route('admin.servicios.editar', ['id' => $servicio->id]) }}" class="btn btn-warning">Editar</a>
                                -----
                                <a href="{{ route('admin.servicios.borrar', ['id' => $servicio->id]) }}" class="btn btn-danger">Borrar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $servicios->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection