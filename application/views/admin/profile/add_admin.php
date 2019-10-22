
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
                        <h4 class="page-title">Admin Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= site_url('admin/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Admin Category</li>
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
                            <form class="" id="adminForm" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Add Admin</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="adminName" class="control-label col-form-label">Admin Name</label>
                                                <input type="text" class="form-control" name="adminName" id="adminName" aria-describedby="name" placeholder="Admin Name">
                                                <input type="hidden" name="adminId" id="adminId">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="adminEmail" class="control-label col-form-label">Admin Email</label>
                                                <input type="email" class="form-control" name="adminEmail" id="adminEmail" aria-describedby="name" placeholder="Admin Email">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="adminMobile" class="control-label col-form-label">Admin Mobile</label>
                                                <input type="text" class="form-control" name="adminMobile" id="adminMobile" aria-describedby="name" placeholder="Admin Mobile">
                                                
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="adminRole" class="control-label col-form-label">Admin Role</label>
                                                <select class="custom-select col-12" id="adminRole" name="adminRole">
                                                    <option value="">Choose...</option>
                                                    <option value="admin">Admin</option> 
                                                    <option value="author">Author</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="adminImage" class="control-label col-form-label">Admin Picture</label>
                                            <div class="input-group mb-3">
                                                
                                                <div class="custom-file" id="customfileCat">
                                                    <input type="file" class="custom-file-input" id="adminImage" name="adminImage">
                                                    <label class="custom-file-label" for="adminImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <img id="adminImagePreview" src="<?= site_url() ?>assets/images/gallery/chair.png" width="80">
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
                                <h4 class="card-title">Admin Listing</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="bg-inverse text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($admins){ $i = 1; foreach($admins as $admin){ 

                                                $filename= pathinfo($admin->admin_image,PATHINFO_FILENAME);
                                                $file_ext = pathinfo($admin->admin_image,PATHINFO_EXTENSION);
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php if(!empty($filename)){ ?>
                                                        <img src="<?= site_url() ?>uploads/admin/thumbs/<?= $filename ?>-50x50.<?= $file_ext ?>" alt="iMac">
                                                    <?php }else{ echo $i; } ?>
                                                        
                                                </td>
                                                <td><?= $admin->admin_display_name ?></td>
                                                <td><?= $admin->admin_role ?></td>
                                                <td><?= $admin->admin_email ?></td>
                                                <td><?= $admin->admin_phone ?></td>
                                                <td>
                                                    <a href="javascript:void(0)" class="text-inverse p-r-10 editAdmin" data-toggle="tooltip" title="" data-original-title="Edit" data-id="<?= $admin->admin_id ?>"><i class="ti-marker-alt"></i></a>
                                                    <?php if($admin->admin_status == 1){ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disableAdmin" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $admin->admin_id ?>"  data-status="0"><i class="ti-trash"></i></a>
                                                    <?php }else{ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disableAdmin" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $admin->admin_id ?>"  data-status="1"><i class="ti-check-box"></i></a>
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