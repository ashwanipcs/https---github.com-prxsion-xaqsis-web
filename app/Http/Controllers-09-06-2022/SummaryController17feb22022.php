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
		//echo $request->get('simulation_uuid');		
		
		if($request->get('simulation_uuid'))
		{
			$simulation_uuid   = $request->get('simulation_uuid');
			$projectUuid       = $request->get('projectActivity_uuid');
			
		}else{
			$simulation_uuid   = "f2187078-072e-435d-8500-569e74d779dd";
			$projectUuid 	   = $project_uuid;
		}
		
		$activityProjects  = $this->getActivityProjects($projectUuid);
		$simulation 	   = $this->getSimulation($projectUuid);
		
		$summaryArr 	   = $this->getSummary($simulation_uuid,$projectUuid);
		$summary 		   = $summaryArr[0]->summary;
		//echo"<pre>"; print_r($summaryArr);die();
		
       return view('summary.summary',compact('activityProjects','simulation','summary','summaryArr','projectUuid')); 
    }
	/**
     * Activity Project a newly created resource in storage.
     * @Post Method for Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getActivityProjects($project_uuid)
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
		if($result->status->response==404)
		{
			return false;
		}else{
			return $result->data; 
		}
    }
	/**
     * Simulation a newly created resource in storage.
     * @Post Method for Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSimulation($project_uuid)
    {
        $url = $this->baseUrl."/".$this->org_uuid."/simulation?project_uuid=".$project_uuid; 
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
		if($result->status->response==404)
		{
			return false;
		}else{
			return $result->data; 
		}
    }
	
	/**
     * Simulation a newly created resource in storage.
     * @Post Method for Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSummary($simulation_uuid,$project_uuid)
    {
       // echo $url = $this->baseUrl."/".$this->org_uuid."/cost_summary?simulation_uuid=".$simulation_uuid."&project_uuid=".$project_uuid; 
	   $url = $this->baseUrl."/f15f0e50-9686-4315-9b38-304a976947e1/cost_summary?simulation_uuid=f2af744c-5726-4cd8-aaf3-45a0cfd20ba4&project_uuid=".$project_uuid; 
		$method ='GET';				
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
		$requestData = [
				//"org_uuid" 	=> $this->org_uuid,
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
		//dd($result);
		if($result->status->response==404)
		{
			return false;
		}else{
			return $result->data; 
		}
    }
	
	
}
