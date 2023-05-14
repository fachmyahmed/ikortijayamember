<!-- header start -->
<section id="top-banner" aria-label="Member site and language selection" class="topheadermenu pb-1 pt-1">
    <div class="flex justify-between align-center mx-auto px-2 md:px-8 lg:px-5 w-full max-w-full md:max-w-[1240px] h-11 xl:h-[60px]">
        <nav class="member-navigation flex w-full sm:w-auto" aria-label="Navigate to Member Site">
            <div class="row p-0 m-0">
                <div class="col-md-4 px-2 my-2">
                    <?php
                    if ($this->session->userdata('member')) {
                        $sess = (array)$this->session->userdata('member');
                        // print_r($sess);
                        $fullname_title = $sess['fullname_title'];
                        $fullname = $sess['fullname'];

                    ?>

                        <span class="text-light">Welcome, <?php echo $fullname_title; ?></span>
                        &nbsp; | &nbsp;
                        <a class="text-warning" href="<?php echo base_url() . 'member/profile'; ?>">Profile</a>
                        &nbsp; | &nbsp;
                        <a class="text-danger" href="<?php echo base_url() . 'member/logout'; ?>">Logout</a>
                </div>
            <?php } else { ?>
                <a class="btn btn-primary btn-member" href="<?php echo 'https://ikortijaya.org/member/member/register' ?>" target="_blank"> Mari Bergabung ></a>
            <?php } ?>
            </div>
    </div>
    <!-- <a class="btn btn-primary btn-member" href="<?php echo base_url() . 'member' ?>" target="_blank"> Member Site ></a> -->
    </nav>
    </div>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-none topheadermenu">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="profile-image.jpg" alt="Profile Image" class="profile-image"> John Doe
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav> -->
</section>
<header id="sticky-header" class="site-header-3">
    <a href="<?php echo base_url() ?>" class="site-logo site-logo-2 site-logo-3">
        <img class="logo-width" src="<?php echo base_url() ?>uploads/logo.png" alt="">
    </a>
    <div class="site-header-3-right">
        <div class="header-top-area header-top-area-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-info-wrap">
                            <div class="header-info-left">
                                <ul>
                                    <li>
                                        <div class="col-xl-12 col-lg-12 my-auto">
                                            <?php //print_r($this->session->userdata('member')); 
                                            ?>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="header-info-right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-area nav-area-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 my-auto">
                        <div class="header-menu-wrap header-menu-wrap-2">
                            <div class="menu-logo-wrap col-md-8">
                                <div class="mainmenu">
                                    <nav id="mobile-menu">
                                        <ul>
                                            <?php
                                            $getmenutop = GetAll("menu_top_member", array("id_parents" => "where/" . "0", "is_publish" => "where/" . "1"));
                                            foreach ($getmenutop->result() as $menutop) { ?>
                                                <li>
                                                    <?php
                                                    $menutoplink = '';
                                                    if ($menutop->is_content == 0) {
                                                        if (!isset($menutop->link)) {
                                                            $menutop->link = '';
                                                        } else {
                                                            $menutoplink = $menutop->link;
                                                        }
                                                    } else {
                                                        if (!isset($menutop->link)) {
                                                            $menutop->link = '';
                                                        } else {
                                                            $menutoplink = 'contents/pages/' . $menutop->link;
                                                        }
                                                    }

                                                    ?>
                                                    <a href="<?php echo base_url() . $menutoplink; ?>">
                                                        <?php echo $menutop->title; ?>
                                                    </a>

                                                    <?php if ($menutop->id_parents == '0') { ?>
                                                        <?php $getsubmenu = GetAll("menu_top_member", array("id_parents" => "where/" . $menutop->id, "is_publish" => "where/" . "1")); ?>
                                                        <?php
                                                        $this->db->select('id');
                                                        $this->db->from('menu_top_member');
                                                        $this->db->where('id_parents', $menutop->id);
                                                        $countchild = $this->db->count_all_results();
                                                        if ($countchild >= '0') {
                                                        ?>
                                                            <ul class="sub-menu">

                                                                <?php foreach ($getsubmenu->result() as $submenu) { ?>
                                                                    <li>
                                                                        <?php
                                                                        $submenulink = '';
                                                                        if ($submenu->is_content == 0) {
                                                                            if (substr($submenu->link, 0, 4) == 'www.' || substr($submenu->link, 0, 4) == 'http') {
                                                                                $submenulink = $submenu->link;
                                                                            } else {
                                                                                if (!isset($submenu->link)) {
                                                                                    $submenu->link = '';
                                                                                } else {
                                                                                    $submenulink = base_url() . $submenu->link;
                                                                                }
                                                                            }
                                                                        } elseif (substr($submenu->link, 0, 4) == 'www.') {
                                                                            $submenulink = $submenu->link;
                                                                        } elseif (substr($submenu->link, 0, 4) == 'http') {
                                                                            $submenulink = $submenu->link;
                                                                        } else {
                                                                            if (!isset($submenu->link)) {
                                                                                $submenu->link = '';
                                                                            } else {
                                                                                $submenulink = base_url() . 'contents/pages/' . $submenu->link;
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <a href="<?php echo $submenulink; ?>">
                                                                            <?php echo $submenu->title; ?>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                            </ul>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="header-nav-info-wrap header-nav-info-wrap-2 mr-3 col-md-4 col-sm-12 col-xs-12 searchinput">
                                <form action="" class="d-none d-sm-block">
                                    <div class="input-group">
                                        <div class="form-outline col-7">
                                            <input type="search" id="form1" class="form-control invis" placeholder="Search" />
                                        </div>
                                        <button type="submit" class="btn btn-warning findort-btn" href="">Cari Ortodontis</button>
                                    </div>
                                </form>
                            </div>
                            <div class="mobile-menu"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container row d-block d-sm-none m-0 p-0">
    <form action="" class="">
        <div class="col-12 py-2 bg-main-header">
            <div class="input-group justify-content-center">
                <div class="form-outline ">
                    <input type="search" id="form1" class="form-control invis" placeholder="Search" />
                </div>
                <button type="submit" class="btn btn-warning findort-btn" href="">Find Orthodontist</button>
            </div>
        </div>
    </form>
</div>
<!-- header end -->