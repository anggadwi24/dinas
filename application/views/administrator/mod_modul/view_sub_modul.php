
                        <?php 
                             $id = $this->session->id_session;
                             $link = 'administrator/tambah_manajemensubmodul';
                              $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
                               $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/delete_manajemensubmodul'")->num_rows();
                                $u= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/edit_manajemensubmodul'")->num_rows();
                              if($c > 0){
                              ?>
                                                    <p class="mb-4"><a href="<?= base_url('administrator/tambah_manajemensubmodul')?>" class="btn btn-primary">Tambah Data</a></p>

                            <?php }?>
                   


          <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Sub Modul</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="default-datatable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Modul</th>
                        <th>Submodul</th>
                        <th>Link</th>

                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    echo "<tr><td>$no</td>
                              <td>$row[nama_modul]</td>
                              <td>$row[submodul]</td>
                              <td>$row[link]</td>
                             
                             
                              <td><center> ";
                              if($u > 0){
                                echo " <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url().$this->uri->segment(1)."/edit_manajemensubmodul/$row[id_sm]'><i class='feather icon-edit' style='font-size:10px;'></i></a>";
                              }
                              if($d > 0){
                                echo"                               <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_manajemensubmodul/$row[id_sm]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><i class='feather icon-trash' style='font-size:10px;'></i></a> ";
                              }
                               
                                
                                echo "
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>