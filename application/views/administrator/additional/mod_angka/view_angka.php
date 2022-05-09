            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Tebak Angka</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_angka'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Angka</th>
                        <th>Tanggal</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Tipe</th>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    echo "<tr><td>$no</td>
                              <td>$row[angka]</td>
                              <td>$row[date]</td>
                              <td>$row[start]</td>
                              <td>$row[end]</td>
                              <td>$row[status] Angka</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."administrator/edit_angka/$row[id_angka]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_angka/$row[id_angka]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>