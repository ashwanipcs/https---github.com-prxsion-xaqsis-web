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

class ActivityController extends Controller
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
		$url = $this->baseUrl."/".$this->org_uuid."/activity";
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
		//dd($result);		 
		$activity = $this->getImportActivity();
		if($result->status->response==404)
		{
			$res='';
			return view('activity.index',compact('res','activity'));
		}else if($result->status->response==500)
		{			 
			$res='';
			return view('activity.index',compact('res','activity'));
		}else{
			//dd($result);
			$res = $result->data;			
			return view('activity.index',compact('res','activity'));
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
        $url = $this->baseUrl."/".$this->org_uuid."/activity"; 
		$method ='POST';		 	
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);		
		$requestData = [				 
				"name" 				=> $request->input('name'),
				"description" 		=> $request->input('description'),
				"is_system"			=> false,
				"is_active"			=> $request->input('is_active') ? true : false,
				"modified_by" 		=> $this->account_uuid,
				
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
		//dd($result);
		if($result->status->response==200)
		{
			$message = $result->status->message;
			return redirect()->route('activity')->with('success',$message);
		}else{
			//dd($result);
			$message = $result->status->message;
			return redirect()->route('activity')->with('error',$message);
		}
    }	
	/**
	* Show the form for editing the specified resource.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	* @param  int  $id
	* @return Response
	*/
	public function edit(Request $request)
	{
		$uuid = "4f278bd9-dd98-47d6-a995-1845a5f31c7e";
		$url = $this->baseUrl."/".$this->org_uuid."/activity?uuid=".$uuid; 
		$method ='GET';		 	
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);		
		$requestData = [				 
				"uuid" => $uuid,
				
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		$retren_arr[] = json_encode($result->data);
		return $retren_arr;
		
	}
	/**
	* Update the specified resource in storage.
	*
	* @param  int  $id
	* @return Response
	*/
    public function update(Request $request)
    {
		$uuid = $request->input('uuid');
		echo $url = $this->baseUrl."/".$this->org_uuid."/activity?uuid=".$uuid; 
		$method ='PUT';		 	
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);		
		$requestData = [				 
				"name" 				=> $request->input('name'),
				"description" 		=> $request->input('description'),
				"is_system"			=> false,
				"is_active"			=> $request->input('is_active') ? true : false,
				"modified_by" 		=> $this->account_uuid,
				
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
		//dd($result);
		if($result->status->response==200)
		{
			$message = $result->status->message;
			return redirect()->route('activity')->with('success',$message);
		}else{
			//dd($result);
			$message = $result->status->message;
			return redirect()->route('activity')->with('error',$message);
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
		$uuid = Crypt::decrypt($id);		 
        $url = $this->baseUrl."/".$this->org_uuid."/activity?uuid=".$uuid;
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
		
		if($result->status->response==200)
		{
			$message = $result->status->message;
			return redirect()->route('activity')->with('success',$message);
		}else{
			//dd($result);
			$message = $result->status->message;
			return redirect()->route('activity')->with('error',$message);
		}
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getImportActivity()
    {	
		$url = $this->baseUrl."/".$this->org_uuid."/activity";
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
		//dd($result);
		if($result->status->response==404)
		{
			return false;	
		}
		else{
			return $result->data;
		}
			  
    }
	/**
     * Import a newly created resource in storage.
     * @Post Method for Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function syncImportActivity(Request $request)
    {
        $url = $this->baseUrl."/".$this->org_uuid."/activity"; 
		$method ='POST';		 	
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
		
		$nameArr 		= $request->input('name');
		$descriptionArr = $request->input('description');
		$isActive 		= $request->input('is_active');
		
		$requestData = array();
		foreach($nameArr as $key=>$name)
		{
			$requestData[$key] = array(				 
						"name" 			=> $nameArr[$key],
						"description" 	=> $descriptionArr[$key],
						"is_system"		=> false,
						"is_active"		=> $isActive[$key] ? true : false,
						"modified_by" 	=> $this->account_uuid,
				
			);
		}
		
		foreach ($requestData as $i => $data ) {			
			$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$data);
		}
		
		$result = json_decode($response);
		if($result->status->response==404)
		{
			$message = $result->status->message;
			return redirect()->route('activity')->with('error',$message);
		}
		else if($result->status->response==500)
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
