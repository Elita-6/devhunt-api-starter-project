<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\TechProject;
use Illuminate\Http\Request;

class TechProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, int $projectId)
    {
        $project = Project::where("projectId", $projectId)->get();
        return response()->json($project->technologies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $project = TechProject::create($request->only([
                "projectId",
                "technologyId"
            ]));

            return response()->json($project, 201);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=> $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TechProject $techProject)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TechProject $techProject)
    {
        try {
            $techProject->update($request->only([
                "projectId",
                "technologyId"
            ]));

            return response()->json(["updated"=>true], 200);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=> $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = $request->only([
            "projectId",
            "technologyId"
        ]);

        try {
            $project = TechProject::where([
                "projectId"=> $data["projectId"],
                "technologyId" => $data["technologyId"]
            ])->delete();

            return response()->json([],204);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=> $th->getMessage()], 500);
        }
    }
}
