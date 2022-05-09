 <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2><?= $judul ?></h2>
          <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
          
        </div>
        <form action="<?= base_url('home/add_kastem')?>" method="POST">
        <div class="row justify-content-center" >
            
            <div class="form-group col-12" >
              <label>Penyandang</label>
              <select class="form-control" name="penyandang" id="pelayanan">
                  <option></option>
                  <option value="kastem">Kastem</option>
                  <option value="putus sekolah">Anak Putus Sekolah</option>
                  <option value="disabilitas">Disabilitas</option>
                  <option value="lansia">Lansia</option>
              </select>
            </div>
            <div class="col-12 form-group">
              <label>NIK</label>
              <input type="number" name="nik" id="nik" class="form-control" required>
            </div>
            <div class="col-12 form-group">
              <label>Nama</label>
              <input type="text" name="nama" id="nama" class="form-control" required  onfocus="dataKeluarga()">
            </div>
            <div class="col-6 form-group">
              <label>Tempat Lahir</label>
              <input type="text" name="tempatlahir" id="tempatlahir" class="form-control" required onfocus="dataKeluarga()">
            </div>
            <div class="col-6 form-group">
              <label>Tanggal Lahir</label>
              <input type="date" name="tanggallahir" id="tanggallahir" class="form-control" required onfocus="dataKeluarga()">
            </div>

                  <div class="col-12 form-group" >
                    <div id="frmAgama1"></div>
                    <label>Agama</label>
                     <select class="form-control" name="agama" required="" id="agama" required>
                                    <option></option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Buddha">Buddha</option>


                       </select>
                  </div>
                  <div class="col-12 form-group" >
                    <div id="frmJK1"></div>
                    <label>Jenis Kelamin</label>
                    <select class="form-control" id="jeniskelamin" name="jeniskelamin" required>
                      <option></option>
                      <option value="Laki-laki">Laki - Laki</option>
                      <option value="Perempuan">Perempuan</option>
                      
                    </select>
                    
                  </div>
            <div class="col-12 form-group">
              <label>Pekerjaan</label>
              <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" required onfocus="dataKeluarga()">
            </div>
             <div class="col-12 form-group">
               <div id="frmPnd1"></div>
                <label>Pendidikan</label>
                <select class="form-control" name="pendidikan" id="pendidikan" required="" onfocus="dataKeluarga()">
                    <option></option>
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
            <div class="col-12 form-group">
               <div id="frmSP1"></div>
              <label>Status Perkawinan</label>
                 <select class="form-control" name="status_perkawinan" id="status_perkawinan" required="" onfocus="dataKeluarga()">
                  <option></option>
                  <option value="kawin">KAWIN</option>
                  <option value="belum kawin" >BELUM KAWIN</option>
                  <option value="cerai hidup">CERAI HIDUP</option>
                  <option value="cerai mati">CERAI MATI</option>
                 


                </select>
            </div>
            <div class="col-12 form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" id="alamat" class="form-control" required onfocus="dataKeluarga()">
            </div>
            <div class="col-12 form-group">
              <label>Provinsi</label>
              <div id="frmProv"></div>
              <select class="form-control" name="provinsi" id="prov" onchange="getkab(this)">
                <option></option>
                <?php 

                  foreach($provinsi as $prv){
                    echo "<option value='".$prv['id_prov']."'>".$prv['nama']."</option>";
                  }
                ?>
              </select>
              
            </div>
            <div class="col-12 form-group">
              <div id="frmKab"></div>
              <label>Kabupaten</label>
              <select class="form-control" name="kabupaten" id="kab" onchange="getkec(this)">
                <option></option>
              </select>
            </div>
            <div class="col-12 form-group">
              <div id="frmKec"></div>
              <label>Kecamatan</label>
              <select class="form-control" name="kecamatan" id="kec"  onchange="getkel(this)">
                <option></option>
              </select>
            </div>
            <div class="col-12 form-group">
              <div id="frmKel"></div>
              <label>Kelurahan</label>
              <select class="form-control" name="kelurahan" id="kel">
                <option></option>
              </select>
            </div>
            <div class="col-12 form-group">
              <label>Catatan</label>
              <textarea name="catatan" class="form-control" ></textarea>
            </div>
            <div class="col-12">
              <input type="submit" name="submit" value="AJUKAN" class="btn btn-primary w-100">
            </div>
        </form>     
      
        
      </div>
  </section>
<script type="text/javascript">
   function dataKeluarga(){
        var nik = $('#nik').val();
          $.ajax({
        url:"<?php echo base_url(); ?>home/get_nik",
        method:"POST",
        data:{nik:nik},
         dataType: 'json',
        success:function(data)
        {
          
          $('#nama').val(data[0].nama_lengkap);
          $('#tempatlahir').val(data[0].tempat_lahir);
          $('#tanggallahir').val(data[0].tanggal_lahir);
          $('#jeniskelamin').val(data[0].jenis_kelamin);
          $('#pekerjaan').val(data[0].nama_pekerjaan);
          $('#alamat').val(data[0].alamat);
          $('#agama').val(data[0].agama);
          $('#status').val(data[0].status_perkawinan);
          $('#prov').val(data[0].provinsi);
          $('#pendidikan').val(data[0].pendidikan);
          $('#status_perkawinan').val(data[0].status_perkawinan);


          $.ajax({
            type:"POST",
            url:"<?php echo site_url('home/ajaxLoc'); ?>",
            data:"id_kel="+data[0].kelurahan,
             dataType: 'json',
            success: function(response){
         
              $('#kab').append($('<option>', {
                  value: response[0].id_kab,
                  text: response[0].nama_kab,
                  selected:'true',
              }));
              $('#kec').append($('<option>', {
                  value: response[0].id_kec,
                  text: response[0].nama_kec,
                  selected:'true',
              }));
              $('#kel').append($('<option>', {
                  value: response[0].id_kel,
                  text: response[0].nama_kel,
                  selected:'true',
              }));
            }

          })

          $("#jeniskelamin").attr('name', 'jk');
          var jk = '<input type="hidden" name="jeniskelamin" value="'+data[0].jenis_kelamin+'">';
          $('#frmJK').html(jk);

          $("#agama").attr('name', 'agm');
          var jk = '<input type="hidden" name="agama" value="'+data[0].agama+'">';
          $('#frmAgama').html(jk);

          $("#status").attr('name', 'sts');
          var jk = '<input type="hidden" name="status" value="'+data[0].status_perkawinan+'">';
          $('#frmStatus').html(jk);

           $("#prov").attr('name', 'provvv');
          var jk = '<input type="hidden" name="provinsi" value="'+data[0].provinsi+'">';
          $('#frmProv').html(jk);

           $("#kec").attr('name', 'keccc');
          var jk = '<input type="hidden" name="kacamatan" value="'+data[0].kecamatan+'">';
          $('#frmKec').html(jk);

           $("#kab").attr('name', 'kabbbb');
          var jk = '<input type="hidden" name="kabupaten" value="'+data[0].kabupaten+'">';
          $('#frmKab').html(jk);

           $("#kel").attr('name', 'kellll');
          var jk = '<input type="hidden" name="kelurahan" value="'+data[0].kelurahan+'">';
          $('#frmKel').html(jk);




          $("#nama").prop("readonly", true);
          $("#tempatlahir").prop("readonly", true);
          $("#tanggallahir").prop("readonly", true);
          $("#jeniskelamin").prop("disabled", true);
          $("#pekerjaan").prop("readonly", true);
          $("#alamat").prop("readonly", true);
          $("#nik").prop("readonly", true);
          $("#agama").prop("disabled", true);
          $("#status").prop("disabled", true);
          $("#prov").prop("disabled", true);
          $("#kab").prop("disabled", true);
          $("#kec").prop("disabled", true);
          $("#kel").prop("disabled", true);
          $("#pendidikan").prop("disabled", true);
          $("#status_perkawinan").prop("disabled", true);
          
        
        }
      })
       }
       
</script>