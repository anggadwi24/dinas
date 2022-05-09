<?php 

$foto_peg = $rows['foto'];


?>


                  <p class="mb-4"><a href="<?= base_url('administrator/laporan')?>" class="btn btn-primary">Kembali</a></p>

                  <!-- DataTales Example -->
                  <div class="row mb-4">
                    <div class="col-md-4">
                      <div class="card" >
                        <img class="card-img-top" src="<?= $foto_peg?>" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title"><?= $rows['nama_guru']?></h5>
                           <h6 class="card-subtitle mb-2 text-muted">NIP : <?= $rows['nip']?></h6>
                          <p class="card-text float-right"><?= $rows['email']?></p>
                         
                        </div>
                         <div class="card-footer">
                                <?php 
                           $id = $this->session->id_session;
                         $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/hapusreport'")->num_rows();
                          $u= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/editreport'")->num_rows();
                    ?>
                    <?php if($u > 0){?>
                           <a href="<?= base_url('administrator/laporan/edit?id=').encode($rows[id_report])?>" class="card-link m-2 float-left">Edit Report</a>
                        <?php }?>
                        <?php if($d > 0){?>
                          <a href="<?= base_url('administrator/laporan/hapus?id=').encode($rows[id_report])?>" class="card-link m-2 float-right">Hapus Report</a>
                         <?php }?>
                         
                         
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h3 class="m-0 font-weight-bold text-primary"><?= ucfirst($rows['judul_report'])?></h3>
                            </div>
                            <div class="card-body">
                                  
                               
                                   <div class="row">
                                      <div class="col-md-6">
                                           <div class="form-group">
                                               <h3><?= format_indo($rows['date'])?></h3>
                                               <label>Tanggal</label>
                                           </div>
                                       </div>
                                       <div class="col-md-2">
                                           <div class="form-group">
                                               <h3><?= date('H:i',strtotime($rows['start']))?></h3>
                                               <label>Dari</label>
                                           </div>
                                       </div>
                                       <div class="col-md-2">
                                           <div class="form-group">
                                               <h3><?= date('H:i',strtotime($rows['end']))?></h3>
                                               <label>Sampai</label>
                                           </div>
                                       </div>
                                       <div class="col-md-2">
                                           <div class="form-group">
                                               <h3><?= $rows['jam_kerja']?></h3>
                                               <label>Total Jam</label>
                                           </div>
                                       </div>
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <h5>Keterangan Report</h5>
                                                <?= $rows['report']?>
                                               
                                           </div>
                                       </div>
                                     <?php
                 
                      if ($rows['foto_masuk']==''){
                         ?>
                         <div class="card col-6" style="width: 18rem;">
                          <div class="form-group">
                            <label>Foto Masuk</label>
                            <img class="card-img-top" src="<?= base_url('asset/foto_report/no-image.jpg')?>" alt="Card image cap">
                            </div>
                          </div>
                         <?php
                         }else{
                         ?>
                      
                       
                           <div class="card col-6" style="width: 18rem;">
                             <div class="form-group">
                            <label>Foto Masuk</label>
                            <img class="card-img-top" src="<?= $rows['foto_masuk']?>" alt="Card image cap">
                          </div>
                           </div>
                        <?php }?>
         
           <?php
               
                      if ($rows['foto_keluar']==''){
                         ?>
                         <div class="card col-6" style="width: 18rem;">
                          <div class="form-group">
                            <label>Foto Keluar</label>
                            <img class="card-img-top" src="<?= base_url('asset/foto_report/no-image.jpg')?>" alt="Card image cap">
                            </div>
                          </div>
                         <?php
                         }else{
                         ?>
                      
                       
                           <div class="card col-6" style="width: 18rem;">
                             <div class="form-group">
                            <label>Foto Keluar</label>
                            <img class="card-img-top" src="<?= $rows['foto_keluar']?>" alt="Card image cap">
                          </div>
                           </div>
                        <?php }?>
                    
          
                              
                                   </div>
                              
                            </div>
                        </div>
                     </div>
                  </div>