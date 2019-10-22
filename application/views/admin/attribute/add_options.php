
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
                        <h4 class="page-title">Attribute Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= site_url('admin/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Attributes Options</li>
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
                            <form class="" id="attributeOptionForm" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Add Attribute Option</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="attributeOptionName" class="control-label col-form-label">Attribute Option Name</label>
                                                <input type="text" class="form-control" name="attributeOptionName" id="attributeOptionName" aria-describedby="name" placeholder="Attribute Option Name">
                                                <input type="hidden" name="attributeOptionId" id="attributeOptionId">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="attributeOptionDisplayName" class="control-label col-form-label">Option Display Name</label>
                                                <input type="text" class="form-control" name="attributeOptionDisplayName" id="attributeOptionDisplayName" aria-describedby="name" placeholder="Option Display Name">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Select Attribute</label>
                                                <select class="custom-select col-12" id="attributeName" name="attributeName">
                                                    <option selected="" value="">Choose...</option>
                                                    <?php if($attributes){ foreach($attributes as $att){ ?>
                                                        <option value="<?= $att->attribute_id ?>"><?= $att->attribute_name ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Option Type</label>
                                                <select class="custom-select col-12" id="optionType" name="optionType">
                                                    <option selected="" value="">Choose...</option>
                                                    <option value="color">Color</option>
                                                    <option value="text">Text</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="attributeOptionName" class="control-label col-form-label">Attribute Option Value</label>
                                                <input type="text" id="opacity" class="form-control" name="optionValue" placeholder="Option Value">
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
                                <h4 class="card-title">Attribute Option Listing</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="bg-inverse text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Option Value</th>
                                                <th>Option Name</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($attributeOptions){ $i = 1; foreach($attributeOptions as $option){
                                            ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td>
                                                    <?php 
                                                        if($option->option_type == 'color'){
                                                            echo '<div style="height:20px;width:20px;border : 1px solid #000; background-color : '.$option->option_value.'"></div>';
                                                        }else{
                                                            echo $option->option_value;
                                                        }
                                                    ?>
                                                </td>
                                                <td><?= $option->option_name ?></td>
                                                
                                                <td>
                                                    <a href="javascript:void(0)" class="text-inverse p-r-10 editOption" data-toggle="tooltip" title="" data-original-title="Edit" data-id="<?= $option->option_id ?>"><i class="ti-marker-alt"></i></a>
                                                    <?php if($option->option_status == 1){ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disableOption" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $option->option_id ?>"  data-status="0"><i class="ti-trash"></i></a>
                                                    <?php }else{ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disableOption" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $option->option_id ?>"  data-status="1"><i class="ti-check-box"></i></a>
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