<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Utilisateur::where("active", true)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

         $userid = '';
           if($request->input('id')){
                $userid = $request->input('id');

           }
           else {$userid = Str::random(10) . time();}

       if($request->file('profile') != null)
       {
           $request->validate([
               'file' => 'required|image|mimes:png,jpg,jpeg,gif'
           ]);

           try
           {
               $file = $request->file('profile');
               $filename = 'pdp_'.$request->input('userName').'.'.$file->getClientOriginalExtension();
               $path = $file->storeAs('images', $filename, 'public');

               $loginuser =  Utilisateur::firstOrCreate(
                   ['email' => $request->input('email')],
                   [
                   'id' => $userid,
                   'username' => $request->input('username'),
                   'firstName' => $request->input('firstName'),
                   'lastName' => $request->input('lastName'),
                   'email' => $request->input('email'),
                   'profileUrl' => $path,
                   'typeProvider' => $request->input('typeProvider')
                    ]);

                   //  dd($loginuser->mail);


                   if($loginuser){
                       Auth::login($loginuser);

                       $user = Auth::user();

                       // dd($user->userId);

                       $token = JWTAuth::fromUser($loginuser, ['userid'=>$loginuser->id]);
//                        $loginuser->forceFill(['api_token' => $token])->save();
                       $cookie = cookie('jwt', $token, 60 * 24);

                       // dd(Auth::user());
                       return response([
                           'message' => "Succes",
                           'token' => $token,
                       ], 200)->withCookie($cookie);
                   }
                   else{
                       return response()->json(["message" => "Error creating"], 401);
                   }
           }
           catch (\Exception $th)
           {
               return response()->json(["created"=>false, "errorMessage"=>$th->getMessage()], 500);
           }
       }

       else {
           try
           {
               // dd($request->all());
               $loginuser =  Utilisateur::firstOrCreate(
                                 ['email' => $request->input('email')],
                                 [
                                 'id' => $userid,
                                 'username' => $request->input('username'),
                                 'firstName' => $request->input('firstName'),
                                 'lastName' => $request->input('lastName'),
                                 'email' => $request->input('email'),
                                'typeProvider' => $request->input('typeProvider'),
                                     'profileUrl' => $request->input('profileUrl')
                          ]);

               //  dd($loginuser->mail);


               if($loginuser){
                   Auth::login($loginuser);

                   $user = Auth::user();

                   // dd($user->userId);

                    $token = JWTAuth::fromUser($loginuser, ['userid'=>$loginuser->id]);
//                    $loginuser->forceFill(['api_token' => $token])->save();
                   $cookie = cookie('jwt', $token, 60 * 24);

                   // dd(Auth::user());
                   return response([
                       'message' => "Succes",
                       'token' => $token
                   ], 200)->withCookie($cookie);
               }
               else{
                   return response()->json(["message" => "Error creating"], 401);
               }

           }
           catch (\Exception $th)
           {
               return response()->json(["created"=>false, "errorMessage"=>$th->getMessage()], 500);
           }
       }

    }

    /**
     * Display the specified resource.
     */
    public function show(Utilisateur $utilisateur)
    {
        return response()->json($utilisateur);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Utilisateur $utilisateur)
    {
        $data = $request->only([
            "username",
            "firstName",
            "lastName",
            "profileUrl",
            "email",
        ]);

        $utilisateur->update($data);

        return response()->json(["utilisateur" => $utilisateur], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utilisateur $utilisateur)
    {
        //
    }
}
