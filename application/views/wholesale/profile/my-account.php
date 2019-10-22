<div class="ps-hero bg--cover" data-background="<?= base_url() ?>assets/user/images/hero/bread-1.jpg">
    <div class="ps-container">
      <h3>My Account</h3>
      <div class="ps-breadcrumb">
        <ol class="breadcrumb">
          <li><a href="<?= base_url() ?>">Home</a></li>
          <li class="active">My Account</li>
        </ol>
      </div>
    </div>
  </div>
<div class="ps-checkout">
  <div class="ps-container">

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
        <form class="ps-form--checkout" action="#" method="post" id="profileUpdate">
          <div class="main-login-info fon-info">
            <h3 class="checkout-head">Personal Details</h3>
            <hr>
            <div class="row">
              <div class="col-md-12 mb-20">
                <label>Name</label>
                <div class="input-field">
                  <input type="text" class="form-control" placeholder="Name" name="username" value="<?= $profile->user_name ?>">
                </div>
              </div>
              <div class="col-md-12 mb-20">
                <label>E-Mail</label>
                <div class="input-field">
                  <input type="text" class="form-control" placeholder="E-Mail" name="email" value="<?= $profile->user_email ?>">
                </div>
              </div>
              <div class="col-md-12 mb-20">
                <label>Telephone</label>
                <div class="input-field">
                  <input type="text" class="form-control" placeholder="Telephone" name="phone" value="<?= $profile->user_mobile ?>">
                </div>
              </div>
              <div class="col-md-12 mb-20 otpField">
                <label>OTP</label>
                <div class="input-field">
                  <input type="text" class="form-control" placeholder="OTP" name="otp" >
                </div>
              </div>
              <div class="btn-address">
                <button class="ps-btn proceed-tocheck" type="submit"> Update Details</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
        <form class="ps-form--checkout" action="#" method="post" id="passwordChange">
          <div class="main-login-info fon-info">
            <h3 class="checkout-head">Change Password</h3>
            <hr>
            <div class="row">
              <div class="col-md-12 mb-20">
                <label>Old Password</label>
                <div class="input-field">
                  <input type="password" class="form-control" placeholder="Old Password" name="oldpassword" id="oldpassword">
                </div>
              </div>
              <div class="col-md-12 mb-20">
                <label>New Password</label>
                <div class="input-field">
                  <input type="password" class="form-control" placeholder="New Password" name="newpassword" id="profilePassword">
                </div>
              </div>
              <div class="col-md-12 mb-20">
                <label>New Password Confirm</label>
                <div class="input-field">
                  <input type="password" class="form-control" placeholder="New Password Confirm" name="confirmpassword" id="confirmProfilePassword">
                </div> 
              </div>
              <div class="btn-address">
                <button class="ps-btn proceed-tocheck" type="submit"> Change Password</button>
              </div>
            </div>


          </div>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="main-login-info">
          <h4 class="info-log">Your Address</h4>
          <hr class="checkout-hr">
          <?php if($address){ foreach($address as $add){ ?>
            <div class="address-details bg-grey clearfix mb-15">
              <div class="pull-left text-center">
                <i class="fa fa-map-marker"></i>
              </div>
              <div class="col-md-9 col-xs-10">
                <p><?= $add->user_add_name ?>, <?= $add->user_add_mobile ?>, <?= $add->user_add_1 ?>, <?= $add->user_add_2 ?><br> <?= $add->user_city ?>, <?= $add->user_state ?>, <?= $add->user_country ?>, <?= $add->user_zip_code ?></p>
              </div>
              <div class="col-md-2 col-xs-1">
                <button class="ps-btn--close ps-btn--no-boder deleteAddress font3" data-id="<?= $add->add_id ?>"></button>
              </div>
            </div>
          <?php } } ?>

          <div class="btn-address col-md-2 col-md-offset-10 pt-10">
            <a type="submit" class="btn btn-default btn-set-adress w-100" data-toggle="modal"
            data-target="#myModal"><i class="fa fa-map-marker"></i> Add Address</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>