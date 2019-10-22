<?php 
	
	defined('BASEPATH') or exit('Nodirect script is allowed');

	/**
	 * 
	 */
	class Product_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			if(!$this->session->admin_id){
				redirect(site_url('admin'));
			}

			$this->load->model('admin/Category','category');
			$this->load->model('admin/brands','brand');
			$this->load->model('admin/Products','product');
		}

		public function index(){

			$data['categories'] = $this->category->get_parent_categories();
			$data['brands'] = $this->brand->get_brands();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/products/add_product', $data);
			$this->load->view('admin/globals/footer');
		}

		public function wholesale_rates(){

			$data['wholealeRates'] = $this->product->get_wholesale_rates();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/products/add_wholesale_rates',$data);
			$this->load->view('admin/globals/footer');
		}

		public function get_attribute_by_category(){

			$data = $this->product->get_attribute_by_category();
		}


		public function save_products(){
			$data = $this->product->save_products();
		}

		public function all_products(){
			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/products/product_listing');
			$this->load->view('admin/globals/footer');
		}

		public function all_products_stock(){
			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/products/product_stock');
			$this->load->view('admin/globals/footer');
		}

		public function get_product_listing(){
			$data = $this->product->product_listing();
		}

		public function get_product_stock(){
			$data = $this->product->product_stock();
		}

		public function update_stock(){
			$data = $this->product->update_stock();
		}

		public function update_status(){
			$data = $this->product->update_status();
		}

		public function edit_product(){

			$id = $this->input->get('productID');

			$data['product'] = $this->product->get_product($id);

			$data['options'] = $this->product->get_options($id);
			$data['categories'] = $this->category->get_parent_categories();
			$data['mainCategories'] = $this->category->get_main_categories();
			$data['subCategories'] = $this->category->get_sub_categories();
			$data['innerCategories'] = $this->category->get_inner_categories();
			$data['brands'] = $this->brand->get_brands();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/products/edit_product',$data);
			$this->load->view('admin/globals/footer');
		}

		public function update_product(){
			$data = $this->product->update_product();
		}

		public function import_export_products(){

			$data['categories'] = $this->category->get_parent_categories();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/products/import_export_product',$data);
			$this->load->view('admin/globals/footer');
		}

		public function import_products(){

			$data = $this->product->import_products();
		}

		public function export_products(){
			$data = $this->product->export_products();
		}

		public function mediaFiles(){

			$data['all_media'] = $this->product->get_media();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/products/upload_media',$data);
			$this->load->view('admin/globals/footer');
		}

		public function upload_media(){
			$data = $this->product->upload_media();
		}

		public function delete_media(){
			$data = $this->product->delete_media();
		}


		public function sale_exceptions(){

			$this->load->model('admin/Location','location');

			$data['countries'] = $this->location->get_countries();
			$data['categories'] = $this->category->get_all_categories();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/products/sale_exceptions',$data);
			$this->load->view('admin/globals/footer');
		}

		public function get_product_sale_exceptions(){
			$data = $this->product->get_product_sale_exceptions();
		}

		public function save_exceptions(){

			$data = $this->product->save_exceptions();
		}

		public function get_product_by_ajax(){
			$keyword = ucwords($this->input->get('term'));

			$this->db->select('product_name,product_id');
			$this->db->where("product_name LIKE '%$keyword%'");
			$query = $this->db->get('whole_products')->result();
			echo json_encode($query);
		}

		public function save_wholesale_rates(){

			$data = $this->product->save_wholesale_rates();
		}
	}