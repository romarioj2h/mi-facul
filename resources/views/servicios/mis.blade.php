@extends('layouts.web')

@section('titulo')
    Servicios de {{ \App\Services\Firebase\Autenticacion\AutenticadorHelper::obtenerDatos()->nombre }}
@endsection

@section('content')
    @include('partials.alerta')
    <div class="list-group" id="servicios">
        <a href="{{ route('web.servicio.agregar') }}" class="list-group-item list-group-item-action active">
            <b>Agregar mi servicio</b>
            <i class="fas fa-plus float-right"></i>
        </a>
        @foreach($servicios as $servicio)
            <div class="list-group-item list-group-item-action flex-column align-items-start  @if($servicio->estado == \App\Servicios::ESTADO_PENDIENTE) list-group-item-warning @elseif($servicio->estado == \App\Servicios::ESTADO_RECHAZADO) list-group-item-danger @endif">
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
                <div class="d-flex w-100 justify-content-between">
                    <h6>Estado: {{ $servicio->estado }}</h6>
                </div>
                <div class="d-flex w-100 justify-content-between">
                    <div class="btn-group" role="group">
                        @if ($servicio->estado == \App\Servicios::ESTADO_APROBADO)
                            <a href="{{ route('web.servicio.obtener', ['id' => $servicio->id, 'slug' => $servicio->slug]) }}" class="btn btn-link">Ver</a>
                        @endif
                        <a href="{{ route('web.servicio.editar', ['id' => $servicio->id]) }}" class="btn btn-link">Editar</a>
                        <button onclick="confirm('Está seguro que deseas borrar tu servicio?') && (location.href = '{{ route('web.servicio.borrar', ['id' => $servicio->id]) }}')" type="button" class="btn btn-link">Borrar</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection