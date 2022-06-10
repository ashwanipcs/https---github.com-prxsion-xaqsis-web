<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client; 
use Ixudra\Curl\Facades\Curl;
use Helper;
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
			echo $request->session()->get('account_uuid');
			
			//return view('users.list');
		}
		else{
			return redirect()->route('login')->with('error','Somthin is wrong?');
		}
		
    }	
  /**
     * Store a newly created resource in storage.
     * @Post Method for Login
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
		   $baseUrl = Helper::BaseUrl();
		   
			$url = $baseUrl."/login";
			
			try {
			
				$username	= $request->input('email');
				$password 	= $request->input('password');
				
				$headers = array(
						"accept: application/json",
						"authorization: Basic ".base64_encode($username.":".$password),
						"cache-control: no-cache",
						"content-type: application/json",
					);
				$method = 'POST';
				
				$response = Helper::AuthLogin($url,$headers,$method);				
				$result = json_decode($response);
				
				if($result->status->response==401)
				{
					$code 		= $result->status->response;
					$message	=  $result->status->message;					 
					return redirect()->route('login')->with('error',$message);	
				}else{
					 
					$request->session()->put('statuscode', $result->status->response);
					$request->session()->put('account_uuid', $result->data->account_uuid);
					$request->session()->put('success', $result->status->message);
					//$request->session()->put('expiration', $result->status->expiration);
					//print_r($result); die();
					return redirect()->route('dashboard')->with('success',$result->status->message);
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
     * @Post Method for Create Account\Register
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
			$baseUrl = Helper::BaseUrl();
			$method ='POST';
			
			$url = $baseUrl."/326bc8a0-da83-45d5-b588-821ac9cadbe9/account";
			
			$org_uuid = "326bc8a0-da83-45d5-b588-821ac9cadbe9";
			$postData['org_uuid'] = $org_uuid;
			$postData['password'] 	= $request->input('password');
			$postData['first_name'] = $request->input('firstname');
			$postData['last_name'] 	= $request->input('lastname');
			$postData['email'] 		= $request->input('email');			
			
			$headers = array(
				'Content-Type: application/json'
			);			
						 
			//$params = json_encode($postData);
			$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$postData);			
			$result = json_decode($response);
			
			if($result->status->response==500)
			{
				$message = $result->status->message;
				return redirect()->route('register')->with('error',$message);
			}else{
				dd($result);
				$message = $result->status->message; 
				die();
				return redirect()->route('login')->with('error',$message);
			}
			
			
			
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
		$baseUrl = Helper::BaseUrl();
		$url = $baseUrl."/326bc8a0-da83-45d5-b588-821ac9cadbe9/org";
		
		$response = Http::get($url);
    	
		if($response->status())
		{
			$response->body() ;
			$response->json()  ;
			$response->status() ;
			$response->ok()  ;
			$response->successful()  ;
			$response->serverError() ;
			$response->clientError() ;
			//$response->header($header)  ;
			$response->headers()  ;
			$jsonData = $response->json();
			dd($jsonData);
		}else{
			echo "error".$response->serverError();
		}
     
	}
	
	public function postDataHttpClient(Request $request)
	{
			$client = new \GuzzleHttp\Client();
			$baseUrl = Helper::BaseUrl();
			$url = $baseUrl."/326bc8a0-da83-45d5-b588-821ac9cadbe9/account";
			
			$org_uuid = "326bc8a0-da83-45d5-b588-821ac9cadbe9";
			$requestData = [
					'org_uuid'	 => $org_uuid,
					'password'	 => 'ashwani',
					'first_name' => 'ashwani',
					'last_name'  => 'kumar',
					'email'      => 'ashwani78244k@gmail.com' 
				];
				
			$params = json_encode($requestData);			
			
			$res = $client->request('POST',	$url, [
							'headers' => [
								'Content-Type'     => 'application/json'
							],
							'body'   => $params
					]
				);
				
				var_dump($res->getStatusCode());
				if($res->getStatusCode()!== 400){
					var_dump($res->getStatusCode()); // HTTP status code;
					var_dump($res->getReasonPhrase()); // Response message;
					echo $res->getStatusCode();
					$response = json_decode($res->getBody());
					
					dd($response);
				}else{
					echo "error";
				}
			
			/*$headers = array(
				'Content-Type: application/json'
			);
			
			$method ='POST';
			
			 
			$params = json_encode($postData);
			$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$params);			
			$result = json_decode($response);
			
			if($result->status->response==500)
			{
				$message = $result->status->message;
				return redirect()->route('register')->with('error',$message);
			}else{
				//dd($result);
				$message = $result->status->message;
				return redirect()->route('login')->with('error',$message);
			}*/
			
     
	}
	Public function OrgAccountsList()
	{
		$baseUrl = Helper::BaseUrl();
		$url = $baseUrl."/326bc8a0-da83-45d5-b588-821ac9cadbe9/org";
		
		$response = Http::get($url);
    	
		if($response->status())
		{
			$response->body() ;
			$response->json()  ;
			$response->status() ;
			$response->ok()  ;
			$response->successful()  ;
			$response->serverError() ;
			$response->clientError() ;
			//$response->header($header)  ;
			$response->headers()  ;
			$jsonData = $response->json();
			dd($jsonData);
		}else{
			echo "error".$response->serverError();
		}
	}
}
