
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
                        <h4 class="page-title">SEO Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= site_url('admin/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">SEO Management</li>
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
                            <form class="" id="seoForm" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Edit <span id="pageName"></span></h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="metatitle" class="control-label col-form-label">Meta Title</label>
                                                <input type="text" class="form-control" name="metatitle" id="metatitle" aria-describedby="name" placeholder="Meta Title">
                                                <input type="hidden" name="pageId" id="pageId">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="metakeywords" class="control-label col-form-label">Meta Keywords</label>
                                                <input type="text" class="form-control" name="metakeywords" id="metakeywords" aria-describedby="name" placeholder="Meta Keywords">
                                                
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="metadescription" class="control-label col-form-label">Meta Description</label>
                                                <textarea class="form-control" name="metadescription" id="metadescription" placeholder="Meta Description" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="bannerImage" name="bannerImage">
                                                    <label class="custom-file-label" for="bannerImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <img id="bannerImagePreview" src="<?= base_url() ?>assets/user/images/hero/bread-1.jpg" width="300">
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
                                                <th>Page Name</th>
                                                <!-- <th>Parent Category</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($pages){ $i = 1; foreach($pages as $page){
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $i ?>
                                                </td>
                                                <td><?= $page->page_name ?></td>
                                                <td>
                                                    <a href="javascript:void(0)" class="text-inverse p-r-10 editPage" data-toggle="tooltip" title="" data-original-title="Edit" data-id="<?= $page->page_id ?>"><i class="ti-marker-alt"></i></a>
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