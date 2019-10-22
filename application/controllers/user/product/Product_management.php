<?php

	defined('BASEPATH') or exit('No Direct Script is Allowed');


	/**
	 * 
	 */
	class Product_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			$this->load->model('user/Product_model','product');
		}

		public function index(){

			$data = $this->product->add_to_whishlist();
		}

		public function user_wishlist(){

			$metadata['metadata'] = get_meta_data(11);

			$data['wishlist'] = $this->product->get_user_wishlist();

			$this->load->view('wholesale/globals/header',$metadata);
			$this->load->view('wholesale/wishlist/wishlist',$data);
			$this->load->view('wholesale/globals/footer');
		}

		public function remove_wishlist(){

			$data = $this->product->remove_wishlist();
		}

		public function change_slug_by_id(){

			$id = $this->input->post('color');

			$this->session->set_userdata('selected_product',$id);
			
			$this->db->where('combination_id',$id);
			$query = $this->db->get('whole_product_combinations')->row();

			echo json_encode(['slug' => $query->combination_slug]);
		}
		
	}