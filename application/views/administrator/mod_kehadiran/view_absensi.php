  
                <form action="<?= base_url('administrator/absensi')?>" method="post">
                   <div class="row pt-3 pb-3">
                     <div class="col-md-4">
                        <label class="sr-only" for="inlineFormInputGroup">Start Date</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Start</div>
                            </div>
                            <input type="date" name="start" class="form-control" id="inlineFormInputGroup" value="<?= $start?>">
                          </div>
                     </div>
                        <div class="col-md-4">
                        <label class="sr-only" for="inlineFormInputGroup">End Date</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">End</div>
                            </div>
                            <input type="date" name="end" class="form-control" id="inlineFormInputGroup" value="<?= $end?>">
                          </div>
                     </div>
                      <div class="col-md-4">
                        <label class="sr-only" for="inlineFormInputGroup">Telat</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Telat</div>
                            </div>
                            <select name="telat" class="form-control">
                              <option value="all" <?php if($telat == 'all'){echo"selected";}?>>Semua</option>
                              <option value="y" <?php if($telat == 'y'){echo"selected";}?>>Telat</option>
                              <option value="n" <?php if($telat == 'n'){echo"selected";}?>>Tidak</option>
                              
                            </select>
                          </div>
                     </div>
                     <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">Pulang</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Pulang</div>
                            </div>
                            <select name="pulang" class="form-control">
                               <option value="all" <?php if($pulang == 'all'){echo"selected";}?>>Semua</option>
                              <option value="y" <?php if($pulang == 'y'){echo"selected";}?>>Lebih Awal</option>
                              <option value="n" <?php if($pulang == 'n'){echo"selected";}?>>Tepat Waktu</option>
                              
                            </select>
                          </div>
                     </div>
                      <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">Ket</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Ket</div>
                            </div>
                            <select name="ket" class="form-control">
                               <option value="all" <?php if($ket == 'all'){echo"selected";}?>>Semua</option>
                              <option value="absen" <?php if($ket == 'absen'){echo"selected";}?>>Absen</option>
                              <option value="dinas" <?php if($ket == 'dinas'){echo"selected";}?>>Dinas</option>
                               <option value="tugas" <?php if($ket == 'tugas'){echo"selected";}?>>Tugas</option>
                              
                            </select>
                          </div>
                     </div>
                   
                     <div class="col-md-3">
                        <input type="submit" name="filter" value="Filter" class="btn btn-primary btn-xs w-100">
                     </div>
                   </div>
                   </form>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Absen</h6>
                        </div>
                        <div class="card-body">
                             <?php 
 $id = $this->session->id_session;
 $link = 'administrator/tambahabsen';
  $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
  if($c > 0){
  ?>
                   <div class="my-3"><a href="<?= base_url('administrator/tambahabsen')?>" class="btn btn-primary">Tambah Absen</a></div>

<?php }?>

                          
                                  <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Tanggal</th>
                                            <th>Absen Masuk</th>
                                            <th>Absen Keluar</th>
                                            <th>Keterangan</th>

                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Tanggal</th>
                                            <th>Absen Masuk</th>
                                            <th>Absen Keluar</th>
                                            <th>Keterangan</th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1; foreach($record->result_array() as $row){
                                            if($row['absen_keluar']==NULL){
                                              $keluar = '--:--';
                                            }else{
                                              $keluar = date('H:i',strtotime($row['absen_keluar']));
                                            }
                                          ?>
                                          
                                            <tr class='clickable-row' data-href='<?= base_url('administrator/detailabsen/').$row['id_absensi']?>'>
                                             
                                                <td><?=$no;?></td>
                                                 <td><?= ucfirst($row['nama_lengkap']);?></td>
                                                 <td><?= format_indo($row['tanggal']);?></td>
                                                 <td><?= date('H:i',strtotime($row['absen_masuk'])); ?></td>
                                                 <td><?= $keluar; ?></td>
                                                 <td><?= ucfirst($row['ket'])?></td>
                                               
                                            </tr>
                                           
                                        <?php $no++; }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

<script type="text/javascript">
   jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>