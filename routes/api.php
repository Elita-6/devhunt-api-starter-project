<?php

use App\Http\Controllers\ApartController;

use App\Http\Controllers\AssistantGenerator;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ParcourController;
use App\Http\Controllers\ParcourDeboucherController;
use App\Http\Controllers\PorteController;
use App\Http\Controllers\ProfileTechController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\TechProjectController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UtilisateurController;
use App\Models\Deboucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReactionController;
// use App\Http\Controllers\TagController;
use App\Http\Controllers\UuidGeneratorControllor;
use App\Models\UserProfile;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DiscussionController;

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
// Route::post('/facebook/generate-response', [FacebookController::class, 'publishPost']);
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


/***
 * Route by pywendi
 */

// API GENERATOR
Route::get("/genUuid", [UuidGeneratorControllor::class,"generate"]);

Route::middleware(['verify.jwt.userid'])->group(function () {

    Route::apiResource('discussion', DiscussionController::class);
    Route::apiResource('message', MessageController::class);


    Route::apiResource("domain", DomainController::class);

    Route::get("/experience/{profileId}", [ExperienceController::class,"index"]);
    Route::apiResource("experience", ExperienceController::class)->except(["index"]);

    Route::apiResource("porte", PorteController::class);

    Route::apiResource("parcour", ParcourController::class);

    Route::apiResource("deboucher", Deboucher::class);

    Route::get("/deboucher/{parcourId}", [ParcourDeboucherController::class,"index"]);
    Route::apiResource("parcourDeboucher", ParcourDeboucherController::class)->except("index");

    Route::get('project/{userId}', [ProjectController::class, 'index']);
    Route::apiResource("project", ProjectController::class)->except('index');
    Route::get('technology/{profileId}', [TechnologyController::class, 'index']);
    Route::get('technology/all', [TechnologyController::class, 'alltech']);
    Route::apiResource( "technology", TechnologyController::class)->except(['index', 'alltech']);
    Route::get("techno/search/{skill}", [TechnologyController::class, "search"]);

    Route::delete("profiletech/{profile}/{tech}", [ProfileTechController::class, 'destroy']);
    Route::post('profiletech/{profileid}', [ProfileTechController::class, 'store']);
    Route::apiResource("profiletech", \App\Http\Controllers\ProfileTechController::class)->except(['destroy', 'store']);

    Route::apiResource("tag", TagController::class);
    Route::get("tag/search/{tag}", [TagController::class, "search"]);
    Route::get("tag/prompt/{prompt}", [TagController::class, "getTagByPrompt"]);
    Route::get("tag/{postId}", [TagController::class, "getTagByPost"]);
    route::get("/tag/post/{postId}", [TagController::class,"getTagByPost"]);


    Route::get("/techProject/{projectId}", [TechProjectController::class,"index"]);
    Route::apiResource("techProject", TechProjectController::class)->except("index");



    Route::post("bolidaai", [ChatController::class, 'generateResponse']);



    route::apiResource("post", PostController::class);
    route::get("/reaction/{postId}", [ReactionController::class,"index"]);
    route::apiResource("reaction", ReactionController::class)->except("index");

    Route::get('commentaire/{postid}', [\App\Http\Controllers\CommentaireController::class, 'index']);
    Route::delete('commentaire/{commentaire}', [\App\Http\Controllers\CommentaireController::class, 'destroy']);
    Route::apiResource('commentaire', \App\Http\Controllers\CommentaireController::class)->except(['index', 'destroy']);
    // route::get("/tag/prompt/{prompt}", [TagController::class,"getTagByPrompt"]);
    // route::apiResource("tag", ProjectController::class)->except("index");
    Route::get("/userprofile/{userId}", [UserProfileController::class,"show"]);
    Route::put("/userprofile/{profileId}", [UserProfileController::class,"update"]);
    Route::apiResource("userprofile", UserProfileController::class)->except(["show", "update"]);

    Route::apiResource("course", CourseController::class);
    Route::apiResource("category", CategoryController::class);

});





