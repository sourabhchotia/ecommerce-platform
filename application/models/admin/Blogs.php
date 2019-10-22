<?php

	defined('BASEPATH') or exit('No Direct Script is Allowed');

	/**
	 * 
	 */
	class Blogs extends CI_model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function save_category(){

			$category = strtoupper($this->input->post('categoryName'));

			$categoryImage = '';

			$id = $this->input->post('categoryId');

			if($_FILES['categoryImage']['name']){

				$config['upload_path'] = './uploads/blogs/category/';
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
					        'new_image' => './uploads/blogs/category/thumbs/'. $uploadData['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$uploadData['file_ext'],
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
					$cat = $this->db->get('whole_blogs_category')->row();

					$categoryImage = $cat->category_image;
				}
			}

			

			if(!empty($id)){

				$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($category));
				$slug = check_slug($slug,'whole_blogs_category','category_slug','category_id',$id);

				$data = array(
					'category_name' => $category,
					'category_image' => $categoryImage,
					'category_slug' => $slug,
					'category_modified_on' => date('y-m-d'),
					'category_modified_by' => $this->session->admin_id
				);

				$this->db->where('category_id',$id);
				$query = $this->db->update('whole_blogs_category',$data);

				if($query){

					echo json_encode(array('msg' => 'updated'));
					exit;
				}else{

					echo json_encode(array('msg' => 'error'));
					exit;
				}

			}else{

				$this->db->where('category_name',$category);
				$query = $this->db->get('whole_blogs_category');

				if($query->num_rows() > 0){
					echo json_encode(array('msg' => 'already'));
					exit;
				}
				

				$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($category));
				$slug = check_slug($slug,'whole_blogs_category','category_slug','','');

				$data = array(
					'category_name' => $category,
					'category_image' => $categoryImage,
					'category_slug' => $slug,
					'category_created_on' => date('y-m-d'),
					'category_created_by' => $this->session->admin_id
				);

				$query = $this->db->insert('whole_blogs_category',$data);

				if($query){

					echo json_encode(array('msg' => 'Inserted'));
					exit;
				}else{

					echo json_encode(array('msg' => 'error'));
					exit;
				}
			}
		}

		public function get_all_categories(){
			return $this->db->get('whole_blogs_category')->result();
		}

		public function change_category_status(){

			$this->db->where('category_id',$this->input->post('id'));
			$query = $this->db->update('whole_blogs_category',['category_status' => $this->input->post('status')]);

			if($query){

				echo json_encode(['msg' => 'changed']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
				exit;

			}
		}

		public function get_category(){

			$this->db->where('category_id',$this->input->post('id'));
			$category = $this->db->get('whole_blogs_category')->row();


			$filename= pathinfo($category->category_image,PATHINFO_FILENAME);
            $file_ext = pathinfo($category->category_image,PATHINFO_EXTENSION);

			$data = array(
				'name' => $category->category_name,
				'id' => $category->category_id,
				'msg' => 'success',
				'filename' => $filename,
				'ext' => $file_ext
			);

			echo json_encode($data);
			exit;
		}


		public function save_blog(){

			$name = $this->input->post('blogName');
			$blogCategory = $this->input->post('blogCategory');

			$blogTags = '';
			if($this->input->post('blogTags'))
				$blogTags = implode(', ',$this->input->post('blogTags'));


			$description = $this->input->post('description');
			$shortDescription = $this->input->post('shortDescription');
			$metaTitle = $this->input->post('metaTitle');
			$metaDescription = $this->input->post('metaDescription');


			$mainImage =  $gallery = '';
			$galleryImages = array();

			if($_FILES['categoryImage']['name']){
				$config['upload_path'] = './uploads/blogs/';
	            $config['allowed_types'] = 'jpg|png|jpeg|gif';
	            $config['max_size'] = '50000';	  
	            $config['overwrite'] = TRUE;          
	            $this->upload->initialize($config);

	            if($this->upload->do_upload('categoryImage')){
	                $uploadData = $this->upload->data();
	                $mainImage = $uploadData['file_name'];
	                $image_sizes = array(
	                	'thumb' => array(50,50),
				        'small' => array(200, 350),
				        'medium' => array(500, 700),
				        'large' => array(600, 900),
				    );
				    $this->load->library('image_lib');
					foreach ($image_sizes as $resize) {
					    $config = array(
					        'source_image' => $uploadData['full_path'],
					        'new_image' => './uploads/blogs/thumbs/'. $uploadData['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$uploadData['file_ext'],
					        'maintain_ration' => false,
					        'width' => $resize[0],
					        'height' => $resize[1]
					    );
					    $this->image_lib->initialize($config);
					    $this->image_lib->resize();
					    $this->image_lib->clear();
					}
	            }
			}

			if($_FILES['gallerImage']['name']){

			    $files = $_FILES;
			    $cpt = count($_FILES['gallerImage']['name']);

			    


			    for($i=0; $i<$cpt; $i++)
			    {           
			        $_FILES['gallerImage']['name']= $files['gallerImage']['name'][$i];
			        $_FILES['gallerImage']['type']= $files['gallerImage']['type'][$i];
			        $_FILES['gallerImage']['tmp_name']= $files['gallerImage']['tmp_name'][$i];
			        $_FILES['gallerImage']['error']= $files['gallerImage']['error'][$i];
			        $_FILES['gallerImage']['size']= $files['gallerImage']['size'][$i];   


			        $config['upload_path'] = './uploads/blogs/';
		            $config['allowed_types'] = 'jpg|png|jpeg|gif';
		            $config['max_size'] = '50000';
		            $config['overwrite'] = TRUE;	            
		            $this->upload->initialize($config);

			        if($this->upload->do_upload('gallerImage')){
			        	$dataInfo = $this->upload->data();

			        	$galleryImages[] = $dataInfo['file_name'];

			        	$image_sizes = array(
	                		'thumb' => array(50,50),
				        	'small' => array(200, 350),
				        	'medium' => array(500, 700),
				        	'large' => array(600, 900),
					    );
					    $this->load->library('image_lib');
						foreach ($image_sizes as $resize) {
						    $config = array(
						        'source_image' => $dataInfo['full_path'],
						        'new_image' => './uploads/blogs/thumbs/'. $dataInfo['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$dataInfo['file_ext'],
						        'maintain_ration' => false,
						        'width' => $resize[0],
						        'height' => $resize[1]
						    );
						    $this->image_lib->initialize($config);
						    $this->image_lib->resize();
						    $this->image_lib->clear();
						}
			        }
			    }
			}

			if(!empty($galleryImages)){
				$gallery = implode(',', $galleryImages);
			}

			$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($name));
			$slug = check_slug($slug,'whole_blogs','blog_slug','','');

			$data = array(
				'blog_name' => $name,
				'blog_slug' => $slug,
				'blog_category' => $blogCategory,
				'blog_image' => $mainImage,
				'blog_gallery' => $gallery,
				'blog_tags' => strtoupper($blogTags),
				'blog_description' => $description,
				'blog_short_description' => $shortDescription,
				'blog_meta_title' => $metaTitle,
				'blog_meta_keywords' => $metaDescription,
				'blog_created_by' => $this->session->admin_id,
				'blog_created_on' => date('y-m-d'),
			);
			$query = $this->db->insert('whole_blogs',$data);

			if($query){
				echo json_encode(['msg' => 'inserted']);
				exit;

			}else{

				echo json_encode(['msg' => 'error']);
				exit;

			}

		}

		public function get_blogs_listing(){

			$draw = $_POST['draw'];
			$row = $_POST['start'];
			$rowperpage = $_POST['length']; // Rows display per page
			$searchValue = $_POST['search']['value'];
			
			$to = $_POST['to'];
			$from = $_POST['from'];
			$category_id = $_POST['category_id'];

			if(($to != '') && ($from !='')){
	   				$this->db->where('blog_created_on >=', date('Y-m-d',strtotime($from)));
					$this->db->where('blog_created_on <=', date('Y-m-d',strtotime($to)));
			}
			if($category_id != ''){
			   $this->db->where('blog_category', $category_id);
			}

			if($searchValue != ''){
			    $this->db->where("blog_name like '%".$searchValue."%' or CONCAT(',', blog_tags, ',') like '%".$searchValue."%'");			
			}


			$this->db->select('*');
			$this->db->from('whole_blogs');
			$totalRecordwithFilter = $totalRecords = $this->db->get()->num_rows();


			if(($to != '') && ($from !='')){
	   				$this->db->where('blog_created_on >=', date('Y-m-d',strtotime($from)));
					$this->db->where('blog_created_on <=', date('Y-m-d',strtotime($to)));
			}
			if($category_id != ''){
			   $this->db->where('blog_category', $category_id);
			}

			if($searchValue != ''){
			    $this->db->where("blog_name like '%".$searchValue."%' or CONCAT(',', blog_tags, ',') like '%".$searchValue."%'");			
			}

			$this->db->select('*');
			$this->db->from('whole_blogs');
			$this->db->limit($rowperpage,$row);
			$blogs = $this->db->get()->result_array();

			$data = array();

			if($blogs){
				foreach ($blogs as $blog) {
					

					$this->db->where('category_id',$blog['blog_category']);
					$category = $this->db->get('whole_blogs_category')->row();


                    $action = '<a class="text-inverse p-r-10" href="javascript:void(0)"><i class="ti-eye"></i></a>';

					$action .= '<a class="text-inverse p-r-10" href="'.site_url('admin/blogs/edit-blog/'.$blog['blog_slug']).'"><i class="ti-pencil"></i></a>';

                    if($blog['blog_status'] == 1){

                    	$status = '<span class="label label-success font-weight-100">Active</span>';

                        $action .= '<a href="javascript:void(0)" class="text-inverse p-r-10 disableBlog" data-toggle="tooltip" title="" data-original-title="Disable" data-id="'.$blog['blog_id'].'"  data-status="0"><i class="ti-trash"></i></a>';
                    }else{
                        $action .= '<a href="javascript:void(0)" class="text-inverse p-r-10 disableBlog" data-toggle="tooltip" title="" data-original-title="Disable" data-id="'.$blog['blog_id'].'"  data-status="1"><i class="ti-check-box"></i></a>';

                        $status = '<span class="label label-warning font-weight-100">In-active</span>';
                    }

                    $filename= pathinfo($blog['blog_image'],PATHINFO_FILENAME);
                    $file_ext = pathinfo($blog['blog_image'],PATHINFO_EXTENSION);

					$img = '<img src="'.base_url().'uploads/blogs/thumbs/'.$filename.'-50x50.'.$file_ext.'">';
				   	$data[] = array( 
				   	  "blog_image" => $img,
				      "blog_title"=>$blog['blog_name'],
				      "category"=>$category->category_name,
				      "tags"=>$blog['blog_tags'],
				      "short"=>$blog['blog_short_description'],
				      "status" => $status,
				      "actions"=>$action,
				   	);
				}

				
			}

			$response = array(
			  "draw" => intval($draw),
			  "iTotalRecords" => $totalRecordwithFilter,
			  "iTotalDisplayRecords" => $totalRecords,
			  "aaData" => $data
			);

			echo json_encode($response);

		}

		public function disable_blogs(){
			$this->db->where('blog_id',$this->input->post('id'));
			$query = $this->db->update('whole_blogs',['blog_status' => $this->input->post('status')]);

			if($query){
				echo json_encode(['msg' => 'updated']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}
		}

		public function get_blog_by_slug($slug){

			$this->db->where('blog_slug',$slug);
			return $this->db->get('whole_blogs')->row();
		}


		public function update_blog(){

			$name = $this->input->post('blogName');
			$blogCategory = $this->input->post('blogCategory');
			$blogTags = implode(', ',$this->input->post('blogTags'));
			$description = $this->input->post('description');
			$shortDescription = $this->input->post('shortDescription');
			$metaTitle = $this->input->post('metaTitle');
			$metaDescription = $this->input->post('metaDescription');
			$id = $this->input->post('blog_id');


			$mainImage =  $gallery = '';
			$galleryImages = array();


			$this->db->where('blog_id',$id);
			$blog = $this->db->get('whole_blogs')->row();


			if($_FILES['categoryImage']['name']){
				$config['upload_path'] = './uploads/blogs/';
	            $config['allowed_types'] = 'jpg|png|jpeg|gif';
	            $config['max_size'] = '50000';	
	            $config['overwrite'] = TRUE;            
	            $this->upload->initialize($config);

	            if($this->upload->do_upload('categoryImage')){
	                $uploadData = $this->upload->data();
	                $mainImage = $uploadData['file_name'];
	                $image_sizes = array(
	                	'thumb' => array(50,50),
				        'small' => array(200, 350),
				        'medium' => array(500, 700),
				        'large' => array(600, 900),
				    );
				    $this->load->library('image_lib');
					foreach ($image_sizes as $resize) {
					    $config = array(
					        'source_image' => $uploadData['full_path'],
					        'new_image' => './uploads/blogs/thumbs/'. $uploadData['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$uploadData['file_ext'],
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

				$mainImage = $blog->blog_image;
			}

			if($_FILES['gallerImage']['name']){

			    $files = $_FILES;
			    $cpt = count($_FILES['gallerImage']['name']);

			    


			    for($i=0; $i<$cpt; $i++)
			    {           
			        $_FILES['gallerImage']['name']= $files['gallerImage']['name'][$i];
			        $_FILES['gallerImage']['type']= $files['gallerImage']['type'][$i];
			        $_FILES['gallerImage']['tmp_name']= $files['gallerImage']['tmp_name'][$i];
			        $_FILES['gallerImage']['error']= $files['gallerImage']['error'][$i];
			        $_FILES['gallerImage']['size']= $files['gallerImage']['size'][$i];   


			        $config['upload_path'] = './uploads/blogs/';
		            $config['allowed_types'] = 'jpg|png|jpeg|gif';
		            $config['max_size'] = '50000';	
		            $config['overwrite'] = TRUE;            
		            $this->upload->initialize($config);

			        if($this->upload->do_upload('gallerImage')){
			        	$dataInfo = $this->upload->data();

			        	$galleryImages[] = $dataInfo['file_name'];

			        	$image_sizes = array(
	                		'thumb' => array(50,50),
				        	'small' => array(200, 350),
				        	'medium' => array(500, 700),
				        	'large' => array(600, 900),
					    );
					    $this->load->library('image_lib');
						foreach ($image_sizes as $resize) {
						    $config = array(
						        'source_image' => $dataInfo['full_path'],
						        'new_image' => './uploads/blogs/thumbs/'. $dataInfo['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$dataInfo['file_ext'],
						        'maintain_ration' => false,
						        'width' => $resize[0],
						        'height' => $resize[1]
						    );
						    $this->image_lib->initialize($config);
						    $this->image_lib->resize();
						    $this->image_lib->clear();
						}
			        }
			    }
			}

			if(!empty($galleryImages)){
				$gallery = implode(',', $galleryImages);
			}else{
				$gallery = $blog->blog_gallery;
			}

			$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($name));
			$slug = check_slug($slug,'whole_blogs','blog_slug','blog_id',$id);

			$data = array(
				'blog_name' => $name,
				'blog_slug' => $slug,
				'blog_category' => $blogCategory,
				'blog_image' => $mainImage,
				'blog_gallery' => $gallery,
				'blog_tags' => strtoupper($blogTags),
				'blog_description' => $description,
				'blog_short_description' => $shortDescription,
				'blog_meta_title' => $metaTitle,
				'blog_meta_keywords' => $metaDescription,
				'blog_created_by' => $this->session->admin_id,
				'blog_created_on' => date('y-m-d'),
			);

			$this->db->where('blog_id',$id);
			$query = $this->db->update('whole_blogs',$data);

			if($query){

				$this->session->set_flashdata('success','Blog has been updated succesfuly');
				redirect('admin/blogs/edit-blog/'.$blog->blog_slug);

			}else{

				$this->session->set_flashdata('error','Error! Please try again');
				redirect('admin/blogs/edit-blog/'.$blog->blog_slug);

			}

		}
	}