
    <!-- ======= About Section ======= -->
     <section id="about" class="about" >
      <div class="container" data-aos="fade-up" >
    
    

          <div class="row justify-content-between">
            <div class="col-12">
                <div class="form-group"><h4><?= ucfirst($user['nama_lengkap'])?></h4><label>Nama Pegawai</label></div>
              </div>
              <div class="col-12">
                <div class="form-group"><h4><?= ucfirst($row['judul_report'])?></h4><label>Judul Report</label></div>
              </div>
  
              <div class="col-12">
                <div class="form-group"><h4><?= format_indo($row['date'])?></h4><label>Tanggal Report</label></div>
              </div>
                <div class="col-4">
                <div class="form-group"><h4><?= date('H:i',strtotime($row['start']))?></h4><label>Dari</label></div>
                </div>
                 <div class="col-4">
                <div class="form-group"><h4><?= date('H:i',strtotime($row['end']))?></h4><label>Sampai</label></div>
                </div>
                <div class="col-4">
                <div class="form-group"><h4><?= $row['jam_kerja']?></h4><label>Jam Kerja</label></div>
                </div>
                <div class="col-12">
                <div class="form-group"><label>Report</label><h4><?= $row['report']?></h4></div>
                </div>
                <div class="col-12">
                <div class="form-group"><label>Foto</label></div>
                </div>

               <?php
                 
                        if ($row['foto_masuk']==''){
                           ?>
                           <div class="card col-5"  style="width: 18rem;border:none">
                            <div class="form-group">
                              <label>Foto Masuk</label>
                              <img class="card-img-top" src="<?= base_url('asset/foto_report/no-image.jpg')?>" alt="Card image cap">
                              </div>
                            </div>
                           <?php
                           }else{
                           ?>
                        
                         
                             <div class="card col-5" style="width: 18rem;border:none">
                               <div class="form-group">
                              <label>Foto Masuk</label>
                              <img class="card-img-top" src="<?= $row['foto_masuk']?>" alt="Card image cap">
                            </div>
                             </div>
                          <?php }?>
                      
         
             <?php
                   
                        if ($row['foto_keluar']==''){
                           ?>
                           <div class="card col-5" style="width: 18rem;border:none">
                            <div class="form-group">
                              <label>Foto Keluar</label>
                              <img class="card-img-top" src="<?= base_url('asset/foto_report/no-image.jpg')?>" alt="Card image cap">
                              </div>
                            </div>
                           <?php
                           }else{
                           ?>
                        
                         
                             <div class="card col-5" style="width: 18rem;border:none">
                               <div class="form-group">
                              <label>Foto Keluar</label>
                              <img class="card-img-top" src="<?=$row['foto_keluar']?>" alt="Card image cap">
                            </div>
                             </div>
                          <?php }?>
                      
           
              
             
          </div>
       
    </div>
    </section>
    <!-- ======= Counts Section ======= -->
  