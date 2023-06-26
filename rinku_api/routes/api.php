<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\MovementController;
use App\Http\Controllers\Api\SalaryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
| Estas son las rutas para USUARIOS
 */
// Route::post('register', [AuthController::class, 'register']);
// Route::get('login', [AuthController::class, 'login']);
/*
| Estas son las rutas para EMPLEADOS
 */
Route::get('employees', [EmployeeController::class, 'index']);
Route::post('employees', [EmployeeController::class, 'store']);
// Route::put('employees/{id}', [EmployeeController::class, 'update']);
// Route::delete('employees/{id}', [EmployeeController::class, 'destroy']);

/*
| Estas son las rutas para MOVIMIENTOS
 */
Route::get('movements', [MovementController::class, 'index']);
Route::post('movements', [MovementController::class, 'store']);
Route::put('movements/{id}', [MovementController::class, 'update']);
Route::delete('movements/{id}', [MovementController::class, 'destroy']);

/*
| Estas son las rutas para MOVIMIENTOS
 */
Route::get('/employees/movements', [SalaryController::class, 'getEmployeeMovements']);
Route::post('/movement/update', [SalaryController::class, 'updateMovementQuantity']);
Route::get('/salary/calculate', [SalaryController::class, 'calculateSalary']);
