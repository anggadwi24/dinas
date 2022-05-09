  
                    <p class="mb-4"><a href="<?= base_url('administrator/pegawai')?>" class="btn btn-primary">Kembali</a></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Pegawai</h6>
                        </div>
                        <div class="card-body">
                               <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
                            <form action="<?= base_url('administrator/pegawai/add')?>" method="post" enctype='multipart/form-data'>
                               <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>No. KTP</label>
                                           <input type="number" name="no_ktp" class="form-control" required>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>No. NPWP</label>
                                           <input type="number" name="no_npwp" class="form-control" required>
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Nama Lengkap</label>
                                           <input type="text" name="nama_lengkap" class="form-control" required>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Nama Panggilan</label>
                                           <input type="text" name="nama_panggilan" class="form-control" required>
                                       </div>
                                   </div>
                                     <div class="col-md-6">
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
                                           <label>Agama</label>
                                          <select class="form-control" name="agama" required>
                                            <option value="">-- Pilih -- </option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Konghucu">Konghucu</option>
                                          </select> 
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Jenis Kelamin</label>
                                          <select class="form-control" name="jenis_kelamin" required>
                                            <option value="Laki-laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                          
                                          </select> 
                                       </div> 
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Golongan Darah</label>
                                          <select class="form-control" name="goldar" required>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="AB">AB</option>
                                            <option value="O">O</option>
                                          </select> 
                                       </div> 
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>No HP</label>
                                           <input type="number" name="no_hp" class="form-control" required>
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Pendidikan Terakhir</label>
                                           <input type="text" name="pendidikan_terakhir" class="form-control" required>
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Status</label>
                                           <input type="text" name="status" class="form-control" required>
                                       </div>
                                   </div>
                                     <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Alamat</label>
                                            <textarea class="form-control" required name="alamat"></textarea>
                                       </div>
                                   </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Bank</label>
                                           <input type="text" name="bank" class="form-control" required>
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>No Rekening</label>
                                           <input type="text" name="no_rekening" class="form-control" required>
                                       </div>
                                   </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Gaji Pokok</label>
                                           <input type="number" name="gaji_pokok" class="form-control" required>
                                       </div>
                                   </div>
                                   <div class="col-12 form-group">
                                      <label >Dinas</label>
                        
                                      <select name="id_sd" class="form-control"  id="cabang">
                                          
                                               <?php 
                                               if($status == 'all' OR $status == 'dinas' OR $status == 'pusat'){
                                 
                                     $subdomain = $this->model_app->view_where_ordering('subdomain',array('status'=>'dinas'),'nama_cabang','ASC')->result_array();
                                    }
                                    
                    
                       
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
                                    <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Bagian</label>
                                          <select name="bagian" class="form-control" required id="bagian">
                                              <option>-- Pilih Bagian --</option>
                                              <?php foreach($bagian->result_array() as $div){?>
                                                    <option value="<?= $div[id_bagian]?>"><?= ucfirst($div['nama_bagian'])?></option>
                                              <?php }?>
                                          </select>
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Sub Bagian</label>
                                          <select name="sub_bagian" class="form-control" required id="sub">
                                              <option>-- Pilih Sub Bagian --</option>
                                              
                                          </select>
                                       </div>
                                   </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Sub Kegiatan</label>
                                          <select name="sub_kegiatan" class="form-control" required id="subkegiatan">
                                              <option>-- Pilih Sub Kegiatan --</option>
                                              
                                          </select>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Tugas Pokok</label>
                                           <input type="text" name="tugas_pokok" class="form-control" required>
                                       </div>
                                   </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Foto Profile</label>
                                           <input type="file" name="foto" class="form-control">
                                       </div>
                                   </div>
                                   
                                    <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Password</label>
                                           <input type="password" name="password" class="form-control" required>
                                       </div>
                                   </div>
                                  
                                   
                                 

                                   <div class="col-md-12">
                                       <input type="submit" name="submit" value="TAMBAH" class="btn btn-primary">
                                   </div>
                               </div>
                            </form>
                        </div>
                    </div>
