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

  <!-- header start -->
  <?php $this->load->view($header); ?>
  <!-- header end -->

  <?php $this->load->view($main_content); ?>

  <!-- news area end -->
  <?php $this->load->view($footer); ?>

  <!--========= JS Here =========-->
  <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.4.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
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
    // A $( document ).ready() block.

    jQuery(document).ready(function() {
      var $j = jQuery.noConflict();
      $j(".datepicker-here").datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
      });

      $j("#registerform").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            fullname: {
                required: true
            },
            fullname_title: {
                required: true
            },
            npa: {
                required: true
            },
            cb_phone: {
                required: true
            },
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            },
            captcha: {
                required: true,
            }
        },
        messages: {
            password_confirmation: {
                equalTo: "Password must match"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    });
  </script>

 
 </body>

</html>