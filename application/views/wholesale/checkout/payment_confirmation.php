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
            <form class="ps-form--checkout" action="<?= $action ?>" method="post" id="payuForm">
              <div class="main-login-info fon-info">
                <h3 class="checkout-head">Payment Confirmation</h3>
                <hr>
                <div class="row">
                  <?php if($details){ foreach($details as $key => $detail){ 

                      if($key == 'firstname' || $key == 'productinfo' || $key == 'email' || $key == 'phone' || $key == 'amount'){

                        $type = 'text';

                      }else{
                        $type = 'hidden';
                      }
                  ?>
                    <div class="col-md-6 mb-20">
                      <div class="input-field">
                        <input  type="<?= $type ?>" class="form-control" name="<?= $key ?>" value="<?= $detail ?>">
                      </div>
                    </div>
                  <?php } }else if($access_code){ ?>

                    <div class="col-md-6 mb-20">
                      <div class="input-field">
                        <input  type="text" class="form-control" name="encRequest" value="<?= $encRequest ?>">
                      </div>
                    </div>
                    <div class="col-md-6 mb-20">
                      <div class="input-field">
                        <input  type="hidden" class="form-control" name="access_code" value="<?= $access_code ?>">
                      </div>
                    </div>
                  <?php }else if($paramList){  ?>

                    <?php foreach($paramList as $key => $paramList){ ?>
                      <div class="col-md-6 mb-20">
                        <div class="input-field">
                          <input  type="text" class="form-control" name="<?= $key ?>" value="<?= $paramList ?>">
                        </div>
                      </div>
                    <?php } ?>
                    <div class="col-md-6 mb-20">
                        <div class="input-field">
                          <input  type="text" class="form-control" name="CHECKSUMHASH" value="<?= $CHECKSUMHASH ?>">
                        </div>
                      </div>
                  <?php } ?>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var payuForm = document.forms.payuForm;
    setTimeout(function(){
      payuForm.submit();
    },1000);
  </script>