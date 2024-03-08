<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\ProfileTech;
use App\Models\Project;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $gen = new GenUuid();
            $data = $request->only([
                "description",
                "linkGithub",
                "linkLinkedin",
                "linkPortfolio",
                "isProf",
                "userId",
                "parcourId",
                "porteId"
            ]);

//            dd($data["description"]);

            $profile = UserProfile::create([
                "profileId" => $gen->genUuid(),
                "description" => $request->input("description"),
                "linkGithub" => $request->input("linkGithub"),
                "linkLinkedin" => $request->input("linkLinkedin"),
                "linkPortfolio" => $request->input("linkPortfolio"),
                "isProf" => $request->input("isProf"),
                "userId" => Auth::user()->userId,
                "parcourId" => $request->input("parcourId"),
                "level" => $request->input('level'),
                "porteId" => $request->input("porteId"),
            ]);


            return response()->json($profile, 201);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=>$th->getMessage()],);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        try {
            $porte = null;
            $technology = [];
            $experiences = [];
            $projects = Project::where('userId', $userId)->get();
            $user = User::where("userId", $userId)->first();

            $userProfile = UserProfile::where("userId", $userId)->first();
//             dd($userProfile->userId);
            // dd($userProfile->experiences);

//            if ($userProfile->porteId != null){
//                $porte = $userProfile->porteId;
//            }

             if($userProfile->technologies != null){
                foreach ($userProfile->technologies as $tech) {
                    array_push($technology, [
                        "technologyId"=> $tech->technologyId,
                        "technologyDescription" => $tech->technologyDesignation
                    ]);
                };
             }

            if($userProfile->experiences != null){
                foreach ($userProfile->experiences as $expe) {
                    array_push($experiences, $expe);
                }
            }

            $data = [
                "profileId" => $userProfile->profileId,
                "description"=>$userProfile->description,
                "linkGithub"=>$userProfile->linkGithub,
                "linkLinkedin"=>$userProfile->linkLinkedin,
                "linkPortfolio"=>$userProfile->linkPortfolio,
                "level" => $userProfile->level,
                "isProf"=>$userProfile->isProf,
                "user"=>$user,
                "parcour"=>$userProfile->parcour->parcourDesign,
//                "porte"=>$porte,
                "technologies"=>$technology,
                "experience"=> $experiences,
                "projects" => $projects
            ];

            return response()->json($data);

        } catch (\Exception $th) {
            return response()->json([
                "errorMessage"=>$th->getMessage(),
                "errorLine" => $th->getLine()
            ],500);
        }
    }

    /**,
     * Update the specified resource in storage.
     */
    public function update(Request $request, $profileId)
    {
        try {
            $data = $request->only([
                "description",
                "linkGithub",
                "linkLinkedin",
                "linkPortfolio",
                "isProf",
                "userId",
                "level",
                "parcourId",
                "porteId"
            ]);

            $userProfile = UserProfile::where('profileId', $profileId)->first();

            $userProfile->description = $data['description'];
            $userProfile->linkGithub = $data['linkGithub'];
            $userProfile->linkLinkedin = $data['linkLinkedin'];
            $userProfile->linkPortfolio = $data['linkPortfolio'];
            $userProfile->isProf = $data['isProf'];
            $userProfile->level = $data['level'];
            $userProfile->parcourId = $data['parcourId'];
//            $userProfile->porteId = $data['porteId'];

            $userProfile->save();

            return response()->json(["profile"=>$userProfile],200);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=>$th->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
