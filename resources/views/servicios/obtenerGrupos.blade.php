@extends('layouts.web')

@section('titulo')
    Grupos de servicios
@endsection

@section('content')
    <div class="list-group">
        @foreach($grupos as $grupo)
            <a href="#" class="list-group-item list-group-item-action">{{ $grupo->nombre }}</a>
        @endforeach
    </div>
@endsection