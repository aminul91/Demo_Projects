<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Validator;

class UserApiController extends Controller
{
    public function showUser($id=null){
        if($id == ''){

            $users = User::get();
            return response() -> json(['users' => $users],200);
            
        }else{

            $users = User::find($id);
            return response() -> json(['users' => $users],200);
        }

    }
    


    public function addUser(Request $request){
        $header = $request -> header('Authorization');
        $token = $this->token();
        if($header == ''){

            $messgae = "Authorization required";
            return response() -> json(['message' => $messgae],422);
        }else{

            if($header == $token){
                if($request -> ismethod('post')){
                    $data = $request -> all();
                    $rules= [
                        "name" => 'required',
                        "email" => 'required|email|unique:users',
                        "password" => 'required',
                    ];

                    $custommessage= [
                        "name.required" => 'Name is required',
                        "email.required" => 'Email required',
                        "email.email" => 'Email required in correct format',
                        "password.required" => 'password required',
                    ];

                    $validator = validator::make($data,$rules,$custommessage);

                    if($validator->fails()){
                        return response()->json($validator->errors(),422);
                    }

                    $user = new User();
                    $user->name = $data['name'];
                    $user->email = $data['email'];
                    $user->password = bcrypt($data['password']);
                    $user->save();
                    $messgae = "user added";
                    return response() -> json(['message' => $messgae],201);
                
                }  
            }else{
                $messgae = "Authorization does not match";
                return response() -> json(['message' => $messgae],422);
            }
        }
    }

    public function token(){

        $string = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6ImxlYXJuYXBpIiwiaWF0IjoxNTE2MjM5MDIyfQ.VkuF0CNVPqPYOfL-_fFWuHfgSUp-9yxZdCnJF_-a9GA";
        return $string;
    }

   
}
