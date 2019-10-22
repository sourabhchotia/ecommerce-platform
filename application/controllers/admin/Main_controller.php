<?php

	defined('BASEPATH') or exit('No Direct Script is Allowed');
	
	/**
	 * 
	 */
	class Main_controller extends CI_Controller{
		
		function __construct(){

			parent::__construct();
			$this->load->model('admin/login','login');
		}

		public function index(){

			if($this->session->admin_id){
				redirect(site_url('admin/dashboard'));
			}
			$this->load->view('admin/auth/login');
		}

		public function admin_login(){

			$data = $this->login->admin_login();
		}

		public function admin_logout(){
			$this->session->sess_destroy();
			redirect(site_url('admin'));
		}
	}

?>