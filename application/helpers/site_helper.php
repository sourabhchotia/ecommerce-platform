<?php

/*
	
	Global Function for generating Random String Which can be used for recaptcha or for OTP verification

	Auhtor : Sourabh Chotia
	Date : 19-09-2019

*/

	if(!function_exists('generateOTP')) {
	  	function generateOTP($n) {
	    	$generator = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1357902468";  
		    $result = ""; 
		    for ($i = 1; $i <= $n; $i++) { 
		        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
		    }  
		    return $result;
	  	}
	}


/*
	
	Global Function for generating Random Numbers for Order ID

	Auhtor : Sourabh Chotia
	Date : 19-09-2019

*/

	if(!function_exists('generateOrderID')) {
	  	function generateOrderID($n) {

	  		$ci =& get_instance();

	    	$generator = "1357902468";  
		    $result = ""; 
		    for ($i = 1; $i <= $n; $i++) { 
		        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
		    }

		    $result = 'OD'.$result;

		    $ci->db->where('order_id',$result);
		    $order = $ci->db->get('whole_orders');

		    if($order->num_rows() > 0){
		    	generateOrderID($n);
		    }
		    return $result;
	  	}
	}

/*
	
	Global Function for generating Random Numbers for Transaction ID

	Auhtor : Sourabh Chotia
	Date : 19-09-2019

*/

	if(!function_exists('generatetransactionID')) {
	  	function generatetransactionID($n) {
	  		$ci =& get_instance();
	  		
	    	$generator = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1357902468";  
		    $result = ""; 
		    for ($i = 1; $i <= $n; $i++) { 
		        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
		    }

		    $result = 'OD'.$result;

		    $ci->db->where('transaction_id',$result);
		    $order = $ci->db->get('whole_user_transactions');

		    if($order->num_rows() > 0){
		    	generatetransactionID($n);
		    }
		    return $result;
	  	}
	}


/*
	
	Global Function for Sending SMS to users from anywhere

	Auhtor : Sourabh Chotia
	Date : 19-09-2019

	Required Parameters  are 

		1 : Mobile number
		2 : Content of Whole text message that has to be send.
	
*/


	if(!function_exists('sendSMS')) {
	  	function sendSMS($mobile, $msg){
			$xml_data ='<?xml version="1.0"?>
                        <smslist><sms>
                        <user>wdream</user>
                        <password>a6b19d6a3cXX</password>
                        <message>'.$msg.'</message>
                        <mobiles>+91'.$mobile.'</mobiles>
                        <accusage>1</accusage>
                        <senderid>WDREAM</senderid>
                        </sms></smslist>';
                        $URL = "http://sms.smsmenow.in/sendsms.jsp?";
                        $ch = curl_init($URL);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
                        curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch);
                        curl_close($ch);

                        return $output;
		}
	}

	if(!function_exists('check_slug')){

		function check_slug($slug,$tbl,$column,$column2 = '',$id=''){

			$ci =& get_instance();
			
			if(!empty($id)){

				$ci->db->where($column,$slug);
				$ci->db->where($column2,$id);
	       		$query = $ci->db->get($tbl);
	       		if($query->num_rows() > 0){
		            return $slug;

		       	}else{

		       		$ci->db->where($column,$slug);
		       		$query = $ci->db->get($tbl);
		       		if($query->num_rows() > 0){
			            return $slug.'-'.time();
			       	}
			       	return $slug;
		       	}
			}
       		$ci->db->where($column,$slug);
       		$query = $ci->db->get($tbl);
       		if($query->num_rows() > 0){
	            return $slug.'-'.time();
	       	}
	       	return $slug;
		}
	}


	if(!function_exists('uniqOrderID')){
		function uniqOrderID($lenght = 8) {
		    if (function_exists("random_bytes")) {
		        $bytes = random_bytes(ceil($lenght / 2));
		    } elseif (function_exists("openssl_random_pseudo_bytes")) {
		        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
		    } else {
		        throw new Exception("no cryptographically secure random function available");
		    }
		    return substr(bin2hex($bytes), 0, $lenght);
		}
	}



	/*

		Get Page Meta Deta On Load Using Page ID
		Author : Sourabh Chotia

	*/

	if(!function_exists('get_meta_data')){

		function get_meta_data($id){
			$ci =& get_instance();

			$ci->db->where('page_id',$id);
			return $ci->db->get('whole_page_seo')->row();
		}
	}


	/*

		Get Site Setting for each Values
		Author : Sourabh Chotia

	*/

	if(!function_exists('get_option')){

		function get_option($key = ''){
			$ci =& get_instance();

			$ci->db->where('setting_key',$key);
			return $ci->db->get('site_settings')->row()->setting_value;
		}
	}