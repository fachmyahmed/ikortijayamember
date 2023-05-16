<!doctype html>
<html class="no-js" lang="zxx">

<head>

	<!--========= Required meta tags =========-->
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--====== Title ======-->
	<title>Ikorti Jaya</title>

	<!--====== Favicon ======-->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo/favicon.ico" type="images/x-icon" />

	<!--====== CSS Here ======-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lightcase.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/meanmenu.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/nice-select.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/default.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bsicon/bootstrap-icons.css">

	<!-- ========= Custom css ========= -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/public.css">
	<!-- <link rel="stylesheet" href="<?php //echo base_url(); 
										?>assets/css/member.css"> -->



</head>

<body>
	<style>
		.bg-head {
			background: #084a62;
			/* height: 80px; */
			margin-bottom: 0px;
		}

		.bg-foot {
			background: #084a62;
			height: 50px;
			margin-top: 30px;
		}

		.border-home {
			width: 1280px !important;
			margin: auto !important;
		}

		.border-home2 {
			width: 1024px !important;
			margin: auto !important;
		}

		.label-section-merah {
			padding-top: 30px;
			color: #ff0000;
		}

		.label-section {
			padding-top: 60px;
			font-size: 80px;
		}

		.label-section1 {
			font-size: 20px;
		}

		.reg {
			background: #ff0000;
			font-size: 20px;
			position: absolute;
			top: -55px;
			margin-left: 100px;
			padding: 8px 10px;
			color: #fff;
			border: none;
		}

		.shad {
			margin-bottom: 60px;
			margin-top: 30px;
		}

		@media (max-width: 767px) {
			.bg-head {
				background: #5fb7c1;
				height: 40px;
				margin-bottom: 0px;
			}

			.bg-foot {
				background: #5fb7c1;
				height: 20px;
				margin-bottom: 0px;
			}

			.border-home {
				width: 100% !important;
				margin: auto !important;
			}

			.label-section-merah {
				padding-top: 6px;
				font-size: 14px;
			}

			.label-section {
				padding-top: 30px;
				font-size: 20px;
			}

			.label-section1 {
				font-size: 20px;
			}

			h3,
			h4 {
				font-size: 14px;
			}

			.blok-reg {
				margin-top: 40px;
			}

			.reg {
				margin-left: 28px;
				padding: 2px 4px;
				font-size: 12px;
			}

			.shad {
				margin-bottom: 20px;
				margin-top: 0px;
			}
		}
	</style>

	<div class="row p-0 m-0">
		<div class="col-12 text-center py-3" style="padding:0px !important;">
			<div class="bg-head">
				<nav class="navbar navbar-expand-lg navbar-dark bg-none">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item dropdown">
							<?php
                            if (!empty($datamember->foto)) {
                                $foto = base_url() . '/uploads/foto/' . $datamember->foto;
                            } else {
                                $foto = base_url() . '/uploads/foto/default.png';
                            }
                            ?>
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<img src="<?php echo $foto; ?>" alt="Profile Image" class="profile-image" style="width: 40px; border: 2px grey solid; border-radius: 2rem; object-fit: cover;height: 40px;">
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="#">Welcome,<br> <?php echo $datamember->fullname_title ?></a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="<?php echo base_url('member/profile') ?>">Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="<?php echo base_url('member/logout') ?>">Logout</a>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="border-home row p-0 m-0">
				<div class="col-12 text-center py-3">
					<video width="320" height="100" autoplay loop>
						<source src="<?php echo base_url(); ?>uploads/home/File Elemen Square.mp4" type="video/mp4">
						</source>
					</video>
					<h1 class="font-weight-bold label-section1">Your website is being updated</h1>
				</div>
			</div>
			<div style="box-shadow: 2px 2px 5px 5px #ddd;margin-bottom:10px;"></div>
			<div class="row p-0 m-0">
				<div class="col-1 p-0"></div>
				<div class="col-10 p-0">
					<video width="100%" autoplay loop>
						<source src="<?php echo base_url(); ?>uploads/home/JOM 2023.mp4" type="video/mp4">
						</source>
					</video>
					<div class="col-12 text-left blok-reg" style="padding:0px !important;">
						<a href="https://ikortijaya.org/member" class="reg"><i>Register Now</i></a>
					</div>
				</div>
				<div class="col-1 p-0"></div>
			</div>
			<div class="shad" style="box-shadow: 2px 2px 5px 5px #ddd;"></div>
			<!-- Section 2 -->
			<div class="row p-0 m-0">
				<div class="col-1 p-0"></div>
				<div class="col-10">
					<div class="row">
						<div class="col-2 text-right" style="padding:0px !important;">
							<video width="50%" autoplay loop>
								<source src="<?php echo base_url(); ?>uploads/home/Check Back Soon.mp4" type="video/mp4">
								</source>
							</video>
						</div>
						<div class="col-8 text-center" style="padding:0px !important;">
							<h1 class="font-weight-bold label-section-merah">Maju Bersama IKORTI Pengwil Jaya</h1>
						</div>
						<div class="col-2 text-left" style="padding:0px !important;">
							<video width="50%" autoplay loop>
								<source src="<?php echo base_url(); ?>uploads/home/Arrow.mp4" type="video/mp4">
								</source>
							</video>
						</div>
					</div>
				</div>
				<div class="col-1 p-0"></div>
			</div>

			<!-- Section 3 -->
			<div class="row p-0 m-0">
				<div class="col-1 p-0"></div>
				<div class="col-10">
					<div class="row">
						<div class="col-1 p-0"></div>
						<div class="col-10 text-center" style="padding:0px !important;">
							<video width="100%" autoplay loop>
								<source src="<?php echo base_url(); ?>uploads/home/Aplikasi Coming Soon.mp4" type="video/mp4">
								</source>
							</video>
						</div>
						<div class="col-1 p-0"></div>
					</div>
				</div>
				<div class="col-1 p-0"></div>
			</div>

			<h1 class="font-weight-bold label-section">Highlight</h1>
			<!-- Section 4 -->
			<div class="row p-0 m-0">
				<div class="col-2 p-0"></div>
				<div class="col-8">
					<div class="row">
						<div class="col-4 text-center" style="padding:0px !important;">
							<video width="100%" autoplay loop>
								<source src="<?php echo base_url(); ?>uploads/home/Informasi.mp4" type="video/mp4">
								</source>
							</video>
							<h3>Informasi</h3>
						</div>
						<div class="col-4 text-center" style="padding:0px !important;">
							<a href="https://ikortijaya.org/member/member/profile">
								<video width="100%" autoplay loop>
									<source src="<?php echo base_url(); ?>uploads/home/Personal Akun.mp4" type="video/mp4">
									</source>
								</video>
								<h3>Personal Akun</h3>
							</a>
						</div>
						<div class="col-4 text-center" style="padding:0px !important;">
							<video width="100%" autoplay loop>
								<source src="<?php echo base_url(); ?>uploads/home/Kegiatan Seminar.mp4" type="video/mp4">
								</source>
							</video>
							<h3>Kegiatan Seminar</h3>
						</div>
					</div>
				</div>
				<div class="col-2 p-0"></div>
			</div>

			<h1 class="font-weight-bold label-section">Edukasi & Informasi Ortodonti</h1>
			<!-- Section 5 -->
			<div class="row p-0 m-0">
				<div class="col-2 p-0"></div>
				<div class="col-8">
					<div class="row">
						<div class="col-6 text-center" style="padding:0px !important;">
							<video width="100%" autoplay loop>
								<source src="<?php echo base_url(); ?>uploads/home/Cara Memilih Ortodontis.mp4" type="video/mp4">
								</source>
							</video>
						</div>
						<div class="col-6 text-center" style="padding:0px !important;">
							<video width="100%" autoplay loop>
								<source src="<?php echo base_url(); ?>uploads/home/Kebersihan Gigi dan Mulut Ortodonti.mp4" type="video/mp4">
								</source>
							</video>
						</div>
						<div class="col-6 text-center" style="padding:0px !important;">
							<video width="100%" autoplay loop>
								<source src="<?php echo base_url(); ?>uploads/home/Pilihan Perawatan Ortodonti.mp4" type="video/mp4">
								</source>
							</video>
						</div>
						<div class="col-6 text-center" style="padding:0px !important;">
							<video width="100%" autoplay loop>
								<source src="<?php echo base_url(); ?>uploads/home/Yuk ke Ortodontis.mp4" type="video/mp4">
								</source>
							</video>
						</div>
						<div class="col-12 text-right" style="padding:0px !important;">
							<h4>Dan masih banyak lagi....</h4>
						</div>
					</div>
				</div>
				<div class="col-2 p-0"></div>
			</div>

			<div class="bg-foot"></div>
		</div>
	</div>

	<!--========= JS Here =========-->
	<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/counterup.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datepicker.en.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.nice-select.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/lightcase.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.meanmenu.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/imagesloaded.pkgd.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/isotope.pkgd.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/waypoint.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
	<script src="https://kit.fontawesome.com/72bdcd7734.js" crossorigin="anonymous"></script>

	<script>
		var tagsOrt = [<?php echo GetListOrt(); ?>];
		var tagsOrtAll = [<?php echo GetListOrt(2); ?>];
		$("#cari_ort").autocomplete({
			source: tagsOrt
		});
		$("#cari_ort_2").autocomplete({
			source: tagsOrtAll
		});
	</script>

</body>

</html>