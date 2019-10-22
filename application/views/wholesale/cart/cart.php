<div class="ps-hero bg--cover" data-background="<?= base_url() ?>assets/user/images/hero/bread-1.jpg"><img src="<?= base_url() ?>assets/user/images/hero/contact-us.jpg" alt="">
    <div class="ps-container">
      <h3>Shopping Cart</h3>
      <div class="ps-breadcrumb">
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li class="active">Shopping Cart</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="ps-content">
    <div class="ps-container">
      <div class="ps-cart-listing">
        <div class="row">
          <div class="col-md-8 col-sm-8 col-xs-12">
            <?php $subtotal = $total = $discount = 0; 
                if($cartitems){  foreach($cartitems as $cart){ 

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
                  <div class="form-group--number">
                    <button class="minus" data-minqty="<?= $cart->product_min_qty ?>"><span>-</span></button>
                    <input class="form-control" type="text" value="<?= $cart->cart_qty; ?>" name="qty" data-minqty="<?= $cart->product_min_qty ?>" data-stock="<?= $cart->combination_stock ?>">
                    <button class="plus" data-stock="<?= $cart->combination_stock ?>"><span>+</span></button>
                    &nbsp;
                    &nbsp;
                    <button class="updateCart" data-id="<?= $cart->cart_id ?>"><i class="fa fa-save"></i></button>
                  </div>
                  <p class="prices"><del>₹ <?= $cart->combination_price; ?></del> ₹ <?= $cart->combination_sale_price; ?></p>
                </div>
              </div>
            </div>
            <?php } }else if($this->cart->contents()){ foreach($this->cart->contents() as $cart){ ?>
              <?php
                $this->db->select('*');
                $this->db->from('whole_product_combinations a');
                $this->db->join('whole_products c','c.product_id = a.combination_product','left');
                $this->db->join('whole_product_options d','d.p_attribute_combo = a.combination_id','left');
                $this->db->join('whole_attribute_options e','e.option_id = d.p_attribute_value','left');
                $this->db->where('combination_id',$cart['id']);
                $product = $this->db->get()->row();

                $subtotal += ($cart['mrp'] * $cart['qty']);

                $total += ($cart['price'] * $cart['qty']);
                $discount += ( ($cart['mrp'] - $cart['price']) * $cart['qty']);

                $filename= pathinfo($product->combination_image,PATHINFO_FILENAME);
                $file_ext = pathinfo($product->combination_image,PATHINFO_EXTENSION);
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
                    <div class="form-group--number">

                      <button class="minus" data-minqty="<?= $product->product_min_qty ?>"><span>-</span></button>
                      <input class="form-control" type="text" value="<?= $cart['qty']; ?>" name="qty" data-stock="<?= $product->combination_stock ?>" data-minqty="<?= $product->product_min_qty ?>">
                      <button class="plus" data-stock="<?= $product->combination_stock ?>"><span>+</span></button>
                      &nbsp;
                    &nbsp;
                    <button class="updateCart" data-id="<?= $cart['rowid'] ?>"><i class="fa fa-save"></i></button>
                    </div>
                    <p class="prices"><del>₹ <?= $cart['mrp']; ?></del> ₹ <?= $cart['price']; ?></p>
                  </div>
                </div>
              </div>

            <?php }} ?>
            <hr>
            <div class="ps-block__footer">
              <div class="row">
                <div class="col-sm-12 col-xs-12">
                  <button class="empty-cart-btn emptyCart emptyCartItem" data-type="all"><i class="fa fa-trash"></i>Empty Cart</button>
                  <a class="ps-btn ps-btn--outline ps-btn--black ps-btn--fullwidth"
                    href="<?= site_url() ?>">Continue Shopping<i class="fa fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="ps-cart__promotion">
                
              <form id="checkDeliver">
                <div class="form-group">
                  <p>Enter your Zip/Postal Code to Check If Delivery is Available in Your Area.</p>
                  <div class="ps-form--icon"><i class="fa fa-angle-right"></i>
                    <input class="form-control" type="text" placeholder="Enter Zip Code" name="zipcodeForm" id="zipcodeForm" value="<?= $this->session->zip_code  ?>"> 
                  </div>
                </div>
                <div class="form-group">
                  <button class="ps-btn ps-btn--gray" type="submit">Check Delivery </button>
                </div>
              </form>
            </div>
            <hr>
            <div class="ps-block__total">
              <h4>SubTotal <span class="color_dark fs_large" id="subtotal"> ₹ <span id="subAmount"><?= round($subtotal,2);?></span></span></h4>
              <h5>Discount: <span id="discount">₹ <span id="disAmount"><?= round(($subtotal - $total),2); ?></span></span></h5>
            </div>
            <div class="ps-cart__actions inlin-block">
              <div class="ps-cart__total">
                <h3>Total Price: <span>₹ <span id="totalAmount"><?= round($total,2); ?></span> </span></h3>

                <?php if($this->session->zip_code){

                        $disabled = '';
                  }else if($is_delivered){
                    $disabled = '';
                  }else{
                    $disabled = 'disabled=""';
                  } ?>
                <button class="ps-btn" onclick="window.location.href = '<?= site_url('checkout')?>'" <?= $disabled ?> id="checkoutButton">Process to checkout</button>
              </div>
              
              
              
              <!-- <div class="ps-cart__promotion">
                  <hr>
                <div class="form-group">
                  <div class="ps-form--icon"><i class="fa fa-angle-right"></i>
                    <input class="form-control" type="text" placeholder="Promo Code">
                  </div>
                </div>
                <div class="form-group">
                  <button class="ps-btn ps-btn--gray">Continue Shopping</button>
                </div>
              </div> -->
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>