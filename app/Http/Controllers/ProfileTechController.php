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
    public function store(Request $request, $profileid)
    {
        $techid = $request->input("added");
        $removed = $request->input("removed");
       foreach ($techid as $id){
           ProfileTech::create([
               'profileId' => $profileid,
               'technologyId' => $id
           ]);
       }

       foreach ($removed as $id){
           $tech = ProfileTech::where('technologyId', $id)->where('profileId', $profileid)->first();
           $tech->delete();
       }

        return response()->json(["message"=>"success"], 200);
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
    public function destroy($profile, $tech)
    {
        //

        ProfileTech::where('technologyId', $tech)->where('profileId', $profile)->delete();

        return response()->json(["message"=>"deleted"], 201);
    }
}
