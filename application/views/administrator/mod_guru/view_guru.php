
  <?php 
 $id = $this->session->id_session;
 $link = 'administrator/addGuru';
  $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
  if($c > 0){
  ?>
                    <p class="mb-4"><a href="<?= base_url('administrator/guru/add')?>" class="btn btn-primary">Tambah Guru</a></p>

<?php }?>
<?php 
     $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/hapusGuru'")->num_rows();
      $u= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/editGuru'")->num_rows();
?>
                    <!-- DataTales Example -->
                    <?php if($status == 'all' OR $status == 'dinas' OR $status == 'pusat'){ ?>
                     <form action="<?= base_url('administrator/guru')?>" method="post">
                   <div class="row pt-3 pb-3">
                     <div class="col-md-4">
                        <label class="sr-only" for="inlineFormInputGroup">Pulang</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                          <div class="input-group-text">Sekolah</div>
                            </div>
                          <select name="cabang" class="form-control"  id="cabang1">
                              
                                  <?php 
                                    echo "  <option value='all'>Semua</option>";

                                     $subdomain = $this->model_app->view_where_ordering('subdomain',array('status'=>'sekolah'),'nama_cabang','ASC');
                                    
           
                                     foreach ($subdomain->result_array() as $sd) {
                                                if ($sd['id_sd']==$cabang){
                                                echo "<option value='$sd[id_sd]' selected>$sd[nama_cabang]</option>";
                                                 }else{
                                                 echo "<option value='$sd[id_sd]'>$sd[nama_cabang]</option>";
                                                 }
                                          }

                                          ?>
                            </select>
                          </div>
                     </div>
                     
                    
                     
                     
                 
                     <div class="col-md-2">
                        <input type="submit" name="filter" value="Filter" class="btn btn-primary btn-xs">
                     </div>
                   </div>
                   </form>
                   <?php }else{
                      echo "<input type='hidden' name='cabang' value='".$cabang."'>";
                     }?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Guru</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No </th>
                                            <th>NIP</th>
                                            <th>Nama Guru</th>
                                            <th>No HP</th>
                                            <th>Email</th>
                                            <th>Sekolah</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; foreach($record->result_array() as $row){
                                              $sekolah = $this->model_app->view_where('subdomain',array('id_sd'=>$row['id_sd']))->row_array();
                                            ?>

                                            <tr>
                                                <td><?=$no;?></td>
                                                 <td><?= ucfirst($row['nip']);?></td>
                                                 <td><?= ucfirst($row['nama_guru']);?></td>
                                                 <td> <?= $row['hp'];?></td>
                                                 <td> <?= $row['email'];?></td>
                                                 <td> <?= $sekolah['nama_cabang'];?> </td>


                                               
                                                 
                                                 <td>
                                                    <?php if($u > 0){?>
                                                <a href="<?= base_url('administrator/guru/edit?id=').$this->encrypt->encode($row['id_guru'],keys())?>" class="mr-1"><span class="fa fa-edit text-warning" style="color: yellow"></span></a>
                                                <?php }?>
                                                <?php if($d > 0){?>
                                                <a href="<?= base_url('administrator/hapusGuru?id=').$this->encrypt->encode($row['id_guru'],keys())?>" class="mr-1"><span class="fa fa-trash text-danger" style="color: red"></span></a>
                                                <?php }?>

                                                 </td>
                                            </tr>
                                        <?php $no++; }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
