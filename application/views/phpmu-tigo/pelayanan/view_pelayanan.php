 <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h6><?= $judul ?></h3>
          <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
          
        </div>
     
        <div class="row justify-content-center" >
           
            <div class="form-group col-6" >
              <label>Bidang</label>
              <select class="form-control" name="pelayanan" id="pelayanan">
                  <option></option>
                <?php foreach ($pelayanan as $row): ?>
                  <option value="<?= $row['id_pelayanan']?>"> <?= $row['pelayanan']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div id="sub_pel" class="form-group col-6">
              

            </div>
            <div class="col-12 form-group mt-3 ">

              <button class="btn btn-primary w-100 mt-3" id="btnPelayanan">PILIH</button>
            </div>

        </div>
        
        <div class="mt-3" id="dataPelayanan">
          

        </div>
                
      
        
      </div>
  </section>
 <script type="text/javascript">

      
        function getkab(sel){
          
          var id_prov = sel.value;
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('home/kabupaten'); ?>",
            data:"id_prov="+id_prov,
            success: function(response){
              $('#kab').html(response);
            }
          })
        }
       function getkec(sel){
          var id_kab = sel.value;
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('home/kecamatan'); ?>",
            data:"id_kab="+id_kab,
            success: function(response){
              $('#kec').html(response);
            }
          })
        }
        function getkel(sel){
          var id_kec = sel.value;
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('home/kelurahan'); ?>",
            data:"id_kec="+id_kec,
            success: function(response){
              $('#kel').html(response);
            }
          })
        }

         function getkab1(sel){
          
          var id_prov = sel.value;
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('home/kabupaten'); ?>",
            data:"id_prov="+id_prov,
            success: function(response){
              $('#kab1').html(response);
            }
          })
        }
       function getkec1(sel){
          var id_kab = sel.value;
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('home/kecamatan'); ?>",
            data:"id_kab="+id_kab,
            success: function(response){
              $('#kec1').html(response);
            }
          })
        }
        function getkel1(sel){
          var id_kec = sel.value;
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('home/kelurahan'); ?>",
            data:"id_kec="+id_kec,
            success: function(response){
              $('#kel1').html(response);
            }
          })
        }
     

  </script>
  <script type="text/javascript">
       $("#btnPelayanan").on('click',function(){
          var link = $('#sub_pelayanan').val();
          var status = $('#status_pel').val();
          if(status == 1){
           $.get(link, function(data){

              $("#dataPelayanan").html(data);
          
          });  
         }else if(status == 0){
              Swal.fire({

            title: 'Peringatan',
            text: 'Pelayanan Tidak Ditemukan',
             customClass: 'swal-wide',
             type:'error',
            
          })
         }
       });
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
          
        
        }
      })
       }
       function dataAnggota(){
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
         


          $("#nama").prop("readonly", true);
          $("#tempatlahir").prop("readonly", true);
          $("#tanggallahir").prop("readonly", true);
          $("#jeniskelamin").prop("readonly", true);
          $("#pekerjaan").prop("readonly", true);
          $("#alamat").prop("readonly", true);
          $("#nik").prop("readonly", true);
          $("#agama").prop("readonly", true);
          
        
        }
      })
       }

       function dataAnggota2(){
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
          $('#status_hubungan').val(data[0].status_hubungan);
          $('#pendidikan').val(data[0].pendidikan);
          
          $("#jeniskelamin").attr('name', 'jk');
          var jk = '<input type="hidden" name="jeniskelamin" value="'+data[0].jenis_kelamin+'">';
          $('#frmJK').html(jk);

          $("#agama").attr('name', 'agm');
          var jk = '<input type="hidden" name="agama" value="'+data[0].agama+'">';
          $('#frmAgama').html(jk);

          $("#status").attr('name', 'sts');
          var jk = '<input type="hidden" name="status" value="'+data[0].status_perkawinan+'">';
          $('#frmStatus').html(jk);




          $("#nama").prop("readonly", true);
          $("#tempatlahir").prop("readonly", true);
          $("#tanggallahir").prop("readonly", true);
          $("#jeniskelamin").prop("disabled", true);
          $("#pekerjaan").prop("readonly", true);
          $("#alamat").prop("readonly", true);
          $("#nik").prop("readonly", true);
          $("#agama").prop("disabled", true);
          $("#status").prop("disabled", true);
          $("#status_hubungan").prop("disabled", true);
          $("#pendidikan").prop("disabled", true);
          
        
        }
      })
       }

        function dataAnggotaA(){
        var nik = $('#nik_ayah').val();
          $.ajax({
        url:"<?php echo base_url(); ?>home/get_nik",
        method:"POST",
        data:{nik:nik},
         dataType: 'json',
        success:function(data)
        {
          
          $('#nama_ayah').val(data[0].nama_lengkap);
          $('#tempatlahir_ayah').val(data[0].tempat_lahir);
          $('#tanggallahir_ayah').val(data[0].tanggal_lahir);
          $('#jeniskelamin_ayah').val(data[0].jenis_kelamin);
          $('#pekerjaan_ayah').val(data[0].nama_pekerjaan);
          $('#alamat_ayah').val(data[0].alamat);
          $('#agama_ayah').val(data[0].agama);
         

          $("#jeniskelamin_ayah").attr('name', 'jk1');
          var jk = '<input type="hidden" name="jeniskelamin_ayah" value="'+data[0].jenis_kelamin+'">';
          $('#frmJK1').html(jk);

          $("#agama_ayah").attr('name', 'agm');
          var jk = '<input type="hidden" name="agama_ayah" value="'+data[0].agama+'">';
          $('#frmAgama1').html(jk);

         




          $("#nama_ayah").prop("readonly", true);
          $("#tempatlahir_ayah").prop("readonly", true);
          $("#tanggallahir_ayah").prop("readonly", true);
          $("#jeniskelamin_ayah").prop("disabled", true);
          $("#pekerjaan_ayah").prop("readonly", true);
          $("#alamat_ayah").prop("readonly", true);
          $("#nik_ayah").prop("readonly", true);
          $("#agama_ayah").prop("disabled", true);
         
          
        
        }
      })
       }
       function dataAnggotaNew(){
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
         

          $("#jeniskelamin").attr('name', 'jk1');
          var jk = '<input type="hidden" name="jeniskelamin" value="'+data[0].jenis_kelamin+'">';
          $('#frmJK1').html(jk);

          $("#agama").attr('name', 'agm');
          var jk = '<input type="hidden" name="agama" value="'+data[0].agama+'">';
          $('#frmAgama1').html(jk);

         




          $("#nama").prop("readonly", true);
          $("#tempatlahir").prop("readonly", true);
          $("#tanggallahir").prop("readonly", true);
          $("#jeniskelamin").prop("disabled", true);
          $("#pekerjaan").prop("readonly", true);
          $("#alamat").prop("readonly", true);
          $("#nik").prop("readonly", true);
          $("#agama").prop("disabled", true);
         
          
        
        }
      })
       }
       function dataAnggotaNew1(){
        var nik = $('#nik1').val();
          $.ajax({
        url:"<?php echo base_url(); ?>home/get_nik",
        method:"POST",
        data:{nik:nik},
         dataType: 'json',
        success:function(data)
        {
          
          $('#nama1').val(data[0].nama_lengkap);
          $('#tempatlahir1').val(data[0].tempat_lahir);
          $('#tanggallahir1').val(data[0].tanggal_lahir);
          $('#jeniskelamin1').val(data[0].jenis_kelamin);
          $('#pekerjaan1').val(data[0].nama_pekerjaan);
          $('#alamat1').val(data[0].alamat);
          $('#agama1').val(data[0].agama);
          $('#status_hubungan').val(data[0].status_hubungan);
         

          $("#jeniskelamin1").attr('name', 'jk1');
          var jk = '<input type="hidden" name="jeniskelamin1" value="'+data[0].jenis_kelamin+'">';
          $('#frmJK2').html(jk);

          $("#agama1").attr('name', 'agm');
          var jk = '<input type="hidden" name="agama1" value="'+data[0].agama+'">';
          $('#frmAgama2').html(jk);

         




          $("#nama1").prop("readonly", true);
          $("#tempatlahir1").prop("readonly", true);
          $("#tanggallahir1").prop("readonly", true);
          $("#jeniskelamin1").prop("disabled", true);
          $("#pekerjaan1").prop("readonly", true);
          $("#alamat1").prop("readonly", true);
          $("#nik1").prop("readonly", true);
          $("#agama1").prop("disabled", true);
          $("#status_hubungan").prop("disabled", true);
         
          
        
        }
      })
       }
       function dataAnggotaI(){
        var nik = $('#nik_ibu').val();
          $.ajax({
        url:"<?php echo base_url(); ?>home/get_nik",
        method:"POST",
        data:{nik:nik},
         dataType: 'json',
        success:function(data)
        {
          
          $('#nama_ibu').val(data[0].nama_lengkap);
          $('#tempatlahir_ibu').val(data[0].tempat_lahir);
          $('#tanggallahir_ibu').val(data[0].tanggal_lahir);
          $('#jeniskelamin_ibu').val(data[0].jenis_kelamin);
          $('#pekerjaan_ibu').val(data[0].nama_pekerjaan);
          $('#alamat_ibu').val(data[0].alamat);
          $('#agama_ibu').val(data[0].agama);
         

          $("#jeniskelamin_ibu").attr('name', 'jk1');
          var jk = '<input type="hidden" name="jeniskelamin_ibu" value="'+data[0].jenis_kelamin+'">';
          $('#frmJK2').html(jk);

          $("#agama_ibu").attr('name', 'agm');
          var jk = '<input type="hidden" name="agama_ibu" value="'+data[0].agama+'">';
          $('#frmAgama2').html(jk);

         




          $("#nama_ibu").prop("readonly", true);
          $("#tempatlahir_ibu").prop("readonly", true);
          $("#tanggallahir_ibu").prop("readonly", true);
          $("#jeniskelamin_ibu").prop("disabled", true);
          $("#pekerjaan_ibu").prop("readonly", true);
          $("#alamat_ibu").prop("readonly", true);
          $("#nik_ibu").prop("readonly", true);
          $("#agama_ibu").prop("disabled", true);
         
          
        
        }
      })
       }
       function dataAnggotaW(){
        var nik = $('#nik_wali').val();
          $.ajax({
        url:"<?php echo base_url(); ?>home/get_nik",
        method:"POST",
        data:{nik:nik},
         dataType: 'json',
        success:function(data)
        {
          
          $('#nama_wali').val(data[0].nama_lengkap);
          $('#tempatlahir_wali').val(data[0].tempat_lahir);
          $('#tanggallahir_wali').val(data[0].tanggal_lahir);
          $('#jeniskelamin_wali').val(data[0].jenis_kelamin);
          $('#pekerjaan_wali').val(data[0].nama_pekerjaan);
          $('#alamat_wali').val(data[0].alamat);
          $('#agama_wali').val(data[0].agama);
         

          $("#jeniskelamin_wali").attr('name', 'jk1');
          var jk = '<input type="hidden" name="jeniskelamin_wali" value="'+data[0].jenis_kelamin+'">';
          $('#frmJK3').html(jk);

          $("#agama_wali").attr('name', 'agm');
          var jk = '<input type="hidden" name="agama_wali" value="'+data[0].agama+'">';
          $('#frmAgama3').html(jk);

         




          $("#nama_wali").prop("readonly", true);
          $("#tempatlahir_wali").prop("readonly", true);
          $("#tanggallahir_wali").prop("readonly", true);
          $("#jeniskelamin_wali").prop("disabled", true);
          $("#pekerjaan_wali").prop("readonly", true);
          $("#alamat_wali").prop("readonly", true);
          $("#nik_wali").prop("readonly", true);
          $("#agama_wali").prop("disabled", true);
         
          
        
        }
      })
       }
       function dataAnggotaC(){
        var nik = $('#nik_c').val();
          $.ajax({
        url:"<?php echo base_url(); ?>home/get_nik",
        method:"POST",
        data:{nik:nik},
         dataType: 'json',
        success:function(data)
        {
          
          $('#nama_c').val(data[0].nama_lengkap);
          $('#tempatlahir_c').val(data[0].tempat_lahir);
          $('#tanggallahir_c').val(data[0].tanggal_lahir);
          $('#jeniskelamin_c').val(data[0].jenis_kelamin);
          $('#pekerjaan_c').val(data[0].nama_pekerjaan);
          $('#alamat_c').val(data[0].alamat);
          $('#agama_c').val(data[0].agama);
          $('#status_c').val(data[0].status_perkawinan);
         

          $("#jeniskelamin_c").attr('name', 'jk1');
          var jk = '<input type="hidden" name="jeniskelamin_c" value="'+data[0].jenis_kelamin+'">';
          $('#frmJK3').html(jk);

          $("#agama_c").attr('name', 'agm');
          var jk = '<input type="hidden" name="agama_c" value="'+data[0].agama+'">';
          $('#frmAgama3').html(jk);
           $("#status_c").attr('name', 'sts');
          var jk = '<input type="hidden" name="status_c" value="'+data[0].status_perkawinan+'">';
          $('#frmStatus3').html(jk);

         




          $("#nama_c").prop("readonly", true);
          $("#tempatlahir_c").prop("readonly", true);
          $("#tanggallahir_c").prop("readonly", true);
          $("#jeniskelamin_c").prop("disabled", true);
          $("#pekerjaan_c").prop("readonly", true);
          $("#alamat_c").prop("readonly", true);
          $("#nik_c").prop("readonly", true);
          $("#agama_c").prop("disabled", true);
          $('#status_c').prop("disabled", true);
         
          
        
        }
      })
       }
        function dataAnggota1(){
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


         


          $("#nama").prop("readonly", true);
          $("#tempatlahir").prop("readonly", true);
          $("#tanggallahir").prop("readonly", true);
          $("#jeniskelamin").prop("readonly", true);
          $("#pekerjaan").prop("readonly", true);
          $("#alamat").prop("readonly", true);
          $("#nik").prop("readonly", true);
          $("#agama").prop("readonly", true);

           $.ajax({
            url:"<?php echo base_url(); ?>home/get_usaha",
            method:"POST",
            data:{nik:nik},
            dataType: 'json',
            success:function(data)
            {

                if( data != 0 ){
                   $("#nama_usaha1").hide();
                   $("#kep").hide();
                   $("#JenUs").hide();
                   $("#AlUs").hide();
                   $("#tglBer").hide();
                   $("#tglBerh").hide();
                   $("#btnUs").hide();
                  $("#nama_usaha1").attr('name', 'nama_usahaw');
                  var html = "";
                   html += '<label>Pilih Usaha</label><select class="form-control" name="id_usaha" id="selUsaha" onchange="getComboA(this)" ><option></option>';
                  var i;
                   for(i=0;i < data.length ; i++){
                      html += '<option value="'+data[i].id_usaha+'">'+data[i].nama_usaha+'</option>';
                   }
                  html += "</select>";
                  $("#usaha").html(html);
                }else{

                }
              
              

            }

          })
          
          }
      })
       }

       function getComboA(selectObject) {
          var id = selectObject.value;  
           $.ajax({
            url:"<?php echo base_url(); ?>home/detailUsaha",
            method:"POST",
            data:{id:id},
            dataType: 'json',
            success:function(data)
            {
              $("#JenUs").show();
              $("#AlUs").show();
              $("#tglBer").show();
              $("#tglBerh").show();
              $("#btnUs").show();

              $('#jenis_usaha1').val(data[0].jenis_usaha);
              $('#alamat_usaha1').val(data[0].alamat_usaha);
              $('#tanggal_berdiri1').val(data[0].tanggal_berdiri);

              $("#jenis_usaha1").prop("readonly", true);
              $("#alamat_usaha1").prop("readonly", true);
              $("#tanggal_berdiri1").prop("readonly", true);

            }
          })
        }

        function waliPernikahan(e){
           
          
            if(e.value == 'wali'){
                var html = '<div class="col-12"><h6>Wali Pernikahan  :</h6></div><div class="col-12 form-group"><label>NIK</label><input type="number" name="nik_wali" id="nik_wali" class="form-control" required></div><div class="col-12 form-group"><label>Nama</label><input type="text" name="nama_wali" id="nama_wali" class="form-control" required  onfocus="dataAnggotaW()"></div><div class="col-12 form-group"><label>Tempat Lahir</label>  <input type="text" name="tempatlahir_wali" id="tempatlahir_wali" class="form-control" required onfocus="dataAnggotaW()"></div><div class="col-12 form-group"><label>Tanggal Lahir</label><input type="date" name="tanggallahir_wali" id="tanggallahir_wali" class="form-control" required onfocus="dataAnggotaW()"></div><div class="col-12 form-group" ><div id="frmAgama4"></div><label>Agama</label><select class="form-control" name="agama_wali" required="" id="agama_wali"><option value="Islam">Islam</option><option value="Kristen">Kristen</option><option value="Katolik">Katolik</option><option value="Hindu">Hindu</option><option value="Konghucu">Konghucu</option><option value="Buddha">Buddha</option></select></div><div class="col-12 form-group" ><div id="frmJK4"></div><label>Jenis Kelamin</label><select class="form-control" id="jeniskelamin_wali" name="jeniskelamin_wali"><option value="Laki-laki">Laki - Laki</option><option value="Perempuan">Perempuan</option></select></div><div class="col-12 form-group"><label>Pekerjaan</label><input type="text" name="pekerjaan_wali" id="pekerjaan_wali" class="form-control" required onfocus="dataAnggotaW()"></div><div class="col-12 form-group"><label>Alamat</label><input type="text" name="alamat_wali" id="alamat_wali" class="form-control" required onfocus="dataAnggotaW()"></div>';
                $('#dataIzin').html(html);
            }

        }

        function addAnggota(){
          $('#btnAdd').hide();
          var html = '<div class="col-6"><h6>Tambah Anggota Keluarga : </h6></div><div class="col-6"><div class="form-inline float-right"><div class="form-group mx-sm-3 mb-2"><label for="inputPassword2" class="sr-only">Password</label><input type="number" class="form-control" id="jumlah" value="1"></div><span  class="btn btn-primary mb-2" id="sbmTot">TAMBAH</span></div></div>';
          $('#dataTambah').html(html);
        }
     
  </script>
  <script >
$(document).ready(function() {
    $('#example').DataTable();
} );
  </script>
