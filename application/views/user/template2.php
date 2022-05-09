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
  <script type="text/javascript">
      $(document).ready(function(){
        $('#btnPelayanan').hide();
        $('#pelayanan').change(function(){
          var id_pelayanan = $('#pelayanan').val();
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('home/sub_pelayanan'); ?>",
            data:"id_pelayanan="+id_pelayanan,
            success: function(response){
              $('#sub_pel').html(response);
              $('#btnPelayanan').show();
            }
          })
        })

       
      })
  </script>
  <script type="text/javascript">
     $(document).ready(function(){
        $('#search_btn').hide();
        $('#formNIK').hide();

        $('#search_pel').change(function(){
          var id_pelayanan = $('#search_pel').val();
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('home/sub_pelayanan1'); ?>",
            data:"id_pelayanan="+id_pelayanan,
            success: function(response){
              $('#search_sub').html(response);
              $('#search_btn').show();
               $('#formNIK').show();
            }
          })
        })

       
      })
  </script>
  <script type="text/javascript">
     $(document).ready(function(){
      
        $('#prov').change(function(){
          console.log('hee');
          var id_prov = $('#prov').val();
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('home/kabupaten'); ?>",
            data:"id_prov="+id_prov,
            success: function(response){
              $('#kab').html(response);
            }
          })
        })
         $('#kab').change(function(){
          var id_kab = $('#kab').val();
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('home/kecamatan'); ?>",
            data:"id_kab="+id_kab,
            success: function(response){
              $('#kec').html(response);
            }
          })
        })
         $('#kec').change(function(){
          var id_kec = $('#kec').val();
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('home/kelurahan'); ?>",
            data:"id_kec="+id_kec,
            success: function(response){
              $('#kel').html(response);
            }
          })
        })
      })

  </script>
  <!-- ======= Header ======= -->
  <?php include "header.php";?>
  <!-- ======= Hero Section ======= -->
<?php  $h = date('w');
     $h = hari_ini($h);
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
     $oper = $this->model_app->view_where('shift',array('hari'=>$h));?>
  
 <section id="hero1" class="d-flex align-items-center" style="padding:20px !important" >
     <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
       
       
      <div class="col-12  mt-3 text-center">
        <h5 style="color: white" class=" "><?= strtoupper($cabang['nama_cabang'])?> </h5>
      </div>
      <div class="col-12 mt-1 text-center">
        <h5><?= strtoupper($judul);?> </h5>

      </div>
      <div class='col-12 mt-1'>
          <form id='formSearch' class='form-inline'>
          <div class="form-group mx-3 mb-2">
                <label for="inputPassword2" class="sr-only">Password</label>
                <input type="search" class="form-control" id="keyword" name='keyword' placeholder="Cari...">
            </div>
            <button type="submit" class="btn btn-info text-white mb-2 ml-1"><i class="ri-search-fill"></i></button>
          </form>
      </div>
  </div>
</div>
  </section><!-- End Hero -->

    <main id="main">
    <!-- ======= About Section ======= -->
    <?= $contents?>

    <!-- ======= Counts Section ======= -->
    </main>

<!-- End #main -->
<?php $this->model_utama->kunjungan(); ?>
  <!-- ======= Footer ======= -->
  <footer id="footer">

 

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left text-lg-center">
        <div class="copyright">
          &copy; Copyright <strong><span><?= strtoupper($cabang['nama_cabang'])?></span></strong>
        
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
<!-- <?php if($this->uri->segment('2') == 'inputabsen'){?>
     <script type="text/javascript">
  $(document).ready(function() {
  navigator.geolocation.getCurrentPosition(function(position){ 
      
        $("#lat").val(position.coords.latitude);
        $("#long").val(position.coords.longitude);
        $("#lat1").val(position.coords.latitude);
        $("#long1").val(position.coords.longitude);
    }, function (e) {
        Swal.fire({

            title: 'Alert',
            text: 'Anda Tidak Mengaktifkan Lokasi!',
             customClass: 'swal-wide',
             type:'error',
            
          }).then(function() {
    window.location = "<?= base_url('pegawai/absensi')?>";
});
    }, {
        enableHighAccuracy: true
    });
  });

</script>
<?php }else{?>
  <script type="text/javascript">
  $(document).ready(function() {
  navigator.geolocation.getCurrentPosition(function(position){ 
      
        $("#lat").val(position.coords.latitude);
        $("#long").val(position.coords.longitude);
        $("#lat1").val(position.coords.latitude);
        $("#long1").val(position.coords.longitude);
    }, function (e) {
        Swal.fire({

            title: 'Alert',
            text: 'Anda Tidak Mengaktifkan Lokasi!',
             customClass: 'swal-wide',
             type:'error',
            
          });
    }, {
        enableHighAccuracy: true
    });
  });

</script>
<?php }?> -->
<script>
function menu(id){
   window.location.href = id;
 }
</script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/js/main.js"></script>
    <script src="<?php echo base_url('asset/ckeditor/ckeditor.js');?>"></script>
 

 
    <script type="text/javascript">
        $(function () {
                CKEDITOR.replace('ckeditor',{
                    filebrowserImageBrowseUrl : '<?php echo base_url('asset/kcfinder/browse.php');?>',
                    height: '200px'             
                });
                CKEDITOR.config.toolbar = [
                 ['Styles','Format','Font','FontSize'],
                 '/',
                 ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
                 '/',
                 ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                 ['Image','Table','-','Link','Flash','Smiley','TextColor','BGColor','Source']
              ] ;
            });
    </script>
    <script type="text/javascript">
      function detailMusrenbang(id){
        window.location.href = '<?= base_url('home/detailMusrenbang/')?>'+id;
      }
    </script>
</body>

</html>