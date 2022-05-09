
                    <p class="mb-4"><a href="<?= base_url('administrator/siswa')?>" class="btn btn-primary">Kembali</a></p>
<div class="row">
    <div class="col-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Siswa</h6>
        </div>
        <div class="card-body">
            <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
            <form id="formAdd">
            <div class="row">
                <?php  if($status == 'all' OR $status == 'dinas' OR $status == 'pusat'){?>
                <div class="col-md-12 form-group">
                        <label >Sekolah</label>
            
                        <select name="id_sd" class="form-control"  id="cabang">
                            
                                <?php 
                    
                        echo "  <option></option>";

                        $subdomain = $this->model_app->view_where_ordering('subdomain',array('status'=>'sekolah'),'nama_cabang','ASC')->result_array();
                    
                        
                        
        
        
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
                    <?php }else{echo "<input type='hidden' name='id_sd' value='".$cabang."'>";}?>
                    <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label>NISN</label>
                        <input type="number" name="nisn" class="form-control" value="<?= $row['nisn']?>" required>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label>NIPD</label>
                        <input type="number" name="nipd" class="form-control" value="<?= $row['nipd']?>" required>
                    </div>
                </div>

                <div class="col-md-8 form-group">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" value="<?= $row['nama_lengkap']?>" required>
                    </div>
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Kelas</label>
                    
                        <?php 
                        if($status == 'sekolah'){
                                echo '<select name="kelas" id="myKelas" class="form-control">';
                                if($jenis == 'sd'){
                                    echo "<option value='I'>I</option><option value='II'>II</option><option value='III'>III</option><option value='IV'>IV</option><option value='V'>V</option><option value='VI'>VI</option>";
                                }else if($jenis == 'smp'){
                                    echo "<option value='VII'>VII</option><option value='VIII'>VIII</option><option value='IX'>IX</option>";
                                }else if($jenis == 'sma'){
                                    echo "<option value='X'>X</option><option value='XI'>XI</option><option value='XII'>XII</option>";

                                }
                                echo '</select>';
                        }else{
                            echo "<select name='kelas' id='kelas' class='form-control'></select>";
                        }
                        
                        ?>
                        
                    
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="number" name="no_hp" class="form-control" required value="<?= $row['no_hp']?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>No Telp</label>
                        <input type="number" name="no_telp" class="form-control" required value="<?= $row['no_telp'] ?>">
                    </div>
                </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required value="<?= $row['email']?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" required value="<?= $row['tempat_lahir']?>">
                    </div>
                </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" required value="<?= $row['tanggal_lahir']?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class='form-control' required>
                                <option value="male">Laki-laki</option>
                                <option value="female">Perempuan</option>

                            </select>
                    </div>
                </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Agama</label>
                        <select class="form-control" name="agama" id="agama" required>
                            <option>-- Pilih -- </option>
                        
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="katolik">Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="buddha">Buddha</option>
                            <option value="konghucu">Konhucu</option>

                        </select> 
                    </div>
                </div>
                
                    
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <select class="form-control" name="kecamatan" id="id_kec1" required>
                            <option>-- Pilih -- </option>
                        
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
                            <option disabled selected>-- Pilih -- </option>
                            <?php 
                                if($row['kecamatan'] != NULL  OR $row['kecamatan'] != 0 ){
                                    $keca = $this->model_app->view_where('kelurahan',array('id_kec'=>$row['kecamatan']));
                                    foreach($keca->result_array() as $kel){
                                        if($row['kelurahan'] == $kel['id_kel']){
                                            echo "<option value='".$kel['id_kel']."' selected>".$kel['nama']."</option>";
                                        }else{
                                            echo "<option value='".$kel['id_kel']."'>".$kel['nama']."</option>";

                                        }
                                    }
                                }

                            ?>
                        
                        

                        </select> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>RT</label>
                        <input type="number" name="rt" class="form-control" value="<?= $row['rt']?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>RW</label>
                        <input type="number" name="rw" class="form-control" value="<?= $row['rw']?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Dusun</label>
                        <input type="text" name="dusun" class="form-control" value="<?= $row['dusun']?>" required>
                    </div>
                </div>
                    <div class="col-md-8">
                    <div class="form-group">
                        <label>Alamat</label>
                            <textarea class="form-control" required name="alamat"><?= $row['alamat'] ?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text" name="kode_pos" class="form-control" required value="<?= $row['kode_pos']?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenis Tinggal</label>
                        <select class="form-control" name="jenis_tinggal" id="jenis_tinggal" required>
                                <option value="Bersama orang tua">Bersama Orang Tua</option>
                                <option value="Bersama wali">Bersama wali</option>
                                <option value="Sendiri">Sendiri</option>
                            </select>
                            

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Alat Transportasi</label>
                        <input type="text" name="alat_transportasi" class="form-control" required value="<?= $row['alat_transportasi']?>">
                    </div>
                </div>
                <div class="col-md-4 form-group">
                                       <label for="">Sudah Vaksin</label>
                                       <select name="vaksin" id="vaksin" class="form-control">
                                            <option value="n">Belum</option>
                                            <option value="y">Sudah</option>
                                       </select>
                                   </div>
                                   <div class="col-md-4 form-group formVaksin">
                                       <label for="">Vaksin Ke - </label>
                                       <input type="number" class="form-control" name="vaksin_ke" value="<?= $row['vaksin_ke']?>">
                                   </div>
                                   <div class="col-md-4 form-group formVaksin">
                                       <label for="">Nama Vaksin </label>
                                       <input type="text" class="form-control" name="nama_vaksin" value="<?= $row['nama_vaksin']?>">
                                   </div>
                <div class="col-md-12 form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" >
                </div>
                    <div class="col-md-12">
                    <div class="form-group">
                        <label>Foto Profile</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= encode($row['id_siswa'])?>">
                    <!-- <div class="col-md-12">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div> -->
                
                
                

                <div class="col-md-12 mt-2">
                    <input type="submit" name="submit" value="SIMPAN" class="btn btn-primary w-100">
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
    <?php 
        $per = $this->model_app->view_where('siswa_data',array('id_siswa'=>$row['id_siswa']))->row_array();
    ?>
    <div class="col-12">
    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h5 class="m-0 font-weight-bold text-primary">Data Personal</h5>
                        </div>
                        <div class="card-body">
                            <form id="formPersonal">
                            <input type="hidden" name="id" value="<?= encode($row['id_siswa'])?>">
                            <div class="form-group">
                                <label for="">NIK</label>
                                <input type="text" class="form-control" name="nik" value="<?= $per['nik']?>">
                            </div>
                            <div class="form-group">
                                <label for="">SKHUN</label>
                                <input type="text" class="form-control" name="skhun" value="<?= $per['skhun'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Penerima KPS</label>
                                <select name="penerima_kps" id="kps" class="form-control">
                                    <option value="n">Tidak</option>
                                    <option value="y">Ya</option>

                                </select>
                            </div>
                            <div class="form-group" id="formKps"> 
                                <label for="">No. KPS</label>
                                <input type="text" class="form-control" name="no_kps" value="<?= $per['no_kps'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">No. Pesertja Ujian Nasional</label>
                                <input type="text" class="form-control" name="no_peserta_ujian_nasional" value="<?= $per['no_peserta_ujian_nasional'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">No. Seri ijazah</label>
                                <input type="text" class="form-control" name="no_seri_ijazah" value="<?= $per['no_seri_ijazah'] ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Penerima KIP</label>
                                <select name="penerima_kip" id="kip" class="form-control">
                                    <option value="n">Tidak</option>
                                    <option value="y">Ya</option>

                                </select>
                            </div>
                            <div class="form-group formKIP" > 
                                <label for="">Nomor. KIP</label>
                                <input type="text" class="form-control" name="nomor_kip" value="<?= $per['nomor_kip'] ?>">
                            </div>
                            <div class="form-group formKIP">
                                <label for="">Nama di KIP</label>
                                <input type="text" class="form-control" name="nama_kip" value="<?= $per['nama_kip'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">No. KKS</label>
                                <input type="text" class="form-control" name="nomor_kks" value="<?= $per['nomor_kks'] ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="">No. Registrasi Akta Lahir</label>
                                <input type="text" class="form-control" name="no_registrasi_akta_lahir" value="<?= $per['no_registrasi_akta_lahir'] ?>">
                                
                            </div>
                           
                           
                            <div class="form-group">
                                <label for="">Bank</label>
                                <input type="text" class="form-control" name="bank" value="<?= $per['bank'] ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="">No. Rekening Bank</label>
                                <input type="text" class="form-control" name="nomor_rekening_bank" value="<?= $per['nomor_rekening_bank'] ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Rekening Atas Nama</label>
                                <input type="text" class="form-control" name="rekening_atas_nama" value="<?= $per['rekening_atas_nama'] ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Layak PIP</label>
                                <select name="layak_pip" class="form-control">
                                    <option value="n">Tidak</option>
                                    <option value="y">Ya</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Alasan Layak PIP</label>
                                <input type="text" class="form-control" name="alasan_layak_pip" value="<?= $per['alasan_layak_pip'] ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Kebutuhan Khusus</label>
                                <input type="text" class="form-control" name="kebutuhan_khusus " value="<?= $per['kebutuhan_khusus'] ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Sekolah Asal</label>
                                <input type="text" class="form-control" name="sekolah_asal" value="<?= $per['sekolah_asal'] ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Anak Ke</label>
                                <input type="number" class="form-control" name="anak_ke" value="<?= $per['anak_ke'] ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Lintang</label>
                                <input type="text" class="form-control" name="lintang" value="<?= $per['lintang'] ?>">
                                
                            </div>
                         
                            <div class="form-group">
                                <label for="">Bujur</label>
                                <input type="text" class="form-control" name="bujur" value="<?= $per['bujur'] ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="">No KK</label>
                                <input type="number" class="form-control" name="no_kk" value="<?= $per['no_kk'] ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Berat Badan</label>
                                <input type="number" class="form-control" name="berat_badan" value="<?= $per['berat_badan'] ?>"> 
                                
                            </div>
                            <div class="form-group">
                                <label for="">Tinggi Badan</label>
                                <input type="number" class="form-control" name="tinggi_badan" value="<?= $per['tinggi_badan'] ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Lingkar Kepala</label>
                                <input type="number" class="form-control" name="lingkar_kepala" value="<?= $per['lingkar_kepala'] ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Saudara Kandung</label>
                                <input type="number" class="form-control" name="jml_saudara" value="<?= $per['jml_saudara'] ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Jarak Ke Sekolah (KM)</label>
                                <input type="number" class="form-control" name="jarak_ke_sekolah" value="<?= $per['jarak_ke_sekolah'] ?>">
                                
                            </div>
                            <input type="submit" name="submit" value="SIMPAN" class="btn btn-primary w-100">
                            </form>
                        </div>
                        
                    </div>
                    <script>
                         $('#formKps').hide();
                        $('#kps').val('<?= $per['penerima_kps']?>').change();
                        $('#kip').val('<?= $per['penerima_kip']?>').change();

                        $(document).on('change','#kps',function(){
                            var val = $(this).val();
                            if(val == 'y'){
                                $('#formKps').show();
                            }else{
                                $('#formKps').hide();
                            }
                        })
                         $('.formKIP').hide();
                        $(document).on('change','#kip',function(){
                            var val = $(this).val();
                            if(val == 'y'){
                                $('.formKIP').show();
                            }else{
                                $('.formKIP').hide();
                            }
                        })
                    </script>
    </div>

<?php 
    $dataWali = $this->model_app->view_where('siswa_wali',array('id_siswa'=>$row['id_siswa']));
    if($dataWali->num_rows() > 0){
        foreach($dataWali->result_array() as $sWal){
    ?>
    <div class="col-6">
                <div class="card shadow mb-4">
                        <div class="card-header">
                            <h5 class="m-0 text-primary">Data <?= ucfirst($sWal['status_wali'])?></h5>
                        </div>
                        <div class="card-body">
                         
                               <form class='formWali'>
                                   <input type="hidden" name="id" value="<?= encode($sWal['sw_id'])?>">
                                        <div class="form-group">
                                            <label for="">Nama </label>
                                            <input type="text" name="nama" value="<?= $sWal['nama'] ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">NIK</label>
                                            <input type="text" name="nik" class="form-control"  value="<?= $sWal['nik'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tahun Lahir</label>
                                            <input type="number" name="tahun_ayah" class="form-control"  value="<?= $sWal['tahun'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenjang Pendidikan</label>
                                            <input type="text" name="jenjang_pendidikan" class="form-control"  value="<?= $sWal['jenjang_pendidikan'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Pekerjaan</label>
                                            <input type="text" name="pekerjaan" class="form-control"  value="<?= $sWal['pekerjaan'] ?>">

                                        </div>
                                        <div class="form-group">
                                            <label for="">Penghasilan</label>
                                            <input type="text" name="penghasilan" class="form-control"  value="<?= $sWal['penghasilan'] ?>">

                                        </div>
                                        <button class="btn btn-primary float-right" >SIMPAN</button>
                                </form>
                               
                        </div>
        </div>
        </div>
    <?php
        }
    }
    
?>

</div>
<script>
    var vaksin = '<?= $row['vaksin']?>';
    if(vaksin == 'n'){
            $('.formVaksin').hide();
        }else if(vaksin == 'y'){
            $('.formVaksin').show();
        }
    $('#vaksin').val('<?= $row['vaksin'] ?>').change();
        $('.formVaksin').hide();
    $(document).on('change','#vaksin',function(){
        var val = $(this).val();
        if(val == 'n'){
            $('.formVaksin').hide();
        }else if(val == 'y'){
            $('.formVaksin').show();
        }
    })
     $(".formWali").on('submit', function(e){
        
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/updateWali') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('.formWali input').prop('disabled',true);
                $('.formWali  select').prop('disabled',true);

                $('.formWali button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('.formWali button').prop('disabled',true);
   
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
               $('.formWali input').prop('disabled',false);
                $('.formWali select').prop('disabled',false);

               $('.formWali button').html('Simpan');
                $('.formWali button').prop('disabled',false);
            },
        });
    });
      $("#formPersonal").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/editPersonalSiswa') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formPersonal input').prop('disabled',true);
                $('#formPersonal select').prop('disabled',true);

                $('#formPersonal button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formPersonal button').prop('disabled',true);
   
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
               $('#formPersonal input').prop('disabled',false);
                $('#formPersonal select').prop('disabled',false);

               $('#formPersonal button').html('Simpan');
                $('#formPersonal button').prop('disabled',false);
            },
        });
    });
    $("#formAdd").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/editSiswa') ?>",

           
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
    $('#myKelas').val('<?= $row['kelas'] ?>').change();
    $(document).on('change','#cabang',function(){
        $.ajax({
            type:'POST',
            url:'<?= base_url('administrator/getKelas') ?>',
            data:{id:$(this).val()},
            // dataType:'json',
            success:function(resp){
                $('#kelas').html(resp);
                var kelas = '<?= $row['kelas']?>';
                $('#kelas').val(kelas).change();
            }
        })
    })
    </script>
                    <script>
                        $('#cabang').val('<?= $row['id_sd'] ?>').change();
                        $('#agama').val('<?= $row['agama'] ?>').change();
                        $('#id_kec1').val(<?= $row['kecamatan'] ?>).change();
                        $('#jenis_tinggal').val('<?= $row['jenis_tinggal'] ?>').change();



                        var jk = '<?= $row['jenis_kelamin'] ?>';
                      
                        $('#jenis_kelamin').val(jk).change();
                        $('#id_kec1').change(function(){
                           
                        var id_kec = $(this).val();
                        $.ajax({
                            type:"POST",
                            url:"<?php echo site_url('administrator/kelurahanSel'); ?>",
                            data:"id_kec="+id_kec,
                            success: function(response){
                                $('#id_kel1').html(response);
                            },complete:function(){
                                // $('#id_kel1').val('<?= $row['kelurahan'] ?>').change();
                            }
                        })
                        })
                    </script>
                    