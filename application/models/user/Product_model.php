<?php

	defined('BASEPATH') or exit('No Direct Script is Allowed');

	/**
	 * 
	 */
	class Product_model extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function add_to_whishlist(){

			if(!$this->session->user_id){
				echo json_encode(['msg' => 'login']);
				exit;
			}

			$productid = $this->input->post('productid');


			$this->db->where('wishlist_product',$productid);
			$this->db->where('wishlist_user',$this->session->user_id);
			$query = $this->db->get('whole_wishlist');

			if($query->num_rows() > 0){
				echo json_encode(['msg' => 'already']);
				exit;

			}
			$data = array(
				'wishlist_product' => $productid,
				'wishlist_user' => $this->session->user_id,
				'wishlist_created_on' => date('y-m-d'),
			);

			$query = $this->db->insert('whole_wishlist',$data);

			if($query){
				echo json_encode(['msg' => 'done']);
				exit;
			}

			echo json_encode(['msg' => 'error']);
			exit;
		}

		public function get_user_wishlist(){

			$this->db->select('*');
			$this->db->from('whole_wishlist a');
			$this->db->join('whole_product_combinations b','b.combination_id = a.wishlist_product','left');
			$this->db->join('whole_products c','c.product_id = b.combination_product','left');
			$this->db->where('wishlist_user',$this->session->user_id);
			return $this->db->get()->result();
		}

		public function remove_wishlist(){

			$wishid = $this->input->post('wishid');

			$this->db->where('wishlist_id',$wishid);
			$this->db->delete('whole_wishlist');

			if($this->db->affected_rows() > 0){
				echo json_encode(['msg' => 'done']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}
		}
	}