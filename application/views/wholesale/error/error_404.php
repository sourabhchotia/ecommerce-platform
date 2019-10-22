<div class="ps-404">
  	<div class="container">
    	<h1>404 <span> Page not found</h1>
    	<p>We are looking for your page … but we can’t find it</p>
    	<a class="ps-btn" href="<?php if(isset($_SERVER['HTTP_REFERER'])){ echo $_SERVER['HTTP_REFERER']; }else{ echo site_url(); }?>">Back to Home</a><br>
    	<img src="<?= base_url() ?>assets/user/images/404.png" alt="">
  	</div>
</div>