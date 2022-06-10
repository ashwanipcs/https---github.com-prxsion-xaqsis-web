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

class PERTAnalysisController extends Controller
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
		return view('pertanalysis.index',compact('peojectsArr'));
	 	 
    }
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function doCreate(Request $request)
    {	
		$project_uuid = $request->get('project_uuid');
		$simulation_type= $request->get('simulation_type');
		
		if($request->get('simulation_uuid'))
		{
			$simulation_uuid = $request->get('simulation_uuid');
			$summaryArr = $this->getSummaryByProjectuuidSimulationuuid($project_uuid,$simulation_uuid );
		}else
		{
			$simulation_uuid =0;
			$summaryArr = 0;
		}
		 
		$peojectsArr = $this->getProjects(); 
		$simulationArr = $this->getSimulation($project_uuid,$simulation_type);
		
		
		$costdetails =0;
		
		return view('pertanalysis.summary',compact('peojectsArr','project_uuid','simulationArr','simulation_uuid','summaryArr','costdetails'));
	 	 
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
     * Display PERT a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function getSummaryByProjectuuidSimulationuuid($project_uuid, $simulation_uuid)
	{
		$url = $this->baseUrl."/".$this->org_uuid."/pert_summary?project_uuid=".$project_uuid."&simulation_uuid=".$simulation_uuid; 
		$method ='GET';		
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
			
				
		$requestData = [
				//"org_uuid" 	=>  $this->org_uuid,
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
	
}
