@extends('layouts.web')

@section('titulo')
    Listas de preguntas
@endsection

@section('content')
    <div class="list-group">
        @foreach($grupos as $grupo)<a href="{{ route('grupos.obtenerPreguntas', ['id' => $grupo->id]) }}" class="list-group-item list-group-item-action">
            <img src="/img/idiomas/{{ $grupo->idioma }}.png" style="width: 34px; height: 22px;"> - {{ $grupo->nombre }}</a>
        @endforeach
    </div>
@endsection