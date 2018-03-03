@extends('layouts.web')

@section('titulo')
    {{ $servicio->nombre }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('web.servicios.obtenerGrupos') }}">Servicios</a></li>
    <li class="breadcrumb-item"><a href="{{ route('web.servicios.obtenerServicios', ['id' => $servicio->grupos->id]) }}">{{ $servicio->grupos->nombre }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $servicio->nombre }}</li>
@endsection

@section('content')
    @include('partials.alerta')

    <div class="card col-md-12">
        <div class="card-body">
            <h5 class="card-title">
                {{ $servicio->nombre }}
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
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">
                        {{ number_format($servicio->promedioEvaluaciones, 1, '.', '') }}
                        <span style="color: #e9cc14">
                        @for($i = 1; $i <= floor($servicio->promedioEvaluaciones); $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                            @if (floor($servicio->promedioEvaluaciones).'.5' <= $servicio->promedioEvaluaciones)
                                <i class="fas fa-star-half"></i>
                            @endif
                    </span>
                    <br>
                    {{ $servicio->evaluaciones->count() }} avaliaciones
                    </h4>
                    <small class="align-content-center">
                        @if(\App\Services\Firebase\Autenticacion\AutenticadorHelper::estaLogueado())
                            <button class="btn btn-info" data-toggle="modal" data-target="#evaluar">Evaluar</button>
                        @else
                            <button onclick="document.getElementById('card-login').scrollIntoView();" class="btn btn-info">Loguese para evaluar!</button onclick="document.getElementById('card-login').scrollIntoView();" >
                        @endif
                    </small>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3 class="text-center">Comentários</h3>
    <hr>
    @if(!\App\Services\Firebase\Autenticacion\AutenticadorHelper::estaLogueado())
        @include('partials.socialLogin', ['titulo' => 'Para comentar y evaluar ingrese con'])
    @else
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <img style="width: 100px;" src="{{ \App\Services\Firebase\Autenticacion\AutenticadorHelper::obtenerDatos()->foto }}" class="img-thumbnail">
                    {{ \App\Services\Firebase\Autenticacion\AutenticadorHelper::obtenerDatos()->nombre }}
                </h5>
                <form name="comentar" action="{{ route('web.servicio.comentar', ['id' => $servicio->id]) }}" method="post">
                    {{ csrf_field() }}
                    <textarea class="form-control" name="comentario" id="" cols="30" rows="4" placeholder="Escriba su comentário acá"></textarea>
                    <button style="margin-top: 10px;" class="btn btn-info float-right">Comentar</button>
                </form>
            </div>
        </div>
    @endif
    @if($servicio->comentarios->count() > 0)
        <hr>
        <div class="card">
            @foreach($servicio->comentarios as $comentario)
                <div style="padding: 1rem;" class="card-body row">
                    <div class="col-md-3">
                        <h5 class="card-title">
                            <img style="width: 60px;" src="{{ $comentario->usuario->foto }}" class="img-thumbnail">
                            {{ $comentario->usuario->nombre }}
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ date('d/m/Y', strtotime($comentario->creadoEn)) }}</h6>
                    </div>
                    <p class="card-text col-md-9">
                        {{ $comentario->comentario }}
                    </p>
                </div>
                <hr>
            @endforeach
        </div>
    @endif

    @if(\App\Services\Firebase\Autenticacion\AutenticadorHelper::estaLogueado())
        <div class="modal fade" id="evaluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('web.servicio.evaluar', ['id' => $servicio->id]) }}" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Que tal te pareció este servicio?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                {{ csrf_field() }}
                                <fieldset class="starability-basic">
                                    <input type="radio" id="no-rate" class="input-no-rate" name="valor" value="0" checked aria-label="No rating." />
                                    <input {{ (isset($evaluacion) && $evaluacion->valor == '1')? 'checked' : '' }} type="radio" id="first-rate1" name="valor" value="1" />
                                    <label for="first-rate1" title="Horríble">1 estrella</label>
                                    <input {{ (isset($evaluacion) && $evaluacion->valor == '2')? 'checked' : '' }} type="radio" id="first-rate2" name="valor" value="2" />
                                    <label for="first-rate2" title="Malo">2 estrellas</label>
                                    <input {{ (isset($evaluacion) && $evaluacion->valor == '3')? 'checked' : '' }} type="radio" id="first-rate3" name="valor" value="3" />
                                    <label for="first-rate3" title="Médio">3 estrellas</label>
                                    <input {{ (isset($evaluacion) && $evaluacion->valor == '4')? 'checked' : '' }} type="radio" id="first-rate4" name="valor" value="4" />
                                    <label for="first-rate4" title="Bueno">4 estrellas</label>
                                    <input {{ (isset($evaluacion) && $evaluacion->valor == '5')? 'checked' : '' }} type="radio" id="first-rate5" name="valor" value="5" />
                                    <label for="first-rate5" title="Increíble">5 estrellas</label>
                                </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Evaluar!</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection