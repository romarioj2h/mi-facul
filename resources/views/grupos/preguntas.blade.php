@extends('layouts.web')

@section('content')
    @foreach($preguntas as $pregunta)
        <ul class="list-group">
            <li class="list-group-item"><b>{{$pregunta->getKey()}}. {{ $pregunta->pregunta }}</b></li>
            @foreach($pregunta->respuestas() as $key => $respuesta)
                <li class="list-group-item @if($key == $pregunta->respuestaCorrecta)respuesta_correcta @endif">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="preguntas[{{ $pregunta->id }}]" id="respuesta_{{ $pregunta->id }}_{{ $key }}" value="{{ $key }}" checked>
                        <label class="form-check-label" for="respuesta_{{ $pregunta->id }}_{{ $key }}">
                            {{$key}}. {{ $respuesta }}
                        </label>
                    </div>
                </li>
            @endforeach
        </ul>
        <hr>
    @endforeach
    <button id="ver-resultado" class="btn btn-primary float-right">Ver resultado!</button>
    <br>
    <br>
    <br>
    <script>
        var cantidadPreguntas = {!! $preguntas->count() !!};
        $(function() {
            $(document).on('click', '#ver-resultado', function () {
                var cantidadIncorrecta = 0;
                $('.list-group-item').css('background-color', '#ffffff');
                $('input[name^=preguntas]:checked').each(function (index, item) {
                    if (!$(item).parents('.list-group-item').hasClass('respuesta_correcta')) {
                        $(item).parents('.list-group-item').css('background-color', '#f8d7da');
                        cantidadIncorrecta++;
                    }
                });
                $('.respuesta_correcta').css('background-color', '#d4edda');
                $('#resultado').html(cantidadPreguntas-cantidadIncorrecta+' acertos de '+cantidadPreguntas+' preguntas');
                $('html,body').animate({
                    scrollTop: $("body").offset().top},
                'slow');
            });
        });
    </script>
@endsection