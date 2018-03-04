@extends('layouts.web')

@section('titulo')
    Servicios de {{ $grupo->nombre }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('web.servicios.obtenerGrupos') }}">Servicios</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $grupo->nombre }}</li>
@endsection

@section('content')
    <div class="list-group">
        <a href="{{ route('web.servicio.agregar') }}" class="list-group-item list-group-item-action active">
            <b>Agregar mi servicio</b>
            <i class="fas fa-plus float-right"></i>
        </a>
        @foreach($servicios as $servicio)
            <a href="{{ route('web.servicio.obtener', ['id' => $servicio->id]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $servicio->nombre }}</h5>
                    <small style="color: #e9cc14">
                        @for($i = 1; $i <= floor($servicio->promedioEvaluaciones); $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                        @if (floor($servicio->promedioEvaluaciones).'.5' <= $servicio->promedioEvaluaciones)
                            <i class="fas fa-star-half"></i>
                        @endif
                    </small>
                </div>
                <p class="mb-1">{{ $servicio->descripcion }}</p>
                <small>
                    {{ $servicio->localidad }}
                    @if(!empty($servicio->whatsapp))
                        - <i class="fab fa-whatsapp"></i>
                    @endif
                </small>
            </a>
        @endforeach
    </div>
@endsection