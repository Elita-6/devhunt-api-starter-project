<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $gen = new GenUuid();
            $data = $request->only([
                "title",
                "projectDescritpion",
                "imageUrl",
                "startDate",
                "endDate",
                "profileId",
            ]);

            $project = Project::create([
                "projectId" => $gen->genUuid(),
                "title"=> $data["title"],
                "projectDescription" => $data["projectDecription"],
                "imageUrl" => $data["imageUrl"],
                "startDate" => $data["startDate"],
                "profileId" => $data["profileId"],
            ]);

            return response()->json(["created"=>true, "project"=>$project], 201);
        } catch (\Exception $th) {
            return response()->json(["error"=> $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $technologies = [];
        foreach ($project->technologies as $tech) {
            array_push($technologies, $tech);
        }
        $data = [
            "title" =>$project->title,
            "projectDescription" => $project->projectDescription,
            "imageUrl"=> $project->imageUrl,
            "startDate" => $project->startDate,
            "endDate" => $project->endDate,
            "technos" => $technologies
        ];

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        try {
            $project->update($request->only([
                "title",
                "projectDescritpion",
                "imageUrl",
                "startDate",
                "endDate",
                // "profileId",
            ]));

            return response()->json(["updated"=> true], 200);
        } catch (\Exception $th) {
            return response()->json(["error"=> $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            $project->delete();
            return response()->json(["errorMessage"],204);
        } catch (\Exception $th) {
            return response()->json(["message"=> $th->getMessage()], 500);
        }
    }
}
