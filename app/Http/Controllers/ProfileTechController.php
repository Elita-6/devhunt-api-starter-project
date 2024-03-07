<?php

namespace App\Http\Controllers;

use App\Models\ProfileTech;
use Illuminate\Http\Request;

class ProfileTechController extends Controller
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
        ProfileTech::create($request->only([
            "profileId",
            "technologyId"
        ]));

        return response()->json([], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfileTech $profileTech)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfileTech $profileTech)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileTech $profileTech)
    {
        //
    }
}
