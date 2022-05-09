  
                    <p class="mb-4"><a href="<?= base_url('administrator/absensi')?>" class="btn btn-primary">Kembali</a></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Absen</h6>
                        </div>
                        <div class="card-body">
                               <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
                             <form method="post" action="<?= base_url('administrator/tambahabsen')?>" enctype="multipart/form-data">
                               <div class="row">
                                <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Desa/Kelurahan</label>
                                          <select name="cabang" class="form-control"  id="cabangPeg">
                              
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
                                   </div>
                                   <div class="col-md-6 form-group">
                                       <label for="">Tanggal</label>
                                       <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d')?>" disabled>
                                   </div>
                                <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Pegawai</label>
                                           <select name="peg" class="form-control selectpicker" data-live-search="true" id="pegCab">
                                            <?php 
                                                if($pegawai->num_rows() > 0){
                                                    foreach($pegawai->result_array() as $peg){
                                                        $cekAbs = $this->model_app->view_where('absensi',array('id_pegawai'=>$peg['id_pegawai'],'tanggal'=>date('Y-m-d')));
                                                        if($cekAbs->num_rows() == 0){
                                                        echo "<option value='".$peg['id_pegawai']."'>".$peg['nama_lengkap']."</option>";

                                                        }
                                                    }
                                                }

                                            ?>

                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Absen Masuk</label>
                                           <input type="time" name="absen_masuk" class="form-control" required value="00:00">
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Absen Keluar</label>
                                           <input type="time" name="absen_keluar" class="form-control" required value="00:00">
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Foto Absen Masuk</label>
                                           <input type="file" name="foto_in"  class="form-control" >
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Foto Absen Keluar</label>
                                           <input type="file" name="foto_out" class="form-control" >
                                       </div>
                                   </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Keterangan</label>
                                          <select name="ket" class="form-control">
                                            <option value="absen">Absen</option>
                                            <option value="dinas">Dinas</option>
                                            <option value="tugas">Tugas</option>
                                            <option value="wfh">Wfh</option>
                                          </select>
                                       </div>
                                   </div>
                          

                                   <div class="col-md-12">
                                       <input type="submit" name="submit" value="TAMBAH" class="btn btn-primary">
                                   </div>
                               </div>
                            </form>
                        </div>
                    </div>
