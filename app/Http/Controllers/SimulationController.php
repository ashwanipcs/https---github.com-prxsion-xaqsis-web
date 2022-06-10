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

class SimulationController extends Controller
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
		$url = $this->baseUrl."/".$this->org_uuid."/simulation";
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
		$projects = $this->getProjects();
		
		if($result->status->response==404)
		{
			//dd($result);
			//$message = $result->status->message;
			//return redirect()->route('simulation')->with('error',$message);
			$res="";
			return view('simulation.index',compact('res','projects'));
		}elseif($result->status->response==500)
		{
			//dd($result);
			//$message = $result->status->message;
			//return redirect()->route('simulation')->with('error',$message);
			$res="";
			return view('simulation.index',compact('res','projects'));
		}else{
			//dd($result);
			$res = $result->data;	
			
			return view('simulation.index',compact('res','projects'));
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
        $url = $this->baseUrl."/".$this->org_uuid."/simulation"; 
		$method ='POST';		 	
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);		
		$requestData = [				 
				"simulation_type" 		=> $request->input('simulation_type'),
				"org_uuid" 				=> $this->org_uuid,
				"project_uuid" 			=> $request->input('project_uuid'),
				"name"					=> $request->input('name'),
				"description"			=> $request->input('description'),
				"is_active"				=> $request->input('is_active') ? true : false,
				"modified_by" 			=> $this->account_uuid,
				
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
		//dd($result);
		if($result->status->response==200)
		{
			$message = $result->status->message;
			return redirect()->route('simulation')->with('success',$message);
		}
		else{
			//dd($result);
			$message = $result->status->message;
			return redirect()->route('simulation')->with('error',$message);
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
		$uuid = $request->input('uuid');
		$url = $this->baseUrl."/".$this->org_uuid."/simulation?uuid=".$uuid; 
		$method ='PUT';		 	
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);		
		$requestData = [	
				"simulation_type" 		=> $request->input('simulation_type'),
				"org_uuid" 				=> $this->org_uuid,
				"project_uuid" 			=> $request->input('project_uuid'),
				"name"					=> $request->input('name'),
				"description"			=> $request->input('description'),
				"is_active"				=> $request->input('is_active') ? true : false,
				"modified_by" 			=> $this->account_uuid,
				
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
		//dd($result);
		if($result->status->response==200)
		{
			$message = $result->status->message;
			return redirect()->route('simulation')->with('success',$message);
		}
		else{
			//dd($result);
			$message = $result->status->message;
			return redirect()->route('simulation')->with('error',$message);
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
        $url = $this->baseUrl."/".$this->org_uuid."/simulation?uuid=".$uuid;
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
			return redirect()->route('simulation')->with('success',$message);
		}
		else{
			//dd($result);
			$message = $result->status->message;
			return redirect()->route('simulation')->with('error',$message);
		} 
    }
	/**
	* Display projects a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	* @return Response
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
				"org_uuid" 	=> $this->org_uuid,
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
	* Display simulation a listing of the resource.
	*
	& @project_uuid
	* @return \Illuminate\Http\Response
	* @return Response
	*/
    public function getSimulationByProjectuuid(Request $request)
    {
		$project_uuid 		= $request->get('project_uuid');  
		$simulation_type 	= $request->get('simulation_type');  
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
			"org_uuid" 		=> $this->org_uuid,
			"project_uuid" 	=> $project_uuid,
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		//dd($result);
		
		if($result->status->response==404)
		{
			return false;
		}
		else if($result->status->response==500)
		{
			return false;
		}else
		{
			return $result->data;
		}				
    }
	
	/**
     * Run Simulation a newly created resource in storage.
     * @Post Method for Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function runSimulation(Request $request)
    {
		$uuid 		  = $request->input('uuid');
		$project_uuid = $request->input('project_uuid');
		
        if($request->input('simulation_type')=='P')
		{
		 $url = $this->baseUrl."/".$this->org_uuid."/pert?simulation_uuid=".$uuid."&project_uuid=".$project_uuid; 
		}else if($request->input('simulation_type')=='M')
		{
			$url = $this->baseUrl."/".$this->org_uuid."/mcs?project_uuid=".$project_uuid."&simulation_uuid=".$uuid; 
		}else{
			$url = $this->baseUrl."/".$this->org_uuid."/cost_run?simulation_uuid=".$uuid."&project_uuid=".$project_uuid; 	
		}
		
		//$url = $this->baseUrl."/".$this->org_uuid."/cost_run?simulation_uuid=".$uuid."&project_uuid=".$project_uuid; 		
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
				"project_uuid" 			=> $project_uuid,				
				
				
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		//dd($result);	
		if($result)
		{
			return true;
		}
		else{
			return false;
		}
    }
	/**
     * Default Simulation a newly created resource in storage.
     * @Post Method for Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function defaultSimulation(Request $request)
    {
		$uuid = $request->input('defaultuuid');
		$url = $this->baseUrl."/".$this->org_uuid."/simulation_set_default?uuid=".$uuid; 
		$method ='POST';		 	
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);	
		
		$requestData = array(				 
				"uuid" => $uuid			
			);
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		//dd($result);	
		if($result->status->response==200)
		{
			$message = $result->status->message;
			return redirect()->route('simulation')->with('success',$message);
		}
		else{
			//dd($result);
			$message = $result->status->message;
			return redirect()->route('simulation')->with('error',$message);
		} 
	}
}
