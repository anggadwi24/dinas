  <?php $bag = $this->db->query("SELECT * FROM bagian a JOIN sub_bagian b ON a.id_bagian = b.id_bagian WHERE b.id_sub_bagian = $rows[sub_bagian]  ")->row_array();

  if (!file_exists("asset/foto_user/$rows[foto_profile]") OR $rows['foto_profile']==''){
                    $foto_peg = base_url('asset/foto_user/blank.png');
                  }else{
                    $foto_peg = base_url('asset/foto_user/').$rows['foto_profile'];
                  }


  ?>

  <h1 class="h3 mb-2 text-gray-800">Edit Report</h1>
                    <p class="mb-4"><a href="<?= base_url('administrator/report')?>" class="btn btn-primary">Kembali</a></p>

                    <!-- DataTales Example -->
                    <div class="row">
                      <div class="col-md-4">
                        <div class="card" >
                          <img class="card-img-top" src="<?= $foto_peg?>" alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title"><?= $rows['nama_lengkap']?></h5>
                             <h6 class="card-subtitle mb-2 text-muted">No KTP : <?= $rows['no_ktp']?></h6>
                            <p class="card-text float-right"><?= $bag['nama_sub_bagian']?></p>
                           
                          </div>
                         
                        </div>
                      </div>
                      <div class="col-md-8">
                          <div class="card shadow mb-4">
                              <div class="card-header py-3">
                                  <h3 class="m-0 font-weight-bold text-primary">Edit Report</h3>
                              </div>
                              <div class="card-body">
                                   
                                 <form method="post" action="<?= base_url('administrator/editreport')?>">
                                     <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Judul</label>
                                        <input type="text" name="judul_report" class="form-control" required value="<?= $rows['judul_report']?>">
                                        <input type="hidden" name="id" class="form-control" required value="<?= $rows['id_report']?>">
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" name="date" class="form-control" readonly value="<?= $rows['date']?>">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Dari</label>
                                        <input type="time" name="start" class="form-control" required value="<?= $rows['start']?>">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Dari</label>
                                        <input type="time" name="end" class="form-control" required value="<?= $rows['end']?>">
                                      </div>
                                    </div>
                                     <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" name="report" required><?= $rows['report']?></textarea>
                                      </div>

                                    </div>
                                  
                                         <div class="col-md-12">
                                           <input type="submit" name="submit" value="Ubah" class="btn btn-primary float-right">
                                         </div>

                                     </div>
                                </form>
                              </div>
                          </div>
                       </div>
                    </div>