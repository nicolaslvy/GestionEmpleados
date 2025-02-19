@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Empleado</h2>
    
    <form action="{{ route('empleados.update', $empleado) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres" value="{{ old('nombres', $empleado->nombres) }}" required>
        </div>

        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos', $empleado->apellidos) }}" required>
        </div>

        <div class="mb-3">
            <label for="identificacion" class="form-label">Identificación</label>
            <input type="text" class="form-control" id="identificacion" name="identificacion" value="{{ old('identificacion', $empleado->identificacion) }}" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $empleado->direccion) }}">
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $empleado->telefono) }}">
        </div>

        <div class="mb-3">
            <label for="ciudad_nacimiento" class="form-label">Ciudad de Nacimiento</label>
            <input type="text" class="form-control" id="ciudad_nacimiento" name="ciudad_nacimiento" value="{{ old('ciudad_nacimiento', $empleado->ciudad_nacimiento) }}">
        </div>

        <div class="mb-3">
            <label for="cargos" class="form-label">Cargos</label>
            <select multiple class="form-control" id="cargos" name="cargos[]">
                @foreach($cargos as $cargo)
                    <option value="{{ $cargo->id }}" {{ $empleado->cargos->contains($cargo->id) ? 'selected' : '' }}>
                        {{ $cargo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jefes" class="form-label">Jefes</label>
            <select multiple class="form-control" id="jefes" name="jefes[]">
                @foreach($jefes as $jefe)
                    <option value="{{ $jefe->id }}" {{ $empleado->jefes->contains($jefe->id) ? 'selected' : '' }}>
                        {{ $jefe->nombres }} {{ $jefe->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection