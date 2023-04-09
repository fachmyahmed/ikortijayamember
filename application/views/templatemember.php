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
  <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="images/x-icon" />

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

  <!-- contact area start -->



  <!-- contact area end -->


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
  <script>
  $('#cbpraktek,#cbpraktek2,#cbpraktek3').autocomplete({
      
      source: function(request, response) {
            $.ajax({
                url: "<?php echo base_url(); ?>ajax/alamat_praktek",
                type: "POST",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            value: item.cb_praktek
                        }
                    }));
                }
            });
        },
      minLength: 3,
      select: function(event, ui){
        var selectedValue = ui.item.value;
        $.ajax({
                url: "<?php echo base_url(); ?>ajax/get_latlong1",
                type: "POST",
                dataType: "json",
                data: {
                    term: selectedValue,
                    value: selectedValue
                },
                success: function(data) {
                  var latLongValue = data[0].latlong1;
                    // do something with the data, like populate another input field
                    var inputFieldId = event.target.id;
                    console.log("Input field ID: " + inputFieldId);
                    if(inputFieldId=='cbpraktek'){
                      $("#latlong1").val(latLongValue);
                    } 
                    else if(inputFieldId=='cbpraktek2'){
                      $("#latlong2").val(latLongValue);
                    } 
                    else if(inputFieldId=='cbpraktek3'){
                      $("#latlong3").val(latLongValue);
                    }
                    
                }
            });
      }
  });

  </script>

</body>

</html>