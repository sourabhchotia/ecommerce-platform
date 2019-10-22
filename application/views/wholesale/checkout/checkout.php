<div class="ps-hero bg--cover" data-background="<?= base_url() ?>assets/user/images/hero/bread-1.jpg">
    <div class="ps-container">
      <h3>Check out</h3>
      <div class="ps-breadcrumb">
        <ol class="breadcrumb">
          <li><a href="<?= site_url() ?>">Home</a></li>
          <li class="active">Check out</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="ps-checkout">
    <div class="ps-container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <?php if($this->session->flashdata('error')){ ?>
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong><?= $this->session->flashdata('error') ?></strong>
            </div>
          <?php } ?>
        </div>
      </div>
      <form class="ps-form--checkout" action="<?= site_url('order-confirmation') ?>" method="post" id="checkoutForm">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
            <div class="main-login-info fon-info">
              <h3 class="checkout-head">LOGIN INFORMATION</h3>
              <hr>

              <?php if($this->session->user_id){?>
                <div class="row">
                  <div class="col-md-12">
                    <ul>
                      <li><p class="user-icon"><i class="fa fa-user"></i><?= $this->session->user_name ?></p></li>
                      <li><p class="mobile-icon"><i class="fa fa-phone"></i><?= $this->session->user_phone ?></p></li>
                      <li><p class="message-icon"><i class="fa fa-envelope"></i><?= $this->session->user_email ?>
                    </p></li></ul>
                  </div>
                </div>
              <?php }else{ ?>
                <p class="place-order">
                  Please <a href="javascript:void(0);" class="open">Login/Signup</a> to place order
                </p>
              <?php } ?>
            </div>

            <div class="main-login-info fon-info">
              <h3 class="checkout-head">SHIPPING DETAILS</h3>
              <hr>

              <?php if($this->session->user_id){ 
                      if($addresses){ foreach($addresses as $address){
              ?>
                <div class="row address_info">
                  <div class="col-md-10 col-xs-8">
                    <div class="ps-radio ps-radio--small">
                      <input class="form-control" type="radio" name="address" id="address<?= $address->add_id ?>" value="<?= $address->add_id ?>">
                      <label for="address<?= $address->add_id ?>"><?= $address->user_add_name ?>, <?= $address->user_add_mobile ?> <br>
                        <?= $address->user_add_1 ?><br>
                        <?= $address->user_add_2 ?>, <?= $address->user_zip_code ?><br>
                        <?= $address->user_city ?>, <?= $address->user_state ?>, <?= $address->user_country ?>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 col-xs-4">
                    <a href="javascript:void(0);" class="ps-btn--close ps-btn--no-boder deleteAddress font3" data-id="<?= $address->add_id ?>"></a>
                  </div>
                </div>
              <?php } } ?>
                <div class="btn-address">
                  <a class="btn btn-default btn-set-adress w-50" data-toggle="modal" data-target="#myModal"><i class="fa fa-map-marker"></i> Add Address</a>
                </div>
              <?php }else{ ?>
                <p class="place-order">
                  Please <a href="javascript:void(0);" class="open">Login/Register</a> to Select or Add New Address
                </p>
              <?php } ?> 
            </div>
            <ul class="box-shadow paymentNote ">
              <li class=" ">
                <p class=" ">Flat <b class="cod-b"><sup style="font-size: 25px;">₹</sup><span style="    font-weight: 800;color: javascript:void(0);27c535; top:0;">50</span>
                </b> Discount on Prepaid Payment Method</p>
              </li>
              <!--  -->
              <li class=" ">
                <p class="flat-style flat-short">Flat <b class="payment-methodb"><sup style="font-size: 20px; font-weight: 500;">₹</sup><span style="    font-weight: 800;    color: black; top:0;">50</span>
                </b> Extra Charges on COD Payment Method</p>
              </li>
            </ul>

            <div class="ps-shipping">
              <h3>FREE SHIPPING</h3>
              <p>YOUR ORDER QUALIFIES FOR FREE SHIPPING.<br> <a href="javascript:void(0);"> Singup </a> for free shipping on every order,
                every time.</p>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
            <div class="ps-checkout__order1">

              <h3 class="checkout-head">Your Order
                <p class="forget-item">Forget an item?<a href="<?= site_url('cart') ?>">EDIT YOUR CART</a></p>
              </h3>
              <hr>
              <div class="checkout-content mb-10">
                <?php if($cartitems){ $subtotal = $total = $discount = 0; foreach($cartitems as $cart){ 

              $subtotal += ($cart->combination_price * $cart->cart_qty);
              $total += ($cart->combination_sale_price * $cart->cart_qty);
              $discount += ($cart->combination_price - $cart->combination_sale_price) * $cart->cart_qty;



              $filename= pathinfo($cart->combination_image,PATHINFO_FILENAME);
              $file_ext = pathinfo($cart->combination_image,PATHINFO_EXTENSION);
            ?>
            <div class="ps-cart__table">
              <div class="prod-img">
                <a class="ps-product--compare" href="<?= site_url($cart->combination_slug) ?>">
                  <img class="mr-15" src="<?= base_url() ?>uploads/products/thumbs/<?= $filename ?>-200x350.<?= $file_ext ?>" alt="">
                </a>
              </div>
              <div class="description-part">
                <div class="ps-remove emptyCartItem" data-id="<?= $cart->cart_id ?>" data-type="single"></div>
                <a class="ps-product--compare" href="<?= site_url($cart->combination_slug) ?>"><?= $cart->product_name; ?></a>
                <div class="ps-block__desc">
                  <p>SKU: <?= $cart->combination_skucode; ?></p>
                  <p>Color: <?= $cart->option_name; ?></p>
                </div>
                <div class="block-action">
                  <div class="row">
                    <div class="col-md-9 col-xs-7">
                      <b class="text-left1">Price:</b>
                      <p class="rs-set"><?= $cart->combination_sale_price ?></p>
                      <span style="font-size: 10px; font-weight: 400; top: 0">X</span><b class="ex-one"><?= $cart->cart_qty; ?></b>
                    </div>
                    <div class="col-md-3 col-xs-5">
                      <b class="text-left1">Total:</b>
                      <p><?= $cart->combination_sale_price * $cart->cart_qty ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } }else if($this->cart->contents()){ $subtotal = $discount = 0; foreach($this->cart->contents() as $cart){ ?>
              <?php
                $this->db->select('*');
                $this->db->from('whole_product_combinations a');
                $this->db->join('whole_products c','c.product_id = a.combination_product','left');
                $this->db->join('whole_product_options d','d.p_attribute_combo = a.combination_id','left');
                $this->db->join('whole_attribute_options e','e.option_id = d.p_attribute_value','left');
                $this->db->where('combination_id',$cart['id']);
                $product = $this->db->get()->row();

                $filename= pathinfo($product->combination_image,PATHINFO_FILENAME);
                $file_ext = pathinfo($product->combination_image,PATHINFO_EXTENSION);

                $subtotal = ($cart['price'] * $cart['qty']);

              ?>
              <div class="ps-cart__table">
                <div class="prod-img">
                  <a class="ps-product--compare" href="<?= site_url($product->combination_slug) ?>">
                    <img class="mr-15" src="<?= base_url() ?>uploads/products/thumbs/<?= $filename ?>-200x350.<?= $file_ext ?>" alt="">
                  </a>
                </div>
                <div class="description-part">
                  <div class="ps-remove emptyCartItem" data-id="<?= $cart['rowid'] ?>" data-type="single"></div>
                  <a class="ps-product--compare" href="<?= site_url($product->combination_slug) ?>"><?= $product->product_name; ?></a>
                  <div class="ps-block__desc">
                    <p>SKU: <?= $product->combination_skucode; ?></p>
                    <p>Color: <?= $product->option_name; ?></p>
                  </div>
                  <div class="block-action">
                    <div class="row">
                      <div class="col-md-9 col-xs-7">
                        <b class="text-left1">Price:</b>
                        <p class="rs-set"><?= $cart['price'] ?></p>
                        <span style="font-size: 10px; font-weight: 400; top: 0">X</span><b class="ex-one"><?= $cart['qty']; ?></b>
                      </div>
                      <div class="col-md-3 col-xs-5">
                        <b class="text-left1">Total:</b>
                        <p><?= $cart['price'] * $cart['qty'] ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php }} ?>
                <hr>
                <div class="ps-block__total checkout-ps">
                  <h4>SubTotal <span class="color_dark fs_large" id="subtotal"> ₹ <?php if($this->session->user_id){ echo round($subtotal,2); }else{ echo $subtotal; }?></span></h4>
                  <h5>Discount: <span id="discount">₹ <?php if($this->session->user_id){ echo round(($subtotal - $total),2); }else{ echo $subtotal - $this->cart->total(); }?></span></h5>
                  <hr>
                  <h3>Grand Total: <span> ₹ <?php if($this->session->user_id){ echo round($total,2); }else{ echo $this->cart->total(); }?></span></h3>
                  <div class="ps-checkout__order">
                    <footer>
                      <h3>Payment Method</h3>
                      <?php if($paymentMethods){ foreach($paymentMethods as $method){?>
                        <div class="cheque">
                          <div class="ps-radio ps-radio--small">
                            <input class="form-control" type="radio" id="payment<?= $method->pg_id ?>" name="payment" checked="" value="<?= $method->pg_name ?>">
                            <label for="payment<?= $method->pg_id ?>"><?= $method->pg_display_name ?> <?php if($method->pg_name != 'cod'){ ?>(Powered By <?= strtoupper($method->pg_name);?>)<?php } ?></label>
                          </div>
                        </div>
                      <?php } } ?>
                      <div class="form-group paypal">
                        <ul class="ps-payment-method">
                          <li><a href="javascript:void(0);"><img src="<?= base_url() ?>assets/user/images/payment/1.png" alt=""></a></li>
                          <li><a href="javascript:void(0);"><img src="<?= base_url() ?>assets/user/images/payment/2.png" alt=""></a></li>
                          <li><a href="javascript:void(0);"><img src="<?= base_url() ?>assets/user/images/payment/3.png" alt=""></a></li>
                        </ul>
                        <?php if($this->session->user_id){ ?>
                          <button type="submit" class="ps-btn ps-btn--fullwidth">Place Order</button>
                        <?php }else{ ?>
                          <h3>Please Login/Signup to Place this Order</h3>
                        <?php } ?>
                      </div>
                    </footer>
                  </div>
                  
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </form>
    </div>
  </div>