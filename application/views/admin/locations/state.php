
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
                                    <li class="breadcrumb-item active" aria-current="page">State</li>
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
                            <form class="" id="stateForm" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Add State</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="attributeName" class="control-label col-form-label">State Name</label>
                                                <input type="text" class="form-control" name="stateName" id="stateName" aria-describedby="name" placeholder="State Name" required="">
                                                <input type="hidden" name="stateId" id="stateId">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="attributeName" class="control-label col-form-label">State Short Name</label>
                                                <input type="text" class="form-control" name="stateShortName" id="stateShortName" aria-describedby="name" placeholder="State Short Name" >
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Select Country</label>
                                                <select class="custom-select col-12" id="stateCountry" name="stateCountry" required="">
                                                    <option selected="" value="">Choose...</option>
                                                    <?php if($countries){ foreach($countries as $country){ ?>
                                                        <option value="<?= $country->country_id ?>"><?= $country->country_name ?> (<?= $country->country_shortname ?>)</option>
                                                    <?php } } ?>
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
                                <h4 class="card-title">State Listing</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="bg-inverse text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>State Name</th>
                                                <th>Short Name</th>
                                                <th>Country</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($states){ $i = 1; foreach($states as $state){
                                            ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $state->state_name ?></td>
                                                <td><?= $state->state_short_name ?></td>
                                                <td><?php if($admins){ foreach($admins as $admin){ 
                                                            if($admin->admin_id == $state->state_created_by){
                                                                echo $admin->admin_display_name;
                                                            }
                                                    } } ?>
                                                        
                                                </td>
                                                <td><?php if($countries){ foreach($countries as $country){ 
                                                            if($country->country_id == $state->state_country_code){
                                                                echo $country->country_name.' ('.$country->country_shortname.')';
                                                            }
                                                    } } ?>
                                                        
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="text-inverse p-r-10 editState" data-toggle="tooltip" title="" data-original-title="Edit" data-id="<?= $state->state_id ?>"><i class="ti-marker-alt"></i></a>
                                                    <?php if($state->state_status == 1){ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disableState" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $state->state_id ?>"  data-status="0"><i class="ti-trash"></i></a>
                                                    <?php }else{ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disableState" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $state->state_id ?>"  data-status="1"><i class="ti-check-box"></i></a>
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