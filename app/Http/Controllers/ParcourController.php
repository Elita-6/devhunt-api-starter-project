<?php

namespace App\Http\Controllers;

use App\Models\Parcour;
use Illuminate\Http\Request;

class ParcourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parcours = Parcour::all();
        return response()->json($parcours);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $gen = new GenUuid();

            $data = $request->only([
                "parcourDesign",
                "parcourDescription"
            ]);

            $parcour = Parcour::create([
                "parcourId" => $gen->genUuid(),
                "parcourDesign" => $data["parcourDesign"],
                "parcourDescription" => $data["parcourDescription"],
            ]);

            return response()->json($parcour, 201);

        } catch (\Exception $th) {
            return response()->json(["errorMessage"=> $th->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Parcour $parcour)
    {
        return response()->json($parcour);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parcour $parcour)
    {
        try {
            $parcour->update($request->only([
                "title",
                "parcourDesign",
                "parcourDescription"
            ]));

            return response()->json($parcour,200);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=> $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parcour $parcour)
    {
        try {
            $parcour->delete();
            return response()->json(["deleted"=>true],204);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=> $th->getMessage()], 500);
        }
    }
}
