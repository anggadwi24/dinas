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
            <div class="col-12 mt-5 mb-5">
              <center><button class="btn btn-primary " id="btnAdd">TAMBAH ANGGOTA KELUARGA</button></center>
            </div>
          </div>
                  
         
        
        </div>
      </div>
        
      </div>
  </section>
<?php }?>
   <section id="formTambah" class="about">
      <div class="container" data-aos="fade-up" style="padding: 0px !important;">

        <div class="section-title">
          <h5 class=""><?= $judul?></h5>
         
          <div class="row justify-content-center">
            <div class="col-11 form-group ">
              <form class="form-inline float-right" action="<?= base_url('pegawai/detail_kk/').$row['no_kk']?>" method="get">
              <div class="row">
                <div class="col-8">
                <input type="number" name="inp" value="<?= $inp?>" class="form-control mr-2">
                </div>
                <div class="col-2">
                <button class="btn btn-secondary">TAMBAH</button>
                </div>
              </div>
              </form>
            </div>
            
          </div>
          
        </div>
          <form method="POST" action="<?= base_url('pegawai/add_anggotakk')?>" enctype="multipart/form-data">
          <div  class="row px-2" >
            <?php for($a=0;$a<$inp;$a++){ ?>
            <div class="col-6 form-group">
             <label>NIK</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <input type="number" class="form-control" name="nik[]" placeholder=""  required="">
              </div>
            </div>
            <div class="col-6 form-group">
             <label>Nama Lengkap</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <input type="text" class="form-control" name="nama_lengkap[]" placeholder=""  required="">
              </div>
            </div>
            <div class="col-6 form-group">
             <label>Jenis Kelamin</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <select class="form-control" name="jenis_kelamin[]" required="">
                  <option value="Laki-laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="col-6 form-group">
             <label>Agama</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <select class="form-control" name="agama[]" required="">
                  <option value="Islam">Islam</option>
                  <option value="Kristen">Kristen</option>
                  <option value="Katolik">Katolik</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Konghucu">Konghucu</option>
                  <option value="Buddha">Buddha</option>


                </select>
              </div>
            </div>
              <div class="col-6 form-group">
             <label>Tempat Lahir</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <input type="text" class="form-control" name="tempat_lahir[]" placeholder=""  required="">
              </div>
            </div>
            <div class="col-6 form-group">
             <label>Tanggal Lahir</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <input type="date" class="form-control" name="tanggal_lahir[]" placeholder=""  required="">
              </div>
            </div>
             <div class="col-6 form-group">
             <label>Pendidikan</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <select class="form-control" name="pendidikan[]" required="">
                  <option value="TAMAT SD / SEDERAJAT">TAMAT SD / SEDERAJAT</option>
                  <option value="SLTP/SEDERAJAT">SLTP/SEDERAJAT</option>
                  <option value="TIDAK / BELUM SEKOLAH">TIDAK / BELUM SEKOLAH</option>
                  <option value="SLTA / SEDERAJAT">SLTA / SEDERAJAT</option>
                  <option value="BELUM TAMAT SD/SEDERAJAT">BELUM TAMAT SD/SEDERAJAT</option>
                  <option value="DIPLOMA IV/ STRATA I">DIPLOMA IV/ STRATA I</option>
                  <option value="AKADEMI/ DIPLOMA III/S. MUD">AKADEMI/ DIPLOMA III/S. MUDA</option>
                  <option value="DIPLOMA I / II">DIPLOMA I / II</option>
                  <option value="STRATA II">STRATA II</option>
                  <option value="STRATA III">STRATA III</option>


                </select>
              </div>
            </div>
            <div class="col-6 form-group">
             <label>Jenis Pekerjaan</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <select name="jenis_pekerjaan[]" class="form-control" required="">
                  <option>   Pilih    </option>
                  <?php foreach($pekerjaan as $pe){
                      echo " <option value='".$pe['id_pekerjaan']."'>".$pe['nama']."</option>";

                  }?>
                </select>
              </div>
            </div>
             <div class="col-6 form-group">
             <label>Status Perkawinan</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <select class="form-control" name="status_perkawinan[]" required="">
                  <option value="kawin">KAWIN</option>
                  <option value="belum kawin" selected>BELUM KAWIN</option>
                  <option value="cerai hidup">CERAI HIDUP</option>
                  <option value="cerai mati">CERAI MATI</option>
                 


                </select>
              </div>
            </div>
            <div class="col-6 form-group">
             <label>Status Hubungan</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <select class="form-control" name="status_hubungan[]" required="">
                  <option >   PILIH   </option>
                  <option value="kepala keluarga">KEPALA KELUARGA</option>
                  <option value="suami" >SUAMI</option>
                  <option value="istri">ISTRI </option>
                  <option value="anak">ANAK</option>
                  <option value="menantu">MENANTU</option>
                  <option value="cucu">CUCU</option>
                  <option value="orang tua">ORANG TUA</option>
                  <option value="mertua">MERTUA</option>
                  <option value="famili lain">FAMILI LAIN</option>
                  <option value="pembantu">PEMBANTU</option>
                  <option value="lainnya">LAINNYA</option>

                 


                </select>
              </div>
            </div>
            <div class="col-12 form-group">
             <label>Kewarganegaraan</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <select class="form-control" name="kewarganegaraan[]" required>
                
                  <option value="wni" >WNI</option>
                  <option value="wna">WNA </option>
                  
                 


                </select>
              </div>
            </div>
            <div class="col-6 form-group">
             <label>NO PASPOR</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <input type="number" class="form-control" name="no_paspor[]" placeholder="" >
                
              </div>
              <small class="text-danger">*Kosongkan jika tidak ada</small>
            </div>
            <div class="col-6 form-group">
             <label>NO KITAS/KITAP</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <input type="number" class="form-control" name="no_kitas[]" placeholder=""  >
               
              </div>
               <small class="text-danger">*Kosongkan jika tidak ada</small>
            </div>
             <div class="col-6 form-group">
             <label>NAMA AYAH</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <input type="text" class="form-control" name="ayah[]" placeholder="" >
                
              </div>
            </div>
             <div class="col-6 form-group">
             <label>NAMA IBU</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <input type="text" class="form-control" name="ibu[]" placeholder="" >
                
              </div>
            </div>
            <div class="col-12">
              <hr>
            </div>
            <?php }?>
            <div class="col-12">
              <input type="hidden" name="no_kk" value="<?= $row['no_kk']?>">
              <input type="submit" name="submit" value="SIMPAN" class="btn btn-primary float-right">
            </div>
          </div>
          </form>   
         
        
        </div>
      </div>
        
      </div>
  </section>

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