<?php

	defined('BASEPATH') or exit('No Direct Script is Allowed');
	
	/**
	 * 
	 */
	class Main_controller extends CI_Controller{
		
		function __construct(){

			parent::__construct();

			$this->load->model('user/home','home');
		}

		public function index(){

			$metadata['metadata'] = get_meta_data(1);

			$data['products'] = $this->home->get_products();
			$slides['sliders'] = $this->db->get('whole_sliders')->result();


			$this->load->view('wholesale/globals/header',$metadata);
			$this->load->view('wholesale/globals/slider',$slides);
			$this->load->view('wholesale/home/home',$data);
			$this->load->view('wholesale/globals/footer');

		}
	}

?>