  
                    <p class="mb-4"><a href="<?= base_url('administrator/report')?>" class="btn btn-primary">Kembali</a></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Report</h6>
                        </div>
                        <div class="card-body">
                               <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
                             <form method="post" action="<?= base_url('administrator/tambahreport')?>" enctype="multipart/form-data">
                               <div class="row">
                                <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Pegawai</label>
                                           <select name="peg" class="form-control">
                                             <?php foreach($peg->result_array() as $row){
                                                $tgl = date('Y-m-d');
                                                $abs = $this->db->query("SELECT * FROM absensi WHERE tanggal='$tgl' AND id_pegawai=$row[id_pegawai]");
                                                if($abs->num_rows()>0){
                                                echo "<option value='".$row['id_pegawai']."'>".$row['nama_lengkap']."</option>";
                                                }
                                             }?>

                                           </select>
                                       </div>
                                   </div>
                                  
                                      <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Judul</label>
                                        <input type="text" name="judul_report" class="form-control" required value="">
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" name="date" class="form-control" readonly value="<?= date('Y-m-d')?>">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Dari</label>
                                        <input type="time" name="start" class="form-control" required value="00:00:00">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Dari</label>
                                        <input type="time" name="end" class="form-control" required value="<?= date('H:i')?>">
                                      </div>
                                    </div>
                                     <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" name="report" required></textarea>
                                      </div>

                                    </div>
                                   
                                   
                                    <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Foto Masuk</label>
                                     
                                       
                                        <input type="file"  class="form-control"  required accept="image/*"  name='file' capture="camera" >
                                       
                                       
                                      </div>
                                     
                                   
                                    </div>
                          
                                    <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Foto Selesai</label>
                                     
                                       
                                        <input type="file"  class="form-control"  required accept="image/*"  name='file1' capture="camera" >
                                       
                                       
                                      </div>
                                     
                                   
                                    </div>
                          

                                   <div class="col-md-12">
                                       <input type="submit" name="submit" value="TAMBAH" class="btn btn-primary">
                                   </div>
                               </div>
                            </form>
                        </div>
                    </div>
