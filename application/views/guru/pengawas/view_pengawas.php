
 <?php if($status == 'dinas'){ ?>
 <section id="about" class="about">
 
  <?php if($jabatan == 'admin'){?>
    <?php $bag = $this->model_app->view_where('bagian',array('id_sd'=>$id_sd));
    ?>
      <div class="container" >
         <form action="<?= base_url('pengawas/pegawai') ?>" method="post" onsubmit="$('#loader').show();">
        <div class="row">
         
        <div class="col-4 " data-aos="fade-left">
          <select class="form-control" name="bagian" id="bagian">
            <option value="all">All</option>
          <?php foreach($bag->result_array() as $div){?>
                  <?php if($div[id_bagian] == $bagian){?>
                   <option value="<?= $div[id_bagian]?>" selected><?= ucfirst($div['nama_bagian'])?></option>
                      <?php }else{?>
                    <option value="<?= $div[id_bagian]?>"><?= ucfirst($div['nama_bagian'])?></option>
                      <?php }?>
           <?php }?>
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
        <div class="col-2" data-aos="fade-right">
          <input type="submit" name="submit" class="btn btn-warning text-light" value="Cari">
        </div>
       
        </div>
 </form>
      </div>
  <?php }else{
      if($this->session->sub_bagian == 0){
        $sub_bag = $this->model_app->view_where('sub_bagian',array('id_bagian'=>$this->session->bagian));
      ?>
      <div class="container" >
         <form action="<?= base_url('pengawas/pegawai') ?>" method="post" onsubmit="$('#loader').show();">
        <div class="row">
       
        <div class="col-8 " data-aos="fade-left">
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
           
            <div class="row">
           
            <div class="col-12 text-center" data-aos="fade-up">
             <h5><?= $sub_bag['nama_sub_bagian']?></h5>
            </div>
         
           
            </div>
    
          </div>

  <?php
      }
    } ?>
  </section>
  <?php 
       $hadir = 0;
       $telat = 0;
       $pulang = 0;
       $sakit = 0;
       $izin =0;
      
       $pegawai = $peg->num_rows();
    foreach($peg->result_array() as $row){
      $tanggal = date('Y-m-d');
     
      $abs = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_pegawai] AND tanggal = '$tanggal'");
      if($abs->num_rows() > 0)
      {
        $hadir +=1;
       
      }else
      {
       
        $hadir +=0;
      }
     


      $absen = $abs->row_array();
      if($absen['telat'] =='y'){
        $telat +=1;
      }else{
        $telat +=0;
      }
       if($absen['pulang_awal'] =='y'){
        $pulang +=1;
      }else{
        $pulang +=0;
      }
      $s = $this->db->query("SELECT * FROM form_izin WHERE id_pegawai = $row[id_pegawai] AND status ='Sakit' AND sampai >= '$tanggal'")->num_rows();
      $sakit += $s;
      $i = $this->db->query("SELECT * FROM form_izin WHERE id_pegawai = $row[id_pegawai] AND status ='Izin' AND sampai >= '$tanggal'")->num_rows();
      $izin += $i;
  }  
  $belum = $pegawai - $hadir;
  ?>
 <section id="about" class="about" style="padding: 0px !important">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Data Pegawai</h2>
          <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
          <ul class="nav nav-tabs justify-content-center" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" href="#grafik" role="tab" data-toggle="tab">Grafik</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#lembur" role="tab" data-toggle="tab">Lembur</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#form" role="tab" data-toggle="tab">Form / Ijin Sakit</a>
          </li>
        </ul>
        </div>
        <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in show  active" id="grafik">
        <div class="col-12 mb-5">
          <canvas id="bar-chart" width="auto" height="auto"></canvas>
        </div>
        <div class="row">
          <div class="col-6 mb-2"><b>Total Pegawai</b></div>
          <div class="col-2 mb-2"><b><?= $pegawai?></b></div>
          <div class="col-4 mb-2"><b>Pegawai</b></div>


          <div class="col-6" data-toggle="collapse" href="#hadir" role="button" aria-expanded="false" aria-controls="hadir"><span style="background-color:#3e95cd " class="px-1" >&nbsp; &nbsp;</span> Hadir</div>
          <div class="col-2"  data-toggle="collapse" href="#hadir" role="button" aria-expanded="false" aria-controls="hadir"><?= $hadir?></div>
          <div class="col-4"  data-toggle="collapse" href="#hadir" role="button" aria-expanded="false" aria-controls="hadir">Pegawai</div>
          <div class="col-12">
            <div class="collapse" id="hadir">
                  <div class="card card-body  my-3">
                    <ul>
                      <?php 
                       foreach($peg->result_array() as $row){
                         $tanggal = date('Y-m-d');
     
                          $abs = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_pegawai] AND tanggal = '$tanggal'");
                          $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$row['sub_bagian']))->row_array();
                         $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$row['bagian']))->row_array();
                          if($abs->num_rows()>0){
                            echo "<li>".$row['nama_lengkap']." ( " .$bag['nama_bagian']." -  " .$sub['nama_sub_bagian']. ")" ."</li>";
                          }
                        }
                      ?>
                   
                    </ul>
                  </div>
                </div>
            </div>
          <div class="col-6"  data-toggle="collapse" href="#tidakhadir" role="button" aria-expanded="false" aria-controls="tidakhadir"><span style="background-color:#8e5ea2 " class="px-1" >&nbsp; &nbsp;</span> Belum Hadir</div>
          <div class="col-2"  data-toggle="collapse" href="#tidakhadir" role="button" aria-expanded="false" aria-controls="tidakhadir"><?= $belum?></div>
          <div class="col-4"  data-toggle="collapse" href="#tidakhadir" role="button" aria-expanded="false" aria-controls="tidakhadir">Pegawai</div>
           <div class="col-12">
            <div class="collapse" id="tidakhadir">
                  <div class="card card-body  my-3">
                    <ul>
                      <?php 
                       foreach($peg->result_array() as $row){
                         $tanggal = date('Y-m-d');
     
                          $abs = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_pegawai] AND tanggal = '$tanggal'");
                          $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$row['sub_bagian']))->row_array();
                         $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$row['bagian']))->row_array();
                          if($abs->num_rows()<=0){
                            echo "<li>".$row['nama_lengkap']." ( " .$bag['nama_bagian']." -  " .$sub['nama_sub_bagian']. ")" ."</li>";
                          }
                        }
                      ?>
                   
                    </ul>
                  </div>
                </div>
            </div>
          <div class="col-6" data-toggle="collapse" href="#sakit" role="button" aria-expanded="false" aria-controls="sakit"><span style="background-color:#3cba9f " class="px-1" >&nbsp; &nbsp;</span> Sakit</div>
          <div class="col-2" data-toggle="collapse" href="#sakit" role="button" aria-expanded="false" aria-controls="sakit"><?= $sakit?></div>
          <div class="col-4" data-toggle="collapse" href="#sakit" role="button" aria-expanded="false" aria-controls="sakit">Pegawai</div>
          <div class="col-12">
            <div class="collapse" id="sakit">
                  <div class="card card-body  my-3">
                    <ul>
                      <?php 
                       foreach($peg->result_array() as $row){
                         $tanggal = date('Y-m-d');
     
                          $abs =$this->db->query("SELECT * FROM form_izin WHERE id_pegawai = $row[id_pegawai] AND status ='Sakit' AND sampai >= '$tanggal'");
                          $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$row['sub_bagian']))->row_array();
                         $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$row['bagian']))->row_array();
                          if($abs->num_rows()>0){
                            echo "<li>".$row['nama_lengkap']." ( " .$bag['nama_bagian']." -  " .$sub['nama_sub_bagian']. ")" ."</li>";
                          }
                        }
                      ?>
                   
                    </ul>
                  </div>
                </div>
            </div>
          <div class="col-6" data-toggle="collapse" href="#ijin" role="button" aria-expanded="false" aria-controls="ijin"><span style="background-color:#e8c3b9 " class="px-1" >&nbsp; &nbsp;</span> Ijin</div>
          <div class="col-2" data-toggle="collapse" href="#ijin" role="button" aria-expanded="false" aria-controls="ijin"><?= $izin?></div>
          <div class="col-4" data-toggle="collapse" href="#ijin" role="button" aria-expanded="false" aria-controls="ijin">Pegawai</div>
             <div class="col-12">
            <div class="collapse" id="ijin">
                  <div class="card card-body  my-3">
                    <ul>
                      <?php 
                       foreach($peg->result_array() as $row){
                         $tanggal = date('Y-m-d');
     
                          $abs =$this->db->query("SELECT * FROM form_izin WHERE id_pegawai = $row[id_pegawai] AND status ='Izin' AND sampai >= '$tanggal'");
                          $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$row['sub_bagian']))->row_array();
                         $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$row['bagian']))->row_array();
                          if($abs->num_rows()>0){
                            echo "<li>".$row['nama_lengkap']." ( " .$bag['nama_bagian']." -  " .$sub['nama_sub_bagian']. ")" ."</li>";
                          }
                        }
                      ?>
                   
                    </ul>
                  </div>
                </div>
            </div>
          <div class="col-6" data-toggle="collapse" href="#terlambat" role="button" aria-expanded="false" aria-controls="terlambat"><span style="background-color:#c45850 " class="px-1" >&nbsp; &nbsp;</span> Terlambat</div>
          <div class="col-2" data-toggle="collapse" href="#terlambat" role="button" aria-expanded="false" aria-controls="terlambat"><?= $telat?></div>
          <div class="col-4" data-toggle="collapse" href="#terlambat" role="button" aria-expanded="false" aria-controls="terlambat">Pegawai</div>
           <div class="col-12">
            <div class="collapse" id="terlambat">
                  <div class="card card-body  my-3">
                    <ul>
                      <?php 
                       foreach($peg->result_array() as $row){
                         $tanggal = date('Y-m-d');
     
                          $abs = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_pegawai] AND tanggal = '$tanggal' AND telat='y' ");
                          $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$row['sub_bagian']))->row_array();
                         $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$row['bagian']))->row_array();
                          if($abs->num_rows()>0){
                            echo "<li>".$row['nama_lengkap']." ( " .$bag['nama_bagian']." -  " .$sub['nama_sub_bagian']. ")" ."</li>";
                          }
                        }
                      ?>
                   
                    </ul>
                  </div>
                </div>
            </div>

          <div class="col-6"  data-toggle="collapse" href="#pulang" role="button" aria-expanded="false" aria-controls="pulang"><span style="background-color:#faae49 " class="px-1" >&nbsp; &nbsp;</span> Pulang Cepat</div>
          <div class="col-2" data-toggle="collapse" href="#pulang" role="button" aria-expanded="false" aria-controls="pulang"><?= $pulang?></div>
          <div class="col-4" data-toggle="collapse" href="#pulang" role="button" aria-expanded="false" aria-controls="pulang">Pegawai</div>
            <div class="col-12">
            <div class="collapse" id="pulang">
                  <div class="card card-body  my-3">
                    <ul>
                      <?php 
                       foreach($peg->result_array() as $row){
                         $tanggal = date('Y-m-d');
     
                          $abs = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_pegawai] AND tanggal = '$tanggal' AND pulang_awal='y' ");
                          $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$row['sub_bagian']))->row_array();
                         $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$row['bagian']))->row_array();
                          if($abs->num_rows()>0){
                            echo "<li>".$row['nama_lengkap']." ( " .$bag['nama_bagian']." -  " .$sub['nama_sub_bagian']. ")" ."</li>";
                          }
                        }
                      ?>
                   
                    </ul>
                  </div>
                </div>
            </div>
            
        </div>
      </div>
      <div role="tabpanel" class="tab-pane fade" id="lembur">
        <div class="row">
          <div class="col-12">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              Tambah Surat Kerja
            </button>
          </div>
          <div class="col-12 mt-3">
            <div class="collapse" id="collapseExample">
            <div class="card card-body">
              <form action="<?= base_url('pengawas/add_lembur')?>" method="POST">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
              <div class="form-group">
                <label>Pegawai</label>
                <select name="id_pegawai[]" class="form-control "   multiple id="choices-multiple-remove-button" placeholder="Maximal 30 Pegawai">

                    <?php 
                        foreach($peg->result_array() as $peg){
                          $date = date('Y-m-d');
                          $cek_abs = $this->model_app->view_where('absensi',array('id_pegawai'=>$peg['id_pegawai'],'tanggal'=>$date))->num_rows();
                          if($cek_abs > 0){
                            echo "<option value='".$peg['id_pegawai'].'-'.$peg['no_hp'].'-'.$peg['sub_bagian'].'-'.$peg['nama_lengkap']."'>".$peg['nama_lengkap']."</option>";
                          }
                        }
                    ?>
                </select>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" id="ckeditor" rows="6" name="keterangan" required></textarea>
              </div>
              <div class="form-group"><button class="btn btn-primary float-right">SUBMIT</button></div>
              </form>
            </div>
          </div>
          </div>
          <div class="col-12">
             <div id="load_data1" >

            
        </div>
                
        <div id="load_data_message1" ></div>
        </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane fade" id="form">
          <div id="load_data" class="row" >

            
        </div>
                
        <div id="load_data_message" class="text-center"></div>
        
      </div>

        </div>
        
      </div>
      <style type="text/css">
        .card-body i{
          color: #B56C0D;
        }
      </style>
      <div class=" justify-content-between d-flex mx-3 mt-5" style="overflow: auto;">
        <?php if($status == 'kelurahan'){?>
           <div class="p-2" >
              <a href="<?= base_url('pengawas/approveADD')?>">
                 <div class="card" style="width:10rem">
                  <div class="card-body text-center">
                    <i class="ri-checkbox-line" style="font-size: 30px;"></i>
                     <h6 style="font-size:3vw">APPROVE ALOKASI </h6>
                  </div>
                 
                </div>
              </a>
          </div>
         <div class="p-2">
              <a href="<?= base_url('pengawas/alokasiDanaDesa')?>">
                 <div class="card" style="width:9rem">
                  <div class="card-body text-center">
                    <i class="ri-earth-line" style="font-size: 30px;"></i>
                     <h6 style="font-size:3vw">ALOKASI DANA</h6>
                  </div>
                 
                </div>
              </a>
          </div>
        <?php }?>
          <div class="p-2">
              <a href="<?= base_url('pengawas/peringkat')?>">
                 <div class="card">
                  <div class="card-body text-center">
                    <i class="ri-trophy-line" style="font-size: 30px;"></i>
                     <h6 style="font-size:3vw">PERINGKAT</h6>
                  </div>
                 
                </div>
              </a>
          </div>
          <div class="p-2">
              <a href="<?= base_url('pengawas/report')?>">
                 <div class="card">
                  <div class="card-body text-center">
                   <i class="ri-file-chart-line" style="font-size: 30px;"></i>
                     <h6 style="font-size:3vw">REPORT</h6>
                  </div>
                 
                </div>
              </a>
          </div>
          <div class="p-2">
              <a href="<?= base_url('pengawas/logout')?>">
                 <div class="card">
                  <div class="card-body text-center">
                   <i class="ri-logout-box-r-line" style="font-size: 30px;"></i>
                     <h6 style="font-size:3vw">LOGOUT</h6>
                  </div>
                 
                </div>
              </a>
          </div>
   
      </div> 
      <div class="col-12 mt-3">
             
            </div>
     
  </section>
<?php }else{?>
  <section id="about" class="about">
    <div class="container">
      <form method="POST" action="<?= base_url('pengawas/pegawai')?>"  onsubmit="$('#loader').show();">

      <div class="row">
          <div class="col-10">
                        <label class="sr-only" for="inlineFormInputGroup">Pulang</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                          <div class="input-group-text">Desa</div>
                            </div>
                          <select name="cabang" class="form-control"  id="subkegiatan1">
                              
                                   <?php if($status == 'all' OR $status == 'dinas' OR $status == 'pusat'){
                                    echo "  <option value='all'>Semua</option>";

                                     $subdomain = $this->model_app->view_ordering('subdomain','nama_cabang','ASC');
                                    }else if($status == 'kabupaten'){
                                        echo "  <option value='all'>Semua</option>";
                                     $subdomain = $this->db->query("SELECT * FROM subdomain WHERE kabupaten = '".$kabupaten."' AND (status = 'kelurahan' OR status = 'kecamatan' OR status ='kabupaten' )")->result_array();
                                    }else if($status == 'kecamatan'){
                                         echo "  <option value='all'>Semua</option>";
                                         $subdomain = $this->db->query("SELECT * FROM subdomain WHERE kecamatan = '".$kecamatan."' AND (status = 'kelurahan' OR status ='kecamatan')")->result_array();
                                    }else if($status == 'kelurahan'){
                                         $subdomain = $this->db->query("SELECT * FROM subdomain WHERE kelurahan = '".$kelurahan."' AND status = 'kelurahan' ")->result_array();
                                    }
        
           
                                     foreach ($subdomain as $sd) {
                                                if ($sd['id_sd']==$cabang){
                                                echo "<option value='$sd[id_sd]' selected>$sd[nama_cabang]</option>";
                                                 }else{
                                                 echo "<option value='$sd[id_sd]'>$sd[nama_cabang]</option>";
                                                 }
                                          }

                                          ?>
                            </select>
                          </div>
                     </div>
                     <div class="col-2">
                       <button class="btn btn-primary w-100">CARI</button>
                     </div>
      </div>
    </form>
    </div>
  </section>
  <?php if(isset($cabang)){?>
   <section id="about" class="about">
 
  <?php if($jabatan == 'admin'){?>
    <?php $bag = $this->model_app->view_where('bagian',array('id_sd'=>$cabang));
    ?>
      <div class="container" >
         <form action="<?= base_url('pengawas/pegawai') ?>" method="post" onsubmit="$('#loader').show();">
           <input type="hidden" name="cabang" value="<?= $cabang?>">
        <div class="row">
         
        <div class="col-4 " data-aos="fade-left">
          <select class="form-control" name="bagian" id="bagian">
            <option value="all">All</option>
          <?php foreach($bag->result_array() as $div){?>
                  <?php if($div[id_bagian] == $bagian){?>
                   <option value="<?= $div[id_bagian]?>" selected><?= ucfirst($div['nama_bagian'])?></option>
                      <?php }else{?>
                    <option value="<?= $div[id_bagian]?>"><?= ucfirst($div['nama_bagian'])?></option>
                      <?php }?>
           <?php }?>
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
        <div class="col-2" data-aos="fade-right">
          <input type="submit" name="submit" class="btn btn-warning text-light" value="Cari">
        </div>
       
        </div>
 </form>
      </div>
  <?php }else{
      if($this->session->sub_bagian == 0){
        $sub_bag = $this->model_app->view_where('sub_bagian',array('id_bagian'=>$this->session->bagian));
      ?>
      <div class="container" >
         <form action="<?= base_url('pengawas/pegawai') ?>" method="post" onsubmit="$('#loader').show();">
        <div class="row">
       
        <div class="col-8 " data-aos="fade-left">
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
           
            <div class="row">
           
            <div class="col-12 text-center" data-aos="fade-up">
             <h5><?= $sub_bag['nama_sub_bagian']?></h5>
            </div>
         
           
            </div>
    
          </div>

  <?php
      }
    } ?>
  </section>
  <?php 
       $hadir = 0;
       $telat = 0;
       $pulang = 0;
       $sakit = 0;
       $izin =0;
      
       $pegawai = $peg->num_rows();
    foreach($peg->result_array() as $row){
      $tanggal = date('Y-m-d');
     
      $abs = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_pegawai] AND tanggal = '$tanggal'");
      if($abs->num_rows() > 0)
      {
        $hadir +=1;
       
      }else
      {
       
        $hadir +=0;
      }
     


      $absen = $abs->row_array();
      if($absen['telat'] =='y'){
        $telat +=1;
      }else{
        $telat +=0;
      }
       if($absen['pulang_awal'] =='y'){
        $pulang +=1;
      }else{
        $pulang +=0;
      }
      $s = $this->db->query("SELECT * FROM form_izin WHERE id_pegawai = $row[id_pegawai] AND status ='Sakit' AND sampai >= '$tanggal'")->num_rows();
      $sakit += $s;
      $i = $this->db->query("SELECT * FROM form_izin WHERE id_pegawai = $row[id_pegawai] AND status ='Izin' AND sampai >= '$tanggal'")->num_rows();
      $izin += $i;
  }  
  $belum = $pegawai - $hadir;
  ?>
 <section id="about" class="about" style="padding: 0px !important">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Data Pegawai</h2>
          <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
          <ul class="nav nav-tabs justify-content-center" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" href="#grafik" role="tab" data-toggle="tab">Grafik</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#lembur" role="tab" data-toggle="tab">Lembur</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#form" role="tab" data-toggle="tab">Form / Ijin Sakit</a>
          </li>
        </ul>
        </div>
        <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in show  active" id="grafik">
        <div class="col-12 mb-5">
          <canvas id="bar-chart" width="auto" height="auto"></canvas>
        </div>
        <div class="row">
          <div class="col-6 mb-2"><b>Total Pegawai</b></div>
          <div class="col-2 mb-2"><b><?= $pegawai?></b></div>
          <div class="col-4 mb-2"><b>Pegawai</b></div>


          <div class="col-6" data-toggle="collapse" href="#hadir" role="button" aria-expanded="false" aria-controls="hadir"><span style="background-color:#3e95cd " class="px-1" >&nbsp; &nbsp;</span> Hadir</div>
          <div class="col-2"  data-toggle="collapse" href="#hadir" role="button" aria-expanded="false" aria-controls="hadir"><?= $hadir?></div>
          <div class="col-4"  data-toggle="collapse" href="#hadir" role="button" aria-expanded="false" aria-controls="hadir">Pegawai</div>
          <div class="col-12">
            <div class="collapse" id="hadir">
                  <div class="card card-body  my-3">
                    <ul>
                      <?php 
                       foreach($peg->result_array() as $row){
                         $tanggal = date('Y-m-d');
     
                          $abs = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_pegawai] AND tanggal = '$tanggal'");
                          $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$row['sub_bagian']))->row_array();
                         $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$row['bagian']))->row_array();
                          if($abs->num_rows()>0){
                            echo "<li>".$row['nama_lengkap']." ( " .$bag['nama_bagian']." -  " .$sub['nama_sub_bagian']. ")" ."</li>";
                          }
                        }
                      ?>
                   
                    </ul>
                  </div>
                </div>
            </div>
          <div class="col-6"  data-toggle="collapse" href="#tidakhadir" role="button" aria-expanded="false" aria-controls="tidakhadir"><span style="background-color:#8e5ea2 " class="px-1" >&nbsp; &nbsp;</span> Belum Hadir</div>
          <div class="col-2"  data-toggle="collapse" href="#tidakhadir" role="button" aria-expanded="false" aria-controls="tidakhadir"><?= $belum?></div>
          <div class="col-4"  data-toggle="collapse" href="#tidakhadir" role="button" aria-expanded="false" aria-controls="tidakhadir">Pegawai</div>
           <div class="col-12">
            <div class="collapse" id="tidakhadir">
                  <div class="card card-body  my-3">
                    <ul>
                      <?php 
                       foreach($peg->result_array() as $row){
                         $tanggal = date('Y-m-d');
     
                          $abs = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_pegawai] AND tanggal = '$tanggal'");
                          $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$row['sub_bagian']))->row_array();
                         $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$row['bagian']))->row_array();
                          if($abs->num_rows()<=0){
                            echo "<li>".$row['nama_lengkap']." ( " .$bag['nama_bagian']." -  " .$sub['nama_sub_bagian']. ")" ."</li>";
                          }
                        }
                      ?>
                   
                    </ul>
                  </div>
                </div>
            </div>
          <div class="col-6" data-toggle="collapse" href="#sakit" role="button" aria-expanded="false" aria-controls="sakit"><span style="background-color:#3cba9f " class="px-1" >&nbsp; &nbsp;</span> Sakit</div>
          <div class="col-2" data-toggle="collapse" href="#sakit" role="button" aria-expanded="false" aria-controls="sakit"><?= $sakit?></div>
          <div class="col-4" data-toggle="collapse" href="#sakit" role="button" aria-expanded="false" aria-controls="sakit">Pegawai</div>
          <div class="col-12">
            <div class="collapse" id="sakit">
                  <div class="card card-body  my-3">
                    <ul>
                      <?php 
                       foreach($peg->result_array() as $row){
                         $tanggal = date('Y-m-d');
     
                          $abs =$this->db->query("SELECT * FROM form_izin WHERE id_pegawai = $row[id_pegawai] AND status ='Sakit' AND sampai >= '$tanggal'");
                          $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$row['sub_bagian']))->row_array();
                         $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$row['bagian']))->row_array();
                          if($abs->num_rows()>0){
                            echo "<li>".$row['nama_lengkap']." ( " .$bag['nama_bagian']." -  " .$sub['nama_sub_bagian']. ")" ."</li>";
                          }
                        }
                      ?>
                   
                    </ul>
                  </div>
                </div>
            </div>
          <div class="col-6" data-toggle="collapse" href="#ijin" role="button" aria-expanded="false" aria-controls="ijin"><span style="background-color:#e8c3b9 " class="px-1" >&nbsp; &nbsp;</span> Ijin</div>
          <div class="col-2" data-toggle="collapse" href="#ijin" role="button" aria-expanded="false" aria-controls="ijin"><?= $izin?></div>
          <div class="col-4" data-toggle="collapse" href="#ijin" role="button" aria-expanded="false" aria-controls="ijin">Pegawai</div>
             <div class="col-12">
            <div class="collapse" id="ijin">
                  <div class="card card-body  my-3">
                    <ul>
                      <?php 
                       foreach($peg->result_array() as $row){
                         $tanggal = date('Y-m-d');
     
                          $abs =$this->db->query("SELECT * FROM form_izin WHERE id_pegawai = $row[id_pegawai] AND status ='Izin' AND sampai >= '$tanggal'");
                          $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$row['sub_bagian']))->row_array();
                         $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$row['bagian']))->row_array();
                          if($abs->num_rows()>0){
                            echo "<li>".$row['nama_lengkap']." ( " .$bag['nama_bagian']." -  " .$sub['nama_sub_bagian']. ")" ."</li>";
                          }
                        }
                      ?>
                   
                    </ul>
                  </div>
                </div>
            </div>
          <div class="col-6" data-toggle="collapse" href="#terlambat" role="button" aria-expanded="false" aria-controls="terlambat"><span style="background-color:#c45850 " class="px-1" >&nbsp; &nbsp;</span> Terlambat</div>
          <div class="col-2" data-toggle="collapse" href="#terlambat" role="button" aria-expanded="false" aria-controls="terlambat"><?= $telat?></div>
          <div class="col-4" data-toggle="collapse" href="#terlambat" role="button" aria-expanded="false" aria-controls="terlambat">Pegawai</div>
           <div class="col-12">
            <div class="collapse" id="terlambat">
                  <div class="card card-body  my-3">
                    <ul>
                      <?php 
                       foreach($peg->result_array() as $row){
                         $tanggal = date('Y-m-d');
     
                          $abs = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_pegawai] AND tanggal = '$tanggal' AND telat='y' ");
                          $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$row['sub_bagian']))->row_array();
                         $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$row['bagian']))->row_array();
                          if($abs->num_rows()>0){
                            echo "<li>".$row['nama_lengkap']." ( " .$bag['nama_bagian']." -  " .$sub['nama_sub_bagian']. ")" ."</li>";
                          }
                        }
                      ?>
                   
                    </ul>
                  </div>
                </div>
            </div>

          <div class="col-6"  data-toggle="collapse" href="#pulang" role="button" aria-expanded="false" aria-controls="pulang"><span style="background-color:#faae49 " class="px-1" >&nbsp; &nbsp;</span> Pulang Cepat</div>
          <div class="col-2" data-toggle="collapse" href="#pulang" role="button" aria-expanded="false" aria-controls="pulang"><?= $pulang?></div>
          <div class="col-4" data-toggle="collapse" href="#pulang" role="button" aria-expanded="false" aria-controls="pulang">Pegawai</div>
            <div class="col-12">
            <div class="collapse" id="pulang">
                  <div class="card card-body  my-3">
                    <ul>
                      <?php 
                       foreach($peg->result_array() as $row){
                         $tanggal = date('Y-m-d');
     
                          $abs = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_pegawai] AND tanggal = '$tanggal' AND pulang_awal='y' ");
                          $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$row['sub_bagian']))->row_array();
                         $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$row['bagian']))->row_array();
                          if($abs->num_rows()>0){
                            echo "<li>".$row['nama_lengkap']." ( " .$bag['nama_bagian']." -  " .$sub['nama_sub_bagian']. ")" ."</li>";
                          }
                        }
                      ?>
                   
                    </ul>
                  </div>
                </div>
            </div>
            
        </div>
      </div>
      <div role="tabpanel" class="tab-pane fade" id="lembur">
        <div class="row">
          <div class="col-12">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              Tambah Surat Kerja
            </button>
          </div>
          <div class="col-12 mt-3">
            <div class="collapse" id="collapseExample">
            <div class="card card-body">
              <form action="<?= base_url('pengawas/add_lembur')?>" method="POST">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
              <div class="form-group">
                <label>Pegawai</label>
                <select name="id_pegawai[]" class="form-control "   multiple id="choices-multiple-remove-button" placeholder="Maximal 30 Pegawai">

                    <?php 
                        foreach($peg->result_array() as $peg){
                          $date = date('Y-m-d');
                          $cek_abs = $this->model_app->view_where('absensi',array('id_pegawai'=>$peg['id_pegawai'],'tanggal'=>$date))->num_rows();
                          if($cek_abs > 0){
                            echo "<option value='".$peg['id_pegawai'].'-'.$peg['no_hp'].'-'.$peg['sub_bagian'].'-'.$peg['nama_lengkap']."'>".$peg['nama_lengkap']."</option>";
                          }
                        }
                    ?>
                </select>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" id="ckeditor" rows="6" name="keterangan" required></textarea>
              </div>
              <div class="form-group"><button class="btn btn-primary float-right">SUBMIT</button></div>
              </form>
            </div>
          </div>
          </div>
          <div class="col-12">
             <div id="load_data1" >

            
        </div>
                
        <div id="load_data_message1" ></div>
        </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane fade" id="form">
          <div id="load_data" class="row" >

            
        </div>
                
        <div id="load_data_message" class="text-center"></div>
        
      </div>

        </div>
        
      </div>
      <div class=" justify-content-between d-flex mx-3 mt-5">
        <div class="p-4 border border-primary   "><center><a href="<?= base_url('pengawas/peringkat')?>"><i class="ri-trophy-line" style="font-size: 30px;"></i><label class="d-block text-primary" >Peringkat</label></a></center></div>
        <div class="p-4 border border-primary  "><center><a href="<?= base_url('pengawas/report')?>"><i class="ri-file-chart-line" style="font-size: 30px;"></i><label class="d-block text-primary">Report</label></a></center></div>
        <div class="p-4 border border-primary "><center><a href="<?= base_url('pengawas/logout')?>"><i class="ri-logout-box-r-line" style="font-size: 30px;"></i><label class="d-block text-primary">Logout</label></a></center></div>
      </div> 
      <div class="col-12 mt-3">
             
            </div>
     
  </section>
         
         <?php }?>             
<?php }?>
<script type="text/javascript">
  new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: ["Hadir", "Belum Absen", "Sakit", "Izin", "Terlambat", "Pulang Cepat"],
      datasets: [
        {
          label: "Pegawai (orang)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#faae49"],
          data: [<?= $hadir?>,<?=$belum?>,<?= $sakit ?>,<?= $izin ?>,<?= $telat?>,<?= $pulang?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Grafik Absensi Hari <?= hari_ini(date('w'))?>'
      }
    }
});
</script>
<script>
  $(document).ready(function(){

    var limit = 7;
    var start = 0;
    var bagian = '<?= $bagian?>';
    var sub_bagian = '<?= $sub_bagian?>';
  

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

    function load_data(limit, start,bagian,sub_bagian)
    {
       
      $.ajax({
        url:"<?php echo base_url(); ?>pengawas/fetch_form",
        method:"POST",
        data:{limit:limit, start:start,bagian:bagian,sub_bagian:sub_bagian},
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
          load_data(limit, start,bagian,sub_bagian);
    
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
        lazzy_loader(limit);
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_data(limit, start,bagian,sub_bagian);
        }, 1000);
      }
    });


     var limit1 = 7;
    var start1 = 0;
   
  

    var action1 = 'inactive';

    function lazzy_loader1(limit1)
    {
      var output1 = '';
      for(var count=0; count<limit1; count++)
      {
        output1 += '<div class="post_data">';
        output1 += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output1 += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output1 += '</div>';
      }
      $('#load_data_message1').html(output1);
    }

    lazzy_loader1(limit1);

    function load_data1(limit1, start1)
    {
       
      $.ajax({
        url:"<?php echo base_url(); ?>pengawas/fetch_lembur",
        method:"POST",
        data:{limit1:limit1, start1:start1},
        cache: false,
        success:function(data)
        {

          if(data == '')
          {
            $('#load_data_message1').html('');
            action1 = 'active';
          }
          else
          {
            $('#load_data1').append(data);
            $('#load_data_message1').html("");
            action1 = 'inactive';
          }
        }
      })
    }

    if(action1 == 'inactive')
    {
      action1 = 'active';
          load_data1(limit1, start1);
    
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data1").height() && action1 == 'inactive')
      {
        lazzy_loader1(limit1);
        action1 = 'active';
        start1 = start1 + limit1;
        
        setTimeout(function(){
          load_data1(limit1, start1);
        }, 1000);
      }
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){

var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
removeItemButton: true,
maxItemCount:30,
searchResultLimit:30,
renderChoiceLimit:30
});


});
</script>

