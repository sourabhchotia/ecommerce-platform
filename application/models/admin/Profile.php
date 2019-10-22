<?php 

	defined('BASEPATH') or exit('No Direct Script is allowed');

	/**
	 * 
	 */
	class Profile extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function get_profile(){
			
			$this->db->where('admin_id',$this->session->admin_id);
			return $this->db->get('whole_admin')->row();
		}

		public function update_profile(){

			$name = $this->input->post('admin_name');
			$email = $this->input->post('admin_email');
			$mobile = $this->input->post('admin_phone');

			if($_FILES['adminImage']['name']){

				$config['upload_path'] = './uploads/admin/';
	            $config['allowed_types'] = 'jpg|png|jpeg|gif';
	            $config['max_size'] = '50000';	
	            $config['overwrite'] = TRUE;            
	            $this->upload->initialize($config);
	            
	            if($this->upload->do_upload('adminImage')){
	                
	                $uploadData = $this->upload->data();
	                $adminImage = $uploadData['file_name'];
	                $image_sizes = array(
	                	'thumb' => array(50,50),
				        'small' => array(150, 150),
				        'medium' => array(300, 300),
				        'large' => array(600, 600),
				        'extralarge' => array(900,900),
				    );
				    $this->load->library('image_lib');
					foreach ($image_sizes as $resize) {
					    $config = array(
					        'source_image' => $uploadData['full_path'],
					        'new_image' => './uploads/admin/thumbs/'. $uploadData['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$uploadData['file_ext'],
					        'maintain_ration' => false,
					        'width' => $resize[0],
					        'height' => $resize[1]
					    );
					    $this->image_lib->initialize($config);
					    $this->image_lib->resize();
					    $this->image_lib->clear();
					}
	            }
			}else{
				if(!empty($this->session->admin_id)){
					$this->db->where('admin_id',$this->session->admin_id);
					$cat = $this->db->get('whole_admin')->row();

					$adminImage = $cat->admin_image;
				}
			}

			$data = array(
				'admin_display_name' => ucfirst($name),
				'admin_email' => $email,
				'admin_phone' => $mobile,
				'admin_image' => $adminImage,
				'admin_modified_on' => date('y-m-d'),
				'admin_modified_by' => $this->session->admin_id,
			);

			

			$this->db->where('admin_id',$this->session->admin_id);
			$query = $this->db->update('whole_admin',$data);

			if($query){


				$this->db->where('admin_id',$this->session->admin_id);
				$admin =  $this->db->get('whole_admin')->row();
				
				$data = array(
					'admin_name' => $admin->admin_display_name,
					'admin_role' => $admin->admin_role,
					'admin_email' => $admin->admin_email,
					'admin_phone' => $admin->admin_phone,
					'admin_image' => $admin->admin_image,
				);

				$this->session->set_userdata($data);
				echo json_encode(['msg' => 'done']);
				exit;
			}else{

				echo json_encode(['msg' => 'error']);
				exit;
			}

		}

		public function change_password(){

			$old_password = $this->input->post('old_password');
			$new_password = $this->input->post('new_password');

			$this->db->where('admin_id',$this->session->admin_id);
			$this->db->where('admin_password',md5($old_password));
			$query = $this->db->get('whole_admin');

			if($query->num_rows() === 0){

				echo json_encode(['msg' => 'invalid']);
				exit;
			}

			$data = array(
				'admin_password' => md5($new_password),
				'admin_last_password' => $old_password,
				'admin_modified_on' => date('y-m-d'),
				'admin_modified_by' => $this->session->admin_id,
			);

			$this->db->where('admin_id',$this->session->admin_id);
			$query = $this->db->update('whole_admin',$data);

			if($query){

				$this->session->sess_destroy();
				
				echo json_encode(['msg' => 'done']);
				exit;
			}else{

				echo json_encode(['msg' => 'error']);
				exit;
			}

		}

		public function save_admin(){

			$name = $this->input->post('adminName');
			$role = $this->input->post('adminRole');
			$email = $this->input->post('adminEmail');
			$mobile = $this->input->post('adminMobile');
			$id = $this->input->post('adminId');

			$adminImage = 'd3.jpg';

			if($_FILES['adminImage']['name']){

				$config['upload_path'] = './uploads/admin/';
	            $config['allowed_types'] = 'jpg|png|jpeg|gif';
	            $config['max_size'] = '50000';	
	            $config['overwrite'] = TRUE;            
	            $this->upload->initialize($config);
	            
	            if($this->upload->do_upload('adminImage')){
	                
	                $uploadData = $this->upload->data();
	                $adminImage = $uploadData['file_name'];
	                $image_sizes = array(
	                	'thumb' => array(50,50),
				        'small' => array(150, 150),
				        'medium' => array(300, 300),
				        'large' => array(600, 600),
				        'extralarge' => array(900,900),
				    );
				    $this->load->library('image_lib');
					foreach ($image_sizes as $resize) {
					    $config = array(
					        'source_image' => $uploadData['full_path'],
					        'new_image' => './uploads/admin/thumbs/'. $uploadData['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$uploadData['file_ext'],
					        'maintain_ration' => false,
					        'width' => $resize[0],
					        'height' => $resize[1]
					    );
					    $this->image_lib->initialize($config);
					    $this->image_lib->resize();
					    $this->image_lib->clear();
					}
	            }
			}else{
				if(!empty($id)){
					$this->db->where('admin_id',$id);
					$cat = $this->db->get('whole_admin')->row();

					$adminImage = $cat->admin_image;
				}
			}


			if($id){

				$data = array(
					'admin_display_name' => ucfirst($name),
					'admin_email' => $email,
					'admin_phone' => $mobile,
					'admin_role' => $role,
					'admin_image' => $adminImage,
					'admin_modified_on' => date('y-m-d'),
					'admin_modified_by' => $this->session->admin_id
				);

				$this->db->where('admin_id',$id);
				$query = $this->db->update('whole_admin',$data);

				if($query){

					echo json_encode(['msg' => 'updated']);
					exit;

				}else{
					echo json_encode(['msg' => 'error']);
					exit;
				}

			}else{

				$this->db->where('admin_email',$email);
				$query = $this->db->get('whole_admin');

				if($query->num_rows() > 0){
					echo json_encode(['msg' => 'email']);
					exit;
				}

				$this->db->where('admin_phone',$mobile);
				$query = $this->db->get('whole_admin');

				if($query->num_rows() > 0){
					echo json_encode(['msg' => 'mobile']);
					exit;
				}

				$password = generateOTP(10);

				$msg = 'Dear user Congratulations on your registeration as an admin on Restock.in. This is Your Password '.$password.'. Please Use this password along with your email/mobile to login to your panel.';

				$output = sendSMS($mobile, $msg);

				$data = array(
					'admin_display_name' => ucfirst($name),
					'admin_email' => $email,
					'admin_phone' => $mobile,
					'admin_role' => $role,
					'admin_image' => $adminImage,
					'admin_password' => md5($password),
					'admin_created_on' => date('y-m-d'),
					'admin_created_by' => $this->session->admin_id
				);

				$query = $this->db->insert('whole_admin',$data);

				if($query){

					echo json_encode(['msg' => 'inserted']);
					exit;

				}else{
					echo json_encode(['msg' => 'error']);
					exit;
				}
			}

		}

		public function get_admin(){
			$this->db->where('admin_id',$this->input->post('id'));
			$query =  $this->db->get('whole_admin')->row();

			$filename= pathinfo($query->admin_image,PATHINFO_FILENAME);
            $file_ext = pathinfo($query->admin_image,PATHINFO_EXTENSION);

			$data = array(
				'admin_display_name' => $query->admin_display_name,
				'admin_email' => $query->admin_email,
				'admin_phone' => $query->admin_phone,
				'admin_role' => $query->admin_role,
				'filename' => $filename,
				'ext' => $file_ext
			);

			echo json_encode($data);
		}

		public function change_admin_status(){
			
			$this->db->where('admin_id',$this->input->post('id'));
			$query = $this->db->update('whole_admin',['admin_status' => $this->input->post('status')]);

			if($query){

				echo json_encode(['msg' => 'done']);
				exit;

			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}
		}

		public function get_all_admins(){

			$this->db->where('admin_role !=','super');
			return $this->db->get('whole_admin')->result();
		}


	}