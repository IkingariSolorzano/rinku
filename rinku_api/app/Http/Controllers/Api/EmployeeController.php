<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'no_empleado' => 'required|string',
            'role' => 'required|in:Cargador,Auxiliar,Chofer'
        ]);

        // Crear un nuevo empleado
        $employee = Employee::create($validatedData);


        return response()->json($employee, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'no_empleado' => 'required|string',
            'role' => 'required|in:Cargador,Auxiliar,Chofer'
        ]);

        // Buscar el empleado por su ID
        $employee = Employee::findOrFail($id);

        // Actualizar los datos del empleado
        $employee->update($validatedData);

        return response()->json($employee, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscar el empleado por su ID
        $employee = Employee::findOrFail($id);

        // Eliminar el empleado
        $employee->delete();

        return response()->json(null, 204);
    }
}
