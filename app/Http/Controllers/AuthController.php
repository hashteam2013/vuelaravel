<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Auth;
class AuthController extends Controller
{
    
    public function login(Request $request){
      
        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password'=>'required',
            ],[
                'email.required'=>"Email is required",
                'password'=>'Password is required',
            ]);
            /**  IF VALIDATION FAILED  ***/
            if ($validator->fails()) { 
                return response()->json(['errors' => $validator->errors(),'status'=>'validErr']);
            }
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
            {
                $user=Auth::user();
                // $user->createToken('Token Name')->accessToken;
                $accessToken = $user->createToken('authToken')->accessToken;
                // dd($accessToken->token);
                return $this->response($this->success,200,$accessToken,'User logged in successfully');

               
            } 
            else {
                return $this->response($this->faliure,500,'',"Some of Your credentials are wrong.");
            }
           

        }
        catch(Exception $ex){
            return $this->response($this->faliure,500,'',$this->errorMessage);
        }
    }
}
