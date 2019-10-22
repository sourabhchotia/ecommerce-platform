<!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Product Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <style type="text/css">
                    ol.sluglink {
                        list-style: none;
                        justify-content: flex-start;
                        padding-left: 0px;
                        margin: 0;
                        position: relative;
                        top: -10px;
                    }
                </style>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form action="<?= site_url('admin/products/update-products') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        
                        <!-- Column -->
                        <div class="col-lg-8">
                            <div class="form-body">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">About Product</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Product Name</label>
                                                    <input type="text" id="productName" name="productName" class="form-control" placeholder="Product Name" value="<?= $product->product_name ?>" required=""> 
                                                    <input type="hidden" name="productID" value="<?= $product->product_id ?>">
                                                </div>
                                                <ol class="sluglink">
                                                    <li class="breadcrumb-item">
                                                        View on Live Site : <a href="<?= site_url($product->combination_slug) ?>" target="_blank"> <?= site_url($product->combination_slug) ?></a>
                                                    </li>
                                                </ol>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">

                                            <div class="col-2">
                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input checkbox" id="is_filter" name="is_filter" value="1" <?php if($product->is_featured){ echo 'checked=""'; }?>>
                                                        <label class="custom-control-label" for="is_filter">Fetaured?</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input checkbox" id="slider" name="slider" value="1" <?php if($product->on_slider){ echo 'checked=""'; }?>>
                                                        <label class="custom-control-label" for="slider">Show on Slider?</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input checkbox" id="banner" name="banner" value="1" <?php if($product->on_banner){ echo 'checked=""'; }?>>
                                                        <label class="custom-control-label" for="banner">Show on Banner?</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <select class="custom-select col-12" id="productType" name="productType" required="">
                                                        <option value="">Product Type</option>
                                                        <option <?php if($product->product_type == 'retail'){ echo 'selected=""'; }?>  value="retail">Retial</option>
                                                        <option <?php if($product->product_type == 'wholesale'){ echo 'selected=""'; }?>  value="wholesale">Wholesale</option>
                                                        <option <?php if($product->product_type == 'both'){ echo 'selected=""'; }?>  value="both">Both</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php

                                    $this->db->where('category_id',$product->product_category);
                                    $category1 = $this->db->get('whole_category')->row();

                                    // Check if Category is Main Category or not.
                                    $finalCat = 0;
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

                                                $innerCatId = $finalCat = $category1->category_id;
                                                $subCatID = $category2->category_id;
                                                $mainCatId = $category3->category_id;
                                                $parentCategoryId = $category4->category_id;
                                            }else{
                                                $subCatID = $finalCat = $category1->category_id;
                                                $mainCatId = $category2->category_id;
                                                $parentCategoryId = $category3->category_id;
                                            }
                                        }else{
                                            $mainCatId = $finalCat = $category1->category_id;
                                            $parentCategoryId = $category2->category_id;
                                        }
                                    }else{
                                        $parentCategoryId = $finalCat = $category1->category_id;
                                        $parentCatName = $category1->category_name;
                                    }
                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Parent Category</label>
                                                    <select class="custom-select col-12" id="parentCat" name="parentCategory" required="">
                                                        <?php if($categories){ foreach($categories as $cat){ 
                                                                if($cat->category_id == $parentCategoryId){ ?>
                                                            <option selected="" value="<?= $cat->category_id ?>"><?= $cat->category_name ?></option>
                                                        <?php } } } ?>
                                                        <option  value="">Choose... from Other</option>
                                                       <?php if($categories){ foreach($categories as $cat){ 
                                                                if($cat->category_id != $parentCategoryId){ ?>
                                                            <option value="<?= $cat->category_id ?>"><?= $cat->category_name ?></option>
                                                        <?php } } } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Main Category</label>
                                                    <select class="custom-select col-12" id="mainCat" name="mainCategory">
                                                        <option  value="">Choose...</option>
                                                        <?php if($mainCategories){ foreach($mainCategories as $cat){ 
                                                                if($cat->category_id == $mainCatId){ ?>
                                                            <option selected="" value="<?= $cat->category_id ?>"><?= $cat->category_name ?></option>
                                                        <?php } } } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Sub Category</label>
                                                    <select class="custom-select col-12" id="subCat" name="subCategory">
                                                        <option  value="">Choose...</option>
                                                        <?php if($subCategories){ foreach($subCategories as $cat){ 
                                                                if($cat->category_id == $subCatID){ ?>
                                                            <option selected="" value="<?= $cat->category_id ?>"><?= $cat->category_name ?></option>
                                                        <?php } } } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Inner Category</label>
                                                    <select class="custom-select col-12" id="innerCat" name="innerCategory">
                                                        <option  value="">Choose...</option>
                                                        <?php if($innerCategories){ foreach($innerCategories as $cat){ 
                                                                if($cat->category_id == $innerCatId){ ?>
                                                            <option selected="" value="<?= $cat->category_id ?>"><?= $cat->category_name ?></option>
                                                        <?php } } } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Artical No.</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Artical Number" aria-label="price" aria-describedby="basic-addon1" name="articalNum" value="<?= $product->product_artical ?>" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>SKU Code</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="SKU Code" aria-label="price" aria-describedby="basic-addon1" name="skuCode" value="<?= $product->combination_skucode ?>" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>HSN Code</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="HSN Code" aria-label="price" aria-describedby="basic-addon1" name="hsnCode" value="<?= $product->product_hsn ?>" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Brand</label>
                                                    <div class="input-group mb-3">
                                                        <select class="custom-select col-12" id="" name="brand" required="">
                                                            <?php if($brands){ foreach($brands as $brand){ 
                                                                if($brand->brand_id == $product->product_brand){ ?>
                                                                <option selected="" value="<?= $brand->brand_id ?>"><?= $brand->brand_name ?></option>
                                                            <?php } } } ?>
                                                            <option  value="">Choose... from Other</option>
                                                           <?php if($brands){ foreach($brands as $brand){ 
                                                                    if($brand->brand_id != $product->product_brand){ ?>
                                                                <option value="<?= $brand->brand_id ?>"><?= $brand->brand_name ?></option>
                                                            <?php } } } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Regular Price</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"><i class="ti-money"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="price" aria-label="price" aria-describedby="basic-addon1" name="price" value="<?= $product->product_price ?>" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Sale Price</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon2"><i class="ti-cut"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Discount" aria-label="Discount" aria-describedby="basic-addon2" name="salePrice" value="<?= $product->product_sale_price ?>" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Stock</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon3"><i class="ti-archive"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Stock" aria-label="Stock" aria-describedby="basic-addon3" name="stock" value="<?= $product->product_stock ?>" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Min. Qty</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Min. Qty" aria-label="Stock" aria-describedby="basic-addon3" name="minQty" value="<?= $product->product_min_qty ?>" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        <!-- Column -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title m-b-10">Product Main Image</h4>
                                    <div class="row">
                                        <div class="col-12 m-b-10">
                                            <?php if($product->product_image != ''){ 
                                                $filename= pathinfo($product->product_image,PATHINFO_FILENAME);
                                                $file_ext = pathinfo($product->product_image,PATHINFO_EXTENSION);
                                            ?>
                                                <img id="categoryImagePreview" class="img-responsive" src="<?= site_url() ?>uploads/products/thumbs/<?= $filename ?>-200x350.<?= $file_ext ?>" style="width: 60%">
                                            <?php }else{ ?>
                                                <img id="categoryImagePreview" class="img-responsive" src="<?= site_url() ?>assets/images/gallery/chair.png" style="width: 60%">
                                            <?php } ?>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="categoryImage" name="categoryImage" >
                                                    <label class="custom-file-label" for="categoryImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title m-b-10">Product Gallery Images</h4>
                                    <div class="row">
                                        
                                        <div class="col-12" id="image_preview">
                                        <?php if($product->product_gallery != ''){ 
                                            $gallery = explode(',', $product->product_gallery);
                                            foreach($gallery as $img){
                                                $filename= pathinfo($img,PATHINFO_FILENAME);
                                                $file_ext = pathinfo($img,PATHINFO_EXTENSION);
                                        ?>
                                            <img id="categoryImagePreview" class="img-responsive" src="<?= site_url() ?>uploads/products/thumbs/<?= $filename ?>-200x350.<?= $file_ext ?>" width="90" height="90">
                                        <?php } }else{ ?>
                                            <img id="categoryImagePreview" class="img-responsive" src="<?= site_url() ?>assets/images/gallery/chair.png" width="90" height="90">
                                        <?php } ?>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="gallerImage" name="gallerImage[]" multiple>
                                                    <label class="custom-file-label" for="gallerImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title m-t-40">Product Description</h5>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="4" placeholder="Product Description" name="description" required=""><?= $product->product_description ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="4" placeholder="Product Short Description" name="shortDescription"><?= $product->product_short_description ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Meta Title</label>
                                                    <input type="text" class="form-control" name="metaTitle" value="<?= $product->product_meta_title ?>"> </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Meta Keyword</label>
                                                    <input type="text" class="form-control" name="metakeywords" value="<?= $product->product_meta_keywords ?>"> </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Meta Description</label>
                                                    <input type="text" class="form-control" name="metaDescription" value="<?= $product->meta_description ?>"> </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h3 class="card-title m-t-40">Attributes</h3>
                                                        <span class="card-title">Leave Fields Blank in Case You dont want to create variations</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="action-form m-t-40">
                                                            <div class="form-group m-b-0 text-right">
                                                                <button type="button" class="btn btn-success waves-effect waves-light"  id="addMoreAttribute">Add More</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered td-padding">
                                                        <tbody id="generalInfo">
                                                            <?php 

                                                            $html = '';
                                                                $this->db->where('assign_category',$finalCat);
                                                                $assigned = $this->db->get('whole_assigned_options');
                                                                $Assignedoptions = array();
                                                                if($assigned->num_rows() > 0){
                                                                    foreach($assigned->result() as $assign){
                                                                        $Assignedoptions[] = $assign->assign_option;
                                                                    }
                                                                }
                                                                $this->db->where('combination_product',$product->product_id);
                                                                $combos = $this->db->get('whole_product_combinations')->result();

                                                                if($combos){ $num = 1; 
                                                                    foreach($combos as $combo){
                                                                        $this->db->where('p_attribute_combo',$combo->combination_id);
                                                                        $options = $this->db->get('whole_product_options')->result();

                                                                        if($options){

                                                                            $html .= '<tr>';
                                                                            $i = 0;
                                                                            foreach ($options as $value) {

                                                                                $this->db->where('attribute_id',$value->p_attribute_id);
                                                                                $attribute = $this->db->get('whole_attributes')->row();
                                                                                $html .='<td><div class="form-group">
                                                                                        <select class="custom-select col-12 categorySelect" id="innerCat" name="att_'.$value->p_attribute_id.'_'.$num.'">
                                                                                            <option value="">SELECT '.$attribute->attribute_name.'</option>';
                                                                                $this->db->where('option_id',$value->p_attribute_value);
                                                                                $this->db->where('option_attribute',$value->p_attribute_id);
                                                                                $option = $this->db->get('whole_attribute_options')->row();
                                                                                    $html .= '<option selected="" value="'.$option->option_id.'">'.$option->option_name.'</option>';

                                                                                foreach ($Assignedoptions as $op) {
                                                                                    $this->db->where('option_id',$op);
                                                                                    $this->db->where('option_attribute',$value->p_attribute_id);
                                                                                    $optionass = $this->db->get('whole_attribute_options')->result();
                                                                                    foreach($optionass as $opt){
                                                                                        if($opt->option_id != $option->option_id){
                                                                                           $html .= '<option value="'.$opt->option_id.'">'.$opt->option_name.'</option>'; 
                                                                                        }
                                                                                        
                                                                                    }
                                                                                }
                                                                                $html .= '</select>
                                                                                    </div></td>';

                                                                                $i++;
                                                                            }
                                                                        }
                                                                        $html .= '<td style="width: 100px;"><input type="text" class="form-control" placeholder="Price" name="attPrice_'.$num.'" value="'. $combo->combination_price.'"></td>
                                                                          <td style="width: 100px;"><input type="text" class="form-control" placeholder="Sale Price" name="attSalePrice_'.$num.'" value="'. $combo->combination_sale_price .'"></td>
                                                                          <td style="width: 100px;"><input type="text" class="form-control" placeholder="Stock" name="attStock_'.$num.'" value="'.$combo->combination_stock.'"></td>
                                                                          <td style="width: 100px;"><input type="text" class="form-control" placeholder="SKU Code" name="attSku_'.$num.'" value="'.$combo->combination_skucode .'"></td></tr>';

                                                                        $gallery = explode(',', $combo->combination_gallery);

                                                                        $html .='<tr><td colspan="'.$i.'">
                                                                                    <h4 class="card-title m-b-10">Combination Gallery Images</h4>
                                                                                    <div class="row">
                                                                                        <div class="col-12" class="image_preview">';

                                                                        foreach($gallery as $img){
                                                                            $filename= pathinfo($img,PATHINFO_FILENAME);
                                                                            $file_ext = pathinfo($img,PATHINFO_EXTENSION);

                                                                            $html .= '<img class="categoryImagePreview" class="img-responsive" src="'.site_url().'uploads/products/thumbs/'.$filename.'-200x350.'.$file_ext.'" width="90" height="90">';
                                                                        }

                                                                        $html .= '</div>
                                                                                    <div class="col-12">
                                                                                        <div class="input-group mb-3">
                                                                                            <div class="custom-file">
                                                                                                <input type="file" class="custom-file-input gallerImage" name="gallerImage_'.$num.'[]" multiple>
                                                                                                <label class="custom-file-label" for="gallerImage">Choose file</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                </td>';

                                                                        $filename= pathinfo($combo->combination_image,PATHINFO_FILENAME);
                                                                        $file_ext = pathinfo($combo->combination_image,PATHINFO_EXTENSION);

                                                                        $html .= '<td colspan="4">
                                                                                    <h4 class="card-title m-b-10">Combination Main Image</h4>
                                                                                    <div class="row">
                                                                                        <div class="col-12 m-b-10">
                                                                                            <img  class="img-responsive ProductImagePreview" src="'.site_url().'uploads/products/thumbs/'.$filename.'-200x350.'.$file_ext.'" width="90">
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
                                                                          $num += 1;
                                                                    }
                                                                    
                                                                }
                                                                echo $html;  
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <input type="hidden" name="totalAttributes" id="totalAttributes" value="<?= count($combos)?>">
                                            </div>
                                        </div>
                                        <hr> 
                                    </div>
                                </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="action-form">
                                        <div class="form-group m-b-0 text-center">
                                            <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                                            <button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <style type="text/css">
                #image_preview img{
                    width: 90px;
                    margin: 5px;
                    border: 1px solid #ececec;
                    height: 90px;
                }
            </style>
            