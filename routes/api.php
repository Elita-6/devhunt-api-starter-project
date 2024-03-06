<?php

use App\Http\Controllers\ApartController;

use App\Http\Controllers\AssistantGenerator;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UtilisateurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('post', PostController::class);
    Route::post('logout', [UtilisateurController::class, 'logout']);
//});


Route::get("/exemple", [ApartController::class, "exemple"]);

Route::apiResource("user", UtilisateurController::class)->except(['logout']);
Route::post('/chat/generate-response', [ChatController::class, 'generateResponse']);
Route::post('/facebook/generate-response', [FacebookController::class, 'publishPost']);
//Route::apiResource("profile", UserProfileController::class);
//Route::apiResource('technology', TechnologyController::class);
//Route::apiResource('project', ProjectController::class);
//Route::apiResource('parcour', ParcourController::class);
//Route::apiResource('deboucher', Deboucher::class);
//Route::apiResource('porte', PorteController::class);
//Route::apiResource('experience', ExperienceController::class);
//Route::apiResource('domain', DomainController::class);
//
//
//Route::apiResource('itineraire', ItineraireController::class);
//Route::apiResource('discussion', DiscussionController::class);
//Route::apiResource('message', MessageController::class);
//Route::apiResource('notification', NotificationController::class);
//Route::apiResource('event', EventController::class);
//Route::apiResource('image', ImageController::class);
//Route::apiResource('archive', ArchiveController::class);
//Route::apiResource('course', CourseController::class);
//Route::apiResource('category', CategoryController::class);
//Route::apiResource('commentaire', CommentaireController::class);
//Route::apiResource('post', PostController::class);
//Route::apiResource('tag', TagController::class);

Route::apiResource("user", UtilisateurController::class);


Route::post("/openai", [AssistantGenerator::class,"index"]);
