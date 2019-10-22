
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
                        <h4 class="page-title">Attribute Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= site_url('admin/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Assigned Attribute Options</li>
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
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">Option Detail</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-6">Option Name:</label>
                                            <div class="col-md-6">
                                                <p class="form-control-static"><?= $option->option_name ?> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-6">Option Value:</label>
                                            <div class="col-md-6">
                                                <?php 
                                                    if($option->option_type == 'color'){
                                                        echo '<div style="height:20px;width:20px;border : 1px solid #000; background-color : '.$option->option_value.'"></div>';
                                                    }else{
                                                        echo $option->option_value;
                                                    }
                                                ?>  
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-6">Attribute Name:</label>
                                            <div class="col-md-6">
                                                <p class="form-control-static">
                                                    <?php if($attributes){ foreach($attributes as $att){
                                                            if($att->attribute_id == $option->option_attribute){
                                                                echo $att->attribute_name;

                                                                $attribute_id = $att->attribute_id;
                                                            }
                                                        }}
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="<?= site_url('admin/attributes/update-options-to-attributes')?>" method="post">

                                    <input type="hidden" name="option_id" value="<?= $option->option_id ?>">
                                    <input type="hidden" name="attribute_id" value="<?= $attribute_id?>">

                                    <div class="table-responsive">
                                        <table id="DOM_pos" class="table table-bordered display" style="width:100%">
                                            <thead class="bg-inverse text-white">
                                                <tr>
                                                    <th style="width: 30px;"><div class="form-check form-check-inline">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input checkbox" id="selectAll" checked="">
                                                                <label class="custom-control-label" for="selectAll"></label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th>Category</th>
                                                </tr>
                                            </thead>
                                            <tbody id="resultBody">
                                                <?php if($assignedOptions){ foreach($assignedOptions as $assign){ 

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

                                                                                $cateName = $category4->category_name.'->'.$category3->category_name.'->'.$category2->category_name.'->'.$category1->category_name;
                                                                            }else{

                                                                                $cateName = $category3->category_name.'->'.$category2->category_name.'->'.$category1->category_name;
                                                                            }

                                                                        }else{

                                                                            $cateName = $category2->category_name.'->'.$category1->category_name;
                                                                        }
                                                                    }else{

                                                                        $cateName = $category1->category_name;
                                                                    } 
                                                                ?>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="form-check form-check-inline">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input checkbox" id="select<?= $assign->assign_id ?>" value="<?= $category1->category_id ?>" name="options[]" checked="">
                                                                                    <label class="custom-control-label" for="select<?= $assign->assign_id ?>"></label>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div style="padding: 5px 5px; display : inline-block;border : 1px solid #dee2e6;margin-right : 2px;"><?= $cateName?></div>
                                                                        </td>
                                                                    </tr>
                                                          <?php }
                                                            }
                                                        }
                                                    }}
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="action-form">
                                        <div class="form-group m-b-0 text-right">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                            <button type="submit" class="btn btn-dark waves-effect waves-light">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

                <style type="text/css">
                    .toolbar {
                        display: inline-block;
                    }
                    div#DOM_pos_filter {
                        display: inline-block;
                        float: right;
                    }
                    div.dataTables_wrapper div.toolbar label {
                        font-weight: normal;
                        white-space: nowrap;
                        text-align: left;
                    }
                    .custom-control-label::after, .custom-control-label::before {
                        top: -10px;
                        left: -16px;
                    }
                </style>