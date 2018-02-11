{{ csrf_field() }}
<div class="form-group">
    <label for="nombre">Nombre</label>
    <input required type="text" class="form-control" value="{{ old('nombre', isset($grupo->nombre) ? $grupo->nombre : null) }}" id="nombre" name="nombre" placeholder="Nombre">
</div>
<div class="form-group">
    <label for="descripcion">Descripcion</label>
    <input required type="text" class="form-control" value="{{ old('descripcion', isset($grupo->descripcion) ? $grupo->descripcion : null) }}" id="descripcion" name="descripcion" placeholder="Descripcion">
</div>
<div class="form-group">
    <label for="idioma">Idioma</label>
    <select class="form-control" id="idioma" name="idioma">
        <option @if(old('idioma', isset($grupo->idioma) ? $grupo->idioma : null) == 'pt') selected @endif value="pt">Portugues</option>
        <option @if(old('idioma', isset($grupo->idioma) ? $grupo->idioma : null) == 'es') selected @endif value="es">Espanhol</option>
    </select>
</div>