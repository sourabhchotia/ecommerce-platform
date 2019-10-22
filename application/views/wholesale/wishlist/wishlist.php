<div class="ps-hero bg--cover" data-background="<?= base_url() ?>assets/user/images/hero/bread-1.jpg">
      <div class="ps-container">
        <h3>Whislist</h3>
        <div class="ps-breadcrumb">
          <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li class="active">Whislist</li>
          </ol>
        </div>
      </div>
    </div>
    <div class="ps-content">
      <div class="ps-container">
        <div class="table-responsive">
          <table class="table ps-table ps-table--whishlist">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Remove</th>
              </tr>
            </thead>
            <tbody>

              <?php if($wishlist){ foreach($wishlist as $wish){ 
                      $filename= pathinfo($wish->product_image,PATHINFO_FILENAME);
                      $file_ext = pathinfo($wish->product_image,PATHINFO_EXTENSION);
              ?>
                <tr>
                  <td>
                    <img class="mr-15" src="<?= base_url() ?>uploads/products/thumbs/<?= $filename ?>-50x50.<?= $file_ext ?>" alt="">
                  </td>
                  <td>
                    <a class="ps-product--compare" href="<?= site_url($wish->combination_slug) ?>" target="_blank">
                       <?= $wish->product_name; ?>
                    </a>
                  </td>
                  <td><strong>₹ <?= $wish->combination_sale_price; ?></strong></td>
                  <td>
                    <?php if($wish->combination_stock > 5){ ?>

                      <span class="label label-success">In Stock</span>

                    <?php }else if($wish->combination_stock > 0 && $wish->combination_stock < 5){?> 

                      <span class="label label-warning">Hurry, Few Left</span>

                    <?php }else{ ?>
                      <span class="label label-danger">Out of Stock</span>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if($wish->combination_stock > 0){ ?>
                      <input type="hidden" value="<?= $wish->product_min_qty ?>" name="minQty" id="minQty">
                      <input type="hidden" value="<?= $wish->combination_stock ?>" name="stock" id="stock">
                    <a class="ps-product__favorite add_to_cart" href="javascript:void(0);" data-combo-id="<?= $wish->combination_id ?>" data-type="wishlist">
                      <i class="fa fa-shopping-cart"></i>
                    </a>
                    &nbsp;&nbsp;
                  <?php } ?>
                    
                    <a class="ps-product__favorite remove_item" href="javascript:void(0);" data-combo-id="<?= $wish->wishlist_id ?>">
                      <i class="fa fa-times"></i>
                    </a>
                  </td>
                </tr>
              <?php } }else{ ?>
                <tr>
                  <td colspan="5">
                      <h4>No ITEM in Wishlist</h4>
                  </td>
                </tr>

              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>