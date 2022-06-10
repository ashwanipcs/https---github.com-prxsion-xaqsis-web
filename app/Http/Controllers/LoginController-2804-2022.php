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
     * Landing a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction(Request $request)
    {		
		return view('master.index');		
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
				//print_r($result); die();
				if(empty($result))
				{
					return redirect()->route('login')->with('error','Something went wrong on the server.');
				}else{
					if($result->status->response==401)
					{
						$code 		= $result->status->response;
						$message	=  $result->status->message;					 
						return redirect()->route('login')->with('error',$message);	
					}else{
						
						/*Final URL*/
						$url = $baseUrl."/".$result->data->org_uuid."/account?uuid=".$result->data->account_uuid;
						$method ='GET';				 
						$headers = array(
							"Content-Type: application/json",
							"authorization: Basic ".base64_encode($result->data->login_token.":".$result->data->license_token),
							"cache-control: no-cache",
							"x-access-token: ".$result->data->login_token,
							"license-token: ".$result->data->license_token,
						);									
						$requestData = [
								'org_uuid'	 => $result->data->org_uuid
								
						];						
						$response1 = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
						$result1 = json_decode($response1);							
						 
						$request->session()->put('username', $result1->data->first_name);					 
						$request->session()->put('account_name', $result->data->account_name);
						$request->session()->put('account_uuid', $result->data->account_uuid);
						$request->session()->put('org_uuid', $result->data->org_uuid);
						$request->session()->put('org_name', $result->data->org_name);
						$request->session()->put('access_token', $result->data->login_token);
						$request->session()->put('license_token', $result->data->license_token);
						$request->session()->put('success', $result->status->message);
						$request->session()->put('igLoggedIn', true);
						//$request->session()->put('expiration', $result->status->expiration);
						//print_r($result); die();
						return redirect()->route('dashboard')->with('success',$result->status->message);;
					}
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
			$org_uuid = "326bc8a0-da83-45d5-b588-821ac9cadbe9";
			$url = $baseUrl."/".$org_uuid."/account";
			
			
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
				//dd($result);
				$message = $result->status->message; 
				//die();
				return redirect()->route('login')->with('success',$message);
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
     * Reset password a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    { 
			$baseUrl = Helper::BaseUrl();
			$method ='POST';
			$org_uuid = "326bc8a0-da83-45d5-b588-821ac9cadbe9";
			$url = $baseUrl."/resetaccountpassword";
			$headers = array(
				'Content-Type: application/json'
			);		
			$requestData['email']= $request->input('email');
			 
			$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
			$result   = json_decode($response);		 
			 //dd($result);
			
			if($result->status->response==500)
			{
				$message = $result->status->message;
				return redirect()->route('forgotpassword')->with('error1',$message);
			}else{
					$message = $result->status->message;
				 	return redirect()->route('forgotpassword')->with('success1',$message);
				}
				 
	}
			
   
	/**
     * Reset password a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {	
			$baseUrl = Helper::BaseUrl();
			$method ='PUT';
			$org_uuid = "326bc8a0-da83-45d5-b588-821ac9cadbe9";
			$url = $baseUrl."/resetaccountpassword";
			
			$headers = array(
				'Content-Type: application/json'
			);		
			
			$otp = $request->input('otp');
			
			$requestData = [
						"email"	 		=> $request->input('username'),
						"otp" 			=> (int)$otp,
						"new_password"	=> $request->input('password')
									
			];
			 
			 
			$response 	= Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
			$result 	= json_decode($response);	
				
			//dd($result);
			 
			if($result->status->response==500)
			{
				//dd($result);
				$message = $result->status->message;
				return redirect()->route('forgotpassword')->with('error',$message);
			}else if($result->status->response==404){
				//dd($result);
				$message = $result->status->message;
				return redirect()->route('forgotpassword')->with('error',$message);
			}
			else{
				//dd($result);
				$message = $result->status->message;				 
				return redirect()->route('forgotpassword')->with('success',$message); 
			}
    }
}
