<p class="mb-4"><a href="<?= base_url('administrator/guru')?>" class="btn btn-primary">Kembali</a></p>
<input type="hidden" id="id" value="<?= encode($row['id_guru'])?>">
<div class="row">
    <div class="col-lg-6 col-xs-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Guru</h5>
            </div>
            <div class="card-body">
            <form id="formProfile">
                <?php if($status == 'dinas'){?>
                <div class="form-group">
                    <label for="">Sekolah</label>
                    <select name="cabang" id="cabang" class="form-control select2">
                         <?php 
                                   

                                     $subdomain = $this->model_app->view_where_ordering('subdomain',array('status'=>'sekolah'),'nama_cabang','ASC');
                                    
           
                                     foreach ($subdomain->result_array() as $sd) {
                                               
                                                 echo "<option value='".encode($sd[id_sd])."'>$sd[nama_cabang]</option>";
                                                 
                                          }

                                          ?>
                    </select>
                </div>
                <?php }else{?>
                    <input type="hidden" name="cabang" value="<?= encode($cabang)?>">
                <?php }?>
                <div class="form-group">
                    <label for="">Nama Guru</label>
                    <input type="text" class="form-control" name="nama_guru" required value="<?= $row['nama_guru']?>">
                </div>
                <div class="form-group">
                    <label for="">NIK</label>
                    <input type="number" class="form-control" name="nik" required value="<?= $row['nik'] ?>">
                </div>
                <div class="form-group">
                    <label for="">No. KK</label>
                    <input type="number" class="form-control" name="no_kk" value="<?= $row['no_kk']?>" >
                </div>
                <div class="form-group">
                    <label for="">NIP</label>
                    <input type="number" class="form-control" name="nip" required value="<?= $row['nip']?>">
                </div>
                <div class="form-group">
                    <label for="">NUPTK</label>
                    <input type="number" class="form-control" name="nuptk" required value="<?= $row['nuptk'] ?>">
                </div>
               
                <div class="form-group">
                    <label for="">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jk"  class="form-control" required>
                        <option disabled selected></option>
                        <option value="male">Pria</option>
                        <option value="female">Wanita</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" required value="<?= $row['tempat_lahir'] ?>">
                    </div>
                    <div class="col-6 form-group">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" required value="<?= $row['tanggal_lahir'] ?>">
                    </div>

                    <div class="col-6 form-group">
                        <label for="">Status Kepegawaian</label>
                        <input type="text" class="form-control" name="status_kepegawaian" required value="<?= $row['status_kepegawaian']?>">
                    </div>
                    <div class="col-6 form-group">
                        <label for="">Jenis PTK</label>
                        <input type="text" class="form-control" name="jenis_ptk" required value="<?= $row['jenis_ptk'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Agama</label>
                    <select class="form-control" name="agama" id="agama" required>
                         <option disabled selected></option>
                                          
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="katolik">Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="buddha">Buddha</option>
                           <option value="konghucu">Konhucu</option>

                    </select> 
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="alamat" id="" cols="30" rows="3" class="form-control" required><?= $row['alamat']?></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <select class="form-control" name="kecamatan" id="id_kec1" required>
                                <option disabled selected></option>
                                          
                                           <?php 
                                              $kecamatan = $this->model_app->view_where_ordering('kecamatan',array('id_kab'=>7604),'nama','ASC');
                                              foreach($kecamatan->result_array() as $kec){
                                               
                                                  echo "<option value='".$kec['id_kec']."'>".$kec['nama']."</option>";
                  
                                                
                                              }
                                           ?>

                            </select> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kelurahan</label>
                            <select class="form-control" name="kelurahan" id="id_kel1" required>
                                <option disabled selected></option>
                                          
                                <?php if($row['kecamatan'] != 0){
                                    
                                        $kelurahan = $this->model_app->view_where('kelurahan',array('id_kec'=>$row['kecamatan']));
                                        foreach($kelurahan->result_array() as $kel){
                                            if($row['kelurahan'] == $kel['id_kel']){
                                            echo "<option value='".$kel['id_kel']."' selected>".$kel['nama']."</option>";

                                            }else{
                                            echo "<option value='".$kel['id_kel']."'>".$kel['nama']."</option>";

                                            }

                                        }
                                    }?>

                            </select> 
                        </div>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">RT</label>
                        <input type="number" class="form-control" name="rt" required value="<?= $row['rt'] ?>">

                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">RW</label>
                        <input type="number" class="form-control" name="rw" required value="<?= $row['rw'] ?>">

                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Kode Pos</label>
                        <input type="number" class="form-control" name="kode_pos" required  value="<?= $row['kode_pos'] ?>">

                    </div>
                     <div class="col-md-6 form-group">
                        <label for="">Telepon</label>
                        <input type="number" class="form-control" name="telepon" required  value="<?= $row['telepon'] ?>">

                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">HP</label>
                        <input type="number" class="form-control" name="hp" required  value="<?= $row['hp'] ?>"> 

                    </div>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" required  value="<?= $row['email'] ?>">
                </div>
                 <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" >
                </div>
                <div class="form-group">
                    <label for="">Kewarganegaraan</label>
                    
                    <select name="kewarganegaraan" id="" class="form-control" required>
                        <option value="ID">Indonesia</option>
                        <option value="WNA">Warga Negara Asing</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="">Foto Profile</label>
                    <input type="file" accept="image/*" name="foto" class="form-control">
                </div>
                <button class="btn btn-primary float-right" id="btnProfile">Simpan</button>
                </form>
            </div>
            
        </div>
        
    </div>
    
    <div class="col-lg-6 col-xs-12">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title">Data Kepegawaian</h5>
            </div>
            <div class="card-body">
            <form id="formKepeg">

                <div class="form-group">
                    <label for="">Tugas Tambahan</label>
                    <input type="text" class="form-control"  name="tugas_tambahan" value="<?= $row['tugas_tambahan']?>">
                </div>
                <div class="form-group">
                    <label for="">Surat Keterangan CPNS</label>
                    <input type="text" class="form-control" requried name="sk_cpns" value="<?= $row['sk_cpns']?>">
                </div>
                <div class="form-group">
                    <label for="">Tanggal  CPNS</label>
                    <input type="date" class="form-control" requried name="tgl_cpns" value="<?= $row['tanggal_cpns']?>">
                </div>
                <div class="form-group">
                    <label for="">Surat Keterangan Pengangkatan</label>
                    <input type="text" class="form-control" requried name="sk_pengangkatan" value="<?= $row['sk_pengangkatan']?>">
                </div>
                <div class="form-group">
                    <label for="">Tamat  Pengangkatan</label>
                    <input type="date" class="form-control" requried name="tmt_pengangkatan" value="<?= $row['tmt_pengangkatan']?>">
                </div>
                <div class="form-group">
                    <label for="">Lembaga  Pengangkatan</label>
                    <input type="text" class="form-control" requried name="lembaga_pengangkatan" value="<?= $row['lembaga_pengangkatan']?>">
                </div>
                <div class="form-group">
                    <label for="">Pangkat Golongan</label>
                    <input type="text" class="form-control" requried name="pangkat_golongan" value="<?= $row['pangkat_golongan']?>">
                </div>
                <div class="form-group">
                    <label for="">Sumber Gaji</label>
                    <input type="text" class="form-control" requried name="sumber_gaji" value="<?= $row['sumber_gaji']?>">
                </div>
                <button class="btn btn-primary float-right" id="btnKepeg">Simpan</button>
                
                </form>
            </div>
            
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title">Data Pribadi</h5>
            </div>
            <div class="card-body">
            <form id="formPribadi">
                <div class="form-group">
                    <label for="">Nama Ibu Kandung</label>
                    <input type="text" class="form-control" requried name="nama_ibu_kandung" value="<?= $row['nama_ibu_kandung']?>">
                </div>
                <div class="form-group">
                    <label for="">Status Perkawinan</label>
                    <select name="status_perkawinan" id="perkawinan" class="form-control" required>
                        <option value="belum">Belum Kawin</option>
                        <option value="kawin">Kawin</option>

                    </select>
                </div>
                <div class="form-group coupleForm">
                    <label for="" id="name_couple"></label>
                    <input type="text" class="form-control"  name="nama_pasangan" value="<?= $row['nama_pasangan']?>">
                </div>
                <div class="form-group coupleForm">
                    <label for="" id="nip_couple">Surat Keterangan Pengangkatan</label>
                    <input type="text" class="form-control" requried name="nip_pasangan" value="<?= $row['nip_pasangan']?>">
                </div>
                <div class="form-group coupleForm" >
                    <label for="" id="job_couple">Tamat  Pengangkatan</label>
                    <input type="text" class="form-control" requried name="pekerjaan_pasangan" value="<?= $row['pekerjaan_pasangan']?>">
                </div>
                <div class="form-group">
                    <label for="">Tamat PNS</label>
                    <input type="date" class="form-control" requried name="tmt_pns" value="<?= $row['tmt_pns']?>">
                </div>
               <div class="row">
                   <div class="col-6 form-group">
                       <label for="">Lisensi Kepala Sekolah</label>
                       <select name="lisensi_kepsek" id="" class="form-control" id="lisensi">
                            <option value="n">Tidak</option>
                           <option value="y">Ya</option>
                          
                       </select>
                   </div>
                   <div class="col-6 form-group">
                       <label for="">Diklat Kepengawasan</label>
                       <select name="diklat_kepengawasan" id="" class="form-control" id="diklat">
                            <option value="n">Tidak</option>
                           <option value="y">Ya</option>
                         
                       </select>
                   </div>
                   <div class="col-6 form-group">
                       <label for="">Keahlian Braille</label>
                       <select name="keahlian_braille" id="" class="form-control" id="bra"> 
                         <option value="n">Tidak</option>
                           <option value="y">Ya</option>
                         
                       </select>
                   </div>
                   <div class="col-6 form-group">
                       <label for="">Keahlian bahasa Isyarat</label>
                       <select name="keahlian_bahasa_syarat" id="" class="form-control" id="isyarat">
                            <option value="n">Tidak</option>
                           <option value="y">Ya</option>
                        
                       </select>
                   </div>
               </div>
               <button class="btn btn-primary float-right" id="btnPribadi">Simpan</button>
               </form>
            </div>
               

           
        </div>
        
    </div>
    
    <div class="col-lg-6 col-xs-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Data Pajak & Bank</h5>
                </div>
                <div class="card-body">
                    <form id="formPajak">
                    <div class="form-group">
                        <label for="">NPWP</label>
                        <input type="number" class="form-control" name="npwp" value="<?= $row['npwp']?>">

                    </div>
                    <div class="form-group">
                        <label for="">Nama Wajib Pajak</label>
                        <input type="text" class="form-control" name="nama_wajib_pajak" value="<?= $row['nama_wajib_pajak']?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="">Bank</label>
                        <input type="text" class="form-control" name="bank" value="<?= $row['bank']?>">

                    </div>
                    <div class="form-group">
                        <label for="">Nomor Rekening</label>
                        <input type="number" class="form-control" name="nomor_rekening" value="<?= $row['nomor_rekening']?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="">Rekening Atas Nama</label>
                        <input type="text" class="form-control" name="atas_nama" value="<?= $row['atas_nama']?>">

                    </div>
                     <button class="btn btn-primary float-right" id="btnPajak">Simpan</button>

                    </form>
                </div>
            </div>
           
    </div>
    <div class="col-lg-6 col-xs-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Data Kepegawaian</h5>
                </div>
                <div class="card-body">
                    <form id="formKepek">
                    <div class="form-group">
                        <label for="">Karpeg</label>
                        <input type="text" class="form-control" name="karpeg" value="<?= $row['karpeg']?>">

                    </div>
                    <div class="form-group">
                        <label for="">Karis/Karsu</label>
                        <input type="text" class="form-control" name="karis/karsu" value="<?= $row['karis/karsu']?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="">Lintang</label>
                        <input type="text" class="form-control" name="lintang" value="<?= $row['lintang']?>">

                    </div>
                    <div class="form-group">
                        <label for="">Bujur</label>
                        <input type="text" class="form-control" name="bujur" value="<?= $row['bujur']?>">

                    </div>
                    <div class=" form-group">
                       <label for="">NUKS</label>
                       <select name="nuks" id="nuks" class="form-control">
                            <option value="n">Tidak</option>
                           <option value="y">Ya</option>
                        
                       </select>
                   </div>
                   <button class="btn btn-primary float-right" id="btnKepek">Simpan</button>

                    </form>
                </div>
               
            </div> 
                                       
    </div>
</div>


<script>
    $('#id_kec1').val(<?= $row['kecamatan'] ?>).change();
    $('#jk').val('<?= $row['jenis_kelamin'] ?>').change();
    $('#agama').val('<?= $row['agama'] ?>').change();
    $('#lisensi').val('<?= $row['lisensi_kepsek'] ?>').change();
    $('#diklat').val('<?= $row['diklat_kepengawasan'] ?>').change();
    $('#bra').val('<?= $row['keahlian_braille'] ?>').change();
    $('#nuks').val('<?= $row['nuks'] ?>').change();

    $('#isyarat').val('<?= $row['keahlian_bahasa_isyarat'] ?>').change();

    $('#perkawinan').val('<?= $row['status_perkawinan'] ?>').change();

    
    var jk = '<?= $row['jenis_kelamin']?>';
        if(jk == 'male'){
            $('#name_couple').html('Nama Istri');
            $('#nip_couple').html('NIP Istri');
            $('#job_couple').html('Job Istri');
        }else{
            $('#name_couple').html('Nama Suami');
            $('#nip_couple').html('NIP Suami');
            $('#job_couple').html('Job Suami');
        }


    $('#id_kec1').change(function(){
          var id_kec = $('#id_kec1').val();
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('administrator/kelurahanSel'); ?>",
            data:"id_kec="+id_kec,
            success: function(response){
              $('#id_kel1').html(response);
            
            },complete:function(){
                $('#id_kel1').val(<?= $row['kelurahan'] ?>).change();
            }
          })
        })
    $(document).on('change','#jk',function(){
        var jk = $(this).val();
        if(jk == 'male'){
            $('#name_couple').html('Nama Istri');
            $('#nip_couple').html('NIP Istri');
            $('#job_couple').html('Job Istri');
        }else{
            $('#name_couple').html('Nama Suami');
            $('#nip_couple').html('NIP Suami');
            $('#job_couple').html('Job Suami');
        }
    })
        
    $(document).on('change','#perkawinan',function(){
        var val = $(this).val();
        if(val == 'belum'){
            $('.coupleForm').hide();
        }else{
            $('.coupleForm').show();
        }
    })
      $("#formProfile").on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('id', $('#id').val());
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/profileGuru') ?>",

           
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formProfile input').prop('disabled',true);
                $('#formProfile select').prop('disabled',true);

                $('#btnProfile').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formProfile button').prop('disabled',true);
   
            },
             error:function(){
             
                 swal({

                  title: '404',
                  text: 'Something error!',
                   customClass: 'swal-wide',
                   type:'error',
                  
                })
               
            },
          
            success: function(resp){
               
              if(resp.status == true){
                
              
                swal({
                    title:'Berhasil',
                    text:resp.msg,
                    type:'success',
                })
              }else{
                swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
              }
               
            }, 
             complete: function() {
               $('#formProfile input').prop('disabled',false);
                $('#formProfile select').prop('disabled',false);

               $('#btnProfile').html('Simpan');
                $('#formProfile button').prop('disabled',false);
            },
        });
    });
    $("#formKepeg").on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('id', $('#id').val());
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/kepegGuru') ?>",

           
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formProfile input').prop('disabled',true);
                $('#formProfile select').prop('disabled',true);

                $('#btnKepeg').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formProfile button').prop('disabled',true);
   
            },
             error:function(){
             
                 swal({

                  title: '404',
                  text: 'Something error!',
                   customClass: 'swal-wide',
                   type:'error',
                  
                })
               
            },
          
            success: function(resp){
               
              if(resp.status == true){
               
                swal({
                    title:'Berhasil',
                    text:resp.msg,
                    type:'success',
                })
              }else{
                swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
              }
               
            }, 
             complete: function() {
               $('#formKepeg input').prop('disabled',false);
                $('#formKepeg select').prop('disabled',false);

               $('#btnKepeg').html('Simpan');
                $('#formKepeg button').prop('disabled',false);
            },
        });
    });
    $("#formPribadi").on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('id', $('#id').val());
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/pribadiGuru') ?>",

           
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formPribadi input').prop('disabled',true);
                $('#formPribadi select').prop('disabled',true);

                $('#btnPribadi').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formPribadi button').prop('disabled',true);
   
            },
             error:function(){
             
                 swal({

                  title: '404',
                  text: 'Something error!',
                   customClass: 'swal-wide',
                   type:'error',
                  
                })
               
            },
          
            success: function(resp){
               
              if(resp.status == true){
                
              
                swal({
                    title:'Berhasil',
                    text:resp.msg,
                    type:'success',
                })
              }else{
                swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
              }
               
            }, 
             complete: function() {
               $('#formPribadi input').prop('disabled',false);
                $('#formPribadi select').prop('disabled',false);

               $('#btnPribadi').html('Simpan');
                $('#formPribadi button').prop('disabled',false);
            },
        });
    });
    $("#formPajak").on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('id', $('#id').val());
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/pajakGuru') ?>",

           
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formPajak input').prop('disabled',true);
                $('#formPajak select').prop('disabled',true);

                $('#formPajak button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formPajak button').prop('disabled',true);
   
            },
             error:function(){
             
                 swal({

                  title: '404',
                  text: 'Something error!',
                   customClass: 'swal-wide',
                   type:'error',
                  
                })
               
            },
          
            success: function(resp){
               
              if(resp.status == true){
                
              
                swal({
                    title:'Berhasil',
                    text:resp.msg,
                    type:'success',
                })
              }else{
                swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
              }
               
            }, 
             complete: function() {
               $('#formPajak input').prop('disabled',false);
                $('#formPajak select').prop('disabled',false);

               $('#formPajak button').html('Simpan');
                $('#formPajak button').prop('disabled',false);
            },
        });
    });
    $("#formKepek").on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('id', $('#id').val());
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/kepekGuru') ?>",

           
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formKepek input').prop('disabled',true);
                $('#formKepek select').prop('disabled',true);

                $('#formKepek button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formKepek button').prop('disabled',true);
   
            },
             error:function(){
             
                 swal({

                  title: '404',
                  text: 'Something error!',
                   customClass: 'swal-wide',
                   type:'error',
                  
                })
               
            },
          
            success: function(resp){
               
              if(resp.status == true){
                
              
                swal({
                    title:'Berhasil',
                    text:resp.msg,
                    type:'success',
                })
              }else{
                swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
              }
               
            }, 
             complete: function() {
               $('#formKepek input').prop('disabled',false);
                $('#formKepek select').prop('disabled',false);

               $('#formKepek button').html('Simpan');
                $('#formKepek button').prop('disabled',false);
            },
        });
    });
</script>




