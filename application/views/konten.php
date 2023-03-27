<div class="row p-0 m-0">
    <div class="col-sm-12 col-md-6 postbox_thumb mb-35 pl-0 ml-0">
        <img src="<?php echo base_url(); ?>uploads/<?php echo $konten->file ?>" alt="">
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="container py-5">
        <h1 id="" class="mb-16"><?php echo $konten->title ?></h1>
        <p><?php echo $konten->headline ?></p>
        <div class="w-100 py-4">
            <a class="btn btn-warning orangebtn" href="<?php echo BASE_URL("cariortodontis");?>">Cari Ortodontis</a>
        </div>
        </div>
    </div>
</div>

<div class="container pt-50">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <article class="postbox singel-post post format-image">
                <div class="postbox_content bg-none">
                    <div class="post-meta mb-15">
                        <!-- <span><i class="far fa-calendar-check"></i> <?php echo GetUrlDate($konten->create_date) ?> </span> -->
                    </div>
                    <div class="post-text mb-20">
                        <?php echo $konten->contents ?>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>