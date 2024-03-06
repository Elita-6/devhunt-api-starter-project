<?php

use App\Http\Controllers\ApartController;
use App\Http\Controllers\AssistantGenerator;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ParcourController;
use App\Http\Controllers\ParcourDeboucherController;
use App\Http\Controllers\PorteController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\TechProjectController;
use App\Http\Controllers\UtilisateurController;
use App\Models\Deboucher;
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


/***
 * Route by pywendi
 */
Route::apiResource("domain", DomainController::class);

Route::get("/experience/{profileId}", [ExperienceController::class,"index"]);
Route::apiResource("experience", ExperienceController::class)->except(["index"]);

Route::apiResource("porte", PorteController::class);

Route::apiResource("parcour", ParcourController::class);

Route::apiResource("deboucher", Deboucher::class);

Route::get("/deboucher/{parcourId}", [ParcourDeboucherController::class,"index"]);
Route::apiResource("parcourDeboucher", ParcourDeboucherController::class)->except("index");

Route::apiResource("project", ProjectController::class);

Route::apiResource( "technology", TechnologyController::class);

Route::get("/techProject/{projectId}", [TechProjectController::class,"index"]);
Route::apiResource("techProject", ProjectController::class)->except("index");

route::apiResource("userProfile", ProjectController::class);

