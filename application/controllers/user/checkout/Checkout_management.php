<?php

	defined('BASEPATH') or exit('No Direct Sccript is Allowed');

	/**
	 * 
	 */
	class Checkout_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			$this->load->model('user/Cart_model','usercart');
			$this->load->model('user/Checkout_model','checkout');
		}

		public function index(){

			$this->load->model('user/UserProfile','profile');

			$metadata['metadata'] = get_meta_data(13);

			$data['cartitems'] = $this->usercart->get_cart_items();
			$data['addresses'] = $this->profile->get_user_address();

			$data['paymentMethods'] = $this->checkout->get_payment_methods();

			$this->load->view('wholesale/globals/header',$metadata);
			$this->load->view('wholesale/checkout/checkout',$data);
			$this->load->view('wholesale/globals/footer');
		}

		public function order_confirmation(){
			$data = $this->checkout->order_confirmation();
		}

		public function payment_confirmation(){

			$payment = $this->session->paymentMode;
			$this->db->where('pg_name',$payment);
			$pay = $this->db->get('whole_payment_gateways');
			if($pay->num_rows() == 0){
				$this->session->set_flashdata('error','Payment Method Not Found');
				redirect('checkout');
			}
			$pay = $pay->row();
			if($payment == 'payumoney'){
				$status = $this->input->post("status");
			    $firstname = $this->input->post("firstname");
			    $amount = $this->input->post("amount");
			    $txnid = $this->input->post("txnid");
			    $posted_hash = $this->input->post("hash");
			    $key = $this->input->post("key");
			    $productinfo = $this->input->post("productinfo");
			    $email = $this->input->post("email");
			    $mode = $this->input->post("mode");
			    $salt = $pay->pg_salt_key;
			    if ($this->input->post("additionalCharges")) {
			        $additionalCharges = $this->input->post("additionalCharges");
			        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
			    } else {
			        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
			    }

			    $transactionID = $txnid;
		    	$status = $status;
		    	$amount = $amount;
		    	$mode = $mode;

			    $hash = strtolower(hash("sha512", $retHashSeq));
			    if ($hash != $posted_hash) {
				    $msg = "Invalid Transaction. Please try again"; 
			    }else{
			    	
			    	$msg = "success";
			    }
			}else if($payment == 'instamojo'){

				$pay_id = $this->input->get('payment_id');
    			$req_id = $this->input->get('payment_request_id');

    			$this->load->library('instamojo');

    			$result = $this->instamojo->all_payment_request($pay->pg_merchant_key,$pay->pg_secret_key, 'live');

    			$amount ='';
				$mode ='';
				$transactionID ='';
				$status ='';
				
				foreach($result as  $key => $value){
					if(is_array($value)){
						$amount = $value['amount'];
						foreach($value as $key => $data){
						if(is_array($data)){
							foreach($data as $key => $second){
								$mode = $second['instrument_type'];
								$status = $second['status'];
								$transactionID = $second['payment_id'];
							}
						}
						}
					}
				}

				if($status == 'Failed'){
					$msg = "Payment Faild";
				}else{
					$msg = "success";
				}

			}else if($payment == 'ccavenue'){

				$this->load->library('crypto');

				$resonse_data = $this->crypto->decrypt( $this->input->post('encResponse'), $pay->pg_salt_key );

				$payment_data=explode('&', $resonse_data);
				$data_size=sizeof($payment_data);

				$auth_desc = null;
				$checksum = null;

				$mode = $amount = $txnid = $status = "";

				for($i = 0; $i < $data_size; $i++){
					$information = explode('=',$payment_data[$i]);
					if($i==3) {
		    			$status = $information[1];
		    		}
		    		if($i==5) {
		    			$mode = $information[1];
		    		}
		    		if($i==10) {
		    			$amount = $information[1];
		    		}
		    		if($i==1) {
		    			$txnid = $information[1];
		    		} 	
				}
				$payment_data_string = $pay->pg_merchant_key.'|'.$this->session->orderID.'|'.$amount.'|'.$status.'|'.$pay->pg_salt_key;
				$verify_checksum = $this->crypto->verifyChecksum( $this->crypto->genchecksum( $payment_data_string ), $checksum );

				$transactionID = $txnid;
		    	$status = $status;
		    	$amount = $amount;
		    	$mode = $mode;
				if($verify_checksum==TRUE && $auth_desc==="Y"){
					
					$msg = "success";
				}
				else if($verify_checksum==TRUE && $auth_desc==="B"){

					$msg = "pending";
				}
				else if($verify_checksum==TRUE && $auth_desc==="N"){

					$msg = "declined";
				}
				else{
					$msg = "error";
				}


			}else if($payment == 'paytm'){
				header("Pragma: no-cache");
            	header("Cache-Control: no-cache");
            	header("Expires: 0");
            	require_once(APPPATH . "/third_party/paytmlib/config_paytm.php");
           		require_once(APPPATH . "/third_party/paytmlib/encdec_paytm.php");
           		$paytmChecksum = "";
            	$paramList = array();
            	$isValidChecksum = "FALSE";
            	$paramList = $this->input->post();
            	$paytmChecksum = isset($this->input->post("CHECKSUMHASH")) ? $this->input->post("CHECKSUMHASH") : "";
            	$txnid =$this->input->post('TXNID');
	            $amount =$this->input->post('TXNAMOUNT');
	            $mode=$this->input->post('PAYMENTMODE');
	            $status = $this->input->post('STATUS');
	            $isValidChecksum = verifychecksum_e($paramList, $pay->pg_merchant_key, $paytmChecksum);

	            $transactionID = $txnid;
		    	$status = $status;
		    	$amount = $amount;
		    	$mode = $mode;

		    	if($isValidChecksum == "TRUE") {
	    			$msg = "success";
		    	}else{
		    		$msg = "error";
		    	}


			}else if($payment == 'paypal'){

			}else if($payment == 'payubiz'){

			}

			$data = $this->checkout->payment_confirmation($transactionID, $this->session->orderID, $status,$amount,$mode, $msg);
		}
	}