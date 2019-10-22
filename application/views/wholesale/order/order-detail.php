<div class="ps-hero bg--cover" data-background="images/hero/bread-1.jpg">
    <div class="ps-container">
      <h3>Check out</h3>
      <div class="ps-breadcrumb">
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li class="active">Check out</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="ps-checkout">
    <div class="ps-container">

      <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="main-login-info fon-info">
            <h3 class="checkout-head">ORDER INFORMATION</h3>
            <hr>
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td class=" "><b>Order Number</b></td>
                  <td data-cell-title="Order Number" class=" "><span class="color_dark">#<?= $orderuserdetail->order_id ?></span></td>
                </tr>
                <tr>
                  <td class=" "><b>Order Date</b></td>
                  <td data-cell-title="Order Date" class=" "><?= date('d M Y',strtotime($orderuserdetail->order_created_on))?></td>
                </tr>
                <tr>
                  <td class=" "><b>Order Status</b></td>
                  <td data-cell-title="Order Status" class="">
                    <?= ucfirst($orderuserdetail->order_status) ?>
                  </td>
                </tr>
                <tr>
                  <td class=" "><b>Payment</b></td>
                  <td data-cell-title="Payment" class=" "><?= $orderuserdetail->order_payment_mode ?></td>
                </tr>
                <tr>
                  <td class=" "><b>Total(₹)</b></td>
                  <td data-cell-title="Total"><b class="scheme_color  "> <?= $orderuserdetail->price * $orderuserdetail->qty?></b></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="main-login-info fon-info">
            <h3 class="checkout-head">BILL TO, <?= strtoupper($orderuserdetail->user_name) ?></h3>
            <hr>
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td class=" "><b>Phone</b></td>
                  <td data-cell-title="Phone" class=" ">(+91) <?= $orderuserdetail->user_mobile ?></td>
                </tr>
                <tr>
                  <td class=" "><b>Address</b></td>
                  <td data-cell-title="Address" class=" "><?= strtoupper($orderuserdetail->user_add_1) ?>, <?= strtoupper($orderuserdetail->user_add_2) ?> </td>
                </tr>
                <tr>
                  <td class=" "><b>City</b></td>
                  <td data-cell-title="City" class=" "><?= $orderuserdetail->user_city ?></td>
                </tr>
                <tr>
                  <td class=" "><b>State</b></td>
                  <td data-cell-title="State" class=" "><?= $orderuserdetail->user_state ?></td>
                </tr>
                <tr>
                  <td class=" "><b>Country</b></td>
                  <td data-cell-title="Country" class=" "><?= $orderuserdetail->user_country ?></td>
                </tr>
                <tr>
                  <td class=" "><b>Zip</b></td>
                  <td data-cell-title="Zip / Postal Code" class=" "><?= $orderuserdetail->user_zip_code ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <?php if($this->session->error){ ?>
              <div class="alert alert-danger">
                <?= $this->session->error ?>
              </div>
            <?php } ?>
            <?php if($this->session->success){ ?>
              <div class="alert alert-success">
                <?= $this->session->success ?>
              </div>
            <?php } ?>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
          <div class="main-login-info fon-info">
            <h3 class="checkout-head">Orders</h3>
            <hr>
            <div class="table-s order-history">
              <table class="table table-striped mb-0">
                <thead>
                  <tr>
                    <th>SKU</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>QTY</th>
                    <th>Total(₹)</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $subtotal = $totalgst = $discount = $total = 0;  
                      if($orderDetail){ foreach($orderDetail as $order){ 

                          $filename= pathinfo($order->combination_image,PATHINFO_FILENAME);
                          $file_ext = pathinfo($order->combination_image,PATHINFO_EXTENSION);

                          

                          $gst = ($order->order_sale_price*$order->order_qty)-(($order->order_sale_price*$order->order_qty) * (100 / (100 + 12)));
                  ?>
                    <tr>
                      <td><?= $order->combination_skucode ?></td>
                      <td><img src="<?= base_url() ?>uploads/products/thumbs/<?= $filename?>-50x50.<?= $file_ext ?>" alt="iMac" width="50"> </td>
                      <td><?= $order->product_name ?></td>
                      <td>₹ <?= $order->order_sale_price ?></td>
                      <td><?= $order->order_qty ?></td>
                      <td><b>₹ <?= ($order->order_sale_price*$order->order_qty) ?></b></td>

                      <?php

                        if($order->order_status == 'delivered'){
                          $now = time();
                          $your_date = strtotime($order->order_created_on);
                          $datediff = $now - $your_date;
                          $lastdate = round($datediff / (60 * 60 * 24));
                          $totalgst += $gst;
                          $subtotal += ($order->order_mrp*$order->order_qty);
                          $discount += ($order->order_discount*$order->order_qty);
                          $total += ($order->order_sale_price*$order->order_qty);
                          if($lastdate < 15){
                      ?>
                        <td>
                          <a href="<?= site_url('return-request') ?>?orderID=<?= $order->order_id?>&productID=<?= $order->combination_id?>" title="return">
                          <i class="fa fa-reply"></i>
                        </td>
                      <?php }}else if($order->order_status != 'canceled'){ 
                          $totalgst += $gst;
                          $subtotal += ($order->order_mrp*$order->order_qty);
                          $discount += ($order->order_discount*$order->order_qty);
                          $total += ($order->order_sale_price*$order->order_qty);
                      ?>
                        <td>
                          <a href="<?= site_url('cancel-request') ?>?orderID=<?= $order->order_id?>&productID=<?= $order->combination_id?>" title="cancel">
                          <i class="fa fa-times"></i>
                        </td>
                      <?php }else{ ?>
                        <td>
                          <span class="label label-warning">Canceled</span>
                        </td>
                      <?php } ?>
                    </tr>
                  <?php
                    
                 } } ?>
                </tbody>
              </table>
            </div>
            <div>
                <table class="table table-striped">
                    <tbody>
                      <tr>
                        <td><b>Sub Total</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align="right"><b>₹ <?= $this->cart->format_number($subtotal);?></b></td>
                      </tr>
                      <!-- <tr>
                        <td><b>COD</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align="right"><b>50.00</b></td>
                      </tr> -->
                      <tr>
                        <td><b>Discount</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align="right"><b>₹ <?= $this->cart->format_number($discount);?></b></td>
                      </tr>
                      <tr>
                        <td><b>Grand Total</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align="right"><b>₹ <?= $this->cart->format_number($total);?></b></td>
                      </tr>
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>