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
  .form-control:disabled, .form-control[readonly] {
  		background-color: transparent;
  		border: 0;
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

          
          </div>
                  
         
        
        </div>
      </div>
        
      </div>
  </section>
  
   <section id="formTambah" class="about">
      <div class="container" data-aos="fade-up" style="padding: 0px !important;">

        <div class="section-title">
          <h5 class=""><?= $judul?></h5>
         
        
          
        </div>
          <form method="POST" action="<?= base_url('pegawai/edit_anggotakk')?>" enctype="multipart/form-data">
          <div  class="row px-2" >
           
            <div class="col-6 form-group">
             <label class="resposivelabel">NIK</label>
            
               
              <h6 class="responsivetext"><?= $rows['nik']?></h6>
            </div>
            <div class="col-6 form-group">
             <label class="resposivelabel">Nama Lengkap</label>
            
             <h6 class="responsivetext"><?= $rows['nama_lengkap']?></h6>
              
            </div>
            <div class="col-6 form-group">
             <label class="resposivelabel">Jenis Kelamin</label>
             <h6 class="responsivetext"><?= $rows['jenis_kelamin']?></h6>
               
             
            </div>
            <div class="col-6 form-group">
               <label class="resposivelabel">Agama</label>
                 <h6 class="responsivetext"><?= $rows['agama']?></h6>
            </div>
              <div class="col-6 form-group">
             <label class="resposivelabel">Tempat Lahir</label>
             <h6 class="responsivetext"><?= ucfirst($rows['tempat_lahir'])?></h6>
              
            </div>
            <div class="col-6 form-group">
             <label class="resposivelabel">Tanggal Lahir</label>
              <h6 class="responsivetext"><?= date('d/m/Y',strtotime($rows['tanggal_lahir']))?></h6>
            </div>
             <div class="col-6 form-group">
               <label class="resposivelabel">Pendidikan</label>
            
                <h6 class="responsivetext"><?= ucfirst($rows['pendidikan'])?></h6>
            </div>
            <div class="col-6 form-group">
             <label class="resposivelabel">Jenis Pekerjaan</label>
            
                  <?php foreach($pekerjaan as $pe){
                  	if($pe['id_pekerjaan'] == $rows['jenis_pekerjaan']){
                      echo " <h6 class='responsivetext'>".$pe['nama']."</h6>";
                  	}

                  }?>
             
             
            </div>
             <div class="col-6 form-group">
             <label class="resposivelabel">Status Perkawinan</label>
           
                <h6 class="responsivetext"><?= ucfirst($rows['status_perkawinan'])?></h6>
             
            </div>
            <div class="col-6 form-group">
             <label class="resposivelabel">Status Hubungan</label>
             
                 <h6 class="responsivetext"><?= ucfirst($rows['status_hubungan'])?></h6>
            </div>
            <div class="col-12 form-group">
             <label class="resposivelabel">Kewarganegaraan</label>
            <h6 class="responsivetext"><?= ucfirst($rows['kewarganegaraan'])?></h6>
               
           </div>
            <div class="col-6 form-group">
             <label class="resposivelabel">NO PASPOR</label>
             
            <?php 
            if($rows['no_paspor'] != ""){

              echo "<h6 class='responsivetext'>".ucfirst($rows['no_paspor'])."</h6>";
            }else{
                echo "<h6 class='responsivetext'>-</h6>";
            }
            ?>
            </div>
            <div class="col-6 form-group">
             <label class="resposivelabel">NO KITAS/KITAP</label>
         
                 <?php 
            if($rows['no_kitas'] != ""){

              echo "<h6 class='responsivetext'>".ucfirst($rows['no_kitas'])."</h6>";
            }else{
                echo "<h6 class='responsivetext'>-</h6>";
            }
            ?>
            </div>
             <div class="col-6 form-group">
             <label class="resposivelabel">NAMA AYAH</label>
            
               <?php 
            if($rows['ayah'] != ""){

              echo "<h6 class='responsivetext'>".ucfirst($rows['ayah'])."</h6>";
            }else{
                echo "<h6 class='responsivetext'>-</h6>";
            }
            ?>
                
            
            </div>
             <div class="col-6 form-group">
             <label class="resposivelabel">NAMA IBU</label>
            
               <?php 
            if($rows['ibu'] != ""){

              echo "<h6 class='responsivetext'>".ucfirst($rows['ibu'])."</h6>";
            }else{
                echo "<h6 class='responsivetext'>-</h6>";
            }
            ?>
                
             
            </div>
            <div class="col-12">
              <hr>
            </div>
           
           
          </div>
          </form>   
         
        
        </div>
      </div>
        
      </div>
  </section>

  <script type="text/javascript">
 		$("#btnDoEdit").hide();
 		 $("#btnUbah").click(function(){
 		 	$("#btnUbah").hide();
           $("#btnDoEdit").show();
           $("input[type=text]").removeAttr("readonly");
           $("input[type=number]").removeAttr("readonly");
           $("input[type=date]").removeAttr("readonly");
           $("select").removeAttr("disabled");
    }); 

  </script>