<?php

namespace App\Http\Controllers;

use App\Models\ProfileTech;
use App\Models\UserProfile;
use Illuminate\Http\Request;

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

            $profile = UserProfile::create([
                "profileId" => $gen->genUuid(),
                "description" => $data["description"],
                "linkGithub" => $data["linkGithub"],
                "linkLinkedin" => $data["linkLinkedin"],
                "linkPortfolio" => $data["linkPortfolio"],
                "isProf" => $data["isProf"],
                "userId" => $data["userId"],
                "parcourId" => $data["parcourId"],
                "porteId" => $data["porteId"],
            ]);


            return response()->json($profile, 201);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=>$th->getMessage()],);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $userId)
    {
        try {
            $porte = null;
            $technology = [];
            $experience = [];

            $userProfile = UserProfile::where("userId", $userId)->first();
            // dd($);
            // dd($userProfile->experiences);

            if ($userProfile->porteId != null){
                $porte = $userProfile->porteId;
            }

            // if($userProfile->technologies() != null){
                foreach ($userProfile->technologies as $tech) {
                    array_push($technology, $tech);
                };
                // }

            // foreach ($userProfile->experiences as $expe) {
            //     array_push($experience, $expe);
            // }

            $data = [
                "description"=>$userProfile->description,
                "linkGithub"=>$userProfile->linkGithub,
                "linkLinkedin"=>$userProfile->linkLinkedin,
                "linkPortfolio"=>$userProfile->linkPortfolio,
                "isProf"=>$userProfile->isProf,
                "user"=>[
                    "id"=>$userProfile->user_id,
                    "userName"=>$userProfile->user->userName,
                    "firstName"=>$userProfile->user->firstName,
                    "lastName"=>$userProfile->user->lastName,
                    "email"=>$userProfile->user->email,
                    "profileUrl"=> $userProfile->user->profile,
                    "contact"=> $userProfile->user->contact,

                ],
                "parcour"=>$userProfile->parcour->title,
                "porte"=>$porte,
                "technologies"=>$technology,
                "experience"=> $experience,
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
    public function update(Request $request, UserProfile $userProfile)
    {
        try {
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

            $userProfile->update($data);

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
