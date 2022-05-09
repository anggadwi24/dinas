  
                <form action="<?= base_url('administrator/report')?>" method="post">
                   <div class="row pt-3 pb-3">
                     <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">Start Time</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Start</div>
                            </div>
                            <input type="date" name="start" class="form-control" id="inlineFormInputGroup" value="<?= $start?>">
                          </div>
                     </div>
                        <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">End Time</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">End</div>
                            </div>
                            <input type="date" name="end" class="form-control" id="inlineFormInputGroup" value="<?= $end?>">
                          </div>
                     </div>
                      
                     <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">Pulang</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Pegawai</div>
                            </div>
                            <select name="pegawai" class="form-control">

                              <option value="all" <?php if($pegawai == 'all'){echo"selected";}?>>Semua</option>
                              <?php foreach($peg->result_array() as $row){

                                    echo "  <option value='$row[id_pegawai]'"; if($pegawai == $row[id_pegawai]){echo'selected';}  echo">$row[nama_lengkap]</option>";

                              }?>
                              
                            </select>
                          </div>
                     </div>
             
                     <div class="col-md-1">
                        <input type="submit" name="filter" value="Filter" class="btn btn-primary btn-xs col-md-12">
                     </div>
                   </div>
                   </form>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Report Pegawai</h6>
                        </div>
                        <div class="card-body">
                             <div class="card-body">
                              <?php 
                             $id = $this->session->id_session;
                             $link = 'administrator/tambahreport';
                              $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
                              if($c > 0){
                              ?>
                                                     <div class="my-3"><a href="<?= base_url('administrator/tambahreport')?>" class="btn btn-primary">Tambah Report</a></div>

                            <?php }?>
                       
                                  <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Judul Report</th>
                                            <th>Tanggal</th>
                                            <th>Dari</th>
                                            <th>Sampai</th>
                                            <th>Jam Kerja</th>

                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Judul Report</th>
                                            <th>Tanggal</th>
                                            <th>Dari</th>
                                            <th>Sampai</th>
                                            <th>Jam Kerja</th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1; foreach($record->result_array() as $row){?>
                                          
                                            <tr class='clickable-row' data-href='<?= base_url('administrator/detailreport/').$row['id_report']?>'>
                                             
                                                <td><?=$no;?></td>
                                                 <td><?= ucfirst($row['nama_lengkap']);?></td>
                                                 <td><?= ucfirst($row['judul_report']);?></td>
                                                 <td><?= format_indo($row['date']);?></td>
                                                 <td><?= date('H:i',strtotime($row['start'])); ?></td>
                                                 <td><?= date('H:i',strtotime($row['end'])); ?></td>
                                                 <td><?= $row['jam_kerja']?> Jam</td>
                                                 </a>
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