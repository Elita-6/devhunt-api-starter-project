<?php

namespace App\Http\Controllers;

use App\Models\User as Utilisation;
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
        return response()->json(Utilisation::where("active", true)->get());
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

               $loginuser =  Utilisation::firstOrCreate(
                   ['email' => $request->input('email')],
                   [
                   'userId' => $userid,
                   'userName' => $request->input('username'),
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

//                        dd($user->userId);

                       $token = JWTAuth::fromUser($loginuser, ['userid'=>$loginuser->userId]);
//                        $loginuser->forceFill(['api_token' => $token])->save();
                       $cookie = cookie('jwt', $token, 60 * 24);

                       // dd(Auth::user());
                       return response([
                           'message' => "Succes",
                           'token' => $token,
                           'userid' => $loginuser->userId
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
               $loginuser =  Utilisation::firstOrCreate(
                                 ['email' => $request->input('email')],
                                 [
                                 'userId' => $userid,
                                 'userName' => $request->input('username'),
                                 'firstName' => $request->input('firstName'),
                                 'lastName' => $request->input('lastName'),
                                 'email' => $request->input('email'),
                                'typeProvider' => $request->input('typeProvider'),
                                 'profileUrl' => $request->input('profileUrl')
                          ]);

//                 dd($loginuser->mail);


               if($loginuser){
                   Auth::login($loginuser);

                   $user = Auth::user();

//                    dd($loginuser->userId);

                    $token = JWTAuth::fromUser($loginuser, ['userid'=>$loginuser->userId]);
//                    $loginuser->forceFill(['api_token' => $token])->save();
                   $cookie = cookie('jwt', $token, 24 * 60 * 60);

                   // dd(Auth::user());
                   return response([
                       'message' => "Succes",
                       'token' => $token,
                       'userid' => $loginuser->userId
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
    public function show(Utilisation $utilisateur)
    {
        return response()->json($utilisateur);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Utilisation::where('userId', Auth::user()->userId)->first();
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


                        $user->userName = $request->input('username');
                        $user->firstName = $request->input('firstName');
                        $user->lastName = $request->input('lastName');
                        $user->email = $request->input('email');
                        $user->profileUrl = $path;

                        $user->save();


                    // dd(Auth::user());
                    return response([
                        'message' => "Succes",
                        'userid' => Auth::user()->userId
                    ], 200);

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


                $user->userName = $request->input('username');
                $user->firstName = $request->input('firstName');
                $user->lastName = $request->input('lastName');
                $user->email = $request->input('email');

                $user->save();

                // dd(Auth::user());
                return response([
                    'message' => "Succes",
                    'userid' => Auth::user()->userId
                ], 200);

            }
            catch (\Exception $th)
            {
                return response()->json(["created"=>false, "errorMessage"=>$th->getMessage()], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utilisation $utilisateur)
    {
        //
    }
}
