<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movement;
use App\Models\Employee;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    public function index()
    {
        $movements = Movement::with('employee')->get();
        return response()->json($movements, 200);
    }

    public function store(Request $request)
    {
        // dd($request);
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'mes' => 'required|numeric',
            'cantidad_entregas' => 'required|numeric'
        ]);

        // Crear un nuevo movimiento
        $movement = Movement::create($validatedData);

        return response()->json($movement, 201);
    }

    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'mes' => 'required|integer',
            'cantidad_entregas' => 'required|integer'
        ]);

        // Buscar el movimiento por su ID
        $movement = Movement::findOrFail($id);

        // Actualizar los datos del movimiento
        $movement->update($validatedData);

        return response()->json($movement, 200);
    }

    public function destroy($id)
    {
        // Buscar el movimiento por su ID
        $movement = Movement::findOrFail($id);

        // Eliminar el movimiento
        $movement->delete();

        return response()->json(null, 204);
    }
}
