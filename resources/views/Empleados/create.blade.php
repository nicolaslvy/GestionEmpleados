@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Nuevo Empleado</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres" required>
        </div>

        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
        </div>

        <div class="mb-3">
            <label for="identificacion" class="form-label">Identificación</label>
            <input type="text" class="form-control" id="identificacion" name="identificacion" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
        </div>

        <div class="mb-3">
            <label for="ciudad_nacimiento" class="form-label">Ciudad de Nacimiento</label>
            <input type="text" class="form-control" id="ciudad_nacimiento" name="ciudad_nacimiento" required>
        </div>

        <div class="mb-3">
            <label for="cargo_id" class="form-label">Cargos</label>
            <select class="form-control" id="cargo_id" name="cargos[]" multiple required>
                @foreach ($cargos as $cargo)
                    <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jefe_id" class="form-label">Jefes</label>
            <select class="form-control" id="jefe_id" name="jefe_id[]" multiple>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->id }}">{{ $empleado->nombres }} {{ $empleado->apellidos }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

    <script>
document.addEventListener("DOMContentLoaded", function() {
    let selectCargos = document.getElementById("cargos");
    let selectJefes = document.getElementById("jefes");

    selectCargos.addEventListener("change", function() {
        let opciones = Array.from(selectCargos.selectedOptions).map(opt => opt.text);
        if (opciones.includes("Presidente")) {
            selectJefes.disabled = true;
            selectJefes.value = ""; 
        } else {
            selectJefes.disabled = false;
        }
    });
});
</script>
</div>

@endsection