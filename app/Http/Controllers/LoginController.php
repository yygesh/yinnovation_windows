<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class LoginController extends Controller
{
    
    function login(Request $request)
    {

        $client = new Client();

        $input=$request->all();

        $response = $client->request('POST',\Config::get('passport.passport_url').'/api/v1/login',['json'=>['email'=>$input['email'],'password'=>$input['password']]]);
        $getContents = $response->getBody()->getContents();
        $responseData = json_decode($getContents);
       
			if($responseData && $responseData->returnType == 'success')
			{
				\Session::put('user', $responseData->user);
				\Session::put('access_token', $responseData->access_token);
				\Session::flash('success', $responseData->message);
				return redirect('home');
			}
			else
			{
				\Session::flash('error', $responseData->message);
				return redirect('/login');
			}
		
    }
    function register(Request $request)
    {

    try{
        $client = new Client();

        $input=$request->all();

        if(Session::get('access_token'))
    	{
        	$response = $client->request('POST',\Config::get('passport.passport_url').'/api/v1/register',['json'=>['name'=>$input['name'],'email'=>$input['email'],'password'=>$input['password']],
        		'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.\Session::get('access_token')]
        		]);
    	}
    	else{
    		$response = $client->request('POST',\Config::get('passport.passport_url').'/api/v1/register',['json'=>['name'=>$input['name'],'email'=>$input['email'],'password'=>$input['password']]]);
    	}
        $getContents = $response->getBody()->getContents();
        $responseData = json_decode($getContents);
       
			if($responseData && $responseData->returnType == 'success')
			{
				//\Session::put('access_token', $responseData->access_token);
				\Session::put('user', $responseData->user);
				return redirect('home');
			}
			else
			{
				\Session::flash('error', $responseData->message);
				return redirect('/');
			}
	   }
	   catch (RequestException $e) {
		    return redirect()->back()->with('error', $e->getMessage());
		}
    }
}
