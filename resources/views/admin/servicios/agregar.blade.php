@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('partials.alerta')
                <form action="{{ route('admin.servicios.guardar') }}" method="post">
                    @include('admin.servicios.formulario')
                    <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                </form>
            </div>
        </div>
    </div>
@endsection