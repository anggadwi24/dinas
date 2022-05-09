  
    <form action="<?= base_url('administrator/lembur')?>" method="post">
                   <div class="row pt-3 pb-3">
                     <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">Start Date</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Tanggal</div>
                            </div>
                            <input type="date" name="hari" class="form-control" id="inlineFormInputGroup" value="<?= $hari?>">
                          </div>
                     </div>
                      <div class="col-md-3">
                        <label class="sr-only" for="inlineFormInputGroup">Start Date</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Sub Bagian</div>
                            </div>
                           <select name="sub" class="form-control" required id="bagian1">
                                              <option value="all" <?php if($sub == 'all'){echo "selected";}?>>All</option>
                                              <?php foreach($sub_bag->result_array() as $div){?>
                                                    <option value="<?= $div[id_sub_bagian]?>" <?php if($sub == $div['id_sub_bagian']){echo "selected";}?>><?= ucfirst($div['nama_sub_bagian'])?></option>
                                              <?php }?>
                                          </select>
                          </div>
                     </div>
                   
                     <div class="col-md-2">
                        <input type="submit" name="filter" value="Filter" class="btn btn-primary btn-xs ">
                     </div>
                   </div>
                   </form>
                

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Lembur</h6>
                        </div>
                        <div class="card-body">
                        
                                  <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Bagian</th>
                                            <th>Sub Bagian</th>
                                            <th>Tanggal</th>
                                           
                                            <th></th>

                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Bagian</th>
                                            <th>Sub Bagian</th>
                                            <th>Tanggal</th>
                                           
                                            <th></th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1; foreach($record->result_array() as $row){

                                              $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$row['sub_bagian']))->row_array();
                                                $bag = $this->model_app->view_where('bagian',array('id_bagian'=>$row['bagian']))->row_array();
                                          
                                          ?>
                                          
                                            <tr >
                                             
                                                <td><?=$no;?></td>
                                                 <td><?= ucfirst($row['nama_lengkap']);?></td>
                                                 <td><?= ucfirst($bag['nama_bagian']);?></td>
                                                  <td><?= ucfirst($sub['nama_sub_bagian']);?></td>
                                                  <td><?= format_indo($row['date'])?></td>
                                                  <td><a href="<?= base_url('administrator/downloadlembur/').sha1($row['id_lembur']).'/'.$row['id_lembur']?>" class="text-primary">Download</a></td>
                                               
                                            </tr>
                                           
                                        <?php $no++; }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

