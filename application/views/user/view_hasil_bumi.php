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
          <?php $record = $this->model_app->view_where_ordering('hasil_bumi',array('id_sd'=>$cabang['id_sd']),'id_hb','DESC');
          $no=1;
          foreach($record->result_array() as $row):
            if($no%2 == 1):
          ?>
                      <div class="col-8 py-2  " data-aos="fade-in" data-aos-delay="100" style="background-color:#efb569 ">
                            <div class="row">
                              <div class="col-12"><h2><?= strtoupper($row['judul'])?></h2></div>
                              <div class="col-12"><img src="<?= base_url('asset/hasilbumi/').$row['gambar'] ?>" class='img-fluid lazyload'></div>
                              <div class="col-12 text-light"><p><?= $row['teks']?></p></div>
                            </div>
                          </div>
                          <div class="col-4"></div>
        <?php else:
          ?>
           <div class="col-4"></div>
        <div class="col-8 py-2  " data-aos="fade-in" data-aos-delay="100" style="background-color:#efb569 ">
                            <div class="row">
                              <div class="col-12"><h2><?= strtoupper($row['judul'])?></h2></div>
                              <div class="col-12 mb-2"><img src="<?= base_url('asset/hasilbumi/').$row['gambar'] ?>" class='img-fluid lazyload'></div>
                              <div class="col-12 text-light"><p><?= $row['teks']?></p></div>
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