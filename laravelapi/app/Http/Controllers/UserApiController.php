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


    public function addMultipleUser(Request $request){
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
                        "users.*.name" => 'required',
                        "users.*.email" => 'required|email|unique:users',
                        "users.*.password" => 'required',
                    ];

                    $custommessage= [
                        "users.*.name.required" => 'Name is required',
                        "users.*.email.required" => 'Email required',
                        "users.*.email.email" => 'Email required in correct format',
                        "users.*.password.required" => 'password required',
                    ];

                    $validator = validator::make($data,$rules,$custommessage);

                    if($validator->fails()){
                        return response()->json($validator->errors(),422);
                    }

                    foreach($data['users'] as $adduser){  // Here users in data is used according to json array(guideline)
                        $user = new User();
                        $user->name = $adduser['name'];
                        $user->email = $adduser['email'];
                        $user->password = bcrypt($adduser['password']);
                        $user->save();
                        $messgae = "All users added successfully";
                        
                    }
                    return response() -> json(['message' => $messgae],201);
                
                }  
            }else{
                $messgae = "Authorization does not match";
                return response() -> json(['message' => $messgae],422);
            }
        }
    }

    public function updateUserDetails(Request $request,$id){
        $header = $request -> header('Authorization');
        $token = $this->token();
        if($header == ''){

            $messgae = "Authorization required";
            return response() -> json(['message' => $messgae],422);
        }else{

            if($header == $token){
                if($request -> ismethod('put')){
                    $data = $request -> all();
                    $rules= [
                        "name" => 'required',
                        "password" => 'required',
                    ];

                    $custommessage= [
                        "name.required" => 'Name is required',
                        "password.required" => 'password required',
                    ];

                    $validator = validator::make($data,$rules,$custommessage);

                    if($validator->fails()){
                        return response()->json($validator->errors(),422);
                    }

                    $user = User::findOrFail($id);
                    $user->name = $data['name'];
                    $user->password = bcrypt($data['password']);
                    $user->save();
                    $messgae = "user successfully updated";
                    return response() -> json(['message' => $messgae],201);
                
                }  
            }else{
                $messgae = "Authorization does not match";
                return response() -> json(['message' => $messgae],422);
            }
        }
    }


    public function updateUsersingle(Request $request,$id){
       
        $header = $request -> header('Authorization');
        $token = $this->token();
        if($header == ''){

            $messgae = "Authorization required";
            return response() -> json(['message' => $messgae],422);
        }else{
           
            if($header == $token){
                if($request -> ismethod('patch')){
                   
                    $data = $request -> all();
                    $rules= [
                        "name" => 'required',
                    ];

                    $custommessage= [
                        "name.required" => 'Name is required',
                    ];

                    $validator = validator::make($data,$rules,$custommessage);

                    if($validator->fails()){
                        return response()->json($validator->errors(),422);
                    }

                    $user = User::findOrFail($id);
                    $user->name = $data['name'];
                    $user->save();
                    $messgae = "user name successfully updated";
                    return response() -> json(['message' => $messgae],201);
                
                }  
            }else{
                $messgae = "Authorization does not match";
                return response() -> json(['message' => $messgae],422);
            }
        }
    }
    // delete single user data with a id at URL
    public function deleteUsersingle($id=null){
        $user = User::findOrFail($id)-> delete();
        $messgae = "user successfully deleted";
        return response() -> json(['message' => $messgae],200);

    }
    
    // delete single user data with a id from json body  
    public function deleteUserwithjson(Request $request){
        if($request -> ismethod('delete')){
            $data = $request->all();
            User::where('id',$data['id'])-> delete();
            $messgae = "user successfully deleted with json";
            return response() -> json(['message' => $messgae],200);
        }

    }
    // Multiple user delete wih id from URL 
    public function deleteUserMultiple($ids=null){
        $ids = explode(',',$ids);
        User::wherein('id',$ids)-> delete();
        $messgae = "Multiple user successfully deleted";
        return response() -> json(['message' => $messgae],200);

    }

    // Multiple user delete wih id from json 
    public function deleteMultipleUserwithjson(Request $request){
        if($request -> ismethod('delete')){
            $data = $request->all();
            User::wherein('id',$data['ids'])-> delete();
            $messgae = "Multiple user successfully deleted with json";
            return response() -> json(['message' => $messgae],200);
        }

    }

    public function token(){

        $string = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6ImxlYXJuYXBpIiwiaWF0IjoxNTE2MjM5MDIyfQ.VkuF0CNVPqPYOfL-_fFWuHfgSUp-9yxZdCnJF_-a9GA";
        return $string;
    }

   
}
