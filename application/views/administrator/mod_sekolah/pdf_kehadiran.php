<center>  <h1 class="h3 mb-2 text-gray-800">REKAP KEHADIRAN <?= strtoupper($sekolah)?> BULAN  <?= $bulan ?> TAHUN <?= $tahun?></h1></center>
<br>
                                <table width="100%" border="1" >
                                    <thead style="background-color: #5cce5c">
                                        <tr>
                                            <th width="3%" rowspan="2" >NO</th>
                                            <th rowspan="2" width="15%">NAMA</th>
                                            <th rowspan="2" width="10%">SEKOLAH</th>
                                            <th rowspan="2" width="10%">JUMLAH HARI KERJA</th>
                                            <th colspan="3" width="25%"><?= strtoupper(bulan($bulan))?></th>
                                            <th rowspan="2" width="9%">TELAT DATANG</th>
                                            <th rowspan="2" width="9%">CEPAT PULANG</th>
                                            <th rowspan="2" width="10%">JUMLAH KEHADIRAN</th>
                                            <th rowspan="2" width="10%">PERSENTASE</th>
                                          
                                           
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

                                                $hk = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_guru] AND YEAR(tanggal) = '$tahun' AND MONTH(tanggal) = '$bulan' AND status_absen ='guru'")->num_rows();
                                                $tlt = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_guru] AND YEAR(tanggal) = '$tahun' AND MONTH(tanggal) = '$bulan' AND telat='y' AND status_absen ='guru' ")->num_rows();
                                                $cpt = $this->db->query("SELECT * FROM absensi WHERE id_pegawai = $row[id_guru] AND YEAR(tanggal) = '$tahun' AND MONTH(tanggal) = '$bulan' AND pulang_awal='y' AND status_absen ='guru'")->num_rows();


                                                $harikerja = $hari->num_rows();
                                            $ket = 0;
                                             $form = $this->db->query("SELECT * FROM form_izin WHERE MONTH(dari) = '$bulan' AND MONTH(sampai) = $bulan AND YEAR(dari) = '$tahun' AND YEAR(sampai) = $tahun AND id_pegawai = $row[id_guru] AND status_form ='guru'");
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
                                                <td align="center"><?=$no;?></td>
                                                 <td><?= ucfirst($row['nama_guru']);?></td>
                                                 <td align="center"><?= ucfirst($row['nama_cabang']);?></td>
                                                
                                                 <td align="center"><?= $harikerja?></td>
                                                 <td align="center"><?= $hk?></td>
                                                 <td align="center"><?= ($harikerja-$hk)?></td>
                                                 <td align="center"><?= $ket?></td>
                                                 <td align="center"><?= $tlt?></td>
                                                 <td align="center"><?= $cpt?></td>
                                                 <td align="center"><?= $hk?></td>
                                                 <td align="center"><?= $persentase?></td>
                                            </tr>
                                        <?php $no++; }?>
                                    </tbody>
                                </table>
                          