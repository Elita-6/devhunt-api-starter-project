<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Http\Controllers\GenUuid;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Domain::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $gen = new GenUuid();
        $data = $request->only(["domainName"]);
        try {
            $domain = Domain::create([
                "domainId"=>$gen->genUuid(),
                "domainName"=>$data["domainName"]
            ]);

            return response()->json(["created" => true], 201);
        } catch (\Exception $th) {
            return response()->json(["errorMessage" => $th->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Domain $domain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Domain $domain)
    {
        $data = $request->only(["domainName"]);
        try {
            $domain->update($data);
            $domain->save();
            return response()->json(["updated"=> true],200);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=> $th->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domain $domain)
    {
        try {
            $domain->delete();
            return response()->json(["deleted"=> true],204);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=> $th->getMessage()],500);
        }
    }
}
