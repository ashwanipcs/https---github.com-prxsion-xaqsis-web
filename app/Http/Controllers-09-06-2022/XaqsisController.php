<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client; 
use Ixudra\Curl\Facades\Curl;
use Helper;
use Session;

class XaqsisController extends Controller
{
    //
	public function index()
	{
		echo "Xaqsis Controller";
	}
	public function postLogin(Request $request)
	{
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
				print_r($result); die();
				if($result->status->response==401)
				{
					$code 		= $result->status->response;
					$message	=  $result->status->message;					 
					return redirect()->route('login')->with('error',$message);	
				}else{
					 
					$request->session()->put('statuscode', $result->status->response);
					$request->session()->put('account_uuid', $result->data->account_uuid);
					$request->session()->put('org_uuid', '326bc8a0-da83-45d5-b588-821ac9cadbe9');
					$request->session()->put('login_token', $result->data->login_token);
					$request->session()->put('license_token', $result->data->license_token);
					$request->session()->put('success', $result->status->message);
					$request->session()->put('igLoggedIn', true);
					//$request->session()->put('expiration', $result->status->expiration);
					//print_r($result); die();
					return redirect()->route('dashboard')->with('success',$result->status->message);
				}
				
				
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
                       
			return redirect()->route('login')->with('error','Something went wrong on the server.');
        }	
	}
	
	/*Route::get('xaqsis/getaccountorgcurl', [XaqsisController::class, 'getOrgByAccountUuidCurl'])->name('xaqsis.getaccountorgcurl');	*/
	public function getOrgByAccountUuidCurl(Request $request)
	{
			 
			$baseUrl = Helper::BaseUrl();		
			
			$org_uuid = "326bc8a0-da83-45d5-b588-821ac9cadbe9";
			$account_uuid ="792d2217-6838-4288-8826-00a1bd8534ff";
			echo $url = $baseUrl."/".$org_uuid."/account?uuid=".$account_uuid;
			
			$requestData = [
					'org_uuid'	 => $org_uuid 
					
				];
				
			//echo $params = json_encode($requestData); 
			
			$access_token ="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1dWlkIjoiNzkyZDIyMTctNjgzOC00Mjg4LTg4MjYtMDBhMWJkODUzNGZmIiwiZXhwIjo5NzA5NDU2Nzg5MH0.7ue3lHruQrZ7KQSBZZ0l4v01_uqpulAH0u7l5cNkDCk";
			$license_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1dWlkIjoiNzkyZDIyMTctNjgzOC00Mjg4LTg4MjYtMDBhMWJkODUzNGZmIiwidmlzaWJsZSI6dHJ1ZX0.J_hvTbicYjHL4P-ea0wk_nThKJe2OsWzLJ3FFRCrsy8";
			 $headers = array(
				"Content-Type: application/json",
				"authorization: Basic ".base64_encode($access_token.":".$license_token),
				"cache-control: no-cache",
				"x-access-token: ".$access_token,
				"license-token: ".$license_token,
			);
			
			$method ='GET';			
			 
			//$params = json_encode($postData);
			$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
			$result = json_decode($response);
			dd($result);die();
			if($result->status->response==500)
			{
				echo $message = $result->status->message;
				//return redirect()->route('register')->with('error',$message);
			}else{
				dd($result);die();
				$message = $result->status->message;
				return redirect()->route('login')->with('error',$message);
			} 
			
     
	}
	
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	
	public function getDataGuzzleClient(Request $request)
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
	
	
	public function postDataGuzzleClient(Request $request)
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
					'email'      => 'ashwani74yk@gmail.com' 
				];
				
			echo $params = json_encode($requestData); 
			
				try {
					$res = $client->request('POST',	$url, [
									'headers' => [
										'Content-Type'     => 'application/json'
									],
									'body'   => $params
							]
						);
				
					var_dump($res->getStatusCode());		 
				 
					$response = json_decode($res->getBody());					
					dd($response);
				}
				 catch(\Exception $e) {
						 
						$error = $e->getResponse();
						dd($error);
					}  
	}
	
	public function postDataByCurl(Request $request)
	{
			 
			$baseUrl = Helper::BaseUrl();
			$url = $baseUrl."/326bc8a0-da83-45d5-b588-821ac9cadbe9/account";
			
			$org_uuid = "326bc8a0-da83-45d5-b588-821ac9cadbe9";
			$requestData = [
					'org_uuid'	 => $org_uuid,
					'password'	 => 'ashwani',
					'first_name' => 'ashwani',
					'last_name'  => 'kumar',
					'email'      => 'ashwani7554yk@gmail.com' 
				];
				
			//echo $params = json_encode($requestData); 
			
			 $headers = array(
				'Content-Type: application/json'
			);
			
			$method ='POST';			
			 
			//$params = json_encode($postData);
			$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
			$result = json_decode($response);
			
			if($result->status->response==500)
			{
				echo $message = $result->status->message;
				//return redirect()->route('register')->with('error',$message);
			}else{
				dd($result);die();
				$message = $result->status->message;
				return redirect()->route('login')->with('error',$message);
			} 
			
     
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
	
	public function importActivity()
	{
		echo "import activity";
	}
}
