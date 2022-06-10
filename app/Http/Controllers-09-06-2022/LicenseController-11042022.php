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
				
		
		if($result->status->response==404)
		{			 
			return false;
			dd($result);
		}else if($result->status->response==500)
		{			 
			return false;
			dd($result);
		}else{
			//dd($result);
			$message = $result->status->message;
			$res = $result->data;			 
				 
			/* Invoice mail send dispaly*/
			$to = 'ashwani7jul@gmail.com'; // receiver email
			$to .= 'sarabjeet.singh@prxsion.com'; // receiver email
			$subject = 'Invoive'; // subject
			$from = 'hello@xaqsis.com'; // send email
			
			 
			// To send HTML mail, the Content-type header must be set
			$headersMail = '';
			$headersMail .= 'From: XAQSIS.Admin.Team <'.$from.'>'."\r\n";
			$headersMail .= 'Reply-To: XAQSIS.Admin.Team <'.$from .'>'."\r\n";
			$headersMail .= 'Return-Path: XAQSIS.Admin.Team <'.$from .'>'. "\r\n";
			$headersMail .= 'MIME-Version: 1.0' . "\r\n";
			$headersMail .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
			$headersMail .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
			
						
			// Compose a simple HTML email message
			$messageHtml ='<html>
					<head>
					<title>HTML email</title>
					<style>
						/* reset */

						*
						{
							border: 0;
							box-sizing: content-box;
							color: inherit;
							font-family: inherit;
							font-size: inherit;
							font-style: inherit;
							font-weight: inherit;
							line-height: inherit;
							list-style: none;
							margin: 0;
							padding: 0;
							text-decoration: none;
							vertical-align: top;
						}
						/* heading */
						h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

						/* table */
						table { font-size: 75%; table-layout: fixed; width: 100%; }
						table { border-collapse: separate; border-spacing: 2px; }
						th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
						th, td { border-radius: 0.25em; border-style: solid; }
						th { background: #EEE; border-color: #BBB; }
						td { border-color: #DDD; }

						/* page */
						html { font: 16px/1 "Open Sans", sans-serif; overflow: auto; padding: 0.5in; }
						html { background: #999; cursor: default; }
						body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
						body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

						/* header */
						header { margin: 0 0 3em; }
						header:after { clear: both; content: ""; display: table; }
						header h1 { background: #2C509E; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
						header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
						header address p { margin: 0 0 0.25em; }
						header span, header img { display: block; float: right; }
						header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
						header img { max-height: 100%; max-width: 100%; }
						header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

						/* article */
						article, article address, table.meta, table.inventory { margin: 0 0 3em; }
						article:after { clear: both; content: ""; display: table; }
						article h1 { clip: rect(0 0 0 0); position: absolute; }

						article address { float: left; font-size: 125%; font-weight: bold; }

						/* table meta & balance */
						table.meta, table.balance { float: right; width: 36%; }
						table.meta:after, table.balance:after { clear: both; content: ""; display: table; }



						/* table items */
						table.inventory { clear: both; width: 100%; }
						table.inventory th { font-weight: bold; text-align: center; }
						table.inventory td:nth-child(1) { width: 26%; }
						table.inventory td:nth-child(2) { width: 38%; }
						table.inventory td:nth-child(3) { text-align: right; width: 12%; }
						table.inventory td:nth-child(4) { text-align: right; width: 12%; }
						table.inventory td:nth-child(5) { text-align: right; width: 12%; }

						/* table balance */
						table.balance th, table.balance td { width: 50%; }
						table.balance td { text-align: right; }

						/* aside */
						aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
						aside h1 { border-color: #999; border-bottom-style: solid; }


						@media print {
							* { -webkit-print-color-adjust: exact; }
							html { background: none; padding: 0; }
							body { box-shadow: none; margin: 0; }
							span:empty { display: none; }
							.add, .cut { display: none; }
						}

						@page { margin: 0; }
							</style>
							
							<style>
								#footer {
									position: fixed;
									padding: 10px 10px 0px 10px;
									bottom: 0;
									width: 100%;
									/* Height of the footer*/ 
									height: 40px;
									background: grey;
								}
							</style>
							 <script>
							  window.console = window.console || function(t) {};
							</script>
							<script>
							  if (document.location.search.match(/type=embed/gi)) {
								window.parent.postMessage("resize", "*");
							  }
							</script>
							</head>
				<body>
					<header>
						<h1>TAX Invoice</h1>
						<div class="row">
						  <div class="column">
							<address>
							<p>PRXSION Technologies Pvt. Ltd.</p>
							<p>H402, PALACIA, WAGHBIL<br>THANE(W) - 400615, MAHARASHTRA</p>
							<p>+91 99303 00053</p>
							<p>GST: 22AAAAA0000A1Z5</p>
							<p>PAN: AAAAA0000A</p>
						</address>
						  </div>
						  <div class="column" style="background-color:#bbb;">
							 <img src="../public/assets/media/image/logo.png" alt="logo">
							
						  </div>
						</div>			
					</header>
					<article>
						<h1>Recipient</h1>
						<address>
							<p>ABC Construction Pvt. Ltd<br>Kalina, Santacruz(W)<br>Mumbai</p>
						</address>
						<table class="meta">
							<tr>
								<th><span>Invoice #</span></th>
								<td><span>'.$res->id.'</span></td>
							</tr>
							<tr>
								<th><span>Date</span></th>
								<td><span>'.$ldate = date('Y-m-d H:i:s').'</span></td>
							</tr>
							<tr>
								<th><span>Amount (Rs.)</span></th>
								<td><span data-prefix></span><span>'.$res->total_amount.'</span></td>
							</tr>
						</table>
						<table class="inventory">
							<thead>
								<tr>
									<th width="60%"><span>Description</span></th>						
									<th><span>Rate</span></th>
									<th><span>Quantity</span></th>
									<th><span>Price</span></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td width="60%"><span>'.$res->bill_from->org_full_name.'(s) @ Rs. '.$res->total_amount.'/credit</span></td>					
									<td><span data-prefix></span><span>'.$res->total_amount.'</span></td>
									<td><span data-prefix></span><span>'.$res->quantity.'</span></td>
									<td><span data-prefix></span><span>'.$res->total_amount.'</span></td>
								</tr>
							</tbody>
						</table>
						
						<table class="balance">
							<tr>
								<th><span>Subtotal</span></th>
								<td><span data-prefix></span><span>'.$res->net_amount.'</span></td>
							</tr>
							<tr>
								<th><span>GST(18%)</span></th>
								<td><span data-prefix></span><span>'.$res->tax_amount.'</span></td>
							</tr>
							<tr>
								<th><span>Total</span></th>
								<td><span data-prefix></span><span>'.$res->total_amount.'</span></td>
							</tr>
						</table>
					</article>
					<aside>
						<h1><span>Additional Notes</span></h1>
						<div>
							<p>This is a computer generated invoice, no signature required.</p>
						</div>
					</aside>		
				</body>
			</html>';
				
				
			// Sending email to receipt
			if(mail($to, $subject, $messageHtml, $headersMail)){
				return redirect()->route('license')->with('success',$message);
			} else{
				return redirect()->route('license')->with('error',$message);
			}
		}	
		 	
	}
}
