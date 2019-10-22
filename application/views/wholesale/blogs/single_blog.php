<div class="ps-hero bg--cover" data-background="<?= base_url() ?>assets/user/images/hero/bread-1.jpg">
      <div class="ps-container">
        <h3><?= ucfirst($blog->blog_name)?></h3>
        <div class="ps-breadcrumb">
          <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li class="active"><?= ucfirst($blog->blog_name)?></li>
          </ol>
        </div>
      </div>
    </div>
    <main class="ps-main">
      <div class="ps-container">
        <div class="ps-blog">
          <div class="row">
                <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 ">
                  <div class="ps-post--detail">
                    <div class="ps-post__thumbnail"><img src="<?= base_url() ?>assets/user/images/post/detail.jpg" alt=""></div>
                    <div class="ps-post__content">
                      <div class="ps-post__meta">
                        <div class="ps-post__posted"><span class="date">25</span><span class="month">Dec</span></div>
                        <div class="ps-post__actions">
                          <div class="ps-post__action red"><a href="#"><i class="furniture-heart"></i><span><i>10</i></span></a></div>
                          <div class="ps-post__action cyan"><a href="#"><i class="fa fa-comment-o"></i><span><i>5</i></span></a></div>
                          <div class="ps-post__action shared"><a href="#"><i class="fa fa-share-alt"></i> Share</a>
                            <ul class="ps-list--shared">
                              <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                              <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                              <li class="google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="ps-post__container">
                        <h3 class="ps-post__title"><?= ucfirst($blog->blog_name)?></h3>
                        <p class="ps-post__info">Posted by <a href="javascript:void(0);" class="author">Alena Studio </a>- <a href="blog-grid.html">Men Shoes</a> , <a href="blog-grid.html">Stylish</a></p>
                        <?= $blog->blog_description?>
                      </div>
                    </div>
                    <div class="ps-post__footer">
                      <p class="ps-post__tags"><i class="fa fa-tags"></i><?= $blog->blog_tags ?></p>
                      <div class="ps-post__actions"><span><i class="fa fa-comments"></i> 23 Comments</span><span><i class="fa fa-heart"></i>  likes</span>
                        <div class="ps-post__social"><i class="fa fa-share-alt"></i><a href="#">Share</a>
                          <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <h3 class="ps-heading--2 mb-20 text-uppercase">Author</h3>
                  <div class="ps-author">
                    <div class="ps-author__thumbnail bg--cover" data-background="<?= base_url() ?>assets/user/images/user/1.jpg" data-mh="author"></div>
                    <div class="ps-author__content" data-mh="author">
                      <header>
                        <h4>MARK GREY</h4>
                        <p>WEB DESIGNER</p>
                      </header>
                      <p>The development of the mass spectrometer allowed the mass of atoms to be measured with increased accuracy. The device uses the launch and continued operation of the Hubble space telescope probably.</p>
                    </div>
                  </div>
                  <div class="ps-comments">
                    <h3 class="ps-heading">Comment(4)</h3>
                    <div class="ps-comment">
                      <div class="ps-comment__thumbnail"><img src="<?= base_url() ?>assets/user/images/user/2.jpg" alt=""></div>
                      <div class="ps-comment__content">
                        <header>
                          <h4>MARK GREY <span>(15 minutes ago)</span></h4><a href="#">Reply<i class="ps-icon-arrow-right"></i></a>
                        </header>
                        <p>The development of the mass spectrometer allowed the mass of atoms to be measured with increased accuracy. The device uses the launch and continued operation of the Hubble space telescope probably.</p>
                      </div>
                    </div>
                    <div class="ps-comment">
                      <div class="ps-comment__thumbnail"><img src="<?= base_url() ?>assets/user/images/user/4.jpg" alt=""></div>
                      <div class="ps-comment__content">
                        <header>
                          <h4>MARK GREY <span>(1 day ago)</span></h4><a href="#">Reply<i class="ps-icon-arrow-right"></i></a>
                        </header>
                        <p>The development of the mass spectrometer allowed the mass of atoms to be measured with increased accuracy. The device uses the launch and continued operation of the Hubble space telescope probably.</p>
                      </div>
                    </div>
                  </div>
                  <form class="ps-form--post-comment" action="do_action" method="post">
                    <h3 class="mb-20">LEAVE A COMMENT</h3>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                        <div class="form-group">
                          <textarea class="form-control" rows="6" placeholder="Text your message here..."></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <button class="ps-btn">Send Message</button>
                    </div>
                  </form>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 ">
                  <div class="ps-blog__sidebar">
                    <div class="widget widget_search">
                      <form class="ps-form--widget-search" action="do_action" method="post">
                        <input class="form-control" type="text" placeholder="Search Post...">
                        <button><i class="furniture-search"></i></button>
                      </form>
                    </div>
                    <div class="widget widget_category">
                      <h3 class="widget-title">Archive</h3>
                      <ul class="ps-list--arrow">
                        <li><a href="#">All Shoes (321)</a></li>
                        <li><a href="#">Amazin’ Glazin’</a></li>
                        <li><a href="#">The Crusty Croissant</a></li>
                        <li><a href="#">The Rolling Pin</a></li>
                        <li><a href="#">Skippity Scones</a></li>
                        <li><a href="#">Mad Batter</a></li>
                        <li><a href="#">Confection Connection</a></li>
                      </ul>
                    </div>
                    <div class="widget widget_ads">
                      <h3 class="widget-title">Ads Banner</h3><img src="<?= base_url() ?>assets/user/images/widget-ads.jpg" alt="">
                    </div>
                    <div class="widget widget_recent-posts">
                      <h3 class="widget-title">Recent Post</h3>
                      <div class="ps-post--sidebar">
                        <div class="ps-post__thumbnail"><a class="ps-post__overlay" href="#"></a><img src="<?= base_url() ?>assets/user/images/post/sidebar-1.jpg" alt=""></div>
                        <div class="ps-post__content"><a class="ps-post__title" href="blog-detail.html">Micenas Placerat Nibh Loreming Fentum</a>
                          <p>Sep 29, 2017</p>
                        </div>
                      </div>
                      <div class="ps-post--sidebar">
                        <div class="ps-post__thumbnail"><a class="ps-post__overlay" href="#"></a><img src="<?= base_url() ?>assets/user/images/post/sidebar-2.jpg" alt=""></div>
                        <div class="ps-post__content"><a class="ps-post__title" href="blog-detail.html">Micenas Placerat Nibh Loreming Fentum</a>
                          <p>Sep 29, 2017</p>
                        </div>
                      </div>
                      <div class="ps-post--sidebar">
                        <div class="ps-post__thumbnail"><a class="ps-post__overlay" href="#"></a><img src="<?= base_url() ?>assets/user/images/post/sidebar-3.jpg" alt=""></div>
                        <div class="ps-post__content"><a class="ps-post__title" href="blog-detail.html">Micenas Placerat Nibh Loreming Fentum</a>
                          <p>Sep 29, 2017</p>
                        </div>
                      </div>
                    </div>
                    <div class="widget widget_tags">
                      <h3 class="widget-title">Tags</h3><a href="#">Men</a><a href="#">Woman</a><a href="#">B&C</a><a href="#">Ugly fashion</a><a href="#">Nike</a><a href="#">Diar</a><a href="#">Adidas</a>
                    </div>
                  </div>
                </div>
          </div>
        </div>
      </div>
    </main>
    <div class="ps-partners">
      <div class="ps-container">
        <div class="ps-slider--partners owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="50" data-owl-nav="false" data-owl-dots="false" data-owl-item="7" data-owl-item-xs="3" data-owl-item-sm="5" data-owl-item-md="6" data-owl-item-lg="7" data-owl-duration="1000" data-owl-mousedrag="on"><img src="<?= base_url() ?>assets/user/images/partner/1.png" alt=""><img src="<?= base_url() ?>assets/user/images/partner/2.png" alt=""><img src="<?= base_url() ?>assets/user/images/partner/3.png" alt=""><img src="<?= base_url() ?>assets/user/images/partner/4.png" alt=""><img src="<?= base_url() ?>assets/user/images/partner/5.png" alt=""><img src="<?= base_url() ?>assets/user/images/partner/6.png" alt=""><img src="<?= base_url() ?>assets/user/images/partner/7.png" alt=""></div>
      </div>
    </div>