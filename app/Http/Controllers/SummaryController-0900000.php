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
		$segments 		 = explode('&simulation_type=', $project_uuid);
		$projectUuid 	 = $segments[0];
		$simulation_type = $segments[1]; 	
		
		if($request->get('activity_name'))
		{
			 
			$simulation_uuid  = $request->get('simulation_uuid');
			$activityname 	  = $request->get('activity_name');
			
		}elseif($request->get('simulation_uuid'))
		{
			 
			$simulation_uuid   = $request->get('simulation_uuid');
			$activityname 	  = "";
		}
		else{
			 
			$simulation_uuid   = "f2187078-072e-435d-8500-569e74d779dd"; 
			$activityname 	  = "";			
		} 
		 
		$summaryArr    = $this->getSummary($simulation_uuid,$projectUuid,$activityname);
		$costdetails   = $this->getCostSummaryDetails($projectUuid,$simulation_uuid,$activityname);
		
		$activityProjects  = $this->getActivityProjects($projectUuid);
		$simulation 	   = $this->getSimulation($projectUuid,$simulation_type);
		$projects 		   = $this->getProjects();
		//$summaryArr  	   = $this->getSummary($simulation_uuid,$projectUuid); 
				
		if($summaryArr){
			$summary = $summaryArr[0]->summary;
		}else{
			$summary = "";
		}
		//echo"<pre>";
		//print_r($costdetails);die();
		if($costdetails)
		{
			$yaxis1 = json_encode($costdetails->chart_data->yaxis);
			$yaxis=str_replace('"', "'",$yaxis1);
			$xaxis = json_encode($costdetails->chart_data->xaxis->data);
		}else{
			$yaxis="";
			$xaxis = "";
		}
		 
		//echo $xaxis; die();
			
		
        return view('summary.summary',compact('activityProjects','activityname','simulation','summary','summaryArr','simulation_uuid','projects','projectUuid','costdetails','yaxis','xaxis')); 
   
   }
   
   public function summary_filter_array($array,$term){
        $matches = array();
		if($array)
		{
			foreach($array as $a){
				if($a->summary->activity_name == $term)
					$matches[]=$a;
			}
			return $matches;
		}else{
			return false;
		}
    } 
	public function cost_filter_array($array,$term){
        $matches = array();
		if($array){
			foreach($array as $a){
				if($a->activity_name == $term)
					$matches[]=$a;
			}
			return $matches;
		}else{
			return false;
		}
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
    public function getSimulation($project_uuid,$simulation_type)
    {
        $url = $this->baseUrl."/".$this->org_uuid."/simulation?project_uuid=".$project_uuid."&simulation_type=".$simulation_type; 
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
        //$url = $this->baseUrl."/".$this->org_uuid."/cost_summary?simulation_uuid=".$simulation_uuid."&project_uuid=".$project_uuid; 
		$url = $this->baseUrl."/".$this->org_uuid."/cost_summary?simulation_uuid=".$simulation_uuid."&project_uuid=".$project_uuid; 
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
	
	public function costAnalysis()
	{
		$projects = $this->getProjects();
		return view('summary.costanalysis',compact('projects'));
	}
	
	public function getProjects()
	{
		$url = $this->baseUrl."/".$this->org_uuid."/project"; 
		$method ='GET';		
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
		//dd($result);
		if($result->status->response==404)
		{
			 
			return false;
		}else if($result->status->response==500)
		{
			return false;
		}else{
			 
			return $result->data;
		}
	}
	public function getCostSummaryDetails($project_uuid,$simulation_uuid,$activity_uuid)
	{
		
		 
		if($activity_uuid){
			$simulationuuid =$simulation_uuid;
			$activityuuid =$activity_uuid;			 
		}else{
			$simulationuuid ="e2f8bc5c-d718-42a7-845a-c580d2ed9f8a";
			$activityuuid ="c69909ac-70e0-4d0f-902b-aee5ae22744b";
			
		} 
		//$url =$this->baseUrl."/".$this->org_uuid."/xview_project_cost_probability_by_mcs?project_uuid=".$project_uuid."&simulation_uuid=".$simulationuuid."&activity_uuid=".$activityuuid."&report_uuid=822f1f21-453f-48cf-bde7-6e1844485c9a";
		$url =  $this->baseUrl."/".$this->org_uuid."/xview_project_cost_probability_by_mcs?project_uuid=".$project_uuid."&simulation_uuid=".$simulationuuid."&activity_uuid=".$activityuuid."&report_uuid=822f1f21-453f-48cf-bde7-6e1844485c9a";
		//die();
		$method ='GET';		
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
		//dd($result);
		if($result->status->response==404)
		{
			 
			return false;
		}else if($result->status->response==500)
		{
			return false;
		}else{
			 
			return $result->data;
		}
		
		die();
	}
	
	 
}
