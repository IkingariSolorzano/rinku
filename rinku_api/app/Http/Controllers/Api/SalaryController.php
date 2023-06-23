<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function getEmployeeMovements(Request $request)
    {
        $employeeId = $request->input('employee_id');

        $results = DB::select("CALL getEmployeeMovements(?)", [$employeeId]);

        return response()->json($results);
    }

    public function updateMovementQuantity(Request $request)
    {
        $movementId = $request->input('movement_id');
        $cantidadEntregas = $request->input('cantidad_entregas');

        DB::select("CALL updateMovementQuantity(?, ?)", [$movementId, $cantidadEntregas]);

        return response()->json(['message' => 'Movement quantity updated successfully']);
    }

    public function calculateSalary(Request $request)
    {
        $employeeId = $request->input('employee_id');

        $results = DB::select("CALL calculateSalary(?)", [$employeeId]);

        return response()->json($results);
    }

    public function calculateAdditionalSalary(Request $request)
    {
        $movementId = $request->input('movement_id');

        $results = DB::select("CALL calculateAdditionalSalary(?)", [$movementId]);

        return response()->json($results);
    }
    public function calculateTotalSalary(Request $request)
    {
        $employeeId = $request->input('employee_id');

        $results = DB::select("CALL calculateTotalSalary(?)", [$employeeId]);

        return response()->json($results);
    }

    public function calculateSalaryDetails(Request $request)
    {
        $employeeId = $request->input('employee_id');

        $results = DB::select("CALL calculateSalaryDetails(?)", [$employeeId]);

        return response()->json($results);
    }

    public function calculatePayment(Request $request)
    {
        $employeeId = $request->input('employee_id');

        $results = DB::select("CALL calculatePayment(?)", [$employeeId]);

        return response()->json($results);
    }
}
