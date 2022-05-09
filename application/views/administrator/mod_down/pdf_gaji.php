    <style type="text/css">
        
    </style>
    <div class="lands">
    <center>
        <h3>DAFTAR HONORARIUM PEGAWAI HONORER/TIDAK TETAP</h3>
        <h3>BIRO UMUM SEKRETARIAT DAERAH PROVINSI SULAWESI BARAT</h3>
        <h3>PADA KEGIATAN <?= strtoupper($nama_kegiatan)?></h3>


    </center>


    <table id="example" class="table table-bordered text-center" border="1" width="100%" >
                                    <thead style="background-color: #5cce5c">
                                        <tr>
                                            <th width="2%" rowspan="2">NO</th>
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
                                            $telat = 0;
                                            $pulang = 0;
                                            $izin = 0;
                                            $ket = 0;
                                            $total_gaji = 0;
                                            $total_dibayar = 0;
                                            foreach ($record->result_array() as $row): 
                                                  $total_gaji += $row['gaji_pokok'];

                                            $telat = $this->model_app->view_where('absensi',array('id_pegawai'=>$row['id_pegawai'],'MONTH(tanggal)'=>$bulan,'YEAR(tanggal)'=>$tahun,'telat'=>'y'))->num_rows();
                                         

                                            $pulang = $this->model_app->view_where('absensi',array('id_pegawai'=>$row['id_pegawai'],'MONTH(tanggal)'=>$bulan,'YEAR(tanggal)'=>$tahun,'pulang_awal'=>'y'))->num_rows();
                                             
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

                                            $pot_cp = ($row['gaji_pokok']*($pulang*0.5))/100;
                                            $pot_td = ($row['gaji_pokok']*($telat*0.5))/100;
                                            $pot_is = ($row['gaji_pokok']*($ket*1.5))/100;
                                            $bolos = 0;
                                            $cek = $this->db->query("SELECT * FROM harikerja  WHERE tanggal <= '$hari' AND bulan = '$bulan' AND tahun = '$tahun' AND status = 'kerja'");
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
                                <?php
                                $pptk = $this->model_app->view_where('pptk',array('id_pptk'=>$sub['id_pptk']))->row_array();
                                $kb = $this->model_app->view_where('kepala_biro',array('id_kb'=>$sub['id_kb']))->row_array();
                                $sub_bag = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$sub['id_sub_bagian']))->row_array();

                                ?>
                                <table width="100%">
                                      <tr>
                                            <td><br></td>
                                            <td><br></td>
                                            <td><br></td>
                                        </tr>
                                          <tr>
                                            <td><br></td>
                                            <td><br></td>
                                            <td><br></td>
                                        </tr>
                                          <tr>
                                            <td><br></td>
                                            <td><br></td>
                                            <td><br></td>
                                        </tr>
                                    
                                </table>
                                <table width="100%" align="center">
                                    <tbody>
                                        <tr>
                                            <td width="33%"></td>
                                            <td width="33%"></td>
                                            <td width="33%">Mamuju, <?= bulan($bulan) ?> <?= $tahun?></td>
                                        </tr>
                                        <tr>
                                            <td>Mengetahui</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><b>KEPALA BIRO UMUM, <br> SETDA PROV.SULBAR</b></td>
                                            <td><b>PEJABAT PELAKSANA TEKHNIS KEGIATAN</b></td>
                                            <td><b>KASUBAG <?= strtoupper($sub_bag['nama_sub_bagian'])?></b></td>
                                        </tr>
                                        <tr>
                                            <td><br></td>
                                            <td><br></td>
                                            <td><br></td>
                                        </tr>
                                        <tr>
                                            <td><br></td>
                                            <td><br></td>
                                            <td><br></td>
                                        </tr>
                                          <tr>
                                            <td><br></td>
                                            <td><br></td>
                                            <td><br></td>
                                        </tr>
                                          <tr>
                                            <td><br></td>
                                            <td><br></td>
                                            <td><br></td>
                                        </tr>
                                          <tr>
                                            <td><br></td>
                                            <td><br></td>
                                            <td><br></td>
                                        </tr>
                                          <tr>
                                            <td><br></td>
                                            <td><br></td>
                                            <td><br></td>
                                        </tr>
                                        <tr>
                                            <td><b><u><?= $kb['nama']?></u></b><br>Pangkat : <?= $kb['pangkat']?><br>Nip : <?= $kb['nip']?></td>
                                            <td><b><u><?= $pptk['nama']?></u></b><br>Pangkat : <?= $pptk['pangkat']?><br>Nip : <?= $pptk['nip']?></td>
                                            <td><b><u><?= $sub_bag['kepala_sub_bagian']?></u></b><br>Pangkat : Kepala Sub Bagian<br></td>

                                        </tr>
                                    </tbody>
                                </table>
                                </div>