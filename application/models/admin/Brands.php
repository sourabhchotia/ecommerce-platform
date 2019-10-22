<?php

	defined('BASEPATH') or exit('No Direct Script is Allowed');

	/**
	 * 
	 */
	class Brands extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function save_brands(){

			$name = strtoupper($this->input->post('brandName'));
			$id = $this->input->post('brandId');

			if($_FILES['brandImage']['name']){

				$config['upload_path'] = './uploads/brands/';
	            $config['allowed_types'] = 'jpg|png|jpeg|gif';
	            $config['max_size'] = '50000';	 
	            $config['overwrite'] = TRUE;           
	            $this->upload->initialize($config);
	            
	            if($this->upload->do_upload('brandImage')){
	                
	                $uploadData = $this->upload->data();

	                

	                $brandImage = $uploadData['file_name'];

	                $image_sizes = array(
	                	'thumb' => array(150,50),
				        'small' => array(300, 100),
				        'medium' => array(500, 200),
				    );

				    $this->load->library('image_lib');
					foreach ($image_sizes as $resize) {

					    $config = array(
					        'source_image' => $uploadData['full_path'],
					        'new_image' => './uploads/brands/thumbs/'. $uploadData['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$uploadData['file_ext'],
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

					$this->db->where('brand_id',$id);
					$cat = $this->db->get('whole_brands')->row();

					$categoryImage = $cat->brand_image;
				}
			}

			if($id){

				$data = array(
					'brand_name' => $name,
					'brand_image' => $brandImage,
					'brand_modified_on' => date('y-m-d'),
					'brand_modified_by' => $this->session->admin_id,
				);

				$this->db->where('brand_id',$id);
				$query = $this->db->update('whole_brands',$data);

				if($query){

					echo json_encode(['msg' => 'updated' ]);
					exit;
				}else{

					echo json_encode(['msg' => 'error']);
					exit;

				}
			}else{

				$this->db->where('brand_name',$name);
				$query = $this->db->get('whole_brands');

				if($query->num_rows() > 0){

					echo json_encode(['msg' => 'already']);
					exit;

				}
				$data = array(
					'brand_name' => $name,
					'brand_image' => $brandImage,
					'brand_created_on' => date('y-m-d'),
					'brand_created_by' => $this->session->admin_id,
				);

				$query = $this->db->insert('whole_brands',$data);

				if($query){

					echo json_encode(['msg' => 'inserted' ]);
					exit;
				}else{

					echo json_encode(['msg' => 'error']);
					exit;
					
				}
			}
		}

		public function get_brands(){

			return $this->db->get('whole_brands')->result();
		}

		public function change_status(){

			$this->db->where('brand_id',$this->input->post('id'));
			$query = $this->db->update('whole_brands',['brand_status' => $this->input->post('status')]);

			if($query){
				echo json_encode(['msg' => 'changed']);
				exit;
			}else{

				echo json_encode(['msg' => 'error']);
				exit;
			}
		}

		public function get_brand(){

			$this->db->where('brand_id',$this->input->post('id'));
			$query = $this->db->get('whole_brands')->row();

			$filename= pathinfo($query->brand_image,PATHINFO_FILENAME);
            $file_ext = pathinfo($query->brand_image,PATHINFO_EXTENSION);

			$data = array(
				'name' => $query->brand_name,
				'id' => $query->brand_id,
				'filename' => $filename,
				'ext' => $file_ext
			);

			echo json_encode($data);
			exit;
		}
	}