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
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
          <div class="main-login-info fon-info">
            <h3 class="checkout-head">Orders</h3>
            <hr>
            <div class="table-s">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Order Number</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($orders){ foreach($orders as $order){?>
                    <tr>
                      <td><a href="<?= site_url('order-detail') ?>?orderID=<?= $order->order_id?>">#<?= $order->order_id?></a></td>
                      <td><?= date('d M Y', strtotime($order->order_created_on)) ?></td>
                      <td><?= ucfirst($order->order_status) ?></td>
                      <td>₹ <?= $order->price * $order->qty?></td>
                      <td>
                        <a href="<?= site_url('order-invoice') ?>?orderID=<?= $order->order_id?>" target="_blank">
                          <i class="fa fa-download"></i>
                        </a>
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
  </div>