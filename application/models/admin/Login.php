<?php
	defined('BASEPATH') or exit('No Direct Script is Allowed');

	/**
	 * 
	 */
	class Login extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function admin_login(){

			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$this->db->where('admin_email',$email);
			$query = $this->db->get('whole_admin');

			if($query->num_rows() > 0){
				$this->db->where('admin_email',$email);
				$this->db->where('admin_password',md5($password));
				$query = $this->db->get('whole_admin');

				if($query->num_rows() > 0){

					$admin = $query->row();

					$data = array(
						'admin_id' => $admin->admin_id,
						'admin_name' => $admin->admin_display_name,
						'admin_role' => $admin->admin_role,
						'admin_email' => $admin->admin_email,
						'admin_phone' => $admin->admin_phone,
						'admin_image' => $admin->admin_image,
					);

					$this->session->set_userdata($data);
					echo json_encode(array('msg' => 'loggedin'));
					exit;
				}else{

					echo json_encode(array('msg' => 'password error'));
					exit;
				}
			}else{
				echo json_encode(array('msg' => 'email error'));
				exit;
			}
		}
	}