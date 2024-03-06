<?php

namespace App\Http\Controllers;

use App\Models\Parcour;
use App\Models\ParcourDeboucher;
use Illuminate\Http\Request;

class ParcourDeboucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, int $parcourId)
    {
        try {
            $data = [];
            $parcour = Parcour::where("parcourId", $parcourId)->first();

            foreach ($parcour->debouchers as $deboucher) {
                array_push($data, $deboucher);
            }

            return response()->json($data);
        } catch (\Exception $th) {
            return response()->json(["errorMessage", $th->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $parcour = Parcour::create($request->only([
                "deboucherId",
                "parcourId"
            ]));

            return response()->json(["created", $parcour], 201);
        } catch (\Exception $th) {
            return response()->json(["errorMessage", $th->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ParcourDeboucher $parcourDeboucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ParcourDeboucher $parcourDeboucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParcourDeboucher $parcourDeboucher)
    {
        //
    }
}
