<?php

	defined('BASEPATH') or exit('No direct script is allowed');


	/**
	 * 
	 */
	class Checkout_model extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}


		public function get_payment_methods(){

			$this->db->where('pg_visibility','1');
			$this->db->where('pg_status','1');
			return $this->db->get('whole_payment_gateways')->result();
		}

		public function order_confirmation(){
			

			$this->session->unset_userdata('items');
			$this->session->unset_userdata('paymentMode');
			$this->session->unset_userdata('orderID');

			$userid = $this->session->user_id;
			$useraddress = $this->input->post('address');
			$payment = $this->input->post('payment');

			$productName = '';

			if(empty($useraddress)){
				$this->session->set_flashdata('error','Please select an delivery address');
				redirect('checkout');
			}

			if(empty($payment)){
				$this->session->set_flashdata('error','Please select a Payment Method');
				redirect('checkout');
			}

			$this->db->where('cart_user_id',$userid);
			$cart = $this->db->get('whole_cart')->result();
			$orderID = generateOrderID(12);
			$total = 0;
			foreach($cart as $item){
				$this->db->select('*');
				$this->db->from('whole_products a');
				$this->db->join('whole_product_combinations b', 'b.combination_product = a.product_id','left');
				$this->db->join('whole_product_options c', 'c.p_attribute_combo = b.combination_id','left');
				$this->db->where('combination_id',$item->cart_combo_id);
				$product = $this->db->get()->row();
				if($product->combination_stock >= $item->cart_qty ){
					$data = array(
						'order_id' => $orderID,
						'order_user' => $userid,
						'order_user_add' => $useraddress,
						'order_product' => $item->cart_combo_id,
						'order_mrp' => $product->combination_price,
						'order_qty' => $item->cart_qty,
						'order_sale_price' => $product->combination_sale_price,
						'order_discount' => ($product->combination_price - $product->combination_sale_price),
						'order_total' => ($product->combination_sale_price * $item->cart_qty),
						'order_payment_mode' => strtoupper($payment),
						'order_type' => 'retail',
						'order_created_on' => date('y-m-d'),
						'order_created_from' => $this->input->ip_address(),
					);
					$result = 1; //$this->db->insert('whole_orders',$data);
					if($result){
						$this->db->where('combination_id',$item->cart_combo_id);
						$this->db->update('whole_product_combinations',['combination_stock' => ( $product->combination_stock - $item->cart_qty)]);
						$total += ($product->combination_sale_price * $item->cart_qty);
						$productName = $product->product_name;

						$items[] = $product->combination_id;
					}
					
				}
			}

			if(!empty($items)){

				$this->session->set_userdata('items',$items);

				$this->session->set_userdata('orderID',$orderID);

				if($payment != 'cod'){
					$this->db->where('pg_name',$payment);
					$pay = $this->db->get('whole_payment_gateways');
					if($pay->num_rows() == 0){
						$this->session->set_flashdata('error','Payment Method Not Found');
						redirect('checkout');
					}
					$pay = $pay->row();
					$this->session->set_userdata('paymentMode',$payment);
				}
				if($payment == 'cod'){
					$transactionID = generatetransactionID(16);
					$trdata = array(
						'transaction_id' => $transactionID,
						'transaction_order_id' => $orderID,
						'transaction_user' => $userid,
						'transaction_date' => date('y-m-d'),
						'transaction_status' => 'success',
						'transaction_mode' => 'cash',
						'transaction_amount' => $total
					);
					$query = $this->db->insert('whole_user_transactions',$trdata);
					if($query){

						foreach($items as $item){
							$this->db->where('cart_user_id',$userid);
							$this->db->where('cart_combo_id',$item);
							$cart = $this->db->delete('whole_cart');
						}
						
						$this->db->where('user_id',$userid);
						$user = $this->db->get('whole_users')->row();

						$msg = 'Order Placed : Your '. substr($productName, 0, 15) .'... With Order ID #'.$orderID.' amounting '.$total.' has been received. You will Receive another SMS once your order will be Processing. For more details please call on '.get_option('contact_mobile');

						$output = sendSMS($user->user_mobile, $msg);

						$this->session->unset_userdata('items');
						$this->session->unset_userdata('paymentMode');
						$this->session->unset_userdata('orderID');

						$this->load->view('wholesale/globals/header');
						$this->load->view('wholesale/checkout/thankyou',$trdata);
						$this->load->view('wholesale/globals/footer');
					}else{
						$this->session->set_flashdata('error','Transaction Couldnot be completed,Please Try again');
						redirect('checkout');
					}

				}else if($payment == 'payumoney'){

					$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
					$success_url = base_url().'order-confirmation';
	                $fail_url = base_url().'order-confirmation';
	                $hash_string = $pay->pg_merchant_key."|".$txnid."|".$total."|"."productinfo|".$this->session->user_name."|".$this->session->user_email."|||||||||||".$pay->pg_salt_key;
	                $hash = strtolower(hash('sha512', $hash_string));

	                $paydetail  =array(
	                	'firstname' => $this->session->user_name,
	                	'productinfo' => $productName,
	                	'email' => $this->session->user_email,
	                	'phone' => $this->session->user_phone,
	                	'surl' => $success_url,
	                	'furl' => $fail_url,
	                	'service_provider' => $pay->pg_password,
	                	'amount' => $total,
	                	'key' => $pay->pg_merchant_key,
	                	'hash' => $hash,
	                	'txnid' => $txnid,
	                );
	                $data['action'] = $pay->pg_url;
	                $data['details'] = $paydetail;
	                $this->load->view('wholesale/globals/header');
					$this->load->view('wholesale/checkout/payment_confirmation',$data);
					$this->load->view('wholesale/globals/footer');

				}else if($payment == 'instamojo'){

					$this->load->library('instamojo');
					$pay = $this->instamojo->pay_request( 

							$total, 
							"TEST", 
							$this->session->user_name, 
							$this->session->user_email , 
							$this->session->user_phone ,
			     			'TRUE' , 
			     			'TRUE' , 
			     			'FALSE',
			     			$pay->pg_merchant_key,
			     			$pay->pg_secret_key,
			     			base_url().'order-confirmation',
			     			'live'
			     		);
					$redirect_url = $pay['longurl'];
					redirect($redirect_url,'refresh');

				}else if($payment == 'ccavenue'){

					$this->load->library('crypto');

					$merchant_data= array();
	                $merchant_data['billing_name'] = $this->session->user_name;
	                $merchant_data['billing_tel'] = $this->session->user_phone;
	                $merchant_data['billing_email'] = $this->session->user_email;
	                $merchant_data['amount'] = $total;
	                $merchant_data['merchant_id'] = $pay->pg_merchant_key;
	                $merchant_data['order_id'] = $orderID;
	                $merchant_data['currency'] = 'INR';
	                $merchant_data['redirect_url'] = base_url().'order-confirmation';
	                $merchant_data['cancel_url'] = base_url().'checkout';
	                $merchant_data['language'] = 'EN';

	                $merchant_final = '';
	                foreach ($merchant_data as $key => $value){
	                  $merchant_final .=$key.'='.$value.'&';
	                }

	                $merchant_data = $this->crypto->getChecksum($pay->pg_merchant_key, $orderID, $total, base_url().'order-confirmation', $pay->pg_salt_key);

	                $encrypted_data= $this->crypto->encrypt($merchant_data,$pay->pg_salt_key);

	                $data['action'] = $pay->pg_url;
	                $data['access_code'] = $pay->pg_secret_key;
	                $data['encRequest'] = $encrypted_data;
	                $data['details'] = '';
	                $this->load->view('wholesale/globals/header');
					$this->load->view('wholesale/checkout/payment_confirmation',$data);
					$this->load->view('wholesale/globals/footer');

				}else if($payment == 'paytm'){

					header("Pragma: no-cache");
				   	header("Cache-Control: no-cache");
				   	header("Expires: 0");
				   	require_once(APPPATH . "/third_party/paytmlib/config_paytm.php");
				   	require_once(APPPATH . "/third_party/paytmlib/encdec_paytm.php");
				   	$checkSum = "";
	   				$paramList = array(
	   					'MID' => $pay->pg_salt_key,
	   					'ORDER_ID' => $orderID,
	   					'CUST_ID' => $this->session->user_phone,
	   					'INDUSTRY_TYPE_ID' => 'Retail',
	   					'CHANNEL_ID' => 'WEB',
	   					'TXN_AMOUNT' => $total,
	   					'WEBSITE' => PAYTM_MERCHANT_WEBSITE,
	   					'CALLBACK_URL' => base_url().'order-confirmation',
	   					'MSISDN' => $this->session->user_phone,
	   					'EMAIL' => $this->session->user_email,
	   					'VERIFIED_BY' => "MSISDN",
	   					'IS_USER_VERIFIED' => "YES"
	   				);

	             	$checkSum = getChecksumFromArray($paramList,$pay->pg_merchant_key);
	             	$data['action'] = $pay->pg_url;
	                $data['paramList'] = $paramList;
	                $data['CHECKSUMHASH'] = $checkSum;
	                $data['access_code'] = '';
	                $data['details'] = '';
	                $this->load->view('wholesale/globals/header');
					$this->load->view('wholesale/checkout/payment_confirmation',$data);
					$this->load->view('wholesale/globals/footer');

				}else if($payment == 'paypal'){

				}else if($payment == 'payubiz'){

				}
			}else{
				$this->session->set_flashdata('error','Couldnot Process Checkout. Please try Again');
				redirect('checkout');
			}
		}


		public function payment_confirmation($transactionID, $orderID, $status,$amount,$mode, $msg){

			$userid = $this->session->user_id;

			$trdata = array(
				'transaction_id' => $transactionID,
				'transaction_order_id' => $orderID,
				'transaction_user' => $this->session->user_id,
				'transaction_date' => date('y-m-d'),
				'transaction_status' => $status,
				'transaction_mode' => $mode,
				'transaction_amount' => $amount
			);

			$query = $this->db->insert('whole_user_transactions',$trdata);
			if($query){
				$items = $this->session->items;
				foreach($items as $item){
					$this->db->where('cart_user_id',$userid);
					$this->db->where('cart_combo_id',$item);
					$cart = $this->db->delete('whole_cart');
				}
				$this->db->where('user_id',$userid);
				$user = $this->db->get('whole_users')->row();
				$msg = 'Order Placed : Your '. substr($productName, 0, 15) .'... With Order ID #'.$orderID.' amounting '.$amount.' has been received. You will Receive another SMS once your order will be Processing. For more details please call on '.get_option('contact_mobile');
				$output = sendSMS($user->user_mobile, $msg);
				$this->session->unset_userdata('items');
				$this->session->unset_userdata('paymentMode');
				$this->session->unset_userdata('orderID');

				$site_msg = 'Order Placed Successfuly. Contact '.get_option('contact_mobile').' for more detail';
			}else{

				$site_msg = 'Order Placed Successfuly, But Transaction Record is invalid. please contact customer support on '.get_option('contact_mobile').' for more detail';
			}

			$data = array(
				'transaction_id' => $transactionID,
				'transaction_order_id' => $orderID,
				'transaction_status' => $status,
				'payment_msg' => $msg,
				'site_msg' => $site_msg
			);
			$this->load->view('wholesale/globals/header');
			$this->load->view('wholesale/checkout/thankyou',$data);
			$this->load->view('wholesale/globals/footer');
		}
	}