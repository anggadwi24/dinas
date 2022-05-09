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
    <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/css/firework.css" rel="stylesheet">
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
     <script type="text/javascript">
      $(document).ready(function(){
        cabang();
        function cabang(){
          var id_sd = $('#cabang').val();
          console.log(id_sd);
          if(id_sd != 'all'){
            $.ajax({
            type:"POST",
            url:"<?php echo site_url('pengawas/getBagian'); ?>",
            data:"id_sd="+id_sd,
            success: function(response){
              $('#bagian').html(response);
            }
          })
          }
          
        }
        $('#cabang').change(function(){
          var id_sd = $('#cabang').val();
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('pengawas/getBagian'); ?>",
            data:"id_sd="+id_sd,
            success: function(response){
              $('#bagian').html(response);
            }
          })
        })

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

 
 <section id="hero" class="d-flex align-items-center"  >
     <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-12  text-left">
         
             <a href="<?= base_url('pengawas/pegawai') ?>" class="float-left">
                  <i class="ri-arrow-left-s-line" style="font-size: 30px;color: white;"></i>

            </a>
            
          
        </div>
        <div class="col-12 text-center">
          <div class="pyro">
            <div class="before"></div>
            <div class="after"></div>
        </div>
          <h1><i class="ri-trophy-fill" style="font-size: 80px;"></i></h1>
          <h5>Peringkat Bulan <?= bulan($bulan)?></h5>
        </div>
       
      
</div>
  </section><!-- End Hero -->

    <main id="main">
       <section id="about" class="about">
  <?php if($jabatan == 'admin'){?>
    <?php $bag = $this->model_app->view('bagian');
    ?>
      <div class="container" >
         <form action="<?= base_url('pengawas/peringkat') ?>" method="post" onsubmit="$('#loader').show();">
        <div class="row">
          <?php 
            if($status == 'kelurahan'){
          ?>
          
           <div class="col-4 " data-aos="fade-left">
          <select class="form-control" name="bagian" id="bagian">
            <option value="all">All</option>
          </select>
        </div>
        <div class="col-4 " data-aos="fade-left">
          <select class="form-control" name="sub" id="sub">
            <option value="all">All</option>
           <?php   $sub_bag = $this->model_app->view_where('sub_bagian',array('id_bagian'=>$bagian));?>
            <?php 
            if($sub_bagian != 'all'){
            foreach($sub_bag->result_array() as $sub){?>
                  <?php if($sub[id_sub_bagian] == $sub_bagian){?>
                   <option value="<?= $sub[id_sub_bagian]?>" selected><?= ucfirst($sub['nama_sub_bagian'])?></option>
                      <?php }else{?>
                    <option value="<?= $sub[id_sub_bagian]?>"><?= ucfirst($sub['nama_sub_bagian'])?></option>
                      <?php }?>
           <?php }} ?>

          </select>
        </div>
        <div class="col-3">
          <select class="form-control" name="bulan">
            <option value="01" <?php if($bulan == '01'){echo "selected"; }?> >Januari</option>
            <option value="02" <?php if($bulan == '02'){echo "selected"; }?>>Februari</option>
            <option value="03" <?php if($bulan == '03'){echo "selected"; }?>>Maret</option>
            <option value="04" <?php if($bulan == '04'){echo "selected"; }?>>April</option>
            <option value="05" <?php if($bulan == '05'){echo "selected"; }?>>Mei</option>
            <option value="06" <?php if($bulan == '06'){echo "selected"; }?>>Juni</option>
            <option value="07" <?php if($bulan == '07'){echo "selected"; }?>>Juli</option>
            <option value="08" <?php if($bulan == '08'){echo "selected"; }?>>Agustus</option>
            <option value="09" <?php if($bulan == '09'){echo "selected"; }?>>September</option>
            <option value="10" <?php if($bulan == '10'){echo "selected"; }?>>Oktober</option>
            <option value="11" <?php if($bulan == '11'){echo "selected"; }?>>November</option>
            <option value="12" <?php if($bulan == '12'){echo "selected"; }?>>Desember</option>
          </select>
        </div>
        <div class="col-12 mt-3" data-aos="fade-right">
          <input type="submit" name="submit" class="btn btn-warning text-light w-100 " value="Cari">
        </div>
          <?php  
            }else{
          ?>  
       
           <div class="col-4 " data-aos="fade-left">
          <select class="form-control" name="bagian" id="bagian">
            <option value="all">All</option>
          </select>
        </div>
        <div class="col-4 " data-aos="fade-left">
          <select class="form-control" name="sub" id="sub">
            <option value="all">All</option>
          

          </select>
        </div>
        <div class="col-5 mt-3">
          <select class="form-control" name="bulan">
            <option value="01" <?php if($bulan == '01'){echo "selected"; }?> >Januari</option>
            <option value="02" <?php if($bulan == '02'){echo "selected"; }?>>Februari</option>
            <option value="03" <?php if($bulan == '03'){echo "selected"; }?>>Maret</option>
            <option value="04" <?php if($bulan == '04'){echo "selected"; }?>>April</option>
            <option value="05" <?php if($bulan == '05'){echo "selected"; }?>>Mei</option>
            <option value="06" <?php if($bulan == '06'){echo "selected"; }?>>Juni</option>
            <option value="07" <?php if($bulan == '07'){echo "selected"; }?>>Juli</option>
            <option value="08" <?php if($bulan == '08'){echo "selected"; }?>>Agustus</option>
            <option value="09" <?php if($bulan == '09'){echo "selected"; }?>>September</option>
            <option value="10" <?php if($bulan == '10'){echo "selected"; }?>>Oktober</option>
            <option value="11" <?php if($bulan == '11'){echo "selected"; }?>>November</option>
            <option value="12" <?php if($bulan == '12'){echo "selected"; }?>>Desember</option>
          </select>
        </div>
        <div class="col-5 mt-3" data-aos="fade-right">
          <input type="submit" name="submit" class="btn btn-warning text-light " value="Cari">
        </div>
        <?php }?>
       
       
        </div>
 </form>
      </div>
  <?php }else{
      if($this->session->sub_bagian == 0){
        $sub_bag = $this->model_app->view_where('sub_bagian',array('id_bagian'=>$this->session->bagian));
      ?>
      <div class="container" >
         <form action="<?= base_url('pengawas/peringkat') ?>" method="post" onsubmit="$('#loader').show();">
        <div class="row">
      
        <div class="col-4 " data-aos="fade-left">
          <select class="form-control" name="sub" >
            <option value="all">All</option>
            <?php foreach($sub_bag->result_array() as $sub){?>
                  <?php if($sub[id_sub_bagian] == $sub_bagian){?>
                   <option value="<?= $sub[id_sub_bagian]?>" selected><?= ucfirst($sub['nama_sub_bagian'])?></option>
                      <?php }else{?>
                    <option value="<?= $sub[id_sub_bagian]?>"><?= ucfirst($sub['nama_sub_bagian'])?></option>
                      <?php }?>
           <?php }?>
          </select>
        </div>
           <div class="col-4">
          <select class="form-control" name="bulan">
            <option value="01" <?php if($bulan == '01'){echo "selected"; }?> >Januari</option>
            <option value="02" <?php if($bulan == '02'){echo "selected"; }?>>Februari</option>
            <option value="03" <?php if($bulan == '03'){echo "selected"; }?>>Maret</option>
            <option value="04" <?php if($bulan == '04'){echo "selected"; }?>>April</option>
            <option value="05" <?php if($bulan == '05'){echo "selected"; }?>>Mei</option>
            <option value="06" <?php if($bulan == '06'){echo "selected"; }?>>Juni</option>
            <option value="07" <?php if($bulan == '07'){echo "selected"; }?>>Juli</option>
            <option value="08" <?php if($bulan == '08'){echo "selected"; }?>>Agustus</option>
            <option value="09" <?php if($bulan == '09'){echo "selected"; }?>>September</option>
            <option value="10" <?php if($bulan == '10'){echo "selected"; }?>>Oktober</option>
            <option value="11" <?php if($bulan == '11'){echo "selected"; }?>>November</option>
            <option value="12" <?php if($bulan == '12'){echo "selected"; }?>>Desember</option>
          </select>
        </div>
        <div class="col-2" data-aos="fade-right">
          <input type="submit" name="submit" class="btn btn-warning text-light" value="Cari">
        </div>
       
        </div>
 </form>
      </div>
  <?php
      }else{
       $sub_bag = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$this->session->sub_bagian))->row_array();
  ?>

          <div class="container" >
          <form action="<?= base_url('pengawas/peringkat') ?>" method="post" onsubmit="$('#loader').show();">
            <div class="row">
           
            <div class="col-12 text-center" data-aos="fade-up">
             <h5><?= $sub_bag['nama_sub_bagian']?></h5>
            </div>
              <div class="col-10">
          <select class="form-control" name="bulan">
            <option value="01" <?php if($bulan == '01'){echo "selected"; }?> >Januari</option>
            <option value="02" <?php if($bulan == '02'){echo "selected"; }?>>Februari</option>
            <option value="03" <?php if($bulan == '03'){echo "selected"; }?>>Maret</option>
            <option value="04" <?php if($bulan == '04'){echo "selected"; }?>>April</option>
            <option value="05" <?php if($bulan == '05'){echo "selected"; }?>>Mei</option>
            <option value="06" <?php if($bulan == '06'){echo "selected"; }?>>Juni</option>
            <option value="07" <?php if($bulan == '07'){echo "selected"; }?>>Juli</option>
            <option value="08" <?php if($bulan == '08'){echo "selected"; }?>>Agustus</option>
            <option value="09" <?php if($bulan == '09'){echo "selected"; }?>>September</option>
            <option value="10" <?php if($bulan == '10'){echo "selected"; }?>>Oktober</option>
            <option value="11" <?php if($bulan == '11'){echo "selected"; }?>>November</option>
            <option value="12" <?php if($bulan == '12'){echo "selected"; }?>>Desember</option>
          </select>
        </div>
        <div class="col-2" data-aos="fade-right">
          <input type="submit" name="submit" class="btn btn-warning text-light w-100" value="Cari">
        </div>

         
           
            </div>
          </form>
          </div>

  <?php
      }
    } ?>
  </section>
    <!-- ======= About Section ======= -->
     <section id="about" class="about" >
      <div class="container" data-aos="fade-down" >
      
      
        <div id="load_data" class="row" >
            
        </div>
                
        <div id="load_data_message" class="text-center"></div>
        
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



<script>
  $(document).ready(function(){

    var limit = 100;
    var start = 0;
  
    var sub = '<?= $sub_bagian ?>';
    var bagian = '<?= $bagian?>';
    var bulan = '<?= $bulan?>';
    var cabang = '<?= $cabang ?>';
    var action = 'inactive';

    function lazzy_loader(limit)
    {
      var output = '';
      for(var count=0; count<limit; count++)
      {
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
      }
      $('#load_data_message').html(output);
    }

    lazzy_loader(limit);

    function load_data(limit, start,sub,bagian,bulan,cabang)
    {
       
      $.ajax({
        url:"<?php echo base_url(); ?>pengawas/fetch_peringkat",
        method:"POST",
        data:{limit:limit, start:start,sub:sub,bagian:bagian,bulan:bulan,cabang:cabang},
        cache: false,
        success:function(data)
        {

          if(data == '')
          {
            $('#load_data_message').html('');
            action = 'active';
          }
          else
          {
            $('#load_data').append(data);
            $('#load_data_message').html("");
            action = 'inactive';
          }
        }
      })
    }

    if(action == 'inactive')
    {
      action = 'active';
   load_data(limit, start,sub,bagian,bulan,cabang);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
        lazzy_loader(limit);
        action = 'active';
        start += limit;
        console.log(start);
        setTimeout(function(){
        load_data(limit, start,sub,bagian,bulan,cabang);
        }, 1000);
      }
    });

  });
</script>
<script type="text/javascript">
  function detailKinerja(id){
   window.location.href = '<?= base_url('pengawas/detailKinerja/')?>'+id;
 }
</script>
</body>





</html>