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
                        <h4 class="page-title">Order Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Orders</li>
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
                        <?php if($this->session->flashdata('error')){
                                ?>
                            <div class="alert alert-danger alert-rounded">
                                <? $error = $this->session->flashdata('error'); foreach ($error as $value) {
                                    echo $value;
                                } ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title p-b-2" id="orderTitle">Exceptions By Product</h3>
                                <hr class="p-b-20">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> 
                                        <a onclick="changeTitle(this);" class="nav-link active" data-toggle="tab" href="#pending" role="tab">
                                            <span class="hidden-sm-up">
                                                <i class="ti-home"></i>
                                            </span> 
                                            <span class="hidden-xs-down">Exceptions By Product</span>
                                        </a> 
                                    </li>
                                    <li class="nav-item"> <a onclick="changeTitle(this);" class="nav-link" data-toggle="tab" href="#processing" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Exceptions By Category</span></a> </li>
                                    <!-- <li class="nav-item"> <a onclick="changeTitle(this);" class="nav-link" data-toggle="tab" href="#packed" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Packed Orders</span></a> </li>
                                    <li class="nav-item"> <a  onclick="changeTitle(this);" class="nav-link" data-toggle="tab" href="#shipped" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Shipped Orders</span></a> </li>
                                    <li class="nav-item"> <a onclick="changeTitle(this);" class="nav-link" data-toggle="tab" href="#delivered" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Delivered Orders</span></a> </li>
                                    <li class="nav-item"> <a onclick="changeTitle(this);" class="nav-link" data-toggle="tab" href="#cancel" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Canceled Orders</span></a> </li> -->
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">

                                    <!-- 
                                    ============================================================================
                                    ============================================================================
                                                        Pending Order Tab Data From Here
                                    ============================================================================
                                    ============================================================================
                                     -->

                                    <div class="tab-pane p-20 active" id="pending" role="tabpanel">
                                        <div class="row">
                                            <!-- Column -->
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form method="post" action="<?= site_url('admin/products/save-sale-exceptions') ?>">
                                                            <input type="hidden" name="type" value="product">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label>Select Country</label>
                                                                        <select class="custom-select col-12" id="stateCountry" name="cityCountry">
                                                                            <option selected="" value="">Choose...</option>
                                                                            <?php if($countries){ foreach($countries as $country){ ?>
                                                                                <option value="<?= $country->country_id ?>"><?= $country->country_name ?> (<?= $country->country_shortname ?>)</option>
                                                                            <?php } } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label>Select State</label>
                                                                        <select class="custom-select col-12" id="cityState" name="cityState" required="">
                                                                            <option selected="" value="">Choose...</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive1">
                                                                <table class="table table-striped table-bordered product-overview" id="zero_config">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                <div class="form-check form-check-inline">
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input checkbox" id="selectAll">
                                                                                        <label class="custom-control-label" for="selectAll"></label>
                                                                                    </div>
                                                                                </div>
                                                                            </th>
                                                                            <th>Product Image</th>
                                                                            <th>Product Name</th>
                                                                            <th>Category</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    </tbody>
                                                                </table>
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
                                            </div>
                                            <!-- Column -->
                                        </div>

                                    </div>

                                    <!-- 
                                    ============================================================================
                                    ============================================================================
                                                        Pending Order Tab Data From Here
                                    ============================================================================
                                    ============================================================================
                                     -->

                                     <!-- 
                                    ============================================================================
                                    ============================================================================
                                                        Processing Order Tab Data From Here
                                    ============================================================================
                                    ============================================================================
                                     -->
                                    <div class="tab-pane  p-20" id="processing" role="tabpanel">
                                        <div class="row">
                                            <!-- Column -->
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form method="post" action="<?= site_url('admin/products/save-sale-exceptions') ?>">
                                                            <input type="hidden" name="type" value="category">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label>Select Country</label>
                                                                        <select class="custom-select col-12" id="stateCountry1" name="cityCountry">
                                                                            <option selected="" value="">Choose...</option>
                                                                            <?php if($countries){ foreach($countries as $country){ ?>
                                                                                <option value="<?= $country->country_id ?>"><?= $country->country_name ?> (<?= $country->country_shortname ?>)</option>
                                                                            <?php } } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label>Select State</label>
                                                                        <select class="custom-select col-12" id="cityState1" name="cityState" required="">
                                                                            <option selected="" value="">Choose...</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive1">
                                                                <table class="table table-striped table-bordered product-overview zero_config" id="zero_config">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                <div class="form-check form-check-inline">
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input checkbox" id="selectAll">
                                                                                        <label class="custom-control-label" for="selectAll"></label>
                                                                                    </div>
                                                                                </div>
                                                                            </th>
                                                                            <th>Category</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php if($categories){ foreach($categories as $cat){?>
                                                                        <tr>
                                                                            <td> 
                                                                                <div class="form-check form-check-inline">
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input checkbox" id="category<?= $cat->category_id ?>" value="<?= $cat->category_id ?>" name="options[]">
                                                                                        <label class="custom-control-label" for="category<?= $cat->category_id ?>"></label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td><?= $cat->category_name ?> (<?= strtoupper($cat->category_role) ?>)</td>
                                                                        </tr>
                                                                        <?php } } ?>
                                                                    </tbody>
                                                                </table>
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
                                            </div>
                                            <!-- Column -->
                                        </div>
                                    </div>

                                    <!-- 
                                    ============================================================================
                                    ============================================================================
                                                        Processing Order Tab Data From Here
                                    ============================================================================
                                    ============================================================================
                                     -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
