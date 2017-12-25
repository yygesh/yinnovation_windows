<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function facebookPost()
    {
       
            
       $page_access_token = 'EAAK0wb3fnLUBALBq0unJVeZCFlKUva9O01R8XF04cCosB5XFwTTUSexaAqcGXSuV7ZCbJZApca9BqRX20SP1AKDJWb7ktUbU7SSWVn9t7yRPq1femRik1DuM7ft4cktA47SvcdKsDoavWmx25GZAJe2Kr185ueq9h7OuJs9gljBqrly5PJMwxZAeLZA63xH64ZD';
        $id = '846437452182280';
        //After that, we create an array with the info to post to our page wall:

        $data['message'] = "Your message";
        $data['access_token'] = $page_access_token;
       // And we set our post URL, to post in our page:

        $post_url = 'https://graph.facebook.com/'.$id.'/feed';
        

        $data['message'] = "Test Message";
        $data['access_token'] = $page_access_token;
        $ch = curl_init($post_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $response = curl_exec($ch);
            curl_close($ch);
            $returnData = json_decode($response, true);
            dd($returnData);

        
    }
     public function user()
    {
         $client = new Client();
        $token=\Session::get('access_token');

        $response1 = $client->request('GET', 'http://passport.com/api/user', [
                    'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$token]]);

                    $getContents1 = $response1->getBody()->getContents(); 
                    $responseData1 = json_decode($getContents1); 

                    return view('info',compact('responseData1'));
                    
    }
    public function getUsers()
    {
         $client = new Client();
        $token=\Session::get('access_token');

        $response1 = $client->request('GET', 'http://passport.com/api/v1/getUsers', [
                    'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$token]]);

                    $getContents1 = $response1->getBody()->getContents(); 
                    $responseData = json_decode($getContents1); 
                    $users=$responseData->users;

                    return view('info',compact('users'));
    }
}
