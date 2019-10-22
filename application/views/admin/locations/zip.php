
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
                        <h4 class="page-title">Location Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= site_url('admin/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Zipcodes</li>
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
                            <form class="" id="zipcodeForm" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Add Zipcode</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="zipcode" class="control-label col-form-label">Zipcode</label>
                                                <input type="text" class="form-control" name="zipcode" id="zipcode" aria-describedby="name" placeholder="Zipcode" required="">
                                                <input type="hidden" name="zipcodeId" id="zipcodeId">
                                            </div>
                                        </div>
                                        <div class="col-12">
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
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Select State</label>
                                                <select class="custom-select col-12" id="cityState" name="cityState" required="">
                                                    <option selected="" value="">Choose...</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Select City</label>
                                                <select class="custom-select col-12" id="zipCity" name="zipCity" required="">
                                                    <option selected="" value="">Choose...</option>
                                                </select>
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
                                <h4 class="card-title">City Listing</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="bg-inverse text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Zipcode</th>
                                                <th>State</th>
                                                <th>City</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($zipcodes){ $i = 1; foreach($zipcodes as $zipcode){
                                            ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $zipcode->zip_code ?></td>
                                                <td><?php if($states){ foreach($states as $state){ 
                                                            if($state->state_id == $zipcode->zip_state){
                                                                echo $state->state_name;
                                                            }
                                                    } } ?>
                                                        
                                                </td>
                                                <td><?php if($cities){ foreach($cities as $city){ 
                                                            if($city->city_id == $zipcode->zip_city){
                                                                echo $city->city_name;
                                                            }
                                                    } } ?>
                                                        
                                                </td>
                                                <td><?php if($admins){ foreach($admins as $admin){ 
                                                            if($admin->admin_id == $zipcode->zip_created_by){
                                                                echo $admin->admin_display_name;
                                                            }
                                                    } } ?>
                                                        
                                                </td>

                                                <td>
                                                    <a href="javascript:void(0)" class="text-inverse p-r-10 editZipcode" data-toggle="tooltip" title="" data-original-title="Edit" data-id="<?= $zipcode->zip_id ?>"><i class="ti-marker-alt"></i></a>
                                                    <?php if($zipcode->zip_status == 1){ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disableZipcode" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $zipcode->zip_id ?>"  data-status="0"><i class="ti-trash"></i></a>
                                                    <?php }else{ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disableZipcode" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $zipcode->zip_id ?>"  data-status="1"><i class="ti-check-box"></i></a>
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