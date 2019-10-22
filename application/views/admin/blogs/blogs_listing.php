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
                        <h4 class="page-title">Invoice List</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Invoice List</li>
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
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
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
                                                        <input type="text" class="form-control article_code ui-autocomplete-input ui-corner-all" placeholder="Category" autocomplete="off"> 
                                                        <input type="hidden" name="category_id" id="category_id">
                                                    </div>
                                                </div>
                                                <div class="form-group col-3">
                                                    <button type="button" name="customSearch" id="customSearch" class="btn btn-success m-r-10">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Blogs Listing</h4>
                                <div class="table-responsive">
                                    <table id="empTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Tags</th>
                                                <th>Short Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

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