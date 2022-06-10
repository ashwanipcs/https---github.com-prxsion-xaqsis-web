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


class EventsController extends Controller
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
		 
		$url = $this->baseUrl."/".$this->org_uuid."/event";
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
			//"org_uuid" 	=>  $this->org_uuid,
		];

		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);	
		//dd($result);
		if($result->status->response==404)
		{
			$message = $result->status->message;
			//return redirect()->route('events')->with('error',$message);
			$res = "";
			//return view('events.index',compact('res'));
			return view('events.index', compact('res'))->with('error',$message);
		}
		else if($result->status->response==500)
		{
			$message = $result->status->message;
			$res = "";
			return view('events.index', compact('res'))->with('error',$message);
		}else{
			//dd($result);
			$res = $result->data;
			return view('events.index',compact('res'));
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
        $url = $this->baseUrl."/".$this->org_uuid."/event"; 
		$method ='POST';		 	
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);	
		
		$start_date 	= strtotime($request->input('start_date'));
		$end_date 		= strtotime($request->input('end_date'));
		
		$requestData = [				 
					"name"			=> $request->input('name'),
					"description"	=> $request->input('description'),
					"event_type"	=> $request->input('event_type'),					
					"start_date"	=> $start_date,
					"end_date"		=> $end_date,
					"is_active"		=> $request->input('is_active') ? true : false,
					"is_productive"	=> $request->input('is_productive') ? true : false,
					"modified_by"	=> $this->account_uuid,
				
		];
		
		//dd($requestData);
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
		//dd($result);
		if($result->status->response==200)
		{
			 $message = $result->status->message;
			return redirect()->route('events')->with('success',$message);
		}else{
			//dd($result);
			$message = $result->status->message;
			return redirect()->route('events')->with('error',$message);
		}	
    }
	/**
     * Store a newly created resource in storage.
     * @Post Method for Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
		$uuid = $request->input('uuid');
		$url = $this->baseUrl."/".$this->org_uuid."/event?uuid=".$uuid; 
		$method ='PUT';		 	
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);	
		
		$start_date 	= strtotime($request->input('start_date'));
		$end_date 		= strtotime($request->input('end_date'));
		
		$requestData = [				 
					"name"			=> $request->input('name'),
					"description"	=> $request->input('description'),
					"event_type"	=> $request->input('event_type'),					
					"start_date"	=> $start_date,
					"end_date"		=> $end_date,
					"is_active"		=> $request->input('is_active') ? true : false,
					"is_productive"	=> $request->input('is_productive') ? true : false,
					"modified_by"	=> $this->account_uuid,
				
		];
		
		//dd($requestData);
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
		//dd($result);
		if($result->status->response==200)
		{
			 $message = $result->status->message;
			return redirect()->route('events')->with('success',$message);
		}else{
			//dd($result);
			$message = $result->status->message;
			return redirect()->route('events')->with('error',$message);
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
    public function destroy(Request $request, $uuid)
    { 
		echo $uuid;
		//$uuid = Crypt::decrypt($id);		 
        $url = $this->baseUrl."/".$this->org_uuid."/event?uuid=".$uuid;
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
			return redirect()->route('events')->with('success',$message);
		}else{
			//dd($result);
			$message = $result->status->message;
			return redirect()->route('events')->with('error',$message);
		}	
    }
}
