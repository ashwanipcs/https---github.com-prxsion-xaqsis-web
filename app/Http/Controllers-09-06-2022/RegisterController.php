<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class RegisterController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	
       return view('register.register');   
	   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
				'firstname'=>'required',
				'lastname'=>'required',
                'email' => 'required|email',
				'password' => 'required|min:6'
            ], 
            [
				'firstname.required' => 'First name Field is required',
				'lastname.required' => 'Last name Field is required',
                'email.required' => 'Email Field is required',
                'password.required' => 'Password is required min 6 charecter'
            ]
          );
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
		
		try {
			
			$apiURL = 'https://jsonplaceholder.typicode.com/posts';              
			$client = new \GuzzleHttp\Client();
			$response = $client->request('GET', $apiURL);
	   
			/*$statusCode = $response->getStatusCode();
			echo "<pre> status:";
			print_r($response->getStatusCode());
			echo "<pre> response:";		
			print_r($response->getReasonPhrase());    	
			echo "<br/> successful:";
			//print_r($response->getSuccessful());
			echo "<br/> serverError:";
			//print_r($response->getServerError());
			echo "<br/> clientError:";
			//print_r($response->getClientError());
			echo "<br/> headers:";
			print_r($response->getHeader('content-type'));
			 echo "<br/> Body:";
			  echo $response->getBody();*/		
			
			$result = json_decode($response->getBody(), true);
			//$result = $response->getBody();	
			
			$responseHttp = Http::get('http://jsonplaceholder.typicode.com/posts');  
			$register = $responseHttp->json();
			/*echo "<pre> status:";
			print_r($responseHttp->status());
			echo "<br/> ok:";
			print_r($responseHttp->ok());
			echo "<br/> successful:";
			print_r($responseHttp->successful());
			echo "<br/> serverError:";
			print_r($responseHttp->serverError());
			echo "<br/> clientError:";
			print_r($responseHttp->clientError());
			echo "<br/> headers:";
			print_r($responseHttp->headers());*/			
			//dd($register);
			// dd($result);
			//die();
			
		} catch (\Exception $e) {

			//return $e->getMessage();
			return back()->withError($e->getMessage())->withInput();
		}
				
       return view('register.list',compact('result','register')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
