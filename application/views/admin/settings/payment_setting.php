
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
                        <h4 class="page-title">Payment Gateway Settings</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= site_url('admin/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Payment Gateway Settings</li>
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
                                <?= $this->session->flashdata('error')?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header bg-primary">
                                    <h4 class="m-b-0 text-white">Payment Gateway Settings</h4>
                                </div>
                                <div class="row m-t-40">
                                    <div class="col-lg-4 col-xl-3">
                                        <!-- Nav tabs -->
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                            <?php if($payment_gateways){ foreach($payment_gateways as $pg){?>
                                                <a class="nav-link <?php if($pg->pg_id == 1){ echo 'active'; } ?>" id="v-pills-<?= $pg->pg_name ?>-tab" data-toggle="pill" href="#v-pills-<?= $pg->pg_name ?>" role="tab" aria-controls="v-pills-<?= $pg->pg_name ?>" aria-selected="true"><?= $pg->pg_display_name ?>
                                                <?php if($pg->pg_name != 'cod'){ ?>
                                                    <br>
                                                    <span class="text-right">Powered By (<?= strtoupper($pg->pg_name)?>)</span>
                                                <?php } ?>
                                                </a>
                                            <?php } } ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-xl-9">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <?php if($payment_gateways){ foreach($payment_gateways as $pg){

                                                $readonly = '';

                                                if($pg->pg_name == 'cod'){
                                                    $readonly = 'd-none';
                                                }
                                            ?>
                                                <div class="tab-pane fade <?php if($pg->pg_id == 1){ echo 'show active'; } ?>" id="v-pills-<?= $pg->pg_name ?>" role="tabpanel" aria-labelledby="v-pills-<?= $pg->pg_name ?>-tab">
                                                    <form class="" action="<?= base_url('admin/settings/save-payment-settings') ?>" enctype="multipart/form-data" method="post">

                                                        <input type="hidden" name="gateway_id" value="<?= $pg->pg_name ?>">
                                                        <div class="row">
                                                            <div class="col-md-6 p-b-20">
                                                                <div class="form-group">
                                                                    <label for="site_title" class="control-label col-form-label">
                                                                        Display Name 
                                                                        <i class="far fa-question-circle" data-toggle="tooltip" title="" data-original-title="Edit" style="cursor: pointer;"></i>
                                                                    </label>
                                                                    <input type="text" class="form-control" name="display_name" id="display_name" aria-describedby="name" placeholder="Display Name" value="<?= $pg->pg_display_name ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 p-b-20 <?= $readonly ?>">
                                                                <div class="form-group">
                                                                    <label for="site_sub_title" class="control-label col-form-label">
                                                                        Service Provider
                                                                        <i class="far fa-question-circle" data-toggle="tooltip" title="" data-original-title="Edit" style="cursor: pointer;"></i>
                                                                    </label>
                                                                    <input type="text" class="form-control" name="service_provider" id="service_provider" aria-describedby="name" placeholder="Service Provider" value="<?= $pg->pg_password  ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 p-b-20 <?= $readonly ?>">
                                                                <div class="form-group">
                                                                    <label for="site_title" class="control-label col-form-label">
                                                                        Merchant Key
                                                                        <i class="far fa-question-circle" data-toggle="tooltip" title="" data-original-title="Edit" style="cursor: pointer;"></i>
                                                                    </label>
                                                                    <input type="text" class="form-control" name="merchant_key" id="merchant_key" aria-describedby="name" placeholder="Merchant Key" value="<?= $pg->pg_merchant_key ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 p-b-20 <?= $readonly ?>">
                                                                <div class="form-group">
                                                                    <label for="site_sub_title" class="control-label col-form-label">
                                                                        Salt Key
                                                                        <i class="far fa-question-circle" data-toggle="tooltip" title="" data-original-title="Edit" style="cursor: pointer;"></i>
                                                                    </label>
                                                                    <input type="text" class="form-control" name="salt_key" id="salt_key" aria-describedby="name" placeholder="Salt Key" value="<?= $pg->pg_salt_key  ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 p-b-20 <?= $readonly ?>">
                                                                <div class="form-group">
                                                                    <label for="site_title" class="control-label col-form-label">
                                                                        Secret Key
                                                                        <i class="far fa-question-circle" data-toggle="tooltip" title="" data-original-title="Edit" style="cursor: pointer;"></i>
                                                                    </label>
                                                                    <input type="text" class="form-control" name="secret_key" id="secret_key" aria-describedby="name" placeholder="Secret Key" value="<?= $pg->pg_secret_key ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 p-b-20 <?= $readonly ?>">
                                                                <div class="form-group">
                                                                    <label for="site_sub_title" class="control-label col-form-label">
                                                                        Gateway URL
                                                                        <i class="far fa-question-circle" data-toggle="tooltip" title="" data-original-title="Edit" style="cursor: pointer;"></i>
                                                                    </label>
                                                                    <input type="text" class="form-control" name="gateway_url" id="gateway_url" aria-describedby="name" placeholder="Gateway URL" value="<?= $pg->pg_url  ?>">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php

                                                            $active = $deactive = '';

                                                            if($pg->pg_status == '1'){ 

                                                                $active = 'checked=""';
                                                            }
                                                            if($pg->pg_status == '0'){ 

                                                                $deactive = 'checked=""';
                                                            }
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-md-6 p-b-20">
                                                                <div class="form-check form-check-inline">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input radio" id="active<?= $pg->pg_id  ?>" name="status" value="1" <?= $active  ?>>
                                                                        <label class="custom-control-label" for="active<?= $pg->pg_id  ?>">Active</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 p-b-20">
                                                                <div class="form-check form-check-inline">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input radio" id="deactive<?= $pg->pg_id  ?>" name="status" value="0" <?= $deactive  ?>>
                                                                        <label class="custom-control-label" for="deactive<?= $pg->pg_id  ?>">Deactive</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="action-form">
                                                            <div class="form-group m-b-10 text-right">
                                                                <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php } } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="result"></div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

                <style type="text/css">
                    div#v-pills-tabContent {
                        border-top: 1px solid #f2f2f2;
                        border-right: 1px solid #f2f2f2;
                        border-bottom: 1px solid #f2f2f2;
                        padding: 10px 30px;
                        box-shadow: 0px 0px 10px #d5d3d3bd;
                    }
                    .nav-pills .nav-link {
                        border-radius: 2px;
                        padding: 15px;
                        border-bottom: 1px solid #dddddd;
                    }
                    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
                        color: #fff;
                        background-color: #fa5838;
                    }
                    div#v-pills-tab {
                        box-shadow: 0px 0px 10px #d9d9d9;
                        text-align: center;
                    }
                </style>