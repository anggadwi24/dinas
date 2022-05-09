<!DOCTYPE html>
<html translate="no">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/img/favicon.png" rel="icon">
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
 
  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/aos/aos.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/')?>slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/')?>slick/slick-theme.css"/>
  <!-- Template Main CSS File -->
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
 
 <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/counterup/counterup.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/aos/aos.js"></script>

<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?= base_url('asset/')?>slick/slick.min.js"></script>

<script>
$(document).ready(function(){
   $(document).bind("contextmenu",function(e){
      return false;
   });
});
</script>


  <!-- Template Main JS File -->
  <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>


  <!-- =======================================================
  * Template Name: OnePage - v2.2.2
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style type="text/css">

         #loader {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 9999;
  overflow: hidden;
  background: #fff;
}

#loader:before {
  content: "";
  position: fixed;
  top: calc(50% - 30px);
  left: calc(50% - 30px);
  border: 6px solid #f9ad4a;
  border-top-color: #fff;
  border-bottom-color: #fff;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  -webkit-animation: animate-loader 1s linear infinite;
  animation: animate-loader 1s linear infinite;
}
  </style>
  <style>
  .embed-responsive-9by16 {
    padding-bottom: 150.78%;
     padding-right: 10px;
    display: inline-block;
}

.embed-responsive .embed-responsive-item, .embed-responsive embed, .embed-responsive iframe, .embed-responsive object, .embed-responsive video {
  
   
    width: 100%;
    height: 100%;
    border: 0;
}
#fixedContainer {
  position: fixed;
 
  right: 0;
  bottom: 60px;
  padding: 15px;

 /*half the width*/
}
#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal1 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content1 {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content1, #caption {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: fixed;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content1 {
    width: 100%;
  }
}
@-webkit-keyframes placeHolderShimmer {
          0% {
            background-position: -468px 0;
          }
          100% {
            background-position: 468px 0;
          }
        }

        @keyframes placeHolderShimmer {
          0% {
            background-position: -468px 0;
          }
          100% {
            background-position: 468px 0;
          }
        }

        .content-placeholder {
          display: inline-block;
          -webkit-animation-duration: 1s;
          animation-duration: 1s;
          -webkit-animation-fill-mode: forwards;
          animation-fill-mode: forwards;
          -webkit-animation-iteration-count: infinite;
          animation-iteration-count: infinite;
          -webkit-animation-name: placeHolderShimmer;
          animation-name: placeHolderShimmer;
          -webkit-animation-timing-function: linear;
          animation-timing-function: linear;
          background: #f6f7f8;
          background: -webkit-gradient(linear, left top, right top, color-stop(8%, #cacaca), color-stop(18%, #dddddd), color-stop(33%, #eeeeee));
          background: -webkit-linear-gradient(left, #cacaca 8%, #dddddd 18%, #cacaca 33%);
          background: linear-gradient(to right, #cacaca 8%, #dddddd 18%, #cacaca 33%);
          -webkit-background-size: 800px 104px;
          background-size: 800px 104px;
          height: inherit;
          position: relative;
        }

        .post_data
        {
          padding:24px;
          border:1px solid #f9f9f9;
          border-radius: 5px;
          margin-bottom: 24px;
          box-shadow: 10px 10px 5px #cacaca;
        }
</style>
</head>

<?php if($this->uri->segment('1') == 'tutorial'){?>
<body style="background-color: white;">
<?php }else{?>
  <body style="background-color: white;">
<?php }?>


  <main id="main">

    <!-- ======= About Section ======= -->

<?= $contents ?>
      

    <!-- ======= Counts Section ======= -->
  
  </main><!-- End #main -->
  <script type="text/javascript">
    function stopOtherMedia(element) {
    $("audio").not(element).each(function(index, audio) {
        audio.pause();
    });

    $("video").not(element).each(function(index, video) {
        video.pause();
    });

}
  </script>
  <div class="clearfix " style="margin-top: 100px;"></div>
  <?php include "footer.php"; ?>
<?php $this->model_utama->kunjungan(); ?>
<script>
   function detailVid(vid){
   window.location.href = '<?= base_url('home/detail/')?>'+vid;
 }
</script>
  <!-- ======= Footer ======= -->
 <!--  <footer id="footer">

 

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left text-lg-center">
        <div class="copyright">
          &copy; Copyright <strong><span>PEMERINTAH PROVINSI SULAWESI BARAT SEKRETARIAT DAERAH</span></strong>. 
        
      </div>
     
    </div>
  </footer> -->


 <!--  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a> -->
  <div id="preloader"></div>
  <div id="loader" style="display: none;"></div>
  <!-- <div id="fixedContainer">
    <a href="<?= base_url('pegawai/chat')?>"><span class="bg-warning p-2 rounded"><i class="ri-message-3-line text-light" style="font-size: 20px"></i></span></a>
  </div> -->

  <!-- Vendor JS Files -->
 





</body>


</html>