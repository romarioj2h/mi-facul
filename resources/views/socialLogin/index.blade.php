@extends('layouts.web')

@section('titulo')
    Login
@endsection

@section('content')
    @include('partials.socialLogin', ['titulo' => 'Login con redes sociales para comentar, evaluar y cargar servicios'])
@endsection