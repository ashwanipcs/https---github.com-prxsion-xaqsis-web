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

class RecipientController extends Controller
{
   //give private url
	private $baseUrl;
	//give private org uuid
	protected $org_uuid;
	//give private account uuid
	protected $account_uuid;
	//give private access-token
	protected $access_token;
	//give private license-token
	protected $license_token;
	/*
	  * Instantiate a new UserController instance.
	  
     */
    public function __construct(Request $request)
    {
		
		$this->middleware(function ($request, $next) {
            if(Session::get("igLoggedIn") == false && empty(Session::get('igLoggedIn'))) {
               return redirect()->route('login')->with('error','Somthin is wrong?');
            }
			
			/* Retuen Base URL*/
			$this->baseUrl = Helper::BaseUrl();
			
			/* Session get org_uuid tokan and account_uuid*/
			$this->org_uuid = $request->session()->get('org_uuid');
			//$this->account_uuid = $request->session()->get('account_uuid');
			
			/* Session get access tokan and license token*/
			$this->access_token = $request->session()->get('access_token');
		    $this->license_token = $request->session()->get('license_token');
			
            return $next($request);
        });
		 
    }
	
	 /**
	* Display a listing of the resource.
	*
	* @return Response
	*/
    public function getProjects()
    {
        $url = $this->baseUrl."/".$this->org_uuid."/project"; 
			
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
			
		$method ='GET';			
		$requestData = [
				"org_uuid" 	=>  $this->org_uuid,
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		//dd($result);		 
		if($result->status->response==200)
		{
			//dd($result);
			$res = $result->data;
			return $res;
		}
		else
		{
			return false;
		}
    }
	 /**
	* Display a listing of the resource.
	*
	* @return Response
	*/
    public function index(Request $request)
    {
        $url = $this->baseUrl."/".$this->org_uuid."/recipient"; 
		//return view('recipients.list');	 die();
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
			
		$method ='GET';			
		$requestData = [
				"org_uuid" 	=>  $this->org_uuid,
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		//dd($result);
		$projects = $this->getProjects();
		if($result->status->response==200)
		{			 
			//dd($result);
			$res = $result->data;			
			return view('recipients.list',compact('res','projects'));
		}else{
			$res = "";
			$message = $result->status->message;
			Session::flash('error', $message); 
			return view('recipients.list',compact('res','projects'));
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
        $url = $this->baseUrl."/".$this->org_uuid."/recipient"; 
			
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
		
		if($request->input('uuid')!='')
		{
			//$uuid = Crypt::decrypt($request->input('uuid'));
			
			$method ='PUT';			
			$requestData = [
				"uuid" 			=>  $request->input('uuid'), 
				"org_uuid"		=>  $this->org_uuid,
				"project_uuid"  =>  $request->input('project_uuid'),
				"name" 			=>  $request->input('name'),
				"email" 		=>  $request->input('email'),				 
				"modified_by" 	=>  $this->org_uuid,
			];
			
		}else{
			$method ='POST';		 
			$requestData = [
				"project_uuid" 	=> $request->input('project_uuid'),
				"name" 			=> $request->input('name'),
				"email" 		=> $request->input('email'),				 
				"modified_by" 	=> $this->org_uuid,
				
		];
		}
				
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		
		//dd($result);
		if($result->status->response==200)
		{
			$message = $result->status->message;
			return redirect()->route('recipients')->with('success',$message);
		}else{
			//dd($result);
			echo $message = $result->status->message;
			return redirect()->route('recipients')->with('error',$message);
		}
    }

    /**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
    public function show(Request $request)
    {
        
 
    }

    /**
	* Show the form for editing the specified resource.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	* @param  int  $id
	* @return Response
	*/
    public function edit(Request $request, $id)
    {
		$project_uuid = Crypt::decrypt($id);
        echo $url = $this->baseUrl."/".$this->org_uuid."/recipient"; 
			
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
			
		$method ='PUT';			
		$requestData = [
				"uuid" 			=>  $project_uuid, 
				"name" 			=> "DLF Gurgaon Sector 124",
				"is_active" 	=> true,
				"modified_by" 	=> $this->org_uuid,
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		
		if($result->status->response==200)
		{
			$message = $result->status->message;
			return redirect()->route('recipients')->with('success',$message);
		}else{
			//dd($result);
			echo $message = $result->status->message;
			return redirect()->route('recipients')->with('error',$message);
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
        //
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
		$project_uuid = Crypt::decrypt($id);
		 
        $url = $this->baseUrl."/".$this->org_uuid."/recipient"; 
			
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
			
		$method ='DELETE';			
		$requestData = [
				"uuid" =>  $project_uuid, 
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		//dd($result);
		
		if($result->status->response==200)
		{
			$message = $result->status->message;
			return redirect()->route('recipients')->with('success',$message);
		}else{
			//dd($result);
			echo $message = $result->status->message;
			return redirect()->route('recipients')->with('error',$message);
		}
    }
}
