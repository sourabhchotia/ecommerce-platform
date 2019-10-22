<?php

	defined('BASEPATH') or exit('No Direct script is allowed');


	/**
	 * 
	 */
	class Error_page extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function page_not_found(){

			if(strrpos($this->uri->segment(1), 'admin')  !== false){
				$this->load->view('admin/error/404_error');
			}else{
				$this->load->view('wholesale/globals/header');
				$this->load->view('wholesale/error/error_404');
				$this->load->view('wholesale/globals/footer');
			}
		}
		
	}