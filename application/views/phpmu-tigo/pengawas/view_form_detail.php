<!DOCTYPE html>
<html lang="en">

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
 <section id="hero1" class="d-flex align-items-center" style="padding:0px !important" >
     <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-12  text-left">
         
             <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="float-left">
                  <i class="ri-arrow-left-s-line" style="font-size: 30px;color: white;"></i>

            </a>
            
          
        </div>
       
      
</div>
  </section><!-- End Hero -->
<?php 

 $tgl1 = strtotime($row['dari']); 
                $tgl2 = strtotime($row['sampai']); 

                $jarak = $tgl2 - $tgl1;

                $hari = $jarak / 60 / 60 / 24;
            $bag = $this->db->query("SELECT * FROM bagian a JOIN sub_bagian b ON a.id_bagian = b.id_bagian WHERE id_sub_bagian = $row[sub_bagian]")->row_array();
      ?>
    <main id="main">
    <!-- ======= About Section ======= -->
     <section id="about" class="about" >
      <div class="container" data-aos="fade-up" >
        <div class="row">
        <div class="col-12">
          <h2 class="text-center">BIODATA</h2>
           <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
        </div>
        <div class="col-12 form-group">
            <label>Nama</label>
            <h6><?= $row['nama_lengkap']?> ( <?= $row['no_ktp']?> ) </h6>
        </div>
       
        <div class="col-6 form-group">
            <label>Bagian</label>
            <h6><?= $bag['nama_bagian']?></h6>
        </div>
        <div class="col-6 form-group">
            <label>Sub Bagian</label>
            <h6><?= $bag['nama_sub_bagian']?></h6>
        </div>
        </div>
        <div class="col-12 mt-3">
          <h3 class="text-center">MENGAJUKAN </h3>
            <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
        </div>
        <div class="row justify-content-between text-center">

          <div class="col-12 form-group text-center">
           
            <h3><?= strtoupper($row['status']) ?></h3>
          </div>
          <div class="col-12 form-group text-center">
            <h6>
            <?php 
            if($row['approved'] == 'proses'){
                echo "Form permohonan anda sedang diproses";
            }elseif($row['approved'] =='tidak'){
              echo "Form permohonan anda ditolak";
            }else{
              echo "Form anda telah disetujui";
            }
            ?>
            </h6>
          </div>
         
          <div class="col-4 form-group">
            <label>Dari Tanggal</label>
            <h6><?= format_indo_w($row['dari'])?></h6>
          </div>
          <div class="col-4 form-group">
            <label>Sampai Tanggal</label>
             <h6><?= format_indo_w($row['sampai'])?></h6>
          </div>
           <div class="col-4 form-group">
            <label>Selama</label>
             <h6><?= $hari ?> hari</h6>
          </div>
          <div class="col-12 form-group">
          
            <label><?= $row['keterangan']?></label>
          </div>

          <?php
          if($row['status'] == 'Sakit'){
           $ex = explode(';',$row['foto']);
           $hitungex = count($ex);

     
            for($i=0; $i<$hitungex; $i++){
                if (file_exists("asset/foto_form/".$ex[$i])) { 
                    if ($ex[$i]==''){
                        echo "<img style='height:120px; width:100%;  border:1px solid #cecece' src='".base_url()."asset/foto_form/no-image.jpg'>";
                    }else{
                       ?>
                         <div class="card col-6" style="width: 18rem;">
                          <img class="card-img-top" src="<?= base_url('asset/foto_form/').$ex[$i]?>" alt="Card image cap">
                        </div>
                    <?php 
                    }
                }else{
                    echo "<img style='height:120px; width:100%;  border:1px solid #cecece' src='".base_url()."asset/foto_form/no-image.jpg'>";
                }
            }
            }
           ?>
         <?php if($row['approved'] != 'setuju'){?>
        <div class="col-6 text-center mt-3"><a href="<?= base_url('pengawas/approv/setuju/').$row['id_form'].'/'.$row['id_pegawai'].'/'.$row['dari'].'/'.$row['sampai']?>" class="btn btn-success">Setujui</a></div>
        <div class="col-6 text-center mt-3"><a href="<?= base_url('pengawas/approv/tidak/').$row['id_form'].'/'.$row['id_pegawai'].'/'.$row['dari'].'/'.$row['sampai']?>" class="btn btn-danger">Tolak</a></div>
        <?php }else{?>
           <div class="col-6 text-center mt-3"><a href="<?= base_url('pengawas/approv/tidak/').$row['id_form'].'/'.$row['id_pegawai'].'/'.$row['dari'].'/'.$row['sampai']?>" class="btn btn-danger">Tolak</a></div>
        <?php
        }?>
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