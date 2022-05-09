 <style type="text/css">
   .nav-link{
    color: #f9ad4a;
   }
 </style>

 <?php $lok = $this->db->query("SELECT a.nama as kab , b.nama as kec , c.nama as kel FROM kabupaten a JOIN kecamatan b ON a.id_kab = b.id_kab JOIN kelurahan c ON b.id_kec = c.id_kec WHERE c.id_kel = '".$cabang['kelurahan']."' ")->row_array()?>
 <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2><?= $judul ?></h2>
          <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
          
        </div>
     
        <div class="row justify-content-center" >
          <?php $record = $this->model_app->view_where_ordering('wisata',array('id_sd'=>$cabang['id_sd']),'id_wisata','DESC');
          $no=1;
          foreach($record->result_array() as $row):
            if($no%2 == 0):
          ?>
          <div class="col-11 bg-white mb-2 py-3" data-aos="fade-in" data-aos-delay="100">
                <div class="row">
                  <div class="col-12">
                    <h6><?= strtoupper($row['tempat_wisata'])?></h6>
                  </div>
                  <div class="col-6">
                    <h6>LUAS <?= rupiah($row['luas'])?> Ha</h6>
                  </div>
                  <div class="col-6">
                    <h6>TINGKAT PEMANFAATAN <?php if($row['tingkat_pemanfaatan'] == 'y'){echo "AKTIF";}else{echo "TIDAK AKTIF";}?> </h6>
                  </div>

                </div>
          </div>
        <?php else:
          ?>
          <div class="col-11 bg-light mb-2 py-3" data-aos="fade-in" data-aos-delay="100">
                <div class="row">
                  <div class="col-12">
                    <h6><?= strtoupper($row['tempat_wisata'])?></h6>
                  </div>
                  <div class="col-6">
                    <h6>LUAS <?= rupiah($row['luas'])?> Ha</h6>
                  </div>
                  <div class="col-6">
                    <h6 style="font-size:2.5vw" class="mt-2">TINGKAT PEMANFAATAN <?php if($row['tingkat_pemanfaatan'] == 'y'){echo "AKTIF";}else{echo "TIDAK AKTIF";}?> </h6>
                  </div>

                </div>
          </div>
          <?php
        endif;
        $no++;
      endforeach;
        ?>
          
         

        </div>
        
       
                
      
        
      </div>
  </section>