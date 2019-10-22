<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7"><![endif]-->
<!--[if IE 8]><html class="ie ie8"><![endif]-->
<!--[if IE 9]><html class="ie ie9"><![endif]-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link href="apple-touch-icon.png" rel="apple-touch-icon">
  <?php 
        $file = get_option('favicon');
        $filename= pathinfo($file,PATHINFO_FILENAME);
        $file_ext = pathinfo($file,PATHINFO_EXTENSION);

        if($filename){
  ?>
    <link href="<?= site_url() ?>uploads/logos/favicons/<?= $filename ?>-16x16.<?= $file_ext ?>" rel="icon">
  <?php }else{ ?>
    <link href="<?= base_url() ?>assets/user/images/favicon.png" rel="icon">
  <?php } ?>

  <meta name="title" content="<?php if(!empty($metadata->page_meta_title)){ echo $metadata->page_meta_title; }?>">
  <meta name="keywords" content="<?php if(!empty($metadata->page_meta_keywords)){ echo $metadata->page_meta_keywords; }?>">
  <meta name="description" content="<?php if(!empty($metadata->page_meta_description)){ echo $metadata->page_meta_description; }?>">
  <meta name="author" content="Sourabh Chotia">
  <title>
    <?php
            if(!empty($metadata->page_meta_title)){

              echo $metadata->page_meta_title;
            }else{

              echo get_option('site_title'). ' | '.get_option('site_sub_title');
            }
    ?>
  </title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CLibre+Baskerville:400,700"
  rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url() ?>assets/user/plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/user/plugins/furniture-icon/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/user/plugins/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/user/plugins/owl-carousel/assets/owl.carousel.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/user/plugins/bootstrap-select/dist/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/user/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/user/plugins/slick/slick/slick.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/user/plugins/jquery-ui/jquery-ui.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/user/plugins/lightGallery-master/dist/css/lightgallery.min.css">
  <!-- Toaster CSS Include -->
  <link href="<?= site_url() ?>assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url() ?>assets/user/css/style.css">
  <!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
  <!--WARNING: Respond.js doesn't work if you view the page via file://-->
  <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!--[if IE 7]><body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
  <!--[if IE 8]><body class="ie8 lt-ie9 lt-ie10"><![endif]-->
    <!--[if IE 9]><body class="ie9 lt-ie10"><![endif]-->

      <body>
        <div class="header--sidebar"></div>
        <!--  Header-->
        <header class="header" data-sticky="true">
          <div class="header__top">
            <div class="ps-container">
              <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">
                  <p><i class="fa fa-envelope green"></i> <?php if(get_option('contact_email_one')){ echo get_option('contact_email_one'); }else{ echo "admin@restock.com";}?> &nbsp;&nbsp;<i class="fa fa-phone green"></i> <?php if(get_option('contact_email_one')){ echo get_option('contact_mobile'); }else{ echo "804-377-3580";}?></p><i
                  class="furniture-market"></i>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-9 col-xs-12 ">
                  <div class="header__actions">
                    <a href="<?= get_option('site_wholesale_url') ?>" class="hidden-xs">Wholesale</a>
                    <a href="javascript:void(0);">How It Works?</a>
                    <?php if($this->session->user_id){ ?>
                      <div class="btn-group ps-dropdown">
                        <a class="dropdown-toggle" href="javascript:void(0);">Hi! <?= $this->session->user_name ?><i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                          <li><a href="<?= site_url('my-account') ?>">My Account</a></li>
                          <li><a href="<?= site_url('my-orders')?>">Orders List</a></li>
                          <li><a href="<?= site_url('my-wishlist')?>">Wishlist</a></li>
                          <li><a href="<?= site_url('user-logout')?>">Logout</a></li>
                        </ul>
                      </div>
                      
                    <?php }else{ ?>
                      <a href="javascript:void(0);" class="open">Login & Regiser</a>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <nav class="navigation">
            <div class="ps-container">
              <a class="ps-logo" href="<?= base_url() ?>">
                <?php 

                    $file = get_option('logo');

                    $filename= pathinfo($file,PATHINFO_FILENAME);
                    $file_ext = pathinfo($file,PATHINFO_EXTENSION);

                    if($filename){
                ?>
                  <img src="<?= site_url() ?>uploads/logos/thumbs/<?= $filename ?>-150x50.<?= $file_ext ?>" alt="">
                <?php }else{ ?>
                  <img src="<?= base_url() ?>assets/user/images/logo.png" alt="">
                <?php } ?>
              </a>
              <ul class="main-menu menu">
                <!--<li class="current-menu-item"><a href="<?= base_url() ?>">Home</a>-->

                </li>
                <li class="menu-item-has-children has-mega-menu current-menu-item">
                  <a href="javascript:void(0);">Pouches <i class="fa fa-angle-down"></i></a>
                    <div class="mega-menu">
                      <div class="mega-wrap">
                        <div class="mega-column">
                          <ul class="mega-item mega-features">
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">FOOD PACKAGING</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">POUCHES</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">CHAI FLASK</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">BOTTLES & JARS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">MEAL TRAYS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">COURIER BAG</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">INNOVATIVE PIZZA BOX</a></li>
                          </ul>
                        </div>
                        <div class="mega-column">
                          <h4 class="mega-heading">FOOD PACKAGING</h4>
                          <ul class="mega-item">
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">POUCHES</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">CHAI FLASK</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">BOTTLES & JARS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">MEAL TRAYS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">COURIER BAG</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">INNOVATIVE PIZZA BOX</a></li>
                          </ul>
                        </div>
                        <div class="mega-column">
                          <h4 class="mega-heading">Sofa & Chair</h4>
                          <ul class="mega-item">
                           <li><a href="<?= site_url('food-packaging/chai-flask')?>">POUCHES</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">CHAI FLASK</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">BOTTLES & JARS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">MEAL TRAYS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">COURIER BAG</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">INNOVATIVE PIZZA BOX</a></li>
                          </ul>
                        </div>
                        <div class="mega-column">
                          <h4 class="mega-heading">POUCHES</h4>
                          <ul class="mega-item">
                           <li><a href="<?= site_url('food-packaging/chai-flask')?>">POUCHES</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">CHAI FLASK</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">BOTTLES & JARS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">MEAL TRAYS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">COURIER BAG</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">INNOVATIVE PIZZA BOX</a></li>
                          </ul>
                        </div>
                        <div class="mega-column">
                          <h4 class="mega-heading">CHAI FLASK</h4>
                          <ul class="mega-item">
                          <li><a href="<?= site_url('food-packaging/chai-flask')?>">POUCHES</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">CHAI FLASK</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">BOTTLES & JARS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">MEAL TRAYS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">COURIER BAG</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">INNOVATIVE PIZZA BOX</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                </li>
                <li><a href="javascript:void(0);">Chai Flask</a></li>
                <li class="menu-item-has-children has-mega-menu"><a href="javascript:void(0);">Food Packaging <i
                  class="fa fa-angle-down"></i></a>
                  <div class="mega-menu">
                    <div class="mega-wrap">
                      <div class="mega-column">
                        <ul class="mega-item mega-features">
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">FOOD PACKAGING</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">POUCHES</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">CHAI FLASK</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">BOTTLES & JARS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">MEAL TRAYS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">COURIER BAG</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">INNOVATIVE PIZZA BOX</a></li>
                          </ul>
                        </div>
                        <div class="mega-column">
                          <h4 class="mega-heading">FOOD PACKAGING</h4>
                          <ul class="mega-item">
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">POUCHES</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">CHAI FLASK</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">BOTTLES & JARS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">MEAL TRAYS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">COURIER BAG</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">INNOVATIVE PIZZA BOX</a></li>
                          </ul>
                        </div>
                        <div class="mega-column">
                          <h4 class="mega-heading">Sofa & Chair</h4>
                          <ul class="mega-item">
                           <li><a href="<?= site_url('food-packaging/chai-flask')?>">POUCHES</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">CHAI FLASK</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">BOTTLES & JARS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">MEAL TRAYS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">COURIER BAG</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">INNOVATIVE PIZZA BOX</a></li>
                          </ul>
                        </div>
                        <div class="mega-column">
                          <h4 class="mega-heading">POUCHES</h4>
                          <ul class="mega-item">
                           <li><a href="<?= site_url('food-packaging/chai-flask')?>">POUCHES</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">CHAI FLASK</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">BOTTLES & JARS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">MEAL TRAYS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">COURIER BAG</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">INNOVATIVE PIZZA BOX</a></li>
                          </ul>
                        </div>
                        <div class="mega-column">
                          <h4 class="mega-heading">CHAI FLASK</h4>
                          <ul class="mega-item">
                          <li><a href="<?= site_url('food-packaging/chai-flask')?>">POUCHES</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">CHAI FLASK</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">BOTTLES & JARS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">MEAL TRAYS</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">COURIER BAG</a></li>
                            <li><a href="<?= site_url('food-packaging/chai-flask')?>">INNOVATIVE PIZZA BOX</a></li>
                          </ul>
                      </div>
                    </div>
                  </div>
                </li>
                <li><a href="<?= site_url('contact-us')?>">Need Customization</a></li>
              </ul>
              <div class="menu-toggle"><span></span></div>
              <div class="ps-cart">
                <a class="ps-cart__toggle" href="<?= site_url('cart') ?>">
                  <?php 
                        $cart = 0;

                        if($this->session->user_id){
                          $this->db->where('cart_user_id',$this->session->user_id);
                          $cart = $this->db->get('whole_cart')->num_rows(); 
                        }else{
                          $cart = count($this->cart->contents());
                        }
                  ?>
                  <span><i><?= $cart ?></i></span><img src="<?= base_url() ?>assets/user/images/market.svg" alt="">
                </a>
              </div>
              <form class="ps-form--search" action="do_action" method="post"><i class="furniture-search"></i>
                <input class="form-control" type="text" placeholder="Find product">
                <button>Search</button>
              </form>
            </div>
          </nav>
        </header>