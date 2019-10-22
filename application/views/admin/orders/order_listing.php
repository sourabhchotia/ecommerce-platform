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
                                        <a href="<?= site_url('admin/dashboard')?>">Home</a>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
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
                                </div>
                                <h3 class="card-title p-b-2" id="orderTitle">Pending Orders</h3>
                                <hr class="p-b-20">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> 
                                        <a onclick="changeTitle(this);" class="nav-link active" data-toggle="tab" href="#pending" role="tab">
                                            <span class="hidden-sm-up">
                                                <i class="ti-home"></i>
                                            </span> 
                                            <span class="hidden-xs-down">Pending Orders</span>
                                        </a> 
                                    </li>
                                    <li class="nav-item"> <a onclick="changeTitle(this);" class="nav-link" data-toggle="tab" href="#processing" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Processing Orders</span></a> </li>
                                    <li class="nav-item"> <a onclick="changeTitle(this);" class="nav-link" data-toggle="tab" href="#packed" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Packed Orders</span></a> </li>
                                    <li class="nav-item"> <a  onclick="changeTitle(this);" class="nav-link" data-toggle="tab" href="#shipped" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Shipped Orders</span></a> </li>
                                    <li class="nav-item"> <a onclick="changeTitle(this);" class="nav-link" data-toggle="tab" href="#delivered" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Delivered Orders</span></a> </li>
                                    <li class="nav-item"> <a onclick="changeTitle(this);" class="nav-link" data-toggle="tab" href="#cancel" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Canceled Orders</span></a> </li>
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
                                                        <div class="table-responsive1">
                                                            <table class="table table-striped table-bordered product-overview zero_config" id="zero_config">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Actions</th>
                                                                        <th>Customer</th>
                                                                        <th>Order ID</th>
                                                                        <th>Photo</th>
                                                                        <th>Product</th>
                                                                        <th>Quantity</th>
                                                                        <th>Date</th>
                                                                        <th>Payment Mode</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php if($orders){ foreach($orders as $order){ 

                                                                        if($order->order_status == 'pending'){
                                                                        $filename= pathinfo($order->combination_image,PATHINFO_FILENAME);
                                                                        $file_ext = pathinfo($order->combination_image,PATHINFO_EXTENSION);
                                                                    ?>
                                                                        <tr>
                                                                            <td> 
                                                                                <div class="btn-group">
                                                                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        <i class="ti-settings"></i>
                                                                                    </button>
                                                                                    <div class="dropdown-menu animated slideInUp" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 0px, 0px);">
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-status-update')?>?orderID=<?= $order->order_id ?>&status=processing"><i class="ti-shopping-cart"></i> Processing</a>
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-status-update')?>?orderID=<?= $order->order_id ?>&status=packed"><i class="ti-bag"></i> Packed</a>
                                                                                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-close"></i> Cancel</a>
                                                                                        <div class="dropdown-divider"></div>
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-detail')?>?orderID=<?= $order->order_id ?>&qtype=view" target="_blank"><i class="ti-eye"></i> View Detail</a>
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-invoice')?>?orderID=<?= $order->order_id ?>&qtype=invoice" target="_blank"><i class="ti-printer"></i> Print Bill</a>
                                                                                    </div>
                                                                                </div> 
                                                                            </td>
                                                                            <td><?= $order->user_name ?></td>
                                                                            <td>#<?= $order->order_id ?></td>
                                                                            <td> <img src="<?= base_url() ?>uploads/products/thumbs/<?= $filename?>-50x50.<?= $file_ext ?>" alt="iMac" width="50"> </td>
                                                                            <td><?= $order->product_name ?></td>
                                                                            <td><?= $order->order_qty ?></td>
                                                                            <td><?= $order->order_created_on ?></td>
                                                                            <td> 
                                                                                <span style="font-size: 13px;font-weight: 600;" class="label label-default font-weight-600 text-dark"><?= $order->order_payment_mode?></span> 
                                                                            </td> 
                                                                        </tr>
                                                                    <?php } } } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
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
                                                        <div class="table-responsive1">
                                                            <table class="table table-striped table-bordered product-overview zero_config" id="zero_config">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Actions</th>
                                                                        <th>Customer</th>
                                                                        <th>Order ID</th>
                                                                        <th>Photo</th>
                                                                        <th>Product</th>
                                                                        <th>Quantity</th>
                                                                        <th>Date</th>
                                                                        <th>Payment Mode</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php if($orders){ foreach($orders as $order){ 

                                                                        if($order->order_status == 'processing'){
                                                                        $filename= pathinfo($order->combination_image,PATHINFO_FILENAME);
                                                                        $file_ext = pathinfo($order->combination_image,PATHINFO_EXTENSION);
                                                                    ?>
                                                                        <tr>
                                                                            <td> 
                                                                                <div class="btn-group">
                                                                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        <i class="ti-settings"></i>
                                                                                    </button>
                                                                                    <div class="dropdown-menu animated slideInUp" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 0px, 0px);">
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-status-update')?>?orderID=<?= $order->order_id ?>&status=packed"><i class="ti-bag"></i> Packed</a>
                                                                                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-close"></i> Cancel</a>
                                                                                        <div class="dropdown-divider"></div>
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-detail')?>?orderID=<?= $order->order_id ?>&qtype=view" target="_blank"><i class="ti-eye"></i> View Detail</a>
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-invoice')?>?orderID=<?= $order->order_id ?>&qtype=invoice" target="_blank"><i class="ti-printer"></i> Print Bill</a>
                                                                                    </div>
                                                                                </div> 
                                                                            </td>
                                                                            <td><?= $order->user_name ?></td>
                                                                            <td>#<?= $order->order_id ?></td>
                                                                            <td> <img src="<?= base_url() ?>uploads/products/thumbs/<?= $filename?>-50x50.<?= $file_ext ?>" alt="iMac" width="50"> </td>
                                                                            <td><?= $order->product_name ?></td>
                                                                            <td><?= $order->order_qty ?></td>
                                                                            <td><?= $order->order_created_on ?></td>
                                                                            <td> 
                                                                                <span style="font-size: 13px;font-weight: 600;" class="label label-default font-weight-600 text-dark"><?= $order->order_payment_mode?></span> 
                                                                            </td> 
                                                                        </tr>
                                                                    <?php } } } ?>
                                                        
                                                                </tbody>
                                                            </table>
                                                        </div>
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

                                     <!-- 
                                    ============================================================================
                                    ============================================================================
                                                        Packed Order Tab Data From Here
                                    ============================================================================
                                    ============================================================================
                                     -->
                                    <div class="tab-pane p-20" id="packed" role="tabpanel">
                                        <div class="row">
                                            <!-- Column -->
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="table-responsive1">
                                                            <table class="table table-striped table-bordered product-overview zero_config" id="zero_config">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Actions</th>
                                                                        <th>Customer</th>
                                                                        <th>Order ID</th>
                                                                        <th>Photo</th>
                                                                        <th>Product</th>
                                                                        <th>Quantity</th>
                                                                        <th>Date</th>
                                                                        <th>Payment Mode</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php if($orders){ foreach($orders as $order){ 

                                                                        if($order->order_status == 'packed'){
                                                                        $filename= pathinfo($order->combination_image,PATHINFO_FILENAME);
                                                                        $file_ext = pathinfo($order->combination_image,PATHINFO_EXTENSION);
                                                                    ?>
                                                                        <tr>
                                                                            <td> 
                                                                                <div class="btn-group">
                                                                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        <i class="ti-settings"></i>
                                                                                    </button>
                                                                                    <div class="dropdown-menu animated slideInUp" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 0px, 0px);">
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-status-update')?>?orderID=<?= $order->order_id ?>&status=shipped"><i class="ti-bag"></i> Shipped</a>
                                                                                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-close"></i> Cancel</a>
                                                                                        <div class="dropdown-divider"></div>
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-detail')?>?orderID=<?= $order->order_id ?>&qtype=view" target="_blank"><i class="ti-eye"></i> View Detail</a>
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-invoice')?>?orderID=<?= $order->order_id ?>&qtype=invoice" target="_blank"><i class="ti-printer"></i> Print Bill</a>
                                                                                    </div>
                                                                                </div> 
                                                                            </td>
                                                                            <td><?= $order->user_name ?></td>
                                                                            <td>#<?= $order->order_id ?></td>
                                                                            <td> <img src="<?= base_url() ?>uploads/products/thumbs/<?= $filename?>-50x50.<?= $file_ext ?>" alt="iMac" width="50"> </td>
                                                                            <td><?= $order->product_name ?></td>
                                                                            <td><?= $order->order_qty ?></td>
                                                                            <td><?= $order->order_created_on ?></td>
                                                                            <td> 
                                                                                <span style="font-size: 13px;font-weight: 600;" class="label label-default font-weight-600 text-dark"><?= $order->order_payment_mode?></span> 
                                                                            </td> 
                                                                        </tr>
                                                                    <?php } } } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Column -->
                                        </div>
                                    </div>

                                    <!-- 
                                    ============================================================================
                                    ============================================================================
                                                        Packed Order Tab Data From Here
                                    ============================================================================
                                    ============================================================================
                                     -->

                                     <!-- 
                                    ============================================================================
                                    ============================================================================
                                                        Shipped Order Tab Data From Here
                                    ============================================================================
                                    ============================================================================
                                     -->

                                    <div class="tab-pane p-20" id="shipped" role="tabpanel">
                                        <div class="row">
                                            <!-- Column -->
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="table-responsive1">
                                                            <table class="table table-striped table-bordered product-overview zero_config" id="zero_config">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Actions</th>
                                                                        <th>Customer</th>
                                                                        <th>Order ID</th>
                                                                        <th>Photo</th>
                                                                        <th>Product</th>
                                                                        <th>Quantity</th>
                                                                        <th>Date</th>
                                                                        <th>Payment Mode</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php if($orders){ foreach($orders as $order){ 

                                                                        if($order->order_status == 'shipped'){
                                                                        $filename= pathinfo($order->combination_image,PATHINFO_FILENAME);
                                                                        $file_ext = pathinfo($order->combination_image,PATHINFO_EXTENSION);
                                                                    ?>
                                                                        <tr>
                                                                            <td> 
                                                                                <div class="btn-group">
                                                                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        <i class="ti-settings"></i>
                                                                                    </button>
                                                                                    <div class="dropdown-menu animated slideInUp" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 0px, 0px);">
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-status-update')?>?orderID=<?= $order->order_id ?>&status=delivered"><i class="ti-bag"></i> Delivered</a>
                                                                                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-close"></i> Cancel</a>
                                                                                        <div class="dropdown-divider"></div>
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-detail')?>?orderID=<?= $order->order_id ?>&qtype=view" target="_blank"><i class="ti-eye"></i> View Detail</a>
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-invoice')?>?orderID=<?= $order->order_id ?>&qtype=invoice" target="_blank"><i class="ti-printer"></i> Print Bill</a>
                                                                                    </div>
                                                                                </div> 
                                                                            </td>
                                                                            <td><?= $order->user_name ?></td>
                                                                            <td>#<?= $order->order_id ?></td>
                                                                            <td> <img src="<?= base_url() ?>uploads/products/thumbs/<?= $filename?>-50x50.<?= $file_ext ?>" alt="iMac" width="50"> </td>
                                                                            <td><?= $order->product_name ?></td>
                                                                            <td><?= $order->order_qty ?></td>
                                                                            <td><?= $order->order_created_on ?></td>
                                                                            <td> 
                                                                                <span style="font-size: 13px;font-weight: 600;" class="label label-default font-weight-600 text-dark"><?= $order->order_payment_mode?></span> 
                                                                            </td> 
                                                                        </tr>
                                                                    <?php } } } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Column -->
                                        </div>
                                    </div>

                                    <!-- 
                                    ============================================================================
                                    ============================================================================
                                                        Shipped Order Tab Data From Here
                                    ============================================================================
                                    ============================================================================
                                     -->

                                     <!-- 
                                    ============================================================================
                                    ============================================================================
                                                        Delivered Order Tab Data From Here
                                    ============================================================================
                                    ============================================================================
                                     -->
                                    <div class="tab-pane  p-20" id="delivered" role="tabpanel">
                                        <div class="row">
                                            <!-- Column -->
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="table-responsive1">
                                                            <table class="table table-striped table-bordered product-overview zero_config" id="zero_config">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Actions</th>
                                                                        <th>Customer</th>
                                                                        <th>Order ID</th>
                                                                        <th>Photo</th>
                                                                        <th>Product</th>
                                                                        <th>Quantity</th>
                                                                        <th>Date</th>
                                                                        <th>Payment Mode</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php if($orders){ foreach($orders as $order){ 

                                                                        if($order->order_status == 'delivered'){
                                                                        $filename= pathinfo($order->combination_image,PATHINFO_FILENAME);
                                                                        $file_ext = pathinfo($order->combination_image,PATHINFO_EXTENSION);
                                                                    ?>
                                                                        <tr>
                                                                            <td> 
                                                                                <div class="btn-group">
                                                                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        <i class="ti-settings"></i>
                                                                                    </button>
                                                                                    <div class="dropdown-menu animated slideInUp" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 0px, 0px);">
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-detail')?>?orderID=<?= $order->order_id ?>&qtype=view" target="_blank"><i class="ti-eye"></i> View Detail</a>
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-invoice')?>?orderID=<?= $order->order_id ?>&qtype=invoice" target="_blank"><i class="ti-printer"></i> Print Bill</a>
                                                                                    </div>
                                                                                </div> 
                                                                            </td>
                                                                            <td><?= $order->user_name ?></td>
                                                                            <td>#<?= $order->order_id ?></td>
                                                                            <td> <img src="<?= base_url() ?>uploads/products/thumbs/<?= $filename?>-50x50.<?= $file_ext ?>" alt="iMac" width="50"> </td>
                                                                            <td><?= $order->product_name ?></td>
                                                                            <td><?= $order->order_qty ?></td>
                                                                            <td><?= $order->order_created_on ?></td>
                                                                            <td> 
                                                                                <span style="font-size: 13px;font-weight: 600;" class="label label-default font-weight-600 text-dark"><?= $order->order_payment_mode?></span> 
                                                                            </td> 
                                                                        </tr>
                                                                    <?php } } } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Column -->
                                        </div>
                                    </div>

                                    <!-- 
                                    ============================================================================
                                    ============================================================================
                                                        Delivered Order Tab Data From Here
                                    ============================================================================
                                    ============================================================================
                                     -->

                                     <!-- 
                                    ============================================================================
                                    ============================================================================
                                                        Cancel Order Tab Data From Here
                                    ============================================================================
                                    ============================================================================
                                     -->

                                    <div class="tab-pane p-20" id="cancel" role="tabpanel">
                                        <div class="row">
                                            <!-- Column -->
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="table-responsive1">
                                                            <table class="table table-striped table-bordered product-overview zero_config" id="zero_config">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Actions</th>
                                                                        <th>Customer</th>
                                                                        <th>Order ID</th>
                                                                        <th>Photo</th>
                                                                        <th>Product</th>
                                                                        <th>Quantity</th>
                                                                        <th>Date</th>
                                                                        <th>Payment Mode</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php if($orders){ foreach($orders as $order){ 

                                                                        if($order->order_status == 'canceled'){
                                                                        $filename= pathinfo($order->combination_image,PATHINFO_FILENAME);
                                                                        $file_ext = pathinfo($order->combination_image,PATHINFO_EXTENSION);
                                                                    ?>
                                                                        <tr>
                                                                            <td> 
                                                                                <div class="btn-group">
                                                                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        <i class="ti-settings"></i>
                                                                                    </button>
                                                                                    <div class="dropdown-menu animated slideInUp" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 0px, 0px);">
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-detail')?>?orderID=<?= $order->order_id ?>&qtype=view" target="_blank"><i class="ti-eye"></i> View Detail</a>
                                                                                        <a class="dropdown-item" href="<?= site_url('admin/orders/order-invoice')?>?orderID=<?= $order->order_id ?>&qtype=invoice" target="_blank"><i class="ti-printer"></i> Print Bill</a>
                                                                                    </div>
                                                                                </div> 
                                                                            </td>
                                                                            <td><?= $order->user_name ?></td>
                                                                            <td>#<?= $order->order_id ?></td>
                                                                            <td> <img src="<?= base_url() ?>uploads/products/thumbs/<?= $filename?>-50x50.<?= $file_ext ?>" alt="iMac" width="50"> </td>
                                                                            <td><?= $order->product_name ?></td>
                                                                            <td><?= $order->order_qty ?></td>
                                                                            <td><?= $order->order_created_on ?></td>
                                                                            <td> 
                                                                                <span style="font-size: 13px;font-weight: 600;" class="label label-default font-weight-600 text-dark"><?= $order->order_payment_mode?></span> 
                                                                            </td> 
                                                                        </tr>
                                                                    <?php } } } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Column -->
                                        </div>
                                    </div>

                                    <!-- 
                                    ============================================================================
                                    ============================================================================
                                                        Cancel Order Tab Data From Here
                                    ============================================================================
                                    ============================================================================
                                     -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
