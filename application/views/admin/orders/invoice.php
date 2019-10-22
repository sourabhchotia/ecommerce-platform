<!DOCTYPE html>
<html dir="ltr" lang="en">
<body>
    <div id="main-wrapper">     
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body printableArea">
                            <div class="row">
                                <div class="col-md-6 pull-left">
                                    <h3><b><img src="<?= base_url() ?>assets/user/images/logo.png" alt=""></b></h3>
                                </div>
                                <div class="col-md-6 pull-right text-right">
                                    <h3><b>INVOICE No : </b> <span class="pull-right">#<?= $orderuserdetail->order_id ?></span></h3>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                    <div class="pull-left col-md-6">
                                        <address>
                                            <h3>From,</h3>
                                            <p class="text-muted m-l-5">E 104, Dharti-2,
                                                <br/> Nr' Viswakarma Temple,
                                                <br/> Talaja Road,
                                                <br/> Bhavnagar - 364002</p>
                                            <p class="m-t-30"><b>Invoice Date :</b> <i class="fa fa-calendar"></i> <?= date('d',strtotime($orderuserdetail->order_created_on))?> <?= date('M',strtotime($orderuserdetail->order_created_on))?> <?= date('Y',strtotime($orderuserdetail->order_created_on))?></p>
                                        </address>
                                    </div>
                                    <div class="pull-right text-right col-md-6">
                                        <address>
                                            <h3>To,</h3>
                                            <h4 class="font-bold"><?= $orderuserdetail->user_name ?>,</h4>
                                            <p class="text-muted m-l-30"><?= strtoupper($orderuserdetail->user_add_1) ?>
                                                <br/> <?= strtoupper($orderuserdetail->user_add_2) ?>
                                                <br/> <?= $orderuserdetail->user_city ?>, <?= $orderuserdetail->user_state ?>
                                                <br/> <?= $orderuserdetail->user_country ?>, <?= $orderuserdetail->user_zip_code ?></p>
                                                <p class="m-t-30"><b><i class="fa fa-mobile-alt"></i></b> (+91) <?= $orderuserdetail->user_add_mobile ?>, <b><i class="fa fa-envelope"></i></b> <?= $orderuserdetail->user_email ?></p>
                                        </address>
                                    </div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-left" style="width: 250px;">Name</th>
                                                    <th class="text-right">QTY</th>
                                                    <th class="text-right">Sale</th>
                                                    <?php if($orderuserdetail->user_state == 'RAJASTHAN'){ ?>
                                                    <th class="text-right">SGST</th>
                                                    <th class="text-right">CGST</th>
                                                    <?php }else{ ?>
                                                    <th class="text-right">IGST</th>
                                                    <?php } ?>
                                                    <th class="text-right">Discount</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $subtotal = $totalgst = $discount = $total = 0;  
                                                    if($orderDetail){ foreach($orderDetail as $order){ 

                                                        $subtotal += ($order->order_mrp*$order->order_qty);
                                                        $discount += ($order->order_discount*$order->order_qty);
                                                        $total += ($order->order_sale_price*$order->order_qty);

                                                        $gst = ($order->order_sale_price*$order->order_qty)-(($order->order_sale_price*$order->order_qty) * (100 / (100 + 12)));
                                                ?>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>
                                                        <h5><?= $order->product_name ?></h5>
                                                        <h6><b>SKU : </b> <span class="pull-right"><?= $order->combination_skucode ?></span></h6>
                                                        <h6><b>Color : </b> <span class="pull-right"><?= $order->option_name ?></span></h6>
                                                    </td>
                                                    <td class="text-right"><?= $order->order_qty ?></td>
                                                    <td class="text-right"> ₹ <?= $order->order_mrp ?> </td>
                                                    <?php if($orderuserdetail->user_state == 'RAJASTHAN'){ ?>
                                                    <td class="text-right"> ₹ <?= round($gst/2,2) ?> </td>
                                                    <td class="text-right"> ₹ <?= round($gst/2,2) ?> </td>
                                                    <?php }else{ ?>
                                                    <td class="text-right"> ₹ <?= round($gst,2) ?> </td>
                                                    <?php } ?>
                                                    <td class="text-right"> ₹ <?= ($order->order_discount*$order->order_qty) ?> </td>
                                                    <td class="text-right"> ₹ <?= ($order->order_sale_price*$order->order_qty) ?> </td>
                                                </tr>
                                                <?php
                                                    $totalgst += $gst;
                                                 } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        <p>Sub Total: ₹ <?= $this->cart->format_number($subtotal);?></p>
                                        <p>GST : ₹ <?= $this->cart->format_number($totalgst);?></p>
                                        <p>Discount : ₹ <?= $this->cart->format_number($discount);?> </p>
                                        <hr>
                                        <h3><b>Total :</b> ₹ <?= $this->cart->format_number($total);?></h3>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/app-style-switcher.js"></script>
    <script src="<?= base_url() ?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/custom.min.js"></script>
    <style type="text/css">
        #main-wrapper[data-layout=vertical][data-header-position=fixed] .page-wrapper {
             padding-top: 0px; 
        }
        #main-wrapper[data-layout=vertical][data-sidebartype=full] .page-wrapper {
             margin-left: 0px; 
        }
    </style>
</body>
</html>