

                          
                <?php 

                             $id = $this->session->id_session;
                             $u= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/edit_manajemenuser'")->num_rows();
                              $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/delete_manajemenuser'")->num_rows();
                             $link = 'administrator/tambah_manajemenuser';
                              $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
                             ?>
                   


          <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
                        </div>
                        <div class="card-body">
                          <?php  if($c > 0){
                              ?>
                                                     <p class="mb-4"><a href="<?= base_url('administrator/tambah_manajemenuser')?>" class="btn btn-primary">Tambah Data</a></p>

                            <?php }?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="default-datatable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                      
                        <th>Blokir</th>
                        <th>Level</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    if ($row['foto'] == ''){ $foto ='blank.png'; }else{ $foto = $row['foto']; }
                    echo "<tr><td>$no</td>
                              <td>$row[username]</td>
                              <td>$row[nama_lengkap]</td>
                              <td>$row[email]</td>
                             
                              <td>$row[blokir]</td>
                              <td>$row[level]</td>
                              <td><center>
                              ";
                              if($u>0){
                                echo "
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url().$this->uri->segment(1)."/edit_manajemenuser/$row[username]'><span class='feather icon-edit' style='font-size:13px;'></span></a> ";
                            }
                            if($d >0){
                                echo "

                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_manajemenuser/$row[username]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='feather icon-trash' style='font-size:13px;'></span></a>

                                ";
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
