<?php 
   $tgl1 = strtotime($row['dari']); 
   $tgl2 = strtotime($row['sampai']); 

   $jarak = $tgl2 - $tgl1;

   $hari = $jarak / 60 / 60 / 24;
?>
    <!-- ======= About Section ======= -->
     <section id="about" class="about" >
      <div class="container" data-aos="fade-up" >
        <div class="row">
        <div class="col-12">
        
        <div class="col-12 form-group">
            <label>Nama</label>
            <h6><?= $row['nama_guru']?>  </h6>
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
         
          <div class="col-6 form-group">
            <label>Dari Tanggal</label>
            <h6><?= format_indo_w($row['dari'])?></h6>
          </div>
          <div class="col-6 form-group">
            <label>Sampai Tanggal</label>
             <h6><?= format_indo_w($row['sampai'])?></h6>
          </div>
        
          <div class="col-12 form-group">
          
            <label><?= $row['keterangan']?></label>
          </div>

          <?php
          if($row['status'] == 'Sakit'){
           $ex = explode(';',$row['foto']);
           $hitungex = count($ex);

     
            for($i=0; $i<$hitungex; $i++){
              
                    if ($ex[$i]==''){
                        echo "<img style='height:120px; width:100%;  border:1px solid #cecece' src='".base_url()."asset/foto_form/no-image.jpg'>";
                    }else{
                       ?>
                         <div class="card col-12" style="width: 18rem;">
                          <img class="card-img-top" src="<?= $ex[$i]?>" alt="Card image cap">
                        </div>
                    <?php 
                    }
              
            }
            }
           ?>
         <?php if($row['approved'] != 'setuju'){?>
        <div class="col-6 text-center mt-3"><a href="<?= base_url('kepsek/approv?id=').encode('setuju/'.$row['id_form'])?>" class="btn btn-success">Setujui</a></div>
        <div class="col-6 text-center mt-3"><a href="<?= base_url('kepsek/approv?id=').encode('tolak/'.$row['id_form'])?>" class="btn btn-danger">Tolak</a></div>
        <?php }?>
        
        </div>
      </div>
    </section>
    <!-- ======= Counts Section ======= -->
