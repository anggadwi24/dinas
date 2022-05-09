
                    <p class="mb-4"><a href="<?= base_url('administrator/siswa')?>" class="btn btn-primary">Kembali</a></p>
                    <form id="formAdd">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                        </div>
                        <div class="card-body">
                               <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
                           
                               <div class="row">
                                <?php   if($status == 'all' OR $status == 'dinas' OR $status == 'pusat'){?>
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
                                           <input type="number" name="nisn" class="form-control" required>
                                       </div>
                                   </div>
                                   <div class="col-md-6 form-group">
                                       <div class="form-group">
                                           <label>NIPD</label>
                                           <input type="number" name="nipd" class="form-control" required>
                                       </div>
                                   </div>

                                   <div class="col-md-8 form-group">
                                       <div class="form-group">
                                           <label>Nama Lengkap</label>
                                           <input type="text" name="nama_lengkap" class="form-control" required>
                                       </div>
                                   </div>
                                   <div class="col-md-4 form-group">
                                       <label for="">Kelas</label>
                                       
                                           <?php 
                                           if($status == 'sekolah'){
                                                echo '<select name="kelas" class="form-control">';
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
                                           <input type="number" name="no_hp" class="form-control" required>
                                       </div>
                                   </div>
                                   <div class="col-md-4">
                                       <div class="form-group">
                                           <label>No Telp</label>
                                           <input type="number" name="no_telp" class="form-control" required>
                                       </div>
                                   </div>
                                     <div class="col-md-4">
                                       <div class="form-group">
                                           <label>Email</label>
                                           <input type="email" name="email" class="form-control" required>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Tempat Lahir</label>
                                           <input type="text" name="tempat_lahir" class="form-control" required>
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Tanggal Lahir</label>
                                           <input type="date" name="tanggal_lahir" class="form-control" required>
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
                                          <select class="form-control" name="agama" required>
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
                                          <select class="form-control" name="kecamatan" id="id_kec" required>
                                            <option>-- Pilih -- </option>
                                          
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
                                            <option>-- Pilih -- </option>
                                          
                                           

                                          </select> 
                                       </div>
                                   </div>
                                   <div class="col-md-3">
                                       <div class="form-group">
                                           <label>RT</label>
                                           <input type="number" name="rt" class="form-control" required>
                                       </div>
                                   </div>
                                   <div class="col-md-3">
                                       <div class="form-group">
                                           <label>RW</label>
                                           <input type="number" name="rw" class="form-control" required>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Dusun</label>
                                           <input type="text" name="dusun" class="form-control" required>
                                       </div>
                                   </div>
                                     <div class="col-md-8">
                                       <div class="form-group">
                                           <label>Alamat</label>
                                            <textarea class="form-control" required name="alamat"></textarea>
                                       </div>
                                   </div>
                                   <div class="col-md-4">
                                       <div class="form-group">
                                           <label>Kode Pos</label>
                                           <input type="text" name="kode_pos" class="form-control" required>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Jenis Tinggal</label>
                                           <select class="form-control" name="jenis_tinggal" required>
                                                <option value="Bersama orang tua">Bersama Orang Tua</option>
                                                <option value="Bersama wali">Bersama wali</option>
                                                <option value="Sendiri">Sendiri</option>
                                            </select>
                                            

                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Alat Transportasi</label>
                                           <input type="text" name="alat_transportasi" class="form-control" required>
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
                                       <input type="number" class="form-control" name="vaksin_ke">
                                   </div>
                                   <div class="col-md-4 form-group formVaksin">
                                       <label for="">Nama Vaksin </label>
                                       <input type="text" class="form-control" name="nama_vaksin">
                                   </div>
                                   <div class="col-md-12 form-group">
                                       <label for="">Password</label>
                                       <input type="password" name="password" class="form-control" required>
                                   </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Foto Profile</label>
                                           <input type="file" name="foto" class="form-control" accept="image/*">
                                       </div>
                                   </div>
                                   
                                    <!-- <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Password</label>
                                           <input type="password" name="password" class="form-control" required>
                                       </div>
                                   </div> -->
                                  
                                   
                                 

                                  
                               </div>
                            
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h5 class="m-0 font-weight-bold text-primary">Data Personal</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">NIK</label>
                                <input type="text" class="form-control" name="nik">
                            </div>
                            <div class="form-group">
                                <label for="">SKHUN</label>
                                <input type="text" class="form-control" name="skhun">
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
                                <input type="text" class="form-control" name="no_kps">
                            </div>
                            <div class="form-group">
                                <label for="">No. Pesertja Ujian Nasional</label>
                                <input type="text" class="form-control" name="no_peserta_ujian_nasional">
                            </div>
                            <div class="form-group">
                                <label for="">No. Seri ijazah</label>
                                <input type="text" class="form-control" name="no_seri_ijazah">
                                
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
                                <input type="text" class="form-control" name="nomor_kip">
                            </div>
                            <div class="form-group formKIP">
                                <label for="">Nama di KIP</label>
                                <input type="text" class="form-control" name="nama_kip">
                            </div>
                            <div class="form-group">
                                <label for="">No. KKS</label>
                                <input type="text" class="form-control" name="nomor_kks">
                                
                            </div>
                            <div class="form-group">
                                <label for="">No. Registrasi Akta Lahir</label>
                                <input type="text" class="form-control" name="no_registrasi_akta_lahir">
                                
                            </div>
                        
                           
                            <div class="form-group">
                                <label for="">Bank</label>
                                <input type="text" class="form-control" name="bank">
                                
                            </div>
                            <div class="form-group">
                                <label for="">No. Rekening Bank</label>
                                <input type="text" class="form-control" name="nomor_rekening_bank">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Rekening Atas Nama</label>
                                <input type="text" class="form-control" name="rekening_atas_nama">
                                
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
                                <input type="text" class="form-control" name="alasan_layak_pip">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Kebutuhan Khusus</label>
                                <input type="text" class="form-control" name="kebutuhan_khusus">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Sekolah Asal</label>
                                <input type="text" class="form-control" name="sekolah_asal">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Anak Ke</label>
                                <input type="number" class="form-control" name="anak_ke">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Lintang</label>
                                <input type="text" class="form-control" name="lintang">
                                
                            </div>
                           
                            <div class="form-group">
                                <label for="">Bujur</label>
                                <input type="text" class="form-control" name="bujur">
                                
                            </div>
                            <div class="form-group">
                                <label for="">No KK</label>
                                <input type="number" class="form-control" name="no_kk">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Berat Badan</label>
                                <input type="number" class="form-control" name="berat_badan">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Tinggi Badan</label>
                                <input type="number" class="form-control" name="tinggi_badan">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Lingkar Kepala</label>
                                <input type="number" class="form-control" name="lingkar_kepala">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Saudara Kandung</label>
                                <input type="number" class="form-control" name="jml_saudara">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Jarak Ke Sekolah (KM)</label>
                                <input type="number" class="form-control" name="jarak_ke_sekolah">
                                
                            </div>
                        </div>
                        
                    </div>
                    <script>
                         $('#formKps').hide();
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
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h5 class="m-0 text-primary">Data Wali</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 form-group">
                                        <h5>Data Ayah</h5>
                                        <div class="form-group">
                                            <label for="">Nama Ayah</label>
                                            <input type="text" name="nama_ayah" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">NIK</label>
                                            <input type="text" name="nik_ayah" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tahun Lahir</label>
                                            <input type="number" name="tahun_ayah" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenjang Pendidikan</label>
                                            <input type="text" name="jenjang_pendidikan_ayah" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Pekerjaan</label>
                                            <input type="text" name="pekerjaan_ayah" class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label for="">Penghasilan</label>
                                            <input type="text" name="penghasilan_ayah" class="form-control">

                                        </div>
                                </div>
                                <div class="col-12 form-group">
                                        <h5>Data Ibu</h5>
                                        <div class="form-group">
                                            <label for="">Nama Ibu</label>
                                            <input type="text" name="nama_ibu" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">NIK</label>
                                            <input type="text" name="nik_ibu" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tahun Lahir</label>
                                            <input type="number" name="tahun_ibu" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenjang Pendidikan</label>
                                            <input type="text" name="jenjang_pendidikan_ibu" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Pekerjaan</label>
                                            <input type="text" name="pekerjaan_ibu" class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label for="">Penghasilan</label>
                                            <input type="text" name="penghasilan_ibu" class="form-control">

                                        </div>
                                </div>
                                <div class="col-12 form-group">
                                        <h5>Data Wali</h5>
                                        <div class="form-group">
                                            <label for="">Nama Wali</label>
                                            <input type="text" name="nama_wali" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">NIK</label>
                                            <input type="text" name="nik_wali" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tahun Lahir</label>
                                            <input type="number" name="tahun_wali" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenjang Pendidikan</label>
                                            <input type="text" name="jenjang_pendidikan_wali" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Pekerjaan</label>
                                            <input type="text" name="pekerjaan_wali" class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label for="">Penghasilan</label>
                                            <input type="text" name="penghasilan_wali" class="form-control">

                                        </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                    <button class="btn btn-primary float-right my-3">SIMPAN</button>
    </form>
<script>
    $('.formVaksin').hide();
    $(document).on('change','#vaksin',function(){
        var val = $(this).val();
        if(val == 'n'){
            $('.formVaksin').hide();
        }else{
            $('.formVaksin').show();
        }
    })
    $(document).on('change','#cabang',function(){
        $.ajax({
            type:'POST',
            url:'<?= base_url('administrator/getKelas') ?>',
            data:{id:$(this).val()},
            // dataType:'json',
            success:function(resp){
                $('#kelas').html(resp);
            }
        })
    })
    $("#formAdd").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/addSiswa') ?>",

           
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