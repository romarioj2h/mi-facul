@extends('layouts.web')

@section('titulo')
    Servicios de {{ $grupo->nombre }}
@endsection

@section('content')
    <div class="list-group">
        @foreach($grupo->servicios as $servicio)
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $servicio->nombre }}</h5>
                    <small style="color: #e9cc14">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half"></i>
                    </small>
                </div>
                <p class="mb-1">{{ $servicio->descripcion }}</p>
                <small>{{ $servicio->localidad }} - <i class="fab fa-whatsapp"></i></small>
            </a>
        @endforeach
    </div>
@endsection