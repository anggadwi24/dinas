            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Semua Kuis</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <form action="<?= base_url('administrator/kuis')?>" method="post">
                    <div class="col-lg-5"><label>Bulan</label></div>
                    <div class="col-lg-5"><label>Status</label></div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-5">
                      <select name="bulan" class="form-control">

                        <option value="all">All</option>
                          <?php 

                            for($a=1;$a<=12;$a++){
                              if($a == $bulan){
                                echo  "<option value='".$a."' selected>".bulan($a)."</option>";

                              }else{
                                 echo  "<option value='".$a."'>".bulan($a)."</option>";
                              }
                            }
                          ?>
                      </select>
                    </div>
                     <div class="col-lg-5">
                      <select name="status" class="form-control">
                        <option value="all">All</option>
                        <option value="y" <?php if($status == 'y'){echo "selected";}?>>Aktif</option>
                        <option value="n" <?php if($status == 'n'){echo "selected";}?> >Tidak Aktif</option>

                      </select>
                    </div>
                   
                    <div class="col-lg-2"><input type="submit" name="search" value="Search" class="btn btn-primary"></div>
                    </form>
                  </div>
                  <br>
                  <div class="col-12 mb-3">
                      <a href="<?= base_url('administrator/addKuis') ?>" class="btn btn-primary w-100">TAMBAH/EDIT TANGGAL KUIS</a>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Tanggal</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                       
                        <th>Status</th>
                      
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                      if($row['status'] == 'n' )
                      {
                    
                        $selesai = 'Tidak Aktif';
                        $selesai .= "<br>".$row['alasan'];
                        $start = '--:--';
                        $end = '--:--';
                      }else{
                        $selesai = 'Aktif';
                        $start = date('H:i',strtotime($row['start']));
                        $end = date('H:i',strtotime($row['end']));
                      }
                    echo "<tr><td class='click' data-href='".base_url('administrator/detailKuis/').$row['qd_id']."'>$no</td>
                              <td class='click' data-href='".base_url('administrator/detailKuis/').$row['qd_id']."'>".format_indo_1($row['tanggal'])."</td>
                              <td class='click' data-href='".base_url('administrator/detailKuis/').$row['qd_id']."'>".$start."</td>
                              <td class='click' data-href='".base_url('administrator/detailKuis/').$row['qd_id']."'>".$end."</td>
                              <td class='click' data-href='".base_url('administrator/detailKuis/').$row['qd_id']."'>$selesai</td>
                             
                             
                              
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
                <br>


<script type="text/javascript">
  $( ".click" ).click(function() {
    var href =$(this).attr('data-href');
    window.location = href;
});
</script>
              