<?php

	defined('BASEPATH') or exit('No direct script is allowed');


	/**
	 * 
	 */
	class Cart_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			$this->load->model('user/Cart_model','usercart');
		}

		public function index(){

			$metadata['metadata'] = get_meta_data(12);

			$data['cartitems'] = $this->usercart->get_cart_items();
			$data['is_delivered'] = $this->usercart->get_deliverystatus();
			
			$this->load->view('wholesale/globals/header',$metadata);
			$this->load->view('wholesale/cart/cart',$data);
			$this->load->view('wholesale/globals/footer');
		}

		public function add_to_cart(){
			
			$data = $this->usercart->add_to_cart();
		}

		public function delete_cart(){

			$data = $this->usercart->delete_cart();
		}

		public function update_cart(){
			$data = $this->usercart->update_cart();
		}


		public function check_zip(){

			$data = $this->usercart->check_zip();
			if($data){
				echo json_encode(['msg' => 'done']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}
			
		}
	}