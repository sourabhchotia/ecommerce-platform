
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
                        <h4 class="page-title">Category Management</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= site_url('admin/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Main Category</li>
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
                            <form class="" id="categoryForm" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Add Main Category</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="categoryName" class="control-label col-form-label">Main Category Name</label>
                                                <input type="text" class="form-control" name="categoryName" id="categoryName" aria-describedby="name" placeholder="Category Name">
                                                <input type="hidden" name="categoryId" id="categoryId">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Select Parent Category</label>
                                                <select class="custom-select col-12" id="parentCat" name="parentCategory">
                                                    <option selected="" value="">Choose...</option>
                                                    <?php if($categories){ foreach($categories as $cat){ ?>
                                                        <option value="<?= $cat->category_id ?>"><?= $cat->category_name ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="meta_title" class="control-label col-form-label">Meta Title</label>
                                                <input type="text" class="form-control" name="meta_title" id="meta_title" aria-describedby="name" placeholder="Meta Title">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="meta_keywords" class="control-label col-form-label">Meta Keywords</label>
                                                <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" aria-describedby="name" placeholder="Meta Keywords">
                                                
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="meta_description" class="control-label col-form-label">Meta Description</label>
                                                <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Meta Description" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="categoryImage" name="categoryImage">
                                                    <label class="custom-file-label" for="categoryImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <img id="categoryImagePreview" src="<?= site_url() ?>assets/images/gallery/chair.png" width="80">
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
                                <h4 class="card-title">Main Category Listing</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="bg-inverse text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Category Name</th>
                                                <th>Parent Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($mainCategories){ foreach($mainCategories as $cat){ 
                                                $filename= pathinfo($cat->category_image,PATHINFO_FILENAME);
                                                $file_ext = pathinfo($cat->category_image,PATHINFO_EXTENSION);
                                            ?>
                                            <tr>
                                                <td>
                                                    <img src="<?= site_url() ?>uploads/category/thumbs/<?= $filename ?>-50x50.<?= $file_ext ?>" alt="iMac">
                                                </td>
                                                <td><?= $cat->category_name ?></td>
                                                <td><?php if($categories){ foreach($categories as $category){ 
                                                            if($category->category_id == $cat->parent_category){
                                                                echo $category->category_name;
                                                            }
                                                    } } ?>
                                                        
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="text-inverse p-r-10 edit" data-toggle="tooltip" title="" data-original-title="Edit" data-id="<?= $cat->category_id ?>"><i class="ti-marker-alt"></i></a>
                                                    <?php if($cat->category_status == 1){ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disable" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $cat->category_id ?>"  data-status="0"><i class="ti-trash"></i></a>
                                                    <?php }else{ ?>
                                                        <a href="javascript:void(0)" class="text-inverse p-r-10 disable" data-toggle="tooltip" title="" data-original-title="Disable" data-id="<?= $cat->category_id ?>"  data-status="1"><i class="ti-check-box"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php } } ?>
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