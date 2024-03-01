<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiStudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/students', [ApiStudentController::class, 'get']);
Route::post('/students', [ApiStudentController::class, 'store']);
Route::get('/students/{id}', [ApiStudentController::class, 'edit']);
Route::post('/students/{id}', [ApiStudentController::class, 'update']);
Route::delete('/students/{id}', [ApiStudentController::class, 'delete']);


// Route::get('/students', [ApiStudentController::class, 'get']);
// Route::post('/students', [ApiStudentController::class, 'store']);
// Route::get('/students/{id}/edit', [ApiStudentController::class, 'edit']);
// Route::post('/students/{id}/update', [ApiStudentController::class, 'update']);
// Route::get('/students/{id}/delete', [ApiStudentController::class, 'delete']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
