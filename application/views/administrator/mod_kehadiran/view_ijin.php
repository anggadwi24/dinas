  
                <form action="<?= base_url('administrator/ijin')?>" method="post">
                   <div class="row pt-3 pb-3">
                     <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">Start Date</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Dari</div>
                            </div>
                            <input type="date" name="start" class="form-control" id="inlineFormInputGroup" value="<?= $start?>">
                          </div>
                     </div>
                        <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">End Date</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Sampai</div>
                            </div>
                            <input type="date" name="end" class="form-control" id="inlineFormInputGroup" value="<?= $end?>">
                          </div>
                     </div>
                      <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">Telat</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Ijin/Sakit</div>
                            </div>
                            <select name="status" class="form-control">
                               <option value="all" <?php if($status == 'all'){echo"selected";}?>>All</option>
                              <option value="Izin" <?php if($status == 'Izin'){echo"selected";}?>>Ijin</option>
                              <option value="Sakit" <?php if($telat == 'Sakit'){echo"selected";}?>>Sakit</option>
                              
                            </select>
                          </div>
                     </div>
                     
                   
                     <div class="col-md-1">
                        <input type="submit" name="filter" value="Filter" class="btn btn-primary btn-xs">
                     </div>
                   </div>
                   </form>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Ijin / Sakit</h6>
                        </div>
                        <div class="card-body">
                              <?php 
                             $id = $this->session->id_session;
                             $link = 'administrator/ijin_add';
                              $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
                              if($c > 0){
                              ?>
                                                  <div class="my-3"><a href="<?= base_url('administrator/ijin_add')?>" class="btn btn-primary">TAMBAH FORM</a></div>

                            <?php }?>
                        
                                  <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Keterangan</th>
                                            <th>Dari</th>
                                            <th>Sampai</th>
                                            <th>Selama</th>
                                            <th>Status</th>
                                            <th></th>

                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Keterangan</th>
                                            <th>Dari</th>
                                            <th>Sampai</th>
                                            <th>Selama</th>
                                            <th>Status</th>
                                            <th></th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1; foreach($record->result_array() as $row){

                                             $sampai = date('Ymd',strtotime($row['sampai']));
                                             $dari = date('Ymd',strtotime($row['dari']));
                                             $diff = abs($sampai - $dari)+1;   
                                          
                                          ?>
                                          
                                            <tr class='clickable-row' data-href='<?= base_url('administrator/detailform/').$row['id_form']?>'>
                                             
                                                <td><?=$no;?></td>
                                                 <td><?= ucfirst($row['nama_lengkap']);?></td>
                                                 <td><?= ucfirst($row['keterangan']);?></td>
                                                 <td><?= format_indo($row['dari']);?></td>
                                                  <td><?= format_indo($row['sampai']);?></td>
                                                  <td><?= $diff ?> Hari</td>
                                                 <td><?= ucfirst($row['status_ket']);?></td>
                                                 <td><a href="<?= base_url('administrator/downloadform/').sha1($row[id_form]).'/'.$row[id_form]?>" class="btn btn-primary">Download</a></td>
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