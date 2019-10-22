<?php

	defined('BASEPATH') or exit('No direct script is allowed');

	/**
	 * 
	 */
	class Home extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function get_products(){

			$this->db->select('*');
			$this->db->from('whole_products a');
			$this->db->join('whole_product_combinations b', 'b.combination_product = a.product_id','left');
			$this->db->join('whole_product_options c', 'c.p_attribute_combo = b.combination_id','left');
			$this->db->order_by('combination_id','desc');
			$this->db->limit(8);
			$this->db->group_by('combination_product');
			$this->db->where('combination_status','1');
			$this->db->where("(product_type = 'retail' OR product_type = 'both')");
			return $this->db->get()->result();
		}
	}