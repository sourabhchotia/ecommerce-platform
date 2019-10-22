<?php 

	defined('BASEPATH') or exit('No direct Script is allowed');

	/**
	 * 
	 */
	class Site_settings extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			if(!$this->session->admin_id){
				redirect(site_url('admin'));
			}

			$this->load->model('admin/Site_setting','settings');
		}

		public function index(){

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/settings/site_setting');
			$this->load->view('admin/globals/footer');
		}

		public function save_settings(){
			$data = $this->settings->save_settings();
		}

		public function payment_settings(){

			$data['payment_gateways'] = $this->settings->get_payments();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/settings/payment_setting',$data);
			$this->load->view('admin/globals/footer');
		}

		public function save_payment_settings(){
			$data = $this->settings->save_payment_settings();
		}
	}