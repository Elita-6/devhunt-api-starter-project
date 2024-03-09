<?php

namespace App\Http\Controllers;

use App\Models\Ressource;
use App\Models\RessourceTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RessourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ressources = Ressource::all();
        $data = [];
        foreach ($ressources as $ressource) {
            $tag = [];

            if ($ressource->tags != null) {
                $tg = $ressource->tags;
                foreach ($tg as $t) {
                    array_push($tag, $t->tagDesign);
                }
            }

            $user = [];
            if($ressource->user != null) {
                $userR = $ressource->user;
                $user = [
                    "userName" => $userR->userId,
                    "firstname" => $userR->firstName,
                    "lastName"=> $userR->lastName,
                ];
            }

            array_push($data, [
                "ressourceId" => $ressource->ressourceId,
                "ressourceName" => $ressource->ressourceName,
                // "ressourceUrl" => $ressource->ressourceUrl,
                "tags" => $tag,
                "user" => $user,
                "date" => $ressource->created_at,
                // "ressourceUrl" => $ressource->ressourceUrl,
            ]);
        }

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $gen = new GenUuid();

            $file = $request->file("file");
            $data = $request->only([
                "ressourceName",
                "categoryIds",
            ]);

            $file = $file[0];
            $filename = "ressource_".$data["ressourceName"].".".$file->getClientOriginalExtension();
            $path = $file->storeAs('', $filename, 'files');
            // dd($path);
            $userId = Auth::user()->userId;

            $ressource = Ressource::create([
                "ressourceId" => $gen->genUuid(),
                "ressourceName" => $data["ressourceName"],
                "ressourceUrl" => $path,
                "userId"=>$userId
            ]);


            // foreach ($data["categoryIds"] as $tagId) {
            //     RessourceTag::create([
            //         "ressourceId" => $ressource->ressourceId,
            //         "tagId" => $tagId,
            //     ]);
            // }

            return response()->json([], 201);
        } catch (\Exception $th) {
            return response()->json(["errorMessage" => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ressource $ressource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ressource $ressource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ressource $ressource)
    {
        //
    }

     // Download the file
     public function download(string $ressourceId)
     {
         try {
             $ressource = Ressource::where("ressourceId", $ressourceId)->first();
             $path = storage_path('app/public/files/' . $ressource->ressourceUrl);

             if (file_exists($path)) {

                 return response()->download($path, $ressource->chemin);
             }

             return response()->json(['download' => false, 'error' => 'Fichier non trouvé'], 404);
         } catch (\Exception $th) {
             return response()->json(['download' => false, 'error' => $th->getMessage(), 500]);
         }
     }
}
