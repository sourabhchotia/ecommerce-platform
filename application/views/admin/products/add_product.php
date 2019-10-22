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
                <form action="<?= site_url('admin/products/save-products') ?>" method="post" enctype="multipart/form-data" id="productForm">
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
                                        echo $value;
                                    } ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- Column -->
                        <div class="col-lg-8">
                            <div class="form-body">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">About Product</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Product Name</label>
                                                    <input type="text" id="productName" name="productName" class="form-control" placeholder="Product Name" required=""> </div>
                                            </div>
                                            <!--/span-->

                                            
                                        </div>
                                        <!--/row-->

                                        <div class="row">

                                            <div class="col-2">
                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input checkbox" id="is_filter" name="is_filter" value="1">
                                                        <label class="custom-control-label" for="is_filter">Fetaured?</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input checkbox" id="slider" name="slider" value="1">
                                                        <label class="custom-control-label" for="slider">Show on Slider?</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-check form-check-inline">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input checkbox" id="banner" name="banner" value="1">
                                                        <label class="custom-control-label" for="banner">Show on Banner?</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <select class="custom-select col-12" id="productType" name="productType" required="">
                                                        <option  value="">Product Type</option>
                                                        <option  value="retail">Retial</option>
                                                        <option  value="wholesale">Wholesale</option>
                                                        <option  value="both">Both</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Parent Category</label>
                                                    <select class="custom-select col-12 catChange" id="parentCat" name="parentCategory" required="">
                                                        <option selected="" value="">Choose...</option>
                                                       <?php if($categories){ foreach($categories as $cat){ ?>
                                                            <option value="<?= $cat->category_id ?>"><?= $cat->category_name ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Main Category</label>
                                                    <select class="custom-select col-12 catChange" id="mainCat" name="mainCategory">
                                                        <option  value="">Choose...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Sub Category</label>
                                                    <select class="custom-select col-12 catChange" id="subCat" name="subCategory">
                                                        <option  value="">Choose...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Inner Category</label>
                                                    <select class="custom-select col-12 catChange" id="innerCat" name="innerCategory">
                                                        <option value="">Choose...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Artical No.</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Artical Number" aria-label="price" aria-describedby="basic-addon1" name="articalNum" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>SKU Code</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="SKU Code" aria-label="price" aria-describedby="basic-addon1" name="skuCode" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>HSN Code</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="HSN Code" aria-label="price" aria-describedby="basic-addon1" name="hsnCode" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Brand</label>
                                                    <div class="input-group mb-3">
                                                        <select class="custom-select col-12" id="" name="brand" required="">
                                                            <option selected="" value="">Choose...</option>
                                                            <?php if($brands){ foreach($brands as $brand){?>
                                                                <option value="<?= $brand->brand_id ?>"><?= $brand->brand_name ?></option>
                                                            <?php } } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Regular Price</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"><i class="ti-money"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="price" aria-label="price" aria-describedby="basic-addon1" name="price" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Sale Price</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon2"><i class="ti-cut"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Discount" aria-label="Discount" aria-describedby="basic-addon2" name="salePrice" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Stock</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon3"><i class="ti-archive"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Stock" aria-label="Stock" aria-describedby="basic-addon3" name="stock" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Min. Qty</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Min. Qty" aria-label="Stock" aria-describedby="basic-addon3" name="minQty" required="">
                                                    </div>
                                                </div>
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
                                    <h4 class="card-title m-b-10">Product Main Image</h4>
                                    <div class="row">
                                        <div class="col-12 m-b-10">
                                            <img id="ProductImagePreview" class="img-responsive" src="<?= site_url() ?>assets/images/gallery/chair.png" style="width: 60%">
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="ProductImage" name="categoryImage" >
                                                    <label class="custom-file-label" for="ProductImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title m-b-10">Product Gallery Images</h4>
                                    <div class="row">
                                        <div class="col-12" id="image_preview">
                                            <img id="categoryImagePreview" class="img-responsive" src="<?= site_url() ?>assets/images/gallery/chair.png" width="90" height="90">
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
                                        <h5 class="card-title m-t-40">Product Description</h5>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="4" placeholder="Product Description" name="description" required=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="4" placeholder="Product Short Description" name="shortDescription"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Meta Title</label>
                                                    <input type="text" class="form-control" name="metaTitle"> </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Meta Keyword</label>
                                                    <input type="text" class="form-control" name="metakeywords"> </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Meta Description</label>
                                                    <input type="text" class="form-control" name="metaDescription"> </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h3 class="card-title m-t-40">Attributes</h3>
                                                        <span class="card-title">Leave Fields Blank in Case You dont want to create variations</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="action-form m-t-40">
                                                            <div class="form-group m-b-0 text-right">
                                                                <button type="button" class="btn btn-success waves-effect waves-light" disabled="" id="addMoreAttribute">Add More</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered td-padding">
                                                        <tbody id="generalInfo">

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <input type="hidden" name="totalAttributes" id="totalAttributes">
                                            </div>
                                        </div>
                                        <hr> 
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
            