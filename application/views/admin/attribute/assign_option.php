
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
                                    <li class="breadcrumb-item active" aria-current="page">Assign Attribute Options</li>
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
                    <div class="col-12">
                        <?php if($this->session->flashdata('success')){?>
                            <div class="alert alert-success alert-rounded">
                                <?= $this->session->flashdata('success') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                            </div>
                        <?php } ?>
                        <?php if($this->session->flashdata('error')){?>
                            <div class="alert alert-danger alert-rounded">
                                <?= $this->session->flashdata('error') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="assignOption" method="post">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Select Parent Category</label>
                                                <select class="custom-select col-12" id="parentCat" name="parentCategory" required="">
                                                    <option selected="" value="">Choose...</option>
                                                   <?php if($parentcategories){ foreach($parentcategories as $cat){ ?>
                                                        <option value="<?= $cat->category_id ?>"><?= $cat->category_name ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label>Select Main Category</label>
                                                <select class="custom-select col-12" id="mainCat" name="mainCategory">
                                                    <option selected="" value="">Choose...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label>Select Sub Category</label>
                                                <select class="custom-select col-12" id="subCat" name="subCategory">
                                                    <option selected="" value="">Choose...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label>Select Inner Category</label>
                                                <select class="custom-select col-12" id="innerCat" name="innerCategory">
                                                    <option selected="" value="">Choose...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Select Attribute</label>
                                                <select class="custom-select col-12" id="attribute" name="attribute" required="">
                                                    <option selected="" value="">Choose...</option>
                                                    <?php if($attributes){ foreach($attributes as $att){ ?>
                                                        <option value="<?= $att->attribute_id ?>"><?= $att->attribute_name ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="DOM_pos" class="table table-bordered display" style="width:100%">
                                            <thead class="bg-inverse text-white">
                                                <tr>
                                                    <th style="width: 30px;">
                                                        <div class="form-check form-check-inline">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input checkbox" id="selectAll">
                                                                <label class="custom-control-label" for="selectAll"></label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th>Option Value</th>
                                                    <th>Option Name</th>
                                                    <th>Assigned To</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="resultBody">
                                                <?php if($attributeOptions){ $i = 1; foreach($attributeOptions as $option){
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input checkbox" id="select<?= $option->option_id ?>" value="<?= $option->option_id ?>" name="options[]">
                                                                <label class="custom-control-label" for="select<?= $option->option_id ?>"></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?php 
                                                            if($option->option_type == 'color'){
                                                                echo '<div style="height:20px;width:20px;border : 1px solid #000; background-color : '.$option->option_value.'"></div>';
                                                            }else{
                                                                echo $option->option_value;
                                                            }
                                                        ?>  
                                                    </td>
                                                    <td><?= $option->option_name ?></td>
                                                    
                                                    <td>
                                                        <?php if($assigned){ foreach($assigned as $assign){ 

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
                                                                        echo '<div style="padding: 5px 5px; display : inline-block;border : 1px solid #dee2e6;margin-right : 2px;">'.$cateName.'</div>';
                                                                    }
                                                                }
                                                            }
                                                        }}
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= site_url('admin/attributes/edit-options-to-attributes') ?>?queryType=edit&queryItem=<?= $option->option_id ?>" class="text-inverse p-r-10" data-toggle="tooltip" title="" data-original-title="Edit"><i class="ti-marker-alt"></i></a>
                                                    </td>
                                                </tr>
                                                <?php $i++; } } ?>
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