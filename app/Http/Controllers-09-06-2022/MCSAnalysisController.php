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

class MCSAnalysisController extends Controller
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
		$peojectsArr = $this->getProjects(); 
		return view('mcsanalysis.index',compact('peojectsArr'));
	 	 
    }
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function doCreate(Request $request)
    {	
		//echo $request->get('simulation_uuid'); die;
		 $project_uuid = $request->get('project_uuid');
		 $simulation_type = $request->get('simulation_type');
		if($request->get('activity_name'))
		{
			$simulation_uuid = $request->get('simulation_uuid');
			$activityname = $request->get('activity_name');
		}else if($request->get('simulation_uuid'))
		{
			$simulation_uuid = $request->get('simulation_uuid');
			$activityname ="*";
		}else
		{
			$simulation_uuid =0;
			$activityname="";
		}
		
		
		$peojectsArr = $this->getProjects(); 
		$activityArr  = $this->getActivityProjects($project_uuid);
		$simulationArr = $this->getSimulation($project_uuid,$simulation_type);
			
		$summaryDataArr = $this->getMCSDefaultSummary($project_uuid,$simulation_uuid);				
		$summaryArr = $this->cost_filter_array($summaryDataArr,$activityname);		 
		$costdetails =0;
		
		//echo "<pre>";
		if($summaryArr)
		{
			foreach($summaryArr as $key=>$val){	
				$summaryResArr[$key] = $val->summary->mcs_summary;
				
			}
		}else{
			$summaryResArr="";
		}
		return view('mcsanalysis.summary',compact('peojectsArr','project_uuid','simulationArr','simulation_uuid','simulation_type','summaryResArr','costdetails','activityArr','activityname'));
	 	 
    }
	
	/**
     * Display star activiies return data a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 public function cost_filter_array($array,$term){
        $matchesArr = array();
		if($term)
		{
			foreach($array as $items){
				if($items->summary->activity_name == $term)
					$matchesArr[] = $items;
			}
			return $matchesArr;
		}else
		{
		 return false;
		}
    }
	 /**
     * Display Peojects a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
     * MCS Summary a newly created resource in storage.
     * @Post Method for Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function getMCSDefaultSummary($project_uuid,$simulation_id)
    {
        $url = $this->baseUrl."/".$this->org_uuid."/mcs_summary?project_uuid=".$project_uuid."&simulation_uuid=".$simulation_id; 
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
		//dd($result->data[0]->summary);
		if($result->status->response==404)
		{
			return false;
		}else{
			return $result->data; 
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
}
