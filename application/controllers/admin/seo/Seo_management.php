<?php

	defined('BASEPATH') or exit('No direct script is allowed');

	/**
	 * 
	 */
	class Seo_management extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			if(!$this->session->admin_id){
				redirect(site_url('admin'));
			}
		}

		public function index(){

			$data['pages'] = $this->db->get('whole_page_seo')->result();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/seo/seo',$data);
			$this->load->view('admin/globals/footer');
		}

		public function get_page(){

			$this->db->where('page_id',$this->input->post('id'));
			$page = $this->db->get('whole_page_seo')->row();

			echo json_encode($page);
			exit;
		}

		public function save_page(){

			$metatitle = $this->input->post('metatitle');
			$metakeyword = $this->input->post('metakeywords');
			$metadescription = $this->input->post('metadescription');
			$id = $this->input->post('pageId');

			$bannerImage = '';
			
			if(array_key_exists('bannerImage', $_FILES)){
				if($_FILES['bannerImage']['name']){

					$config['upload_path'] = './uploads/banners/';
		            $config['allowed_types'] = 'jpg|png|jpeg|gif';
		            $config['max_size'] = '50000';
		            $config['overwrite'] = TRUE;	            
		            $this->upload->initialize($config);
		            if($this->upload->do_upload('bannerImage')){
		                $uploadData = $this->upload->data();
		                $bannerImage = $uploadData['file_name'];

		                $image_sizes = array(
					        'extralarge' => array(1920,250),
					    );

					    $this->load->library('image_lib');
						foreach ($image_sizes as $resize) {

						    $config = array(
						        'source_image' => $uploadData['full_path'],
						        'new_image' => './uploads/banners/thumbs/'. $uploadData['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$uploadData['file_ext'],
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
						$this->db->where('page_id',$id);
						$cat = $this->db->get('whole_page_seo')->row();
						$bannerImage = $cat->banner_image;
					}
				}
			}

			$data = array(
				'page_meta_title' => $metatitle,
				'page_meta_description' => $metadescription,
				'page_meta_keywords' => $metakeyword,
				'banner_image' => $bannerImage
			);

			$this->db->where('page_id',$id);
			$query = $this->db->update('whole_page_seo',$data);

			if($query){

				echo json_encode(['msg' => 'done']);
				exit;

			}else{

				echo json_encode(['msg' => 'error']);
				exit;
			}
		}


		/*

				Slider Function From Below

				Author : Sourabh Chotia
				
		*/

		public function sliders(){

			$data['sliders'] = $this->db->get('whole_sliders')->result();

			$this->load->view('admin/globals/head');
			$this->load->view('admin/globals/side');
			$this->load->view('admin/slider/sliders',$data);
			$this->load->view('admin/globals/footer');
		}

		public function save_slider(){


			$heading = $this->input->post('sliderheading');
			$caption = $this->input->post('sliderCaption');
			$buttontext = $this->input->post('sliderButtonText');
			$url = $this->input->post('sliderURL');

			$id = $this->input->post('sliderId');

			if($_FILES['sliderImage']['name']){

				$config['upload_path'] = './uploads/sliders/';
	            $config['allowed_types'] = 'jpg|png|jpeg|gif';
	            $config['max_size'] = '50000';
	            $config['overwrite'] = TRUE;	            
	            $this->upload->initialize($config);
	            if($this->upload->do_upload('sliderImage')){
	                $uploadData = $this->upload->data();
	                $sliderImage = $uploadData['file_name'];

	                $image_sizes = array(
				        'extralarge' => array(1920,600),
				    );

				    $this->load->library('image_lib');
					foreach ($image_sizes as $resize) {

					    $config = array(
					        'source_image' => $uploadData['full_path'],
					        'new_image' => './uploads/sliders/thumbs/'. $uploadData['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$uploadData['file_ext'],
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
					$this->db->where('slider_id',$id);
					$cat = $this->db->get('whole_sliders')->row();
					$sliderImage = $cat->slider_image;
				}
			}

			if($id){
				$data = array(
					'slider_heading' => $heading,
					'slider_caption' => $caption,
					'slider_button_text' => $buttontext,
					'slider_page_url' => $url,
					'slider_image' => $sliderImage,
					'slider_modified_on' => date('y-m-d'),
					'slider_modified_by' => $this->session->admin_id
				);

				$this->db->where('slider_id',$id);
				$query = $this->db->update('whole_sliders',$data);

				if($query){

					echo json_encode(['msg' => 'updated']);
					exit;

				}else{

					echo json_encode(['msg' => 'error']);
					exit;
				}

			}else{

				$data = array(
					'slider_heading' => $heading,
					'slider_caption' => $caption,
					'slider_button_text' => $buttontext,
					'slider_page_url' => $url,
					'slider_image' => $sliderImage,
					'slider_created_on' => date('y-m-d'),
					'slider_created_by' => $this->session->admin_id
				);
				$query = $this->db->insert('whole_sliders',$data);

				if($query){

					echo json_encode(['msg' => 'Inserted']);
					exit;

				}else{

					echo json_encode(['msg' => 'error']);
					exit;
				}
			}

		}


		public function get_slider(){

			$this->db->where('slider_id',$this->input->post('id'));
			$slider = $this->db->get('whole_sliders')->row();

			echo json_encode($slider);
			exit;
		}

		public function change_slider_status(){

			$this->db->where('slider_id',$this->input->post('id'));
			$query = $this->db->update('whole_sliders',['slider_status' => $this->input->post('status')]);

				if($query){

					echo json_encode(['msg' => 'changed']);
					exit;

				}else{

					echo json_encode(['msg' => 'error']);
					exit;
				}
		}
	}