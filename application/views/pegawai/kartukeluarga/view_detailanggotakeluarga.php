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
             <label>NIK</label>
            
                <input type="number" class="form-control" name="nik321" placeholder=""  required="" disabled value="<?= $rows['nik']?>">
           
            </div>
            <div class="col-6 form-group">
             <label>Nama Lengkap</label>
            
                <input type="text" class="form-control" name="nama_lengkap" placeholder=""  required="" readonly value="<?= $rows['nama_lengkap']?>">
              
            </div>
            <div class="col-6 form-group">
             <label>Jenis Kelamin</label>
             
                <select class="form-control" name="jenis_kelamin" required="" disabled>
                  <option value="Laki-laki" <?php if($rows['jenis_kelamin'] == 'Laki-Laki'){echo "selected";}?>>Laki-Laki</option>
                  <option value="Perempuan" <?php if($rows['jenis_kelamin'] == 'Perempuan'){echo "selected";}?>>Perempuan</option>
                </select>
             
            </div>
            <div class="col-6 form-group">
             <label>Agama</label>
             
                <select class="form-control" name="agama" required="" disabled>
                  <option value="Islam" <?php if($rows['agama'] == 'Islam'){echo "selected";}?> >Islam</option>
                  <option value="Kristen" <?php if($rows['agama'] == 'Kristen'){echo "selected";}?>>Kristen</option>
                  <option value="Katolik" <?php if($rows['agama'] == 'Katolik'){echo "selected";}?>>Katolik</option>
                  <option value="Hindu" <?php if($rows['agama'] == 'Hindu'){echo "selected";}?>>Hindu</option>
                  <option value="Konghucu" <?php if($rows['agama'] == 'Konghucu'){echo "selected";}?>>Konghucu</option>
                  <option value="Buddha" <?php if($rows['agama'] == 'Buddha'){echo "selected";}?>>Buddha</option>


                </select>
             
            </div>
              <div class="col-6 form-group">
             <label>Tempat Lahir</label>
             
                <input type="text" class="form-control" name="tempat_lahir" placeholder="" readonly required="" value="<?= $rows['tempat_lahir']?>">
              
            </div>
            <div class="col-6 form-group">
             <label>Tanggal Lahir</label>
             
                <input type="date" class="form-control" name="tanggal_lahir" placeholder=""  required="" value="<?= date('Y-m-d',strtotime($rows['tanggal_lahir']))?>" readonly="">
            
            </div>
             <div class="col-6 form-group">
             <label>Pendidikan</label>
          
             
                <select class="form-control" name="pendidikan" required="" disabled>
                  <option value="TAMAT SD / SEDERAJAT" <?php if($rows['pendidikan'] == 'TAMAT SD / SEDERAJAT'){echo "selected";}?> >TAMAT SD / SEDERAJAT</option>
                  <option value="SLTP/SEDERAJAT" <?php if($rows['pendidikan'] == 'SLTP/SEDERAJAT'){echo "selected";}?> > SLTP/SEDERAJAT</option>
                  <option value="TIDAK / BELUM SEKOLAH" <?php if($rows['pendidikan'] == 'TIDAK / BELUM SEKOLAH'){echo "selected";}?> >TIDAK / BELUM SEKOLAH</option>
                  <option value="SLTA / SEDERAJAT" <?php if($rows['pendidikan'] == 'SLTA / SEDERAJAT'){echo "selected";}?> >SLTA / SEDERAJAT</option>
                  <option value="BELUM TAMAT SD/SEDERAJAT" <?php if($rows['pendidikan'] == 'BELUM TAMAT SD/SEDERAJAT'){echo "selected";}?> >BELUM TAMAT SD/SEDERAJAT</option>
                  <option value="DIPLOMA IV/ STRATA I" <?php if($rows['pendidikan'] == 'DIPLOMA IV/ STRATA I'){echo "selected";}?> >DIPLOMA IV/ STRATA I</option>
                  <option value="AKADEMI/ DIPLOMA III/S. MUD" <?php if($rows['pendidikan'] == 'AKADEMI/ DIPLOMA III/S. MUD'){echo "selected";}?> >AKADEMI/ DIPLOMA III/S. MUDA</option>
                  <option value="DIPLOMA I / II" <?php if($rows['pendidikan'] == 'DIPLOMA I / II'){echo "selected";}?> >DIPLOMA I / II</option>
                  <option value="STRATA II" <?php if($rows['pendidikan'] == 'STRATA II'){echo "selected";}?>>STRATA II</option>
                  <option value="STRATA III" <?php if($rows['pendidikan'] == 'STRATA III'){echo "selected";}?> >STRATA III</option>


                </select>
             
            </div>
            <div class="col-6 form-group">
             <label>Jenis Pekerjaan</label>
            
                <select name="jenis_pekerjaan" disabled class="form-control" required="">
                  <option>   Pilih    </option>
                  <?php foreach($pekerjaan as $pe){
                  	if($pe['id_pekerjaan'] == $rows['jenis_pekerjaan']){
                      echo " <option value='".$pe['id_pekerjaan']."' selected>".$pe['nama']."</option>";
                  	}else{
                  		 echo " <option value='".$pe['id_pekerjaan']."' >".$pe['nama']."</option>";
                  	}

                  }?>
                </select>
             
            </div>
             <div class="col-6 form-group">
             <label>Status Perkawinan</label>
           
                <select class="form-control" name="status_perkawinan" disabled required="">
                  <option value="kawin" <?php if($rows['status_perkawinan'] == "kawin"){echo "selected";}?> >KAWIN</option>
                  <option value="belum kawin" <?php if($rows['status_perkawinan'] == "belum kawin"){echo "selected";}?> > BELUM KAWIN</option>
                  <option value="cerai hidup" <?php if($rows['status_perkawinan'] == "cerai hidup"){echo "selected";}?> > CERAI HIDUP</option>
                  <option value="cerai mati" <?php if($rows['status_perkawinan'] == "cerai mati"){echo "selected";}?> > CERAI MATI</option>
                 


                </select>
             
            </div>
            <div class="col-6 form-group">
             <label>Status Hubungan</label>
             
                <select class="form-control" name="status_hubungan" required="" required disabled>
                  <option >   PILIH   </option>
                  <option value="kepala keluarga" <?php if($rows['status_hubungan'] == "kepala keluarga"){echo "selected";}?>>KEPALA KELUARGA</option>
                  <option value="suami" <?php if($rows['status_hubungan'] == "suami"){echo "selected";}?>>SUAMI</option>
                  <option value="istri" <?php if($rows['status_hubungan'] == "istri"){echo "selected";}?>>ISTRI </option>
                  <option value="anak" <?php if($rows['status_hubungan'] == "anak"){echo "selected";}?>>ANAK</option>
                  <option value="menantu" <?php if($rows['status_hubungan'] == "menantu"){echo "selected";}?>>MENANTU</option>
                  <option value="cucu" <?php if($rows['status_hubungan'] == "cucu"){echo "selected";}?> >CUCU</option>
                  <option value="orang tua" <?php if($rows['status_hubungan'] == "orang tua"){echo "selected";}?>>ORANG TUA</option>
                  <option value="mertua" <?php if($rows['status_hubungan'] == "mertua"){echo "selected";}?>>MERTUA</option>
                  <option value="famili lain" <?php if($rows['status_hubungan'] == "famili lain"){echo "selected";}?>>FAMILI LAIN</option>
                  <option value="pembantu" <?php if($rows['status_hubungan'] == "pembantu"){echo "selected";}?>>PEMBANTU</option>
                  <option value="lainnya" <?php if($rows['status_hubungan'] == "lainnya"){echo "selected";}?>>LAINNYA</option>

                 


                </select>
            </div>
            <div class="col-12 form-group">
             <label>Kewarganegaraan</label>
            
                <select class="form-control" name="kewarganegaraan" required disabled>
                
                  <option value="wni" <?php if($rows['kewarganegaraan'] == 'wni'){echo "selected";}?> >WNI</option>
                  <option value="wna" <?php if($rows['kewarganegaraan'] == 'wna'){echo "selected";}?>>WNA </option>
                  
                 


                </select>
                         </div>
            <div class="col-6 form-group">
             <label>NO PASPOR</label>
             
                <input type="number" class="form-control" name="no_paspor" value="<?= $rows['no_paspor']?>" placeholder="" readonly>
                
              
              <small class="text-danger">*Kosongkan jika tidak ada</small>
            </div>
            <div class="col-6 form-group">
             <label>NO KITAS/KITAP</label>
         
                <input type="number" class="form-control" name="no_kitas" value="<?= $rows['no_kitas']?>" placeholder=""  readonly>
               
              
               <small class="text-danger">*Kosongkan jika tidak ada</small>
            </div>
             <div class="col-6 form-group">
             <label>NAMA AYAH</label>
            
                <input type="text" class="form-control" name="ayah" placeholder="" value="<?= $rows['ayah']?>" readonly >
                
            
            </div>
             <div class="col-6 form-group">
             <label>NAMA IBU</label>
            
                <input type="text" class="form-control" name="ibu" placeholder="" value="<?= $rows['ibu']?>" readonly>
                
             
            </div>
            <div class="col-12">
              <hr>
            </div>
           
            <div class="col-12">
              <input type="hidden" name="no_kk" value="<?= $row['no_kk']?>">
              <input type="hidden" name="nik" value="<?= $rows['nik']?>">
              <div class="row">
              	
              	<div class="col-6">
              		<a href="<?= base_url('pegawai/delete_nik/').$rows['nik'].'/'.$rows['no_kk']?>" class="btn btn-danger">HAPUS</a>
              	</div>
              	<div class="col-6">
              		 <span class="btn btn-primary float-right " id="btnUbah">UBAH</span>
              		 <input type="submit" name="submit" value="UPDATE" id="btnDoEdit" class="btn btn-primary float-right">
              	</div>
              </div>
             
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