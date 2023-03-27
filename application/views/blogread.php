<div class="container pt-50">
    <div class="row">
        <div class="col-xl-8 col-lg-12">
            <article class="postbox singel-post post format-image">
                <div class="postbox_thumb mb-35">
                    <img src="<?php echo base_url(); ?>uploads/<?php echo $blog_detail->image ?>" alt="">
                </div>
                <div class="postbox_content bg-none">
                    <div class="post-meta mb-15">
                        <span><i class="far fa-calendar-check"></i> <?php echo GetUrlDate($blog_detail->create_date) ?> </span>
                    </div>
                    <h3 class="blog-title">
                        <?php echo $blog_detail->title ?>
                    </h3>
                    <div class="post-text mb-20">
                        <?php echo $blog_detail->contents ?>
                    </div>
                </div>
            </article>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="sidebar-wrap">
                <div class="widget mb-40">
                    <div class="widget-title-box mb-30">
                        <span class="animate-border"></span>
                        <h3 class="widget-title">Other Article</h3>
                    </div>
                    <ul class="recent-posts">
                        <li>
                            <div class="widget-posts-image">
                                <a href="#0"><img src="assets/images/blog/details/img1.jpg" alt=""></a>
                            </div>
                            <div class="widget-posts-body">
                                <h6 class="widget-posts-title"><a href="#0">Lorem ipsum dolor sit
                                        cing elit, sed do.</a></h6>
                                <div class="widget-posts-meta">October 18, 2018 </div>
                            </div>
                        </li>
                        <li>
                            <div class="widget-posts-image">
                                <a href="#0"><img src="assets/images/blog/details/img2.jpg" alt=""></a>
                            </div>
                            <div class="widget-posts-body">
                                <h6 class="widget-posts-title"><a href="#0">Lorem ipsum dolor sit
                                        cing elit, sed do.</a></h6>
                                <div class="widget-posts-meta">October 24, 2018 </div>
                            </div>
                        </li>
                        <li>
                            <div class="widget-posts-image">
                                <a href="#0"><img src="assets/images/blog/details/img3.jpg" alt=""></a>
                            </div>
                            <div class="widget-posts-body">
                                <h6 class="widget-posts-title"><a href="#0">Lorem ipsum dolor sit
                                        cing elit, sed do.</a></h6>
                                <div class="widget-posts-meta">October 28, 2018 </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>