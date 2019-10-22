<?php

	defined('BASEPATH') or exit('No direct Script is Allowed');

	/**
	 * 
	 */
	class Attribute_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			if(!$this->session->admin_id){
				redirect(site_url('admin'));
			}

			$this->load->model('admin/Attribute','attribute');

		}

		/*

				Attribute Related Functions 

				These are Main Attributes For the Site

				You Can Find Functions Such as Add, Edit, And Enable/Disable Attributes

				Author : Sourabh Chotia
				Date : 22/08/2019
				Modified on : -
				Modified By : - 

		*/
		public function index(){

			$data['attributes'] = $this->attribute->get_attributes();
			$data['admins'] = $this->db->get('whole_admin')->result();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/attribute/add_attribute',$data);
			$this->load->view('admin/globals/footer');
		}

		public function add_attributes(){

			$data = $this->attribute->add_attributes();
		}

		public function change_att_status(){

			$data = $this->attribute->change_att_status();
		}

		public function get_attribute(){

			$data = $this->attribute->get_attribute();
		}

		/*

			All Attribute Options Related functions Are Below

			These Are the Options for attributes Created Previously 
			
			You Can Find Functions Such as Add, Edit, And Enable/Disable Attribute Options

			Author : Sourabh Chotia
			Date : 22/08/2019
			Modified on : -
			Modified By : - 

		*/

		public function add_attribute_options(){
			$data['attributes'] = $this->attribute->get_attributes();
			$data['attributeOptions'] = $this->attribute->get_attribute_options();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/attribute/add_options',$data);
			$this->load->view('admin/globals/footer');
		}

		public function save_attribute_option(){

			$data = $this->attribute->save_attribute_option();
		}

		public function change_attribute_option_status(){

			$data = $this->attribute->change_attribute_option_status();
		}

		public function get_attribute_option(){
			$data = $this->attribute->get_attribute_option();
		}

		/*

			Below Are The Function For Assignments of Options to Attributes and Attributes to Category

			This will help us to Filter All Other Irrelevent data for admin when adding new products;
			

			Author : Sourabh Chotia
			Date : 22/08/2019
			Modified on : -
			Modified By : - 

		*/

		public function assign_to_attribute(){

			$this->load->model('admin/Category','category');

			$data['attributes'] = $this->attribute->get_attributes();
			$data['attributeOptions'] = $this->attribute->get_attribute_options();
			$data['assigned'] = $this->attribute->get_assigned_options();

			$data['parentcategories'] = $this->category->get_parent_categories();
			$data['categories'] = $this->category->get_all_categories();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/attribute/assign_option',$data);
			$this->load->view('admin/globals/footer');
		}

		public function get_attribute_options(){

			$data = $this->attribute->get_att_options_by_att();
		}
		
		public function save_to_attribute(){

			$data = $this->attribute->save_to_attribute();

			if($data){
				// echo "true";

				echo json_encode(['msg' => 'true']);
				exit;

			}else{
				// echo "false";

				echo json_encode(['msg' => 'false']);
				exit;
			}
		}

		public function edit_assigned_attribute(){
			$this->load->model('admin/Category','category');

			$id = $this->input->get('queryItem');

			$data['option'] = $this->attribute->get_option_by_id($id);
			$data['assignedOptions'] = $this->attribute->edit_assigned_attribute($id);
			$data['categories'] = $this->category->get_all_categories();
			$data['attributes'] = $this->attribute->get_attributes();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/attribute/edit_assign_option',$data);
			$this->load->view('admin/globals/footer');

		}

		public function update_assigned_attribute(){

			$data = $this->attribute->update_assigned_attribute();

			if($data){

				$this->session->set_flashdata('success','Assignment Updated Successfully');
				redirect('admin/attributes/assign-attributes-to-category');
			}else{
				$this->session->set_flashdata('error','Error! Please try again');
				redirect('admin/attributes/assign-attributes-to-category');
			}
		}
	}