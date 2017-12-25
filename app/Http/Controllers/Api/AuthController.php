<?php 
namespace App\Http\Controllers\Api;

use App\User;
use Validator;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Input;
use Carbon;
use Response;

class AuthController extends Controller
{
    public function index()
    {
       $response = array(
                'returnType'    => 'success',
                'message'       => 'You are logged in successfully.'
            );

        return Response::json($response);
    }

}
