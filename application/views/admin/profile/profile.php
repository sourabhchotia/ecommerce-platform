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
                        <h4 class="page-title">Profile</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= site_url('admin/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                                </li>
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                                <br>
                                                <p class="text-muted"><?= $profile->admin_display_name ?></p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                                                <br>
                                                <p class="text-muted">+91 <?= $profile->admin_phone ?></p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                                <br>
                                                <p class="text-muted"><?= $profile->admin_email ?></p>
                                            </div>
                                            <div class="col-md-3 col-xs-6"> <strong>Role</strong>
                                                <br>
                                                <p class="text-muted"><?= strtoupper($profile->admin_role) ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form class="form-horizontal form-material" id="update_profile">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Full Name</label>
                                                        <div class="col-md-12">
                                                            <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line" value="<?= $profile->admin_display_name ?>" name="admin_name" id="admin_name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="admin_email" class="col-md-12">Email</label>
                                                        <div class="col-md-12">
                                                            <input type="email" placeholder="johndoe@admin.com" class="form-control form-control-line" name="admin_email" id="admin_email" value="<?= $profile->admin_email ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Phone No</label>
                                                        <div class="col-md-12">
                                                            <input type="text" placeholder="123 456 7890" value="<?= $profile->admin_phone ?>" class="form-control form-control-line" name="admin_phone" id="admin_phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group mb-3">
                                                            <div class="custom-file" id="customfileCat">
                                                                <input type="file" class="custom-file-input" id="adminImage" name="adminImage">
                                                                <label class="custom-file-label" for="adminImage">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <?php 
                                                            $filename= pathinfo($profile->admin_image,PATHINFO_FILENAME);
                                                            $file_ext = pathinfo($profile->admin_image,PATHINFO_EXTENSION);
                                                        ?>
                                                        <img id="adminImagePreview" src="<?= site_url() ?>uploads/admin/thumbs/<?= $filename ?>-150x150.<?= $file_ext ?>" width="150">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <button class="btn btn-success">Update Profile</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-6">
                                                <form class="form-horizontal form-material" id="changePassword">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Old Password</label>
                                                        <div class="col-md-12">
                                                            <input type="password" placeholder="Old Password" class="form-control form-control-line" name="old_password" id="old_password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="new_password" class="col-md-12">New Password</label>
                                                        <div class="col-md-12">
                                                            <input type="password" placeholder="New Password" class="form-control form-control-line" name="new_password" id="new_password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Confirm Password</label>
                                                        <div class="col-md-12">
                                                            <input type="password" placeholder="Confirm Password" class="form-control form-control-line" name="confirm_password" id="confirm_password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <button class="btn btn-success">Change Password</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
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