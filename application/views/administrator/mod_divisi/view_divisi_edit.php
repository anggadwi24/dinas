  
                    <p class="mb-4"><a href="<?= base_url('administrator/bagian')?>" class="btn btn-primary">Kembali</a></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Bidang</h6>
                        </div>
                        <div class="card-body">
                               <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
                            <form action="<?= base_url('administrator/bagian/edit')?>" method="post">
                               <div class="row">
                                <input type="hidden" name="id" class="form-control" value="<?= $row[id_bagian]?>" required>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Nama Bagian</label>
                                           <input type="text" name="nama_bagian" class="form-control" value="<?= $row[nama_bagian]?>" required>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Kepala Bagian</label>
                                           <input type="text" name="kepala_bagian" class="form-control"  value="<?= $row[kepala_bagian]?>" required>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>NIP Kepala Bagian</label>
                                           <input type="text" name="nip" class="form-control"  value="<?= $row[nip]?>" required>
                                       </div>
                                   </div>
                          

                                   <div class="col-md-12">
                                       <input type="submit" name="submit" value="UBAH" class="btn btn-primary">
                                   </div>
                               </div>
                            </form>
                        </div>
                    </div>
