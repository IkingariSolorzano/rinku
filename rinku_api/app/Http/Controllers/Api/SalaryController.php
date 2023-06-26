<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function updateMovementQuantity(Request $request)
    {
        $employee_id = $request->input('employee_id');
        $mesT = $request->input('mes');
        $cantidad_entregas = $request->input('cantidad_entregas');

        // dd($mesT);

        DB::select("CALL updateEntregas(?, ?, ?)", [$employee_id, $mesT, $cantidad_entregas]);

        return response()->json(['message' => 'Movement quantity updated successfully']);
    }

    public function getEmployeeMovements(Request $request)
    {
        $employeeId = $request->input('employee_id');

        $results = DB::select("CALL getEmployeeMovements(?)", [$employeeId]);

        return response()->json($results);
    }

    public function calculateSalary(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $mesT = $request->input('mes');

        $results = DB::select("CALL calcular_salario(?, ?, @horas_base, @salario_base, @bono, @pago_entregas, @salario_bruto, @salario_neto, @pago_efectivo, @pago_vales)", [$employeeId, $mesT]);

        $salaryResults = DB::select("SELECT @horas_base AS horas_base, @salario_base AS salario_base, @bono AS bono, @pago_entregas AS pago_entregas, @salario_bruto AS salario_bruto, @salario_neto AS salario_neto, @pago_efectivo AS pago_efectivo, @pago_vales AS pago_vales");

        return response()->json($salaryResults[0]);
    }
}
