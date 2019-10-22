<?php

	defined('BASEPATH') or exit('No Direct Script is allowed');


	/**
	 * 
	 */
	class UserProfile extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function signup_verification(){

			$name = $this->input->post('username');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$password = $this->input->post('password');


			$otp = generateOTP(6);

			$this->db->where('user_email',$email);
			$query = $this->db->get('whole_users');

			if($query->num_rows()  > 0){

				$row = $query->row();

				if($row->user_verified == '1'){

					echo json_encode(['msg' => 'email']);
					exit;

				}else{

					$msg = 'Dear user this is your verification code '.$otp.'. Please Use this code to complete registration proccess.';
					$output = sendSMS($mobile, $msg);

					if($output){

						$data = array(
							'user_id' => $row->user_id,
							'msg' => 'resend'
						);

						echo json_encode($data);
						exit;

					}else{

						echo json_encode(['msg' => 'otperror']);
						exit;
					}
				}
			}

			$this->db->where('user_mobile',$mobile);
			$query = $this->db->get('whole_users');

			if($query->num_rows()  > 0){
				$row = $query->row();

				if($row->user_verified == '1'){

					echo json_encode(['msg' => 'phone']);
					exit;

				}else{

					$msg = 'Dear user this is your verification code '.$otp.'. Please Use this code to complete registration proccess.';

					$output = sendSMS($mobile, $msg);

					if($output){

						$data = array(
							'user_id' => $row->user_id,
							'msg' => 'resend'
						);

						echo json_encode($data);
						exit;
						
					}else{

						echo json_encode(['msg' => 'otperror']);
						exit;
					}
				}
			}

			$msg = 'Dear user this is your verification code '.$otp.'. Please Use this code to complete registration proccess.';

			$output = sendSMS($mobile, $msg);

            if($output){
               	$data = array(
					'user_name' => $name,
					'user_email' => $email,
					'user_mobile' => $mobile,
					'user_password' => md5($password),
					'user_created_on' => date('y-m-d'),
					'user_otp' => md5($otp)
				);

				$query = $this->db->insert('whole_users',$data);

				if($query){
					$data['user_id'] = $this->db->insert_id();
					$data['msg'] = 'done';
				}else{
					$data['msg'] = 'error';
				}

            }else{
               
               echo json_encode(['msg' => 'otperror']);
				exit;
            }
			echo json_encode($data);
		}

		public function signup_complete(){

			$userID = $this->input->post('userid');
			$otp = $this->input->post('otp');

			$this->db->where('user_id',$userID);
			$query = $this->db->get('whole_users');

			if($query->num_rows() > 0){

				$row = $query->row();

				if(md5($otp) == $row->user_otp){

					$data = array(
						'user_id' => $row->user_id,
						'user_name' => $row->user_name,
						'user_email' => $row->user_email,
						'user_phone' => $row->user_mobile
					);
					$this->session->set_userdata($data);


					$this->db->where('user_id',$row->user_id);
					$this->db->update('whole_users',['user_verified' => '1']);

					if($this->cart->contents()){
					 	foreach($this->cart->contents() as $item){
					 		$this->db->where('cart_user_id',$this->session->user_id);
							$this->db->where('cart_combo_id',$item['id']);
							$cart = $this->db->get('whole_cart');

							if($cart->num_rows() > 0){
								
							}else{

								$this->db->where('wishlist_product',$item['id']);
								$this->db->where('wishlist_user',$this->session->user_id);
								$this->db->delete('whole_wishlist');

								$data = array(
									'cart_user_id' => $this->session->user_id,
									'cart_combo_id' => $item['id'],
									'cart_qty' => $item['qty'],
								);

								$query = $this->db->insert('whole_cart',$data);
							}
					 	}

					 	$this->cart->destroy();
					}

					echo json_encode(['msg' => 'done']);
					exit;

				}else{

					echo json_encode(['msg' => 'invalid']);
					exit;
				}
			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}
		}

		public function login(){

			$username = $this->input->post('username');
			$password = $this->input->post('password');


			if(is_numeric($username)){
				$this->db->where('user_mobile',$username);
				$query = $this->db->get('whole_users');

				if($query->num_rows() > 0){

					$this->db->where('user_mobile',$username);
					$this->db->where('user_password',md5($password));
					$query = $this->db->get('whole_users');

					if($query->num_rows() > 0){

						$row = $query->row();

						if($row->user_status == '0'){
							echo json_encode(['msg' => 'blocked']);
							exit;

						}
						$data = array(
							'user_id' => $row->user_id,
							'user_name' => $row->user_name,
							'user_email' => $row->user_email,
							'user_phone' => $row->user_mobile
						);
						$this->session->set_userdata($data);

						if($this->cart->contents()){
						 	foreach($this->cart->contents() as $item){
						 		$this->db->where('cart_user_id',$this->session->user_id);
								$this->db->where('cart_combo_id',$item['id']);
								$cart = $this->db->get('whole_cart');

								if($cart->num_rows() > 0){
									
								}else{

									$this->db->where('wishlist_product',$item['id']);
									$this->db->where('wishlist_user',$this->session->user_id);
									$this->db->delete('whole_wishlist');

									$data = array(
										'cart_user_id' => $this->session->user_id,
										'cart_combo_id' => $item['id'],
										'cart_qty' => $item['qty'],
									);

									$query = $this->db->insert('whole_cart',$data);
								}
						 	}
						 	$this->cart->destroy();
						}

						echo json_encode(['msg' => 'done']);
						exit;
					}else{
						echo json_encode(['msg' => 'pass']);
						exit;
					}
				}else{
					echo json_encode(['msg' => 'phone']);
					exit;
				}

			}else{
				$this->db->where('user_email',$username);
				$query = $this->db->get('whole_users');

				if($query->num_rows() > 0){

					$this->db->where('user_email',$username);
					$this->db->where('user_password',md5($password));
					$query = $this->db->get('whole_users');

					if($query->num_rows() > 0){

						$row = $query->row();
						if($row->user_status == '0'){
							echo json_encode(['msg' => 'blocked']);
							exit;
							
						}
						$data = array(
							'user_id' => $row->user_id,
							'user_name' => $row->user_name,
							'user_email' => $row->user_email,
							'user_phone' => $row->user_mobile
						);
						$this->session->set_userdata($data);

						if($this->cart->contents()){
						 	foreach($this->cart->contents() as $item){
						 		$this->db->where('cart_user_id',$this->session->user_id);
								$this->db->where('cart_combo_id',$item['id']);
								$cart = $this->db->get('whole_cart');

								if($cart->num_rows() > 0){
									
								}else{

									$this->db->where('wishlist_product',$item['id']);
									$this->db->where('wishlist_user',$this->session->user_id);
									$this->db->delete('whole_wishlist');

									$data = array(
										'cart_user_id' => $this->session->user_id,
										'cart_combo_id' => $item['id'],
										'cart_qty' => $item['qty'],
									);

									$query = $this->db->insert('whole_cart',$data);
								}
						 	}
						 	$this->cart->destroy();
						}

						echo json_encode(['msg' => 'done']);
						exit;
					}else{
						echo json_encode(['msg' => 'pass']);
						exit;
					}
					
				}else{

					echo json_encode(['msg' => 'email']);
					exit;

				}
			}
			
		}

		public function get_userdetails(){

			$this->db->where('user_id',$this->session->user_id);
			return $this->db->get('whole_users')->row();

		}

		public function update_profile(){

			$name = $this->input->post('username');
			$email = $this->input->post('email');
			$mobile = $this->input->post('phone');
			$otp = $this->input->post('otp');

			$this->db->where('user_id',$this->session->user_id);
			$user = $this->db->get('whole_users')->row();

			$oldmobile = $user->user_mobile;
			$oldname = $user->user_name;
			$oldemail = $user->user_email;

			if(!empty($otp)){

				if($this->session->user_otp == md5($otp)){

					

					$data = array(
						'user_mobile' => $mobile,
						'user_email' => $email,
						'user_name' => $name,
					);

					$this->db->where('user_id',$this->session->user_id);
					$query = $this->db->update('whole_users',$data);

					if($query){

						$data = array(
							'log_user' => $this->session->user_id,
							'log_field' => 'mobile',
							'log_from_value' => $oldmobile,
							'log_to_value' => $mobile,
							'log_change_date' => date('y-m-d h:i:s'),
							'log_changed_from' => $this->input->ip_address()
						);

						$this->db->insert('whole_profile_log',$data);


						echo json_encode(['msg' => 'done']);
						exit;
					}else{
						echo json_encode(['msg' => 'error']);
						exit;
					}
				}else{
					echo json_encode(['msg' => 'incorrect']);
					exit;
				}
			}else{

				if($user->user_mobile != $mobile){

					$otp = generateOTP(6);
					$msg = 'Dear user this is your verification code '.$otp.'. Please Use this code to Change Your Phone Number.';
					$output = sendSMS($mobile, $msg);

					if($output){
						$data = array(
							'user_otp' => md5($otp),
						);

						$this->session->set_userdata($data);

						echo json_encode(['msg' => 'otp']);
						exit;

					}else{
						echo json_encode(['msg' => 'error']);
						exit;
					}

				}else{

					$data = array(
						'user_mobile' => $mobile,
						'user_email' => $email,
						'user_name' => $name,
					);

					$this->db->where('user_id',$this->session->user_id);
					$query = $this->db->update('whole_users',$data);

					if($oldname != $name){
						$data = array(
							'log_user' => $this->session->user_id,
							'log_field' => 'name',
							'log_from_value' => $oldname,
							'log_to_value' => $name,
							'log_change_date' => date('y-m-d h:i:s'),
							'log_changed_from' => $this->input->ip_address()
						);
						$this->db->insert('whole_profile_log',$data);
					}
					
					if($oldemail != $email){
						$data = array(
							'log_user' => $this->session->user_id,
							'log_field' => 'email',
							'log_from_value' => $oldemail,
							'log_to_value' => $email,
							'log_change_date' => date('y-m-d h:i:s'),
							'log_changed_from' => $this->input->ip_address()
						);
						$this->db->insert('whole_profile_log',$data);
					}

					

					if($query){
						echo json_encode(['msg' => 'done']);
						exit;
					}else{
						echo json_encode(['msg' => 'error']);
						exit;
					}
				}
			}
		}

		public function change_password(){

			if(!$this->session->user_id){

				echo json_encode(['msg' => 'redirect']);

			}
			$oldpassword = $this->input->post('oldpassword');
			$newpassword = $this->input->post('newpassword');

			$this->db->where('user_id',$this->session->user_id);
			$user = $this->db->get('whole_users')->row();

			if($user->user_password == md5($oldpassword)){

				$this->db->where('user_id',$this->session->user_id);
				$query = $this->db->update('whole_users',['user_password' => md5($newpassword)]);

				if($query){

					$data = array(
						'log_user' => $this->session->user_id,
						'log_field' => 'password',
						'log_from_value' => $oldpassword,
						'log_to_value' => $newpassword,
						'log_change_date' => date('y-m-d h:i:s'),
						'log_changed_from' => $this->input->ip_address()
					);

					$this->db->insert('whole_profile_log',$data);

					$this->session->sess_destroy();
					echo json_encode(['msg' => 'done']);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);
					exit;
				}

			}else{
				echo json_encode(['msg' => 'incorrect']);
				exit;
			}

		}

		public function check_zipCode(){

			$code = $this->input->post('code');

			$this->db->where('zip_code',$code);
			$codes = $this->db->get('whole_zipcodes');

			if($codes->num_rows() > 0){

				$zip = $codes->row();

				$this->db->where('state_id',$zip->zip_state);
				$state = $this->db->get('whole_states')->row();

				$this->db->where('city_id',$zip->zip_city);
				$city = $this->db->get('whole_cities')->row();

				$this->db->where('country_id',$state->state_country_code);
				$country = $this->db->get('whole_country')->row();


				$this->session->set_userdata('zip_code',$code);
				
				$data = array(
					'state' => $state->state_name,
					'country' => $country->country_name,
					'city' => $city->city_name,
					'msg' => 'done'
				);
				echo json_encode($data);
				exit;


			}else{
				echo json_encode(['msg' => 'not found']);
				exit;
			}
		}
		public function add_address(){

			$name = $this->input->post('name');
			$mobile = $this->input->post('phone');
			$address1 = $this->input->post('address1');
			$address2 = $this->input->post('address2');
			$zipcode = $this->input->post('zipcode');
			$city = $this->input->post('city');
			$state = $this->input->post('state');
			$country = $this->input->post('country');

			$data = array(
				'user_id' => $this->session->user_id,
				'user_add_name' => ucfirst($name),
				'user_add_mobile' => $mobile,
				'user_add_1' => ucfirst($address1),
				'user_add_2' => ucfirst($address2),
				'user_zip_code' => $zipcode,
				'user_city' => $city,
				'user_state' => $state,
				'user_country' => $country,
				'add_created_on' => date('y-m-d'),
				'add_from' => $this->input->ip_address()
			);

			$query = $this->db->insert('whole_user_address',$data);

			if($query){
				echo json_encode(['msg' => 'done']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}

		}

		public function get_user_address(){

			$this->db->where('user_id',$this->session->user_id);
			$this->db->where('add_status','1');
			return $this->db->get('whole_user_address')->result();
		}

		public function delete_address(){
			$this->db->where('user_id',$this->session->user_id);
			$this->db->where('add_id',$this->input->post('id'));
			$query = $this->db->update('whole_user_address',['add_status' => '0']);

			if($query){
				echo json_encode(['msg' => 'done']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}
		}
	}