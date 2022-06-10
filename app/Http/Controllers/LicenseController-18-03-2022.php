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
use Mail;

class LicenseController extends Controller
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
		$licensehistory = $this->licenseHistory();
		return view('license.index',compact('licensehistory'));
	 	 
    }
	/**
     * Create a newly created resource in storage.
     * @Post Method for License
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function doCreate(Request $request)
    {
		return view('license.add');
	}
	/**
     * Store a newly created resource in storage.
     * @Post Method for License
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = $this->baseUrl."/".$this->org_uuid."/license"; 
		$method ='POST';		 	
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);		
		
		$credits 	= intval($request->input('license_credits'));
		
		$requestData = [				 
				"license_type" 					=> $request->input('license_type'),
				"license_credits" 				=> $request->input('license_credits'),
				"license_txn_id"				=> "",
				"license_status"				=> $request->input('license_status') ? true : false,
				"license_status_description"	=> "Sample license status",
				"is_active"						=> $request->input('is_active') ? true : false,
				"modified_by" 					=> $this->account_uuid,
				
		];
		
		$response = Helper::xaqsisHgttpCurl($url,$headers,$method,$requestData);			
		$result = json_decode($response);		
		//dd($result);
		if($result->status->response==404)
		{
			$message = $result->status->message;
			return redirect()->route('license.create')->with('error',$message);
		}else if($result->status->response==500)
		{
			$message = $result->status->message;
			return redirect()->route('license.create')->with('error',$message);
		}else{
			$uuid = $result->data->uuid;
			$invoice = $this->synInvoice($uuid, $credits);
			$message = $result->status->message;
			return redirect()->route('license')->with('success',$message);
		}
    }
	
	/**
     * Store a newly created resource in storage.
     * @Post Method for Invoice
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function synInvoice($uuid, $price)
    {
        $url = $this->baseUrl."/".$this->org_uuid."/invoice"; 
		$method ='POST';		 	
		$headers = array(
			"Content-Type: application/json",
			"authorization: Basic ".base64_encode($this->access_token.":".$this->license_token),
			"cache-control: no-cache",
			"x-access-token: ".$this->access_token,
			"license-token: ".$this->license_token,
		);	
	 		
		$requestData = [				 
				"id" 				=> 1000001,
				"license_uuid" 		=> $uuid,
				"unit_price"		=> (int) $price,
				"quantity"			=> 1,				 
				"is_active"			=> true,
				"modified_by" 		=> $this->org_uuid,
				
		];
		
		//dd($requestData);		
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
			//dd($result);
			return true;
		}
    }


	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function licenseHistory()
    {	
		$url = $this->baseUrl."/".$this->org_uuid."/license";
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
		//dd($result);		
		 
		if($result->status->response==404)
		{			 
			return false;
		}else if($result->status->response==500)
		{			 
			return false;
		}else{
			//dd($result);
			return $result->data;			
			 
		}		 
    }
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function invoice($id)
	{
		$res = $this->getInvoiveByUuid($id);		 
		return view('invoices.index',compact('res'));
	}
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function getInvoiveByUuid($uuid)
	{
		$url = $this->baseUrl."/".$this->org_uuid."/invoice?license_uuid=".$uuid;
		
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
			
			$res = $result->data;			 
			return $res;
			 
		}		 
	}
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function sendInvoice(Request $request)
	{
		$uuid = $request->input('uuid');
		//$uuid = "0fa82bbd-08c9-4a28-8fd3-482cecbab1f5";
		$url = $this->baseUrl."/".$this->org_uuid."/invoice?license_uuid=".$uuid;
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
			
			$res = $result->data;			 
				 
		
		$header = "From: no-reply@heytuts.com\r\n";
		$to = "ashwani7jul@gmail.com";
		$subject = "Sending a basic email with php";
		$message ='<html>
					<head>
					<title>HTML email</title>
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
					</head>
					<body>					 
					<div class="invoice" id="invoice"> 
								 
                                <div class="d-md-flex justify-content-between align-items-center">
                                    <h2 class="font-weight-800 d-flex align-items-center">
                                        <img class="m-r-20" src="../public/assets/media/image/logo.png" alt="image">
                                    </h2>
                                    <h3 class="text-xs-left m-b-0">Invoice #INV-'.$res->id.'</h3>
                                </div>
                                <hr class="m-t-b-50">
                                <div class="row">
                                    <div class="col-md-6">
										<p>
                                            <h3>Biil To</h3>
                                        </p>                                         
                                        <p><strong>'.$res->bill_to->org_full_name .'</strong>, <br>'.$res->bill_to->address_line_1 .',<br>'.$res->bill_to->address_line_2
											.''.$res->bill_to->city .',<br>.'.$res->bill_to->state .', '.$res->bill_to->country .' -'.$res->bill_to->pin. ',<br>
											'.$res->bill_to->phone .',<br> '.$res->bill_to->gst .'</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-right">
                                            <b>Bill From</b>
                                        </p>
                                        <p class="text-right"><strong>'.$res->bill_from->org_full_name.'</strong>,<br>'.$res->bill_from->address_line_2.', 
										'.$res->bill_from->state.'-'.$res->bill_from->pin.',
										<br> '.$res->bill_from->country.', '.$res->bill_from->phone.',<br>
										 '.$res->bill_from->gst.'</p>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-4 mt-4">
                                        <thead class="thead-light">
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Description</strong></th>
                                            <th class="text-right"><strong>Quantity</strong></th>
                                            <th class="text-right"><strong>Unit cost</strong></th>
                                            <th class="text-right"><strong>Total</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                       										 
                                        <tr class="text-right">
                                            <td class="text-left">'.$res->id.'</td>
											<td class="text-left">'.$res->bill_from->org_full_name.'</td>
                                            <td class="text-left"> '.$res->quantity.'</td>
                                            <td> '.$res->unit_price.'  </td>
                                            <td>'.$res->total_amount.'</td>                                            
                                        </tr>                                        
										
                                        </tbody>
                                    </table>
                                </div>								
                                <div class="text-right">
                                    <p>Sub - Total amount:  '.$res->net_amount.'</p>
                                    <p>vat (18%) : '.$res->tax_amount.'</p>
                                    <h4 class="font-weight-800">Total : '.$res->total_amount.'</h4>
                                </div>
                                <p class="text-center small text-muted  m-t-50">
									<span class="row">
										<span class="col-md-6 offset-3">
										'.$res->bill_from->org_full_name.'
										</span>
									</span>
                                </p>
                            </div>
							 
					</body>
					</html>';
					//echo $message; die();

				if ( mail($to, $subject, $message, $headers) )
					echo 'Success!';
				else
					echo 'UNSUCCESSFUL...';	
					 
		}	
	}
}
