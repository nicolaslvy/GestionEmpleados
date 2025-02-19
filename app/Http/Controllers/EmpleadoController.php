<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Cargo;
class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('cargos', 'jefes')->where('activo', true)->get();
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        $cargos = Cargo::all();
        $empleados = Empleado::all(); // Para seleccionar jefes
        return view('empleados.create', compact('cargos', 'empleados'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'identificacion' => 'required|unique:empleados',
            'direccion' => 'required',
            'telefono' => 'required',
            'ciudad_nacimiento' => 'required',
            'jefe_id' => 'nullable|exists:empleados,id',
            'cargos' => 'required|array'
        ]);

        $empleado = Empleado::create($data);
        $empleado->cargos()->sync($request->cargos);

        return redirect()->route('empleados.index');
    }

    public function edit(Empleado $empleado)
    {
        $cargos = Cargo::all();
        $jefes = Empleado::where('id', '!=', $empleado->id)->get(); // Excluir al mismo empleado
        return view('empleados.edit', compact('empleado', 'cargos', 'jefes'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'identificacion' => 'required|string|max:50|unique:empleados,identificacion,' . $empleado->id,
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'ciudad_nacimiento' => 'nullable|string|max:100',
            'cargos' => 'required|array',
            'jefes' => 'nullable|array',
        ]);
    
        // Actualizar datos del empleado
        $empleado->update($request->only(['nombres', 'apellidos', 'identificacion', 'direccion', 'telefono', 'ciudad_nacimiento']));
    
        // Sincronizar Cargos
        $empleado->cargos()->sync($request->cargos);
    
        // Sincronizar Jefes
        $empleado->jefes()->sync($request->jefes ?? []);
    
        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->update(['activo' => false]);
        return redirect()->route('empleados.index');
    }
}
