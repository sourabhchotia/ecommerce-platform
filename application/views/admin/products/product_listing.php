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
                                    <? $error = $this->session->flashdata('error'); foreach ($error as $value) {
                                        echo $value;
                                    } ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                </div>
                            <?php } ?>
                        </div>
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="form-group col-3">
                                                    <div class="input-group">
                                                       <input type="text" name="fromDate" id="fromDate" class="form-control datepicker" placeholder="Date From" >
                                                   </div>
                                               </div>
                                               <div class="form-group col-3">
                                                <div class="input-group">
                                                    <input type="text" name="ToDate" id="ToDate" class="form-control datepicker" placeholder="Date To">  

                                                </div>
                                            </div>                   
                                            <div class="form-group col-3">
                                                <div class="input-group">

                                                    <input type="text" class="form-control article_code ui-autocomplete-input ui-corner-all" placeholder="Artical Number" autocomplete="off" name="art_id" id="art_id"> 
                                                </div>
                                            </div>
                                            <div class="form-group col-3">
                                                <button type="button" name="customSearch" id="customSearch" class="btn btn-success m-r-10">Search</button>
                                            </div>

                                        </div>
                                    </form>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table product-overview" id="empTable">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px;"><div class="form-check form-check-inline">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input checkbox" id="selectAll">
                                                            <label class="custom-control-label" for="selectAll"></label>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th>Image</th>
                                                <th>SKU</th>
                                                <th>Name</th>
                                                <th>Catgegory</th>
                                                <th>MRP</th>
                                                <th>Sale Price</th>
                                                <th>Stock</th>
                                                
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
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