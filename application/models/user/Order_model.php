<?php

	defined('BASEPATH') or exit('No Direct script is allowed');

	/**
	 * 
	 */
	class Order_model extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function get_orders(){

			$this->db->select('*, SUM(order_sale_price) as price, SUM(order_qty) as qty');
			$this->db->from('whole_orders');
			$this->db->order_by('id','desc');
			$this->db->group_by('order_id');
			$this->db->where('order_user',$this->session->user_id);
			return $this->db->get()->result();
		}


		public function get_order_user_details($orderid){

			$this->db->select('*, SUM(order_sale_price) as price, SUM(order_qty) as qty');
			$this->db->from('whole_orders a');
			$this->db->join('whole_users e','e.user_id = a.order_user','left');
			$this->db->join('whole_user_address f','e.user_id = f.user_id','left');
			$this->db->where('a.order_id',$orderid);
			$this->db->group_by('order_id');
			return $this->db->get()->row();
		}

		public function get_order_details($orderid){

			$this->db->select('*');
			$this->db->from('whole_orders a');
			$this->db->join('whole_product_combinations b','b.combination_id = a.order_product','left');
			$this->db->join('whole_products c','b.combination_product = c.product_id','left');
			$this->db->join('whole_product_options d','d.p_attribute_combo = b.combination_id','left');
			$this->db->join('whole_attribute_options e','e.option_id = d.p_attribute_value','left');
			$this->db->where('a.order_id',$orderid);
			return $this->db->get()->result();
		}

		public function cancel_request(){
			$productID = $this->input->get('productID');
			$orderid = $this->input->get('orderID');

			$this->db->where('order_id',$orderid);
			$this->db->where('order_product',$productID);
			$query = $this->db->update('whole_orders',['order_status' => 'canceled','order_status_updated_by' => $this->session->user_id, 'updated_by_name' => 'user']);

			if($query){

				$this->db->select('*');
				$this->db->from('whole_product_combinations a');
				$this->db->join('whole_products c','a.combination_product = c.product_id','left');
				$this->db->where('combination_id',$productID);
				$product = $this->db->get()->row();

				$msg = 'Canceled : Your '. substr($product->product_name, 0, 15) .'... With Order ID #'.$orderid.' is Canceled. Please Contact to our customer service helpline number more details. For more details please call on '.get_option('contact_mobile');

				$output = sendSMS($this->session->user_mobile, $msg);

				if($output){
					$this->session->set_flashdata('success','Order Canceled Successfully.');
					redirect('order-detail?orderID='.$orderid);
				}else{
					$this->session->set_flashdata('error','Order Canceled Successfully.But Notification to user via sms failed');
					redirect('order-detail?orderID='.$orderid);
				}
			}else{

				$this->session->set_flashdata('error','Order Cancelation failed.Try again after some time');
				redirect('order-detail?orderID='.$orderid);
			}
		}
	}