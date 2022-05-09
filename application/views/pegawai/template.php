<!DOCTYPE html>
<html translate="no">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/img/favicon.png" rel="icon">
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
 
  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/aos/aos.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" />
  <!-- Template Main CSS File -->
  <link href="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
 




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
#fixedContainer {
  position: fixed;
 
  right: 0;
  bottom: 60px;
  padding: 15px;

 /*half the width*/
}
</style>
</head>

<body>
  <style type="text/css">
    .text-danger {
      color: #dc3545;
    }
  </style>
   <?php if($this->session->flashdata('message')){ ?>

    <script type="text/javascript">
            Swal.fire({

            title: 'Mohon Maaf',
            text: '<?php echo $this->session->flashdata('message'); ?>',
             customClass: 'swal-wide',
            imageUrl: "<?= base_url('asset/images/iconic.jpg')?>",
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
             imageUrl: "<?= base_url('asset/images/iconic.jpg')?>",
  imageClass:'img-responsive ',  
 
  imageWidth:'200px',
  imageHeight:'300px',  
            
          })
  </script>
  <?php }?>

  <!-- ======= Header ======= -->
  <?php include "header.php";?>
  <!-- ======= Hero Section ======= -->

  <?php 
  $user = $this->model_app->view_Where('pegawai',array('id_pegawai'=>$this->session->userdata['pegawai']['id_pegawai']))->row_array();
  $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$user['sub_bagian']))->row_array();
    $foto = $user['foto_profile'];
     if (!file_exists("asset/foto_user/$foto") OR $foto==''){
      $pp = base_url('asset/foto_user/blank.png');
     }else{
      $pp = base_url('asset/foto_user/').$foto;
     }

  ?>
 <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-8 ">
          <h5 class="mb-4">Selamat Datang, <?= ucfirst($user['nama_panggilan'])?></h5>
          <h5><b><?= ucfirst($user['nama_lengkap'])?></b></h5>
          <label><?= $sub['nama_sub_bagian']?></label>
        </div>
        <div class="col-4">
          <img src="<?= $pp?>" class="rounded-circle mt-4" style="width: 80px;" alt="Cinque Terre">
        </div>
      </div>
      <?php if($this->uri->segment('2')=='absensi'){ ?>
        <?php if($access == 'y'){?>
        <?php   
            $id = $this->session->userdata['pegawai']['id_pegawai'];
            $tanggal = date('Y-m-d');
        $abs = $this->db->query("SELECT * FROM absensi WHERE tanggal = '$tanggal' AND id_pegawai = $id");
        $absen = $abs->row_array();
        if($abs->num_rows() > 0  AND $absen['absen_keluar']=="" ){
            echo "   
            <div class='row justify-content-center mt-5'>
              <div class='col-12 text-center'>
                <a href='".base_url('pegawai/inputabsen/').$absen['id_absensi']."' class='btn  text-light rounded-pill ' style='background-color: #ff5a00 !important'>ABSEN KELUAR</a>
              </div>
            </div>";
        }elseif($abs->num_rows() <= 0){
           echo "   
            <div class='row justify-content-center mt-5'>
              <div class='col-12 text-center'>
                <a href='".base_url('pegawai/inputabsen/')."' class='btn  text-light rounded-pill ' style='background-color: #ff5a00 !important'>ABSEN MASUK</a>
              </div>
            </div>";
        } 
        ?>
        
        
     <?php }?>
    <?php }?>
     <?php if($this->uri->segment('2')=='form'){ 

         echo "   
            <div class='row justify-content-center mt-5'>
              <div class='col-12 text-center'>
                <a href='".base_url('pegawai/inputform/')."' class='btn  text-light rounded-pill ' style='background-color: #ff5a00 !important'>AJUKAN FORM</a>
              </div>
            </div>";
      }?> 
       <?php if($this->uri->segment('2')=='report'){ 

         echo "   
            <div class='row justify-content-center mt-5'>
              <div class='col-12 text-center'>
                <a href='".base_url('pegawai/inputreport/')."' class='btn  text-light rounded-pill ' style='background-color: #ff5a00 !important'>TAMBAH REPORT</a>
              </div>
            </div>";
      }?> 
     

    </div>

  </section>

  <main id="main">

    <!-- ======= About Section ======= -->
<?php $h = date('w');
     $h = hari_ini($h);

     $harikerja = $this->model_app->view_where('shift',array('hari'=>$h));
     $hk = $harikerja->row_array();
     $bulan = date('m');
     $tgl = date('j');
     $id = $this->session->userdata['pegawai']['id_pegawai'];
     $hadir = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $id AND MONTH(tanggal) = $bulan")->num_rows();
     $form_i = $this->db->query("SELECT * FROM form_izin WHERE id_pegawai = $id AND MONTH(dari) = $bulan AND MONTH(sampai) = $bulan AND status='Izin'");
      $form_s = $this->db->query("SELECT * FROM form_izin WHERE id_pegawai = $id AND MONTH(dari) = $bulan AND MONTH(sampai) = $bulan AND status='Sakit'");
      $ijin = 0;
      foreach($form_i->result_array() as $i)
      { 

        $di = date('Ymd',strtotime($i['dari']));
        $si = date('Ymd',strtotime($i['sampai']));
        $ijin += ($si - $di) + 1;

      }
      $sakit = 0;
       foreach($form_s->result_array() as $s)
      { 

        $ds = date('Ymd',strtotime($s['dari']));
        $ss = date('Ymd',strtotime($s['sampai']));
        $sakit += ($ss - $ds) + 1;

      }

      $harikerja1 = $this->db->query("SELECT * FROM harikerja WHERE bulan = $bulan AND tanggal <= $tgl AND tahun = '".date('Y')."' AND status = 'kerja' ");
      $alpha = 0;
      foreach($harikerja1->result_array() as $hi){
        $tgl = $hi['tahun'].'-'.$hi['bulan'].'-'.$hi['tanggal'];
        $date = date('Y-m-d',strtotime($tgl));
        $abs = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $id AND tanggal = '$date'");
        if($abs->num_rows() <= 0 )
        {
          $alpha += 1;
        }else{
          $alpha +=0;
        }
      }
     


     ?>
 <section id="about" class="about position-relative" style="margin-top: -30px !important;padding:0px !important;">
      <div class="container" data-aos="fade-up">
    
      <div class="card mb-5" style="background: transparent !important;border: none !important;" >
        <div class="card-header text-light text-center rounded-pill" style="background-color: #960001 !important">
          Data Absensi Bulan <?= bulan(date('m'))?>
        </div>
        <div class="card-body text-center" style="box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);">
          <div class="row">
      <?php if($harikerja->num_rows() > 0){?>
        <div class="col-12 mb-3"><span ><?= $hk['hari'].'   '. date('H:i',strtotime($hk['shift_masuk'])).'-'. date('H:i',strtotime($hk['shift_keluar']))?></span></div>
      <?php }else{?>
         <div class="col-12"><h6>Hari ini Libur</h6></div>
      <?php }?>
            <div class="col-3 border-top border-right"><span>HADIR</span><h6><?= $hadir?></h6></div>
            <div class="col-3 border-top border-right"><span>IJIN</span><h6><?= $ijin?></h6></div>
            <div class="col-3 border-top border-right"><span>SAKIT</span><h6><?= $sakit?></h6></div>
             <div class="col-3 border-top"><span>ALPHA</span><h6><?= $alpha?></h6></div>
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 my-3">
            <div id='calendar'></div>
        </div>
      
      </div>
      <?php $lembur = $this->model_app->view_where('lembur',array('id_pegawai'=>$this->session->userdata['pegawai']['id_pegawai'],'date'=>date('Y-m-d')));
            if($lembur->num_rows() > 0){
         ?>
           <div class="row mt-3 justify-content-center">
             <div class="col-12"><h3><b>SURAT TUGAS</b></h3></div>
             <?php foreach($lembur->result_array() as $lem){?>
             <div class="col-12  text-light m-2" style="color: #B56C0D; "><a href="<?= base_url('main/downloadlembur/').sha1($lem[id_lembur]).'/'.$lem['id_lembur']?>" style="color: #B56C0D"><i class="ri-file-pdf-line"></i> DOWNLOAD PDF</a></div>
           <?php }?>
           </div>
         <?php }?>
           <?php 
        $tgl = date('Y-m-d');
        $id_peg= $this->session->userdata['pegawai']['id_pegawai'];
        $form = $this->db->query("SELECT * FROM form_izin WHERE id_pegawai = $id_peg  AND sampai >= '$tgl' ORDER BY id_form DESC LIMIT 3");
        if($form->num_rows() > 0){
        ?>
        <div class="row mt-3 justify-content-center">
             <div class="col-12"><h3><b>FORM PENGAJUAN</b></h3></div>
             <?php foreach($form->result_array() as $form){
               $tgl1 = strtotime($form['dari']); 
                $tgl2 = strtotime($form['sampai']); 

                $jarak = $tgl2 - $tgl1;
                    $hari = $jarak / 60 / 60 / 24 +1;
              ?>
             <div class="col-12"><h6><?= strtoupper($form['status'])?></h6></div>
             <div class="col-12"><label style="font-size: 12px;color: #B56C0D;"><?= format_indo($form['dari']).' - '.format_indo($form['sampai']). ' ( ' .$hari. ' Hari )'?></label></div>
             <div class="col-12">
               
               <label style="font-size: 12px;color: #B56C0D;" class="float-right">
                 <?php 
                    if($form['approved'] == 'setuju'){
                      echo "Pengajuan Disetujui";
                    }elseif($form['approved'] =='proses'){
                      echo "Pengajuan dalam proses";
                    }else{
                      echo "Pengajuan Ditolak";
                    }

                 ?>
               </label>
             </div>
             <div class="col-12"><hr style="width: 100%;border-top: 1px solid #f9ad4a; "></div>
           <?php }?>
           </div>
        <?php
        }

        ?>
      <div class="col-12 mt-5">
          <a href="<?= base_url('pegawai/logout')?>" class="btn btn-danger col-12">LOGOUT</a>
      </div>
      </div>
      

  </section>

    <!-- ======= Counts Section ======= -->
  
  </main><!-- End #main -->
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
  <!-- <div id="fixedContainer">
    <a href="<?= base_url('pegawai/chat')?>"><span class="bg-warning p-2 rounded"><i class="ri-message-3-line text-light" style="font-size: 20px"></i></span></a>
  </div> -->

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/moment/moment.js"></script>    
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/fullcalendar/js/fullcalendar.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/counterup/counterup.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/vendor/aos/aos.js"></script>


  <script>
    data();
    function data(){
   
   $.ajax({
       
       type:'POST',
       url:'<?= base_url('pegawai/dataCalendar') ?>',
      
       dataType:'json',
      success:function(resp){
           if(resp.status == true){
               
               $('#calendar').fullCalendar({
                   header: {
                      left: 'prev,next',
                       center: 'title',
                       right: false,
                   },
                   editable: false,
                   eventLimit: true, /* -- allow "more" link when too many events -- */
                   droppable: false, /* -- this allows things to be dropped onto the calendar !!! -- */
                   drop: function(date, allDay) { /* -- this function is called when something is dropped -- */
                       /* -- retrieve the dropped element's stored Event Object -- */
                       var originalEventObject = $(this).data('eventObject');
                       /* -- we need to copy it, so that multiple events don't have a reference to the same object -- */
                       var copiedEventObject = $.extend({}, originalEventObject);
                       /* -- assign it the date that was reported -- */
                       copiedEventObject.start = date;
                       copiedEventObject.allDay = allDay;
                       /* -- render the event on the calendar -- */
                       /* -- the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/) -- */
                       $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                       /* -- is the "remove after drop" checkbox checked? -- */
                      
                   },
                  //  eventClick: function(event, element)
                  //  {
                  //     detailBook(event.id);
                  //  },
                   events: resp.arr
               });        
           }
          
       }
       
       
   })
}
  </script>
  <!-- Template Main JS File -->
  <script src="<?php echo base_url(); ?>template/<?php echo base_theme(); ?>/assets/js/main.js"></script>
   
  

</body>

</html>