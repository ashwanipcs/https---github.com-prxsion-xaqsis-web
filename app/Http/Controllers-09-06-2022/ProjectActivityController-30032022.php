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

class ProjectActivityController extends Controller
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
	* @return \Illuminate\Http\Response
	* @return Response
	*/
    public function index(Request $request)
    {
        $url = $this->baseUrl."/".$this->org_uuid."/project_activity"; 
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
		dd($result);
		if($result->status->response==500)
		{
			$message = $result->status->message;
			//dd($result);
			return redirect()->route('projectactivity')->with('error',$message);
		}else{
			if($result->status->response==200){
				//dd($result);
				$res = $result->data;
				//$rs =  $this->getImportActivity();
				return view('projectactivity.index',compact('res'));
			}else
			{
				$message = $result->status->message;
				//dd($result);
				return redirect()->route('projectactivity')->with('error',$message);
			}
		}
    }
	
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	* @return Response
	*/
    public function getAllProjectActivity()
    {
        $url = $this->baseUrl."/".$this->org_uuid."/project_activity"; 
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
		
		if($result->status->response==500)
		{
			$message = $result->status->message;
			//dd($result);
			//return redirect()->route('projectactivity')->with('error',$message);
		}else{
			if($result->status->response==200){
				$res = $result->data;
				dd($res);
				return $res;
				//$rs =  $this->getImportActivity();
				//return view('projectactivity.index',compact('res'));
			}else
			{
				$message = $result->status->message;
				//dd($result);
				//return redirect()->route('projectactivity')->with('error',$message);
			}
		}
    }
	 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
		//$project_uuid 		= Crypt::decrypt($id);
		$project_uuid 		= $id;
		$projects 			= $this->getProjects();		 
		$activity 			= $this->getActivity();
		$projectactivity 	= $this->getProjectActivity($project_uuid);			
		//echo "<pre>"; print_r($projectactivity); die();
        return view('projectactivity.add',compact('projects','activity','project_uuid','projectactivity')); 
    }
	
	/**
     * Store a newly created resource in storage.
     * @Post Method for Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		 
		//{{xaqsis_url}}/api/{{org_uuid}}/activity
        $url = $this->baseUrl."/".$this->org_uuid."/project_activity"; 
		$method ='POST';		
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);	
	
		$project_uuid 			= $request->input('project_uuid');
		$uuid 					= $request->input('uuid');
		$is_active 				= $request->input('is_active')? true : false;
		$activityArr  			= $request->input('activity_uuid');
		$mostlikelyCostArr  	= $request->input('mostlikely_cost');
		$mostlikelyDurationArr  = $request->input('mostlikely_duration');
		$pessimisticCostArr  	= $request->input('pessimistic_cost');
		$pessimisticDurationArr = $request->input('pessimistic_duration');
		$optimisticCostArr 		= $request->input('optimistic_cost');
		$optimisticDurationArr 	= $request->input('optimistic_duration');	 
		$predecessorsArr		= $request->input('predecessors');
		
		$predecessorsParam 	= array();
		$predecessors		= array();		
		$paramData 			= array();
		foreach($activityArr as $key=>$items)
		{ 
			
			$projectActivity = $this->getProjectActivityUuid($activityArr[$key]);
			
			//print_r($projectActivity->name);
			
			$projectActivities = $this->getProjectActivityUuid($predecessorsArr[$key]);
			$predecessorsParam[$key] = array($projectActivities->uuid=>$projectActivities->name);
			$predecessors =	$predecessorsParam;	 


			
			$paramData[$key] = array(
					"org_uuid" 				=> $this->org_uuid,
					"uuid" 					=> $uuid[$key],
					"project_uuid" 			=> $project_uuid,
					"activity_uuid" 		=> $activityArr[$key],
					"name" 					=> $projectActivity->name,
					"mostlikely_cost" 		=> $mostlikelyCostArr[$key],
					"mostlikely_duration" 	=> $mostlikelyDurationArr[$key],				
					"pessimistic_cost" 		=> $pessimisticCostArr[$key],
					"pessimistic_duration" 	=> $pessimisticDurationArr[$key],
					"predecessors" 			=> $predecessors,				
					"optimistic_cost" 		=> $optimisticCostArr[$key],	
					"optimistic_duration" 	=> $optimisticDurationArr[$key],
					"is_active" 			=> true,
					"modified_by"			=> $this->account_uuid,
			);
		}
		//dd($paramData);
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$paramData);	
		
		/*
		foreach($paramData as $k => $requestData)
		{			 
			$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);
		}	
		*/
		$result = json_decode($response);
		
		//dd($result);
		if($result->status->response==500)
		{
			$message = $result->status->message;
			//return redirect()->route('projects')->with('error',$message);
			 return back()->with('error',$message);
		}else{
			//dd($result);
			$message = $result->status->message;
			 return back()->with('success',$message);
			//return redirect()->route('projects')->with('success',$message);
		}
    }
	
	 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    { 
		//$uuid = Crypt::decrypt($id);
		$uuid = $id;
		
        $url = $this->baseUrl."/".$this->org_uuid."/project_activity?uuid=".$uuid; 
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
		
		if($result->status->response==404)
		{
			 $message = $result->status->message;
			  return back()->with('error',$message);
			//return redirect()->route('projectactivity/create/'.$uuid)->with('error',$message);
		}else{
			//dd($result);
			$message = $result->status->message;
			 return back()->with('error',$message);
			//return redirect()->route('projectactivity/create/'.$uuid)->with('success',$message);
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
		if($result->data)
		{
			return $res = $result->data;
		}else{
			return false;
		}
    }
	
	/**
	* Display activity a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	* @return Response
	*/
    public function getActivity()
    {
        $url = $this->baseUrl."/".$this->org_uuid."/activity"; 
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
		if($result->data)
		{
			return $res = $result->data;
		}else{
			return false;
		}
    }
	
	/**
	* Display a listing of the resource.
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
				//"org_uuid" 	=> $this->org_uuid,
				"project_uuid" 	=> $project_uuid,
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
		if($result->status->response==200){
			//dd($result);
			return $res = $result->data;
		}else{
			return false;
		}
		 
    }
	/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProjectActivityUuid($activity_uuid)
    {
        //$url 	= $this->baseUrl."/".$this->org_uuid."/project_activity"; 
		$url 	= $this->baseUrl."/".$this->org_uuid."/activity?uuid=".$activity_uuid; 
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
		if($result->status->response==200){
			//dd($result);
			return $res = $result->data;
		}else{
			return false;
		}
    }
}
