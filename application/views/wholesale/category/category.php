<div class="ps-hero bg--cover" data-background="<?= base_url() ?>assets/user/images/hero/bread-1.jpg">
      <div class="ps-container">
        <h3><?= ucfirst($category->category_name )?></h3>
        <div class="ps-breadcrumb">
          <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li class="active"><?= ucfirst($category->category_name )?></li>
          </ol>
        </div>
      </div>
    </div>
    <main class="ps-main">
      <div class="ps-container">
        <div class="ps-filter">
          <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 ">
                  <div class="ps-filter__trigger">
                    <div class="ps-filter__icon"><span></span></div>
                    <p>Filter Product</p>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                  <div class="ps-filter__result">
                    <p>Showing 1–12 of 35 results</p>
                  </div>
                </div>
          </div>
          <div class="ps-filter__content">
            <div class="ps-filter__column" data-mh="column">
              <h3>SORT CATEGORIES BY</h3>
              <ul class="ps-list--filter">
                <?php if($parentCategory){ foreach($parentCategory as $parent){ ?>
                  <li class="<?php if($parent->category_id == $current){ echo 'current'; }?>"><a href="<?= site_url($parent->category_slug)?>"><?= $parent->category_name ?></a></li>

                  <?php if($mainCategory){ foreach($mainCategory as $main){ if($main->parent_category == $parent->category_id){?>
                    <li class="<?php if($main->category_id == $current){ echo 'current'; }?>">-<a href="<?= site_url($main->category_slug)?>"><?= $main->category_name ?></a></li>
                  <?php } ?>
                      <?php if($subCategory){ foreach($subCategory as $sub){ if($sub->parent_category == $main->category_id){?>
                        <li class="<?php if($sub->category_id == $current){ echo 'current'; }?>">--<a href="<?= site_url($sub->category_slug)?>"><?= $sub->category_name ?></a></li>
                      <?php } ?>
                        <?php if($innerCategory){ foreach($innerCategory as $inner){ if($inner->parent_category == $sub->category_id){?>
                          <li class="<?php if($inner->category_id == $current){ echo 'current'; }?>">---<a href="<?= site_url($inner->category_slug)?>"><?= $inner->category_name ?></a></li>
                        <?php } ?>  
                        <?php } } ?>
                      <?php } } ?>

                  <?php } } ?>
                <?php } } ?>
              </ul>
            </div>
            <div class="ps-filter__column" data-mh="column">
              <h3>SORT PRODUCTS BY</h3>
              <ul class="ps-list--filter">
                <li class="<?php if($this->input->get('sortby') == 'default'){ echo 'current'; }?>"><a href="javascript:void(0);" data-value="default" class="priceFilter">Default Sorting</a></li>
                <li class="<?php if($this->input->get('sortby') == 'low'){ echo 'current'; }?>"><a href="javascript:void(0);" data-value="low" class="priceFilter">Sort by price: low to high</a></li>
                <li class="<?php if($this->input->get('sortby') == 'high'){ echo 'current'; }?>"><a href="javascript:void(0);" data-value="high" class="priceFilter">Sort by price: high to low</a></li>
              </ul>
            </div>
            <div class="ps-filter__column" data-mh="column">
              <h3>FILTER BY COLOR</h3>
              <ul class="ps-list--color">
                <?php if($attributes){ 
                  foreach($attributes as $key => $att){ 
                    if($key == 'COLOR'){ 

                      foreach($att as $color){ ?>

                      <li><a href="javascript:void(0);" title="<?= $color['option_display_name'] ?>" style="background-color: <?= $color['option_value']; ?>" class="<?php if(in_array($color['option_id'], $colors)){ echo 'active';}?> colorFilter" data-value="<?= $color['option_name'] ?>"></a></li>

                <?php } } } } ?>
                <?php foreach($totalcolors as $color){ ?>
                <input type="hidden" name="allColors[]" value="<?=  $color ?>">
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <?php if($products){ foreach($products as $product){ 
            $filename= pathinfo($product->combination_image,PATHINFO_FILENAME);
            $file_ext = pathinfo($product->combination_image,PATHINFO_EXTENSION);
          ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
              <div class="ps-product">
                <div class="ps-product__thumbnail">
                  <?php if($product->is_featured == '1'){ ?>
                    <div class="ps-badge"><span>Featured</span></div>
                  <?php } ?>

                  <?php 
                    $price = $product->combination_price;
                    $sale = $product->combination_sale_price;

                    $off = (($price - $sale)/$price)*100;

                    if($off > 0){
                  ?>
                    <div class="ps-badge ps-badge--sale"><span>-<?= $off ?>%</span></div>
                  <?php } ?>
                  <a class="ps-product__favorite add_wishlist" href="javascript:void(0);" data-combo-id="<?= $product->combination_id ?>">
                    <i class="furniture-heart"></i>
                  </a>
                  <img src="<?= base_url() ?>uploads/products/thumbs/<?= $filename ?>-500x700.<?= $file_ext ?>" alt="">
                  <a class="ps-product__overlay" href="<?= site_url($product->combination_slug) ?>" target="_blank"></a>
                  <div class="ps-product__content full">
                    <?php 

                      $this->db->where('combination_product',$product->product_id);
                      $this->db->where('combination_id !=',$product->combination_id);
                      $variants = $this->db->get('whole_product_combinations');

                      if($variants->num_rows() > 0){
                    ?>
                      <div class="ps-product__variants">
                        <?php foreach($variants->result() as $variant){ 
                          $filename= pathinfo($variant->combination_image,PATHINFO_FILENAME);
                          $file_ext = pathinfo($variant->combination_image,PATHINFO_EXTENSION);
                        ?>
                          <div class="item">
                            <a href="<?= site_url($variant->combination_slug) ?>" target="_blank">
                              <img src="<?= base_url() ?>uploads/products/thumbs/<?= $filename ?>-50x50.<?= $file_ext ?>" alt="<?= $variant->combination_slug ?>">
                            </a>
                          </div>
                        <?php } ?>
                      </div>
                    <?php } ?>
                        <select class="ps-rating">
                          <option value="1">1</option>
                          <option value="1">2</option>
                          <option value="1">3</option>
                          <option value="1">4</option>
                          <option value="2">5</option>
                        </select>
                        <a class="ps-product__title" href="<?= site_url($product->combination_slug) ?>" target="_blank"><?= $product->product_name; ?></a>
                    <!-- <div class="ps-product__categories"><a href="product-listing.html">Armchair</a></div> -->
                    <p class="ps-product__price">
                      <?php if($product->combination_price > $product->combination_sale_price){ ?>
                        <del>₹ <?= $product->combination_price; ?></del>₹ <?= $product->combination_sale_price; ?>
                      <?php }else{ ?>
                        ₹ <?= $product->combination_sale_price; ?>
                      <?php } ?>
                    </p>
                    <a class="ps-btn ps-btn--sm add_to_cart" href="javascript:void(0);" data-combo-id="<?= $product->combination_id ?>" data-type="cart">Add to cart</a>
                    <p class="ps-product__feature"><i class="furniture-delivery-truck-2"></i>Free Shipping in 24 hours</p>
                  </div>
                </div>
                <div class="ps-product__content">
                    <select class="ps-rating">
                      <option value="1">1</option>
                      <option value="1">2</option>
                      <option value="1">3</option>
                      <option value="1">4</option>
                      <option value="2">5</option>
                    </select>
                    <a class="ps-product__title" href="<?= site_url($product->combination_slug) ?>" target="_blank">
                      <?= $product->product_name; ?>
                    </a>
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
            </div>
          <?php } }?>
        </div>
      </div>
      <!-- <div class="ps-pagination">
        <ul class="pagination">
          <li><a href="javascript:void(0);"><i class="fa fa-angle-left"></i></a></li>
          <li class="active"><a href="javascript:void(0);">1</a></li>
          <li><a href="javascript:void(0);">2</a></li>
          <li><a href="javascript:void(0);">3</a></li>
          <li><a href="javascript:void(0);">...</a></li>
          <li><a href="javascript:void(0);"><i class="fa fa-angle-right"></i></a></li>
        </ul>
      </div> -->
    </main>