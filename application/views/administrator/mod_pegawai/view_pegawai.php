  
  <?php 
 $id = $this->session->id_session;
 $link = 'administrator/pegawai/add';
  $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
  if($c > 0){
  ?>
                    <p class="mb-4"><a href="<?= base_url('administrator/pegawai/add')?>" class="btn btn-primary">Tambah Pegawai</a></p>

<?php }?>
<?php 
     $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/pegawai/hapus'")->num_rows();
      $u= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/pegawai/edit'")->num_rows();
?>
                    <!-- DataTales Example -->
                    
                     <form action="<?= base_url('administrator/pegawai')?>" method="post">
                   <div class="row pt-3 pb-3">
                     
                     <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">Start Date</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Bagian</div>
                            </div>
                         <select name="bagian" class="form-control"  id="bagian1">
                            <option value="all">Semua</option>
                                 <?php $bg = $this->model_app->view_where('bagian',array('id_sd'=>$cabang));?>
                                 <?php 

                                 
                                    foreach($bg->result_array() as $div){?>
                                               <?php if($div[id_bagian] == $bagian){?>
                                                     <option value="<?= $div[id_bagian]?>" selected><?= ucfirst($div['nama_bagian'])?></option>
                                                    <?php }else{?>
                                                    <option value="<?= $div[id_bagian]?>"><?= ucfirst($div['nama_bagian'])?></option>
                                                     <?php }?>
                                  <?php }
                              
                              ?>
                              
                            </select>
                          </div>
                     </div>
                    
                      <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">Telat</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Sub Bagian</div>
                            </div>
                          <select name="sub_bagian" class="form-control"  id="sub1">
                                <option value="all">Semua</option>
                                  <?php   $sub_bag = $this->model_app->view_where('sub_bagian',array('id_bagian'=>$bagian));?>
                                <?php 
                                if($sub_bagian != 'all'){
                                foreach($sub_bag->result_array() as $sub){?>
                                      <?php if($sub[id_sub_bagian] == $sub_bagian){?>
                                       <option value="<?= $sub[id_sub_bagian]?>" selected><?= ucfirst($sub['nama_sub_bagian'])?></option>
                                          <?php }else{?>
                                        <option value="<?= $sub[id_sub_bagian]?>"><?= ucfirst($sub['nama_sub_bagian'])?></option>
                                          <?php }?>
                               <?php }} ?>
                              
                            </select>
                          </div>
                     </div>
                     <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">Pulang</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Sub Kegiatan</div>
                            </div>
                          <select name="sub_kegiatan" class="form-control"  id="subkegiatan1">
                                <option value="all">Semua</option>
                                    <?php $sk = $this->model_app->view_where_ordering('sub_kegiatan',array('id_sub_bagian'=>$sub_bagian),'id_sub_kegiatan','DESC');?>
            <?php 
            if($sub_kegiatan != 'all'){
             foreach ($sk->result_array() as $sk) {
                                                if ($sub_kegiatan==$sk['id_sub_kegiatan']){
                                                echo "<option value='$sk[id_sub_kegiatan]' selected>$sk[nama_kegiatan]</option>";
                                                 }else{
                                                 echo "<option value='$sk[id_sub_kegiatan]'>$sk[nama_kegiatan]</option>";
                                                 }
                                          }}
                                          ?>
                            </select>
                          </div>
                     </div>
                  
                     
                 
                     <div class="col-md-1">
                        <input type="submit" name="filter" value="Filter" class="btn btn-primary btn-xs">
                     </div>
                   </div>
                   </form>
                   
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Pegawai</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="15%">No KTP</th>
                                            <th>Nama Lengkap</th>
                                            <th>Bagian</th>
                                            <th>Sub Bagian</th>
                                            <th>Gaji</th>
                                            <th>Desa/Kelurahan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th width="15%">No KTP</th>
                                            <th>Nama Lengkap</th>
                                            <th>Bagian</th>
                                            <th>Sub Bagian</th>
                                            <th>Gaji</th>
                                            <th>Desa/Kelurahan</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1; foreach($record->result_array() as $row){
                                                $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$row['sub_bagian']))->row_array();
                                                $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$row['bagian']))->row_array();
                                            ?>

                                            <tr>
                                                <td><?=$row['no_ktp'];?></td>
                                                 <td><?= ucfirst($row['nama_lengkap']);?></td>
                                                 <td><?= ucfirst($bag['nama_bagian']);?></td>
                                                 <td><?= ucfirst($sub['nama_sub_bagian']);?></td>
                                                 <td><?= rupiah($row['gaji_pokok']);?></td>
                                                 <td><?= $row['nama_cabang']?></td>
                                                 
                                                 <td>
                                                    <?php if($u > 0){?>
                                                <a href="<?= base_url('administrator/pegawai/edit/').$row['id_pegawai']?>" class="mr-1"><span class="fa fa-edit text-warning" style="color: yellow"></span></a>
                                                <?php }?>
                                                <?php if($d > 0){?>
                                                <a href="<?= base_url('administrator/pegawai/hapus/').$row['id_pegawai']?>" class="mr-1"><span class="fa fa-trash text-danger" style="color: red"></span></a>
                                                <?php }?>

                                                 </td>
                                            </tr>
                                        <?php $no++; }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
