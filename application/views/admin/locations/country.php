
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
                                    <li class="breadcrumb-item active" aria-current="page">Country</li>
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
                            <form class="" id="countryForm" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Add Country</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="attributeName" class="control-label col-form-label">Country Name</label>
                                                <input type="text" class="form-control" name="countryName" id="countryName" aria-describedby="name" placeholder="Country Name" required="">
                                                <input type="hidden" name="countryId" id="countryId">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="attributeName" class="control-label col-form-label">Country Short Name</label>
                                                <input type="text" class="form-control" name="countryShortName" id="countryShortName" aria-describedby="name" placeholder="Country Short Name">
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
                                <h4 class="card-title">Country Listing</h4>

                                <div class="table-responsive">
                                    <table class="table zero_config">
                                        <thead class="bg-inverse text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Country Name</th>
                                                <th>Short Name</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($countries){ $i = 1; foreach($countries as $country){
                                            ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $country->country_name ?></td>
                                                <td><?= $country->country_shortname ?></td>
                                                <td><?php if($admins){ foreach($admins as $admin){ 
                                                            if($admin->admin_id == $country->country_created_by){
                                                                echo $admin->admin_display_name;
                                                            }
                                                    } } ?>
                                                        
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="text-inverse p-r-10 editCountry" data-toggle="tooltip" title="" data-original-title="Edit" data-id="<?= $country->country_id ?>"><i class="ti-marker-alt"></i></a>
                                                    <?php if($country->country_status == 1){ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disableCountry" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $country->country_id ?>"  data-status="0"><i class="ti-trash"></i></a>
                                                    <?php }else{ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disableCountry" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $country->country_id ?>"  data-status="1"><i class="ti-check-box"></i></a>
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