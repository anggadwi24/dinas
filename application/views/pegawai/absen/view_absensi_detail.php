<!DOCTYPE html>
<html translate="no">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/img/favicon.png" rel="icon">
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/counterup/counterup.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
   <script 
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvIKsWqK6VMx5ZDko3-3EvV1EAxfSyrMk">
</script>

     <style>
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
          background: -webkit-gradient(linear, left top, right top, color-stop(8%, #eeeeee), color-stop(18%, #dddddd), color-stop(33%, #eeeeee));
          background: -webkit-linear-gradient(left, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
          background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
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
         
        }
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

@-webkit-keyframes animate-loader {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes animate-loader {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

    </style>



  <!-- =======================================================
  * Template Name: OnePage - v2.2.2
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
 
  <?php if($this->session->flashdata('message')){ ?>

    <script type="text/javascript">
            Swal.fire({

            title: 'Peringatan',
            text: '<?php echo $this->session->flashdata('message'); ?>',
             customClass: 'swal-wide',
             type:'error',
            
          })
  </script>
  <?php }?>
  <?php if($this->session->flashdata('success')){ ?>

    <script type="text/javascript">
            Swal.fire({

            title: 'Peringatan',
            text: '<?php echo $this->session->flashdata('success'); ?>',
             customClass: 'swal-wide',
             type:'success',
            
          })
  </script>
  <?php }?>

  <!-- ======= Header ======= -->
  <?php include "header.php";?>
  <!-- ======= Hero Section ======= -->

  <?php $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$this->session->sub_bagian))->row_array()?>

  <?php 
    $foto = $this->session->foto_profile;
     if (!file_exists("asset/foto_user/$foto") OR $foto==''){
      $pp = base_url('asset/foto_user/blank.png');
     }else{
      $pp = base_url('asset/foto_user/').$foto;
     }
     $h = date('w',strtotime($row['tanggal']));
     $h = hari_ini($h);

     $hk = $this->model_app->view_where('shift',array('hari'=>$h))->row_array();
  ?>
 <section id="hero1" class="d-flex align-items-center" style="padding:20px !important" >
     <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-12  text-left">
          <h5>
             <a href="<?= $_SERVER['HTTP_REFERER'] ?>">
                  <i class="ri-arrow-left-s-line" style="font-size: 30px;color: white;"></i>

            </a>
          </h5>
        </div>
       
      <div class="col-12  mt-3 text-center">
        <h5 style="color: white" class=" "><?= $judul?></h5>
      </div>
      <div class="col-12 mt-1 text-center">
        <h2><?= date('H:i')?> </h2>
        <label><?= $hk['hari'].', '.date('H:i',strtotime($hk['shift_masuk'])).' - '.date('H:i',strtotime($hk['shift_keluar']))?></label>
      </div>
  </div>
</div>
  </section><!-- End Hero -->
  <?php 

    if($row['absen_keluar'] == ""){
        $out = "-- : -- ";
     }else{
        $out = date('H:i',strtotime($row['absen_keluar']));
    }
    if($row['foto_keluar']==""){
        $foto_out =  "Tidak Ada";
    }else{
         $foto_out = "   <img src='". $row['foto_keluar']."'>";
     }  
     if($row['ket'] == 'dinas'){
      $ket = 'DL';
     }elseif($row['ket']=='tugas'){
      $ket = 'TL';
     }else{
      $ket ="ABSEN";
     }

     if($row['telat'] == 'y')
     {
      $telat = "Terlambat";
     }else{
      $telat = "Datang Tepat Waktu";
     }

     if($row['pulang_awal'] == 'y'){
      $pulang = "Pulang Mendahului";
     }else{
      $pulang ="Pulang Tepat Waktu";
     }
  ?>
    <main id="main">
    <!-- ======= About Section ======= -->
     <section id="about" class="about" >
      <div class="container" data-aos="fade-up" >
        <div class="row justify-content-between text-center">
          <div class="col-12 form-group text-center">
           
            <h3><?= $ket ?></h3>
          </div>
          <div class="col-12 form-group">
            <label>Tanggal</label>
            <h3><?= format_indo($row['tanggal'])?></h3>
          </div>
          <div class="col-6 form-group">
            <label>Absen Masuk</label>
            <h3><?= date('H:i',strtotime($row['absen_masuk']));?></h3>
          </div>
          <div class="col-6 form-group">
            <label>Absen Keluar</label>
            <h3><?= $out?></h3>
          </div>
          <div class="col-6 form-group">
          
            <label><?= $telat?></label>
          </div>
          <div class="col-6 form-group">
           
            <label><?= $pulang?></label>
          </div>
          <div class="col-6 form-group">
            <h6>Foto Masuk</h6>
            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Buka</a>
            <div class="collapse" id="collapseExample">
            <div class="card card-body">
             <img src="<?=$row['foto_masuk']?>">
            </div>
          </div>
          </div>
          <div class="col-6 form-group">
            <h6>Foto Keluar</h6>
             <a data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">Buka</a>
            <div class="collapse" id="collapseExample1">
            <div class="card card-body">
             <?= $foto_out?>
            </div>
          </div>
          </div>
          <div class="col-12 form-group">
              <?php

                                              $lat_in = $row['latitude_in'];
                                              $long_in = $row['longitude_in'];

                                             

                                                $lat_out = $row['latitude_out'];
                                                $long_out = $row['longitude_out'];

                                           
                                           ?>
                                           <script>    

                                              var marker;
                                              function initialize() {  
                                                  // Variabel untuk menyimpan informasi (desc)
                                                  var infoWindow = new google.maps.InfoWindow;
                                                  //  Variabel untuk menyimpan peta Roadmap
                                                  var mapOptions = {
                                                      mapTypeId: google.maps.MapTypeId.ROADMAP
                                                  } 
                                                  // Pembuatan petanya
                                                  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);      
                                                  // Variabel untuk menyimpan batas kordinat
                                                  var bounds = new google.maps.LatLngBounds();
                                                  // Pengambilan data dari database
                                              <?php echo ("addMarker($lat_in, $long_in, 'absen masuk');\n");?>
                                              <?php if($lat_out != "" AND $long_out != ""){?>
                                              <?php echo ("addMarker($lat_out, $long_out, 'absen keluar');\n");?>
                                              <?php }?>
                                                  // Proses membuat marker 
                                                  function addMarker(lat, lng, info) {
                                                      var lokasi = new google.maps.LatLng(lat, lng);
                                                      bounds.extend(lokasi);
                                                      var marker = new google.maps.Marker({
                                                          map: map,
                                                          position: lokasi
                                                      });       
                                                      map.fitBounds(bounds);
                                                      bindInfoWindow(marker, map, infoWindow, info);
                                                   }        
                                                  // Menampilkan informasi pada masing-masing marker yang diklik
                                                  function bindInfoWindow(marker, map, infoWindow, html) {
                                                      google.maps.event.addListener(marker, 'click', function() {
                                                      infoWindow.setContent(html);
                                                      infoWindow.open(map, marker);
                                                    });
                                                  }
                                              }
                                              google.maps.event.addDomListener(window, 'load', initialize);
                                          </script>
                                         
                                           <div id="map-canvas" class="col-sm-12" style="height:250px;"></div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======= Counts Section ======= -->
    </main>

<!-- End #main -->
<?php $this->model_utama->kunjungan(); ?>
  <!-- ======= Footer ======= -->
  <footer id="footer">

 

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left text-lg-center">
        <div class="copyright">
          &copy; Copyright <strong><span>PEMERINTAH PROVINSI SULAWESI BARAT SEKRETARIAT DAERAH</span></strong>
        
      </div>
     
    </div>
  </footer><!-- End Footer -->


  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div>

<div id="loader" style="display: none;"></div>

  <!-- Vendor JS Files -->



  <!-- Template Main JS File -->

  <script >
    $(document).ready(function() {
   $('#example').dataTable( {
  "searching": false,
  "lengthChange": false
} );

} );
  </script>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
<script>
getLocation();
getLocation_out();

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        view.innerHTML = "Yah browsernya ngga support Geolocation bro!";
    }
}
 function showPosition(position) {



 document.getElementById("lat").value = position.coords.latitude;
  document.getElementById("long").value =position.coords.longitude;

   
 }
 function getLocation_out() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition_out);
    } else {
        alert('Yah browsernya ngga support Geolocation bro!');
    }
}
 function showPosition_out(position) {

  document.getElementById("lat1").value = position.coords.latitude;
  document.getElementById("long1").value =position.coords.longitude;
  
   
 }
</script>
<script type="text/javascript">


     $("#maps_in").on('click',function(){
           var lat = $(this).attr("data-lat");
           var long = $(this).attr("data-long");
           
          
           
            $.ajax({
                url: '<?php echo base_url(); ?>pegawai/lokasi',
                type: 'POST',
                data: {lat:lat,long:long},
                success: function(data){
                     
                console.log(data);
            
                  

                 
              
            }
                
            })
 
        });
</script>
<script>
function detailReport(id){
   window.location.href = '<?= base_url('pegawai/detailreport/')?>'+id;
 }
</script>

</body>

</html>