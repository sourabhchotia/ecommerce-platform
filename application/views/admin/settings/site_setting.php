
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
                        <h4 class="page-title">Site Settings</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= site_url('admin/dashboard')?>">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Site Settings</li>
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
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header bg-primary">
                                    <h4 class="m-b-0 text-white">Site Settings</h4>
                                </div>
                                <div class="row m-t-40">
                                    <div class="col-lg-4 col-xl-3">
                                        <!-- Nav tabs -->
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">General Setting</a>
                                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Style Setting</a>
                                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Social Icons</a>
                                            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Shop Setting</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-xl-9">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                <form class="" id="generalSettings" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-6 p-b-20">
                                                            <div class="form-group">
                                                                <label for="site_title" class="control-label col-form-label">Site Title</label>
                                                                <input type="text" class="form-control" name="site_title" id="site_title" aria-describedby="name" placeholder="Site Title" value="<?= get_option('site_title') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 p-b-20">
                                                            <div class="form-group">
                                                                <label for="site_sub_title" class="control-label col-form-label">Site Sub Title</label>
                                                                <input type="text" class="form-control" name="site_sub_title" id="site_sub_title" aria-describedby="name" placeholder="Site Sub Title" value="<?= get_option('site_sub_title') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 p-b-40">
                                                            <label for="meta_title" class="control-label col-form-label">Site Logo</label>
                                                            <div class="input-group mb-3">
                                                                <div class="custom-file" id="customfileCat">
                                                                    <input type="file" class="custom-file-input" id="logo" name="logo">
                                                                    <label class="custom-file-label" for="logo">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 offset-md-2 p-b-40">
                                                            <?php 

                                                                $file = get_option('logo');

                                                                $filename= pathinfo($file,PATHINFO_FILENAME);
                                                                $file_ext = pathinfo($file,PATHINFO_EXTENSION);

                                                                if($filename){
                                                            ?>
                                                                <img src="<?= site_url() ?>uploads/logos/thumbs/<?= $filename ?>-200x80.<?= $file_ext ?>" alt="iMac">

                                                            <?php }else{ ?>

                                                                <img id="logoPreview" src="<?= site_url() ?>assets/images/gallery/chair.png" width="80">
                                                            <?php } ?>
                                                        </div>

                                                        <div class="col-md-6 p-b-40">
                                                            <label for="meta_title" class="control-label col-form-label">Site FavIcon</label>
                                                            <div class="input-group mb-3">
                                                                <div class="custom-file" id="customfileCat">
                                                                    <input type="file" class="custom-file-input" id="favicon" name="favicon">
                                                                    <label class="custom-file-label" for="favicon">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 offset-md-2 p-b-40">
                                                            <?php 

                                                                $file = get_option('favicon');

                                                                $filename= pathinfo($file,PATHINFO_FILENAME);
                                                                $file_ext = pathinfo($file,PATHINFO_EXTENSION);

                                                                if($filename){
                                                            ?>
                                                                <img src="<?= site_url() ?>uploads/logos/favicons/<?= $filename ?>-64x64.<?= $file_ext ?>" alt="iMac">

                                                            <?php }else{ ?>

                                                                <img id="faviconPreview" src="<?= site_url() ?>assets/images/gallery/chair.png" width="80">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        
                                                        <div class="col-md-6 p-b-20">
                                                            <div class="form-group">
                                                                <label for="contact_phone" class="control-label col-form-label">Contact Phone</label>
                                                                <input type="text" class="form-control" name="contact_phone" id="contact_phone" aria-describedby="name" placeholder="Contact Phone" value="<?= get_option('contact_phone') ?>">
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 p-b-20">
                                                            <div class="form-group">
                                                                <label for="contact_mobile" class="control-label col-form-label">Contact Mobile</label>
                                                                <input class="form-control" name="contact_mobile" id="contact_mobile" placeholder="Contact Mobile" value="<?= get_option('contact_mobile') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 p-b-20">
                                                            <div class="form-group">
                                                                <label for="contact_email_one" class="control-label col-form-label">Contact Email</label>
                                                                <input class="form-control" name="contact_email_one" id="contact_email_one" placeholder="Contact Email" value="<?= get_option('contact_email_one') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 p-b-20">
                                                            <div class="form-group">
                                                                <label for="contact_email_two" class="control-label col-form-label">Contact Secondary Email</label>
                                                                <input class="form-control" name="contact_email_two" id="contact_email_two" placeholder="Contact Secondary Email" value="<?= get_option('contact_email_two') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 p-b-20">
                                                            <div class="form-group">
                                                                <label for="address" class="control-label col-form-label">Company Address</label>
                                                                <textarea class="form-control" name="address" id="address" placeholder="Company Address"><?= get_option('address') ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 p-b-20">
                                                            <div class="form-group">
                                                                <label for="copyright_text" class="control-label col-form-label">Site URL</label>
                                                                <input class="form-control" name="copyright_text" id="copyright_text" placeholder="Copyright Text" value="<?= get_option('site_retail_url') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 p-b-20">
                                                            <div class="form-group">
                                                                <label for="copyright_text" class="control-label col-form-label">Wholesale URL</label>
                                                                <input class="form-control" name="copyright_text" id="copyright_text" placeholder="Copyright Text" value="<?= get_option('site_wholesale_url') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 p-b-20">
                                                            <div class="form-group">
                                                                <label for="copyright_text" class="control-label col-form-label">Copyright Text</label>
                                                                <input class="form-control" name="copyright_text" id="copyright_text" placeholder="Copyright Text" value="<?= get_option('copyright_text') ?>">
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <hr>
                                                    <div class="action-form">
                                                        <div class="form-group m-b-10 text-right">
                                                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                                <form class="" id="styleSetting" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-12 p-b-20">
                                                            <div class="form-group">
                                                                <label for="primary_color" class="control-label col-form-label">Primary Color</label>
                                                                <input type="text" class="form-control" name="primary_color" id="primary_color" aria-describedby="name" placeholder="Primary Color" value="<?= get_option('primary_color') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 p-b-20">
                                                            <div class="form-group">
                                                                <label for="secondary_color" class="control-label col-form-label">Secondary Color</label>
                                                                <input type="text" class="form-control" name="secondary_color" id="secondary_color" aria-describedby="name" placeholder="Secondary Color" value="<?= get_option('secondary_color') ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="action-form">
                                                        <div class="form-group m-b-10 text-right">
                                                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                                <form class="" id="socialSettings" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-12 p-b-20">
                                                            <div class="form-group">
                                                                <label for="facebook" class="control-label col-form-label">Facebook</label>
                                                                <input type="text" class="form-control" name="facebook" id="facebook" aria-describedby="name" placeholder="Facebook" value="<?= get_option('facebook') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 p-b-20">
                                                            <div class="form-group">
                                                                <label for="instagram" class="control-label col-form-label">Instagaram</label>
                                                                <input type="text" class="form-control" name="instagram" id="instagram" aria-describedby="name" placeholder="Instagaram" value="<?= get_option('instagram') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 p-b-20">
                                                            <div class="form-group">
                                                                <label for="youtube" class="control-label col-form-label">Youtube</label>
                                                                <input type="text" class="form-control" name="youtube" id="youtube" aria-describedby="name" placeholder="Youtube" value="<?= get_option('youtube') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 p-b-20">
                                                            <div class="form-group">
                                                                <label for="google_plus" class="control-label col-form-label">Google Plus</label>
                                                                <input type="text" class="form-control" name="google_plus" id="google_plus" aria-describedby="name" placeholder="Google Plus" value="<?= get_option('google_plus') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 p-b-20">
                                                            <div class="form-group">
                                                                <label for="linked_in" class="control-label col-form-label">LinkedIn</label>
                                                                <input type="text" class="form-control" name="linked_in" id="linked_in" aria-describedby="name" placeholder="LinkedIn" value="<?= get_option('linked_in') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 p-b-20">
                                                            <div class="form-group">
                                                                <label for="twitter" class="control-label col-form-label">Twitter</label>
                                                                <input type="text" class="form-control" name="twitter" id="twitter" aria-describedby="name" placeholder="Twitter" value="<?= get_option('twitter') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 p-b-20">
                                                            <div class="form-group">
                                                                <label for="vimeo" class="control-label col-form-label">Vimeo</label>
                                                                <input type="text" class="form-control" name="vimeo" id="vimeo" aria-describedby="name" placeholder="Vimeo" value="<?= get_option('vimeo') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 p-b-20">
                                                            <div class="form-group">
                                                                <label for="pinterest" class="control-label col-form-label">Pintrest</label>
                                                                <input type="text" class="form-control" name="pinterest" id="pinterest" aria-describedby="name" placeholder="Pintrest" value="<?= get_option('pinterest') ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="action-form">
                                                        <div class="form-group m-b-10 text-right">
                                                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                                <form class="" id="shopSettings" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-12 p-b-20">
                                                            <div class="form-group">
                                                                <label for="currency_symbol" class="control-label col-form-label">Currency Symbol</label>
                                                                <input type="text" class="form-control" name="currency_symbol" id="currency_symbol" aria-describedby="name" placeholder="Currency Symbol" value="<?= get_option('currency_symbol') ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 p-b-20">
                                                            <div class="form-group">
                                                                <label for="currency_code" class="control-label col-form-label">Currency Code</label>
                                                                <input type="text" class="form-control" name="currency_code" id="currency_code" aria-describedby="name" placeholder="Currency Code" value="<?= get_option('currency_code') ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="action-form">
                                                        <div class="form-group m-b-10 text-right">
                                                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

                <style type="text/css">
                    div#v-pills-tabContent {
                        border-top: 1px solid #f2f2f2;
                        border-right: 1px solid #f2f2f2;
                        border-bottom: 1px solid #f2f2f2;
                        padding: 10px 30px;
                        box-shadow: 0px 0px 10px #d5d3d3bd;
                    }
                    .nav-pills .nav-link {
                        border-radius: 2px;
                        padding: 15px;
                        border-bottom: 1px solid #dddddd;
                    }
                    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
                        color: #fff;
                        background-color: #fa5838;
                    }
                    div#v-pills-tab {
                        box-shadow: 0px 0px 10px #d9d9d9;
                        text-align: center;
                    }
                </style>