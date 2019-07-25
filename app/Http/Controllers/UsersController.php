<?php


namespace App\Http\Controllers;
use http\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
        function getClient(Request $request){

        }

        function createClient(Request $request){

            $data = $request->all();

            Client::create([


            ]);

        }
        function getToken(Request $request){

            if($request->isJson()){
                try{
                    $data = $request->all();
                    $user = Client::where('email',$data['email'])->first();
                    if($user && Hash::check($data['password'],$user->password)){
                        return response()->json([$user],400);
                    }
                }catch (ModelNotFoundException $e){


                }

            }

        }
}
