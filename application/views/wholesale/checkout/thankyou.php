  <div class="ps-hero bg--cover" data-background="<?= base_url() ?>assets/user/images/hero/bread-1.jpg">
    <div class="ps-container">
      <h3>Order Confirmation</h3>
      <div class="ps-breadcrumb">
        <ol class="breadcrumb">
          <li><a href="<?= site_url() ?>">Home</a></li>
          <li class="active">Order Confirmation</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="ps-checkout">
    <div class="ps-container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="text-center">
            <h2>Thank You</h2>
            <h4>Your Order has been Confirmed</h4>
            <ul>
              <li>Order ID : <span><?= $transaction_order_id; ?></span></li>
              <li>Transaction ID : <span><?= $transaction_id; ?></span></li>
              <li>Transaction Status : <span><?= $transaction_status; ?></span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>