 <?php 
  if (!file_exists("asset/foto_user/$row[foto_profile]") OR $row['foto_profile']==''){
                    $foto_user = "https://bootdey.com/img/Content/avatar/avatar7.png";
                  }else{
                    $foto_user = base_url('asset/foto_user/').$row['foto_profile'];
                  }
                   $bagian = $this->db->query("SELECT * FROM `pegawai` JOIN `bagian` ON `pegawai`.`bagian`=`bagian`.`id_bagian` JOIN `sub_bagian`ON `sub_bagian`.`id_sub_bagian` = `pegawai`.`sub_bagian` WHERE id_pegawai = $row[id_pegawai]")->row_array();;
                  
?>    


  
                    <p class="mb-4"><a href="<?= base_url('administrator/pegawai')?>" class="btn btn-primary">Kembali</a></p>

                    <!-- DataTales Example -->
            <?php if($row['aktif'] =='y'){
                $btt = "border-bottom-success";
            }else{
              $btt = "border-bottom-danger";
            } ?>
            <div class="row">
              <div class="col-md-4">
                  <div class="card <?= $btt?>" style="width: 18rem;" >
                    <img class="card-img-top" src="<?= $foto_user ?>" alt="Card image cap" id="output">
                    <div class="card-body">
                      <h5 class="card-title"><?= $row['no_ktp']?></h5>
                      <h6 class="card-subtitle mb-2 text-muted"><?= $row['nama_lengkap']?></h6>
                       <h6 class="card-subtitle mb-2 text-muted"><?= $row['email']?></h6>
                     <div class="d-flex justify-content-between"><label><?= $row['no_hp']?></label><label><?= $bagian['nama_bagian']?></label></div>
                    </div>
                  </div>
              </div>
              <div class="col-md-8">
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Pegawai</h6>
                        </div>
                        <div class="card-body">
                               <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
                            <form action="<?= base_url('administrator/pegawai/edit')?>" method="post" enctype='multipart/form-data'>
                              <input type="hidden" name="id" value="<?=$row['id_pegawai']?>">
                               <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>No. KTP</label>
                                           <input type="number" name="no_ktp" class="form-control" required value="<?= $row[no_ktp] ?>">
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>No. NPWP</label>
                                           <input type="number" name="no_npwp" class="form-control" required value="<?= $row[no_npwp] ?>">
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Nama Lengkap</label>
                                           <input type="text" name="nama_lengkap" class="form-control" required value="<?= $row[nama_lengkap] ?>">
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Nama Panggilan</label>
                                           <input type="text" name="nama_panggilan" class="form-control" required value="<?= $row[nama_panggilan] ?>">
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Email</label>
                                           <input type="email" name="email" class="form-control" required value="<?= $row[email] ?>">
                                       </div>
                                   </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Tempat Lahir</label>
                                           <input type="text" name="tempat_lahir" class="form-control" required value="<?= $row[tempat_lahir] ?>">
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Tanggal Lahir</label>
                                           <input type="date" name="tanggal_lahir" class="form-control" required value="<?= date('Y-m-d',strtotime($row[tanggal_lahir])) ?>">
                                       </div>
                                   </div>
                                       <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Agama</label>
                                          <select class="form-control" name="agama" required>
                                            <option value="">-- Pilih -- </option>
                                            <option value="Islam" <?php if($row['agama']=='Islam'){echo "selected";}?>>Islam</option>
                                            <option value="Kristen" <?php if($row['agama']=='Kristen'){echo "selected";}?>>Kristen</option>
                                            <option value="Katolik" <?php if($row['agama']=='Katolik'){echo "selected";}?>>Katolik</option>
                                            <option value="Hindu" <?php if($row['agama']=='Hindu'){echo "selected";}?>>Hindu</option>
                                            <option value="Budha" <?php if($row['agama']=='Budha'){echo "selected";}?>>Budha</option>
                                            <option value="Konghucu" <?php if($row['agama']=='Konghucu'){echo "selected";}?>>Konghucu</option>
                                          </select> 
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Jenis Kelamin</label>
                                          <select class="form-control" name="jenis_kelamin" required>
                                            <option value="Laki-laki" <?php if($row['jenis_kelamin']=='Laki-Laki'){echo "selected";}?>>Laki-Laki</option>
                                            <option value="Perempuan" <?php if($row['jenis_kelamin']=='Perempuan'){echo "selected";}?>>Perempuan</option>
                                          
                                          </select> 
                                       </div> 
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Golongan Darah</label>
                                          <select class="form-control" name="goldar" required>
                                            <option value="A"  <?php if($row['goldar']=='A'){echo "selected";}?>>A</option>
                                            <option value="B" <?php if($row['goldar']=='B'){echo "selected";}?>>B</option>
                                            <option value="AB" <?php if($row['goldar']=='AB'){echo "selected";}?>>AB</option>
                                            <option value="O" <?php if($row['goldar']=='O'){echo "selected";}?>>O</option>
                                          </select> 
                                       </div> 
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>No HP</label>
                                           <input type="number" name="no_hp" class="form-control" required value="<?= $row[no_hp] ?>">
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Pendidikan Terakhir</label>
                                           <input type="text" name="pendidikan_terakhir" class="form-control" required value="<?= $row[pendidikan_terakhir] ?>">
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Status</label>
                                           <input type="text" name="status" class="form-control" required value="<?= $row[status] ?>">
                                       </div>
                                   </div>
                                     <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Alamat</label>
                                            <textarea class="form-control" required name="alamat"><?= $row[alamat] ?></textarea>
                                       </div>
                                   </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Bank</label>
                                           <input type="text" name="bank" class="form-control" required value="<?= $row[bank] ?>">
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>No Rekening</label>
                                           <input type="text" name="no_rekening" class="form-control" required value="<?= $row[no_rekening] ?>">
                                       </div>
                                   </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Gaji Pokok</label>
                                           <input type="number" name="gaji_pokok" class="form-control" required value="<?= $row[gaji_pokok] ?>">
                                       </div>
                                   </div>
                                    <div class="col-12">
                                      <label >Desa/Kelurahan</label>
                        
                                      <select name="id_sd" class="form-control"  id="cabang2">
                                          
                                               <?php
                                                  if($status == 'all' OR $status == 'dinas' OR $status == 'pusat'){
                                                echo "  <option></option>";

                                                 $subdomain = $this->model_app->view_ordering('subdomain','nama_cabang','ASC');
                                                }else if($status == 'kabupaten'){
                                                    echo " <option></option>";
                                                 $subdomain = $this->db->query("SELECT * FROM subdomain WHERE kabupaten = '".$kabupaten."' AND (status = 'kelurahan' OR status = 'kecamatan' OR status ='kabupaten' )")->result_array();
                                                }else if($status == 'kecamatan'){
                                                     echo "  <option></option>";
                                                     $subdomain = $this->db->query("SELECT * FROM subdomain WHERE kecamatan = '".$kecamatan."' AND (status = 'kelurahan' OR status ='kecamatan')")->result_array();
                                                }else if($status == 'kelurahan'){
                                                     $subdomain = $this->db->query("SELECT * FROM subdomain WHERE kelurahan = '".$kelurahan."' AND status = 'kelurahan' ")->result_array();
                                                }
                    
                       
                                                 foreach ($subdomain as $sd) {
                                                            if ($sd['id_sd']==$row['id_sd']){
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
                                              <?php foreach($bag->result_array() as $div){?>
                                                    <?php if($div[id_bagian] == $row[bagian]){?>
                                                     <option value="<?= $div[id_bagian]?>" selected><?= ucfirst($div['nama_bagian'])?></option>
                                                    <?php }else{?>
                                                    <option value="<?= $div[id_bagian]?>"><?= ucfirst($div['nama_bagian'])?></option>
                                                     <?php }?>
                                              <?php }?>
                                          </select>
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Sub Bagian</label>
                                          <select name="sub_bagian" class="form-control" required id="sub">
                                              <option>-- Pilih Sub Bagian --</option>
                                               <?php   $sub = $this->model_app->view_where_ordering('sub_bagian',array('id_bagian'=>$row['bagian']),'id_sub_bagian','DESC');
                                                foreach ($sub->result_array() as $s) {
                                                if ($row['sub_bagian']==$s['id_sub_bagian']){
                                                echo "<option value='$s[id_sub_bagian]' selected>$s[nama_sub_bagian]</option>";
                                                 }else{
                                                 echo "<option value='$s[id_sub_bagian]'>$s[nama_sub_bagian]</option>";
                                                 }
                                                }?> 
                                          </select>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Sub Kegiatan</label>
                                          <select name="sub_kegiatan" class="form-control" required id="subkegiatan">
                                              <option>-- Pilih Sub Kegiatan --</option>
                                               <?php   $sk = $this->model_app->view_where_ordering('sub_kegiatan',array('id_sub_bagian'=>$row['sub_bagian']),'id_sub_kegiatan','DESC');
                                                foreach ($sk->result_array() as $sk) {
                                                if ($row['sub_kegiatan']==$sk['id_sub_kegiatan']){
                                                echo "<option value='$sk[id_sub_kegiatan]' selected>$sk[nama_kegiatan]</option>";
                                                 }else{
                                                 echo "<option value='$sk[id_sub_kegiatan]'>$sk[nama_kegiatan]</option>";
                                                 }
                                                }?> 
                                          </select>
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Tugas Pokok</label>
                                           <input type="text" name="tugas_pokok" class="form-control" required value="<?= $row[tugas_pokok]?>">
                                       </div>
                                   </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Foto Profile</label>
                                           <input type="file" name="foto" class="form-control"  onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                       </div>
                                   </div>
                                    <div class="col-12">
                                      <label >Desa/Kelurahan</label>
                        
                                      <select name="id_sd" class="form-control"  id="subkegiatan1">
                                          
                                               <?php
                                                  if($status == 'all' OR $status == 'dinas' OR $status == 'pusat'){
                                                echo "  <option></option>";

                                                 $subdomain = $this->model_app->view_ordering('subdomain','nama_cabang','ASC');
                                                }else if($status == 'kabupaten'){
                                                    echo " <option></option>";
                                                 $subdomain = $this->db->query("SELECT * FROM subdomain WHERE kabupaten = '".$kabupaten."' AND (status = 'kelurahan' OR status = 'kecamatan' OR status ='kabupaten' )")->result_array();
                                                }else if($status == 'kecamatan'){
                                                     echo "  <option></option>";
                                                     $subdomain = $this->db->query("SELECT * FROM subdomain WHERE kecamatan = '".$kecamatan."' AND (status = 'kelurahan' OR status ='kecamatan')")->result_array();
                                                }else if($status == 'kelurahan'){
                                                     $subdomain = $this->db->query("SELECT * FROM subdomain WHERE kelurahan = '".$kelurahan."' AND status = 'kelurahan' ")->result_array();
                                                }
                    
                       
                                                 foreach ($subdomain as $sd) {
                                                            if ($sd['id_sd']==$row['id_sd']){
                                                            echo "<option value='$sd[id_sd]' selected>$sd[nama_cabang]</option>";
                                                             }else{
                                                             echo "<option value='$sd[id_sd]'>$sd[nama_cabang]</option>";
                                                             }
                                                      }

                                                      ?>
                                        </select>
                                    
                                 </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Password</label>
                                           <input type="password" name="password" class="form-control">
                                       </div>
                                   </div>
                                  
                                   
                                   <input type="hidden" name="old" value="<?= $row[foto_profile]?>">

                                   <div class="col-md-12">
                                       <input type="submit" name="submit" value="UBAH" class="btn btn-primary w-100">
                                   </div>
                               </div>
                            </form>
                        </div>
                    </div>


                  </div>
                </div>
