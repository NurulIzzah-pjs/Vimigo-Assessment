<?php

use App\Http\Controllers\studentcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Public routes
Route::match(['get', 'post'], '/register', [UserController::class, 'register']);
Route::match(['get', 'post'], '/login', [UserController::class, 'login']);

// Routes requiring authentication
Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::match(['get', 'post'], '/logout', [UserController::class, 'logout']);
    Route::get('/student', [StudentController::class, 'index']);
    Route::get('/student/search', [StudentController::class, 'searchstudent']); 
    Route::post('/student/store', [StudentController::class, 'store']);
    Route::get('/student/{id}', [StudentController::class, 'show']); 
    Route::get('/student/{id}/edit', [StudentController::class, 'edit']); 
    Route::put('/student/{id}/edit', [StudentController::class, 'update']);
    Route::delete('/student/{id}/delete', [StudentController::class, 'destroy']);

});

// Catch-all route for non-existent endpoints
Route::fallback(function(){
    return response()->json(['message' => 'Not Found.'], 404);
});