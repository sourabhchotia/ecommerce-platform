<?php 

	defined('BASEPATH') or exit('No Direct Script is allowed');

	/**
	 * 
	 */
	class Profile_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			if(!$this->session->admin_id){
				redirect(site_url('admin'));
			}

			$this->load->model('admin/profile','profile');
		}

		public function index(){

			$data['profile'] = $this->profile->get_profile();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/profile/profile',$data);
			$this->load->view('admin/globals/footer');
		}

		public function update_profile(){

			$data = $this->profile->update_profile();
		}

		public function change_password(){

			$data = $this->profile->change_password();
		}

		public function add_admin(){

			$data['admins'] = $this->profile->get_all_admins();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/profile/add_admin',$data);
			$this->load->view('admin/globals/footer');
		}

		public function save_admin(){
			$data = $this->profile->save_admin();
		}

		public function get_admin(){
			$data = $this->profile->get_admin();
		}

		public function change_admin_status(){
			$data = $this->profile->change_admin_status();
		}
	}