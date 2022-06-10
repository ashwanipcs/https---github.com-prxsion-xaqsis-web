<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use GuzzleHttp\Client; 
use Ixudra\Curl\Facades\Curl;
use Helper;
use Session;

class ProjectActivityController extends Controller
{
    /**
     * Return Base URL.
     */
	protected $baseUrl;
	/**
     * Return $org_uuid
	 * Return $org_name
     */
	protected $org_uuid;
	protected $org_name;
	/**
     * Return $account_uuid
	 * Return $account_name
     */
	protected $account_uuid;
	protected $account_name;
	/**
     * Return $access_token
	 * Return $license_token
     */
	protected $access_token;
	protected $license_token;
	
	/**
     * Instantiate a new UserController instance.
     */
    public function __construct(Request $request)
    {
		
		$this->middleware(function ($request, $next) {
            if(Session::get("igLoggedIn") == false && empty(Session::get('igLoggedIn'))) {
               return redirect()->route('login')->with('error','Sorry! something was not right with your login, please try again');
            }
			
			/* Retuen Base URL*/
			$this->baseUrl = Helper::BaseUrl();			
			/* Session GET org_uuid tokan and org_name*/
			$this->org_uuid = $request->session()->get('org_uuid');
			$this->org_name = $request->session()->get('org_name');
			/* Session GET account_uuid tokan and account_uuid*/
			$this->account_uuid = $request->session()->get('account_uuid');
			$this->account_name = $request->session()->get('account_name');			
			/* Session GET access tokan and license token from API*/
			$this->access_token = $request->session()->get('access_token');
		    $this->license_token = $request->session()->get('license_token');
			
            return $next($request);
        });		 
    }
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {	
		$url = $this->baseUrl."/".$this->org_uuid."/project_activity";
		$method ='GET';	
		/* Difine Header Section*/				
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);	
		/*Input Params*/
		$requestData = [
			"org_uuid" 	=>  $this->org_uuid,
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
				 
		if($result->status->response==500)
		{
			$message = $result->status->message;
			dd($result);
			return redirect()->route('projectactivity')->with('error',$message);
		}else if($result->status->response==404){
			echo $message = $result->status->message;
			dd($result);
			return redirect()->route('projectactivity')->with('error',$message);
		}else{
			if($result->status->response==500)
			{
				dd($result);
				$res = $result->data;
				$activity = $this->getImportActivity();
				return view('projectactivity.index',compact('res','activity'));
			}else{
				echo $message = $result->status->message;				 
				dd($result);
				return redirect()->route('projectactivity')->with('error',$message);
			}
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
        $url = $this->baseUrl."/".$this->org_uuid."/project_activity"; 
		$method ='POST';		 	
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);	
		
		$requestData = [				 
				"org_uuid" 				=> $this->org_uuid,
				"project_uuid" 			=> "8a8b0844-6424-4590-878c-375de7a91e74",
				"activity_uuid"			=> "a260207d-ba8f-4cb6-bd81-4a538279d38e",
				"name"					=> "W1010-Furnitures & Flooring",
				"mostlikely_cost"		=> "392818.55990",
				"optimistic_cost"		=> "0.00",
				"pessimistic_cost"		=> "0.00",
				"predecessors"			=> "[]",
				"optimistic_duration"	=> "0",
				"mostlikely_duration"	=> "0",
				"pessimistic_duration"	=> "0",
				"is_active"				=>  true,
				"modified_by" 			=> $this->account_uuid,
				
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
		
		if($result->status->response==500)
		{
			$message = $result->status->message;
			dd($result);
			return redirect()->route('projectactivity')->with('error',$message);
		}elseif($result->status->response==404)
		{
			$message = $result->status->message;
			dd($result);
			return redirect()->route('projectactivity')->with('error',$message);
		}else{
			if($result->status->response==200)
			{				
				$message = $result->status->message;
				dd($result);
				return redirect()->route('projectactivity')->with('success',$message);
			}
			else{
				$message = $result->status->message;
				dd($result);
				return redirect()->route('projectactivity')->with('error',$message);
			}
		}
    }
	/**
	* Update the specified resource in storage.
	*
	* @param  int  $id
	* @return Response
	*/
	 public function update(Request $request)
    {
		//$uuid = $request->input('uuid');
		$uuid = "8a8b0844-6424-4590-878c-375de7a91e74";
        $url = $this->baseUrl."/".$this->org_uuid."/project_activity?uuid=".$uuid; 
		$method ='PUT';		 	
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);	
		
		$requestData = [				 
				"org_uuid" 				=> $this->org_uuid,
				"project_uuid" 			=> "8a8b0844-6424-4590-878c-375de7a91e74",
				"activity_uuid"			=> "a260207d-ba8f-4cb6-bd81-4a538279d38e",
				"name"					=> "FF1010- H Indian Furnitures & Flooring",
				"mostlikely_cost"		=> "392818.55990",
				"optimistic_cost"		=> "0.00",
				"pessimistic_cost"		=> "0.00",
				"predecessors"			=> "[]",
				"optimistic_duration"	=> "0",
				"mostlikely_duration"	=> "0",
				"pessimistic_duration"	=> "0",
				"is_active"				=>  true,
				"modified_by" 			=> $this->account_uuid,
				
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
		
		if($result->status->response==500)
		{
			echo $message = $result->status->message;
			dd($result);
			return redirect()->route('projectactivity')->with('error',$message);
		}elseif($result->status->response==404)
		{
			echo $message = $result->status->message;
			dd($result);
			return redirect()->route('projectactivity')->with('error',$message);
		}else{
			if($result->status->response==200)
			{				
				echo $message = $result->status->message;
				dd($result);
				return redirect()->route('projectactivity')->with('success',$message);
			}
			else{
				echo $message = $result->status->message;
				dd($result);
				return redirect()->route('projectactivity')->with('error',$message);
			}
		}
    }
	/**
	* Remove the specified resource from storage.
	*
	 * @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	* @param  int  $id
	* @return Response
	*/
    public function destroy(Request $request, $id)
    { 
		//$uuid = Crypt::decrypt($id);
		$uuid = "3084614b-c761-4b59-ab14-0e8744a4090d";	
        $url = $this->baseUrl."/".$this->org_uuid."/project_activity?uuid=".$uuid;
		$method ='DELETE';	
			
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);		
				
		$requestData = [
				"uuid" =>  $uuid, 
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		//dd($result);
		
		if($result->status->response==404)
		{
			 $message = $result->status->message;
			return redirect()->route('activity')->with('error',$message);
		}else{
			//dd($result);
			$message = $result->status->message;
			return redirect()->route('activity')->with('success',$message);
		}	
    }
	
	
}
