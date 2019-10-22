<?php 

	defined('BASEPATH') or exit('No Direct Script is Allowed');


	/**
	 * 
	 */
	class Location_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			if(!$this->session->admin_id){
				redirect(site_url('admin'));
			}
			$this->load->model('admin/Location','location');

		}

		/*
			Country Function
			Author : Sourabh Chotia

		*/

		public function index(){

			$data['countries'] = $this->location->get_countries();
			$data['admins'] = $this->db->get('whole_admin')->result();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/locations/country',$data);
			$this->load->view('admin/globals/footer');
		}

		public function add_country(){

			$data = $this->location->add_country();
		}

		public function update_country_status(){
			$data = $this->location->update_country_status();
		}

		public function edit_country(){
			$data = $this->location->edit_country();
		}


		/*
			State Function
			Author : Sourabh Chotia

		*/


		public function states(){

			$data['countries'] = $this->location->get_countries();
			$data['states'] = $this->location->get_states();
			$data['admins'] = $this->db->get('whole_admin')->result();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/locations/state',$data);
			$this->load->view('admin/globals/footer');
		}

		public function add_state(){

			$data = $this->location->add_state();
		}

		public function update_state_status(){
			$data = $this->location->update_state_status();
		}

		public function edit_state(){
			$data = $this->location->edit_state();
		}


		/*
			City Function
			Author : Sourabh Chotia

		*/


		public function cities(){

			$data['countries'] = $this->location->get_countries();
			$data['states'] = $this->location->get_states();
			$data['cities'] = $this->location->get_cities();

			$data['admins'] = $this->db->get('whole_admin')->result();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/locations/city',$data);
			$this->load->view('admin/globals/footer');
		}

		public function add_city(){

			$data = $this->location->add_city();
		}

		public function update_city_status(){
			$data = $this->location->update_city_status();
		}

		public function edit_city(){
			$data = $this->location->edit_city();
		}

		/*
			Zipcode Function
			Author : Sourabh Chotia

		*/

		public function zipcodes(){

			$data['countries'] = $this->location->get_countries();
			$data['states'] = $this->location->get_states();
			$data['cities'] = $this->location->get_cities();
			$data['zipcodes'] = $this->location->get_zipcodes();
			$data['admins'] = $this->db->get('whole_admin')->result();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/locations/zip',$data);
			$this->load->view('admin/globals/footer');
		}

		public function add_zipcode(){

			$data = $this->location->add_zipcode();
		}

		public function update_zipcode_status(){
			$data = $this->location->update_zipcode_status();
		}

		public function edit_zipcode(){
			$data = $this->location->edit_zipcode();
		}


		/*
			Extra Function
			Author : Sourabh Chotia

		*/

		public function get_state_by_country(){

			$this->db->where('state_country_code',$this->input->post('id'));
			$states = $this->db->get('whole_states')->result();

			$html = '';
			if($states){
				$html .= '<option selected="" value="">Choose...</option>';
				foreach ($states as $state) {
					$html .='<option  value="'.$state->state_id.'">'.$state->state_name.'</option>';
				}
			}else{
				$html .= '<option selected="" value="">No Data Found</option>';

			}

			echo $html;
				
		}

		public function get_city_by_state(){
			
			$this->db->where('city_state',$this->input->post('id'));
			$states = $this->db->get('whole_cities')->result();

			$html = '';
			if($states){
				$html .= '<option selected="" value="">Choose...</option>';
				foreach ($states as $state) {
					$html .='<option  value="'.$state->city_id.'">'.$state->city_name.'</option>';
				}
			}else{
				$html .= '<option selected="" value="">No Data Found</option>';

			}
			echo $html;
		}

		public function get_zipcode_by_city(){
			
			$this->db->where('zip_city',$this->input->post('id'));
			$states = $this->db->get('whole_zipcodes')->result();

			$html = '';
			if($states){
				$html .= '<option selected="" value="">Choose...</option>';
				foreach ($states as $state) {
					$html .='<option  value="'.$state->zip_id.'">'.$state->state_name.'</option>';
				}
			}else{
				$html .= '<option selected="" value="">No Data Found</option>';

			}
			echo $html;
		}

	}