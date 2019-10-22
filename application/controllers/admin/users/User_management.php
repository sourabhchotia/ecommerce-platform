<?php

	defined('BASEPATH') or exit('No Direct Script is allowed');


	/**
	 * 
	 */
	class User_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			if(!$this->session->admin_id){
				redirect(site_url('admin'));
			}

		}

		public function index(){

			$data['users'] = $this->db->get('whole_users')->result();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/users/user_listing',$data);
			$this->load->view('admin/globals/footer');
		}

		public function user_details(){

			$id = $this->input->get('userID');

			$this->db->where('user_id',$id);
			$data['userdetail'] = $this->db->get('whole_users')->row();

			$this->db->where('user_id',$id);
			$data['useraddresses'] = $this->db->get('whole_user_address')->result();

			$this->db->where('order_user',$id);
			$this->db->group_by('order_id');
			$data['totalOrder'] = $this->db->get('whole_orders')->num_rows();

			$this->db->where('order_user',$id);
			$data['totalProducts'] = $this->db->get('whole_orders')->num_rows();

			$this->db->where('order_user',$id);
			$this->db->select('SUM(order_total) as totalpurchase');
			$data['totalPurchase'] = $this->db->get('whole_orders')->row()->totalpurchase;

			$this->db->where('order_user',$id);
			$this->db->where('MONTH(order_created_on)', date('m'));
			$this->db->select('SUM(order_total) as totalpurchase');
			$data['monthPurchase'] = $this->db->get('whole_orders')->row()->totalpurchase;



			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/users/user_detail',$data);
			$this->load->view('admin/globals/footer');
		}

		public function change_status(){

			$this->db->where('user_id',$this->input->post('id'));
			$query = $this->db->update('whole_users',['user_status' => $this->input->post('status')]);

			if($query){
				echo json_encode(['msg' => 'changed']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
			}
		}
	}