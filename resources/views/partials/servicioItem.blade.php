<a href="{{ route('web.servicio.obtener', ['id' => $servicio->id, 'slug' => $servicio->slug]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
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