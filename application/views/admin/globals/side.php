<!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/dashboard')?>" aria-expanded="false">
                                <i class="mdi mdi-av-timer"></i>
                                <span class="hide-menu">Dashboard </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                                <span class="hide-menu">Product Data</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                        <i class="far fa-list-alt"></i>
                                        <span class="hide-menu">Category</span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse first-level">
                                        <li class="sidebar-item">
                                            <a href="<?= site_url('admin/category/parent-category') ?>" class="sidebar-link">
                                                <i class="mdi mdi-toggle-switch"></i>
                                                <span class="hide-menu">Parent Category</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="<?= site_url('admin/category/main-category') ?>" class="sidebar-link">
                                                <i class="mdi mdi-toggle-switch"></i>
                                                <span class="hide-menu">Main Category</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="<?= site_url('admin/category/sub-category') ?>" class="sidebar-link">
                                                <i class="mdi mdi-toggle-switch"></i>
                                                <span class="hide-menu">Sub Category</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="<?= site_url('admin/category/inner-category') ?>" class="sidebar-link">
                                                <i class="mdi mdi-toggle-switch"></i>
                                                <span class="hide-menu">Inner Category</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                        <i class="far fa-bookmark"></i>
                                        <span class="hide-menu">Attributes</span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse first-level">
                                        <li class="sidebar-item">
                                            <a href="<?= site_url('admin/attributes/add-attribute') ?>" class="sidebar-link">
                                                <i class="mdi mdi-toggle-switch"></i>
                                                <span class="hide-menu">Attributes</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="<?= site_url('admin/attributes/add-options')?>" class="sidebar-link">
                                                <i class="mdi mdi-toggle-switch"></i>
                                                <span class="hide-menu">Attribute Options</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="<?= site_url('admin/attributes/assign-attributes-to-category')?>" class="sidebar-link">
                                                <i class="mdi mdi-toggle-switch"></i>
                                                <span class="hide-menu">Assign to Category</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/brands/add-brand')?>" aria-expanded="false">
                                        <i class="fab fa-blackberry"></i>
                                        <span class="hide-menu">Brands</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                        <i class="far fa-gem"></i>
                                        <span class="hide-menu">Products</span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse second-level">
                                        <li class="sidebar-item">
                                            <a href="<?= site_url('admin/products/products-listing')?>" class="sidebar-link">
                                                <i class="mdi mdi-toggle-switch"></i>
                                                <span class="hide-menu">Product Listing</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="<?= site_url('admin/products/add-product') ?>" class="sidebar-link">
                                                <i class="mdi mdi-toggle-switch"></i>
                                                <span class="hide-menu">Add Product</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="<?= site_url('admin/products/add-wholesale-rates') ?>" class="sidebar-link">
                                                <i class="mdi mdi-toggle-switch"></i>
                                                <span class="hide-menu">Add Wholesale Rates</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="<?= site_url('admin/products/product-stock') ?>" class="sidebar-link">
                                                <i class="mdi mdi-toggle-switch"></i>
                                                <span class="hide-menu">Stock Management</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="<?= site_url('admin/products/import-export-products') ?>" class="sidebar-link">
                                                <i class="mdi mdi-toggle-switch"></i>
                                                <span class="hide-menu">Import/Export Products</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="<?= site_url('admin/products/sale-exceptions') ?>" class="sidebar-link">
                                                <i class="mdi mdi-toggle-switch"></i>
                                                <span class="hide-menu">Sale Exceptions</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/products/upload-media-files')?>" aria-expanded="false">
                                        <i class="mdi mdi-file-image"></i>
                                        <span class="hide-menu">Media Files</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                                <span class="hide-menu">Order Section</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/orders/order-listing')?>" aria-expanded="false">
                                        <i class="fab fa-first-order"></i>
                                        <span class="hide-menu">Orders</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/orders/wholesale-order-listing')?>" aria-expanded="false">
                                        <i class="fab fa-first-order"></i>
                                        <span class="hide-menu">Wholesale Orders</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/orders/return-request-listing')?>" aria-expanded="false">
                                        <i class="fas fa-reply"></i>
                                        <span class="hide-menu">Returns</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                                <span class="hide-menu">Blogs Section</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/blogs/blogs-category')?>" aria-expanded="false">
                                        <i class="fas fa-certificate"></i>
                                        <span class="hide-menu">Blogs Category</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/blogs/add-blog')?>" aria-expanded="false">
                                        <i class="fas fa-edit"></i>
                                        <span class="hide-menu">Add Blog</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/blogs/blogs-listing')?>" aria-expanded="false">
                                        <i class="fas fa-list-ul"></i>
                                        <span class="hide-menu">All Blogs</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/blogs/blog-comments')?>" aria-expanded="false">
                                        <i class="far fa-comment-alt"></i>
                                        <span class="hide-menu">Comments</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                                <span class="hide-menu">Location Management</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/location/countries')?>" aria-expanded="false">
                                        <i class="fas fa-globe"></i>
                                        <span class="hide-menu">Countries</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/location/states')?>" aria-expanded="false">
                                        <i class="fas fa-location-arrow"></i>
                                        <span class="hide-menu">States</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/location/cities')?>" aria-expanded="false">
                                        <i class="far fa-building"></i>
                                        <span class="hide-menu">Cities</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/location/zipcodes')?>" aria-expanded="false">
                                        <i class="far fa-file-archive"></i>
                                        <span class="hide-menu">Zip Codes</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                                <span class="hide-menu">User Management</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/users/user-listing')?>" aria-expanded="false">
                                        <i class="mdi mdi-account"></i>
                                        <span class="hide-menu">User Listing</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                                <span class="hide-menu">SEO Management</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/page-seo-setting')?>" aria-expanded="false">
                                        <i class="mdi mdi-flash"></i>
                                        <span class="hide-menu">Page Listing</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                                <span class="hide-menu">Slider Management</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark" href="<?= site_url('admin/slider-settings')?>" aria-expanded="false">
                                        <i class="mdi mdi-folder-multiple-image"></i>
                                        <span class="hide-menu">Slider Listing</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->