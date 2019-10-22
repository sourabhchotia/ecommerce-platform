<?php

	defined('BASEPATH') or exit('No direct Script is Allowed');

	/**
	 * 
	 */
	class Brands_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			if(!$this->session->admin_id){
				redirect(site_url('admin'));
			}
			
			$this->load->model('admin/brands','brand');
		}

		public function index(){
			
			$data['brands'] = $this->brand->get_brands();
			$data['admins'] = $this->db->get('whole_admin')->result();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/brands/add_brand',$data);
			$this->load->view('admin/globals/footer');

		}

		public function save_brands(){
			$data = $this->brand->save_brands();
		}

		public function edit_brand(){
			$data = $this->brand->get_brand();
		}

		public function change_brand_status(){
			$data = $this->brand->change_status();
		}
	}