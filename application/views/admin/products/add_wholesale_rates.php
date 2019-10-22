
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
                        <h4 class="page-title">Wholesale Rate Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= site_url('admin/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Wholesale Rate Management</li>
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
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="card">
                            <form class="" id="wholesaleRateForm" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Add Wholesale Rate</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="wholesaleProduct" class="control-label col-form-label">Select Product</label>
                                                <input type="text" class="form-control" name="wholesaleProduct" id="wholesaleProduct" aria-describedby="name">
                                                <input type="hidden" name="wholesaleProductId" id="wholesaleProductId">
                                                <input type="hidden" name="wholesaleRateId" id="wholesaleRateId">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="startQty" class="control-label col-form-label">Quantity Starting Point</label>
                                                <input type="text" class="form-control" name="startQty" id="startQty" aria-describedby="name" placeholder="Quantity Starting Point">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="endQty" class="control-label col-form-label">Quantity End Point</label>
                                                <input type="text" class="form-control" name="endQty" id="endQty" aria-describedby="name" placeholder="Quantity End Point">
                                                
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="wholesalePrice" class="control-label col-form-label">Sale Price</label>
                                                <input type="text" class="form-control" name="wholesalePrice" id="wholesalePrice" aria-describedby="name" placeholder="Sale Price">
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
                    <div class="col-sm-12 col-md-6 col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Wholesale Rate Listing</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="bg-inverse text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th>Start Quantity</th>
                                                <th>End Quantity</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($wholealeRates){ $i = 1; foreach($wholealeRates as $rate){ 

                                                $filename= pathinfo($rate->product_image,PATHINFO_FILENAME);
                                                $file_ext = pathinfo($rate->product_image,PATHINFO_EXTENSION);
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php if(!empty($filename)){ ?>
                                                        <img src="<?= site_url() ?>uploads/products/thumbs/<?= $filename ?>-50x50.<?= $file_ext ?>" alt="iMac">
                                                    <?php }else{ echo $i; } ?>
                                                        
                                                </td>
                                                <td><?= $rate->product_name ?></td>
                                                <td><?= $rate->rate_start_qty ?></td>
                                                <td><?= $rate->rate_end_qty ?></td>
                                                <td><?= $rate->rate_price ?></td>
                                                <td>
                                                    <a href="javascript:void(0)" class="text-inverse p-r-10 editRate" data-toggle="tooltip" title="" data-original-title="Edit" data-id="<?= $rate->rate_id ?>"><i class="ti-marker-alt"></i></a>
                                                    <a href="javascript:void(0)" class="text-inverse p-r-10 deleteRate" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $rate->rate_id ?>"  data-status="0"><i class="ti-trash"></i></a>
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