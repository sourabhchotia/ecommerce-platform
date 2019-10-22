
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
                        <h4 class="page-title">Brand Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= site_url('admin/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Brands</li>
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
                            <form class="" id="brandForm" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Add Brand</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="categoryName" class="control-label col-form-label">Brand Name</label>
                                                <input type="text" class="form-control" name="brandName" id="brandName" aria-describedby="name" placeholder="Brand Name">
                                                <input type="hidden" name="brandId" id="brandId">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="custom-file" id="customfileCat">
                                                    <input type="file" class="custom-file-input" id="brandImage" name="brandImage">
                                                    <label class="custom-file-label" for="brandImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <img id="categoryImagePreview" src="<?= site_url() ?>assets/images/gallery/chair.png" width="80">
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
                                <h4 class="card-title">Brand Listing</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="bg-inverse text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Brand Name</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($brands){ foreach($brands as $brand){ 

                                                $filename= pathinfo($brand->brand_image,PATHINFO_FILENAME);
                                                $file_ext = pathinfo($brand->brand_image,PATHINFO_EXTENSION);
                                            ?>
                                            <tr>
                                                <td>
                                                    <img src="<?= site_url() ?>uploads/brands/thumbs/<?= $filename ?>-150x50.<?= $file_ext ?>" alt="<?= $filename ?>">
                                                </td>
                                                <td><?= $brand->brand_name ?></td>
                                                <td><?php if($admins){ foreach($admins as $admin){ 
                                                            if($admin->admin_id == $brand->brand_created_by){
                                                                echo $admin->admin_display_name;
                                                            }
                                                    } } ?>
                                                        
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="text-inverse p-r-10 edit" data-toggle="tooltip" title="" data-original-title="Edit" data-id="<?= $brand->brand_id ?>"><i class="ti-marker-alt"></i></a>
                                                    <?php if($brand->brand_status == 1){ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disable" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $brand->brand_id ?>"  data-status="0"><i class="ti-trash"></i></a>
                                                    <?php }else{ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disable" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $brand->brand_id ?>"  data-status="1"><i class="ti-check-box"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php } } ?>
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