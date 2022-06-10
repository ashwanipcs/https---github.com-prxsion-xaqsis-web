<?php
namespace App\Helpers;

/**
     * Display a listing of the resource.
     *https://stackoverflow.com/questions/43179978/how-to-call-custom-helper-in-laravel-5
     * @return \Illuminate\Http\Response
     */

class Helper{
	
	/**
     * Display a listing of the resource.
     * 
     * @return \App\Helpes fo login
     */
	public static function AuthLogin($url,$headers,$method) {
        // initialize curl resource
		$ch = curl_init();
		// set curl options
		curl_setopt_array($ch, array(
			CURLOPT_URL=> $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30000,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => $method,
				CURLOPT_HTTPHEADER => $headers,
			));
			// execute curl
			$response = curl_exec($ch);			
			//$err = curl_error($ch);
			return $response;
    }
	
	/**
 * 
 * @param string $url
 * @param string|array $post_fields
 * @param array $headers
 * @return type
 */
	public static function xaqsisHgttpCurl($url,$headers,$method,$params) {
        $curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30000,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $method,
			CURLOPT_POSTFIELDS => json_encode($params),
			CURLOPT_HTTPHEADER => $headers,
		));
		
		$response = curl_exec($curl);		 
		$err = curl_error($curl);
		/* 
		* Check for 404 (file not found). 
		*/
		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  
		// Check the HTTP Status code
		switch ($httpCode) {
			case 200:
				return $response;
				break;			 			 
			default:
					return $response;				 
				break;
		}
		curl_close($curl);
    }
	/**
     * Display a listing of the resource.
     * 
     * @return helpers base url
     */
	
    public static function BaseUrl()
    {
		$base_url = "http://159.203.172.63:8080/api";
        return $base_url;
    }
}