@extends('layouts.web')

@section('titulo')
    Listas de preguntas
@endsection

@section('content')
    <div class="list-group">
        @foreach($grupos as $grupo)
            <a href="{{ route('grupos.obtenerPreguntas', ['id' => $grupo->id]) }}" class="list-group-item list-group-item-action">{{ $grupo->nombre }}</a>
        @endforeach
    </div>
@endsection