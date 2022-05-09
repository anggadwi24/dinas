  <h1 class="h3 mb-2 text-gray-800">Alpha</h1>
                <form action="<?= base_url('administrator/alpha')?>" method="post">
                   <div class="row pt-3 pb-3">
                     <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">Start Date</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Tanggal</div>
                            </div>
                            <input type="date" name="hari" class="form-control" id="inlineFormInputGroup" value="<?= $hari?>">
                          </div>
                     </div>
                      
                    
                     <div class="col-md-5">
                        <label class="sr-only" for="inlineFormInputGroup">Start Date</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Sub Bagian</div>
                            </div>
                           <select name="sub" class="form-control" required id="cabangSub">
                             <option value="all">Semua</option>
                              <?php 
                                if($sub_bag->num_rows() > 0){
                                  foreach($sub_bag->result_array() as $bag){
                                    echo "<option value='".$bag['id_sub_bagian']."'>".$bag['nama_sub_bagian']."</option>";
                                  }
                                }
                              ?>
                                          </select>
                          </div>
                     </div>
                     <div class="col-md-2">
                        <input type="submit" name="filter" value="Filter" class="btn btn-primary btn-xs ">
                     </div>
                   </div>
                   </form>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Alpha  <?= format_indo($hari)?></h6>
                        </div>
                        <div class="card-body">
                         
                                  <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama Lengkap</th>
                                             <th>Bagian</th>
                                            <th>Sub Bagian</th>
                                            <th>Tanggal</th>

                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th width="5%">No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Bagian</th>
                                            <th>Sub Bagian</th>
                                            <th>Tanggal</th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1; foreach($record->result_array() as $row){

                                                $abs = $this->db->query("SELECT * FROM absensi WHERE tanggal='$hari' AND id_pegawai=$row[id_pegawai]");
                                                if($abs->num_rows()<=0){
                                          ?>

                                            <tr>
                                                <td><?=$no?></td>
                                                 <td><?= ucfirst($row['nama_lengkap']);?></td>
                                                 <td><?= ucfirst($row['nama_bagian']);?></td>
                                                 <td><?= ucfirst($row['nama_sub_bagian']);?></td>
                                                 <td><?= format_indo($hari)?></td>
                                                 
                                               
                                            </tr>
                                        <?php } $no++; }?>
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