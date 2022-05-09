
                       <?php 
                             $id = $this->session->id_session;
                             $link = 'administrator/tambah_manajemencabang';
                              $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
                               $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/delete_manajemencabang'")->num_rows();
                                $u= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/edit_manajemencabang'")->num_rows();
                              if($c > 0){
                              ?>
                                                     <p class="mb-4"><a href="<?= base_url('administrator/tambah_manajemencabang')?>" class="btn btn-primary">Tambah Data</a></p>

                            <?php }?>
                  


          <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Cabang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Subdomain</th>
                        <th>Status</th>
                        <th>Jenis</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                      if($row['status'] == 'pusat'){
                        $lokasi = "Pusat";
                      }else if($row['status'] == 'dinas'){
                        $lokasi = "Dinas";

                      }else if($row['status'] == 'sekolah'){
                       $lokasi = strtoupper($row['jenis_sekolah']);
                      }
                    echo "<tr><td>$no</td>
                              <td>$row[nama_cabang]</td>
                              <td>".ucfirst($row['status'])."</td>
                              <td>$lokasi</td>
                             
                             
                              <td><center> ";
                                if($u > 0){
                                echo " <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url().$this->uri->segment(1)."/edit_manajemencabang/$row[id_sd]'><i class='fa fa-edit' style='font-size:10px;'></i></a>";
                              }
                              if($d > 0){
                                echo"<a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_manajemencabang/$row[id_sd]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><i class='fa fa-trash' style='font-size:10px;'></i></a>";
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