            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Semua Kuis</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <form action="<?= base_url('administrator/detailKuis/').$id?>" method="post">
          
                    <div class="col-lg-10">
                      <select name="konsumen" class="form-control selectpicker" data-live-search="true">
                        <option value="all">All</option>

                        <?php 
                          foreach($pengguna as $k)
                          {
                            if($konsumen == $k['id_konsumen']){
                               echo "<option value='$k[id_konsumen]' selected>$k[nama_lengkap]</option>";
                            }else{
                               echo "<option value='$k[id_konsumen]'>$k[nama_lengkap]</option>";
                            }
                           
                          }
                        ?>
                      </select>
                    </div>
                  
                    <div class="col-lg-2"><input type="submit" name="search" value="Search" class="btn btn-primary"></div>
                    </form>
                  </div>
                  <div class="col-12 mt-5">
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#myModal">TAMBAH POIN</button>
                  </div>
                  <br>
                  <table id="example4" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Benar</th>
                        <th>Salah</th>
                        <th>Poin</th>
                        <th>Jumlah</th>
                        <th>Waktu Selesai</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                      if($row['qp_selesai'] == 'n' )
                      {
                        $selesai = 'Belum Selesai';
                      }else{
                        $selesai = $row['qp_finish'];
                      }
                    echo "<tr><td>$no</td>
                              <td>$row[nama_lengkap]</td>
                              <td>$row[tanggal]</td>
                              <td>$row[qp_benar]</td>
                              <td>$row[qp_salah]</td>
                              <td>$row[qp_poin]</td>
                              <td>$row[qp_status] Soal</td>
                              <td>$selesai</td>
                              
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
                <br>
                
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Poin</h4>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('administrator/addPoin') ?>" method="POST">
        <div class="row">
          <div class="col-lg-12 form-group">
            <label>Pengguna</label>
              <select name="konsumen" class="form-control selectpicker" data-live-search="true" required title="Pilih Pengguna">
                      

                        <?php 
                          foreach($pengguna as $pe)
                          {
                           
                            
                               echo "<option value='$pe[id_konsumen]'>$pe[nama_lengkap]</option>";
                           
                           
                          }
                        ?>
                      </select>
          </div>
           <div class="col-lg-12 form-group">
            <label>Poin</label>
            <input type="number" name="poin" max="100" class="form-control" required value="0"> 
            <input type="hidden" name="qd_id" value="<?= $id ?>">
          </div>
          <div class="col-lg-12">
            <input type="submit" name="submit" class="btn btn-primary " style="width: 100%;" value="TAMBAH">
          </div>

        </div>
        </form>
      </div>
   
    </div>

  </div>
</div>