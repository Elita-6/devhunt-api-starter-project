<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use App\Models\UserProfile;
use http\Env\Response;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($profileId)
    {
        $profile = UserProfile::where('profileId', $profileId)->first();
        $technology = [];
        if($profile->technologies == null){
            return response()->json([], 204);
        }
        $techs = $profile->technologies;

        foreach ($techs as $tech) {
            array_push($technology, [
                "tecnologyId" => $tech->technologyId,
                "technologyDesignation" => $tech->technologyDesignation
            ]);
        }

        return response()->json($technology, 200);
    }

    public function alltech(){
        return response()->json(Technology::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(["technologyDesignation"]);
        try {
            $gen = new GenUuid();
            // dd($gen->genUuid()->toString());
            Technology::create([
                "technologyId"=>$gen->genUuid(),
                "technologyDesignation"=>$data["technologyDesignation"],
            ]);

            return response()->json(["created"=>true], 201);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=>$th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        //
    }

    public function search($skill){
        $skills = Technology::where('technologyDesignation', 'like', '%'. $skill .'%')->get();
        return $skills;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $data = $request->only(["technologyDesignation"]);

        try {
            $technology->update($data);
            $technology->save();

            return response()->json(["updated"=>true],200);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=>$th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        try {
            $technology->delete();
            return response()->json(["deleted"=>true],204);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=>$th->getMessage()], 500);
        }
    }
}
