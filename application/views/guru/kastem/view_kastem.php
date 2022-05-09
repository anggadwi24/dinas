 <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h6><?= $judul ?></h3>
          <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
          
        </div>
      <form action="<?= base_url('pegawai/datakastem')?>" method="POST">
        <div class="row justify-content-center" >
           
            <div class="form-group col-12" >
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text">Penyandang</div>
              </div>
                      <select class="form-control" name="keyword" >
                          <option value="all">Semua</option>
                          <option value="kastem" <?php if($keyword == 'kastem'){echo "selected";}?>>Kastem</option>
                          <option value="putus sekolah" <?php if($keyword == 'putus sekolah'){echo "selected";}?>>Anak Putus Sekolah</option>
                          <option value="disabilitas" <?php if($keyword == 'disabilitas'){echo "selected";}?>>Disabilitas</option>
                          <option value="lansia" <?php if($keyword == 'lansia'){echo "selected";}?>>Lansia</option>

                      
                      </select>
              </div>
                      
            </div>
          
            <div class="col-12 form-group  ">

              <input type="submit" name="filter" value="FILTER" class="btn btn-primary w-100">
            </div>

        </div>
        </form>
        
        <div class="col-12">

      <?php
          $no = 1;
          foreach($record->result_array() as $row):
                  $n = $row['nik'];
                  $nik = explode("_", $n);
                  if(isset($nik[1])){

                    $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
                  }else{
                    
                    $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
                  }
       ?>
       
       <?php if($no%2 == 0){?>
       <div class="row bg-white p-2">
       <?php }else{?>
        <div class="row  bg-light p-2">
       <?php }?>
          <div class="col-1"><a href="<?= base_url('pegawai/detail_kastem/').$row['id_kastem']?>"><h6><?= $no;?>.</h6></a></div>
          <div class="col-10"><a href="<?= base_url('pegawai/detail_kastem/').$row['id_kastem']?>"><h6><?= ucfirst($war['nik'])?></h6></a></div>
          <div class="col-12"><a href="<?= base_url('pegawai/detail_kastem/').$row['id_kastem']?>"><h6><?= ucfirst($war['nama_lengkap'])?></h6></a></div>
          <div class="col-8 text-left"><a href="<?= base_url('home/detail_kastem/').$row['id_kastem']?>"><h6><?= date('Y/m/d H:i:s',strtotime($row['created_at']))?></h6></a></div>
          <div class="col-2 "><a href="<?= base_url('pegawai/approvekastem/kastem/').$row['id_kastem'].'/id_kastem'?>" class="text-success"><i class="ri-check-line"></i></a></div>
          <div class="col-2"><a href="<?= base_url('pegawai/disapprovekastem/kastem/').$row['id_kastem'].'/id_kastem'?>" class="text-danger"><i class="ri-close-line"></i></a></div>
          
          
       </div>
      
       <?php $no++; endforeach;?>
       </div>
  
</div>
                
      
        
      </div>
  </section>

