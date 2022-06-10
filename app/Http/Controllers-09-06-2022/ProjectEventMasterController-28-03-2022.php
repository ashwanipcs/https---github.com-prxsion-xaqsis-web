<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use GuzzleHttp\Client; 
use Ixudra\Curl\Facades\Curl;
use Helper;
use Session;

class ProjectEventMasterController extends Controller
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
	 //==========Projects Events=============
Route::get('projectevents', [ProjectEventMasterController::class, 'index'])->name('projectevents');
Route::post('projectevents/create', [ProjectEventMasterController::class, 'store'])->name('projectevents.create');
Route::post('projectevents/update', [ProjectEventMasterController::class, 'update'])->name('projectevents.update');
Route::get('projectevents/remove/{id}', [ProjectEventMasterController::class, 'destroy'])->name('projectevents.remove');
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
			$res = $result->data;	
			//print_r($res);die;
			return view('projectsevents.index',compact('res'));
		 		
    }
}
