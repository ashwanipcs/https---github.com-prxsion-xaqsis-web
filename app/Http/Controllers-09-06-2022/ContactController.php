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
		 
		 $request->validate([
            'name' => 'required',
            'email' => 'required|email',           
            'message' => 'required',
        ]);
	  //  Send mail to admin
       Mail::raw('Text to e-mail', function ($message) {
		   $message->to('ashwani7jul@gmail.com');
		});

        return redirect()->back()->with(['success' => 'Contact Form Submit Successfully']);
				 
    }
}
