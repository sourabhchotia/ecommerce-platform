<?php
	
	defined('BASEPATH') or exit('No Direct Script is Allowed');

	/**
	 * 
	 */
	class Category_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			if(!$this->session->admin_id){
				redirect(site_url('admin'));
			}

			$this->load->model('admin/Category','category');
		}

		public function index(){

			$data['categories'] = $this->category->get_parent_categories();
			$data['admins'] = $this->db->get('whole_admin')->result();
			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/category/parent_category',$data);
			$this->load->view('admin/globals/footer');
		}


		public function main_category(){

			$data['categories'] = $this->category->get_parent_categories();
			$data['mainCategories'] = $this->category->get_main_categories();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/category/main_category',$data);
			$this->load->view('admin/globals/footer');
		}

		public function sub_category(){

			$data['categories'] = $this->category->get_parent_categories();
			$data['mainCategories'] = $this->category->get_main_categories();
			$data['subCategories'] = $this->category->get_sub_categories();


			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/category/sub_category',$data);
			$this->load->view('admin/globals/footer');
		}
		
		public function inner_category(){

			$data['categories'] = $this->category->get_parent_categories();
			$data['mainCategories'] = $this->category->get_main_categories();
			$data['subCategories'] = $this->category->get_sub_categories();
			$data['innerCategories'] = $this->category->get_inner_categories();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/category/inner_category',$data);
			$this->load->view('admin/globals/footer');
		}


		public function save_category(){
			$data = $this->category->save_category();
		}

		public function get_ajax_category(){
			$data = $this->category->get_ajax_category();

			$html = '<option selected="" value="">Choose...</option>';

			if(!empty($data)){
				foreach ($data as $result) {
					$html .='<option value="'.$result->category_id.'">'.$result->category_name.'</option>';
				}
			}
			
			echo $html;
		}

		public function change_status(){
			$data = $this->category->change_status();
		}

		public function edit_category(){

			$data = $this->category->edit_category();
		}
	}