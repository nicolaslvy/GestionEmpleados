@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Gestión de Cargos</h2>

    {{-- Formulario para agregar un nuevo cargo --}}
    <div class="mb-3">
        <label for="nombreCargo" class="form-label">Nuevo Cargo</label>
        <input type="text" id="nombreCargo" class="form-control">
        <button class="btn btn-success mt-2" onclick="crearCargo()">Agregar</button>
    </div>

    {{-- Tabla de Cargos --}}
    <table class="table">
        <thead>
            <tr>
                <th>Cargo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="cargosTable">
            @foreach($cargos as $cargo)
                <tr id="row-{{ $cargo->id }}">
                    <td>
                        <input type="text" value="{{ $cargo->nombre }}" class="form-control" id="input-{{ $cargo->id }}">
                    </td>
                    <td>
                        <button class="btn btn-primary" onclick="actualizarCargo({{ $cargo->id }})">Actualizar</button>
                        <button class="btn btn-danger" onclick="eliminarCargo({{ $cargo->id }})">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
function crearCargo() {
    let nombre = document.getElementById('nombreCargo').value;

    fetch("{{ route('cargos.store') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ nombre: nombre })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let newRow = `
                <tr id="row-${data.cargo.id}">
                    <td><input type="text" value="${data.cargo.nombre}" class="form-control" id="input-${data.cargo.id}"></td>
                    <td>
                        <button class="btn btn-primary" onclick="actualizarCargo(${data.cargo.id})">Actualizar</button>
                        <button class="btn btn-danger" onclick="eliminarCargo(${data.cargo.id})">Eliminar</button>
                    </td>
                </tr>`;
            document.getElementById('cargosTable').innerHTML += newRow;
            document.getElementById('nombreCargo').value = "";
        }
    });
}

function actualizarCargo(id) {
    let nombre = document.getElementById(`input-${id}`).value;

    fetch(`/cargos/${id}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ nombre: nombre })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Cargo actualizado correctamente");
        }
    });
}

function eliminarCargo(id) {
    if (!confirm("¿Seguro que deseas eliminar este cargo?")) return;

    fetch(`/cargos/${id}`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`row-${id}`).remove();
        }
    });
}
</script>
@endsection