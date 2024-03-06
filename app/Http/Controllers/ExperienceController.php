<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, int $profileId)
    {
        $experience = Experience::where("profileId", $profileId)->get();

        return response()->json($experience);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $experience = Experience::create($request->only([
                "experiencePost",
                "experienceDescription",
                "experienceLocal",
                "dateStart",
                "dateEnd",
                "profileId"
            ]));

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
