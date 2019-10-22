<div class="ps-hero bg--cover" data-background="<?= base_url() ?>assets/user/images/hero/bread-2.jpg">
  <div class="ps-container">
    <h3><?= ucfirst($product->product_name) ?></h3>
    <div class="ps-breadcrumb">
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>">Home</a></li>
        <li class="active"><?= ucfirst($product->product_name) ?></li>
      </ol>
    </div>
  </div>
</div>
<main class="ps-main">
  <div class="ps-container">
    <div class="ps-product--detail">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
          <div class="ps-product__thumbnail">
            <div class="ps-product__image">
              <?php 
                $filename= pathinfo($product->combination_image,PATHINFO_FILENAME);
                $file_ext = pathinfo($product->combination_image,PATHINFO_EXTENSION);
              ?>
              <div class="item">
                <a href="<?= base_url() ?>uploads/products/<?= $product->combination_image ?>">
                  <img src="<?= base_url() ?>uploads/products/thumbs/<?= $filename ?>-500x700.<?= $file_ext ?>" alt="">
                </a>
              </div>

            <?php  foreach(explode(',', $product->combination_gallery) as $img){ 
              $filename= pathinfo($img,PATHINFO_FILENAME);
              $file_ext = pathinfo($img,PATHINFO_EXTENSION);
            ?>
              <div class="item">
                <a href="<?= base_url() ?>uploads/products/<?= $img ?>">
                  <img src="<?= base_url() ?>uploads/products/thumbs/<?= $filename ?>-500x700.<?= $file_ext ?>" alt="">
                </a>
              </div> 
            <?php } ?>
            </div>

            <?php 
              $filename= pathinfo($product->combination_image,PATHINFO_FILENAME);
              $file_ext = pathinfo($product->combination_image,PATHINFO_EXTENSION);
            ?>
            <div class="ps-product__preview">
              <div class="ps-product__variants">
                <div class="item"><img src="<?= base_url() ?>uploads/products/thumbs/<?= $filename ?>-500x700.<?= $file_ext ?>" alt=""></div>

                <?php  foreach(explode(',', $product->combination_gallery) as $img){ 
                  $filename= pathinfo($img,PATHINFO_FILENAME);
                  $file_ext = pathinfo($img,PATHINFO_EXTENSION);
                ?>
                <div class="item"><img src="<?= base_url() ?>uploads/products/thumbs/<?= $filename ?>-200x350.<?= $file_ext ?>" alt=""></div>
                <?php } ?>
              </div>
              <!-- <div class="ps-video"><a class="popup-youtube ps-product__video"
                href="https://www.youtube.com/watch?v=meBbDqAXago"><img src="<?= base_url() ?>assets/user/images/product/detail/variant-5.jpg"
                alt=""><i class="fa fa-play"></i></a>
              </div> -->
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
          <div class="ps-product__info">
            <div class="ps-product__rating">
              <select class="ps-rating">
                <option value="1">1</option>
                <option value="1">2</option>
                <option value="1">3</option>
                <option value="1">4</option>
                <option value="2">5</option>
              </select><a href="javascript:void(0);">(Read all 8 reviews)</a>
            </div>
            <h1><?= ucfirst($product->product_name) ?></h1>
            <?php if($product->combination_price > $product->combination_sale_price){ ?>
              <h3 class="ps-product__price"><del><span>₹</span> <?= $product->combination_price; ?></del> <span>₹</span> <?= $product->combination_sale_price; ?></h3>
            <?php }else{ ?>
              <h3 class="ps-product__price"><span>₹</span> <?= $product->combination_sale_price; ?></h3>
            <?php } ?>
            <div class="ps-product__short-desc">
              <p><?= $product->product_short_description ?></p>
            </div>

            <div class="support_info">
              <ul class="h-clearlist object-capacity">
                <li class="object-capacity__item">
                  <div class="object-capacity__iconbox">
                    <img alt="Size (m2)" class="object-capacity__icon" src="<?= base_url() ?>assets/user/images/size.png">
                  </div>
                  <div class="object-capacity__info">
                    <p class="object-capacity__title">Size/Capacity</p>
                    <span class="object-capacity__number">
                      200 ML
                    </span>
                  </div>
                </li>

                <li class="object-capacity__item">
                  <div class="object-capacity__iconbox">
                    <img alt="Size (m2)" class="object-capacity__icon" src="<?= base_url() ?>assets/user/images/quality.png">
                  </div>
                  <div class="object-capacity__info">
                    <p class="object-capacity__title">Quality</p>
                    <span class="object-capacity__number">High
                    </span>
                  </div>
                </li>

                <li class="object-capacity__item">
                  <div class="object-capacity__iconbox">
                    <img alt="Size (m2)" class="object-capacity__icon" src="<?= base_url() ?>assets/user/images/material.png">
                  </div>
                  <div class="object-capacity__info">
                    <p class="object-capacity__title">Material</p>
                    <span class="object-capacity__number">
                      Glass
                    </span>
                  </div>
                </li>

                <li class="object-capacity__item">
                  <div class="object-capacity__iconbox">
                    <img alt="Size (m2)" class="object-capacity__icon" src="<?= base_url() ?>assets/user/images/food-grade.png">
                  </div>
                  <div class="object-capacity__info">
                    <p class="object-capacity__title">Food Grade</p>
                    <span class="object-capacity__number">
                      <span class="glyphicon glyphicon-ok"></span>
                    </span>
                  </div>
                </li>
              </ul>
            </div>

            <div class="ps-product__block ps-product__size">
              <h4>CHOOSE YOUR COLOR</h4>
              <div class="ps-radio ps-radio--color ps-radio--inline color-1">
                <div class="ps-checkbox ps-checkbox--inline ps-checkbox--color color-1">
                  <?php
                    if($assigned){
                    foreach($assigned as $value){
                      $filename= pathinfo($value->combination_image,PATHINFO_FILENAME);
                      $file_ext = pathinfo($value->combination_image,PATHINFO_EXTENSION);
                  ?>
                    <a class="img thumbnail" title="<?= $value->option_display_name ?>" style="width: 50px;display: inline-block;" href="<?= site_url($value->combination_slug)?>">
                      <img width="50" src="<?= base_url() ?>uploads/products/thumbs/<?= $filename ?>-50x50.<?= $file_ext ?>" title="<?= $value->option_display_name ?>" alt="<?= $value->option_display_name ?>">
                    </a>
                  <?php } } ?>
                  </div>
                </div>
              <div class="form-group ps-number">
                <input type="hidden" value="<?= $product->product_min_qty ?>" name="minQty" id="minQty">
                <input type="hidden" value="<?= $product->combination_stock ?>" name="stock" id="stock">
                <input class="form-control" type="text" value="<?= $product->product_min_qty ?>" name="qty"><span class="up"></span><span class="down"></span>
              </div>
            </div>
            <?php if($already){ ?>
              <div class="ps-product__shopping">
                <a class="ps-btn" href="<?= site_url('cart')?>">Go to Cart</a>
              </div>
            <?php }else{ ?>
            <div class="ps-product__shopping">
              <button type="button" class="ps-btn add_to_cart" href="javascript:void(0);" data-type="cart" data-combo-id="<?= $product->combination_id ?>">Add To Cart</button>
              <div class="ps-product__actions">
                <button type="button" class="mr-5 add_wishlist" href="javascript:void(0);"><i class="furniture-heart"></i></button>
                <!-- <button type="button" href="compare.html" title="Compare"><i class="furniture-reload"></i></button> -->
              </div>
            </div>
            <?php } ?>
            <div class="ps-product__sharing">
              <p>Share this:
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-dribbble"></i></a>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="ps-product__content">
        <ul class="tab-list" role="tablist">
          <li class="active"><a href="#tab_01" aria-controls="tab_01" role="tab" data-toggle="tab">Overview</a></li>
          <li><a href="#tab_02" aria-controls="tab_02" role="tab" data-toggle="tab">Review</a></li>
        </ul>
      </div>
      <div class="tab-content">
        <div class="tab-pane active" role="tabpanel" id="tab_01">
         <?= $product->product_description ?>

         <h4 style="padding: 38px 0px 10px 0px;">All Features</h4>
         <div class="row">
          <div class="col-md-8">
            <div class="table-responsive">
              <table class="table-bordered table-striped table">
                <tbody>
                  <?php 
                    
                    foreach($productOptions as $option){
                  ?>
                  <tr>
                    <td class="text-center"><?= $option->p_attribute_name ?></td>
                    <td class="text-center">
                      <?php 
                        foreach($all_options as $all){
                          if($all->option_id == $option->p_attribute_value){

                            echo $all->option_display_name;
                          }
                        }
                      ?>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
        <div class="tab-pane" role="tabpanel" id="tab_02">
          <p>1 review for <strong>Shoes Air Jordan</strong></p>
          <div class="ps-review">
            <div class="ps-review__thumbnail"><img src="<?= base_url() ?>assets/user/images/user/1.jpg" alt=""></div>
            <div class="ps-review__content">
              <header>
                <select class="ps-rating">
                  <option value="1">1</option>
                  <option value="1">2</option>
                  <option value="1">3</option>
                  <option value="1">4</option>
                  <option value="5">5</option>
                </select>
                <p>By<a href=""> Alena Studio</a> - November 25, 2017</p>
              </header>
              <p>Soufflé danish gummi bears tart. Pie wafer icing. Gummies jelly beans powder. Chocolate bar pudding
                macaroon candy canes chocolate apple pie chocolate cake. Sweet caramels sesame snaps halvah bear claw
                wafer. Sweet roll soufflé muffin topping muffin brownie. Tart bear claw cake tiramisu chocolate bar
              gummies dragée lemon drops brownie.</p>
            </div>
          </div>
          <form class="ps-form--product-review" action="do_action" method="post">
            <h4>ADD YOUR REVIEW</h4>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                <div class="form-group">
                  <label>Name:<sup>*</sup></label>
                  <input class="form-control" type="text" placeholder="">
                </div>
                <div class="form-group">
                  <label>Email:<sup>*</sup></label>
                  <input class="form-control" type="email" placeholder="">
                </div>
                <div class="form-group">
                  <label>Your rating</label>
                  <select class="ps-rating">
                    <option value="1">1</option>
                    <option value="1">2</option>
                    <option value="1">3</option>
                    <option value="1">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 ">
                <div class="form-group">
                  <label>Your Review:</label>
                  <textarea class="form-control" rows="6"></textarea>
                </div>
                <div class="form-group">
                  <button class="ps-btn">Submit Reviews</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<div class="ps-section ps-home-promotions">
  <div class="ps-container">
    <div class="ps-section__header text-center">
      <p>Here are key products that bring fashionistas to Furniture Store.</p>
      <h3 class="ps-section__title">YOU MIGHT ALSO LIKE</h3><span class="ps-section__line"></span>
    </div>
    <div class="ps-section__content">
      <div class="ps-slider--center owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="off">
        <?php if($related){ foreach($related as $relate){

          $filename= pathinfo($product->product_image,PATHINFO_FILENAME);
          $file_ext = pathinfo($product->product_image,PATHINFO_EXTENSION);
        ?>
        <div class="ps-product">
          <div class="ps-product__thumbnail">
            <?php if($relate->is_featured == '1'){ ?>
              <div class="ps-badge"><span>Featured</span></div>
            <?php } ?>

            <?php 
              $price = $relate->combination_price;
              $sale = $relate->combination_sale_price;

              $off = (($price - $sale)/$price)*100;

              if($off > 0){
            ?>
              <div class="ps-badge ps-badge--sale"><span>-<?= $off ?>%</span></div>
            <?php } ?>
            <a class="ps-product__favorite add_wishlist" href="javascript:void(0);" data-combo-id="<?= $product->combination_id ?>"><i class="furniture-heart"></i></a>
            <img src="<?= base_url() ?>uploads/products/thumbs/<?= $filename ?>-500x700.<?= $file_ext ?>" alt="">
            <a class="ps-product__overlay" href="<?= site_url($product->combination_slug) ?>" target="_blank"></a>
          </div>
          <div class="ps-product__content">
            <select class="ps-rating">
              <option value="1">1</option>
              <option value="1">2</option>
              <option value="1">3</option>
              <option value="1">4</option>
              <option value="2">5</option>
            </select><a class="ps-product__title" href="<?= site_url($product->combination_slug) ?>"><?= $product->product_name; ?></a>
            <!-- <div class="ps-product__categories"><a href="product-listing.html">Armchair</a></div> -->
            <p class="ps-product__price">
              <?php if($product->combination_price > $product->combination_sale_price){ ?>
                <del>₹ <?= $product->combination_price; ?></del>₹ <?= $product->combination_sale_price; ?>
              <?php }else{ ?>
                ₹ <?= $product->combination_sale_price; ?>
              <?php } ?>
            </p>
          </div>
        </div>
        <?php } } ?>
      </div>
    </div>
  </div>
</div>