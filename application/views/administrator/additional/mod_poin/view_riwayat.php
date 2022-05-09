            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Riwayat Poin</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Lengkap</th>
                        <th>Tambahan Poin</th>
                        <th>Poin</th>
                        <th>Soal</th>
                        <th>Waktu</th>
                      
                       
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($riwayat->result_array() as $row){
                    $link = base_url('administrator/edit_poin/').$row['id_poin'];
                    echo "<tr><td>$no</td>
                              <td>$row[nama_lengkap]</td>
                          
                              <td><a href='$link' target='_blank'>$row[judul]</a></td>
                              <td>$row[poin]</td>
                              <td>$row[status] Soal</td>
                              <td>$row[waktu]</td>
                              
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>

              