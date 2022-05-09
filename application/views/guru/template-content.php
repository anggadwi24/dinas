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
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAV0e-lFppqNT9E_ZmGzYNQ0Qst92QODxw">
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

            title: 'Mohon Maaf',
            text: '<?php echo $this->session->flashdata('message'); ?>',
             customClass: 'swal-wide',
            imageUrl: "<?= base_url('asset/images/iconic.png')?>",
  imageClass:'img-responsive ',  
 
  imageWidth:'200px',
  imageHeight:'300px',  
            
          })
  </script>
  <?php }?>
  <?php if($this->session->flashdata('success')){ ?>

    <script type="text/javascript">
            Swal.fire({

            title: 'Berhasil',
            text: '<?php echo $this->session->flashdata('success'); ?>',
             customClass: 'swal-wide',
             imageUrl: "<?= base_url('asset/images/iconic.png')?>",
  imageClass:'img-responsive ',  
 
  imageWidth:'200px',
  imageHeight:'300px',  
            
          })
  </script>
  <?php }?>

  <!-- ======= Header ======= -->
  <?php include "header.php";?>
  <!-- ======= Hero Section ======= -->

  <?php ?>

  <?php 
  $user = $this->model_app->view_Where('guru',array('id_guru'=>$this->session->userdata['guru']['id_guru']))->row_array();
  // $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$user['sub_bagian']))->row_array();
    $foto = $user['foto'];

  ?>
 <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-8 ">
          <h5 class="mb-4">Selamat Datang, <?= ucfirst($user['nama_guru'])?></h5>
          <h5><b><?= ucfirst($user['nama_guru'])?></b></h5>
          
        </div>
        <div class="col-4">
          <img src="<?= $foto?>" class="rounded-circle mt-4" style="width: 80px;height: 80px;" alt="Cinque Terre">
        </div>
      </div>
      <?php if($this->uri->segment('2')=='absensi'){ ?>
        <?php if($access == 'y'){?>
        <?php   
            $id = $this->session->userdata['guru']['id_guru'];
            $tanggal = date('Y-m-d');
        $abs = $this->db->query("SELECT * FROM absensi WHERE tanggal = '$tanggal' AND id_pegawai = $id AND status_absen = 'guru'");
        $absen = $abs->row_array();
        $hari= hari_ini(date('w'));
        $shift = $this->model_app->view_where('working_hours',array('hari'=>$hari));
        if($shift->num_rows() > 0){
          if($abs->num_rows() > 0  AND $absen['absen_keluar']=="" ){
            echo "   
            <div class='row justify-content-center mt-5'>
              <div class='col-12 text-center'>
                <a href='".base_url('guru/inputabsen/').$absen['id_absensi']."' class='btn  text-light rounded-pill ' style='background-color: #ff5a00 !important'>ABSEN KELUAR</a>
              </div>
            </div>";
          }elseif($abs->num_rows() <= 0){
            echo "   
              <div class='row justify-content-center mt-5'>
                <div class='col-12 text-center'>
                  <a href='".base_url('guru/inputabsen/')."' class='btn  text-light rounded-pill ' style='background-color: #ff5a00 !important'>ABSEN MASUK</a>
                </div>
              </div>";
          } 
        }
        
        ?>
        
        
     <?php }?>
    <?php }?>
     <?php if($this->uri->segment('2')=='form'){ 

         echo "   
            <div class='row justify-content-center mt-5'>
              <div class='col-12 text-center'>
                <a href='".base_url('guru/inputform/')."' class='btn  text-light rounded-pill ' style='background-color: #ff5a00 !important'>AJUKAN FORM</a>
              </div>
            </div>";
      }?> 
       <?php if($this->uri->segment('2')=='report'){ 

         echo "   
            <div class='row justify-content-center mt-5'>
              <div class='col-12 text-center'>
                <a href='".base_url('guru/inputreport/')."' class='btn  text-light rounded-pill ' style='background-color: #ff5a00 !important'>TAMBAH REPORT</a>
              </div>
            </div>";
      }?> 
     
    </div>
  </section><!-- End Hero -->

    <main id="main">
    <!-- ======= About Section ======= -->
    <?= $contents?>
    <div class="container mt-3">
      <div class="row form-group">
        <div class="col-12 form-group">
          <a href="<?= base_url('guru/logout')?>" class="btn btn-danger p-2 w-50 float-right">LOGOUT</a>
        </div>
      </div>
    </div>
    
    <!-- ======= Counts Section ======= -->
    </main>

<!-- End #main -->
<?php $this->model_utama->kunjungan(); ?>
  <!-- ======= Footer ======= -->
 <?php $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();?>
  <footer id="footer">

 

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left text-lg-center">
        <div class="copyright">
          &copy; Copyright <strong><span><?= strtoupper($cabang['nama_cabang']) ?></span></strong>. 
        
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
function detailReport(id){
   window.location.href = '<?= base_url('guru/detailreport/')?>'+id;
 }
 function detailAbsen(id){
   window.location.href = '<?= base_url('guru/detailabsen/')?>'+id;
 }
 function detailForm(id){
   window.location.href = '<?= base_url('guru/detailform/')?>'+id;
 }
</script>

<script>
  $(document).ready(function() {
    $("div[id='searchReport']").on('click',function(){
           var tanggal = $(this).attr("data-tanggal");
           var bulan = $(this).attr("data-bulan");
           var tahun = $(this).attr("data-tahun");
           
          
           
           var url = "<?= base_url('guru/report/')?>"+tanggal+"/"+bulan+"/"+tahun ;
            $(location).attr('href',url);

 
        });
    });
</script>
</body>

</html>