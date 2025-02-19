@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Empleados</h1>
    <a href="{{ route('empleados.create') }}" class="btn btn-primary">Agregar Empleado</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Identificación</th>
                <th>Cargos</th>
                <th>Jefe</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nombres }} {{ $empleado->apellidos }}</td>
                    <td>{{ $empleado->identificacion }}</td>
                    <td>{{ implode(', ', $empleado->cargos->pluck('nombre')->toArray()) }}</td>
                    <td>
                    @if($empleado->jefes->isNotEmpty())
                      @foreach($empleado->jefes as $jefe)
                     {{ $jefe->nombres }}@if (!$loop->last), @endif
                    @endforeach
                    @else
                        N/A
                    @endif


                    </td>
                    <td>
                        <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('¿Seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection