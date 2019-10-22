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
                        <h4 class="page-title">User Detail</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= site_url('admin/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">User Detail</li>
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
                <div class="card-group">
                    <div class="card">
                        <div class="card-body bg-primary">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div>
                                            <p class="font-16 m-b-5 text-white">Total Orders</p>
                                        </div>
                                        <div class="ml-auto">
                                            <h1 class="font-light text-right text-white"><?= $totalOrder ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body bg-success">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div>
                                            <p class="font-16 m-b-5 text-white">Total Products</p>
                                        </div>
                                        <div class="ml-auto">
                                            <h1 class="font-light text-right text-white"><?= $totalProducts ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body bg-warning">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div>
                                            <p class="font-16 m-b-5 text-white">Monthly Purchase</p>
                                        </div>
                                        <div class="ml-auto">
                                            <h3 class="font-light text-right text-white"><?php if($monthPurchase){ echo $monthPurchase;}else{ echo "0.00"; } ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body bg-danger">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div>
                                            <p class="font-16 m-b-5 text-white">Total Purchase</p>
                                        </div>
                                        <div class="ml-auto">
                                            <h3 class="font-light text-right text-white"><?php if($totalPurchase){ echo $totalPurchase;}else{ echo "0.00"; } ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">User Personal Info</h4>
                            </div>
                            <form class="form-horizontal">
                                <div class="form-body">
                                    <hr class="m-t-0 m-b-40">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Name:</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-static"><?= $userdetail->user_name ?> </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Email:</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-static"> <?= $userdetail->user_email ?> </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Mobile:</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-static"> <?= $userdetail->user_mobile ?> </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">User Addresses</h4>
                            </div>
                            <form class="form-horizontal">
                                <div class="form-body">
                                    <hr class="m-t-0 m-b-40">
                                    <div class="card-body">
                                        <div class="row">
                                            <?php if($useraddresses){ foreach($useraddresses as $address){ ?>
                                            <div class="col-md-6 useraddress">
                                                <div class="form-group">
                                                        <h4 class="form-control-static"><?= $address->user_add_name ?></h4>
                                                        <p class="form-control-static"><?= $address->user_add_1 ?>, <?= $address->user_add_2 ?>
                                                            <br><?= $address->user_city ?>, <?= $address->user_state ?>, <?= $address->user_country ?>
                                                            <br><?= $address->user_zip_code ?>, (+91) <?= $address->user_add_mobile ?>
                                                        </p>
                                                </div>
                                            </div>
                                            <?php } } ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-actions">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 d-flex justify-content-center">
                                                    <?php if($userdetail->user_status == '1'){ ?>
                                                        <button type="button"  class="btn btn-danger changeStatus" data-id="<?= $userdetail->user_id ?>" data-status="0">Block</button>
                                                    <?php }else{ ?>
                                                        <button type="button" class="btn btn-primary changeStatus" data-id="<?= $userdetail->user_id ?>" data-status="1">Un Block</button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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

            <style type="text/css">
                .col-md-6.useraddress {
                    border: 1px solid #f2f2f2;
                    padding: 13px;
                    box-shadow: 0px 0px 10px #f2f2f2;
                }

                .col-md-6.useraddress:hover{
                    box-shadow: 2px 7px 10px #f2f2f2;
                }
            </style>