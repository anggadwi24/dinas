            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Semua Kuis</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <form action="<?= base_url('administrator/kuis')?>" method="post">
                    <div class="col-lg-3"><input type="date" name="start" value="<?= date('Y-m-d')?>" class="form-control"></div>
                    <div class="col-lg-3"><input type="date" name="end" value="<?= date('Y-m-d')?>" class="form-control"></div>
                    <div class="col-lg-2">
                      <select name="konsumen" class="form-control">
                        <option value="all">All</option>

                        <?php 
                          foreach($konsumen->result_array() as $k)
                          {
                            echo "<option value='$k[username]'>$k[nama_lengkap]</option>";
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-lg-2">
                        <select name="status" class="form-control">
                         
                          <option value="50">50 Soal</option>
                          <option value="80">80 Soal</option>
                          <option value="100">100 Soal</option>
                        </select>
                    </div>
                    <div class="col-lg-1"><input type="submit" name="search" value="Search" class="btn btn-primary"></div>
                    </form>
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
                    foreach ($kuis->result_array() as $row){
                      if($row['qp_selesai'] == 'n' )
                      {
                        $selesai = 'Belum Selesai';
                      }else{
                        $selesai = $row['qp_finish'];
                      }
                    echo "<tr><td>$no</td>
                              <td>$row[nama_lengkap]</td>
                              <td>$row[qp_date]</td>
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
                <center><h2>Leaderboard | <?= $start.' - '.$end ?> || <?= $status ?> SOAL</h2></center>
                <table id="example4" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama</th>
                      
                        <th>Total Poin</th>
         
                        
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($board->result_array() as $row){
                      
                    echo "<tr><td>$no</td>
                              <td>$row[nama_lengkap]</td>
                             
                              <td>$row[totalp]</td>
                              
                              
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>