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
                        <h4 class="page-title">Product Orders</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Product Orders</li>
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
                                    <?php $error = $this->session->flashdata('error'); foreach ($error as $value) {
                                        echo $value.'<br>';
                                    } ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                </div>
                            <?php } ?>
                        </div>
                    <!-- Column -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-self-center">
                                    <div class="col-12 d-flex align-items-center justify-content-center" style="flex-direction: column;">
                                        <h4 class="card-title m-b-20">Import Product</h4>
                                        <form class="d-flex align-items-center justify-content-center" style="flex-direction: column;" id="importForm" action="<?= site_url('admin/products/import-products') ?>" method="post" enctype="multipart/form-data">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select class="custom-select col-12" id="parentCat" name="parentCategory" >
                                                        <option>Select Parent Category</option>
                                                       <?php if($categories){ foreach($categories as $cat){ ?>
                                                            <option value="<?= $cat->category_id ?>"><?= $cat->category_name ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select class="custom-select col-12" id="mainCat" name="mainCategory" required="">
                                                        <option value="">Select Main Category</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select class="custom-select col-12" id="subCat" name="subCategory">
                                                        <option value="">Select Sub Category</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select class="custom-select col-12" id="innerCat" name="innerCategory">
                                                        <option value="">Select inner Category</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="importFile" name="importFile">
                                                        <label class="custom-file-label" for="importFile">Choose file</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <span id="importFilePreview"></span>
                                                </div>
                                            </div>

                                            <div class="action-form">
                                                <div class="form-group m-b-0 text-right">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Import</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-self-center">
                                    <div class="col-12 d-flex align-items-center justify-content-center" style="flex-direction: column;">
                                        <h4 class="card-title m-b-20">Export Product</h4>
                                        <form class="d-flex align-items-center justify-content-center" style="flex-direction: column;" id="exportForm1" action="<?= site_url('admin/products/export-products') ?>" method="post">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select class="custom-select col-12" id="parentCatOne" name="parentCategory">
                                                        <option value="">Select Parent Category</option>
                                                       <?php if($categories){ foreach($categories as $cat){ ?>
                                                            <option value="<?= $cat->category_id ?>"><?= $cat->category_name ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select class="custom-select col-12" id="mainCatOne" name="mainCategory" required="">
                                                        <option value="">Select Main Category</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select class="custom-select col-12" id="subCatOne" name="subCategory">
                                                        <option value="">Select Sub Category</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select class="custom-select col-12" id="innerCatOne" name="innerCategory">
                                                        <option value="">Select inner Category</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="action-form">
                                                <div class="form-group m-b-0 text-right">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Export</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
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