    <!-- footer start -->
    <footer class="site-footer mt-50 pt-50 pb-10 bg-footer">
        <div class="px-5">
            <div class="row p-0 m-0">
                <div class="col-xl-12 col-lg-12">
                    <div class="row pb-2">
                        <div class="col-xs-6 col-md-3">
                            <a href=""><img class="logo-width" src="<?php echo base_url() ?>uploads/logo.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12">
                    <div class="row px-1 pb-3">
                        <div class="col-md-3 col-lg-3 col-sm-4">
                            <div class="footer-widget">
                                <?php 
                                    $footeraddress = $this->db->get_where('banner', array('id' => 10), 1)->result()[0];
                                ?>
                                <h4 class="widget-title text-light"><?php echo $footeraddress->title ?></h4>
                                <div class="row">
                                    <div class="col-12 pr-10">
                                        <ul>
                                            <li>
                                                <p class="text-light"><?php echo $footeraddress->headline; ?>
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-2 col-lg-2">
                            <?php
                                $getmenubottom = GetAll("menu_bottom", array("id" => "where/" . "1", "is_publish" => "where/" . "1"));
                                foreach ($getmenubottom->result() as $menubottom) { ?>
                                <div class="footer-widget department">
                                    <h4 class="widget-title text-light"><?php echo $menubottom->title ?></h4>
                                    <ul>
                                        <?php
                                            $getsubmenubottom = GetAll("menu_bottom", array("id_parents" => "where/" . $menubottom->id, "is_publish" => "where/" . "1"));
                                            foreach ($getsubmenubottom->result() as $submenubottom) { ?>
                                                <?php 
                                                    $titlesub = $submenubottom->title;
                                                    $linksub = $submenubottom->link;
                                                    $is_content = $submenubottom->is_content;
                                                    $is_active = $submenubottom->is_active;
                                                    if($is_content==1){
                                                        $linksub=base_url().'contents/pages/'.$linksub;
                                                    }
                                                    else{
                                                        $linksub = $submenubottom->link;
                                                    }
                                                    
                                                ?>
                                                <?php
                                                    if($is_active==1){
                                                ?>
                                                    <li><a href="<?php echo $linksub ?>"><?php echo $titlesub;  ?></a></li>                     
                                                <?php } else { ?>
                                                    <li><a class="text-secondary"><?php echo $titlesub;  ?></a></li>
                                                <?php } ?>
                                            <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-xs-4 col-md-2 col-lg-2">
                            <?php
                                $getmenubottom = GetAll("menu_bottom", array("id" => "where/" . "4", "is_publish" => "where/" . "1"));
                                foreach ($getmenubottom->result() as $menubottom) { ?>
                                <div class="footer-widget department">
                                    <h4 class="widget-title text-light"><?php echo $menubottom->title ?></h4>
                                    <ul>
                                        <?php
                                            $getsubmenubottom = GetAll("menu_bottom", array("id_parents" => "where/" . $menubottom->id, "is_publish" => "where/" . "1"));
                                            foreach ($getsubmenubottom->result() as $submenubottom) { ?>
                                                <?php 
                                                    $titlesub = $submenubottom->title;
                                                    $linksub = $submenubottom->link;
                                                    $is_content = $submenubottom->is_content;
                                                    $is_active = $submenubottom->is_active;
                                                    if($is_content==1){
                                                        $linksub=base_url().'contents/pages/'.$linksub;
                                                    }
                                                    else{
                                                        $linksub = $submenubottom->link;
                                                    }
                                                    
                                                ?>
                                                <?php
                                                    if($is_active==1){
                                                ?>
                                                    <li><a href="<?php echo $linksub ?>"><?php echo $titlesub;  ?></a></li>                     
                                                <?php } else { ?>
                                                    <li><a class="text-secondary"><?php echo $titlesub;  ?></a></li>
                                                <?php } ?>
                                            <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-xs-4 col-md-2 col-lg-2">
                            <div class="row p-0 w-0">
                                <div class="col-sm-4 text-center">
                                    <a href="https://www.instagram.com/spesialis.gigirapi"><i class="bi-instagram igico"></i></a>
                                </div>
                                <div class="col-sm-4 text-center">
                                    <a href=""><i class="bi-android2 androidico"></i></a>                
                                </div>
                                <div class="col-sm-4 text-center">
                                    <a href=""><i class="bi-apple appleico"></i></a>                
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4 col-md-2 col-lg-2">
                            <div class="row p-0 w-0">
                                <div class="col-sm-12 text-right pb-3 mb-3">
                                    <a class="btn btn-regular orangebtn" href="">Cari Ortodontis</i></a>
                                </div>
                                <div class="col-sm-12 text-right pb-3 mb-3 h-200">
                                                
                                </div>
                                <div class="col-sm-12 text-right pb-3 mb-3">
                                    <a class="btn btn-regular orangebtn" href="">Cek Ortodontis-mu</i></a>      
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row px-1 pt-3">
                        <div class="col-lg-3">
                            <div class="footer-widget">
                                <div class="row">
                                    <div class="col-4 pr-10">
                                        <a href="https://www.ikorti-iao.com/"><img class="logo-width" src="<?php echo base_url() ?>uploads/ikorti.png" alt=""></a>
                                    </div>
                                    <div class="col-4 pr-10">
                                        <a href="https://www.wfo.org"><img class="logo-width" src="<?php echo base_url() ?>uploads/wfo-2.png" alt=""></a>
                                    </div>
                                    <div class="col-4 pr-10">
                                        <a href="https://pdgi.or.id"><img class="logo-width" src="<?php echo base_url() ?>uploads/pdgi-2.png" alt=""></a>
                                    </div>
                                    <a href="https://api.whatsapp.com/send?phone=6281298791284&text=Halo." class="floatbutton" target="_blank">
                                        <i class="fa fa-whatsapp my-float"></i>
                                    </a>
                                    <a href="#" class="floatbutton2" target="_blank">
                                        <i class="fa fa-comment-dots my-float"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="copyright-text">
                                <p>© 2023 Ikatan Ortodontis Indonesia Pengwil Jaya. All rights reserved.</p>
                                <p>Copyright By@<span>Mz Team</span> - 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->