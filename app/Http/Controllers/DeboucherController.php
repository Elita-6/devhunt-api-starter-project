<?php

namespace App\Http\Controllers;

use App\Models\Deboucher;
use Illuminate\Http\Request;

class DeboucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json(Deboucher::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->only([
                "deboucherName"
            ]);
            $gen = new GenUuid();

            $deboucher = Deboucher::create([
                "deboucherId" => $gen->genUuid(),
                "deboucherName" => $data["deboucherName"],
            ]);

            return response()->json($deboucher, 201);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=> $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Deboucher $deboucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deboucher $deboucher)
    {
        try {
            $deboucher->update($request->only(["deboucherName"]));

            return response()->json($deboucher, 200);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=> $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deboucher $deboucher)
    {
        try {
            $deboucher->delete();
            return response()->json([], 204);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=> $th->getMessage()], 500);
        }
    }
}
