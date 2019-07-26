<?php


namespace App\Http\Controllers;
use app\User;
use app\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
        function getClient($id){

            $Client = Client::find($id);
            return response()->json($Client,200);

        }

        function createUser(Request $request){

<<<<<<< HEAD
            $data = $request->all();
        
            $client = Client::create([
                'name'=> $data['name'],
                'email' =>$data['email'],
                'password' => Hash::make($data['password']),
                'address' => $data['address'],
                'number' => $data['number'],       
            ]);

            return response()->json(['body'=> $client, 201]);

=======
            


        }

        function createClient(Request $request){
>>>>>>> 0f4c7ab50fa79176c461de28e7c28c4c8be48d5f

        }

<<<<<<< HEAD
            if($request->isJson()){
                try{
                    $data = $request->all();
                    $user = Client::where('email',$data['email'])->first();
                    if($user && Hash::check($data['password'],$user->password)){
                        $user->api_token = str_random(63); 
                        return response()->json([$user],400);
                    }
                }catch (ModelNotFoundException $e){
=======
        function updateAddress(Request $request){
>>>>>>> 0f4c7ab50fa79176c461de28e7c28c4c8be48d5f

            $data = $request->all();

            try {   

                $Client = Client::find($data['id']);
                $Client->address = $data['address'];
                $Client->save();
                
            } catch (\Exception $e) {
                response()->json(['error'=> $e ],422);
            }
            
             

        }


        function getToken(Request $request){
            try{
                $data = $request->all();
                $user = User::where('email',$data['email'])->first();
                if($user && Hash::check($data['password'],$user->password)){
                    return response()->json([$user],400);
                }
            }catch (ModelNotFoundException $e){

                return response ()->json(['error'=> $e], 401);
            }
        }
}
