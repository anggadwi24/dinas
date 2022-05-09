  
                  
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Guru</h6>
                            <?php if($status == 'dinas'){?>
                            <form action="<?= base_url('administrator/lembarKinerjaGuru')?>" method="post">
                                <div class="row mt-5">
                                    <div class="col-8">
                                        <select name="sekolah" id="sekolah" class="form-control">
                                            <option value="all">Semua</option>
                                            <?php 
                                                $sekolah = $this->model_app->view_where('subdomain',array('status'=>'sekolah'));
                                                if($sekolah->num_rows() > 0){
                                                    foreach($sekolah->result_array() as $sch){
                                                        if($cabang == $sch['id_sd']){
                                                            echo "<option value='".encode($sch['id_sd'])."' selected>".$sch['nama_cabang']."</option>";

                                                        }else{
                                                            echo "<option value='".encode($sch['id_sd'])."'>".$sch['nama_cabang']."</option>";

                                                        }
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-primary" name="filter">Filter</button>
                                    </div>
                                </div>
                            </form>
                            <?php }?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered text-center"   >
                                    <thead>
                                        <tr>
                                            <th width="15%" rowspan="2" valign="top">No</th>
                                            <th rowspan="2">Nama Guru</th>
                                            <th rowspan="2">NIP</th>
                                            <th rowspan="2">Sekolah</th>
                                            <th colspan="3">Download PDF</th>
                                            
                                          
                                           
                                        </tr>
                                        <tr>
                                            <th>Harian</th>
                                            <th>Bulanan</th>
                                            <th>Tahunan</th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php $no = 1; foreach($record->result_array() as $row){
                                            
                                            ?>

                                            <tr>
                                                <td><?=$no;?></td>
                                                 <td><?= ucfirst($row['nama_guru']);?></td>
                                                 <td><?= ucfirst($row['nip']);?></td>
                                                 <td><?= ucfirst($row['nama_cabang']);?></td>
                                                 <td><a href="<?= base_url('administrator/lembarKinerjaGuru/harian/').$row['id_guru'].'/'.$row['nama_guru']?>">Download</a></td>
                                                 
                                                  <td><a href="<?= base_url('administrator/lembarKinerjaGuru/bulanan/').$row['id_guru'].'/'.$row['nama_guru']?>">Download</a></td> 
                                                   <td><a href="<?= base_url('administrator/lembarKinerjaGuru/tahunan/').$row['id_guru'].'/'.$row['nama_guru']?>">Download</a></td>
                                            </tr>
                                        <?php $no++; }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
