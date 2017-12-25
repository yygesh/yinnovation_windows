<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon;
use Response;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
class LoginController extends Controller
{
    //
   
    
    function login(Request $request)
    {
        $client = new Client();
        $response = $client->request('POST','http://api.com/api/v1/redirect',['json'=>['email'=>'yogchhantyal@gmail.com','password'=>'password']]);
        $getContents = $response->getBody()->getContents();
           
      return Response::json($getContents);
    }
    function redirect()
    {
        $query = http_build_query([
         'client_id' => '2',
        'redirect_uri' => 'http://yinnovation.com/api/v1/callback',
        'response_type' => 'code',
        'email'=>'yogchhantyal@gmail.com',
        'password'=>'password',
        'scope' => '',
    ]);

    return redirect('http://api.com/oauth/authorize?'.$query);
    }
    function callback(Request $request)
    {

        $client = new Client();
            $response1 = $client->request('POST','http://api.com/oauth/token',[
            'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '2',
            'client_secret' => 'DsC19aUcWLUf6wQGNQAplWm4anakBifCWYsRuv0D',
            'redirect_uri' => 'http://yinnovation.com/api/v1/callback',
            'email'=>'yogchhantyal@gmail.com',
            'password'=>'password',
            'code' => $request->code,
        ]]);

            $getContents1 = $response1->getBody()->getContents();
            $responseData = json_decode($getContents1);;
$response = $client->request('GET', 'http://api.com/api/user', [
    'headers' => [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$responseData->access_token,
    ],
]);
$getContents = $response->getBody()->getContents();
           
      return Response::json($getContents);
    }

    function register()
    {
    	$input = Input::all();

        $credentials = [
        	'name'		=>$input['name'],
            'email'     => $input['email'],
            'password'  => $input['password']
        ];
        $result = User::create($credentials);

		if($credentials)
		{
			$jsonInput = json_encode($credentials);
	        $url = 'http://api.com/api/v1/register';
	        $ch = curl_init($url);
	        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	        curl_setopt($ch, CURLOPT_PORT, 80);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonInput);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	                'Content-Type: application/json',
	                'Content-Length: ' . strlen($jsonInput))
	        );
	        $response = curl_exec($ch);
	        curl_close($ch);
	        $returnData = json_decode($response, true);

	        if($returnData['returnType'] == 'success') {
	        	 $response = array(
                'returnType'    => 'success',
                'message'       => 'You are Signup in successfully.'
            );

        	return Response::json($response);
	        	 }
	        else
	        {
	       		$response = array(
                'returnType'    => 'error',
                'message'       => 'You are Signup in successfully.'
            );

        		return Response::json($response);
	       	}
		}
        if($result)
        {
        $response = array(
                'returnType'    => 'success',
                'message'       => 'You are Signup in successfully.'
            );

        return Response::json($response);
    	}
	    else
	    {
	    	$response = array(
	                'returnType'    => 'error',
	                'message'       => 'Error in signup.'
	            );

	        return Response::json($response);
	    }
	}
    function client()
    {
        $client = new Client();
            $response = $client->request('GET','http://api.com/oauth/clients');

            $getContents = $response->getBody()->getContents();
           
      return Response::json($getContents);
    }
}
