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
                        <h4 class="page-title">Media Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Media</li>
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
                <form id="uploadMedia" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12" id="error">
                            
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title m-b-10">Upload Media</h4>
                                    <div class="row">
                                        <div class="col-12" id="image_preview">
                                            <img id="categoryImagePreview" class="img-responsive" src="<?= site_url() ?>assets/images/gallery/chair.png" width="90" height="90">
                                        </div>
                                    </div>
                                    <div class="action-form align-self-center">
                                        <div class="form-group m-b-0 d-flex align-items-center justify-content-center">
                                            <div class="input-group mb-3 col-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="gallerImage" name="gallerImage[]" multiple>
                                                    <label class="custom-file-label" for="gallerImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action-form">
                                        <div class="form-group m-b-0 text-center">
                                            <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                                            <button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

                <div class="row el-element-overlay">
                    <?php if($all_media){ foreach($all_media as $media){ 

                        $filename = pathinfo($media->image_name,PATHINFO_FILENAME);
                        $file_ext = pathinfo($media->image_name,PATHINFO_EXTENSION);
                    ?>
                    <div class="col-lg-2 col-md-4">
                        <div class="card">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1"> <img src="<?= base_url() ?>uploads/products/thumbs/<?=$filename?>-200x350.<?= $file_ext ?>" alt="user" />
                                    <div class="el-overlay">
                                        <ul class="list-style-none el-info">
                                            <li class="el-item">
                                                <a class="btn default btn-outline image-popup-vertical-fit el-link" href="<?= base_url() ?>uploads/products/thumbs/<?=$filename?>-500x700.<?= $file_ext ?>"><i class="icon-magnifier"></i></a>
                                            </li>
                                            <li class="el-item">
                                                <a class="btn default btn-outline el-link delete-media" data-id="<?= $media->media_id ?>" href="javascript:void(0);"><i class="icon-trash"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="el-card-content">
                                    <h4 class="m-b-0"><?= $media->image_name ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                </div>

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
                #image_preview img{
                    width: 90px;
                    margin: 5px;
                    border: 1px solid #ececec;
                    height: 90px;
                }
            </style>
            