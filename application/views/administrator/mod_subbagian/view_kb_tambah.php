  
                    <p class="mb-4"><a href="<?= base_url('administrator/kepalabiro')?>" class="btn btn-primary">Kembali</a></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Kepala Biro</h6>
                        </div>
                        <div class="card-body">
                               <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
                            <form action="<?= base_url('administrator/kepalabiro/add')?>" method="post">
                               <div class="row">
                                <div class="col-md-12">
                                      
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Nama</label>
                                           <input type="text" name="nama" class="form-control" required>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Pangkat</label>
                                           <input type="text" name="pangkat" class="form-control" required>
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>NIP</label>
                                           <input type="text" name="nip" class="form-control" required>
                                       </div>
                                   </div>
                          

                                   <div class="col-md-12">
                                       <input type="submit" name="submit" value="TAMBAH" class="btn btn-primary">
                                   </div>
                               </div>
                            </form>
                        </div>
                    </div>
