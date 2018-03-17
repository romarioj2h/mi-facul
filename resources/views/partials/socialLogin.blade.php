<div class="card" id="card-login">
    <div class="card-body">
        <h5 class="card-title">
            {{ $titulo }}
        </h5>
        <div id="botonesLogin" class="row">
            <div style="padding-top: 5px" class="col-md-6 align-content-center">
                <button onclick="loginPagina.google();" class="btn btn-info">
                    <i class="fab fa-google"></i> Google
                </button>
            </div>
            <div style="padding-top: 5px" class="col-md-6 align-content-center">
                <button onclick="loginPagina.facebook()" type="button" class="btn btn-info">
                    <i class="fab fa-facebook"></i> Facebook
                </button>
            </div>
        </div>
        <div style="margin-top: 15px; display: none;" id="errorLogin" class="alert alert-danger" role="alert">
            <p>Estamos con problemas para realizar el login, si posible contactese con nosotros!</p>
            <a href="{{ route('web.login.obtener') }}">Refrescar pagina y volver a intentar</a>
        </div>
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

    var googleProvider = new firebase.auth.GoogleAuthProvider();
    var facebookProvider = new firebase.auth.FacebookAuthProvider();
    firebase.auth().languageCode = 'es';

    var loginPagina = {
        google: function() {
            web.tapa.show();
            firebase.auth().signInWithPopup(googleProvider).then(function(result) {
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
                    $('#botonesLogin').hide();
                    $('#errorLogin').show();
                    web.tapa.remove();
                });
            }).catch(function(error) {
                $('#botonesLogin').hide();
                $('#errorLogin').show();
                web.tapa.remove();
            });
        },
        facebook: function () {
            web.tapa.show();
            firebase.auth().signInWithPopup(facebookProvider).then(function(result) {
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
                    $('#botonesLogin').hide();
                    $('#errorLogin').show();
                    web.tapa.remove();
                });
            }).catch(function(error) {
                $('#botonesLogin').hide();
                $('#errorLogin').show();
                web.tapa.remove();
            });
        }
    }
</script>