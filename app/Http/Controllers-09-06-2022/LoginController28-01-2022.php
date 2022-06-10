<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Session;

class LoginController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
		return view('login.login');
		
    }	
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
		if($request->session()->get('account_uuid') >0)
		{
			 
			echo  $request->session()->get('statuscode');
			echo $request->session()->get('reasonphrase');
			echo $request->session()->get('success');
		}
		else{
			return redirect()->route('login')->with('error','Somthin is wrong?');
		}
		
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
                'email' => 'required|email',
				 'password' => 'required|min:6'
            ], 
            [
                'email.required' => 'Email Field is required',
                'password.required' => 'Password is required min 6 charecter'
            ]
          );
		  
		   $client = new \GuzzleHttp\Client(); 
			$url = "http://159.203.172.63:8080/api/login";
			
			try {
			
				$username	= $request->input('email');
				$password 	= $request->input('password');

				$credentials = base64_encode($username.':'.$password);
				 
					$headers = [					   
					   'Authorization' => 'Basic ' . $credentials,
					];

					$response = $client->request('POST', $url, [					   
								'headers' => $headers,
								'verify'  => false,
						]);
				
				$result = json_decode($response->getBody());
				if($response->getStatusCode()==200)
				{
					 
					$request->session()->put('statuscode', $response->getStatusCode());
					$request->session()->put('reasonphrase', $response->getReasonPhrase());
					$request->session()->put('account_uuid', $result->data->account_uuid);
					$request->session()->put('success', $result->status->message);
					//$request->session()->put('expiration', $result->status->expiration);

					return redirect()->route('dashboard')->with('success',$result->status->message);
				}else{
					$request->session()->put('error', 'Please enter a valid username or a password');
				return redirect()->route('login')->with('error','Invalid Request. Please enter a username or a password');	
				}
			
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
                       
			return redirect()->route('login')->with('error','Something went wrong on the server.');
        }	
    }
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
	
       return view('register.register');   
	   
    }
	
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createRegister(Request $request)
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
		
		try {
			
			$client = new \GuzzleHttp\Client();
			
			$apiURL = 'http://159.203.172.63:8080/api/326bc8a0-da83-45d5-b588-821ac9cadbe9/account'; 
			
			$postData['org_uuid'] = '326bc8a0-da83-45d5-b588-821ac9cadbe9';
			$postData['password'] 	= $request->input('password');
			$postData['first_name'] = $request->input('firstname');
			$postData['last_name'] 	= $request->input('lastname');
			$postData['email'] 		= $request->input('email');
			
			$request = $client->post($qpiURL, [
					'body' => json_encode($postData)
				]);
				 
   
			echo $response = $request->getBody();
			//$response = $client->request('POST', $apiURL);
	   
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
			
			 	
		} catch (\Exception $e) {

			//return $e->getMessage();
			return back()->withError($e->getMessage())->withInput();
		}
    }
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(Request $request)
    {
        return view('password.recovery-password');
    }
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {
        $request->validate(
            [
				'email' => 'required|email' 
            ], 
            [
				'email.required' => 'Email Field is required' 
            ]
          );
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatepassword(Request $request)
    {
        $request->validate(
            [
				'email' => 'required|email',
				'otp'=>'required',
				'password' => 'required|min:6'
            ], 
            [
				'email.required' => 'Email Field is required',
				'otp.required' => 'Last name Field is required',                
                'password.required' => 'Password is required min 6 charecter'
            ]
          );
		
    }
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	
	public function postHttpClient(Request $request)
	{
		$client = new \GuzzleHttp\Client(); 
        $url = "http://159.203.172.63:8080/api/login";

		$credentials = base64_encode('ashwani7jul@gmail.com:ashwani');
        $params = [
           'username' =>'ashwani7jul@gmai1.com',
		   'password' => 'ashwani'
        ];

        $headers = [
           // 'api-key' => 'k3Hy5qr73QhXrmHLXhpEh6CQ'
		   'Authorization' => 'Basic ' . $credentials,
        ];

        $response = $client->request('POST', $url, [
           'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);
		echo $response->getReasonPhrase();

        if($response->getStatusCode()==200)
		{
		
			$result = json_decode($response->getBody());
			
			
			$request->session()->put('statuscode', $response->getStatusCode());
			$request->session()->put('reasonphrase', $response->getReasonPhrase());
			$request->session()->put('account_uuid', $result->data->account_uuid);
			$request->session()->put('success', $result->status->message);
			
			$account_uuid = $result->data->account_uuid;
			$postData['org_uuid'] = $account_uuid;
			$postData['password'] = 'ashwani';
			$postData['first_name'] = 'ashwani';
			$postData['last_name'] = 'kumar';
			$postData['email'] = 'ashwani1@gmail.com'; 
			$postDatas['Input']= array('org_uuid'=>$account_uuid,'password'=>'ashwani','first_name'=>'ashwani','last_name'=>'kumar','email'=>'ashwani7jul@gmail.com');
			
			 $inputData =  $postData;
			 echo json_encode($postDatas); 
			
			/*$response1 = $client->request('POST', 'http://159.203.172.63:8080/api/792d2217-6838-4288-8826-00a1bd8534ff/account', [
					 'body' => "Input=" . json_encode([$postData]),
					'headers' => [
						'Content-Type' => 'application/x-www-form-urlencoded'
					]
					
				 ]);

			$result1 = $response1->getBody();
			dd($result1);
			*/
		} 
		
		dd($result);
	}
}
