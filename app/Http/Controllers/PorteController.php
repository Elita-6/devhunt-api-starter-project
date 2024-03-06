<?php

namespace App\Http\Controllers;

use App\Models\Porte;
use Illuminate\Http\Request;

class PorteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Porte::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            "porteId",
            "profileId"
        ]);

        try {
            Porte::create($data);

            return response()->json(["created"=>true], 201);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=> $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Porte $porte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Porte $porte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Porte $porte)
    {
        $porte->delete();
        return response()->json(["deleted"=>true],204);
    }
}
