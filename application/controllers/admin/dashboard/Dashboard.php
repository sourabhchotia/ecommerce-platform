<?php

	defined('BASEPATH') or exit('No Direct Script is Allowed');

	/**
	 * 
	 */
	class Dashboard extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			if(!$this->session->admin_id){
				redirect(site_url('admin'));
			}
		}

		public function index(){

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/dashboard/dashboard');
			$this->load->view('admin/globals/footer');
		}
	}