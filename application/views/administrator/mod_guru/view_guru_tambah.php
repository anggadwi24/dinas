<p class="mb-4"><a href="<?= base_url('administrator/guru')?>" class="btn btn-primary">Kembali</a></p>
<form id="formAdd">
<div class="row">
    <div class="col-lg-6 col-xs-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Guru</h5>
            </div>
            <div class="card-body">
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
                    <input type="text" class="form-control" name="nama_guru" required>
                </div>
                <div class="form-group">
                    <label for="">NIK</label>
                    <input type="number" class="form-control" name="nik" required>
                </div>
                <div class="form-group">
                    <label for="">No. KK</label>
                    <input type="number" class="form-control" name="no_kk" >
                </div>
                <div class="form-group">
                    <label for="">NIP</label>
                    <input type="number" class="form-control" name="nip" required>
                </div>
                <div class="form-group">
                    <label for="">NUPTK</label>
                    <input type="number" class="form-control" name="nuptk" required>
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
                        <input type="text" class="form-control" name="tempat_lahir" required>
                    </div>
                    <div class="col-6 form-group">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" required>
                    </div>

                    <div class="col-6 form-group">
                        <label for="">Status Kepegawaian</label>
                        <input type="text" class="form-control" name="status_kepegawaian" required>
                    </div>
                    <div class="col-6 form-group">
                        <label for="">Jenis PTK</label>
                        <input type="text" class="form-control" name="jenis_ptk" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Agama</label>
                    <select class="form-control" name="agama" required>
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
                    <textarea name="alamat" id="" cols="30" rows="3" class="form-control" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <select class="form-control" name="kecamatan" id="id_kec" required>
                                <option disabled selected></option>
                                          
                                           <?php 
                                              $kecamatan = $this->model_app->view_where_ordering('kecamatan',array('id_kab'=>7604),'nama','ASC');
                                              foreach($kecamatan->result_array() as $kec){
                                                if($kec['id_kec'] == $row['kecamatan']){
                                                  echo "<option value='".$kec['id_kec']."' selected>".$kec['nama']."</option>";
                                                }else{
                                                  echo "<option value='".$kec['id_kec']."'>".$kec['nama']."</option>";
                  
                                                }
                                              }
                                           ?>

                            </select> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kelurahan</label>
                            <select class="form-control" name="kelurahan" id="id_kel" required>
                                <option disabled selected></option>
                                          
                                           

                            </select> 
                        </div>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">RT</label>
                        <input type="number" class="form-control" name="rt" required>

                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">RW</label>
                        <input type="number" class="form-control" name="rw" required>

                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Kode Pos</label>
                        <input type="number" class="form-control" name="kode_pos" required>

                    </div>
                     <div class="col-md-6 form-group">
                        <label for="">Telepon</label>
                        <input type="number" class="form-control" name="telepon" required>

                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">HP</label>
                        <input type="number" class="form-control" name="hp" required>

                    </div>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                 <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" required>
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
               
                
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xs-12">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title">Data Kepegawaian</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Tugas Tambahan</label>
                    <input type="text" class="form-control"  name="tugas_tambahan">
                </div>
                <div class="form-group">
                    <label for="">Surat Keterangan CPNS</label>
                    <input type="text" class="form-control" requried name="sk_cpns">
                </div>
                <div class="form-group">
                    <label for="">Tanggal  CPNS</label>
                    <input type="date" class="form-control" requried name="tgl_cpns">
                </div>
                <div class="form-group">
                    <label for="">Surat Keterangan Pengangkatan</label>
                    <input type="text" class="form-control" requried name="sk_pengangkatan">
                </div>
                <div class="form-group">
                    <label for="">Tamat  Pengangkatan</label>
                    <input type="date" class="form-control" requried name="tmt_pengangkatan">
                </div>
                <div class="form-group">
                    <label for="">Lembaga  Pengangkatan</label>
                    <input type="text" class="form-control" requried name="lembaga_pengangkatan">
                </div>
                <div class="form-group">
                    <label for="">Pangkat Golongan</label>
                    <input type="text" class="form-control" requried name="pangkat_golongan">
                </div>
                <div class="form-group">
                    <label for="">Sumber Gaji</label>
                    <input type="text" class="form-control" requried name="sumber_gaji">
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title">Data Pribadi</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nama Ibu Kandung</label>
                    <input type="text" class="form-control" requried name="nama_ibu_kandung">
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
                    <input type="text" class="form-control"  name="nama_pasangan">
                </div>
                <div class="form-group coupleForm">
                    <label for="" id="nip_couple">Surat Keterangan Pengangkatan</label>
                    <input type="text" class="form-control" requried name="nip_pasangan">
                </div>
                <div class="form-group coupleForm" >
                    <label for="" id="job_couple">Tamat  Pengangkatan</label>
                    <input type="text" class="form-control" requried name="pekerjaan_pasangan">
                </div>
                <div class="form-group">
                    <label for="">Tamat PNS</label>
                    <input type="date" class="form-control" requried name="tmt_pns">
                </div>
               <div class="row">
                   <div class="col-6 form-group">
                       <label for="">Lisensi Kepala Sekolah</label>
                       <select name="lisensi_kepsek" id="" class="form-control">
                            <option value="n">Tidak</option>
                           <option value="y">Ya</option>
                          
                       </select>
                   </div>
                   <div class="col-6 form-group">
                       <label for="">Diklat Kepengawasan</label>
                       <select name="diklat_kepengawasan" id="" class="form-control">
                            <option value="n">Tidak</option>
                           <option value="y">Ya</option>
                         
                       </select>
                   </div>
                   <div class="col-6 form-group">
                       <label for="">Keahlian Braille</label>
                       <select name="keahlian_braille" id="" class="form-control">
                         <option value="n">Tidak</option>
                           <option value="y">Ya</option>
                         
                       </select>
                   </div>
                   <div class="col-6 form-group">
                       <label for="">Keahlian bahasa Isyarat</label>
                       <select name="keahlian_bahasa_syarat" id="" class="form-control">
                            <option value="n">Tidak</option>
                           <option value="y">Ya</option>
                        
                       </select>
                   </div>
               </div>
            </div>
        </div>
        
    </div>
    
    <div class="col-lg-6 col-xs-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Data Pajak</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">NPWP</label>
                        <input type="number" class="form-control" name="npwp">

                    </div>
                    <div class="form-group">
                        <label for="">Nama Wajib Pajak</label>
                        <input type="text" class="form-control" name="nama_wajib_pajak">
                        
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Data Bank</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Bank</label>
                        <input type="text" class="form-control" name="bank">

                    </div>
                    <div class="form-group">
                        <label for="">Nomor Rekening</label>
                        <input type="number" class="form-control" name="nomor_rekening">
                        
                    </div>
                    <div class="form-group">
                        <label for="">Rekening Atas Nama</label>
                        <input type="text" class="form-control" name="atas_nama">

                    </div>
                </div>
            </div>
    </div>
    <div class="col-lg-6 col-xs-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Data Kepegawaian</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Karpeg</label>
                        <input type="text" class="form-control" name="karpeg">

                    </div>
                    <div class="form-group">
                        <label for="">Karis/Karsu</label>
                        <input type="text" class="form-control" name="karis/karsu">
                        
                    </div>
                    <div class="form-group">
                        <label for="">Lintang</label>
                        <input type="text" class="form-control" name="lintang">

                    </div>
                    <div class="form-group">
                        <label for="">Bujur</label>
                        <input type="text" class="form-control" name="bujur">

                    </div>
                    <div class=" form-group">
                       <label for="">NUKS</label>
                       <select name="nuks" id="" class="form-control">
                            <option value="n">Tidak</option>
                           <option value="y">Ya</option>
                        
                       </select>
                   </div>
                </div>
            </div> 
            <button class="float-right btn btn-primary">Simpan</button>                                      
    </div>
</div>
</form>

<script>
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
        $('.coupleForm').hide();
    $(document).on('change','#perkawinan',function(){
        var val = $(this).val();
        if(val == 'belum'){
            $('.coupleForm').hide();
        }else{
            $('.coupleForm').show();
        }
    })
      $("#formAdd").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/addGuru') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formAdd input').prop('disabled',true);
                $('select').prop('disabled',true);

                $('#btnAdd').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formAdd button').prop('disabled',true);
   
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
                
                $('#formAdd input').val('');
                $('#formAdd textarea').val('');
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
               $('#formAdd input').prop('disabled',false);
                $('select').prop('disabled',false);

               $('#btnAdd').html('Simpan');
                $('#formAdd button').prop('disabled',false);
            },
        });
    });
</script>




