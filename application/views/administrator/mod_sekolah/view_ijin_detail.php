<?php 

$foto_peg = $rows['foto'];


                                          $sampai = date('Ymd',strtotime($rows['sampai']));
                                           $dari = date('Ymd',strtotime($rows['dari']));
                                           $diff = abs($sampai - $dari)+1;   
?>

<h1 class="h3 mb-2 text-gray-800">Detail Ijin/Sakit</h1>
                  <p class="mb-4"><a href="<?= base_url('administrator/form')?>" class="btn btn-primary">Kembali</a></p>

                  <!-- DataTales Example -->
                  <div class="row">
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
                         $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/form/hapus'")->num_rows();
                          $u= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/form/edit'")->num_rows();
                    ?>
                    <?php if($u > 0){?>
                       <a href="<?= base_url('administrator/form/edit?id=').encode($rows[id_form])?>" class="card-link m-2 float-left">Edit Form</a>
                        <?php }?>
                        <?php if($d > 0){?>
                            <a href="<?= base_url('administrator/form/hapus?id=').encode($rows[id_form])?>" class="card-link m-2 float-right">Hapus Form</a>
                         <?php }?>
                          
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Detail Ijin/Sakit</h6>
                            </div>
                            <div class="card-body">
                                 
                               
                                   <div class="row">
                                   
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <h3><?= format_indo($rows['dari']);?></h3>
                                               <label>Dari</label>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <h3><?= format_indo($rows['sampai']);?></h3>
                                               <label>Sampai</label>
                                           </div>
                                       </div>
                                       
                                        <div class="col-md-6">
                                           <div class="form-group">
                                               <h3><?= ucfirst($rows['keterangan'])?></h3>
                                               <label>Keterangan</label>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <h3><?= $diff?></h3>
                                               <label>Hari</label>
                                           </div>
                                       </div>
                                        <div class="col-md-6">
                                           <div class="form-group">
                                               <h3><?= ucfirst($rows['status_ket'])?></h3>
                                               <label>Status</label>
                                           </div>
                                       </div>
                                       
                                       <div class="col-md-12">
                                         <div class="form-group">
                                           <label>Foto</label>
                                           <div class="row">
                                           <?php  $ex = explode(';',$rows['foto_form']);
                                              $hitungex = count($ex);
                                              for($i=0; $i<$hitungex; $i++){
                                              ?>

                                            <div class="col-md-6"><img src="<?= $ex[$i]?>" class="img-fluid"></div>
                                            <?php } ?>
                                          </div>
                                         </div>
                                       </div>
                              

                                   </div>
                              
                            </div>
                        </div>
                     </div>
                  </div>