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
        
            $client = Client::create([
                'name'=> $data['name'],
                'email' =>$data['email'],
                'password' => Hash::make($data['password']),
                'address' => $data['address'],
                'number' => $data['number'],       
            ]);

            return response()->json(['body'=> $client, 201]);


        }
        function getToken(Request $request){

            if($request->isJson()){
                try{
                    $data = $request->all();
                    $user = Client::where('email',$data['email'])->first();
                    if($user && Hash::check($data['password'],$user->password)){
                        $user->api_token = str_random(63); 
                        return response()->json([$user],400);
                    }
                }catch (ModelNotFoundException $e){


                }

            }

        }
}
