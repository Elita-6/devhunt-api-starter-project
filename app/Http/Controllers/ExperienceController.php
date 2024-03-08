<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($profileId)
    {
        $experience = Experience::where("profileId", $profileId)->get();

        return response()->json($experience);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $gen = new GenUuid();
        try {
            $data = $request->only([
                "experiencePost",
                "experienceDescription",
                "experienceLocal",
                "dateStart",
                "dateEnd",
                "profileId"
            ]);

            $experience = Experience::create([
                "experienceId" => $gen->genUuid(),
                "experiencePost" => $data["experiencePost"],
                "experienceDescription" => $data["experienceDescription"],
                "experienceLocal" => $data["experienceLocal"],
                "dateStart" => $data["dateStart"],
                "dateEnd" => $data["dateEnd"],
                "profileId" => $data["profileId"],
            ]);

            return response()->json($experience, 201);

        } catch (\Exception $th) {
            return response()->json(["message"=> $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        try {
            $experience->update($request->only([
                "experiencePost",
                "experienceDescription",
                "experienceLocal",
                "dateStart",
                "dateEnd"
            ]));

            return response()->json($experience, 200);
        } catch (\Exception $th) {
            return response()->json(["message"=> $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        $experience->delete();
        return response()->json(["message"=> true],500);
    }
}
