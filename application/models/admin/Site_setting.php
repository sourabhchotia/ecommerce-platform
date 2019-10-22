<?php

	defined('BASEPATH') or exit('No Direct Script is allowed');

	/**
	 * 
	 */
	class Site_setting extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function save_settings(){

			$data = $this->input->post();
			
			if(array_key_exists('logo', $_FILES)){

				if($_FILES['logo']['name']){
					$config['upload_path'] = './uploads/logos/';
		            $config['allowed_types'] = 'jpg|png|jpeg|gif';
		            $config['max_size'] = '50000';	
		            $config['overwrite'] = TRUE;            
		            $this->upload->initialize($config);
		            if($this->upload->do_upload('logo')){
		                $uploadData = $this->upload->data();
		                $logoImage = $uploadData['file_name'];
		                $image_sizes = array(
		                	'thumb' => array(150,50),
					        'small' => array(200, 80),
					        'medium' => array(300, 100),
					    );

					    $this->load->library('image_lib');
						foreach ($image_sizes as $resize) {

						    $config = array(
						        'source_image' => $uploadData['full_path'],
						        'new_image' => './uploads/logos/thumbs/'. $uploadData['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$uploadData['file_ext'],
						        'maintain_ration' => false,
						        'width' => $resize[0],
						        'height' => $resize[1]
						    );

						    $this->image_lib->initialize($config);
						    $this->image_lib->resize();
						    $this->image_lib->clear();
						}

						$this->db->where('setting_key','logo');
						$error[] = $this->db->update('site_settings',['setting_value' => $logoImage]);
		            }
				}

			}

			if(array_key_exists('favicon', $_FILES)){
				
				if($_FILES['favicon']['name']){
					$config['upload_path'] = './uploads/logos/favicons';
		            $config['allowed_types'] = 'jpg|png|jpeg|gif';
		            $config['max_size'] = '50000';	
		            $config['overwrite'] = TRUE;            
		            $this->upload->initialize($config);
		            if($this->upload->do_upload('favicon')){
		                $uploadData = $this->upload->data();
		                $favicon = $uploadData['file_name'];
		                $image_sizes = array(
		                	'thumb' => array(16,16),
					        'small' => array(32, 32),
					        'medium' => array(64, 64),
					    );

					    $this->load->library('image_lib');
						foreach ($image_sizes as $resize) {

						    $config = array(
						        'source_image' => $uploadData['full_path'],
						        'new_image' => './uploads/logos/favicons/'. $uploadData['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$uploadData['file_ext'],
						        'maintain_ration' => false,
						        'width' => $resize[0],
						        'height' => $resize[1]
						    );

						    $this->image_lib->initialize($config);
						    $this->image_lib->resize();
						    $this->image_lib->clear();
						}

						$this->db->where('setting_key','favicon');
						$error[] = $this->db->update('site_settings',['setting_value' => $favicon]);
		            }
				}
			}

			foreach($data as $key => $value){
				$this->db->where('setting_key',$key);
				$error[] = $this->db->update('site_settings',['setting_value' => $value]);
			}

			foreach ($error as $err) {
				if(!$err){
					echo json_encode(['msg' => 'error']);
					exit;
				}
			}

			echo json_encode(['msg' => 'done']);
			exit;
		}


		public function get_payments(){

			$this->db->where('pg_visibility','1');
			return $this->db->get('whole_payment_gateways')->result();
		}

		public function save_payment_settings(){

			$id = $this->input->post('gateway_id');

			$display_name = $this->input->post('display_name');
			$service_provider = $this->input->post('service_provider');
			$merchant_key = $this->input->post('merchant_key');
			$salt_key = $this->input->post('salt_key');
			$secret_key = $this->input->post('secret_key');
			$gateway_url = $this->input->post('gateway_url');
			$status = $this->input->post('status');

			$data = array(

				'pg_display_name' => $display_name,
				'pg_password' => $service_provider,
				'pg_url' => $gateway_url,
				'pg_merchant_key' => $merchant_key,
				'pg_secret_key' => $secret_key,
				'pg_salt_key' => $salt_key,
				'pg_status' => $status,
			);

			$this->db->where('pg_name',$id);
			$query = $this->db->update('whole_payment_gateways',$data);

			if($query){

				$this->session->set_flashdata('success','Payment Gateway Settings saved succefully');
				redirect('admin/settings/payment-settings');

			}else{

				$this->session->set_flashdata('error','Technical Error! Please try again');
				redirect('admin/settings/payment-settings');
			}
		}
	}