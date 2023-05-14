 <!-- Hero area start -->
 <section class="hero-area">
     <div class="col-12 col-lg-12 m-0 p-0">
         <div class="row mx-0">
             <div class="col-lg-5 m-0 p-0">
                 <div class="hero-content">
                     <div class="model1">
                         <img class="" src="uploads/<?php echo $hero->file ?>" alt="">
                     </div>
                 </div>
             </div>

             <div class="col-lg-7 m-0 p-0">
                 <div class="hero-content">
                     <h1 class="title"><?php echo $hero->title ?>
                     </h1>
                     <p class="hero-p p-3"><?php echo $hero->headline ?></p>

                 </div>
             </div>
         </div>
     </div>

 </section>
 <!-- Hero area end -->

 <div class="row p-0 m-0">
     <div class="col-12 text-left px-5 py-2">
         <p ><?php echo $welcome->headline ?></p>
     </div>
     <div class="textlooking col-12 text-center p-0 my-3">
         <h3 class="my-4"><?php echo $orange_tagline->title ?></h3>
     </div>
 </div>

 <!-- resources you need -->

 <div class="row p-0 m-0">
     <div class="textresources col-12 text-center py-3">
         <h1 class="font-weight-bold"><?php echo $mid_tagline->title ?></h1>
     </div>
 </div>
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-12 col-lg-4 col-md-4 col-sm-12 text-right">
             <div class="resourcesimg">
                 <img class="w-100" src="uploads/<?php echo $mid_left_content->file ?>">
             </div>
             <div class="text-center resourceslink mt-4">
                 <a href="practice"><?php echo $mid_left_content->title ?></a>
             </div>
         </div>
         <div class="col-12 col-lg-4 col-md-4 col-sm-12 text-left">
             <div class="resourcesimg">
                 <img class="w-100" src="uploads/<?php echo $mid_right_content->file ?>">
             </div>
             <div class="text-center resourceslink mt-4">
                 <a href="education"><?php echo $mid_right_content->title ?></a>
             </div>
         </div>
         <div class="col-12 col-lg-12 col-md-12 col-sm-12  text-center mt-4">
             <p><?php echo $mid_bottom_content->headline ?></a>
         </div>
     </div>
 </div>
 <div class="row px-0 mt-5 mx-0">
     <div class="col-12 col-lg-6 col-md-6 px-0">
         <div class="hero-content">
             <div class="joinus-model">
                 <img class="" src="uploads/joinus.png" alt="">
             </div>
         </div>
     </div>
     <div class="col-12 col-lg-6 col-md-6 joinus mt-5">
         <div class="col-12 col-lg-12 joinus text-left p-4 mt-5 ">
             <h2 class="joinus-head"><?php echo $join_us->title ?></h2>
             <p class="joinus-content"><?php echo $join_us->headline ?></p>
             <h2 class="joinus-member"><?php echo $ort_join->headline ?></h2>
         </div>
     </div>
 </div>
 <!-- resources you need end -->

 <!-- events -->
 <div class="row px-0 pb-2 mx-0 mt-5 bg-light">
     <div class="container ">
         <div class="row px-0 mt-5 mb-5 mx-0">
             <div class="col-12 col-md-4 col-lg-4">
                 <h3 class="event-head">Upcoming Events</h3>
                 <p class="event-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
             </div>
             <div class="col-12 col-md-8 col-lg-8">
                 <div class="row">
                     <div class="col-12 col-md-6 col-lg-6 pt-3">
                         <a class="event-link" href="">
                             IAO
                         </a>
                         <p class="event-desc pt-2">Iao Annual Session</p><br>
                         <i class="event-location fa-sharp fa-solid fa-location-dot">JAKARTA</i>
                     </div>
                     <div class="col-12 col-md-6 col-lg-6 pt-3">
                         <a class="event-link" href="">
                             JOM 2023
                         </a>
                         <p class="event-desc pt-2">Iao Annual Session</p><br>
                         <i class="event-location fa-sharp fa-solid fa-location-dot">JAKARTA</i>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- end events -->

 <!-- blog -->
 <div class="row px-0 mx-0 justify-content-center mt-30 px-2">
     <div class="head-blog col-12 text-center py-1">
         <h1 class="font-weight-bold">Explore the IKORTI JAYA's Blog</h1>
     </div>
 </div>
 <div class="row px-0 mx-0 justify-content-center mt-30 px-2">
     <!-- <div class="col-xl-2 col-lg-3 col-sm-12 mt-30"> -->
     <?php
        foreach ($blog->result() as $blogrow) {
        ?>
         <div class=" col-sm col-lg col-xl-2 col mt-30">
             <div class="single-news-box">
                 <div class="thumb">
                     <img src="uploads/<?php echo $blogrow->image; ?>" alt="">
                 </div>
                 <div class="content">
                     <div class="news-meta">
                         <ul>
                             <li><a href="#0"><i class="fal fa-calendar-alt"></i><?php echo GetUrlDate($blogrow->create_date); ?></a></li>
                         </ul>
                     </div>
                     <h5 class="title">
                         <a class="inline-btn" href="blog/read/<?php echo $blogrow->slug; ?>"><?php echo $blogrow->title; ?></a>
                     </h5>
                 </div>
             </div>
         </div>
     <?php  } ?>
     <div class=" col-sm-12 col-lg-12 col-xl-12 col mt-30">
         <a href="blog" class="site-btn">Read More</a>
     </div>
 </div>
 <!-- end blog -->