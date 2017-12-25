<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//use Illuminate\Support\Facades\Request;

use Illuminate\Http\Request;
Route::get('/', function () {
    return view('welcome'); 
});

Auth::routes();
// Route::get('/facebook/login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
// {
//     // Send an array of permissions to request
//     $login_url = $fb->getLoginUrl(['email']);

//     // Obviously you'd do this in blade :)
//     echo '<a href="' . $login_url . '">Login with Facebook</a>';
// });

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/fbpost', 'HomeController@facebookPost');
Route::post('/apilogin', 'LoginController@login');
Route::post('/apiregister', 'LoginController@register');
Route::get('/getUsers', 'HomeController@getUsers');




// Route::group(['middleware' => ['auth', 'admin']], function () {
//     // Admin routes
//     Route::get('/admin', 'HomeController@admin');
// });
// routes/web.php

//use Illuminate\Http\Request;

// First route that user visits on consumer app
// Route::get('/', function () {
//     // Build the query parameter string to pass auth information to our request
//     $query = http_build_query([
//         'client_id' => 3,
//         'redirect_uri' => 'http://localhot/yinnovation/public/api/v1',
//         'response_type' => '1bGTImEjwJguro2PiETDV2q8j2x7VQP',
//         'scope' => 'conference'
//     ]);

//     // Redirect the user to the OAuth authorization page
//     return redirect('http://localhot/yinnovation/public/oauth/authorize?' . $query);
// });

// // Route that user is forwarded back to after approving on server
// Route::get('callback', function (Request $request) {
//     $http = new GuzzleHttp\Client;

//     $response = $http->post('http://localhot/yinnovation/public/oauth/token', [
//         'form_params' => [
//             'grant_type' => 'authorization_code',
//             'client_id' => 3, // from admin panel above
//             'client_secret' => '1bGTImEjwJguro2PiETDV2q8j2x7VQP', // from admin panel above
//             'redirect_uri' => 'http://localhot/yinnovation/public/api/v1',
//             'code' => $request->code // Get code from the callback
//         ]
//     ]);

//     // echo the access token; normally we would save this in the DB
//     return json_decode((string) $response->getBody(), true)['access_token'];
// });
// Route::get('/redirect', function () {
//     $query = http_build_query([
//         'client_id' => '3',
//         'redirect_uri' => 'http://localhot/yinnovation/public/api/v1',
//         'response_type' => '1bGTImEjwJguro2PiETDV2q8j2x7VQPxoke5LaIt',
//         'scope' => '',
//     ]);

//     return redirect('http://localhot/yinnovation/public/oauth/authorize?'.$query);
// });
// Route::get('/redirect', function () {
//     $query = http_build_query([
//         'client_id' => '3',
//         'redirect_uri' => 'http://localhost/yinnovation/public/api/v1',
//         'response_type' => 'code',
//         'scope' => '',
//     ]);

//     return redirect('http://localhost/yinnovation/public/oauth/authorize?'.$query);
// });

Route::get('/redirect', function () {
    $query = http_build_query([
         'client_id' => '2',
        'redirect_uri' => 'http://yinnovation.com/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('http://localhost/API/public/oauth/authorize?'.$query);
});
Route::get('/callback', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://localhost/API/public/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '2',
            'client_secret' => 'DsC19aUcWLUf6wQGNQAplWm4anakBifCWYsRuv0D',
            'redirect_uri' => 'http://yinnovation.com/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/sms/send/{to}', function(\Nexmo\Client $nexmo, $to){
    $message = $nexmo->message()->send([
        'to' => $to,
        'from' => '@leggetter',
        'text' => 'Sending SMS from Laravel. Woohoo!'
    ]);
    Log::info('sent message: ' . $message['message-id']);
});
