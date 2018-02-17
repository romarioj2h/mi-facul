@extends('layouts.web')

@section('titulo')
    {{ $servicio->nombre }}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ $servicio->nombre }}
                <small class="float-right" style="color: #e9cc14">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half"></i>
                </small>
            </h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $servicio->grupos->nombre }}</h6>
            <p class="card-text">
                {{ $servicio->descripcion }}
            </p>
            @if(!empty($servicio->whatsapp))
                <a href="https://api.whatsapp.com/send?phone={{ preg_replace("/[^0-9,.]/", "", $servicio->whatsapp) }}" class="card-link">
                    <i class="fab fa-whatsapp"></i> {{ $servicio->whatsapp }}
                </a>
            @endif
            @foreach($servicio->telefonos() as $telefono)
                <a href="tel:{{ $telefono }}" class="card-link">
                    <i class="fas fa-phone"></i> {{ $telefono }}
                </a>
            @endforeach
        </div>
    </div>
@endsection