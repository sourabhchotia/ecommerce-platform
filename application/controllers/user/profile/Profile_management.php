<?php 

	defined('BASEPATH') or exit('No direct script is allowed');

	/**
	 * 
	 */
	class Profile_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			$this->load->model('user/UserProfile','profile');
		}

		public function index(){

			if(!$this->session->user_id){
				redirect(site_url());
			}

			$metadata['metadata'] = get_meta_data(9);

			$data['profile'] = $this->profile->get_userdetails();
			$data['address'] = $this->profile->get_user_address();

			
			$this->load->view('wholesale/globals/header',$metadata);
			$this->load->view('wholesale/profile/my-account',$data);
			$this->load->view('wholesale/globals/footer');
		}

		public function signup_verification(){

			$data = $this->profile->signup_verification();
		}

		public function signup_complete(){

			$data = $this->profile->signup_complete();
		}

		public function login(){
			$data = $this->profile->login();
		}

		public function forget_password_verification(){

		}

		public function forget_password_otp_verification(){

		}

		public function reset_password(){


		}

		public function resend_otp(){

			
		}
		public function update_profile(){
			$data = $this->profile->update_profile();
		}

		public function add_address(){
			$data = $this->profile->add_address();
		}

		public function delete_address(){
			$data = $this->profile->delete_address();
		}

		public function check_zip(){
			$data = $this->profile->check_zipCode();

		}


		public function change_password(){

			$data = $this->profile->change_password();
		}

		public function logout(){

			$this->session->sess_destroy();

			redirect(site_url());
		}
	}