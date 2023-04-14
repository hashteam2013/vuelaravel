<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    use AuthorizesRequests, ValidatesRequests;
    protected $success="success";
    protected $faliure="faliure";
    protected $errorMessage="Something went wrong";
    public function response($status,$code,$data,$message){
        if($status==$this->success){
           $stat=$this->success;
        }
        else{
            $stat=$this->faliure;
        }
        return response([
               "status"=>$stat,
               "code"=>$code,
               "data"=>$data,
               "message"=>$message
        ]);

    }
}
