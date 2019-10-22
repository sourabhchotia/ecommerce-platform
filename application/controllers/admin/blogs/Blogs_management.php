<?php
	
	defined('BASEPATH') or exit('No Direct Script is Allowed');

	/**
	 * 
	 */
	class Blogs_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			if(!$this->session->admin_id){
				redirect(site_url('admin'));
			}

			$this->load->model('admin/Blogs','blog');
		}

		public function index(){

			$data['categories'] = $this->blog->get_all_categories();
			$data['admins'] = $this->db->get('whole_admin')->result();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/blogs/blog_category',$data);
			$this->load->view('admin/globals/footer');
		}

		public function save_blogs_category(){
			$data = $this->blog->save_category();
		}

		public function change_category_status(){
			$data = $this->blog->change_category_status();
		}

		public function get_category(){
			$data = $this->blog->get_category();
		}

		public function get_category_by_ajax(){

			$keyword = ucwords($this->input->get('term'));

			$this->db->select('category_name,category_id');
			$this->db->where("category_name LIKE '%$keyword%'");
			$query = $this->db->get('whole_blogs_category')->result();
			echo json_encode($query);
		}


		public function add_blog(){

			$data['categories'] = $this->blog->get_all_categories();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/blogs/add_blogs',$data);
			$this->load->view('admin/globals/footer');
		}

		public function save_blog(){

			$data = $this->blog->save_blog();
		}

		public function blogs_listing(){

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/blogs/blogs_listing');
			$this->load->view('admin/globals/footer');

		}

		public function get_blogs_listing(){
			$data = $this->blog->get_blogs_listing();
		}

		public function disable_blogs(){

			$data = $this->blog->disable_blogs();
		}

		public function edit_blog($slug){

			$data['blog'] = $this->blog->get_blog_by_slug($slug);
			$data['categories'] = $this->blog->get_all_categories();
			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/blogs/edit_blogs',$data);
			$this->load->view('admin/globals/footer');
		}

		public function update_blog(){

			$data = $this->blog->update_blog();
		}
	}