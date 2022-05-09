            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Absen</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <form action="<?= base_url('administrator/absen')?>" method="post">
                    <div class="col-lg-3"><input type="date" name="start" value="<?= date('Y-m-d')?>" class="form-control"></div>
                    <div class="col-lg-3"><input type="date" name="end" value="<?= date('Y-m-d')?>" class="form-control"></div>
                    <div class="col-lg-3">
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
                    <div class="col-lg-3"><input type="submit" name="search" value="Search" class="btn btn-primary"></div>
                    </form>
                  </div>
                  <br>
                  <table id="example4" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Lengkap</th>
                        <th>Absen</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($absen->result_array() as $row){
                    echo "<tr><td>$no</td>
                              <td>$row[nama_lengkap]</td>
                              <td>$row[date] - $row[absen_in]</td>
                              
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
                <hr>
                <center><h3>Leaderboard Bulan <?= date('F')?></h3></center>
                <table id="example4" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Absen</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($board->result_array() as $br){
                    echo "<tr>
                              <td>$no</td>
                              <td>$br[nama]</td>
                              <td>$br[total] x absen</td>
                              
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>