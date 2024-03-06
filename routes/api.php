<?php

use App\Http\Controllers\ApartController;
use App\Http\Controllers\AssistantGenerator;
use App\Http\Controllers\UtilisateurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get("/exemple", [ApartController::class, "exemple"]);
Route::apiResource("utilisateur", UtilisateurController::class);


Route::post("/openai", [AssistantGenerator::class,"index"]);
