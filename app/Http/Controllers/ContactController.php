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

class ContactController extends Controller
{	 
	 /**
	* Display a listing of the resource.
	* 
	* @return Response
	*/
    public function contactForm(Request $request)
    {	
		 
		$to = 'ashwani7jul@gmail.com';

		$subject = 'Website Change Request';
		$from ="noreply@gmail.com";

		$headers  = "From: " .$from  . "\r\n";
		$headers .= "Reply-To: " . $from  . "\r\n";
		$headers .= "CC: susan@example.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

		$message = '<p><strong>This is strong text</strong> while this is not.</p>';


		$sender = mail($to, $subject, $message, $headers);
		
		 
		// Sending email
		if($sender){
			echo 'Your mail has been sent successfully.';
			//return redirect()->back()->with(['success' => 'Your mail has been sent successfully.']);
		} else{
			echo 'Unable to send email. Please try again.';
			//return redirect()->back()->with(['error' => 'Unable to send email. Please try again.']);
		}
         	 
    }
}
