<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use GuzzleHttp\Client; 
use Ixudra\Curl\Facades\Curl;
use Helper;
use Session;

class ProjectEventMasterController extends Controller
{
   //give private url
	protected $baseUrl;
	//give private org uuid
	protected $org_uuid;
	//give private account uuid
	protected $account_uuid;
	//give private access-token
	protected $access_token;
	//give private license-token
	protected $license_token;	
	/**
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
			$this->account_uuid = $request->session()->get('account_uuid');			
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
    public function index(Request $request)
    {  
		//echo $project_uuid =  $request->get('project_uuid');
		if ($request->get('project_uuid')):
		
			$project_uuid =  $request->get('project_uuid');
           $url = $this->baseUrl."/".$this->org_uuid."/project_event?project_uuid=".$project_uuid;
		   
        else:
		
            $url = $this->baseUrl."/".$this->org_uuid."/project_event";
			
        endif;		
		 
		$method ='GET';	
		/* Difine Header Section*/				
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);	
		
		$requestData = [
			"org_uuid" 	=>  $this->org_uuid,
		];
	
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		
		$projects 	= $this->getAllProjects();
		$events 	= $this->getAllEvents();
		/* echo "<pre>";
			print_r($res);die; */	
		
		if($result->status->response==404)
		{
			$res = "";
			return view('projectsevents.index',compact('res','projects','events'));
		}
		else if($result->status->response==500)
		{
			$res = "";
			return view('projectsevents.index',compact('res','projects','events'));
		}else{
			 
			$res = $result->data;
			return view('projectsevents.index',compact('res','projects','events'));
		}	
    }
	
	/**
	* Display a store of the resource.
	*
	* @return Response
	*/
    public function store(Request $request)
    {  
		$url = $this->baseUrl."/".$this->org_uuid."/project_event";
		$method ='POST';	
		/* Difine Header Section*/				
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);	
		
		$projectArr = $request->input('project_uuid');
		
		foreach($projectArr as $key=>$val)
		{
			$requestData[$key] = [
					"project_uuid"	=> $projectArr[$key],
					"event_uuid"	=> $request->input('event_uuid'),
					"is_active"		=> true,
					"modified_by"	=> $this->account_uuid,
			];			
		
		}
		
		foreach($requestData as $k=>$requestParams)
		{				
			$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestParams);
		}		
		//print_r($v);
					
		$result = json_decode($response);
		//dd($result);
		$projects = $this->getAllProjects();
		/* echo "<pre>";
			print_r($res);die; */	
		
		if($result->status->response==404)
		{			
			$message = $result->status->message;
			return redirect()->route('projectevents')->with('error',$message);
		}
		else if($result->status->response==500)
		{
			$message = $result->status->message;
			return redirect()->route('projectevents')->with('error',$message);
			
		}else{
			 
			$res = $result->data;
			$message = $result->status->message;
			return redirect()->route('projectevents')->with('success',$message);
		}	
    }
	/**
	* Display a Projects listing of the resource.
	*
	* @return Response
	*/
    public function getAllProjects()
    {  
		$url = $this->baseUrl."/".$this->org_uuid."/project";
		$method ='GET';	
		/* Difine Header Section*/				
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);	
		
		$requestData = [
			"org_uuid" 	=>  $this->org_uuid,
		];
	
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		/*
		$res = $result->data;
		echo "<pre>";
		print_r($res);die; 	*/	 	
		
		if($result->status->response==404)
		{
			return false;
		}
		else if($result->status->response==500)
		{			 
			return false;
		}else{
			 
			return $result->data;
			 
		}	
    }
	/**
	* Display a Projects listing of the resource.
	*
	* @return Response
	*/
    public function getAllEvents()
    {  
		$url = $this->baseUrl."/".$this->org_uuid."/event";
		$method ='GET';	
		/* Difine Header Section*/				
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);	
		
		$requestData = [
			"org_uuid" 	=>  $this->org_uuid,
		];
	
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		/*
		$res = $result->data;
		echo "<pre>";
		print_r($res);die; 	*/	 	
		
		if($result->status->response==404)
		{
			return false;
		}
		else if($result->status->response==500)
		{			 
			return false;
		}else{
			 
			return $result->data;
			 
		}	
    }
}
