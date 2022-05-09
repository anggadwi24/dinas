
                     
                        <?php 
                             $id = $this->session->id_session;
                             $link = 'administrator/tambah_manajemenmodul';
                              $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
                               $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/delete_manajemenmodul'")->num_rows();
                                $u= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/edit_manajemenmodul'")->num_rows();
                              if($c > 0){
                              ?>
                                                    <p class="mb-4"><a href="<?= base_url('administrator/tambah_manajemenmodul')?>" class="btn btn-primary">Tambah Data</a></p>

                            <?php }?>
                    


          <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Modul</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="default-datatable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Modul</th>
                        <th>Icon</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    echo "<tr><td>$no</td>
                              <td>$row[nama_modul]</td>
                              <td><i class='".$row['icon']."'></i></td>
                             
                             
                              <td><center>
                              ";
                              if($u > 0){
                                echo "<a class='btn btn-success btn-xs' title='Edit Data' href='".base_url().$this->uri->segment(1)."/edit_manajemenmodul/$row[id_modul]'><i class='dripicons-document-edit' style='font-size:10px;'></i></a>";
                              }
                              if($d > 0){
                                echo"                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_manajemenmodul/$row[id_modul]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><i class='dripicons-trash' style='font-size:10px;'></i></a> ";
                              }
                              echo "                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    
<!-- 
        <script type="text/javascript">
// Use any event to append the code
$(document).ready(function() 
{
    var s = document.createElement("script");
    s.type = "text/javascript";
    s.src = "http://scriptlocation/das.js";
    // Use any selector
    $("head").append(s);
});
</script> -->