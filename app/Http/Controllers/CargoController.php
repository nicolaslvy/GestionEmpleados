<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
class CargoController extends Controller
{
    public function index()
    {
        $cargos = Cargo::all();
        return view('cargos.index', compact('cargos'));
    }

    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required|string|unique:cargos,nombre']);

        $cargo = Cargo::create(['nombre' => $request->nombre]);

        return response()->json(['success' => true, 'cargo' => $cargo]);
    }

    public function update(Request $request, Cargo $cargo)
    {
        $request->validate(['nombre' => 'required|string|unique:cargos,nombre,' . $cargo->id]);

        $cargo->update(['nombre' => $request->nombre]);

        return response()->json(['success' => true, 'cargo' => $cargo]);
    }

    public function destroy(Cargo $cargo)
    {
        $cargo->delete();

        return response()->json(['success' => true]);
    }
}
