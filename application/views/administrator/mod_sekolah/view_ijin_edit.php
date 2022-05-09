<?php

                  $foto_peg = $rows['foto'];
       

                                          $sampai = date('Ymd',strtotime($rows['sampai']));
                                           $dari = date('Ymd',strtotime($rows['dari']));
                                           $diff = abs($sampai - $dari)+1;   
?>


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
                         
                      </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Edit Ijin/Sakit</h6>
                            </div>
                            <div class="card-body">
                                 
                                 <form method="post" action="<?= base_url('administrator/form/edit')?>">
                                   <div class="row">
                                    <input type="hidden" name="id" value="<?= $rows[id_form]?>">
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <input type="date" name="dari" value="<?= $rows[dari]?>" class="form-control" required>
                                               <label>Dari</label>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                              <input type="date" name="sampai" value="<?= $rows[sampai]?>" class="form-control" required>
                                               <label>Sampai</label>
                                           </div>
                                       </div>
                                       
                                        <div class="col-md-12">
                                           <div class="form-group">
                                             
                                   
                                              <textarea class="form-control" name="keterangan" required><?= $rows['keterangan']?></textarea>
                                    
                                               <label>Keterangan</label>
                                           </div>
                                       </div>
                                     <div class="col-md-12 my-3">
                                  
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="Izin" <?php if($rows['status_ket'] == 'Izin'){ echo "checked";}?> >
                                        <label class="form-check-label" for="exampleRadios1">
                                          Ijin
                                        </label>
                                       
                                    </div>
                                     <div class="form-check form-check-inline">
                                     <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="Sakit" <?php if($rows['status_ket'] == 'Sakit'){ echo "checked";}?> >
                                        <label class="form-check-label" for="exampleRadios2">
                                          Sakit
                                        </label>

                                      </div>
                                    </div>
                              
                                     <div class="col-md-12">
                                     <input type="submit" name="submit" value="Ubah" class="btn btn-primary float-right">
                                   </div>
                                   </div>
                                  
                                 </form>
                              
                            </div>
                        </div>
                     </div>
                  </div>