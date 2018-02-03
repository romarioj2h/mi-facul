{{ csrf_field() }}
<div class="form-group">
    <label for="pregunta">Pregunta</label>
    <input required type="text" class="form-control" value="{{ old('pregunta', isset($pregunta->pregunta) ? $pregunta->pregunta : null) }}" id="pregunta" name="pregunta" placeholder="Pregunta">
</div>
<div class="form-group">
    <label for="respuesta1">Respuesta 1</label>
    <input required type="text" class="form-control" value="{{ old('respuesta1', isset($pregunta->respuesta1) ? $pregunta->respuesta1 : null) }}" id="respuesta1" name="respuesta1" placeholder="Respuesta 1">
</div>
<div class="form-group">
    <label for="respuesta2">Respuesta 2</label>
    <input type="text" class="form-control" value="{{ old('respuesta2', isset($pregunta->respuesta2) ? $pregunta->respuesta2 : null) }}" id="respuesta2" name="respuesta2" placeholder="Respuesta 2">
</div>
<div class="form-group">
    <label for="respuesta3">Respuesta 3</label>
    <input type="text" class="form-control" value="{{ old('respuesta3', isset($pregunta->respuesta3) ? $pregunta->respuesta3 : null) }}" id="respuesta3" name="respuesta3" placeholder="Respuesta 3">
</div>
<div class="form-group">
    <label for="respuesta4">Respuesta 4</label>
    <input type="text" class="form-control" value="{{ old('respuesta4', isset($pregunta->respuesta4) ? $pregunta->respuesta4 : null) }}" id="respuesta4" name="respuesta4" placeholder="Respuesta 4">
</div>
<div class="form-group">
    <label for="respuestaCorrecta">Respuesta correcta</label>
    <input type="number" max="4" min="1" class="form-control" value="{{ old('respuestaCorrecta', isset($pregunta->respuestaCorrecta) ? $pregunta->respuestaCorrecta : null) }}" id="respuestaCorrecta" name="respuestaCorrecta" placeholder="Respuesta 4">
</div>