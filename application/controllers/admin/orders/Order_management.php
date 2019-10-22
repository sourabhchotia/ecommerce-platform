<?php

	defined('BASEPATH') or exit('No direct script is allowed');


	/**
	 * 
	 */
	class Order_management extends CI_Controller
	{
		
		function __construct(){
			
			parent::__construct();
			if(!$this->session->admin_id){
				redirect(site_url('admin'));
			}
			
			$this->load->model('admin/order_model','order');
		}

		public function index(){

			$data['orders'] = $this->order->get_retail_orders();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/orders/order_listing',$data);
			$this->load->view('admin/globals/footer');
		}


		public function wholesale_orders(){

			$data['orders'] = $this->order->get_wholesale_orders();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/orders/order_listing',$data);
			$this->load->view('admin/globals/footer');
		}

		public function order_detail(){

			$orderid = $this->input->get('orderID');

			$data['orderuserdetail'] = $this->order->get_order_user_details($orderid);
			$data['orderDetail'] = $this->order->get_order_details($orderid);

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/orders/order_detail',$data);
			$this->load->view('admin/globals/footer');
		}

		public function order_status_update(){
			$data = $this->order->order_status_update();
		}

		public function order_invoice(){

			$this->load->library('pdfgenerator');
			$orderid = $this->input->get('orderID');

			$data['orderuserdetail'] = $this->order->get_order_user_details($orderid);
			$data['orderDetail'] = $this->order->get_order_details($orderid);

			
    		$html = $this->load->view('admin/orders/invoice',$data, TRUE);

  
    		$filename = 'report_'.time();
    		$this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
		}

		public function return_listing(){
			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/orders/order_listing');
			$this->load->view('admin/globals/footer');
		}

		public function return_detail(){
			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/orders/order_listing');
			$this->load->view('admin/globals/footer');
		}

		public function return_status_update(){
			
		}
	}