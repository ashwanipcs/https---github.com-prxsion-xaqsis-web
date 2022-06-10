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

class ProjectsController extends Controller
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
		if($result->status->response==200)
		{
			$res = $result->data;	
			if($res[0]->cost_simulation_uuid)
			{
				$simulation = $this->getSummary($res[0]->uuid,$res[0]->cost_simulation_uuid); 
				//dd($simulation);
				if($simulation)
				{
					$simulaions = $simulation->summary;
				}else{
					$simulaions ="";
				}
			 }else{
				$simulaions =""; 
			 }
			//echo $url2= $this->baseUrl."/".$this->org_uuid."/simulation_status?simulation_uuid=".$res[0]->simulation_uuid; 
			 
			//dd($simulaions );
			return view('projects.index',compact('res','simulaions'));
		}else  
		{
			$res='';
			$simulaions ="";
			return view('projects.index',compact('res','simulaions'));
		} 
    }

    /**
	* Show the form for creating a new resource.
	** @return \Illuminate\Http\Response
	* @return Response
	*/
    public function create(Request $request)
    {
		return view('project.addprojects');
    }

   /**
     * Store a newly created resource in storage.
     * @Post Method for Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = $this->baseUrl."/".$this->org_uuid."/project"; 
			
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
		
		
		if($request->input('include_critical_path')==1) 
		{	$include_critical_path = true;
		}else
		{
			$include_critical_path = false;
		}
		
		$configsDataArr = array(
						"cost_trials"=>$request->input('trials'),
						"pert_desired_min_duration"=>$request->input('desired_min_duration'),
						"pert_desired_max_duration"=>$request->input('desired_max_duration'),
						"mcs_include_critical_path"=>$include_critical_path,
						"mcs_trials"=>$request->input('pert_trials'),
						
					);
		
		if($request->input('editid')!='')
		{
			$project_uuid = Crypt::decrypt($request->input('editid'));
			
			$method ='PUT';			
			$requestData = [
				"uuid" 					=>  $project_uuid, 
				"name" 					=> $request->input('name'),
				"project_start_date" 	=> strtotime($request->input('project_start_date')),
				"is_active" 			=> true,
				"configs"				=> $configsDataArr,
				"modified_by" 			=> $this->org_uuid,
			];
		
		}else{
			$method ='POST';		 
			$requestData = [
					"org_uuid" 				=> $this->org_uuid,
					"name" 					=> $request->input('name'),
					"project_start_date" 	=> strtotime($request->input('project_start_date')),
					"is_active" 			=> true,
					"configs"				=> array($configsDataArr),
					"modified_by" 			=> $this->org_uuid,
					
			];
		}
		
		//echo json_encode($requestData);
		 //dd($requestData);		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		//dd($result);
		if($result->status->response==200)
		{
			$message = $result->status->message;
			return redirect()->route('projects')->with('success',$message);
		}else{
			//dd($result);
			echo $message = $result->status->message;
			return redirect()->route('projects')->with('error',$message);
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
        $url = $this->baseUrl."/".$this->org_uuid."/project"; 
			
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
				"modified_by" 	=> "f15f0e50-9686-4315-9b38-304a976947e1",
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		
		if($result->status->response==200)
		{
			echo $message = $result->status->message;
			//return redirect()->route('projects/create')->with('error',$message);
		}else{
			dd($result);
			echo $message = $result->status->message;
			//return redirect()->route('projects')->with('error',$message);
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
		$uuid = Crypt::decrypt($id);
		 
        $url = $this->baseUrl."/".$this->org_uuid."/project"; 
			
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
			
		$method ='DELETE';			
		$requestData = [
				"uuid" => $uuid, 
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		//dd($result);
		
		if($result->status->response==200)
		{
			 $message = $result->status->message;
			return redirect()->route('projects')->with('success',$message);
		}else{
			//dd($result);
			$message = $result->status->message;
			return redirect()->route('projects')->with('error',$message);
		}	
    }
	
	/**
     * Simulation a newly created resource in storage.
     * @Post Method for Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSummary($project_uuid,$simulation_uuid)
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
		 
		if($result->status->response==200)
		{
			return $result->data[0];
			
		}else{
			return false; 
		}
		 
    }
	

}
