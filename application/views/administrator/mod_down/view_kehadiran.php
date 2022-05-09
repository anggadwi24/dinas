  

                        <form action="<?= base_url('administrator/kehadiran')?>" method="post">
                   <div class="row pt-3 pb-3">
                     <div class="col-md-4">
                        <label class="sr-only" for="inlineFormInputGroup">Start Date</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Bulan</div>
                            </div>
                            <select class="form-control" name="bulan">
                            <?php 
                                foreach($month->result_array() as $m){
                                ?>
                                      <?php if($bulan == $m['bulan']){?>
                                     <option value="<?= $m[bulan]?>" selected ><?= bulan($m[bulan])?></option>
                                 <?php }else{?>
                                    <option value="<?= $m[bulan]?>"  ><?= bulan($m[bulan])?></option>
                                <?php }?>
                                <?php 
                                }
                            ?>
                            </select>
                          </div>
                     </div>
                       
                     
                     <div class="col-md-4">
                        <label class="sr-only" for="inlineFormInputGroup">Pulang</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Tahun</div>
                            </div>
                             <select class="form-control" name="tahun">
                            <?php 
                                foreach($year->result_array() as $y){
                                ?>
                                      <?php if($tahun == $y['tahun']){?>
                                     <option value="<?= $y[tahun]?>" selected ><?= $y[tahun]?></option>
                                 <?php }else{?>
                                    <option value="<?= $y[tahun]?>"  ><?= $y[tahun]?></option>
                                <?php }?>
                                <?php 
                                }
                            ?>
                            </select>
                          </div>
                     </div>
                     <div class="col-md-4">
                        <input type="submit" name="filter" value="Filter" class="btn btn-primary btn-xs">
                     </div>
                   </div>
                   </form>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DATA KEHADIRAN BULAN <?= $bulan ?> TAHUN <?= $tahun?></h6>
                        </div>
                        <div class="card-body">
                            <div class="my-3 d-flex flex-row">
                                <div class="p-2"><a href="<?= base_url('administrator/downloadpdf/').$bulan.'/'.$tahun?>" class="btn btn-primary"><i class="fas fa-file-pdf"></i> DOWNLOAD PDF</a></div>
                                <!-- <div class="p-2"><a href="<?= base_url('administrator/downloadexcel/').$bulan.'/'.$tahun?>" class="btn btn-primary"><i class="fas fa-file-excel"></i> DOWNLOAD EXCEL</a></div> -->
                            </div>
                            <div class="table-responsive1">
                                <table id="example" class="table table-bordered text-center"   >
                                    <thead>
                                        <tr>
                                            <th width="5%" rowspan="2" valign="top">NO</th>
                                            <th rowspan="2">NAMA</th>
                                            <th rowspan="2">BAGIAN</th>
                                            <th rowspan="2">JUMLAH HARI KERJA</th>
                                            <th colspan="3"><?= strtoupper(bulan($bulan))?></th>
                                            <th rowspan="2">TELAT DATANG</th>
                                            <th rowspan="2">CEPAT PULANG</th>
                                            <th rowspan="2">JUMLAH KEHADIRAN</th>
                                            <th rowspan="2">PERSENTASE</th>
                                          
                                           
                                        </tr>
                                        <tr>
                                            <th>HADIR</th>
                                            <th>ALPHA</th>
                                            <th>IZIN/SAKIT</th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php $no = 1; foreach($record->result_array() as $row){?>
                                            <?php 

                                                $hk = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_pegawai] AND YEAR(tanggal) = '$tahun' AND MONTH(tanggal) = '$bulan'")->num_rows();
                                                $tlt = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_pegawai] AND YEAR(tanggal) = '$tahun' AND MONTH(tanggal) = '$bulan' AND telat='y' ")->num_rows();
                                                $cpt = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_pegawai] AND YEAR(tanggal) = '$tahun' AND MONTH(tanggal) = '$bulan' AND pulang_awal='y' ")->num_rows();


                                                $harikerja = $hari->num_rows();
                                            $ket = 0;
                                             $form = $this->db->query("SELECT * FROM form_izin WHERE MONTH(dari) = '$bulan' AND MONTH(sampai) = $bulan AND YEAR(dari) = '$tahun' AND YEAR(sampai) = $tahun AND id_pegawai = $row[id_pegawai]");
                                             if($form->num_rows() > 0){
                                                 foreach($form->result_array() as $f){
                                                    $dari = date('Ymd',strtotime($f['dari']));
                                                    $sampai = date('Ymd',strtotime($f['sampai']));
                                                    if($dari == $sampai){
                                                        $ket += 1;
                                                    }else{
                                                        $ket +=($sampai - $dari)+1;
                                                    }
                                                 }
                                            }
                                            $persentase = round(($hk / $harikerja) * 100,2);

                                            ?>
                                            <tr>
                                                <td><?=$no;?></td>
                                                 <td><?= ucfirst($row['nama_lengkap']);?></td>
                                                 <td><?= ucfirst($row['nama_bagian']);?></td>
                                                
                                                 <td><?= $harikerja?></td>
                                                 <td><?= $hk?></td>
                                                 <td><?= ($harikerja-$hk)?></td>
                                                 <td><?= $ket?></td>
                                                 <td><?= $tlt?></td>
                                                 <td><?= $cpt?></td>
                                                 <td><?= $hk?></td>
                                                 <td><?= $persentase?></td>
                                            </tr>
                                        <?php $no++; }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
