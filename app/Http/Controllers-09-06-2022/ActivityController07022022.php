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

class ActivityController extends Controller
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
	//==========Activity=============
		Route::get('activity', [ActivityController::class, 'index'])->name('activity');
		Route::get('activity/save', [ActivityController::class, 'store'])->name('activity.save');
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
				"uuid" 	=> $this->org_uuid,
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		//dd($result);
		if($result->status->response==500)
		{
			$message = $result->status->message;
			return redirect()->route('activity')->with('error',$message);
		}else{
			//dd($result);
			$res = $result->data;
			$rs =  $this->getImportActivity();
			return view('activity.index',compact('res','rs'));
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
		//{{xaqsis_url}}/api/{{org_uuid}}/activity
        $url = $this->baseUrl."/".$this->org_uuid."/activity"; 
			
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
			
		$method ='POST';		 
		$requestData = [				
				"name" 			=> "E1010-CommercialEquipment2",
				"description" 	=> "E1010-CommercialEquipment2 Input message",
				"is_system" 	=> true,
				"is_active" 	=> true,
				"modified_by"	=> $this->org_uuid,
				
		];
		//dd($requestData);
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		
		//dd($result);
		if($result->status->response==500)
		{
			$message = $result->status->message;
			return redirect()->route('activity')->with('error',$message);
		}else{
			//dd($result);
			echo $message = $result->status->message;
			return redirect()->route('activity')->with('success',$message);
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
        //{{xaqsis_url}}/api/{{org_uuid}}/activity
		$uuid = $request->input('uuid');
        $url = $this->baseUrl."/".$this->org_uuid."/activity?uuid=".$uuid ; 
			
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
			
		$method ='POST';		 
		$requestData = [				
				"name" 			=>  $request->input('name'),
				"description" 	=>  $request->input('description'),
				"is_system" 	=> true,
				"is_active" 	=>  $request->input('uuid') ? true : false ,
				"modified_by"	=> $this->org_uuid,
				
		];
		//dd($requestData);
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		
		//dd($result);
		if($result->status->response==500)
		{
			$message = $result->status->message;
			return redirect()->route('activity')->with('error',$message);
		}else{
			//dd($result);
			echo $message = $result->status->message;
			return redirect()->route('activity')->with('success',$message);
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
		 
        $url = $this->baseUrl."/".$this->org_uuid."/activity?uuid=".$uuid; 
			
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
			
		$method ='DELETE';			
		$requestData = [
				"uuid" =>  $uuid, 
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		//dd($result);
		
		if($result->status->response==404)
		{
			 $message = $result->status->message;
			return redirect()->route('activity')->with('error',$message);
		}else{
			//dd($result);
			$message = $result->status->message;
			return redirect()->route('activity')->with('success',$message);
		}	
    }
	
	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
    public function getImportActivity()
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
				"uuid" 	=> $this->org_uuid,
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		//dd($result);
		if($result->status->response==500)
		{
			$message = $result->status->message;
			return false;
		}else{
			//dd($result);
			$res = $result->data;
			return $res;
		}
    }
	/**
     * Activity a newly mport resource in storage.
     * @Post Method for Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function syncActivity(Request $request)
    {
		//{{xaqsis_url}}/api/{{org_uuid}}/activity
        $url = $this->baseUrl."/".$this->org_uuid."/activity"; 
		$method ='POST';		
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
			
		$nameArr 			= $request->input('name');
		$descriptionArr 	= $request->input('description');
		$isActiveArr 		= $request->input('is_active');
		
		$paramData =array();
		foreach($nameArr as $key=>$items)
		{
				$paramData[$key] = array(
								"name" 			=> $nameArr[$key],
								"description" 	=> $descriptionArr[$key],
								"is_system" 	=> true,
								"is_active" 	=> $isActiveArr[$key] ? true : false,
								"modified_by"	=> $this->org_uuid,
						);
		}
		//dd($paramData);
					 
		 foreach($paramData as $k =>$requestData)
		 {			 
			$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);
		 }
		$result = json_decode($response);
		
		dd($result);
		if($result->status->response==500)
		{
			$message = $result->status->message;
			return redirect()->route('activity')->with('error',$message);
		}else{
			//dd($result);
			echo $message = $result->status->message;
			return redirect()->route('activity')->with('success',$message);
		}
    }
	
}
