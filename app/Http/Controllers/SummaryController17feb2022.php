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

class SummaryController extends Controller
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
		 
      
    }
	
	/**
     * Create a newly created resource in storage.
     * @Post Method for Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function doCreate(Request $request,$project_uuid)
	{
		$projectActivity = $this->getProjectActivity($project_uuid);
		$simulation_uuid ="5bb79063-4d7e-45c3-bd4b-12cd52eef934";
		$summary	= $this->getSummary($simulation_uuid,$project_uuid);
		return view('summary.summary', compact('projectActivity')); 
	}
	/**
     * Summary a newly created resource in storage.
     * @Post Method for Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSummary($simulation_uuid,$project_uuid)
    {
        echo $url = $this->baseUrl."/".$this->org_uuid."/cost_summary?simulation_uuid=".$simulation_uuid."&project_uuid=".$project_uuid; 
		$method ='GET';				
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
		
		$requestData = [
				
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);	
		dd($result);
		if($result->status->response==404){
			
			return false;
		}else if($result->status->response==500){
			return false;
		}else{
			return $result->data;
		}
		 
    }
	
	/**
	* Display a listing project activity of the resource.
	*
	* @return \Illuminate\Http\Response
	* @return Response
	*/
    public function getProjectActivity($project_uuid)
    {
        $url = $this->baseUrl."/".$this->org_uuid."/project_activity?project_uuid=".$project_uuid; 
		$method ='GET';				
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
		
		$requestData = [
				"org_uuid" 	=> $this->org_uuid,				 
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);	
		//dd($result);		
		if($result->status->response==404){
			
			return false;
		}else if($result->status->response==500){
			return false;
		}else{
			return $result->data;
		}
		 
    }
}
