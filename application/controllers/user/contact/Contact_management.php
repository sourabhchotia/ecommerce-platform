<?php

	defined('BASEPATH') or exit('No Direct Script is allowed');

	/**
	 * 
	 */
	class Contact_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function index(){

			$metadata['metadata'] = get_meta_data(2);

			$this->load->view('wholesale/globals/header',$metadata);
			$this->load->view('wholesale/contact/contact');
			$this->load->view('wholesale/globals/footer');
		}
	}