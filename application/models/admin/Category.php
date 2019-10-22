<?php

	defined('BASEPATH') or exit('No direct Script is allowed');

	/**
	 * 
	 */
	class Category extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function save_category(){

			$category = strtoupper($this->input->post('categoryName'));
			$parent = $this->input->post('parentCategory');
			$main = $this->input->post('mainCategory');
			$sub = $this->input->post('subCategory');
			$meta_title = $this->input->post('meta_title');
			$meta_keywords = $this->input->post('meta_keywords');
			$meta_description = $this->input->post('meta_description');

			$categoryImage = '';

			$id = $this->input->post('categoryId');

			if($_FILES['categoryImage']['name']){

				$config['upload_path'] = './uploads/category/';
	            $config['allowed_types'] = 'jpg|png|jpeg|gif';
	            $config['max_size'] = '50000';	
	            $config['overwrite'] = TRUE;            
	            $this->upload->initialize($config);
	            
	            if($this->upload->do_upload('categoryImage')){
	                
	                $uploadData = $this->upload->data();

	                

	                $categoryImage = $uploadData['file_name'];

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
					        'new_image' => './uploads/category/thumbs/'. $uploadData['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$uploadData['file_ext'],
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

					$this->db->where('category_id',$id);
					$cat = $this->db->get('whole_category')->row();

					$categoryImage = $cat->category_image;
				}
			}

			if(!empty($sub)){

				$parentCategory = $sub;
				$role = 'inner';

				$this->db->where('category_id',$sub);
				$cat = $this->db->get('whole_category')->row();

				$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($category));
				$slug = check_slug($cat->category_slug.'/'.$slug,'whole_category','category_slug');

			}else if(!empty($main)){

				$parentCategory = $main;
				$role = 'sub';

				$this->db->where('category_id',$main);
				$cat = $this->db->get('whole_category')->row();

				$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($category));
				$slug = check_slug($cat->category_slug.'/'.$slug,'whole_category','category_slug');


			}elseif(!empty($parent)){

				$parentCategory = $parent;
				$role = 'main';

				$this->db->where('category_id',$parent);
				$cat = $this->db->get('whole_category')->row();

				$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($category));
				$slug = check_slug($cat->category_slug.'/'.$slug,'whole_category','category_slug');

			}else{

				$parentCategory = 0;
				$role = 'parent';

				$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($category));
				$slug = check_slug($slug,'whole_category','category_slug');
			}

			if(!empty($id)){

				$data = array(
					'category_name' => $category,
					'category_role' => $role,
					'parent_category' => $parentCategory,
					'category_image' => $categoryImage,
					'category_slug' => $slug,
					'meta_title' => $meta_title,
					'meta_keywords' => $meta_keywords,
					'meta_description' => $meta_description,
					'category_modified_on' => date('y-m-d'),
					'category_modified_by' => $this->session->admin_id
				);

				$this->db->where('category_id',$id);
				$query = $this->db->update('whole_category',$data);

				if($query){

					echo json_encode(array('msg' => 'updated'));
					exit;
				}else{

					echo json_encode(array('msg' => 'error'));
					exit;
				}

			}else{

				$this->db->where('category_name',$category);
				$this->db->where('parent_category',$parentCategory);
				$query = $this->db->get('whole_category');

				if($query->num_rows() > 0){
					echo json_encode(array('msg' => 'already'));
					exit;
				}
				

				$data = array(
					'category_name' => $category,
					'category_role' => $role,
					'parent_category' => $parentCategory,
					'category_image' => $categoryImage,
					'category_slug' => $slug,
					'meta_title' => $meta_title,
					'meta_keywords' => $meta_keywords,
					'meta_description' => $meta_description,
					'category_created_on' => date('y-m-d'),
					'category_created_by' => $this->session->admin_id
				);

				$query = $this->db->insert('whole_category',$data);

				if($query){

					echo json_encode(array('msg' => 'Inserted'));
					exit;
				}else{

					echo json_encode(array('msg' => 'error'));
					exit;
				}
			}

		}


		public function get_parent_categories(){

					$this->db->where('category_role','parent');
			return $this->db->get('whole_category')->result();
		}

		public function get_main_categories(){
					$this->db->where('category_role','main');
			return $this->db->get('whole_category')->result();
		}

		public function get_sub_categories(){
					$this->db->where('category_role','sub');
			return $this->db->get('whole_category')->result();
		}

		public function get_inner_categories(){
					$this->db->where('category_role','inner');
			return $this->db->get('whole_category')->result();
		}

		public function get_ajax_category(){

			$this->db->where('parent_category',$this->input->post('id'));
			return $this->db->get('whole_category')->result();
		}

		public function change_status(){

			$this->db->where('category_id',$this->input->post('id'));
			$query = $this->db->update('whole_category',[ 'category_status' => $this->input->post('status')]);

			if($query){

				echo json_encode(['msg' => 'changed' ]);
			}else{
				echo json_encode(['msg' => 'error']);
			}
		}

		public function edit_category(){

			

			$this->db->where('category_id',$this->input->post('id'));
			$category1 = $this->db->get('whole_category')->row();

			// Check if Category is Main Category or not.

			if($category1->parent_category != 0){

				$this->db->where('category_id',$category1->parent_category);
				$category2 = $this->db->get('whole_category')->row();

				// Check if Category is Sub Category or not.

				if($category2->parent_category != 0){

					$this->db->where('category_id',$category2->parent_category);
					$category3 = $this->db->get('whole_category')->row();

					// Check if Category is inner Category or not.

					if($category3->parent_category != 0){

						$this->db->where('category_id',$category3->parent_category);
						$category4 = $this->db->get('whole_category')->row();

						// return Inner Category Array
						$filename= pathinfo($category1->category_image,PATHINFO_FILENAME);
                		$file_ext = pathinfo($category1->category_image,PATHINFO_EXTENSION);

						$data = array(
							'name' => $category1->category_name,
							'id' => $category1->category_id,
							'parentId' => $category4->category_id,
							'mainID' => $category3->category_id,
							'mainName' => $category3->category_name,
							'subId' => $category2->category_id,
							'subName' => $category2->category_name,
							'msg' => 'success',
							'filename' => $filename,
							'ext' => $file_ext,
							'meta_title' => $category1->meta_title,
							'meta_keywords' => $category1->meta_keywords,
							'meta_description' => $category1->meta_description,
						);

						echo json_encode($data);
						exit;

					}else{

						// return Sub Category Array
						$filename= pathinfo($category1->category_image,PATHINFO_FILENAME);
                		$file_ext = pathinfo($category1->category_image,PATHINFO_EXTENSION);

						$data = array(
							'name' => $category1->category_name,
							'id' => $category1->category_id,
							'parentId' => $category3->category_id,
							'mainID' => $category2->category_id,
							'mainName' => $category2->category_name,
							'msg' => 'success',
							'filename' => $filename,
							'ext' => $file_ext,
							'meta_title' => $category1->meta_title,
							'meta_keywords' => $category1->meta_keywords,
							'meta_description' => $category1->meta_description,
						);

						echo json_encode($data);
						exit;

					}

				}else{

					// return Main Category Array
					$filename= pathinfo($category1->category_image,PATHINFO_FILENAME);
                	$file_ext = pathinfo($category1->category_image,PATHINFO_EXTENSION);

					$data = array(
						'name' => $category1->category_name,
						'id' => $category1->category_id,
						'parentId' => $category2->category_id,
						'msg' => 'success',
						'filename' => $filename,
						'ext' => $file_ext,
						'meta_title' => $category1->meta_title,
						'meta_keywords' => $category1->meta_keywords,
						'meta_description' => $category1->meta_description,
					);

					echo json_encode($data);
					exit;
				}
			}else{

				// return Parent Category Array

				$filename= pathinfo($category1->category_image,PATHINFO_FILENAME);
                $file_ext = pathinfo($category1->category_image,PATHINFO_EXTENSION);

				$data = array(
					'name' => $category1->category_name,
					'id' => $category1->category_id,
					'msg' => 'success',
					'filename' => $filename,
					'ext' => $file_ext,
					'meta_title' => $category1->meta_title,
					'meta_keywords' => $category1->meta_keywords,
					'meta_description' => $category1->meta_description,
				);

				echo json_encode($data);
				exit;
			}
		}

		public function get_all_categories(){
			return $this->db->get('whole_category')->result();
		}

	}