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
use File;

class DashboardController extends Controller
{
    //give private url
	private $baseUrl;
	//give private org uuid
	protected $org_uuid;
	protected $org_name;
	//give private account uuid
	protected $account_uuid;
	protected $account_name;
	//give private access-token
	protected $access_token;
	//give private license-token
	protected $license_token;
	protected $logintime;
	
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
			/* Session get org_uuid tokan and account_uuid*/
			$this->org_uuid = $request->session()->get('org_uuid');
			$this->org_name = $request->session()->get('org_name');
			$this->account_uuid = $request->session()->get('account_uuid');
			$this->account_name = $request->session()->get('account_name');			
			/* Session get access tokan and license token from API*/
			$this->access_token = $request->session()->get('access_token');
		    $this->license_token = $request->session()->get('license_token');
			$this->logintime = $request->session()->get('logintime');
			
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
		return view('dashboard.dashboard'); 
    }	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAccountProfile(Request $request)
    {
		
		/*Final URL*/
		$url = $this->baseUrl."/".$this->org_uuid."/account?uuid=".$this->account_uuid;
		$method ='GET';				 
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);	
				
		$requestData = [
				'org_uuid'	 => $this->org_uuid 
				
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		if($result->status->response==200)
		{
			 $result =json_decode($response);
			//$message = $result->status->message;			
			return view('users.profile',compact('result'));
			
		}else{
			$resultRes =json_decode($response);
			$result = "";
			$message = $resultRes->status->message;
			Session::flash('error', $message); 
			return view('users.profile',compact('result'));			
		} 				
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEditAccountProfile(Request $request)
    {
		/*Final URL*/
		$url = $this->baseUrl."/".$this->org_uuid."/account?uuid=".$this->account_uuid;
		$method ='GET';
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);		
					
		$requestData = [
				'org_uuid'	 => $this->org_uuid 
				
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		 
		if($result->status->response==200)
		{
			
			$message = $result->status->message;			
			return view('dashboard.updateprofile',compact('result')); 
		}else{
			//dd($result); 
			 $message = $result->status->message;
			return redirect()->route('profile')->with('error',$message);
			
			
		}  
		
    }
	
	/**
     * Display a Update Profile of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAccountProfile(Request $request)
    { 
		/*Final URL*/
		$url = $this->baseUrl."/".$this->org_uuid."/account?uuid=".$this->account_uuid;
		$method ='PUT';
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);		
					
		$requestData = array(
				"first_name" 		=> $request->input('first_name'),
				"middle_name"		=> $request->input('middle_name'),
				"last_name"			=> $request->input('last_name'),
				"email"				=> $request->input('email'),
				"address_line1"		=> $request->input('address_line1')?$request->input('address_line1'):"",
				"address_line2"		=> $request->input('address_line2')?$request->input('address_line2'):"",
				"city"				=> $request->input('city')?$request->input('city'):"",
				"state"				=> $request->input('state')?$request->input('state'):"",
				"postal_code"		=> $request->input('postal_code')?$request->input('postal_code'):"",
				"country"			=> $request->input('country')?$request->input('country'):"",
				"work_phone"		=> $request->input('work_phone')? $request->input('work_phone'): "",
				"home_phone"		=> $request->input('home_phone')?$request->input('home_phone'):"",
				"mobile_phone"		=> $request->input('mobile_phone')?$request->input('mobile_phone'):"",
				"dob"				=> $request->input('dob')?$request->input('dob'):"",
				"position_title"	=> $request->input('position_title')?$request->input('position_title'):"",
				"manager"			=> $request->input('manager')?$request->input('manager'):"",
				"employment_code"	=> $request->input('employment_code')?$request->input('employment_code'):"",
				"employment_type"	=> $request->input('employment_type')?$request->input('employment_type'):"",
				"doj"				=> $request->input('doj')?$request->input('doj'):"",
				"expiration"		=> "30",
				"is_active"			=> $request->input('is_active')? true:false ,
				"is_primary"		=> $request->input('is_primary')? true:false ,
				"is_administrator"	=> $request->input('is_administrator')? true:false ,
				"is_billing_manager" => $request->input('is_billing_manager')? true:false ,
				"is_support"		=> $request->input('is_support')? true:false ,
				"modified_by"		=> $this->account_uuid,	
			);		
		//echo json_encode($requestData); 
		/*echo "<pre>";
		print_r($requestData);
		die;*/
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		
		if($result->status->response==200)
		{
			//dd($result);
			$message = $result->status->message;
			return redirect()->route('dashboard.profile')->with('success',$message);
		}else{
			//dd($result); 
			$message = $result->status->message;			
			return redirect()->route('dashboard.profile')->with('error',$message);			
		}  
    }
	public function postProfile(Request $request)
	{
		echo "edit profile controller";
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function changeAccountPassword()
	{
		return view('dashboard.updateaccountpassword');
	}
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 public function postChangeAccountPassword(Request $request)
	 {
		/* Request URL */
		$url = $this->baseUrl."/".$this->account_uuid."/updateaccountpassword"; 
		$method = "POST"; /* Method */
		/* Set Headers */
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
		/*Request Params*/
		$requestData = [
			"old_password"	 => $request->input('old_password_hash'), 
			"new_password"	 =>  $request->input('new_password_hash'), 
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		
		if($result->status->response==200)
		{
			
			//dd($result); 
			$message = $result->status->message;			
			session_unset();
			Session::flush();
			Session::forget('isLoggedIn');
			return redirect()->route('login')->with('success',$message); 	
		}
		else{
			$message = $result->status->message;
			return redirect()->route('changeaccountpassword')->with('error',$message);
		}	
	 }

	/**
     * Upload Profile Image of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function fileUpload(Request $request)
	{
		$this->validate($request, [             
            'filename' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);
		
		$path = public_path('storage/users/'.$this->account_uuid);
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
		if ($request->hasFile('filename')) {			
			 
    
			$file      			= $request->file('filename');
			$filename  			= $file->getClientOriginalName();
			$extension 			= $file->getClientOriginalExtension();
			$fileNameToStore 	= $this->account_uuid. '.jpg';
			 
			//move image to public/image folder
			if(File::exists($path.'/'.$fileNameToStore) ){
				File::delete($path.'/'.$fileNameToStore);
				$file->move($path, $fileNameToStore);
				// image uplode function Succesfully saved message
				$message = "Successfully, you have uploaded profile picture";	
				return redirect()->route('dashboard.profile')->with('success',$message);
			}else{
				$file->move($path, $fileNameToStore);
				// image uplode function Succesfully saved message
				//echo response()->json(["message" => "Image Uploaded Succesfully"]);
				$message = "Successfully, you have uploaded profile picture";	
				return redirect()->route('dashboard.profile')->with('success',$message);
			}
			
		}
		else {
			$message = "Image format is jpg,jpeg,png,svg,gif|max:2048";
			return redirect()->route('dashboard.profile')->with('error',$message); 
		}
	}
	
	
		 /**
     * Accunt a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function accountIndex(Request $request)
    {
		 	 
			/*Final URL*/
			$org_uuid = $this->org_uuid;
			$org_name = $this->org_name;
			
			$url = $this->baseUrl."/".$this->org_uuid."/aac?account_uuid=".$this->account_uuid;
			//$url = $this->baseUrl."/".$this->org_uuid."/account";
			$method ='GET';				 
			$headers = array(
				"Content-Type: application/json",
				"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
				"cache-control: no-cache",
				"x-access-token: ".$this->access_token,
				"license-token: ".$this->license_token,
			);	
					
			$requestData = [
					'org_uuid'	 => $this->org_uuid 
					
			];
			
			$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
			$result = json_decode($response);
			//dd($result);			
			$inviteurl =   "http://159.203.172.63:8090/createaccountinvite?org_uuid=".$this->org_uuid;			
			if($result->status->response==200)
			{		
				$res = $result->data;
				$userRoles = $this->getRoles();
				/*Start Get Method for invite users list*/
				$inviteGetUrl =$this->baseUrl."/".$this->org_uuid."/invitation";
				$inviteGetMethod = "GET";
				$inviteGetHeaders = array(
								"Content-Type: application/json",
								"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
								"cache-control: no-cache",
								"x-access-token: ".$this->access_token,
								"license-token: ".$this->license_token,
							);
				$inviteGetRequestData = array();
				$inviteResponse = Helper::xaqsisHgttpCurl($inviteGetUrl,$inviteGetHeaders,$inviteGetMethod,$inviteGetRequestData);			
				$inviteResult = json_decode($inviteResponse);
				 
				if($inviteResult->status->response==200)
				{
					$inviteUsers = $inviteResult->data;
				}else
				{
					$inviteUsers = "";
				}
				
				/*End Get invite Users*/
				
				return view('dashboard.accounts', compact('res','org_uuid','org_name','inviteurl','userRoles','inviteUsers')); 	
				
			}else{				 
				 $res = "";	
				 $inviteUsers = "";
				 $userRoles = $this->getRoles();			 
				return view('dashboard.accounts',compact('res','org_uuid','org_name','inviteurl','userRoles','inviteUsers'));	
							
			} 			
		 
    }
	/**
     * Invite Send of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function inviteSendIndex(Request $request)
	{
			$baseUrl = Helper::BaseUrl();
			$method ='POST';
			$org_uuid = $request->input('org_uuid');
			$url =  $baseUrl."/".$org_uuid."/inviteuser"; 
			$request->input('invite_url');
			 
			$headers = array(
				"Content-Type: application/json",
				"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
				"cache-control: no-cache",
				"x-access-token: ".$this->access_token,
				"license-token: ".$this->license_token,
			);	
			
			$name = $request->input('new_account_name');
			$lname = $request->input('new_account_lname');
			$email = $request->input('new_account_email');
			$invite_url = $request->input('invite_url');
			$inviteurl =   $invite_url."&name=".$name."&lname=".$lname."&email=".$email;
			
			$requestData = array(
						"new_account_name" 	=> $name,
						"new_account_email"	=> $email,
						"url"				=> $inviteurl,
				);
			/* Check Invite User IF Exists */	
			$checkUserApiUrl = $baseUrl."/checkuser?email=".$request->input('new_account_email');
			$checkUserMethod ="GET";
			$checkUserHeaders = array(
				"Content-Type: application/json",
				"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
				"cache-control: no-cache",
				"x-access-token: ".$this->access_token,
				"license-token: ".$this->license_token,
			);	
			
			$checkUseRrequestData = array();
			$checkUserResponse =  Helper::xaqsisHgttpCurl($checkUserApiUrl,$checkUserHeaders,$checkUserMethod,$checkUseRrequestData);
			$checkUserResult = json_decode($checkUserResponse);
			//dd($checkUserResult);
			/* End Check User exists*/
			if($checkUserResult->status->response==200)
			{
				$message = "This email address is already try different email";
				return redirect()->route('accounts')->with('error',$message);
			}else{
				$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
				$result   = json_decode($response);					 
				//dd($result);	
				/*Method For check user if exists */
				$checkUserEmail = $this->checkUserIfExsitsEmail($email);				
				if($checkUserEmail->status->response==200)
				{
					//dd($checkUserEmail);
					/*Call API Method for save invite data 30/05/2022*/						
					/*Invitation user save data */
					$invitationUsers = $this->saveUserInvitation($name,$lname,$email);
					if($invitationUsers->status->response==200)
					{
						return redirect()->route('accounts')->with('success',"New Account Email has been queued");
					}else
					{
						$message = $invitationUsers->status->message;
						return redirect()->route('accounts')->with('error',$message);
					}
					/*EOF Invitation user */
				}else{
					$message = $checkUserEmail->status->message;
					return redirect()->route('accounts')->with('error',$message);
				}
				/*EOF check exists user*/
			}
	}
	
	/**
     * Save Invitation of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
	public function saveUserInvitation($name,$lname,$email)
	{
		$url 	= $this->baseUrl."/".$this->org_uuid."/invitation";
		$method = "POST";
		$headers =  array(
					"Content-Type: application/json",
					"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
					"cache-control: no-cache",
					"x-access-token: ".$this->access_token,
					"license-token: ".$this->license_token,
				);
		$requestData = array(
						"first_name"	=>	$name,
						"last_name"		=>  $lname,
						"email"			=>	$email,
						"modified_by"	=>  $this->account_uuid
					);
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result   = json_decode($response);
		if($result)
		{
			return $result;
		}
	}
	
	/**
     * User Email  of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
	public function checkUserIfExsitsEmail($email)
	{
		$url =$this->baseUrl."/".$this->org_uuid."/invitation";
		$method = "GET";
		$headers = array(
						"Content-Type: application/json",
						"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
						"cache-control: no-cache",
						"x-access-token: ".$this->access_token,
						"license-token: ".$this->license_token,
					);
		$requestData = array();
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);
		if($result)
		{
			return $result;
		}
	}
	
	/**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function accountAccessControlIndex(Request $request)
    { 
		/*Final URL*/
		//$account_uuid =  $this->account_uuid; 
		$account_uuid =  $request->get('account_uuid'); 
		//$url = $this->baseUrl."/".$this->org_uuid."/account";
		$url = $this->baseUrl."/".$this->org_uuid."/account?uuid=".$account_uuid;
		
		$method ='GET';
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);		
					
		$requestData = array();
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
		//dd($result);
		
		if($result->status->response==200)
		{
			//dd($result); 
			$res = $result->data;
			$userRoles = $this->getRoles();
			
			$acUrl 		= $this->baseUrl."/".$this->org_uuid."/aac?account_uuid=".$account_uuid;			
			$acMethod 	= "GET";
			$acHeaders 	= array(
							"Content-Type: application/json",
							"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
							"cache-control: no-cache",
							"x-access-token: ".$this->access_token,
							"license-token: ".$this->license_token,
						);
			
			$acRequestData 	= array();		
			$acResponse 	= Helper::xaqsisHgttpCurl($acUrl,$acHeaders,$acMethod,$acRequestData);			
			$acResult 		= json_decode($acResponse);
			//dd($acResult);
						
			if($acResult->status->response==200)	
			{
				$summaryDataArr = $acResult->data;	
				$acRes  	  = $this->filter_by_array_key_value($summaryDataArr,$account_uuid);				 			 
			}
			else{
				 
				$acRes="";				
			}
			 
		 	return view('dashboard.accountaccesscontrol',compact('res','userRoles','acRes')); 
			
		}else{
			
			$message = $result->status->message;
			return redirect()->route('accounts')->with('error',$message);
		}  
    }
	public function filter_by_array_key_value($array,$term){
        $matches = array();
        foreach($array as $a){
            if($a->account_uuid == $term)
                $matches[]=$a;
        }
        return $matches;
	} 
	
	/**
     * Display a Roles listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoles()
    { 
		 
		$url = $this->baseUrl."/".$this->org_uuid."/role";
		 
		$method ='GET';
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);		
					
		$requestData = array();		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
		//dd($result);		 
		if($result->status->response==200)
		{
			//dd($result); 
			$res = $result->data;			
			return $res;
		}else{
			$message = $result->status->message;
			return redirect()->route('accounts')->with('error',$message);
		}  
    }
	
	public function addAccessControlAction(Request $request)
	{
	 	
		$rolesArr = $request->input('role_uuid');
		$accountArr = $request->input('accountuuid');
		$uroleUiidArr = $request->input('roleuuid');
		
		foreach($rolesArr as $key => $role) {
			
			if (array_key_exists($role, $uroleUiidArr))
			  {
				$isActive = true;
			  }
			  else
			  {
				$isActive = false;
			  }
			foreach($accountArr as $k =>$v)
			{
				$requestParams[$key] = array(
							"account_uuid" 	=> $v,
							"role_uuid" 	=> $role,
							"is_active" 	=> $isActive,
							"modified_by" 	=> $this->account_uuid
					);
			}
		} 
		/*
		echo "<pre>";
		print_r($requestParams);
		die();
		*/
		$url = $this->baseUrl."/".$this->org_uuid."/ac";
		$method ='POST';
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);		
		
		foreach($requestParams as $requestData)
		{		
			//echo json_encode($requestData);
			$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);
		}
		
		$result 	= json_decode($response);
		if($result->status->response==200)
		{
			$message = $result->status->message;
			return redirect()->route('accounts')->with('success',$message);
		}else{
			$method1 ='PUT';
			foreach($requestParams as $requestData)
			{		
				//echo json_encode($requestData);
				$response1 = Helper::xaqsisHgttpCurl($url,$headers,$method1,$requestData);
			}
			
			$result1 	= json_decode($response1);
			if($result1->status->response==200)
			{
				$message1 = $result1->status->message;
				return redirect()->route('accounts')->with('success',$message1);	
			}
		}		
		//dd($result);
		
	}
	

	public function authLogout(Request $request)
	{
		/*Final URL*/
			$url = $this->baseUrl."/".$this->org_uuid."/audit?account_uuid=".$this->account_uuid;
			$method ='PUT';				 
			$headers = array(
				"Content-Type: application/json",
				"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
				"cache-control: no-cache",
				"x-access-token: ".$this->access_token,
				"license-token: ".$this->license_token,
			);	
			
			 
			$logoutTime =  strtotime("now");
			 
			$requestData =array(
							"login" 		=> $this->logintime,
							"logout"		=> $logoutTime,							 
							"modified_by"	=> $this->account_uuid
							
						);
			//echo json_encode($requestData);
			$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
			$result = json_decode($response);
			
			 //dd($result);
			if($result)
			{	
				if($result->status->response==200)
				{
					session_unset();
					Session::flush();
					Session::forget('isLoggedIn');
					return redirect()->route('login')->with('success','Log Out Successfully');
				} else{
					session_unset();
					Session::flush();
					Session::forget('isLoggedIn');
					return redirect()->route('login')->with('success','Log Out Successfully');
				}
			}else{
				 
				return redirect()->route('dashboard')->with('error','Sorry! something was not right with the inputs you provided');
			}
	}
	public function ajaxRefreshAccess(Request $request)
	{
		//print_r($request->all());
		$uuid  = $request->get('uuid');
		$fname = $request->get('fname');
		$email = $request->get('email');
		
		$url =  $this->baseUrl."/".$this->org_uuid."/refresh_access?account_uuid=".$uuid;		 
		$method ='POST';
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);
		
		$requestData = array();
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);
		$result = json_decode($response);
		
		if($result->status->response==200)
		{
			return $result;
		}else
		{
			return $result;
		}
			

	}
	
	
}
