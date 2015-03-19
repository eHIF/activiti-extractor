<?php namespace App\Http\Controllers;

use GuzzleHttp\Client;
class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$client = new  Client();
		$response = $client->get('http://guzzlephp.org');
		//$res = $client->get('https://api.github.com/user', ['auth' =>  ['user', 'pass']]);
		echo $response->getStatusCode();
// "200"
		echo $response->getHeader('content-type');
// 'application/json; charset=utf8'
		echo $response->getBody();
// {"type":"User"...'
		var_export($response->json());
// Outputs the JSON decoded data

// Send an asynchronous request.
		$req = $client->createRequest('GET', 'http://httpbin.org', ['future' => true]);
		$client->send($req)->then(function ($response) {
			echo 'I completed! ' . $response;
		});


		return view('welcome');
	}

}
