 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif (session()->has('mensage'))
    <div class="alert alert-{{ session()->get('mensage')['tipo'] }}">
        {{ session()->get('mensage')['mensage'] }}
    </div>
@endif