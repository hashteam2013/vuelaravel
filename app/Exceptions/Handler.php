<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception)
    {
 
       if($request->is('api/*')) {
          return response([
                               "status"=>"faliure",
                               "code"=>500,
                               "message"=>$exception->getMessage(),
                               "line"=>$exception->getLine(),
                               "trace"=>$exception->getFile()
                             ]);
    if ($exception instanceof OAuthServerException || $exception instanceof AuthenticationException) {

          return response([
                            "status"=>"faliure",
                            "code"=>401,
                            "message"=>"Unauthorized"
                          ]);
        }
$statusCode = $exception->getStatusCode();
 switch ($statusCode) {
        case 401:
            $response['message'] = 'Unauthorized';
             return response([
                       "status"=>"faliure",
                       "code"=>401,
                       "message"=>"Unauthorized",
                       "data"=>[] 
                     ]);
            break;
        case 403:
           
                         return response([
                       "status"=>"faliure",
                       "code"=>403,
                       "message"=>"Forbidden",
                       "data"=>[] 
                     ]);
            break;
        case 404:
            
           return response([
                       "status"=>"faliure",
                       "code"=>403,
                       "message"=>"Route not found",
                       "data"=>[] 
                     ]);            
            break;
        case 405:
            
             return response([
                       "status"=>"faliure",
                       "code"=>405,
                       "message"=>"Method Not Allowed",
                       "data"=>[] 
                     ]);
            break;
        case 422:
                 return response([
                       "status"=>"faliure",
                       "code"=>422,
                       "message"=>$exception->getMessage(),
                       "data"=>[]
                     ]);

            break;
        default:
            return response([
                       "status"=>"faliure",
                       "code"=>500,
                       "message"=>$exception->getMessage(),
                       "line"=>$exception->getLine(),
                       "trace"=>$exception->getFile()
                     ]);
            break;
    }
   return parent::render($request, $exception);   
  }
}

}
