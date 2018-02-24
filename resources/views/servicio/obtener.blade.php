@extends('layouts.web')

@section('titulo')
    {{ $servicio->nombre }}
@endsection

@section('content')
    @include('partials.alerta')
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
    <hr>
    <h3 class="text-center">Comentários</h3>
    <hr>
    @if(!\App\Services\Firebase\Autenticacion\AutenticadorHelper::estaLogueado())
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    Para comentar y evaluar ingrese con
                </h5>
                <p class="card-text">
                    <button onclick="loginPagina.google();" class="btn btn-info">
                        <i class="fab fa-google"></i> Login con Google
                    </button>
                    <button type="button" class="btn btn-info">
                        <i class="fab fa-facebook"></i> Login con Facebook (todo)
                    </button>
                </p>
                <form name="login" action="{{ route('web.login') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="nombre">
                    <input type="hidden" name="email">
                    <input type="hidden" name="foto">
                    <input type="hidden" name="token">
                    <input type="hidden" name="origen">
                </form>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <img style="width: 100px;" src="{{ Session::get('foto') }}" class="img-thumbnail">
                    {{ Session::get('nombre') }}
                </h5>
                <form name="comentar" action="{{ route('web.servicio.comentar', ['id' => $servicio->id]) }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ Session::get('usuarioId') }}" name="usuarioId">
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
                <div class="card-body">
                    <h5 class="card-title">
                        <img style="width: 75px;" src="{{ $comentario->usuario->foto }}" class="img-thumbnail">
                        {{ $comentario->usuario->nombre }}
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ date('d/m/Y', strtotime($comentario->creadoEn)) }}</h6>
                    <p class="card-text">
                        {{ $comentario->comentario }}
                    </p>
                </div>
                <hr>
            @endforeach
        </div>
    @endif

    <script src="https://www.gstatic.com/firebasejs/4.10.0/firebase.js"></script>
    <script>
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyAxZX1xBs7fiu2pgH1EMYOmI09onu-xV9k",
            authDomain: "preguntas-108dc.firebaseapp.com",
            databaseURL: "https://preguntas-108dc.firebaseio.com",
            projectId: "preguntas-108dc",
            storageBucket: "preguntas-108dc.appspot.com",
            messagingSenderId: "304367267543"
        };
        firebase.initializeApp(config);

        var provider = new firebase.auth.GoogleAuthProvider();
        firebase.auth().languageCode = 'es';

        var loginPagina = {
            google: function() {
                firebase.auth().signInWithPopup(provider).then(function(result) {
                    // This gives you a Google Access Token. You can use it to access the Google API.
                    var token = result.credential;
                    // The signed-in user info.
                    var user = result.user;
                    console.log(token);
                    console.log(user);
                    $('form[name="login"]').find('input[name="nombre"]').val(user.displayName);
                    $('form[name="login"]').find('input[name="email"]').val(user.email);
                    $('form[name="login"]').find('input[name="foto"]').val(user.photoURL);
                    $('form[name="login"]').find('input[name="origen"]').val('google');
                    firebase.auth().currentUser.getIdToken(/* forceRefresh */ true).then(function(idToken) {
                        $('form[name="login"]').find('input[name="token"]').val(idToken);
                        $('form[name="login"]').submit();
                    }).catch(function(error) {
                        // Handle error
                    });
                }).catch(function(error) {
                    // Handle Errors here.
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    // The email of the user's account used.
                    var email = error.email;
                    // The firebase.auth.AuthCredential type that was used.
                    var credential = error.credential;
                    alert(errorMessage);
                    console.log(error);
                    // ...
                });
            }
        }
    </script>
@endsection