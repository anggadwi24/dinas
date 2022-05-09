  <h1 class="h3 mb-2 text-gray-800">Bagian</h1>
                    <p class="mb-4"><a href="<?= base_url('administrator/bagian')?>" class="btn btn-primary">Kembali</a></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Bagian</h6>
                        </div>
                        <div class="card-body">
                               <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
                            <form action="<?= base_url('administrator/bagian/add')?>" method="post">
                               <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Nama Bagian</label>
                                           <input type="text" name="nama_bagian" class="form-control" required>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Kepala Bagian</label>
                                           <input type="text" name="kepala_bagian" class="form-control" required>
                                       </div>
                                   </div>
                          

                                   <div class="col-md-12">
                                       <input type="submit" name="submit" value="TAMBAH" class="btn btn-primary">
                                   </div>
                               </div>
                            </form>
                        </div>
                    </div>
