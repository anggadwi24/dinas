<?php 

  $prov = $this->model_app->view_where('provinsi',array('id_prov'=>$row['provinsi']))->row_array();
  $kab =$this->model_app->view_where('kabupaten',array('id_kab'=>$row['kabupaten']))->row_array();
  $kec = $this->model_app->view_where('kecamatan',array('id_kec'=>$row['kecamatan']))->row_array();
  $kel = $this->model_app->view_where('kelurahan',array('id_kel'=>$row['kelurahan']))->row_array();
?>
<style type="text/css">
  .responsivetext{
     font-size: calc(0.45em + 0.75vmin);
  }
  .resposivelabel{
     font-size: calc(0.45em + 0.5vmin);
  }
</style>
 <section id="about" class="about">
      <div class="container" data-aos="fade-up" style="padding: 10px !important;">

        <div class="section-title">
          <h5 class=""><?= $menu?></h5>
         
         
          
        </div>
       
          <div  class="row" >
            <div class="col-12 text-center"><h6>NO KK : <?= $row['no_kk']?></h6></div>

            <div class="col-4 form-group mt-3">
              <label class="resposivelabel">Kepala Keluarga</label>
              <h6 class="responsivetext"><?= $row['nama_kepala_keluarga']?></h6>
            </div>
            
            <div class="col-8 form-group mt-3 text-right">
              <label class="resposivelabel">Lokasi</label>
              <h6 class="responsivetext"><?= strtoupper($row['alamat'].' /'.$row['kode_pos'].' RT/RW'.$row['rt'].'/'.$row['rw'].'  <br>   '.$prov['nama'].'/'.$kab['nama'].'/'.$kec['nama'].'/'.$kel['nama'])?></h6>
            </div>
          <!--   <div class="col-12">
              <a href="<?= base_url('pegawai/delete_kk/').$row['no_kk'] ?>" class="text-danger float-left responsivetext">Delete Kartu Keluarga</a>
        
              <a href="<?= base_url('pegawai/edit_kk/').$row['no_kk']?>" class="float-right text-success responsivetext">Edit Kartu Keluarga</a>
            </div> -->

          
          </div>
                  
         
        
        </div>
      </div>
        
      </div>
  </section>
  <?php if($anggota->num_rows() > 0){?>
    <section id="about" class="about" style="padding: 0px !important;">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h5 class="">Anggota Keluarga</h5>
         
         
          
        </div>
       
          <div  class="row" >
          
            <?php foreach ($anggota->result_array() as $key): ?>
                <div class="col-12" onclick="detailAK('<?= $key['nik']?>','<?= $key['no_kk']?>')">
                  <div class="row">
                    <div class="col-3 form-group">
                      <label class="resposivelabel">NIK</label>
                      <h6 class="responsivetext"><?= $key['nik']?></h6>
                    </div>
                    <div class="col-6 form-group">
                      <label class="resposivelabel">Nama</label>
                      <h6 class="responsivetext"><?= strtoupper($key['nama_lengkap'])?></h6>
                    </div>
                     <div class="col-3 form-group">
                      <label class="resposivelabel">Hubungan</label>
                      <h6 class="responsivetext"><?= strtoupper($key['status_hubungan'])?></h6>
                    </div>
                  </div>
                  
                </div>
            <?php endforeach ?>
           
          </div>
                  
         
        
        </div>
      </div>
        
      </div>
  </section>
<?php }?>
   

  <script type="text/javascript">
    $(document).ready(function() {
         <?php if($anggota->num_rows() > 0){?>
            $("#formTambah").hide();
       <?php }else{?>
            $("#formTambah").show();
       <?php }?>
    $("#btnAdd").click(function(){
           $("#formTambah").toggle();
    }); 
});  

  </script>