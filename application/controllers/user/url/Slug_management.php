<?php

	defined('BASEPATH') or exit('No Direct Sccript is Allowed');

	/**
	 * 
	 */
	class Slug_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function index($slug1 = '', $slug2 = '',$slug3 = '',$slug4 = ''){

			if(!empty($slug4)){
				$slug = $slug1.'/'.$slug2.'/'.$slug3.'/'.$slug4;
			}else if(!empty($slug3)){
				$slug = $slug1.'/'.$slug2.'/'.$slug3;
			}else if(!empty($slug2)){
				$slug = $slug1.'/'.$slug2;
			}else if(!empty($slug1)){
				$slug = $slug1;
			}

			$this->db->where('category_slug',$slug);
			$category = $this->db->get('whole_category');

			if($category->num_rows() > 0){

				$colorOptions = array();
				$colors = $this->input->get('color');

				foreach(explode(',', $colors) as $color){
					$this->db->where('option_name',$color);
					$query = $this->db->get('whole_attribute_options');

					if($query->num_rows() > 0){
						$colorOptions[] = $query->row()->option_id; 
					}
				}

				$filter = $this->input->get('sortby');


				$category = $category->row();
				$this->db->select('*');
				$this->db->from('whole_products a');
				$this->db->join('whole_product_combinations b', 'b.combination_product = a.product_id','left');
				$this->db->join('whole_product_options c', 'c.p_attribute_combo = b.combination_id','left');
				
				$this->db->group_by('combination_product');
				$this->db->where('combination_status','1');
				$this->db->where('product_category',$category->category_id);
				$this->db->where("(product_type = 'retail' OR product_type = 'both')");
				if(!empty($colorOptions)){
					$this->db->where_in('p_attribute_value',$colorOptions);
				}

				if(!empty($filter)){

					if($filter == 'low'){

						$this->db->order_by('ABS(combination_sale_price)','asc');

					}else if($filter == 'high'){

						$this->db->order_by('ABS(combination_sale_price)','desc');

					}else{

						$this->db->order_by('combination_id','desc');

					}
				}else{

					$this->db->order_by('combination_id','desc');

				}
				$products = $this->db->get()->result();

				if(!$products){

					$this->db->where('parent_category',$category->category_id);
					$allCat = $this->db->get('whole_category')->result();

					foreach($allCat as $cat){

						$cats[] = $cat->category_id;
					}

					if(!empty($cats)){
						$this->db->select('*');
						$this->db->from('whole_products a');
						$this->db->join('whole_product_combinations b', 'b.combination_product = a.product_id','left');
						$this->db->join('whole_product_options c', 'c.p_attribute_combo = b.combination_id','left');
						$this->db->order_by('combination_id','desc');
						$this->db->group_by('combination_product');
						$this->db->where('combination_status','1');
						$this->db->where_in('product_category',$cats);
						$this->db->where("(product_type = 'retail' OR product_type = 'both')");
						if(!empty($colorOptions)){
							$this->db->where_in('p_attribute_value',$colorOptions);
						}
						$products = $this->db->get()->result();
					}
				}

				$meta  = array(
					'page_meta_title' => $category->meta_title,
					'page_meta_keywords' => $category->meta_keywords,
					'page_meta_description' => $category->meta_description,
				);

				$category1 = $category;
				if($category1->parent_category != 0){
					$this->db->where('category_id',$category1->parent_category);
					$category2 = $this->db->get('whole_category')->row();
					if($category2->parent_category != 0){
						$this->db->where('category_id',$category2->parent_category);
						$category3 = $this->db->get('whole_category')->row();
						if($category3->parent_category != 0){
							$this->db->where('category_id',$category3->parent_category);
							$category4 = $this->db->get('whole_category')->row();
							$finalCategory = $category4->category_id;
						}else{
							$finalCategory = $category3->category_id;
						}
					}else{
						$finalCategory = $category2->category_id;
					}
				}else{
					$finalCategory = $category1->category_id;
				}
				$this->db->where('assign_category',$finalCategory);
				$assigned = $this->db->get('whole_assigned_options');

				$attributes = $options = $finalAttributes = array();
				if($assigned->num_rows() > 0){

					foreach($assigned->result() as $assign){

						if(in_array($assign->assign_attribute, $attributes)){

						}else{
							$attributes[] = $assign->assign_attribute;
						}

						$options[] = $assign->assign_option;
					}

					foreach ($attributes as $value) {
						$this->db->where('attribute_id',$value);
						$attribute = $this->db->get('whole_attributes')->row();
						foreach ($options as $op) {
							$this->db->where('option_id',$op);
							$this->db->where('option_attribute',$value);
							$option = $this->db->get('whole_attribute_options')->result();
							foreach($option as $opt){
								$finalAttributes[$attribute->attribute_name][] = array(
									'option_id' => $opt->option_id,
									'option_name' => $opt->option_name,
									'option_display_name' => $opt->option_display_name,
									'option_type' => $opt->option_type,
									'option_value' => $opt->option_value,
								); 
							}
						}
					}

				}

				$this->db->where('category_status','1');
				$this->db->where('category_role','parent');
				$parentCategory = $this->db->get('whole_category')->result();

				$this->db->where('category_status','1');
				$this->db->where('category_role','main');
				$mainCategory = $this->db->get('whole_category')->result();

				$this->db->where('category_status','1');
				$this->db->where('category_role','sub');
				$subCategory = $this->db->get('whole_category')->result();

				$this->db->where('category_status','1');
				$this->db->where('category_role','inner');
				$innerCategory = $this->db->get('whole_category')->result();

				$data['category'] = $category;
				$data['products'] = $products;
				$data['parentCategory'] = $parentCategory;
				$data['mainCategory'] = $mainCategory;
				$data['subCategory'] = $subCategory;
				$data['innerCategory'] = $innerCategory;
				$data['attributes'] = $finalAttributes;
				$data['current'] = $category->category_id;

				$data['colors'] = $colorOptions;
				$data['totalcolors'] = explode(',', $colors);
				$meta = json_encode($meta);

				$metadata['metadata'] = json_decode($meta);

				$this->load->view('wholesale/globals/header',$metadata);
				$this->load->view('wholesale/category/category',$data);
				$this->load->view('wholesale/globals/footer');

			}else{

				$this->db->select('*');
				$this->db->from('whole_products a');
				$this->db->join('whole_product_combinations b', 'b.combination_product = a.product_id','left');
				$this->db->where('combination_slug',$slug);
				$products = $this->db->get();

				if($products->num_rows() > 0){

					$product = $products->row();

					$meta  = array(
						'page_meta_title' => $product->product_meta_title,
						'page_meta_keywords' => $product->product_meta_keywords,
						'page_meta_description' => $product->meta_description,
					);


					// Getting All Attribute Options of this particular product combination
					$this->db->where('p_attribute_combo',$product->combination_id);
                    $options = $this->db->get('whole_product_options')->result();


                    $this->db->where('category_id',$product->product_category);
					$category1 = $this->db->get('whole_category')->row();
					if($category1->parent_category != 0){
						$this->db->where('category_id',$category1->parent_category);
						$category2 = $this->db->get('whole_category')->row();
						if($category2->parent_category != 0){
							$this->db->where('category_id',$category2->parent_category);
							$category3 = $this->db->get('whole_category')->row();
							if($category3->parent_category != 0){
								$this->db->where('category_id',$category3->parent_category);
								$category4 = $this->db->get('whole_category')->row();
								$finalCategory = $category4->category_id;
							}else{
								$finalCategory = $category3->category_id;
							}
						}else{
							$finalCategory = $category2->category_id;
						}
					}else{
						$finalCategory = $category1->category_id;
					}

                    // Getting all Attributes that may be a variant or for switching Product Combination Such as Size , Color or so on

					$this->db->from('whole_products a');
					$this->db->join('whole_product_combinations b', 'b.combination_product = a.product_id','left');
					$this->db->join('whole_product_options c', 'c.p_attribute_combo = b.combination_id','left');
					$this->db->join('whole_attributes d', 'd.attribute_id = c.p_attribute_id','left');
					$this->db->join('whole_attribute_options e', 'e.option_id = c.p_attribute_value','left');
					$this->db->where('attribute_variant','1');
	                $this->db->where('combination_product',$product->product_id);
                    $this->db->where('combination_id !=',$product->combination_id);
	                $assigned = $this->db->get()->result();


	                // Related Products based on category;

	                $this->db->select('*');
					$this->db->from('whole_products a');
					$this->db->join('whole_product_combinations b', 'b.combination_product = a.product_id','left');
					$this->db->where('product_category',$product->product_category);
					$this->db->where('combination_slug !=',$slug);
					$this->db->where("(product_type = 'retail' OR product_type = 'both')");
					$related = $this->db->get()->result();

	                // Passing all data to view part
	                
	                $this->db->where('cart_combo_id',$product->combination_id);
	                $cart = $this->db->get('whole_cart');

	                $data['already'] = FALSE;
	                if($cart->num_rows() > 0){
	                	$data['already'] = TRUE;
	                }
	                
					$data['all_options'] = $this->db->get('whole_attribute_options')->result();
					$data['productOptions'] = $options;
					$data['product'] = $product;
					$data['assigned'] = $assigned;
					$data['related'] = $related;

					$meta = json_encode($meta);

					$metadata['metadata'] = json_decode($meta);

					$this->load->view('wholesale/globals/header',$metadata);
					$this->load->view('wholesale/product/product',$data);
					$this->load->view('wholesale/globals/footer');

				}else{

					$this->db->where('blog_slug',$slug);
					$blogs = $this->db->get('whole_blogs');

					if($blogs->num_rows() > 0){

						$meta  = array(
							'page_meta_title' => $blogs->blog_meta_title,
							'page_meta_keywords' => $blogs->blog_meta_keywords,
							'page_meta_description' => $blogs->blog_short_description,
						);

						$data['blog'] = $blogs->row();
						$meta = json_encode($meta);
						$metadata['metadata'] = json_decode($meta);

						$this->load->view('wholesale/globals/header',$metadata);
						$this->load->view('wholesale/blogs/single_blog',$data);
						$this->load->view('wholesale/globals/footer');

					}else{

						if(strrpos($this->uri->segment(1), 'admin')  !== false){
							redirect('admin/404-error');
						}else{
							redirect('404-error');
						}
						
					}
				}
			}
			
		}
	}