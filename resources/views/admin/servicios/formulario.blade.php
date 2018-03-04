{{ csrf_field() }}
<div class="form-group">
    <label for="nombre">Nombre</label>
    <input required type="text" class="form-control" value="{{ old('nombre', isset($servicio->nombre) ? $servicio->nombre : null) }}" id="nombre" name="nombre">
</div>
<div class="form-group">
    <label for="descripcion">Descripcion</label>
    <input required type="text" class="form-control" value="{{ old('descripcion', isset($servicio->descripcion) ? $servicio->descripcion : null) }}" id="descripcion" name="descripcion">
</div>
<div class="form-group">
    <label for="telefonos">Telefonos (separados por coma)</label>
    <input required type="text" class="form-control" value="{{ old('telefonos', isset($servicio->telefonos) ? $servicio->telefonos : null) }}" id="telefonos" name="telefonos">
</div>
<div class="form-group">
    <label for="whatsapp">WhatsApp</label>
    <input required type="text" class="form-control" value="{{ old('whatsapp', isset($servicio->whatsapp) ? $servicio->whatsapp : null) }}" id="whatsapp" name="whatsapp">
</div>
<div class="form-group">
    <label for="facebook">Facebook</label>
    <input required type="text" class="form-control" value="{{ old('facebook', isset($servicio->facebook) ? $servicio->facebook : null) }}" id="facebook" name="facebook">
</div>
<div class="form-group">
    <label for="direccion">Dirección</label>
    <input required type="text" class="form-control" value="{{ old('direccion', isset($servicio->direccion) ? $servicio->direccion : null) }}" id="direccion" name="direccion">
</div>
<div class="form-group">
    <label for="localidad">Localidad</label>
    <select class="form-control" id="localidad" name="localidad">
        <option @if(old('localidad', isset($servicio->localidad) ? $servicio->localidad : null) == 'Rosario') selected @endif value="Rosario">Rosario</option>
        <option @if(old('localidad', isset($servicio->localidad) ? $servicio->localidad : null) == 'Buenos Aires') selected @endif value="Buenos Aires">Buenos Aires</option>
    </select>
</div>
<div class="form-group">
    <label for="serviciosGruposId">Grupo</label>
    <select class="form-control" id="serviciosGruposId" name="serviciosGruposId">
        @foreach($grupos as $grupo)
            <option @if(old('serviciosGruposId', isset($servicio->serviciosGruposId) ? $servicio->serviciosGruposId : null) == $grupo->id) selected @endif value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
        @endforeach
    </select>
</div>