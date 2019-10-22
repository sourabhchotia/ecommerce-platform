
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
                                    <li class="breadcrumb-item active" aria-current="page">Attributes</li>
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
                            <form class="" id="attributeForm" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Add Attributes</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="attributeName" class="control-label col-form-label">Attributes Name</label>
                                                <input type="text" class="form-control" name="attributeName" id="attributeName" aria-describedby="name" placeholder="Attribute Name">
                                                <input type="hidden" name="attributeId" id="attributeId">
                                            </div>
                                        </div>
                                        <div class="col-5 text-left">
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input checkbox" id="is_filter" name="is_filter">
                                                    <label class="custom-control-label" for="is_filter">Is Filter?</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-5 text-left">
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input checkbox" id="is_variant" name="is_variant">
                                                    <label class="custom-control-label" for="is_variant">Is Variant?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-left">
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input radio" id="is_size" name="att_type" value="size">
                                                    <label class="custom-control-label" for="is_size">Is Size?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-left">
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input radio" id="is_color" name="att_type" value="color">
                                                    <label class="custom-control-label" for="is_color">Is Color?</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="action-form">
                                        <div class="form-group m-b-0 text-right">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                            <button type="submit" class="btn btn-dark waves-effect waves-light">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Attribute Listing</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="bg-inverse text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Attribute Name</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($attributes){ $i = 1; foreach($attributes as $attribute){
                                            ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $attribute->attribute_name ?></td>
                                                <td><?php if($admins){ foreach($admins as $admin){ 
                                                            if($admin->admin_id == $attribute->attribute_created_by){
                                                                echo $admin->admin_display_name;
                                                            }
                                                    } } ?>
                                                        
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="text-inverse p-r-10 edit" data-toggle="tooltip" title="" data-original-title="Edit" data-id="<?= $attribute->attribute_id ?>"><i class="ti-marker-alt"></i></a>
                                                    <?php if($attribute->attribute_status == 1){ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disable" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $attribute->attribute_id ?>"  data-status="0"><i class="ti-trash"></i></a>
                                                    <?php }else{ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disable" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $attribute->attribute_id ?>"  data-status="1"><i class="ti-check-box"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php $i++; } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->