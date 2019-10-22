<?php

	defined('BASEPATH') or exit('No direct script is allowed');

	/**
	 * 
	 */
	class Order_model extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function get_retail_orders(){

			$this->db->select('*');
			$this->db->from('whole_orders a');
			$this->db->join('whole_product_combinations b','b.combination_id = a.order_product','left');
			$this->db->join('whole_products c','b.combination_product = c.product_id','left');
			$this->db->join('whole_users d','d.user_id = a.order_user','left');
			$this->db->order_by('combination_id');
			$this->db->where('order_type','retail');
			return $this->db->get()->result();
		}

		public function get_wholesale_orders(){

			$this->db->select('*');
			$this->db->from('whole_orders a');
			$this->db->join('whole_product_combinations b','b.combination_id = a.order_product','left');
			$this->db->join('whole_products c','b.combination_product = c.product_id','left');
			$this->db->join('whole_users d','d.user_id = a.order_user','left');
			$this->db->order_by('combination_id');
			$this->db->where('order_type','wholesale');
			return $this->db->get()->result();
		}

		public function get_order_user_details($orderid){

			$this->db->select('*');
			$this->db->from('whole_orders a');
			$this->db->join('whole_users e','e.user_id = a.order_user','left');
			$this->db->join('whole_user_address f','e.user_id = f.user_id','left');
			$this->db->where('a.order_id',$orderid);
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

		public function order_status_update(){

			$status = $this->input->get('status');
			$orderid = $this->input->get('orderID');

			$this->db->where('order_id',$orderid);
			$query = $this->db->update('whole_orders',['order_status' => $status,'order_status_updated_by' => $this->session->admin_id, 'updated_by_name' => 'admin']);

			if($query){


				$this->db->order_by('id','asc');
				$this->db->limit(1);
				$this->db->where('order_id',$orderid);
				$orderDetail = $this->db->get('whole_orders')->row();


				$this->db->where('user_id',$orderDetail->order_user);
				$user = $this->db->get('whole_users')->row();


				$this->db->select('*');
				$this->db->from('whole_product_combinations a');
				$this->db->join('whole_products c','a.combination_product = c.product_id','left');
				$this->db->where('combination_id',$orderDetail->order_product);
				$product = $this->db->get()->row();


				if($status == 'processing'){

					$msg = 'Processed : Your '. substr($product->product_name, 0, 15) .'... With Order ID #'.$orderid.' is Processing. You will Receive another SMS once your order will be Packed/Shipped. For more details please call on '.get_option('contact_mobile');

				}else if($status == 'packed'){

					$msg = 'Packed : Your '. substr($product->product_name, 0, 15) .'... With Order ID #'.$orderid.' is Packed. You will Receive another SMS once your order will be Shipped. For more details please call on '.get_option('contact_mobile');

				}else if($status == 'shipped'){

					$msg = 'Shipped : Your '. substr($product->product_name, 0, 15) .'... With Order ID #'.$orderid.' is Shipped. You will Receive another SMS once your order will be Delivered. For more details please call on '.get_option('contact_mobile');

				}else if($status == 'delivered'){
						
					$msg = 'Delivered : Your '. substr($product->product_name, 0, 15) .'... With Order ID #'.$orderid.' is Processing. Thank You for Shopping with us. For more details please call on '.get_option('contact_mobile');

				}else if($status == 'canceled'){
					
					$msg = 'Canceled : Your '. substr($product->product_name, 0, 15) .'... With Order ID #'.$orderid.' is Canceled. Please Contact to our customer service helpline number more details. For more details please call on '.get_option('contact_mobile');

				}

				$output = sendSMS($user->user_mobile, $msg);

				if($output){

					$this->session->set_flashdata('success','Order Status updated Successfully.');
					if($orderDetail->order_type == 'retail'){

						redirect('admin/orders/order-listing');

					}else if($orderDetail->order_type == 'wholesale'){

						redirect('admin/orders/wholesale-order-listing');
					}
					
				}else{

					$this->session->set_flashdata('error','Order Status updated Successfully.But Notification to user via sms failed');
					if($orderDetail->order_type == 'retail'){

						redirect('admin/orders/order-listing');

					}else if($orderDetail->order_type == 'wholesale'){

						redirect('admin/orders/wholesale-order-listing');
					}
				}

			}else{
				$this->session->set_flashdata('error','Order Status update failed.Try again after some time');
				if($orderDetail->order_type == 'retail'){

						redirect('admin/orders/order-listing');

					}else if($orderDetail->order_type == 'wholesale'){

						redirect('admin/orders/wholesale-order-listing');
					}
			}
		}
	}