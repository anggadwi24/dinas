            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Music</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_music'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Music</th>
                        <th >Link </th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    echo "<tr><td>$no</td>
                              <td>$row[music]</td>
                              <td><a href='".base_url('asset/music')."/$row[link]'>$row[link]</a></td>
                              <td>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_music/$row[id_music]/$row[link]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>