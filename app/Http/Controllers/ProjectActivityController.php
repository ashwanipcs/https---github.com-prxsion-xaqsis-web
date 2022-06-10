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
		//dd($result);
		if($result->status->response==200)
		{
			$message = $result->status->message;
			//dd($result);
			return redirect()->route('projectactivity')->with('success',$message);
		}else{		 
			$message = $result->status->message;
			//dd($result);
			return redirect()->route('projectactivity')->with('error',$message);			 
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
		//dd($projectactivity);
		return view('projectactivity.addnew',compact('projects','activity','project_uuid','projectactivity')); 
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
		
		/* IF New Project Activity*/
		$project_uuid 				= $request->input('project_uuid');			
		$is_activeNewArr 			= $request->input('newis_active')? true : false;
		$activityNewArr  			= $request->input('newactivity_uuid');
		$mostlikelyCostNewArr  		= $request->input('newmostlikely_cost');
		$mostlikelyDurationNewArr  	= $request->input('newmostlikely_duration');
		$pessimisticCostNewArr  	= $request->input('newpessimistic_cost');
		$pessimisticDurationNewArrr = $request->input('newpessimistic_duration');
		$optimisticCostNewArr 		= $request->input('newoptimistic_cost');
		$optimisticDurationNewArr 	= $request->input('newoptimistic_duration');	 
		$predecessorsNewArr			= $request->input('newpredecessors');
		
		
		if(!empty($activityArr) && !empty($activityNewArr))
		{			
			$predecessorsParam 	= array();
			$predecessors		= array();		
			$paramData 			= array();
			
			foreach($predecessorsArr as $p=>$v)
			{
				//print_r($v);
				foreach($v as $p1=>$v1)
				{
					//echo $v1;
					$projectActivities = $this->getProjectActivityUuid($v1);
					$predecessorsParam[] = array($projectActivities->uuid=>$projectActivities->name);
					
					//print_r($projectActivities);
				}				
			}
			$predecessorshtml = htmlspecialchars(json_encode($predecessorsParam),ENT_QUOTES,'UTF-8');
			$predecessors = $predecessorsParam; 
			
			foreach($activityArr as $key=>$items)
			{
				
				$projectActivity = $this->getProjectActivityUuid($activityArr[$key]);				
				$paramData[$key] =array( 
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
			
			$predecessorsParamNew 	= array();
			$predecessorsNew		= array();		
			$paramDataNew 			= array();
			
			foreach($predecessorsNewArr as $p=>$v)
			{
				//print_r($v);
				foreach($v as $p1=>$v1)
				{
					//echo $v1;
					$projectActivities = $this->getProjectActivityUuid($v1);
					$predecessorsParamNew[] = array($projectActivities->uuid=>$projectActivities->name);
					//print_r($projectActivities);
				}
				
			}			
			$predecessorshtmlNew =	htmlspecialchars(json_encode($predecessorsParamNew),ENT_QUOTES,'UTF-8');	 
			$predecessorsNew = $predecessorsParamNew; 
			
			foreach($activityNewArr as $key=>$items)
			{			 
				
				$projectActivity = $this->getProjectActivityUuid($activityNewArr[$key]);
				$paramDataNew[$key] =array( 
							"org_uuid" 				=> $this->org_uuid,						
							"project_uuid" 			=> $project_uuid,
							"activity_uuid" 		=> $activityNewArr[$key],
							"name" 					=> $projectActivity->name,
							"mostlikely_cost" 		=> $mostlikelyCostNewArr[$key],
							"mostlikely_duration" 	=> $mostlikelyDurationNewArr[$key],				
							"pessimistic_cost" 		=> $pessimisticCostNewArr[$key],
							"pessimistic_duration" 	=> $pessimisticDurationNewArrr[$key],
							"predecessors" 			=> $predecessorsNew,									
							"optimistic_cost" 		=> $optimisticCostNewArr[$key],	
							"optimistic_duration" 	=> $optimisticDurationNewArr[$key],
							"is_active" 			=> true,
							"modified_by"			=> $this->account_uuid,
						);
					
			}
			
			$mergeData = array_merge($paramData,$paramDataNew); 
			//echo json_encode($mergeData);
			//die();			
			$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$mergeData);
			$result = json_decode($response);
			//dd($result);
			if($result->status->response==200)
			{				
				$message = $result->status->message;
				return back()->with('success',$message);
			}else{
				$message = $result->status->message;
				return back()->with('error',$message);					
			}
			
		}
		else if(!empty($activityNewArr))
		{			
			$predecessorsParamNew 	= array();
			$predecessorsNew		= array();		
			$paramDataNew 			= array();	

			foreach($predecessorsNewArr as $p=>$v)
			{
				//print_r($v);
				foreach($v as $p1=>$v1)
				{
					//echo $v1;
					$projectActivities = $this->getProjectActivityUuid($v1);
					$predecessorsParamNew[] = array($projectActivities->uuid=>$projectActivities->name);
					//print_r($projectActivities);
				}
				
			}
			
			$predecessorsNew =	htmlspecialchars(json_encode($predecessorsParamNew),ENT_QUOTES,'UTF-8');
			$predecessorsNew = $predecessorsParamNew;
			
			foreach($activityNewArr as $key=>$items)
			{			 
				
				$projectActivity = $this->getProjectActivityUuid($activityNewArr[$key]);
				$paramDataNew[$key] =array( 
							"org_uuid" 				=> $this->org_uuid,						
							"project_uuid" 			=> $project_uuid,
							"activity_uuid" 		=> $activityNewArr[$key],
							"name" 					=> $projectActivity->name,
							"mostlikely_cost" 		=> $mostlikelyCostNewArr[$key],
							"mostlikely_duration" 	=> $mostlikelyDurationNewArr[$key],				
							"pessimistic_cost" 		=> $pessimisticCostNewArr[$key],
							"pessimistic_duration" 	=> $pessimisticDurationNewArrr[$key],
							"predecessors" 			=> $predecessorsNew,
							 				
							"optimistic_cost" 		=> $optimisticCostNewArr[$key],	
							"optimistic_duration" 	=> $optimisticDurationNewArr[$key],
							"is_active" 			=> true,
							"modified_by"			=> $this->account_uuid,
						);
					
			}
		
			//echo json_encode($paramDataNew); die();
			$response1 = Helper::xaqsisHgttpCurl($url,$headers,$method,$paramDataNew);
			$result1 = json_decode($response1);		
			//dd($result);
			if($result1->status->response==200)
			{
				$message = $result1->status->message;
				//return redirect()->route('projects')->with('error',$message);
				 return back()->with('success',$message);
			}else{
				//dd($result1);
				$message = $result1->status->message;
				 return back()->with('error',$message);
				//return redirect()->route('projects')->with('success',$message);
			}			
			
		}
		else
		{
			//echo "only update<pre>";			
			$predecessorsParam 	= array();
			$predecessors		= array();		
			$paramData 			= array();
			//print_r($predecessorsArr);  
			 
			foreach($activityArr as $key=>$items)
			{
				$projectActivity = $this->getProjectActivityUuid($activityArr[$key]);	
				
				foreach($predecessorsArr as $k => $v)
				{
					foreach($v as $k1=>$v1)
					{
						$projectActivities = $this->getProjectActivityUuid($v1);						 
						$predecessorsParam[$uuid[$k]][] = array($projectActivities->uuid=>$projectActivities->name);
						 
					}
				}
				
				$predecessors = $predecessorsParam;
				
				$paramData[$key] =array( 
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
			 
			
			foreach($paramData as $kr => $requestData)
			{			 
				//print_r( $requestData); 
				//$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);	
				
			}	
			//die();
			$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$paramData);
			$result = json_decode($response);		
			//dd($result);
			if($result->status->response==200)
			{
				$message = $result->status->message;
				//return redirect()->route('projects')->with('error',$message);
				 return back()->with('success',$message);
			}else{
				//dd($result);
				$message = $result->status->message;
				 return back()->with('error',$message);
				//return redirect()->route('projects')->with('success',$message);
			}
				
		}
		
    }
	/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function doCreate(Request $request)
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
		
				
		$projectActivity = $this->getProjectActivityUuid($request->input('activity_uuid'));				
		$predecessorsArr = $request->input('predecessors');	
		if($predecessorsArr)
		{
			foreach($predecessorsArr as $key=>$items)
			{
				$projectActivities 	 = $this->getProjectActivityUuid($items);
				$predecessorsParam[] = array($projectActivities->uuid=>$projectActivities->name);
			}
		}else
		{
			$predecessorsParam = "[]";
		}
		//echo json_encode($predecessorsParam);
		
		//echo print_r($predecessorsParam);		
		
		$requestData = array(				
				"org_uuid" 				=> $this->org_uuid,
				"project_uuid" 			=> $request->input('project_uuid'),
				"activity_uuid" 		=> $projectActivity->uuid,
				"name" 					=> $projectActivity->name,
				"mostlikely_cost" 		=> $request->input('mostlikely_cost'),
				"optimistic_cost" 		=> $request->input('optimistic_cost'),
				"pessimistic_cost" 		=> $request->input('pessimistic_cost'),
				"predecessors" 			=> $predecessorsParam,
				"mostlikely_duration" 	=>	$request->input('mostlikely_duration'),
				"optimistic_duration" 	=>  $request->input('optimistic_duration'),			
				"pessimistic_duration" 	=>  $request->input('pessimistic_duration'),
				"is_active" 			=> true,
				"modified_by"			=> $this->account_uuid,
			);
			
		$requestParams = array($requestData);
		//dd($requestData);
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
		//dd($result);
		if($result->status->response==200)
		{
			$message = $result->status->message;
			 return back()->with('success',$message);
		}
		else  
		{
			$message = $result->status->message;
			return back()->with('error',$message);
		} 
		 
	 }
	 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //{{xaqsis_url}}/api/{{org_uuid}}/projectactivity
		$uuid = "ad90a071-307a-446d-9fd1-454921f97d70";
        $url = $this->baseUrl."/".$this->org_uuid."/project_activity?uuid=".$uuid; 
		$method ='GET';		
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);			
			 
		$requestData = [				
				"org_uuid" => $this->org_uuid,
		];
		//dd($requestData);
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
		//dd($result);
		if($result->status->response==200)
		{
			$message = $result->status->message;
			return redirect()->route('projectactivity')->with('success',$message);
		}else{
			//dd($result);
			$message = $result->status->message;
			return redirect()->route('projectactivity')->with('error',$message);
		}
    }
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //{{xaqsis_url}}/api/{{org_uuid}}/projectactivity
		$uuid = $request->input('uuid'); 
        $url = $this->baseUrl."/".$this->org_uuid."/project_activity"; 	
		$method ='POST';		
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);	
		
				
		$projectActivity = $this->getProjectActivityUuid($request->input('activity_uuid'));	
		//print_r($projectActivity);	 die();	
		$predecessorsArr = $request->input('predecessors');	
		
		if($predecessorsArr)
		{
			foreach($predecessorsArr as $key=>$items)
			{
				$projectActivities 	 = $this->getProjectActivityUuid($items);
				$predecessorsParam[] = array($projectActivities->uuid=>$projectActivities->name);
			}
		}else{
			$predecessorsParam ="[]";
		}
		//echo json_encode($predecessorsParam);
		
		//echo print_r($predecessorsParam);		
		
		$requestData = [				
				"org_uuid" 				=> $this->org_uuid,
				"uuid"					=> $request->input('uuid'),
				"project_uuid" 			=> $request->input('project_uuid'),
				"activity_uuid" 		=> $projectActivity->uuid,
				"name" 					=> $projectActivity->name,
				"mostlikely_cost" 		=> $request->input('mostlikely_cost'),
				"optimistic_cost" 		=> $request->input('optimistic_cost'),
				"pessimistic_cost" 		=> $request->input('pessimistic_cost'),
				"predecessors" 			=> $predecessorsParam,
				"mostlikely_duration" 	=>	$request->input('mostlikely_duration'),
				"optimistic_duration" 	=>  $request->input('optimistic_duration'),			
				"pessimistic_duration" 	=>  $request->input('pessimistic_duration'),
				"is_active" 			=> true,
				"modified_by"			=> $this->account_uuid,
				
		];
		$requestParams = array($requestData);
		//dd($requestData);
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestParams);			
		$result = json_decode($response);		
		//dd($result);
		if($result->status->response==200)
		{
			$message = $result->status->message;
			 return back()->with('success',$message);
		}
		else  
		{
			$message = $result->status->message;
			 return back()->with('error',$message);
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
		
		if($result->status->response==200)
		{
			 $message = $result->status->message;
			  return back()->with('success',$message);
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
				//"org_uuid" 	=> $this->org_uuid,
				"uuid" 	=> $activity_uuid,
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
		
		if($result->status->response==200){
			$res = $result->data;
			//dd($res);
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
	/**
     * Update Project Activity the form for editing the specified resource.
     *
     * @param  int  $id
	  * @param  int  index
     * @return \Illuminate\Http\Response
     */
    public function updateProjectActivities(Request $request)
    {
        //$url 	= $this->baseUrl."/".$this->org_uuid."/project_activity"; 
		$url 	= $this->baseUrl."/".$this->org_uuid."/update_project_activity"; 
		$method ='POST';				
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
		
		 
		
		$uuid = $request->input('tableuuid');
		$index =  $request->input('tableIndex');
		/*echo "<pre>";
		print_r(array_unique($uuid) );
		print_r(array_unique($index));
		die();*/
		foreach($uuid  as $key=>$val)
		{
			$requestData[$key] = array('uuid'=>$val,'activity_index'=> (int)$index[$key]);
		}
		/*
		echo $a = json_encode($requestData);		 
		die();
		*/
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		if($result->status->response==200)
		{
			$message = $result->status->message;
			 return back()->with('success',$message);
		}
		else 
		{
			$message = $result->status->message;
			 return back()->with('error',$message);
		} 
    }
	
}
