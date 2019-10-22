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
                        <h4 class="page-title">User Listing</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= site_url('admin/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">User Listing</li>
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
                    <!-- Column -->
                    <div class="col-lg-12 col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center m-b-30">
                                    <h4 class="card-title">User Listing</h4>
                                </div>
                                <div class="table-responsive">
                                    <table id="file_export" class="table table-bordered nowrap display">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Joining date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($users){ foreach($users as $user){?>
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="userSelect<?= $user->user_id ?>" required>
                                                            <label class="custom-control-label" for="userSelect<?= $user->user_id ?>"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="<?= site_url('admin/users/user-detail')?>?userID=<?= $user->user_id ?>"><?= $user->user_name ?></a>
                                                    </td>
                                                    <td><?= $user->user_email ?></td>
                                                    <td>(+91) <?= $user->user_mobile ?></td>
                                                    <td>
                                                        <?php if($user->user_status == '0'){ ?>
                                                            <span class="label label-danger">Blocked</span> 
                                                        <?php }else{ ?>
                                                            <span class="label label-success">Active</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?= date('d M Y', strtotime($user->user_created_on)) ?></td>
                                                    <td>
                                                        <?php if($user->user_status == '1'){ ?>
                                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn changeStatus" data-toggle="tooltip" data-original-title="Block" data-id="<?= $user->user_id ?>" data-status="0"><i class="ti-close" aria-hidden="true"></i></button>
                                                        <?php }else{ ?>
                                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn changeStatus" data-toggle="tooltip" data-original-title="Unblock" data-id="<?= $user->user_id ?>" data-status="1"><i class="ti-close" aria-hidden="true"></i></button>
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
                    <!-- Column -->
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->