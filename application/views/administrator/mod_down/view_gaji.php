  

                        <form action="<?= base_url('administrator/ampragaji')?>" method="post">
                   <div class="row pt-3 pb-3">
                     <div class="col-md-3">
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
                       
                     
                     <div class="col-md-3">
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
           
                     <div class="col-md-5">
                        <label class="sr-only" for="inlineFormInputGroup">Pulang</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Sub Kegiatan</div>
                            </div>
                             <select class="form-control" name="bagian" id="cabangSubK">
                                <option value="all">All</option>
                                <?php $subkegiatan = $this->model_app->view_where('sub_kegiatan',array('id_sd'=>$cabang));
                                if($subkegiatan->num_rows() > 0){
                                    foreach($subkegiatan->result_array() as $subk){
                                      if($subl['id_sub_kegiatan'] == $sk){
                                     echo "<option value='".$subk['id_sub_kegiatan']."' selected>".$subk['nama_kegiatan']."</option>";

                                      }else{
                                     echo "<option value='".$subk['id_sub_kegiatan']."'>".$subk['nama_kegiatan']."</option>";

                                      }
                                    }
                                }?>
                            
                            </select>
                          </div>
                     </div>
                     
                      
                     <div class="col-md-1">
                        <input type="submit" name="filter" value="Filter" class="btn btn-primary btn-xs">
                     </div>
                   </div>
                   </form>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">AMPRA GAJI BULAN <?= strtoupper(bulan($bulan))?> TAHUN <?= $tahun?></h6>
                        </div>
                        <div class="card-body">
                            <div class="my-3 d-flex flex-row">
                                <div class="p-2"><a href="<?= base_url('administrator/pdf_gaji/').$hari.'/'.$bulan.'/'.$tahun.'/'.$bagian.'/'.$cabang?>" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> DOWNLOAD PDF</a></div>
                                <div class="p-2"><a href="<?= base_url('administrator/print_gaji/').$hari.'/'.$bulan.'/'.$tahun.'/'.$bagian.'/'.$cabang?>" class="btn btn-primary" target="_BLANK"><i class="fa fa-file-o"></i> PRINT</a></div>
                               <div class="p-2"><a href="<?= base_url('administrator/excel_gaji/').$hari.'/'.$bulan.'/'.$tahun.'/'.$bagian.'/'.$cabang?>" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> DOWNLOAD EXCEL</a></div>
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered text-center"   >
                                    <thead>
                                        <tr>
                                            <th width="5%" rowspan="2">NO</th>
                                            <th rowspan="2">NAMA</th>
                                            <th rowspan="2">JUMLAH</th>
                                            <th rowspan="2">BULAN</th>
                                            <th colspan="3">TELAT DATANG</th>
                                            <th colspan="3">CEPAT PULANG</th>
                                            <th colspan="3">IZIN / SAKIT</th>
                                            <th colspan="3">ALPHA </th>
                                            <th >PERSENTASE POTONGAN</th>
                                            <th >JUMLAH POTONGAN</th>
                                            <th >TOTAL DIBAYARKAN</th>
                                            <th rowspan="2">TANDA TANGAN</th>
                                          
                                           
                                        </tr>
                                        <tr>
                                            <th><i>Jml</i></th>
                                            <th><i>0,5%</i></th>
                                            <th><i>Potongan (Rp)</i></th>

                                             <th><i>Jml</i></th>
                                            <th><i>0,5%</i></th>
                                            <th><i>Potongan (Rp)</i></th>

                                             <th><i>Jml</i></th>
                                            <th><i>1,5%</i></th>
                                            <th><i>Potongan (Rp)</i></th>

                                             <th><i>Jml</i></th>
                                            <th><i>4,5%</i></th>
                                            <th><i>Potongan (Rp)</i></th>

                                            <th><i>( % )</i></th>
                                            <th><i>( Rp )</i></th>
                                            <th><i>( Rp )</i></th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php $no=1; 
                                            
                                            $pulang = 0;
                                            $izin = 0;
                                          
                                            $total_gaji = 0;
                                            $total_dibayar = 0;

                                            foreach ($record->result_array() as $row): 
                                             $total_gaji += $row['gaji_pokok'];


                                            $telat = $this->model_app->view_where('absensi',array('id_pegawai'=>$row['id_pegawai'],'MONTH(tanggal)'=>$bulan,'YEAR(tanggal)'=>$tahun,'telat'=>'y'))->num_rows();
                                         

                                            $pulang = $this->model_app->view_where('absensi',array('id_pegawai'=>$row['id_pegawai'],'MONTH(tanggal)'=>$bulan,'YEAR(tanggal)'=>$tahun,'pulang_awal'=>'y'))->num_rows();
                                             
                                             $form = $this->db->query("SELECT * FROM form_izin WHERE MONTH(dari) = '$bulan' AND MONTH(sampai) = $bulan AND YEAR(dari) = '$tahun' AND YEAR(sampai) = $tahun AND id_pegawai = $row[id_pegawai] AND approved='setuju' ");
                                               $ket = 0;
                                             if($form->num_rows() > 0){
                                                 foreach($form->result_array() as $f){
                                                    $dari = date('Ymd',strtotime($f['dari']));
                                                    $sampai = date('Ymd',strtotime($f['sampai']));
                                                    if($dari == $sampai){
                                                        $ket += 1;
                                                    }else{
                                                        $ket += ($sampai - $dari)+1;
                                                    }
                                                 }
                                            }
                                           

                                            $pot_cp = ($row['gaji_pokok']*($pulang*0.5))/100;
                                            $pot_td = ($row['gaji_pokok']*($telat*0.5))/100;
                                            $pot_is = ($row['gaji_pokok']*($ket*1.5))/100;
                                           
                                            $cek = $this->db->query("SELECT * FROM harikerja  WHERE tanggal <= '$hari' AND bulan = '$bulan' AND tahun = '$tahun' AND status = 'kerja'");
                                            $bolos = 0;
                                            foreach($cek->result_array() as $c)
                                            {
                                                $tgl = $c['tanggal'];
                                                $bln = $c['bulan'];
                                                $thn = $c['tahun'];
                                                $all = $thn.'-'.$bln.'-'.$tgl;
                                                $date = date('Y-m-d',strtotime($all));
                                            
                                                
                                                $abs = $this->db->query("SELECT * FROM absensi WHERE tanggal = '$date' AND id_pegawai = $row[id_pegawai]");
                                                
                                                if($abs->num_rows() > 0){
                                                    $bolos += 0;
                                                 
                                                }else{
                                                    $bolos += 1;
                                                  
                                                }
                                            }

                                            $pot_bol = ($row['gaji_pokok']*($bolos*4.5))/100;
                                            $pot_all = $pot_td + $pot_cp + $pot_is + $pot_bol;
                                            $dibayar = $row['gaji_pokok'] - $pot_all;
                                            $total_dibayar += $dibayar;
                                        ?>
                                            <tr>
                                                <td><?= $no;?></td>
                                                <td><?= $row['nama_lengkap']?></td>
                                                <td><?= rupiah($row['gaji_pokok'])?></td>
                                                <td><?= bulan($bulan)?></td>
                                                <td><?= $telat?></td>
                                                <td><?= $telat*0.5;?>%</td>
                                                <td><?= rupiah($pot_td) ?></td>
                                                <td><?= $pulang?></td>
                                                <td><?= $pulang*0.5?>%</td>
                                                <td><?= rupiah($pot_cp)?></td>
                                                <td><?= $ket?></td>
                                                <td><?= $ket*1.5?>%</td>
                                                <td><?= rupiah($pot_is)?></td>
                                                <td><?= $bolos;?></td>
                                                <td><?= $bolos*4.5?>%</td>
                                                <td><?= rupiah($pot_bol)?></td>
                                                <td><?= ($telat*0.5)+($pulang*0.5)+($ket*1.5)+($bolos*4.5)?>%</td>
                                                <td><?= rupiah($pot_all)?></td>
                                                <td><?= rupiah($dibayar)?></td>
                                                <td><?php if($no%2 != 0){echo $no.' ............';}else{echo '............ '.$no;}?></td>
                                            </tr>
                                        <?php $no++; 
                                            endforeach ?>
                                      <tr>
                                        <td colspan="2"><b>Jumlah</b></td>
                                        <td><?= rupiah($total_gaji) ?></td>
                                        <td colspan="15"></td>
                                        <td><?= rupiah($total_dibayar)?></td>
                                        <td></td>
                                      </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
