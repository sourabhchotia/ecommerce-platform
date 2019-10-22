<?php
	
	defined('BASEPATH') or exit('No direct script is allowed');

	/**
	 * 
	 */
	class Products extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function get_attribute_by_category(){

			$category = $this->input->post('id');
			$num = $this->input->post('num');

			$finalCategory = 0;

			$this->db->where('category_id',$category);
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

			$attributes = $options = array();
			if($assigned->num_rows() > 0){

				foreach($assigned->result() as $assign){

					if(in_array($assign->assign_attribute, $attributes)){

					}else{
						$attributes[] = $assign->assign_attribute;
					}

					$options[] = $assign->assign_option;
				}


				$html = '<tr>';
				$i = 0;
				foreach ($attributes as $value) {
					
					$this->db->where('attribute_id',$value);
					$attribute = $this->db->get('whole_attributes')->row();
					$html .='<td><div class="form-group">
                                <select class="custom-select col-12 categorySelect" id="innerCat" name="att_'.$value.'_'.$num.'" required="">
                                    <option selected="" value="">SELECT '.$attribute->attribute_name.'</option>';
                                
					foreach ($options as $op) {

						$this->db->where('option_id',$op);
						$this->db->where('option_attribute',$value);
						$option = $this->db->get('whole_attribute_options')->result();

						foreach($option as $opt){
							$html .= '<option value="'.$opt->option_id.'">'.$opt->option_name.'</option>';
						}
					}

					$html .= '</select>
                            </div></td>';

                            $i++;
				}

				$html .= '<td style="width: 100px;"><input type="text" class="form-control" placeholder="Price" name="attPrice_'.$num.'" required=""></td>
						  <td style="width: 100px;"><input type="text" class="form-control" placeholder="Sale Price" name="attSalePrice_'.$num.'" required=""></td>
						  <td style="width: 100px;"><input type="text" class="form-control" placeholder="Stock" name="attStock_'.$num.'" required=""></td>
						  <td style="width: 100px;"><input type="text" class="form-control" placeholder="SKU Code" name="attSku_'.$num.'" required=""></td></tr>';

				$html .= '<tr><td colspan="'.$i.'">
								<h4 class="card-title m-b-10">Combination Gallery Images</h4>
								<div class="row">
                                    <div class="col-12" class="image_preview">
                                        <img class="categoryImagePreview" class="img-responsive" src="'.site_url().'assets/images/gallery/chair.png" width="90" height="90">
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input gallerImage" name="gallerImage_'.$num.'[]" multiple>
                                                <label class="custom-file-label" for="gallerImage">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</td>
							<td colspan="4">
								<h4 class="card-title m-b-10">Combination Main Image</h4>
								<div class="row">
                                    <div class="col-12 m-b-10">
                                        <img  class="img-responsive ProductImagePreview" src="'.site_url().'assets/images/gallery/chair.png" width="90">
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input ProductImage" name="categoryImage_'.$num.'" >
                                                <label class="custom-file-label" for="ProductImage">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</td>
							</tr>';

			}else{

				$html = '<h3>No Attributes for This Category<h3>';
			}

			echo $html;
			exit;
		}

		public function save_products(){

			$name = $this->input->post('productName');

			// Change Category Selection Here For Customization according to client

			$parentCategory = $this->input->post('parentCategory');
			$mainCategory = $this->input->post('mainCategory');
			$subCategory = $this->input->post('subCategory');
			$innerCategory = $this->input->post('innerCategory');

			if(!empty($innerCategory)){

				$Category = $innerCategory;

			}elseif(!empty($subCategory)){

				$Category = $subCategory;

			}elseif(!empty($mainCategory)){

				$Category = $mainCategory;
				
			}elseif(!empty($parentCategory)){

				$Category = $parentCategory;
				
			}

			// ----------------------------------------------------

			$articalNum = $this->input->post('articalNum');
			$skuCode = $this->input->post('skuCode');
			$hsnCode = $this->input->post('hsnCode');
			$brand = $this->input->post('brand');
			$price = $this->input->post('price');
			$salePrice = $this->input->post('salePrice');
			$stock = $this->input->post('stock');
			$description = $this->input->post('description');
			$shortDescription = $this->input->post('shortDescription');
			$metaTitle = $this->input->post('metaTitle');
			$metaDescription = $this->input->post('metaDescription');
			$metaKeywords = $this->input->post('metakeywords');
			$is_feautred = $this->input->post('is_filter');
			$on_slider = $this->input->post('slider');
			$on_banner = $this->input->post('banner');
			$minQty = $this->input->post('minQty');
			$productType = $this->input->post('productType');


			$mainImage =  $gallery = '';
			$galleryImages = $error = array();

			if(empty($is_feautred)){
				$is_feautred = '0';
			}

			if(empty($on_slider)){
				$on_slider = '0';
			}

			if(empty($on_banner)){
				$on_banner = '0';
			}
			if($_FILES['categoryImage']['name']){
				$config['upload_path'] = './uploads/products/';
	            $config['allowed_types'] = 'jpg|png|jpeg|gif';
	            $config['overwrite'] = TRUE;
	            $config['max_size'] = '50000';	            
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
					        'new_image' => './uploads/products/thumbs/'. $uploadData['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$uploadData['file_ext'],
					        'maintain_ration' => FALSE,
					        'create_thumb'    => TRUE,
					        'quality' => "100%",
					        'width' => $resize[0],
					        'height' => $resize[1]
					    );
					    $this->image_lib->initialize($config);
					    $this->image_lib->resize();
					    $this->image_lib->clear();
					}
	            }
	            $data = array(
		        	'image_name' => $mainImage,
		        	'uploaded_on' => date('y-m-d'),
		        	'uploaded_by' => $this->session->admin_id,
		        );
		        $this->db->insert('whole_media',$data);
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


			        $config['upload_path'] = './uploads/products/';
		            $config['allowed_types'] = 'jpg|png|jpeg|gif';
		            $config['overwrite'] = TRUE;
		            $config['max_size'] = '50000';	            
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
						        'new_image' => './uploads/products/thumbs/'. $dataInfo['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$dataInfo['file_ext'],
						        'maintain_ration' => FALSE,
						        'create_thumb'    => TRUE,
						        'quality' => "100%",
						        'width' => $resize[0],
						        'height' => $resize[1]
						    );
						    $this->image_lib->initialize($config);
						    $this->image_lib->resize();
						    $this->image_lib->clear();
						}
			        }

			        $data = array(
			        	'image_name' => $dataInfo['file_name'],
			        	'uploaded_on' => date('y-m-d'),
			        	'uploaded_by' => $this->session->admin_id,
			        );
			        $this->db->insert('whole_media',$data);
			    }
			}

			if(!empty($galleryImages)){
				$gallery = implode(',', $galleryImages);
			}

			

			$data = array(
				'product_name' => $name,
				'product_category' => $Category,
				'product_artical' => $articalNum,
				'product_hsn' => $hsnCode,
				'product_image' => $mainImage,
				'product_gallery' => $gallery,
				'product_brand' => $brand,
				'product_price' => $price,
				'product_sale_price' => $salePrice,
				'product_stock' => $stock,
				'product_description' => $description,
				'product_short_description' => $shortDescription,
				'product_meta_title' => $metaTitle,
				'product_meta_keywords' => $metaKeywords,
				'meta_description' => $metaDescription,
				'product_min_qty' => $minQty,
				'is_featured' => $is_feautred,
				'on_slider' => $on_slider,
				'on_banner' => $on_banner,
				'product_type' => $productType,
				'product_created_on' => date('y-m-d'),
				'product_created_by' => $this->session->admin_id
			);

			$this->db->insert('whole_products',$data);

			$p_id =  $this->db->insert_id();



			$finalCategory = 0;

			$this->db->where('category_id',$Category);
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


			if(!empty($p_id)){
				$totalAtt = $this->input->post('totalAttributes');
				

				for($i = 1; $i <= $totalAtt; $i++){
					$slugArray = array();
					$this->db->where('assign_category',$finalCategory);
					$assigned = $this->db->get('whole_assigned_options');

					$attributes = $options = array();
					if($assigned->num_rows() > 0){

						foreach($assigned->result() as $assign){

							if(in_array($assign->assign_attribute, $attributes)){

							}else{
								$attributes[] = $assign->assign_attribute;
							}

							$options[] = $assign->assign_option;
						}

						if($this->input->post('attPrice_'.$i)){
							$attPrice = $this->input->post('attPrice_'.$i);
						}else{
							$attPrice = $price;
						}
						
						if($this->input->post('attSalePrice_'.$i)){
							$attSalePrice = $this->input->post('attSalePrice_'.$i);
						}else{
							$attSalePrice = $salePrice;
						}

						if($this->input->post('attStock_'.$i)){
							$attStock = $this->input->post('attStock_'.$i);
						}else{
							$attStock = $stock;
						}

						if($this->input->post('attSku_'.$i)){
							$attSku = $this->input->post('attSku_'.$i);
						}else{
							$attSku = $skuCode;
						}

						$mainImage =  $gallery = '';
						$galleryImages = array();

						if($_FILES['categoryImage_'.$i]['name']){
							$config['upload_path'] = './uploads/products/';
				            $config['allowed_types'] = 'jpg|png|jpeg|gif';
				            $config['overwrite'] = TRUE;
				            $config['max_size'] = '50000';	            
				            $this->upload->initialize($config);

				            if($this->upload->do_upload('categoryImage_'.$i)){
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
								        'new_image' => './uploads/products/thumbs/'. $uploadData['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$uploadData['file_ext'],
								        'maintain_ration' => false,
								        'width' => $resize[0],
								        'height' => $resize[1]
								    );
								    $this->image_lib->initialize($config);
								    $this->image_lib->resize();
								    $this->image_lib->clear();
								}
				            }

				            $data = array(
					        	'image_name' => $mainImage,
					        	'uploaded_on' => date('y-m-d'),
					        	'uploaded_by' => $this->session->admin_id,
					        );
					        $this->db->insert('whole_media',$data);
						}


						if($_FILES['gallerImage_'.$i]['name']){

						    $files = $_FILES['gallerImage_'.$i];
						    $cpt = count($_FILES['gallerImage_'.$i]['name']);
						    for($j=0; $j<$cpt; $j++)
						    {           
						        $_FILES['gallerImage']['name']= $files['name'][$j];
						        $_FILES['gallerImage']['type']= $files['type'][$j];
						        $_FILES['gallerImage']['tmp_name']= $files['tmp_name'][$j];
						        $_FILES['gallerImage']['error']= $files['error'][$j];
						        $_FILES['gallerImage']['size']= $files['size'][$j];   


						        $config['upload_path'] = './uploads/products/';
					            $config['allowed_types'] = 'jpg|png|jpeg|gif';
					            $config['overwrite'] = TRUE;
					            $config['max_size'] = '50000';	            
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
									        'new_image' => './uploads/products/thumbs/'. $dataInfo['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$dataInfo['file_ext'],
									        'maintain_ration' => FALSE,
									        'create_thumb'    => TRUE,
									        'quality' => "100%",
									        'width' => $resize[0],
									        'height' => $resize[1]
									    );
									    $this->image_lib->initialize($config);
									    $this->image_lib->resize();
									    $this->image_lib->clear();
									}
						        }

						        $data = array(
						        	'image_name' => $dataInfo['file_name'],
						        	'uploaded_on' => date('y-m-d'),
						        	'uploaded_by' => $this->session->admin_id,
						        );
						        $this->db->insert('whole_media',$data);
						    }
						}

						if(!empty($galleryImages)){
							$gallery = implode(',', $galleryImages);
						}

						$data = array(
							'combination_product' => $p_id,
							'combination_price' => $attPrice,
							'combination_sale_price' => $attSalePrice,
							'combination_stock' => $attStock,
							'combination_skucode' => $attSku,
							'combination_image' => $mainImage,
							'combination_gallery' => $gallery,
						);

						$this->db->insert('whole_product_combinations',$data);

						$comboID = $this->db->insert_id();

						if(!empty($comboID)){
							foreach ($attributes as $value) {
								
								if($this->input->post('att_'.$value.'_'.$i)){

									$this->db->where('attribute_id',$value);
									$attribute = $this->db->get('whole_attributes')->row();

									$selected = $this->input->post('att_'.$value.'_'.$i);

									$data = array(
										'p_product_id' => $p_id,
										'p_attribute_name' => $attribute->attribute_name,
										'p_attribute_id' => $attribute->attribute_id,
										'p_attribute_value' => $selected,
										'p_attribute_combo' => $comboID
									);

									$this->db->where('option_id',$selected);
									$option = $this->db->get('whole_attribute_options')->row();

									$slugArray[] =  $option->option_name;

									if($this->db->insert('whole_product_options',$data)){
										$error[] = 'Error in Entering Product Attribute Details for SKU : '.$attSku;
									}
								}
							}
						}else{
							$error[] = 'Error in Creating Product Attribute Combinations for SKU : '.$attSku;
						}
					}



					$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($name));

					$slug = $slug.'-'.strtolower(implode('-', $slugArray));
					$slug = check_slug($slug,'whole_product_combinations','combination_slug','','');

					$this->db->where('combination_id',$comboID);
					$this->db->update('whole_product_combinations',['combination_slug' => $slug]);

				}
			}else{
				$error[] = 'Error in Adding Product.';
			}
				
			if(!empty($error)){
				$this->session->set_flashdata('error',$error);
				redirect('admin/products/add-product');
			}else{

				$this->session->set_flashdata('success','product has been insertd succefuly');

				redirect('admin/products/add-product');
			}	

		}

		public function get_all_products(){
			return $this->db->get('whole_products')->result();
		}

		public function get_all_combinations(){
			return $this->db->get('whole_product_combinations')->result();
		}

		public function get_all_options(){
			return $this->db->get('whole_product_options')->result();
		}

		public function product_listing(){

			
			$categories = $this->db->get('whole_category')->result();


			$draw = $_POST['draw'];
			$row = $_POST['start'];
			$rowperpage = $_POST['length']; // Rows display per page
			$searchValue = $_POST['search']['value'];
			
			$to = $_POST['to'];
			$from = $_POST['from'];
			$art_id = $_POST['art_id'];


			$searchQuery = " ";
			if(($to != '') && ($from !='')){
	   				$this->db->where('product_created_on >=', date('Y-m-d',strtotime($from)));
					$this->db->where('product_created_on <=', date('Y-m-d',strtotime($to)));
			}
			if($art_id != ''){
			   $this->db->where('product_artical', $art_id);
			}

			if($searchValue != ''){
			    $this->db->where("product_name like '%".$searchValue."%' or product_price like '%".$searchValue."%'");			
			}

			$this->db->select('*');
			$this->db->from('whole_product_combinations a');
			$this->db->join('whole_products b','a.combination_product = b.product_id','left');
			$totalRecordwithFilter = $totalRecords = $this->db->get()->num_rows();


			if(($to != '') && ($from !='')){
	   				$this->db->where('product_created_on >=', date('Y-m-d',strtotime($from)));
					$this->db->where('product_created_on <=', date('Y-m-d',strtotime($to)));
			}
			if($art_id != ''){
			   $this->db->where('product_artical', $art_id);
			}

			if($searchValue != ''){
			    $this->db->where("product_name like '%".$searchValue."%' or product_price like '%".$searchValue."%'");			
			}

			
			$this->db->select('*');
			$this->db->from('whole_product_combinations a');
			$this->db->join('whole_products b','a.combination_product = b.product_id','left');
			$this->db->order_by('combination_id');
			$this->db->limit($rowperpage,$row);
			$combinations = $this->db->get()->result_array();

			$data = array();
			if($combinations){ foreach($combinations as $combo){
                    $filename= pathinfo($combo['product_image'],PATHINFO_FILENAME);
                    $file_ext = pathinfo($combo['product_image'],PATHINFO_EXTENSION);
                    if($categories){
                    	foreach($categories as $cat){ 
                        	if($cat->category_id == $combo['product_category']){
                            	$category = $cat->category_name;
                        	}
                    	} 
                    }
                    if($combo['combination_status'] == '1'){

                        $status = '<span class="label label-success font-weight-100">Active</span>'; 
                    }else{
                        $status = '<span class="label label-danger font-weight-100">In-Active</span>'; 
                    }
                    $action = '<a href="'.base_url('admin/products/edit-product').'?productID='.$combo['combination_id'].'" class="text-inverse p-r-10" data-toggle="tooltip" title="" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
                    if($combo['combination_status'] == 1){
                        $action .= '<a href="javascript:void(0)" class="text-inverse p-r-10 disableProduct" data-toggle="tooltip" title="" data-original-title="Disable" data-id="'.$combo['combination_id'].'"  data-status="0"><i class="ti-trash"></i></a>';
                    }else{
                        $action .= '<a href="javascript:void(0)" class="text-inverse p-r-10 disableProduct" data-toggle="tooltip" title="" data-original-title="Disable" data-id="'.$combo['combination_id'].'"  data-status="1"><i class="ti-check-box"></i></a>';
                    }
		        	$img = '<img src="'.base_url().'uploads/products/thumbs/'.$filename.'-50x50.'.$file_ext.'">';
				   	$data[] = array( 
				   	  "checkboxes" => '<div class="custom-control custom-checkbox">
		                                    <input type="checkbox" class="custom-control-input checkbox" id="customControlValidation'.$combo['combination_id'].'" value="'.$combo['combination_id'].'" name="comboIDs[]">
		                                    <label class="custom-control-label" for="customControlValidation'.$combo['combination_id'].'"></label>
		                                </div>',
				   	  "product_image" => $img,
				      "product_sku"=>$combo['combination_skucode'],
				      "product_name"=>$combo['product_name'],
				      "category"=>$category,
				      "mrp"=>$combo['combination_price'],
				      "sale_price"=>$combo['combination_sale_price'],
				      "stock"=>$combo['combination_stock'],
				      "status"=>$status,
				      "actions"=>$action,
				   	);
		        
			} }

			$response = array(
			  "draw" => intval($draw),
			  "iTotalRecords" => $totalRecordwithFilter,
			  "iTotalDisplayRecords" => $totalRecords,
			  "aaData" => $data
			);

			echo json_encode($response);

		}

		public function product_stock(){

			$categories = $this->db->get('whole_category')->result();


			$draw = $_POST['draw'];
			$row = $_POST['start'];
			$rowperpage = $_POST['length']; // Rows display per page
			$searchValue = $_POST['search']['value'];
			
			$to = $_POST['to'];
			$from = $_POST['from'];
			$art_id = $_POST['art_id'];

			if(($to != '') && ($from !='')){
	   				$this->db->where('product_created_on >=', date('Y-m-d',strtotime($from)));
					$this->db->where('product_created_on <=', date('Y-m-d',strtotime($to)));
			}
			if($art_id != ''){
			   $this->db->where('product_artical >=', $art_id);
			}

			if($searchValue != ''){
			    $this->db->where("product_name like '%".$searchValue."%' or product_price like '%".$searchValue."%'");			
			}

			$this->db->select('*');
			$this->db->from('whole_product_combinations a');
			$this->db->join('whole_products b','a.combination_product = b.product_id','left');
			$totalRecordwithFilter = $totalRecords = $this->db->get()->num_rows();


			if(($to != '') && ($from !='')){
	   				$this->db->where('product_created_on >=', date('Y-m-d',strtotime($from)));
					$this->db->where('product_created_on <=', date('Y-m-d',strtotime($to)));
			}
			if($art_id != ''){
			   $this->db->where('product_artical >=', $art_id);
			}

			if($searchValue != ''){
			    $this->db->where("product_name like '%".$searchValue."%' or product_price like '%".$searchValue."%'");			
			}
			
			$this->db->select('*');
			$this->db->from('whole_product_combinations a');
			$this->db->join('whole_products b','a.combination_product = b.product_id','left');
			$this->db->limit($rowperpage,$row);
			$combinations = $this->db->get()->result_array();

			$data = array();
			if($combinations){ foreach($combinations as $combo){
                    $filename= pathinfo($combo['product_image'],PATHINFO_FILENAME);
                    $file_ext = pathinfo($combo['product_image'],PATHINFO_EXTENSION);
                    if($categories){
                    	foreach($categories as $cat){ 
                        	if($cat->category_id == $combo['product_category']){
                            	$category = $cat->category_name;
                        	}
                    	} 
                    }

                    $action = '<a href="javascript:void(0);" class="text-inverse p-r-10 update_stock" data-toggle="tooltip" title="" data-original-title="Update" data-id="'.$combo['combination_id'].'"><i class="ti-export"></i></a>';

		        	$img = '<img src="'.base_url().'uploads/products/thumbs/'.$filename.'-50x50.'.$file_ext.'">';
				   	$data[] = array( 
				   	  "product_image" => $img,
				      "product_sku"=>$combo['combination_skucode'],
				      "product_name"=>$combo['product_name'],
				      "category"=>$category,
				      "stock"=>'<input type="text" name="qty_'.$combo['combination_id'].'" value="'.$combo['combination_stock'].'">',
				      "actions"=>$action,
				   	);
		        
			} }

			$response = array(
			  "draw" => intval($draw),
			  "iTotalRecords" => $totalRecordwithFilter,
			  "iTotalDisplayRecords" => $totalRecords,
			  "aaData" => $data
			);

			echo json_encode($response);

		}

		public function get_product_sale_exceptions(){

			$categories = $this->db->get('whole_category')->result();


			$draw = $_POST['draw'];
			$row = $_POST['start'];
			$rowperpage = $_POST['length']; // Rows display per page
			$searchValue = $_POST['search']['value'];


			$searchQuery = " ";
			
			if($searchValue != ''){
			    $this->db->where("product_name like '%".$searchValue."%' or product_price like '%".$searchValue."%'");			
			}

			$this->db->select('*');
			$this->db->from('whole_product_combinations a');
			$this->db->join('whole_products b','a.combination_product = b.product_id','left');
			$totalRecordwithFilter = $totalRecords = $this->db->get()->num_rows();

			$this->db->select('*');
			$this->db->from('whole_product_combinations a');
			$this->db->join('whole_products b','a.combination_product = b.product_id','left');
			$this->db->limit($rowperpage,$row);
			$combinations = $this->db->get()->result_array();

			$data = array();
			if($combinations){ foreach($combinations as $combo){
                    $filename= pathinfo($combo['product_image'],PATHINFO_FILENAME);
                    $file_ext = pathinfo($combo['product_image'],PATHINFO_EXTENSION);
                    if($categories){
                    	foreach($categories as $cat){ 
                        	if($cat->category_id == $combo['product_category']){
                            	$category = $cat->category_name;
                        	}
                    	} 
                    }

		        	$img = '<img src="'.base_url().'uploads/products/thumbs/'.$filename.'-50x50.'.$file_ext.'">';
				   	$data[] = array( 
				   		"checkboxes" => '<div class="custom-control custom-checkbox">
		                                    <input type="checkbox" class="custom-control-input checkbox" id="customControlValidation'.$combo['combination_id'].'" value="'.$combo['combination_id'].'" name="options[]">
		                                    <label class="custom-control-label" for="customControlValidation'.$combo['combination_id'].'"></label>
		                                </div>',
				   	  	"product_image" => $img,
				      	"product_name"=>$combo['product_name'],
				      	"category"=>$category,
				   	);
		        
			} }

			$response = array(
			  "draw" => intval($draw),
			  "iTotalRecords" => $totalRecordwithFilter,
			  "iTotalDisplayRecords" => $totalRecords,
			  "aaData" => $data
			);

			echo json_encode($response);
		}

		public function update_status(){

			$this->db->where('combination_id',$this->input->post('id'));
			$query = $this->db->update('whole_product_combinations',['combination_status' => $this->input->post('status')]);

			if($query){
				echo json_encode(['msg' => 'updated']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}
		}

		public function update_stock(){

			$this->db->where('combination_id',$this->input->post('id'));
			$query = $this->db->update('whole_product_combinations',['combination_stock' => $this->input->post('stock')]);

			if($query){
				echo json_encode(['msg' => 'updated']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}
		}

		public function get_product($id){

			$this->db->select('*');
			$this->db->from('whole_product_combinations a');
			$this->db->join('whole_products b','b.product_id = a.combination_product','left');
			$this->db->where('combination_id',$id);

			return $this->db->get()->row();
		}

		public function get_options($id){
			
			$this->db->select('*');
			$this->db->from('whole_product_combinations a');
			$this->db->join('whole_products b','b.product_id = a.combination_id','left');
			$this->db->join('whole_product_options c','c.p_product_id = b.product_id AND c.p_attribute_combo = a.combination_id','left');
			$this->db->where('combination_id',$id);
			return $this->db->get()->result();
		}

		public function update_product(){

			$p_id = $this->input->post('productID');
			$name = $this->input->post('productName');

			// Change Category Selection Here For Customization according to client

			$parentCategory = $this->input->post('parentCategory');
			$mainCategory = $this->input->post('mainCategory');
			$subCategory = $this->input->post('subCategory');
			$innerCategory = $this->input->post('innerCategory');

			if(!empty($innerCategory)){

				$Category = $innerCategory;

			}elseif(!empty($subCategory)){

				$Category = $subCategory;

			}elseif(!empty($mainCategory)){

				$Category = $mainCategory;
				
			}elseif(!empty($parentCategory)){

				$Category = $parentCategory;
				
			}

			// ----------------------------------------------------

			$articalNum = $this->input->post('articalNum');
			$skuCode = $this->input->post('skuCode');
			$hsnCode = $this->input->post('hsnCode');
			$brand = $this->input->post('brand');
			$price = $this->input->post('price');
			$salePrice = $this->input->post('salePrice');
			$stock = $this->input->post('stock');
			$description = $this->input->post('description');
			$shortDescription = $this->input->post('shortDescription');
			$metaTitle = $this->input->post('metaTitle');
			$metaDescription = $this->input->post('metaDescription');
			$metaKeywords = $this->input->post('metakeywords');
			$is_feautred = $this->input->post('is_filter');
			$on_slider = $this->input->post('slider');
			$on_banner = $this->input->post('banner');
			$minQty = $this->input->post('minQty');
			$productType = $this->input->post('productType');

			$this->db->where('product_id',$p_id);
			$product = $this->db->get('whole_products')->row();
			$galleryImages = $error = array();
			if($_FILES['categoryImage']['name']){
				$config['upload_path'] = './uploads/products/';
	            $config['allowed_types'] = 'jpg|png|jpeg|gif';
	            $config['overwrite'] = TRUE;
	            $config['max_size'] = '50000';	            
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
					        'new_image' => './uploads/products/thumbs/'. $uploadData['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$uploadData['file_ext'],
					        'maintain_ration' => false,
					        'width' => $resize[0],
					        'height' => $resize[1]
					    );
					    $this->image_lib->initialize($config);
					    $this->image_lib->resize();
					    $this->image_lib->clear();
					}
	            }

	            $data = array(
		        	'image_name' => $mainImage,
		        	'uploaded_on' => date('y-m-d'),
		        	'uploaded_by' => $this->session->admin_id,
		        );
		        $this->db->insert('whole_media',$data);

			}else{
				$mainImage = $product->product_image;
			}
			if(!empty($_FILES['gallerImage']['name'][0])){

				
			    $files = $_FILES;
			    $cpt = count($_FILES['gallerImage']['name']);
			    for($i=0; $i<$cpt; $i++)
			    {           
			        $_FILES['gallerImage']['name']= $files['gallerImage']['name'][$i];
			        $_FILES['gallerImage']['type']= $files['gallerImage']['type'][$i];
			        $_FILES['gallerImage']['tmp_name']= $files['gallerImage']['tmp_name'][$i];
			        $_FILES['gallerImage']['error']= $files['gallerImage']['error'][$i];
			        $_FILES['gallerImage']['size']= $files['gallerImage']['size'][$i];   


			        $config['upload_path'] = './uploads/products/';
		            $config['allowed_types'] = 'jpg|png|jpeg|gif';
		            $config['overwrite'] = TRUE;
		            $config['max_size'] = '50000';	            
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
						        'new_image' => './uploads/products/thumbs/'. $dataInfo['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$dataInfo['file_ext'],
						        'maintain_ration' => FALSE,
					        	'create_thumb'    => TRUE,
					        	'quality' => "100%",
						        'width' => $resize[0],
						        'height' => $resize[1]
						    );
						    $this->image_lib->initialize($config);
						    $this->image_lib->resize();
						    $this->image_lib->clear();
						}
			        }

			        $data = array(
			        	'image_name' => $dataInfo['file_name'],
			        	'uploaded_on' => date('y-m-d'),
			        	'uploaded_by' => $this->session->admin_id,
			        );
			        $this->db->insert('whole_media',$data);
			    }

			    if(!empty($galleryImages)){
					$gallery = implode(',', $galleryImages);
				}
			}else{
				$gallery = $product->product_gallery;
			}

			if(empty($is_feautred)){
				$is_feautred = '0';
			}

			if(empty($on_slider)){
				$on_slider = '0';
			}

			if(empty($on_banner)){
				$on_banner = '0';
			}

			$data = array(
				'product_name' => $name,
				'product_category' => $Category,
				'product_artical' => $articalNum,
				'product_hsn' => $hsnCode,
				'product_image' => $mainImage,
				'product_gallery' => $gallery,
				'product_brand' => $brand,
				'product_price' => $price,
				'product_sale_price' => $salePrice,
				'product_stock' => $stock,
				'product_description' => $description,
				'product_short_description' => $shortDescription,
				'product_meta_title' => $metaTitle,
				'product_meta_keywords' => $metaKeywords,
				'meta_description' => $metaDescription,
				'product_min_qty' => $minQty,
				'is_featured' => $is_feautred,
				'on_slider' => $on_slider,
				'on_banner' => $on_banner,
				'product_type' => $productType,
				'product_modified_on' => date('y-m-d'),
				'product_modified_by' => $this->session->admin_id
			);

			$this->db->where('product_id',$p_id);
			$this->db->update('whole_products',$data);

			$finalCategory = 0;

			$this->db->where('category_id',$Category);
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

			if(!empty($p_id)){
				$totalAtt = $this->input->post('totalAttributes');

				
				for($i = 1; $i <= $totalAtt; $i++){
					$slugArray = array();
					$this->db->where('assign_category',$finalCategory);
					$assigned = $this->db->get('whole_assigned_options');

					$attributes = $options = array();
					if($assigned->num_rows() > 0){

						foreach($assigned->result() as $assign){

							if(in_array($assign->assign_attribute, $attributes)){

							}else{
								$attributes[] = $assign->assign_attribute;
							}

							$options[] = $assign->assign_option;
						}

						if($this->input->post('attPrice_'.$i)){
							$attPrice = $this->input->post('attPrice_'.$i);
						}else{
							$attPrice = $price;
						}
						
						if($this->input->post('attSalePrice_'.$i)){
							$attSalePrice = $this->input->post('attSalePrice_'.$i);
						}else{
							$attSalePrice = $salePrice;
						}

						if($this->input->post('attStock_'.$i)){
							$attStock = $this->input->post('attStock_'.$i);
						}else{
							$attStock = $stock;
						}

						if($this->input->post('attSku_'.$i)){
							$attSku = $this->input->post('attSku_'.$i);
						}else{
							$attSku = $skuCode;
						}

						

						$mainImage =  $gallery = '';
						$galleryImages = array();

						if($_FILES['categoryImage_'.$i]['name']){

							$config['upload_path'] = './uploads/products/';
				            $config['allowed_types'] = 'jpg|png|jpeg|gif';
				            $config['overwrite'] = TRUE;
				            $config['max_size'] = '50000';	            
				            $this->upload->initialize($config);

				            if($this->upload->do_upload('categoryImage_'.$i)){
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
								        'new_image' => './uploads/products/thumbs/'. $uploadData['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$uploadData['file_ext'],
								        'maintain_ration' => false,
								        'width' => $resize[0],
								        'height' => $resize[1]
								    );
								    $this->image_lib->initialize($config);
								    $this->image_lib->resize();
								    $this->image_lib->clear();
								}
				            }

				            $data = array(
					        	'image_name' => $mainImage,
					        	'uploaded_on' => date('y-m-d'),
					        	'uploaded_by' => $this->session->admin_id,
					        );

					        $this->db->insert('whole_media',$data);
						}

						

						if($_FILES['gallerImage_'.$i]['name']){

							

						    $files = $_FILES['gallerImage_'.$i];
						    $cpt = count($_FILES['gallerImage_'.$i]['name']);

						    

						    for($j=0; $j<$cpt; $j++)
						    {           
						        $_FILES['gallerImage']['name']= $files['name'][$j];
						        $_FILES['gallerImage']['type']= $files['type'][$j];
						        $_FILES['gallerImage']['tmp_name']= $files['tmp_name'][$j];
						        $_FILES['gallerImage']['error']= $files['error'][$j];
						        $_FILES['gallerImage']['size']= $files['size'][$j];   
								if($_FILES['gallerImage']['name']){

							        $config['upload_path'] = './uploads/products/';
						            $config['allowed_types'] = 'jpg|png|jpeg|gif';
						            $config['overwrite'] = TRUE;
						            $config['max_size'] = '50000';	            
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
										        'new_image' => './uploads/products/thumbs/'. $dataInfo['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$dataInfo['file_ext'],
										        'maintain_ration' => FALSE,
										        'create_thumb'    => TRUE,
										        'quality' => "100%",
										        'width' => $resize[0],
										        'height' => $resize[1]
										    );
										    $this->image_lib->initialize($config);
										    $this->image_lib->resize();
										    $this->image_lib->clear();
										}
							        }

							        $data = array(
							        	'image_name' => $dataInfo['file_name'],
							        	'uploaded_on' => date('y-m-d'),
							        	'uploaded_by' => $this->session->admin_id,
							        );

							        $this->db->insert('whole_media',$data);
							    }
						    }
						}

						if(!empty($galleryImages)){
							$gallery = implode(',', $galleryImages);
						}

						$this->db->where('combination_product',$p_id);
						$this->db->where('combination_skucode',$attSku);
						$alreadyCombo = $this->db->get('whole_product_combinations');

						if($alreadyCombo->num_rows() > 0){

							$combo = $alreadyCombo->row();

							if(empty($mainImage)){
								$mainImage = $combo->combination_image;
							}

							if(empty($gallery)){
								
								$gallery = $combo->combination_gallery;
							}

							$data = array(
								'combination_product' => $p_id,
								'combination_price' => $attPrice,
								'combination_sale_price' => $attSalePrice,
								'combination_stock' => $attStock,
								'combination_skucode' => $attSku,
								'combination_image' => $mainImage,
								'combination_gallery' => $gallery,
							);

							$this->db->where('combination_id',$combo->combination_id);
							$this->db->update('whole_product_combinations',$data);

							$comboID = $combo->combination_id;
						}else{
							$data = array(
								'combination_product' => $p_id,
								'combination_price' => $attPrice,
								'combination_sale_price' => $attSalePrice,
								'combination_stock' => $attStock,
								'combination_skucode' => $attSku,
								'combination_image' => $mainImage,
								'combination_gallery' => $gallery,
							);

							$this->db->insert('whole_product_combinations',$data);

							$comboID = $this->db->insert_id();
						}
							

						if(!empty($comboID)){
							foreach ($attributes as $value) {
								
								if($this->input->post('att_'.$value.'_'.$i)){

									$this->db->where('attribute_id',$value);
									$attribute = $this->db->get('whole_attributes')->row();

									$selected = $this->input->post('att_'.$value.'_'.$i);

									$this->db->where('p_product_id',$p_id);
									$this->db->where('p_attribute_id',$attribute->attribute_id);
									$this->db->where('p_attribute_combo',$comboID);
									$alreadyOptions = $this->db->get('whole_product_options');

									if($alreadyOptions->num_rows() > 0){

										$data = array(
											'p_product_id' => $p_id,
											'p_attribute_name' => $attribute->attribute_name,
											'p_attribute_id' => $attribute->attribute_id,
											'p_attribute_value' => $selected,
											'p_attribute_combo' => $comboID
										);

										$this->db->where('option_id',$selected);
										$option = $this->db->get('whole_attribute_options')->row();

										$slugArray[] =  $option->option_name;

										$this->db->where('p_product_id',$p_id);
										$this->db->where('p_attribute_id',$attribute->attribute_id);
										$this->db->where('p_attribute_combo',$comboID);
										$query = $this->db->update('whole_product_options',$data);
										if(!$query){
											$error[] = 'Error in Entering Product Attribute Details for SKU : '.$attSku;
										}

									}else{

										$data = array(
											'p_product_id' => $p_id,
											'p_attribute_name' => $attribute->attribute_name,
											'p_attribute_id' => $attribute->attribute_id,
											'p_attribute_value' => $selected,
											'p_attribute_combo' => $comboID
										);
										$query = $this->db->insert('whole_product_options',$data);

										$this->db->where('option_id',$selected);
										$option = $this->db->get('whole_attribute_options')->row();

										$slugArray[] =  $option->option_name;

										if(!$query){
											$error[] = 'Error in Entering Product Attribute Details for SKU : '.$attSku;
										}
									}

										
								}
							}
						}else{
							$error[] = 'Error in Creating Product Attribute Combinations for SKU : '.$attSku;
						}
					}

					$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($name));

					$slug = $slug.'-'.strtolower(implode('-', $slugArray));
					$slug = check_slug($slug,'whole_product_combinations','combination_slug','combination_id',$comboID);

					if($slug == true){

					}else{
						$this->db->where('combination_id',$comboID);
						$this->db->update('whole_product_combinations',['combination_slug' => $slug]);
					}
						
				}


			}else{
				$error[] = 'Error in Adding Product.';
			}
				
			if(!empty($error)){
				$this->session->set_flashdata('error',$error);
				redirect('admin/products/products-listing');
			}else{

				$this->session->set_flashdata('success','product has been Updated succefuly');

				redirect('admin/products/products-listing');
			}	

		}


		public function import_products(){

			$parentCategory = $this->input->post('parentCategory');
			$mainCategory = $this->input->post('mainCategory');
			$subCategory = $this->input->post('subCategory');
			$innerCategory = $this->input->post('innerCategory');


			if(!empty($innerCategory)){
				$Category = $innerCategory;
			}elseif(!empty($subCategory)){
				$Category = $subCategory;
			}elseif(!empty($mainCategory)){
				$Category = $mainCategory;	
			}elseif(!empty($parentCategory)){
				$Category = $parentCategory;
			}

			$finalCategory = 0;

			$this->db->where('category_id',$Category);
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

			$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');


			if(!empty($_FILES['importFile']['name']) && in_array($_FILES['importFile']['type'], $csvMimes)){
		    	if(is_uploaded_file($_FILES['importFile']['tmp_name'])){
		        	$csvFile = fopen($_FILES['importFile']['tmp_name'], 'r');
		        	fgetcsv($csvFile);
		        	while(($line = fgetcsv($csvFile)) !== FALSE){
		        		$finalGallery  = array();
		        		$name = $line[0];
		        		$category = $line[1];
		        		$artical = $line[2];
		        		$hsn = $line[3];
		        		$sku = $line[4];
		        		$price = $line[5];
		        		$salePrice = $line[6];
		        		$stock = $line[7];
		        		$brand = $line[8];
		        		$image = $line[9];
		        		$gallery = $line[10];
		        		$desc = $line[11];
		        		$short = $line[12];
		        		$is_feautred = $line[count($line)-7];
		        		$on_slider = $line[count($line)-6];
		        		$on_banner = $line[count($line)-5];
		        		$product_type = $line[count($line) - 4];
		        		$metaTitle = $line[count($line)-3];
						$metaKeywords =$line[count($line)-2];
						$metaDescription = end($line);



						if(!empty($gallery)){

							foreach (explode(',', $gallery) as $value) {
								$full_path = './uploads/products/'.$value;

								if(!file_exists($full_path)){
									$error[] = 'The Gallery Image '.$value.' For Product '.$name.' is not Uploaded on Server';
								}else{

									$finalGallery[] = $value;
								}
							}
						}

						if(!empty($finalGallery))
							$gallery = implode(',', $finalGallery);


						if(!empty($image)){

							$full_path = './uploads/products/'.$image;

							if(file_exists($full_path)){


								$this->db->where('category_name',strtoupper($category));
								$cat = $this->db->get('whole_category');

								if($cat->num_rows() > 0){

									$catg = $cat->row();

									$this->db->where('brand_name',strtoupper($brand));
									$brnd = $this->db->get('whole_brands');


									if($brnd->num_rows() > 0){

										$brnd = $brnd->row();

										$this->db->where('product_name',$name);
										$this->db->where('product_category',$Category);
										$products = $this->db->get('whole_products');

										if($products->num_rows() > 0){

											$product = $products->row();

											$data = array(
												'product_name' => $name,
												'product_category' => $catg->category_id,
												'product_artical' => $artical,
												'product_hsn' => $hsn,
												'product_image' => $image,
												'product_gallery' => $gallery,
												'product_brand' => $brnd->brand_id,
												'product_price' => $price,
												'product_sale_price' => $salePrice,
												'product_stock' => $stock,
												'product_description' => $desc,
												'product_short_description' => $short,
												'product_meta_title' => $metaTitle,
												'product_meta_keywords' => $metaKeywords,
												'meta_description' => $metaDescription,
												'is_featured' => $is_feautred,
												'on_slider' => $on_slider,
												'on_banner' => $on_banner,
												'product_type' => $product_type,
												'product_modified_on' => date('y-m-d'),
												'product_modified_by' => $this->session->admin_id
											);
											$this->db->where('product_id',$product->product_id);
											$this->db->update('whole_products',$data);
											$p_id = $product->product_id;

										}else{

											$data = array(
												'product_name' => $name,
												'product_category' => $catg->category_id,
												'product_artical' => $artical,
												'product_hsn' => $hsn,
												'product_image' => $image,
												'product_gallery' => $gallery,
												'product_brand' => $brnd->brand_id,
												'product_price' => $price,
												'product_sale_price' => $salePrice,
												'product_stock' => $stock,
												'product_description' => $desc,
												'product_short_description' => $short,
												'product_meta_title' => $metaTitle,
												'product_meta_keywords' => $metaKeywords,
												'meta_description' => $metaDescription,
												'is_featured' => $is_feautred,
												'on_slider' => $on_slider,
												'on_banner' => $on_banner,
												'product_type' => $product_type,
												'product_created_on' => date('y-m-d'),
												'product_created_by' => $this->session->admin_id
											);

											$this->db->insert('whole_products',$data);
											$p_id = $this->db->insert_id();
										}
										if(!empty($p_id)){
											$this->db->where('assign_category',$finalCategory);
											$assigned = $this->db->get('whole_assigned_options');
											$attributes = $options = $midHead = array();
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
													$midHead[] = $attribute->attribute_name;
												}
											}
											$totalAtt = count($midHead);

											for($i = 0; $i < $totalAtt; $i++){

												$slugArray = array();
												$this->db->where('assign_category',$finalCategory);
												$assigned = $this->db->get('whole_assigned_options');

												$attributes = $options = array();
												if($assigned->num_rows() > 0){

													foreach($assigned->result() as $assign){

														if(in_array($assign->assign_attribute, $attributes)){

														}else{
															$attributes[] = $assign->assign_attribute;
														}

														$options[] = $assign->assign_option;
													}

													$this->db->where('combination_product',$p_id);
													$this->db->where('combination_skucode',$sku);
													$alreadyCombo = $this->db->get('whole_product_combinations');

													if($alreadyCombo->num_rows() > 0){

														$combo = $alreadyCombo->row();
														$data = array(
															'combination_product' => $p_id,
															'combination_price' => $price,
															'combination_sale_price' => $salePrice,
															'combination_stock' => $stock,
															'combination_skucode' => $sku,

														);
														$this->db->where('combination_id',$combo->combination_id);
														$this->db->update('whole_product_combinations',$data);
														$comboID = $combo->combination_id;
													}else{
														$data = array(
															'combination_product' => $p_id,
															'combination_price' => $price,
															'combination_sale_price' => $salePrice,
															'combination_stock' => $stock,
															'combination_skucode' => $sku,
														);
														$this->db->insert('whole_product_combinations',$data);
														$comboID = $this->db->insert_id();
													}
													if(!empty($comboID)){
														$j = 13;
														foreach ($attributes as $value) {
										
															if($midHead[$i]){

																$this->db->where('attribute_id',$value);
																$attribute = $this->db->get('whole_attributes')->row();

																
																$this->db->where('option_name',strtoupper($line[$j]));
																$optionsName = $this->db->get('whole_attribute_options');

																if($optionsName->num_rows() > 0){

																	$selected = $optionsName->row();

																	$this->db->where('p_product_id',$p_id);
																	$this->db->where('p_attribute_id',$attribute->attribute_id);
																	$this->db->where('p_attribute_combo',$comboID);
																	$alreadyOptions = $this->db->get('whole_product_options');

																	if($alreadyOptions->num_rows() > 0){

																		$data = array(
																			'p_product_id' => $p_id,
																			'p_attribute_name' => $attribute->attribute_name,
																			'p_attribute_id' => $attribute->attribute_id,
																			'p_attribute_value' => $selected->option_id,
																			'p_attribute_combo' => $comboID
																		);

																		$this->db->where('option_id',$selected->option_id);
																		$option = $this->db->get('whole_attribute_options')->row();

																		$slugArray[] =  $option->option_name;

																		$this->db->where('p_product_id',$p_id);
																		$this->db->where('p_attribute_id',$attribute->attribute_id);
																		$this->db->where('p_attribute_combo',$comboID);
																		$query = $this->db->update('whole_product_options',$data);
																		if(!$query){
																			$error[] = 'Error in Entering Product Attribute Details for SKU : '.$sku;
																		}

																	}else{

																		$data = array(
																			'p_product_id' => $p_id,
																			'p_attribute_name' => $attribute->attribute_name,
																			'p_attribute_id' => $attribute->attribute_id,
																			'p_attribute_value' => $selected->option_id,
																			'p_attribute_combo' => $comboID
																		);
																		$query = $this->db->insert('whole_product_options',$data);

																		$this->db->where('option_id',$selected->option_id);
																		$option = $this->db->get('whole_attribute_options')->row();

																		$slugArray[] =  $option->option_name;


																		if(!$query){
																			$error[] = 'Error in Entering Product Attribute Details for SKU : '.$sku;
																		}
																	}
																}else{

																	$error[] = 'Error in Creating Product Attribute Combinations for SKU : '.$sku.'. The Value '.$line[$j].' For Attribute '.$attribute->attribute_name.' is not Available';
																}
	
															}
															$j++;
														}
													}else{
														$error[] = 'Error in Creating Product Attribute Combinations for SKU : '.$attSku;
													}
												}

												$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($name));
												$slug = $slug.'-'.strtolower(implode('-', $slugArray));
												$slug = check_slug($slug,'whole_product_combinations','combination_slug','combination_id',$comboID);
												$this->db->where('combination_id',$comboID);
												$this->db->update('whole_product_combinations',['combination_slug' => $slug]);
											}
										}else{
											$error[] = 'Error in Adding Product.';
										}
									}else{
										$error[] = 'The Brand '.$brand.' For Product '.$name.' is not created';
									}
								}else{
									$error[] = 'The Category '.$category.' For Product '.$name.' is not created';
								}

							}else{

								$error[] = 'The Main Image '.$image.' For Product '.$name.' is not Uploaded on Server';
							}
						}
							

		        	}
		        	
		        	fclose($csvFile);
		        	if(!empty($error)){
		        		$this->session->set_flashdata('error',$error);
		        		redirect('admin/products/import-export-products');
		        	}else{
		        		$this->session->set_flashdata('success','All products has been Imported succefuly');
						redirect('admin/products/import-export-products');
		        	}
		    	}else{
		    		$error[] = 'File Could not be uploaded for some technical issue! please try after some time';
					$this->session->set_flashdata('error',$error);
		        	redirect('admin/products/import-export-products');
		    	}
			}else{

				$error[] = 'Ivalid File Type! Please Upload a CSV File Only';
				$this->session->set_flashdata('error',$error);
		        redirect('admin/products/import-export-products');
			}

			echo json_encode($output);
			exit;

		}

		public function export_products(){


			$parentCategory = $this->input->post('parentCategory');
			$mainCategory = $this->input->post('mainCategory');
			$subCategory = $this->input->post('subCategory');
			$innerCategory = $this->input->post('innerCategory');

			if(!empty($innerCategory)){
				$Category = $innerCategory;
			}elseif(!empty($subCategory)){
				$Category = $subCategory;
			}elseif(!empty($mainCategory)){
				$Category = $mainCategory;	
			}elseif(!empty($parentCategory)){
				$Category = $parentCategory;
			}

			$finalCategory = 0;

			$this->db->where('category_id',$Category);
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



			$this->db->select('*');
			$this->db->from('whole_product_combinations a');
			$this->db->join('whole_products b','b.product_id = a.combination_product','left');
			$this->db->where('product_category',$Category);
			$products = $this->db->get()->result();

			$preHead = array("Product Name", "Category", "Artical Number", "HSN Code","SKU Code","Price","Sale Price","Stock", "Brand", "Image", "Gallery","Description", "Short Description");

			$midHead = array();

			$this->db->where('assign_category',$finalCategory);
			$assigned = $this->db->get('whole_assigned_options');
			$attributes = $options = array();
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
					$midHead[] = $attribute->attribute_name;
				}
			}

			$arrayone = array_merge($preHead, $midHead);

			$lastHead = array("is Fetaured","On Slider", "on Banner" , "Product Type" ,"Meta Title" ,"Meta Keywords","Meta Description");
			$array[] = array_merge($arrayone,$lastHead);

			$this->db->where('category_id',$Category);
            $categories = $this->db->get('whole_category')->row();
			foreach($products as $product){

				$this->db->where('brand_id',$product->product_brand);
				$brands = $this->db->get('whole_brands')->row();


				$preData = array(
					$product->product_name,
					$categories->category_name,
					$product->product_artical,
					$product->product_hsn,
					$product->combination_skucode,
					$product->combination_price,
					$product->combination_sale_price,
					$product->combination_stock,
					$brands->brand_name,
					$product->product_image,
					$product->product_gallery,
					$product->product_description,
					$product->product_short_description,
				);

				$optionName = '';
                $midData  = array();
                $this->db->where('p_attribute_combo',$product->combination_id);
                $options = $this->db->get('whole_product_options')->result();
                if($options){
                	foreach ($options as $value) {

                		$this->db->where('attribute_id',$value->p_attribute_id);
                        $attribute = $this->db->get('whole_attributes')->row();

                        $this->db->where('option_id',$value->p_attribute_value);
                        $this->db->where('option_attribute',$value->p_attribute_id);
                        $option = $this->db->get('whole_attribute_options')->row();

                        $midData[] = $option->option_name;
                	}
                }

                $lastData = array(
                	$product->is_featured,
					$product->on_slider,
					$product->on_banner,
					$product->product_type,
                	$product->product_meta_title,
					$product->product_meta_keywords,
					$product->meta_description,
                );
				
                $arrayone = array_merge($preData, $midData);
				$finalLine = array_merge($arrayone,$lastData);

				$array[] = $finalLine;
			}


			$this->db->where('category_id',$Category);
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
						$category_name = $category4->category_name.'-'.$category3->category_name.'-'.$category2->category_name.'-'.$category1->category_name;
					}else{
						$category_name = $category3->category_name.'-'.$category2->category_name.'-'.$category1->category_name;
					}
				}else{
					$category_name = $category2->category_name.'-'.$category1->category_name;
				}
			}else{
				$category_name = $category1->category_name;
			}

			$filename = 'Products_'.$category_name.'-'.time().'.csv'; 
			header("Content-Description: File Transfer"); 
			header("Content-Disposition: attachment; filename=$filename"); 
			header("Content-Type: application/csv; ");
		    header("Expires: 0");

		    $handle = fopen('php://output', 'w');
		    foreach ($array as $array) {
		        fputcsv($handle, $array);
		    }
		    fclose($handle);
		    exit; 

		}


		public function upload_media(){

			

			if(!empty($_FILES['gallerImage']['name'][0])){

				

				
			    $files = $_FILES;
			    $cpt = count($_FILES['gallerImage']['name']);
			    for($i=0; $i<$cpt; $i++)
			    {           
			        $_FILES['gallerImage']['name']= $files['gallerImage']['name'][$i];
			        $_FILES['gallerImage']['type']= $files['gallerImage']['type'][$i];
			        $_FILES['gallerImage']['tmp_name']= $files['gallerImage']['tmp_name'][$i];
			        $_FILES['gallerImage']['error']= $files['gallerImage']['error'][$i];
			        $_FILES['gallerImage']['size']= $files['gallerImage']['size'][$i];   


			        $config['upload_path'] = './uploads/products/';
		            $config['allowed_types'] = 'jpg|png|jpeg|gif';
		            $config['max_size'] = '50000';	            
		            $this->upload->initialize($config);

			        if($this->upload->do_upload('gallerImage')){
			        	$dataInfo = $this->upload->data();

			        	$galleryImages = $dataInfo['file_name'];

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
						        'new_image' => './uploads/products/thumbs/'. $dataInfo['raw_name'] . '-' . $resize[0] . 'x' . $resize[1].$dataInfo['file_ext'],
						        'maintain_ration' => false,
						        'width' => $resize[0],
						        'height' => $resize[1]
						    );
						    $this->image_lib->initialize($config);
						    $this->image_lib->resize();
						    $this->image_lib->clear();
						}
			        }

			        $data = array(
			        	'image_name' => $galleryImages,
			        	'uploaded_on' => date('y-m-d'),
			        	'uploaded_by' => $this->session->admin_id,
			        );

			        $query = $this->db->insert('whole_media',$data);

			        if(!$query){
			        	$error[] = 'Image '.$galleryImages.' Could not be uploaded! Please try again';
			        }
			    }


			    if(!empty($error)){
			    	echo json_encode($error);
			    	exit;
			    }else{
			    	echo json_encode(['msg' => 'Uploaded succefuly']);
			    	exit;
			    }
			}else{

				echo json_encode(['msg' => 'Please Select Images First']);
				exit;

			}
		}

		public function get_media(){

			return $this->db->get('whole_media')->result();
		}
		public function delete_media(){

			$id = $this->input->post('id');

			$this->db->where('media_id',$id);
			$media = $this->db->get('whole_media')->row();

			$filename = pathinfo($media->image_name,PATHINFO_FILENAME);
            $file_ext = pathinfo($media->image_name,PATHINFO_EXTENSION);

            $path = './uploads/products/thumbs/'.$filename.'-50x50.'.$file_ext;
			unlink($path);

			$path = './uploads/products/thumbs/'.$filename.'-200x350.'.$file_ext;
			unlink($path);

			$path = './uploads/products/thumbs/'.$filename.'-500x700.'.$file_ext;
			unlink($path);

			$path = './uploads/products/thumbs/'.$filename.'-600x900.'.$file_ext;
			unlink($path);

			$path = './uploads/products/'.$media->image_name;
			unlink($path);

			$this->db->where('media_id',$id);
			$query = $this->db->delete('whole_media');

			if($this->db->affected_rows() > 0){
				echo json_encode(['msg' => 'deleted']);
				exit;
			}else{
				echo json_encode(['msg' => 'error']);
				exit;
			}
		}


		public function save_exceptions(){

			$state = $this->input->post('cityState');
			$options = $this->input->post('options');
			$type = $this->input->post('type');


			if(!empty($options)){

				foreach($options as $option){

					$this->db->where('except_option',$option);
					$this->db->where('except_type',$type);
					$this->db->where('except_state',$state);
					$query = $this->db->get('whole_exeptions');

					if($query->num_rows() === 0 ){

						$data = array(
							'except_option' => $option,
							'except_type' => $type,
							'except_state' => $state,
						);

						$error[] = $this->db->insert('whole_exeptions',$data);
					}
				}

				foreach ($error as $err) {
					
					if(!$err){

						$this->session->set_flashdata('error','Action Couldnot be Completed. Please Try Again');
						redirect('admin/products/sale-exceptions');

					}

					$this->session->set_flashdata('success','Exceptions Added Successfully');
					redirect('admin/products/sale-exceptions');
				}

			}else{

				$this->session->set_flashdata('error','Please Select atleast one '.ucfirst($type).' to complete the action');
				redirect('admin/products/sale-exceptions');
			}
		}



		public function get_wholesale_rates(){

			$this->db->select('*');
			$this->db->from('whole_rate_slots a');
			$this->db->join('whole_products b','a.rate_product = b.product_id','left');
			return $this->db->get()->result();
		}
		
		public function save_wholesale_rates(){

			$product = $this->input->post('wholesaleProductId');
			$start = $this->input->post('startQty');
			$end = $this->input->post('endQty');
			$price = $this->input->post('wholesalePrice');

			$id = $this->input->post('wholesaleRateId');

			if($id){

				$data = array(
					'rate_product' => $product,
					'rate_start_qty' => $start,
					'rate_end_qty' => $end,
					'rate_price' => $price,
					'rate_modified_by' => $this->session->admin_id,
					'rate_modified_on' => date('y-m-d'),
				);

				$this->db->where('rate_id',$id);
				$query = $this->db->update('whole_rate_slots',$data);

				if($query){
					echo json_encode(['msg' => 'updated']);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);
					exit;

				}
			}else{

				$this->db->where('rate_product',$product);
				$this->db->where('rate_start_qty >=',$start);
				$this->db->where('rate_start_qty <= ',$end);
				$query = $this->db->get('whole_rate_slots');
				if($query->num_rows() > 0){

					echo json_encode(['msg' => 'already']);
					exit;
				}else{

					$this->db->where('rate_product',$product);
					$this->db->where('rate_end_qty >=',$start);
					$this->db->where('rate_end_qty <= ',$end);
					$query = $this->db->get('whole_rate_slots');
					if($query->num_rows() > 0){

						echo json_encode(['msg' => 'already']);
						exit;
					}
				}

				
				$data = array(
					'rate_product' => $product,
					'rate_start_qty' => $start,
					'rate_end_qty' => $end,
					'rate_price' => $price,
					'rate_created_on' => date('y-m-d'),
					'rate_created_by' => $this->session->admin_id,
				);

				$query = $this->db->insert('whole_rate_slots',$data);

				if($query){
					echo json_encode(['msg' => 'inserted']);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);
					exit;
					
				}
			}
		}
	}