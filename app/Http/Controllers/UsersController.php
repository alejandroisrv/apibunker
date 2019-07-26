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

            


        }

        function createClient(Request $request){

        }

        function updateAddress(Request $request){

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
