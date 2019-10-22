
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
                        <h4 class="page-title">Slider Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= site_url('admin/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Slider Management</li>
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
                            <form class="" id="sliderForm" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Add Slider</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="sliderheading" class="control-label col-form-label">Slider Heading</label>
                                                <input type="text" class="form-control" name="sliderheading" id="sliderheading" aria-describedby="name" placeholder="Slider Heading">
                                                <input type="hidden" name="sliderId" id="sliderId">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="sliderCaption" class="control-label col-form-label">Slider Caption</label>
                                                <input type="text" class="form-control" name="sliderCaption" id="sliderCaption" aria-describedby="name" placeholder="Slider Caption">
                                                
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="sliderButtonText" class="control-label col-form-label">Slider Button Text</label>
                                                <input class="form-control" name="sliderButtonText" id="sliderButtonText" placeholder="Slider Button Text" aria-describedby="name">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="sliderURL" class="control-label col-form-label">Slider Page URL</label>
                                                <input class="form-control" name="sliderURL" id="sliderURL" placeholder="Slider Page URL" aria-describedby="name">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                             <label for="sliderURL" class="control-label col-form-label">Slider Image</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="sliderImage" name="sliderImage">
                                                    <label class="custom-file-label" for="sliderImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <img id="sliderImagePreview" src="<?= base_url() ?>assets/user/images/hero/bread-1.jpg" width="300">
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
                                <h4 class="card-title">Page Listing</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="bg-inverse text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Slider Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($sliders){ $i = 1; foreach($sliders as $slider){
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $i ?>
                                                </td>
                                                <td>
                                                    <img class="img-fluid" width="300" src="<?= site_url() ?>uploads/sliders/<?= $slider->slider_image ?>">
                                                </td>
                                                <td>
                                                    <?php if($slider->slider_status == 1){ ?>
                                                        <span class="label label-success">Active</span>
                                                    <?php }else{ ?>
                                                        <span class="label label-danger">Inactive</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="text-inverse p-r-10 editSlider" data-toggle="tooltip" title="" data-original-title="Edit" data-id="<?= $slider->slider_id ?>"><i class="ti-marker-alt"></i></a>
                                                    <?php if($slider->slider_status == 1){ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disableSlider" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $slider->slider_id ?>"  data-status="0"><i class="ti-trash"></i></a>
                                                    <?php }else{ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disableSlider" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $slider->slider_id ?>"  data-status="1"><i class="ti-check-box"></i></a>
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