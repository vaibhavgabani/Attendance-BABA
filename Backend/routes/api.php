<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\StudentControllers;
use App\Http\Controllers\UserAuthController;



Route::get('/test-db-connection', function () {
    try {
        DB::connection()->getPdo();
        return response()->json(['message' => 'Database connection successful', 'database' => DB::connection()->getDatabaseName()]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Database connection failed', 'error' => $e->getMessage()], 500);
    }
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/students', [StudentControllers::class, 'index']);
Route::get('/students/{id}', [StudentControllers::class, 'show']);
Route::post('/students', [StudentControllers::class, 'store']);
Route::put('/students/{id}', [StudentControllers::class, 'update']);
Route::delete('/students/{id}', [StudentControllers::class, 'destroy']);

Route::post('/login', [UserAuthController::class, 'login']);
Route::post('signup', [UserAuthController::class, 'signup']);
