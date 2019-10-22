<?php if($sliders){ ?>
<div class="ps-slider--banner owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="9000"
    data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1"
    data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
    <?php foreach($sliders as $slide){ ?>
	    <div class="ps-product--banner item">
	      <div class="ps-product__thumbnail">
	      	<a href="<?php if($slide->slider_page_url){ echo $slide->slider_page_url; }else{ echo 'javascript:void(0)'; }?>">
	      		<img src="<?= base_url() ?>uploads/sliders/<?= $slide->slider_image ?>" alt="<?= $slide->slider_image ?>">
	      	</a>
	      </div>
	    </div>
	<?php } ?>


</div>
<?php } ?>