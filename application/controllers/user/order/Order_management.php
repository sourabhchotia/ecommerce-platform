<?php

	defined('BASEPATH') or exit('No Direct Script is allowed');

	/**
	 * 
	 */
	class Order_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			$this->load->model('user/Order_model','orders');
		}

		public function index(){

			$metadata['metadata'] = get_meta_data(10);

			$data['orders'] = $this->orders->get_orders();

			$this->load->view('wholesale/globals/header',$metadata);
			$this->load->view('wholesale/order/order-listing',$data);
			$this->load->view('wholesale/globals/footer');
		}

		public function order_detail(){

			$orderid = $this->input->get('orderID');
			$metadata['metadata'] = get_meta_data(10);

			$data['orderuserdetail'] = $this->orders->get_order_user_details($orderid);
			$data['orderDetail'] = $this->orders->get_order_details($orderid);

			$this->load->view('wholesale/globals/header',$metadata);
			$this->load->view('wholesale/order/order-detail',$data);
			$this->load->view('wholesale/globals/footer');
		}

		public function order_invoice(){

			$this->load->library('pdfgenerator');
			$orderid = $this->input->get('orderID');

			$data['orderuserdetail'] = $this->orders->get_order_user_details($orderid);
			$data['orderDetail'] = $this->orders->get_order_details($orderid);

			
    		$html = $this->load->view('admin/orders/invoice',$data, TRUE);

  
    		$filename = 'report_'.time();
    		$this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
		}

		public function return_request(){
			
		}

		public function save_return_request(){
			
		}

		public function cancel_request(){

			$data = $this->orders->cancel_request();
		}
	}