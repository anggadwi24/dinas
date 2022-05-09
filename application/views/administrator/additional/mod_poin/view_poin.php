            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Tambahan Poin</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_poin'>Tambahkan Poin Tambahan</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Judul</th>
                        <th>Poin</th>
                        <th>Link</th>
                      
                        <th style='width:120px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($poin->result_array() as $row){
                    echo "<tr><td>$no</td>
                              <td>$row[judul]</td>
                              <td>$row[poin]</td>
                              <td><a href='$row[link]' target='_blank'>$row[link]</a></td>
                              
                              <td><center>
                              
                                <a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url()."administrator/edit_poin/$row[id_poin]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_poin/$row[id_poin]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>

              