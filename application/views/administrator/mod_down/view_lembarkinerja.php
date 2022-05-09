  
                  
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Pegawai</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered text-center"   >
                                    <thead>
                                        <tr>
                                            <th width="15%" rowspan="2" valign="top">No KTP</th>
                                            <th rowspan="2">Nama Lengkap</th>
                                            <th rowspan="2">Bagian</th>
                                            <th rowspan="2">Sub Bagian</th>
                                            <th colspan="3">Download PDF</th>
                                            
                                          
                                           
                                        </tr>
                                        <tr>
                                            <th>Harian</th>
                                            <th>Bulanan</th>
                                            <th>Tahunan</th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php $no = 1; foreach($record->result_array() as $row){?>

                                            <tr>
                                                <td><?=$row['no_ktp'];?></td>
                                                 <td><?= ucfirst($row['nama_lengkap']);?></td>
                                                 <td><?= ucfirst($row['nama_bagian']);?></td>
                                                 <td><?= ucfirst($row['nama_sub_bagian']);?></td>
                                                 <td><a href="<?= base_url('administrator/lembarkinerja/harian/').$row['id_pegawai'].'/'.$row['nama_panggilan']?>">Download</a></td>
                                                 
                                                  <td><a href="<?= base_url('administrator/lembarkinerja/bulanan/').$row['id_pegawai'].'/'.$row['nama_panggilan']?>">Download</a></td> 
                                                   <td><a href="<?= base_url('administrator/lembarkinerja/tahunan/').$row['id_pegawai'].'/'.$row['nama_panggilan']?>">Download</a></td>
                                            </tr>
                                        <?php $no++; }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
