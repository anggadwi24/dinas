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
          <?php $record = $this->db->query("SELECT *,b.jenis as nama_jenis,a.jenis as wilayah FROM luas_wilayah a JOIN jenis_luas_wilayah b ON a.id_jlw = b.id_jlw WHERE a.id_sd ='".$cabang['id_sd']."'");
          $no=1;
          foreach($record->result_array() as $row):
            if($no%2 == 0):
          ?>
          <div class="col-11 bg-white mb-2 py-3" data-aos="fade-in" data-aos-delay="100">
                <div class="row">
                  <div class="col-12">
                    <h6><?= strtoupper($row['nama_jenis'])?></h6>
                  </div>
                  <div class="col-8">
                    <h6><?= strtoupper($row['wilayah'])?> </h6>
                  </div>
                  <div class="col-4">
                    <h6>LUAS <?= rupiah($row['luas']) ?> Ha </h6>
                  </div>

                </div>
          </div>
        <?php else:
          ?>
          
         <div class="col-11 bg-light mb-2 py-3" data-aos="fade-in" data-aos-delay="100">
                <div class="row">
                  <div class="col-12">
                    <h6><?= strtoupper($row['nama_jenis'])?></h6>
                  </div>
                  <div class="col-8">
                    <h6><?= strtoupper($row['wilayah'])?> </h6>
                  </div>
                  <div class="col-4">
                    <h6>LUAS <?= rupiah($row['luas']) ?> Ha </h6>
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