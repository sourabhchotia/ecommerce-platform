<?php 

	defined('BASEPATH') or exit('No Direct Script is allowed');

	/**
	 * 
	 */
	class Location extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		/*
			Country Function
			Author : Sourabh Chotia

		*/

		public function add_country(){

			$name = strtoupper($this->input->post('countryName'));
			$shortname = strtoupper($this->input->post('countryShortName'));

			$id = $this->input->post('countryId');

			if($id){

				$data = array(
					'country_name' => $name,
					'country_shortname' => $shortname,
					'country_modified_on' => date('y-m-d'),
					'country_modified_by' => $this->session->admin_id,
				);

				$this->db->where('country_id',$id);
				$query = $this->db->update('whole_country',$data);

				if($query){
					echo json_encode(['msg' => 'updated']);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);

				}
			}else{

				$this->db->where('country_name',$name);
				$query = $this->db->get('whole_country');

				if($query->num_rows() > 0){
					echo json_encode(['msg' => 'already']);
					exit;

				}
				$data = array(
					'country_name' => $name,
					'country_shortname' => $shortname,
					'country_created_on' => date('y-m-d'),
					'country_created_by' => $this->session->admin_id,
				);

				$query = $this->db->insert('whole_country',$data);

				if($query){
					echo json_encode(['msg' => 'done']);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);
					
				}
			}
		}

		public function get_countries(){

			return $this->db->get('whole_country')->result();
		}

		public function update_country_status(){

			$this->db->where('country_id',$this->input->post('id'));
			$query = $this->db->update('whole_country',['country_status' => $this->input->post('status')]);

			if($query){
				echo json_encode(['msg' => 'done']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}
		}

		public function edit_country(){

			$this->db->where('country_id',$this->input->post('id'));
			$query = $this->db->get('whole_country')->row();

			$data = array(
				
				'name' => $query->country_name,
				'short' => $query->country_shortname,
				'id' => $query->country_id,				
			);

			echo json_encode($data);
		}



		/*
			State Function
			Author : Sourabh Chotia

		*/

		public function add_state(){

			$name = strtoupper($this->input->post('stateName'));
			$shortname = strtoupper($this->input->post('stateShortName'));
			$country = $this->input->post('stateCountry');
			$id = $this->input->post('stateId');

			if($id){

				$data = array(
					'state_name' => $name,
					'state_short_name' => $shortname,
					'state_country_code' => $country,
					'state_modified_on' => date('y-m-d'),
					'state_modified_by' => $this->session->admin_id,
				);

				$this->db->where('state_id',$id);
				$query = $this->db->update('whole_states',$data);

				if($query){
					echo json_encode(['msg' => 'updated']);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);

				}
			}else{

				$this->db->where('state_name',$name);
				$query = $this->db->get('whole_states');

				if($query->num_rows() > 0){
					echo json_encode(['msg' => 'already']);
					exit;
					
				}

				$data = array(
					'state_name' => $name,
					'state_short_name' => $shortname,
					'state_country_code' => $country,
					'state_created_on' => date('y-m-d'),
					'state_created_by' => $this->session->admin_id,
				);

				$query = $this->db->insert('whole_states',$data);

				if($query){
					echo json_encode(['msg' => 'done']);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);
					
				}
			}
		}

		public function get_states(){

			return $this->db->get('whole_states')->result();
		}

		public function update_state_status(){

			$this->db->where('state_id',$this->input->post('id'));
			$query = $this->db->update('whole_states',['state_status' => $this->input->post('status')]);

			if($query){
				echo json_encode(['msg' => 'done']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}
		}

		public function edit_state(){

			$this->db->where('state_id',$this->input->post('id'));
			$query = $this->db->get('whole_states')->row();

			$data = array(
				
				'name' => $query->state_name,
				'short' => $query->state_short_name,
				'country' => $query->state_country_code,
				'id' => $query->state_id,				
			);

			echo json_encode($data);
		}


		/*
			City Function
			Author : Sourabh Chotia

		*/

		public function add_city(){

			$name = strtoupper($this->input->post('cityName'));
			$shortname = strtoupper($this->input->post('cityShortName'));
			$state = $this->input->post('cityState');
			$id = $this->input->post('cityId');

			if($id){

				$data = array(
					'city_name' => $name,
					'city_short_name' => $shortname,
					'city_state' => $state,
					'city_modified_on' => date('y-m-d'),
					'city_modified_by' => $this->session->admin_id,
				);

				$this->db->where('city_id',$id);
				$query = $this->db->update('whole_cities',$data);

				if($query){
					echo json_encode(['msg' => 'updated']);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);

				}
			}else{

				$this->db->where('city_name',$name);
				$query = $this->db->get('whole_cities');

				if($query->num_rows() > 0){
					echo json_encode(['msg' => 'already']);
					exit;
					
				}

				$data = array(
					'city_name' => $name,
					'city_short_name' => $shortname,
					'city_state' => $state,
					'city_created_on' => date('y-m-d'),
					'city_created_by' => $this->session->admin_id,
				);

				$query = $this->db->insert('whole_cities',$data);

				if($query){
					echo json_encode(['msg' => 'done']);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);
					
				}
			}
		}

		public function get_cities(){

			return $this->db->get('whole_cities')->result();
		}

		public function update_city_status(){

			$this->db->where('city_id',$this->input->post('id'));
			$query = $this->db->update('whole_cities',['city_status' => $this->input->post('status')]);

			if($query){
				echo json_encode(['msg' => 'done']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}
		}

		public function edit_city(){

			$this->db->where('city_id',$this->input->post('id'));
			$query = $this->db->get('whole_cities')->row();

			$this->db->where('state_id',$query->city_state);
			$state = $this->db->get('whole_states')->row();

			$data = array(
				'city_name' => $query->city_name,
				'short' => $query->city_short_name,
				'country' => $state->state_country_code,
				'state' => $query->city_state,
				'statename' => $state->state_name, 
				'id' => $query->city_id,				
			);

			echo json_encode($data);
		}



		/*
			Zipcodes Function
			Author : Sourabh Chotia

		*/

		public function add_zipcode(){

			$code = strtoupper($this->input->post('zipcode'));
			
			$country = $this->input->post('cityCountry');
			$state = strtoupper($this->input->post('cityState'));
			$city = strtoupper($this->input->post('zipCity'));

			$id = $this->input->post('zipcodeId');

			if($id){

				$data = array(
					'zip_code' => $code,
					'zip_state' => $state,
					'zip_city' => $city,
					'zip_modified_on' => date('y-m-d'),
					'zip_modified_by' => $this->session->admin_id,
				);

				$this->db->where('zip_id',$id);
				$query = $this->db->update('whole_zipcodes',$data);

				if($query){
					echo json_encode(['msg' => 'updated']);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);

				}
			}else{


				$this->db->where('zip_code',$code);
				$query = $this->db->get('whole_zipcodes');

				if($query->num_rows() > 0){
					echo json_encode(['msg' => 'already']);
					exit;
					
				}

				$data = array(
					'zip_code' => $code,
					'zip_state' => $state,
					'zip_city' => $city,
					'zip_created_on' => date('y-m-d'),
					'zip_created_by' => $this->session->admin_id,
				);

				$query = $this->db->insert('whole_zipcodes',$data);

				if($query){
					echo json_encode(['msg' => 'done']);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);
					
				}
			}
		}

		public function get_zipcodes(){

			return $this->db->get('whole_zipcodes')->result();
		}

		public function update_zipcode_status(){

			$this->db->where('zip_id',$this->input->post('id'));
			$query = $this->db->update('whole_zipcodes',['zip_status' => $this->input->post('status')]);

			if($query){
				echo json_encode(['msg' => 'done']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}
		}

		public function edit_zipcode(){

			$this->db->where('zip_id',$this->input->post('id'));
			$query = $this->db->get('whole_zipcodes')->row();

			$this->db->where('state_id',$query->zip_state);
			$state = $this->db->get('whole_states')->row();

			$this->db->where('city_id',$query->zip_city);
			$cities = $this->db->get('whole_cities')->row();


			$data = array(
				
				'code' => $query->zip_code,
				'country' => $state->state_country_code,
				'stateid' => $state->state_id,
				'statename' => $state->state_name,
				'cityid' => $cities->city_id,
				'cityname' => $cities->city_name,
				'id' => $query->zip_id,				
			);

			echo json_encode($data);
		}


	}