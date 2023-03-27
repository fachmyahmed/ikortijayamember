<div class="blog-area bg-2 pt-150 pb-120">
        <div class="container">
            <div class="row mt-none-30">
            <?php
                foreach ($blog->result() as $blogrow) {
            ?>
                <div class="col-xl-4 col-lg-6 col-sm-12 mt-30">
                    <div class="single-news-box">
                        <div class="thumb">
                            <img src="<?php echo base_url();?>uploads/<?php echo $blogrow->image; ?>" alt="">
                        </div>
                        <div class="content">
                            <div class="news-meta">
                                <ul>
                                    <li><a href="#0"><i class="fal fa-calendar-alt"></i> <?php echo GetUrlDate($blogrow->create_date) ?></a></li>
                                </ul>
                            </div>
                            <h4 class="title"><a href="blog-details.html"><?php echo $blogrow->title; ?></a></h4>
                            <a class="inline-btn" href="<?php echo base_url();?>blog/read/<?php echo $blogrow->slug; ?>">Read More</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="col-lg-12">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>