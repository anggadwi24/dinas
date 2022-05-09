<!DOCTYPE html>
<html translate="no">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/img/favicon.png" rel="icon">
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/css/firework.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
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

  <!-- Template Main JS File -->
  <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/assets/js/main.js"></script>
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
     <script type="text/javascript">
      $(document).ready(function(){
        $('#bagian').change(function(){
          var id_bagian = $('#bagian').val();
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('pengawas/sub'); ?>",
            data:"id_bagian="+id_bagian,
            success: function(response){
              $('#sub').html(response);
            }
          })
        })

       
      })

      
  </script>
 
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

 <?php 

  $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$row['bagian']))->row_array();
  $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$row['sub_bagian']))->row_array();
  $keg = $this->model_app->view_where('sub_kegiatan',array('id_sub_kegiatan'=>$row['sub_kegiatan']))->row_array();
 ?>
 <section id="hero" class="d-flex align-items-center" style="padding-top: 0px !important;height: 50px !important;"  >
     <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-12  text-left mt-5">
         
             <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="float-left">
                  <i class="ri-arrow-left-s-line" style="font-size: 30px;color: white;"></i>

            </a>
            
          
        </div>
        
       
      
</div>
  </section><!-- End Hero -->

    <main id="main">
     
    <!-- ======= About Section ======= -->
     <section id="about" class="about" >
      <div class="container" data-aos="fade-down" >
      
        <div class="section-title">
          <h2>LEMBAR KINERJA BULAN <?= strtoupper($bulan) ?> NON ASN</h2>
           <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
        </div>
        <div  class="row" >
            <div class="col-12">
                <?php 
    $foto = $row['foto_profile'];
     if (!file_exists("asset/foto_user/$foto") OR $foto==''){
      $pp = base_url('asset/foto_user/blank.png');
     }else{
      $pp = base_url('asset/foto_user/').$foto;
     }
  ?>
               <center> <img src="<?= $pp ?>" class="img-fluid"></center>
            </div>
            <div class="col-12 mt-3">
               <h2 class="text-center"> BIODATA</h2>
              <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
            </div>
            <div class="col-12 form-group">
              <label>No KTP</label>
              <h6><?= $row['no_ktp']?></h6>
            </div>
            <div class="col-12 form-group">
              <label>Nama Lengkap</label>
              <h6><?= $row['nama_lengkap']?></h6>
            </div>
            <div class="col-12 form-group">
              <label>Nama Panggilan</label>
              <h6><?= $row['nama_panggilan']?></h6>
            </div>
            <div class="col-12 form-group">
              <label>Tempat Tanggal Lahir</label>
              <h6><?= $row['tempat_lahir']?>, <?= format_indo_w($row['tanggal_lahir']) ?></h6>
            </div>
             <div class="col-12 form-group">
              <label>Status</label>
              <h6><?= $row['status']?></h6>
            </div>
             <div class="col-12 form-group">
              <label>Agama</label>
              <h6><?= $row['agama']?></h6>
            </div>
            <div class="col-12 form-group">
              <label>No HP/WA</label>
              <h6><?= $row['no_hp']?></h6>
            </div>
            <div class="col-12 form-group">
              <label>Email</label>
              <h6><?= $row['email']?></h6>
            </div>
            <div class="col-12 form-group">
              <label>Pendidikan Terakhir</label>
              <h6><?= $row['pendidikan_terakhir']?></h6>
            </div>
            <div class="col-12 form-group">
              <label>Bagian</label>
              <h6><?= $bag['nama_bagian']?> ( <?= $bag['kepala_bagian']?> )</h6>
            </div>
            <div class="col-12 form-group">
              <label>Sub Bagian</label>
              <h6><?= $sub['nama_sub_bagian']?> ( <?= $sub['kepala_sub_bagian']?> )</h6>
            </div>
             <div class="col-12 form-group">
              <label>Sub Kegiatan</label>
              <h6><?= $keg['nama_kegiatan']?></h6>
            </div>
            <div class="col-12 form-group">
              <label>Tugas Pokok</label>
              <h6><?= $row['tugas_pokok']?></h6>
            </div>
            <div class="col-12 mt-3">
               <h2 class="text-center"> KINERJA</h2>
              <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
            </div>
            <div class="col-4 form-group">
              <label>Bulan</label>
              <h6><?= bulan(date('m')).' '.date('Y')?></h6>
            </div>
            <div class="col-4 form-group">
              <label>Dari Tanggal</label>
              <h6><?= format_indo_w(date('Y-m-01'))?></h6>
            </div>
             <div class="col-4 form-group">
              <label>Sampai Tanggal</label>
              <h6><?= format_indo_w(date('Y-m-d'))?></h6>
            </div>
             <div class="col-4 form-group">
              <label>Persentase Kehadiran</label>
              <h6><?= $persentase?>%</h6>
            </div>
             <div class="col-4 form-group">
              <label>Persentase Kinerja</label>
              <h6><?= $kinerja?>%</h6>
            </div>
            <div class="col-4 form-group">
              <label>Keterangan</label>
              <h6><?= $status?></h6>
            </div>
            <div class="col-6 form-group">
              <label>Telat Datang</label>
              <h6><?= $telat?></h6>
            </div>
            <div class="col-6 form-group">
              <label>Pulang Awal</label>
              <h6><?= $pulang?></h6>
            </div>
             <div class="col-4 form-group">
              <label>Alpha</label>
              <h6><?= $alpha?></h6>
            </div>
             <div class="col-4 form-group">
              <label>Izin</label>
              <h6><?= $izin?></h6>
            </div>
             <div class="col-4 form-group">
              <label>Sakit</label>
              <h6><?= $sakit?></h6>
            </div>
            <div class="col-6 form-group">
              <label>Jumlah Pekerjaan</label>
              <h6><?= $jumlah_kerja?></h6>
            </div>
            <div class="col-6 form-group">
              <label>Lama Pekerjaan</label>
              <h6><?= $lama_kerja?> Jam</h6>
            </div>
            <div class="col-12 mt-3">
               <h2 class="text-center"> DOKUMENTASI PEKERJAAN</h2>
              <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
            </div>
             <?php $report = $this->model_app->view_where_ordering('report',array('id_pegawai'=>$row['id_pegawai'],'MONTH(date)'=>$month),'id_report','DESC')->result_array();
                  $no =1;
                  foreach($report as $r){
            ?>
            <div class="col-12 form-group mt-2">
              <label>Nama Pekerjaan</label>
              <h6><?= ucfirst($r['judul_report'])?></h6>
            </div>
           <div class="col-12 form-group">
              <label>Lama Pekerjaan</label>
              <h6><?= date('H:i',strtotime($r['start'])).' - '.date('H:i',strtotime($r['end'])) ?> (<?= $r['jam_kerja']?> Jam)</h6>
            </div>
          
            <div class="col-6">
              <img src="<?= base_url('asset/foto_report/').$r['foto_masuk']?>" class="img-fluid">
            </div>
             <div class="col-6">
              <img src="<?= base_url('asset/foto_report/').$r['foto_keluar']?>" class="img-fluid">
            </div>
            <div class="col-12">
              <hr style="width: 80%;border-top: 3px solid #f9ad4a; ">
            </div>
             

          <?php }?>


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




</body>





</html>