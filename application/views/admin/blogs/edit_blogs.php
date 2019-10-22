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
                        <h4 class="page-title">Product Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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
                <form id="UpdateblogForm" action="<?= site_url('admin/blogs/update-blog') ?>" method="post" enctype="multipart/form-data">
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
                                    <?= $this->session->flashdata('error'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- Column -->
                        <div class="col-lg-8">
                            <div class="form-body">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">About Blog</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Blog Name</label>
                                                    <input type="text" id="blogName" name="blogName" class="form-control" placeholder="Blog Name" value="<?= $blog->blog_name ?>"> </div>
                                                    <input type="hidden" name="blog_id" value="<?= $blog->blog_id  ?>">
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Category</label>
                                                    <select class="custom-select col-12" id="blogCategory" name="blogCategory">
                                                        
                                                       <?php if($categories){ foreach($categories as $cat){ 
                                                                if($blog->blog_category == $cat->category_id)
                                                        ?>
                                                            <option value="<?= $cat->category_id ?>" selected=""><?= $cat->category_name ?></option>
                                                        <?php } } ?>

                                                        <option value="">Choose...</option>

                                                        <?php if($categories){ foreach($categories as $cat){ 
                                                                if($blog->blog_category != $cat->category_id)
                                                        ?>
                                                            <option value="<?= $cat->category_id ?>" selected=""><?= $cat->category_name ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Tags</label>
                                                    <select class="form-control" multiple="" id="blogTags" name="blogTags[]" style="width: 100%;height: 36px;">

                                                        <?php $tags = explode(', ', $blog->blog_tags); foreach($tags as $tag){ ?>
                                                            <option value="<?= $tag ?>" selected=""><?= $tag ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title m-t-40">Blog Description</h5>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="8" placeholder="Blog Description" name="description" id="editor"><?= $blog->blog_description ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="4" placeholder="Blog Short Description" name="shortDescription"><?= $blog->blog_short_description ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Meta Title</label>
                                                    <input type="text" class="form-control" name="metaTitle" value="<?= $blog->blog_meta_title ?>"> </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Meta Keyword</label>
                                                    <input type="text" class="form-control" name="metaDescription" value="<?= $blog->blog_meta_keywords ?>"> </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- Column -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title m-b-10">Blog Feature Image</h4>
                                    <div class="row">
                                        <div class="col-12 m-b-10">

                                            <?php if($blog->blog_image != ''){ 
                                                $filename= pathinfo($blog->blog_image,PATHINFO_FILENAME);
                                                $file_ext = pathinfo($blog->blog_image,PATHINFO_EXTENSION);
                                            ?>
                                                <img id="categoryImagePreview" class="img-responsive" src="<?= site_url() ?>uploads/blogs/thumbs/<?= $filename ?>-200x350.<?= $file_ext ?>" style="width: 60%">
                                            <?php }else{ ?>
                                                <img id="categoryImagePreview" class="img-responsive" src="<?= site_url() ?>assets/images/gallery/chair.png" style="width: 60%">
                                            <?php } ?>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="categoryImage" name="categoryImage" >
                                                    <label class="custom-file-label" for="categoryImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title m-b-10">Blog Gallery Images</h4>
                                    <div class="row">
                                        <div class="col-12" id="image_preview">
                                            <?php if($blog->blog_gallery != ''){ 
                                                $gallery = explode(',', $blog->blog_gallery);
                                                foreach($gallery as $img){
                                                    $filename= pathinfo($img,PATHINFO_FILENAME);
                                                    $file_ext = pathinfo($img,PATHINFO_EXTENSION);
                                            ?>
                                                <img id="categoryImagePreview" class="img-responsive" src="<?= site_url() ?>uploads/blogs/thumbs/<?= $filename ?>-200x350.<?= $file_ext ?>" width="90" height="90">
                                            <?php } }else{ ?>
                                                <img id="categoryImagePreview" class="img-responsive" src="<?= site_url() ?>assets/images/gallery/chair.png" width="90" height="90">
                                            <?php } ?>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="gallerImage" name="gallerImage[]" multiple>
                                                    <label class="custom-file-label" for="gallerImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
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
            