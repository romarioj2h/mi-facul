@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('partials.alerta')
                <h1>Contactos</h1>
                <table class="table table-striped">
                    <thead>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Asunto</th>
                        <th>Mensaje</th>
                        <th>#</th>
                    </thead>
                    <tbody>
                    @foreach($contactos as $contacto)
                        <tr class="@if($contacto->estado == \App\Contactos::NUEVA) success @endif">
                            <td>{{ $contacto->nombre }}</td>
                            <td>{{ $contacto->email }}</td>
                            <td>{{ $contacto->asunto }}</td>
                            <td>
                                <pre>{{ $contacto->mensaje }}</pre>
                            </td>
                            <td>
                                @if($contacto->estado == \App\Contactos::NUEVA)
                                    <form action="{{ route('admin.contactos.modificarEstado', ['id' => $contacto->id]) }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="estado" value="leida">
                                        <button class="btn btn-primary">Leído</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $contactos->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection