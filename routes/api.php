<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("allprojects", [ProjectController::class, "all"]);
Route::post("addproject", [ProjectController::class, "add"]);
Route::put("updateVisibility", [ProjectController::class, "updateVisibility"]);
Route::delete("deleteproject", [ProjectController::class, "deleteProject"]);
