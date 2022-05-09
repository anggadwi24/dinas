
  <?php 
 $id = $this->session->id_session;
 $link = 'administrator/addRoomClass';
  $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
  if($c > 0){
  ?>
                    <p class="mb-4"><a href="<?= base_url('administrator/addRoomClass')?>" class="btn btn-primary">Tambah Kelas</a></p>

<?php }?>
<?php 
     $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/deleteRoomClass'")->num_rows();
      $u= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/editRoomClass'")->num_rows();
      $det= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/detailRoomClass'")->num_rows();

?>
                    <!-- DataTales Example -->
                    <?php  if($status == 'all' OR $status == 'dinas' OR $status == 'pusat'){?>
                     <form action="<?= base_url('administrator/roomClass')?>" method="post">
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

                                     $subdomain = $this->model_app->view_where_ordering('subdomain',array('status'=>'sekolah'),'nama_cabang','ASC')->result_array();
                                   
        
           
                                     foreach ($subdomain as $sd) {
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
                   <?php }?>
                   
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Kelas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="15%">No </th>
                                            <th>Sekolah</th>
                                            <th>Judul</th>
                                            <th>Matpel / Kelas</th>
                                            <th>Guru</th>
                                           
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; foreach($record->result_array() as $row){
                                                 $sekolah = $this->model_app->view_where('subdomain',array('id_sd'=>$row['rk_id_sd']))->row_array();
                                                 $mapel = $this->model_app->view_where('mata_pelajaran',array('mapel_id'=>$row['rk_mapel']))->row_array();
                                                 $guru = $this->model_app->view_where('guru',array('id_guru'=>$row['rk_id_guru']))->row_array();
                                            ?>

                                            <tr>
                                                <td><?=$no;?></td>
                                            
                                                 <td><?= $sekolah['nama_cabang'] ?></td>
                                                 <td><?= $row['rk_title'] ?></td>
                                                 <td><?= $mapel['mapel'] ?> / <?= $row['rk_kelas'] ?></td>
                                                 <td><?= $guru['nama_guru'] ?></td>




                                               
                                                 
                                                 <td>
                                                 <?php if($det > 0){?>
                                                <a href="<?= base_url('administrator/detailRoomClass?id=').$this->encrypt->encode($row['rk_id'],keys())?>" class="mr-1"><span class="fa fa-eye text-info" ></span></a>
                                                <?php }?> 
                                                <?php if($u > 0){?>
                                                <a href="<?= base_url('administrator/editRoomClass?id=').$this->encrypt->encode($row['rk_id'],keys())?>" class="mr-1"><span class="fa fa-edit text-warning" ></span></a>
                                                <?php }?>
                                                <?php if($d > 0){?>
                                                <a href="<?= base_url('administrator/deleteRoomClass?id=').$this->encrypt->encode($row['rk_id'],keys())?>" class="mr-1"><span class="fa fa-trash text-danger" ></span></a>
                                                <?php }?>

                                                 </td>
                                            </tr>
                                        <?php $no++; }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
