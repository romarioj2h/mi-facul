@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('partials.alerta')
                <h1>Servicios
                    <a href="{{ route('admin.servicios.agregar') }}" class="btn btn-primary pull-right">Agregar</a>
                </h1>
                <table class="table table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Grupo</th>
                    <th>Usuario</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                    </thead>
                    <tbody>
                    @foreach($servicios as $servicio)
                        <tr>
                            <td>{{ $servicio->id }}</td>
                            <td>{{ $servicio->nombre }}</td>
                            <td>{{ $servicio->grupos->nombre }}</td>
                            <td>
                                @if(is_object($servicio->usuarios))
                                    {{ $servicio->usuarios->nombre }}
                                @endif
                            </td>
                            <td>{{ $servicio->estado }}</td>
                            <td>
                                <a href="{{ route('admin.servicios.editar', ['id' => $servicio->id]) }}" class="btn btn-warning">Editar</a>
                                @if($servicio->estado != \App\Servicios::ESTADO_APROBADO)
                                    <a href="{{ route('admin.servicios.aprobar', ['id' => $servicio->id]) }}" class="btn btn-success">Aprobar</a>
                                @endif
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