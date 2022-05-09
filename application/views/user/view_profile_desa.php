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
          <div class="col-12">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Sejarah Desa</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Pemimpin Desa</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#references" role="tab" data-toggle="tab">Wilayah</a>
                </li>
             </ul>
          </div>
          <div class="col-12 mt-3">
             <div class="tab-content">

                   <div role="tabpanel" class="tab-pane fade in show active" id="profile">
                     <div class="row">
                       <?php 
                        $sejarah = $this->model_app->view_where_ordering('sejarah_desa',array('id_sd'=>$cabang['id_sd']),'id_sejarah','DESC');
                        $no=1;
                        foreach($sejarah->result_array() as $sej){
                        ?>
                        <?php if($no%2 == 1){?>
                          <div class="col-8 py-2  " data-aos="fade-in" data-aos-delay="100" style="background-color:#efb569 ">
                            <div class="row">
                              <div class="col-12"><h2><?= $sej['judul']?></h2></div>
                              <div class="col-12 text-light"><p><?= $sej['teks']?></p></div>
                            </div>
                          </div>
                          <div class="col-4"></div>
                        <?php }else{?>
                          <div class="col-4"></div>
                          <div class="col-8 py-2" data-aos="fade-in" data-aos-delay="100" style="background-color:#efb569 ">
                            <div class="row">
                              <div class="col-12"><h2><?= $sej['judul']?></h2></div>
                              <div class="col-12 text-light"><p><?= $sej['teks']?></p></div>
                            </div>
                          </div>
                          
                        <?php }?>
                        <?php
                        $no++;
                        }
                       ?>
                     </div>
                   </div>
                  
                
               
                    <div role="tabpanel" class="tab-pane fade" id="buzz">
                      <div class="row">
                        <?php $pemimpin = $this->model_app->view_where_ordering('pemimpin_desa',array('id_sd'=>$cabang['id_sd']),'tahun_mulai','ASC');?>
                        <div class="col-12 mb-3">
                          <h3 class="text-center">DAFTAR PEMIMPIN <br> <?= strtoupper($cabang['nama_cabang'])?></h3>
                        </div>
                        <div class="col-2"><h6 class='text-center'>NO</h6></div>
                        <div class="col-5"><h6 class='text-center'>TAHUN</h6> </div>
                        <div class="col-5"><h6 class='text-center'>NAMA</h6></div>
                          <?php 
                            $no=1;
                          foreach($pemimpin->result_array() as $pem):
                            echo "<div class='col-2'><h6 class='text-center'>".$no."</h6></div>
                                  <div class='col-5'><h6 class='text-center'>".$pem['tahun_mulai']. " - ".$pem['tahun_selesai']."</h6></div>
                                  <div class='col-5'><h6 class='text-center'>".strtoupper($pem['pemimpin_desa'])."</h6></div>

                                  ";
                            $no++;
                          endforeach;
                            ?>
                      </div>
                    </div>
              
                    <div role="tabpanel" class="tab-pane fade" id="references">
                      <div class="row">
                          <div class="col-12 mb-3">
                          <h5 class="text-center">BATAS WILAYAH <br> <?= strtoupper($cabang['nama_cabang'])?></h5>
                        </div>
                        <?php $batas = $this->model_app->view_where('batas_wilayah',array('id_sd'=>$cabang['id_sd']));
                              foreach($batas->result_array() as $bat){
                                $kab = $this->model_app->view_where('kabupaten',array('id_kab'=>$bat['kabupaten']))->row_array();
                                $kec = $this->model_app->view_where('kecamatan',array('id_kec'=>$bat['kecamatan']))->row_array();
                                $kel = $this->model_app->view_where('kelurahan',array('id_kel'=>$bat['kelurahan']))->row_array();
                            ?>
                            <div class="col-12 mb-1">
                              <label>SEBELAH <?=  strtoupper($bat['batas'])?></label>
                              <h6><?= strtoupper($kab['nama'].'/'.$kec['nama'].'/'.$kel['nama'])?></h6>
                            </div>
                            <?php
                              }
                         ?>
                         <div class="col-12 mt-3">
                          <h5 class="text-center">DATA WILAYAH ADMINISTRASI <br> <?= strtoupper($cabang['nama_cabang'])?></h5>
                        </div>
                        <div class="col-12">
                          <label>KABUPATEN</label>
                          <h6><?= strtoupper($lok['kab'])?></h6>
                        </div>
                        <div class="col-12">
                          <label>KECAMATAN</label>
                          <h6><?= strtoupper($lok['kec'])?></h6>
                        </div>
                        <div class="col-12">
                          <label>KELURAHAN</label>
                          <h6><?= strtoupper($lok['kel'])?></h6>
                        </div>

                        <?php $wilayah = $this->model_app->view_where_ordering('data_wilayah',array('id_sd'=>$cabang['id_sd']),'data_per','DESC');

                          foreach($wilayah->result_array() as $wil){?>
                              <div class="col-5"><h6>JUMLAH UNIT RT</h6></div>
                              <div class="col-7"><h6><?= $wil['jumlah_rt']?> ( <?= terbilang($wil['jumlah_rt'])?> ) </h6></div>
                              <div class="col-5"><h6>JUMLAH UNIT RW</h6></div>
                              <div class="col-7"><h6><?= $wil['jumlah_rw']?> ( <?= terbilang($wil['jumlah_rw'])?> ) </h6></div>
                               <div class="col-5"><h6>JUMLAH DUSUN </h6></div>
                              <div class="col-7"><h6><?= $wil['jumlah_dusun']?> ( <?= terbilang($wil['jumlah_dusun'])?> ) </h6></div>
                               <div class="col-5"><h6>JUMLAH PENDUDUK  </h6></div>
                              <div class="col-7"><h6><?= $wil['jumlah_penduduk_pria']+$wil['jumlah_penduduk_wanita']?> JIWA </h6></div>
                              <div class="col-5"><h6>JUMLAH PENDUDUK LAKI-LAKI </h6></div>
                              <div class="col-7"><h6><?= $wil['jumlah_penduduk_pria']?> JIWA </h6></div>
                              <div class="col-5"><h6>JUMLAH PENDUDUK PEREMPUAN </h6></div>
                              <div class="col-7"><h6><?= $wil['jumlah_penduduk_wanita']?> JIWA </h6></div>
                              <div class="col-5"><h6>JUMLAH KEPALA KELUARGA </h6></div>
                              <div class="col-7"><h6><?= $wil['jumlah_kk']?> KEPALA KELUARGA </h6></div>


                          <?php } ?>
                      </div>
                    </div>
               
          




             </div>
          </div>
         

        </div>
        
       
                
      
        
      </div>
  </section>