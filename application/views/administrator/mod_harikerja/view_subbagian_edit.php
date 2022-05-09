  <h1 class="h3 mb-2 text-gray-800">Sub Bagian</h1>
                    <p class="mb-4"><a href="<?= base_url('administrator/sub_bagian')?>" class="btn btn-primary">Kembali</a></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Sub Bagian</h6>
                        </div>
                        <div class="card-body">
                               <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
                            <form action="<?= base_url('administrator/sub_bagian/edit')?>" method="post">
                               <div class="row">
                                 <input type="hidden" name="id" class="form-control" value="<?= $rows['id_sub_bagian']?>" required>
                                <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Bagian</label>
                                           <select name="bagian" class="form-control">
                                             <?php foreach($bagian->result_array() as $row){
                                              if($rows['id_bagian'] == $row['id_bagian']){
                                                echo "<option value='".$row['id_bagian']."' selected>".$row['nama_bagian']."</option>";
                                              }else{
                                                echo "<option value='".$row['id_bagian']."' >".$row['nama_bagian']."</option>";
                                              }
                                             }?>

                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Nama Sub Bagian</label>
                                           <input type="text" name="nama_sub_bagian" class="form-control" value="<?= $rows['nama_sub_bagian']?>" required>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Kepala Sub Bagian</label>
                                           <input type="text" name="kepala_sub_bagian" class="form-control" value="<?= $rows['kepala_sub_bagian']?>"  required>
                                       </div>
                                   </div>
                          

                                   <div class="col-md-12">
                                       <input type="submit" name="submit" value="EDIT" class="btn btn-primary">
                                   </div>
                               </div>
                            </form>
                        </div>
                    </div>
