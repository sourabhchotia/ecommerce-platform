<?php
	
	defined('BASEPATH') or exit('No Direct Script is Allowed');

	/**
	 * 
	 */
	class Attribute extends CI_model
	{
		
		function __construct()
		{
			parent::__construct();


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

		public function add_attributes(){

			// Catch All Form Data Here
			$name = strtoupper($this->input->post('attributeName'));
			
			$is_filter = $is_variant = '0';
			$type = 'other';

			if($this->input->post('is_filter')){
				$is_filter = '1';
			}

			if($this->input->post('is_variant')){
				$is_variant = '1';
			}

			if($this->input->post('att_type')){
				$type = $this->input->post('att_type');
			}

			$id = $this->input->post('attributeId');

			// Check if id has been submitted or not, 
			// if id has been submitted that means this is a request to update the attribute

			if(!empty($id)){

				// If id has been submitted than create and array and update the data
				$data = array(

					'attribute_name' => $name,
					'attribute_filter' => $is_filter,
					'attribute_variant' => $is_variant,
					'attribute_type' => $type,
					'attribute_modified_on' => date('y-m-d'),
					'attribute_modified_by' => $this->session->admin_id,
				);

				$this->db->where('attribute_id',$id);
				$query = $this->db->update('whole_attributes',$data);

				// Check the response of update query and than return the result to the ajax call
				if($query){

					echo json_encode(['msg' => 'updated']);
					exit;
				}else{

					echo json_encode(['msg' => 'error']);
					exit;
				}
			}else{

				// Check if Attribute is Already Created or not;

				$this->db->where('attribute_name',$name);
				$query = $this->db->get('whole_attributes');

				if($query->num_rows() > 0){

					echo json_encode(['msg' => 'already']);
					exit;

				}

				// If id is not submitted than create and array and insert the data

				$data = array(

					'attribute_name' => $name,
					'attribute_filter' => $is_filter,
					'attribute_variant' => $is_variant,
					'attribute_type' => $type,
					'attribute_created_on' => date('y-m-d'),
					'attribute_created_by' => $this->session->admin_id,
				);

				$query = $this->db->insert('whole_attributes',$data);

				// Check the response of update query and than return the result to the ajax call

				if($query){

					echo json_encode(['msg' => 'inserted']);
					exit;
				}else{

					echo json_encode(['msg' => 'error']);
					exit;
				}
			}
		}


		public function get_attributes(){
			// Return List of All Attributes
			return $this->db->get('whole_attributes')->result();
		}

		public function change_att_status(){

			// Update Status of Attributes Whose id has been submitted through post data

			$this->db->where('attribute_id',$this->input->post('id'));
			$query = $this->db->update('whole_attributes',['attribute_status' => $this->input->post('status')]);

			// Return Result to the Ajax Call
			if($query){
				echo json_encode(['msg' => 'updated']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}
		}

		public function get_attribute(){

			// Fetch Attribute from table by attribute id
			$this->db->where('attribute_id',$this->input->post('id'));
			$data = $this->db->get('whole_attributes')->row();

			// Build Array and return it as result to ajax call
			$output = array(
				'id' => $data->attribute_id,
				'filter' => $data->attribute_filter,
				'variant' => $data->attribute_variant,
				'type' => $data->attribute_type,
				'name' => $data->attribute_name,
				'msg' => 'success'
			);

			echo json_encode($output);
			exit;
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

		public function get_attribute_options(){

			// Return List of All Attribute Options

			return $this->db->get('whole_attribute_options')->result();
		}

		public function save_attribute_option(){

			// Catch Post data into variabels first

			$name = strtoupper($this->input->post('attributeOptionName'));
			$displayname = strtoupper($this->input->post('attributeOptionDisplayName'));
			$attributeName = $this->input->post('attributeName');
			$optionType = $this->input->post('optionType');
			$value = $this->input->post('optionValue');
			$id = $this->input->post('attributeOptionId');

			// Check if id has been posted 

			if(!empty($id)){

				$data = array(
					'option_name' => $name,
					'option_display_name' => $displayname,
					'option_attribute' => $attributeName,
					'option_type' => $optionType,
					'option_value' => $value,
					'option_modified_on' => date('y-m-d'),
					'option_modified_by' => $this->session->admin_id,
				);

				$this->db->where('option_id',$id);
				$query = $this->db->update('whole_attribute_options',$data);

				if($query){

					echo json_encode(['msg' => 'updated']);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);
					exit;
				}
			}else{

				$this->db->where('option_name',$name);
				$query = $this->db->get('whole_attribute_options');

				if($query->num_rows() > 0){

					echo json_encode(['msg' => 'already'] );
					exit;
				}

				$data = array(
					'option_name' => $name,
					'option_display_name' => $displayname,
					'option_attribute' => $attributeName,
					'option_type' => $optionType,
					'option_value' => $value,
					'option_created_on' => date('y-m-d'),
					'option_created_by' => $this->session->admin_id,
				);

				$query = $this->db->insert('whole_attribute_options',$data);

				if($query){

					echo json_encode(['msg' => 'inserted']);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);
					exit;
				}
			}
		}

		public function change_attribute_option_status(){

			// Update Status of Attributes Whose id has been submitted through post data

			$this->db->where('option_id',$this->input->post('id'));
			$query = $this->db->update('whole_attribute_options',['option_status' => $this->input->post('status')]);

			// Return Result to the Ajax Call
			if($query){
				echo json_encode(['msg' => 'updated']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}
		}

		public function get_attribute_option(){

			$this->db->where('option_id',$this->input->post('id'));
			$data = $this->db->get('whole_attribute_options')->row();

			$output = array(
				'name' => $data->option_name,
				'id' => $data->option_id,
				'display' => $data->option_display_name,
				'type' => $data->option_type,
				'value' => $data->option_value,
				'attribute' => $data->option_attribute,
				'msg' => 'success'
			);

			echo json_encode($output);	
		}

		public function get_att_options_by_att(){

			$this->load->model('admin/Category','category');


			$this->db->where('option_attribute',$this->input->post('id'));
			$query = $this->db->get('whole_attribute_options');

			$assigned = $this->get_assigned_options();

			$categories = $this->category->get_all_categories();

			if($query->num_rows() > 0){

				$i = 1;
				$html = '';
				foreach($query->result() as $option){

					$html .= '<tr>';
					$html .= '<td>';
					$html .= '<div class="form-check form-check-inline">';
					$html .= '<div class="custom-control custom-checkbox">';
					$html .= '<input type="checkbox" class="custom-control-input checkbox" id="select'.$option->option_id.'" value="'.$option->option_id .'" name="options[]">';
					$html .= '<label class="custom-control-label" for="select'.$option->option_id.'"></label></div></div></td>';

					$html .= '<td>';
					if($option->option_type == 'color'){

						$html .= '<div style="height:20px;width:20px;border : 1px solid #000; background-color : '.$option->option_value.'"></div>';
					}else{
						$html .= $option->option_value;
					}
					$html .= '</td>';

					$html .= '<td>'.$option->option_name.'</td>';
					$html .= '<td>';
					if($assigned){ foreach($assigned as $assign){ 

                        if($assign->assign_option == $option->option_id){
                            foreach($categories as $cat){

                                if($cat->category_id == $assign->assign_category){

                                	$this->db->where('category_id',$cat->category_id);
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
                                                $cateName = $category1->category_name.'->'.$category3->category_name.'->'.$category2->category_name.'/'.$category4->category_name;
                                            }else{
                                                $cateName = $category3->category_name.'->'.$category2->category_name.'->'.$category1->category_name;
                                            }
                                        }else{
                                            $cateName = $category2->category_name.'->'.$category1->category_name;
                                        }
                                    }else{
                                        $cateName = $category1->category_name;
                                    }
                                    $html .= '<div style="padding: 5px 5px; display : inline-block; border : 1px solid #dee2e6;margin-right : 2px;">'.$cateName.'</div>';
                                }
                            }
                        }
                    }
                    $html .= '</td>';

                    $html .= '<td>';
                    $html .= '<a href="'.site_url('admin/attributes/edit-options-to-attributes').'?queryType=edit&queryItem='.$option->option_id.'" class="text-inverse p-r-10" data-toggle="tooltip" title="" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
                    $html .='</td></tr>';
                }
                    

                    $i++;
				}

				echo $html;
				exit;
			}else{

				echo '<tr class="text-center"><td colspan="4"><h3>No Result Found</h3></td></tr>';
				exit;

			}
		}
		public function save_to_attribute(){

			$attribute = $this->input->post('attribute');

			$options = $this->input->post('options');

			if(!empty($this->input->post('innerCategory'))){
				$type = 'inner';
				$category = $this->input->post('innerCategory');

			}else if(!empty($this->input->post('subCategory'))){
				$type = 'sub';
				$category = $this->input->post('subCategory');

			}else if(!empty($this->input->post('mainCategory'))){
				$type = 'main';
				$category = $this->input->post('mainCategory');

			}else if(!empty($this->input->post('parentCategory'))){
				$type = 'parent';
				$category = $this->input->post('parentCategory');

			}

			foreach($options as $value){

				$this->db->where('assign_attribute',$attribute);
				$this->db->where('assign_category',$category);
				$this->db->where('assign_option',$value);
				$query = $this->db->get('whole_assigned_options');

				if($query->num_rows() === 0){

					$data = array(
						'assign_attribute' => $attribute,
						'assign_category_type' => $type,
						'assign_category' => $category,
						'assign_option' => $value,
						'assigned_on' => date('y-m-d'),
						'assigned_by' => $this->session->admin_id,
					);

					$error[] = $this->db->insert('whole_assigned_options',$data);
				}
			}

			foreach($error as $err){

				if(!$err){
					return false;
				}
			}

			return true;

		}


		public function edit_assigned_attribute($id){

			$this->db->where('assign_option',$id);
			return $this->db->get('whole_assigned_options')->result();
		}

		public function get_option_by_id($id){

			$this->db->where('option_id',$id);
			return $this->db->get('whole_attribute_options')->row();
		}

		public function update_assigned_attribute(){
			$option = $this->input->post('option_id');
			$attribute = $this->input->post('attribute_id');
			$categories = $this->input->post('options');

			$this->db->where('assign_option',$option);
			$options = $this->db->get('whole_assigned_options')->result();

			foreach($options as $op){

				$opCategory[] =  $op->assign_category;
			}

			foreach ($opCategory as $value) {
				
				if(in_array($value, $categories)){
				}else{

					$this->db->where('assign_attribute',$attribute);
					$this->db->where('assign_option',$option);
					$this->db->where('assign_category',$value);
					$error[] = $this->db->delete('whole_assigned_options');
				}
			}
			foreach($error as $err){
				if(!$err){
					return false;
				}
			}
			return true;
		}

		public function get_assigned_options(){

			return $this->db->get('whole_assigned_options')->result();
		}
	}