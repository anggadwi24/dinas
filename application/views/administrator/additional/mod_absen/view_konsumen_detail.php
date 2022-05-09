      <div class='col-md-12'>
              <dixv class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Konsumen</h3>
                  <a class='pull-right btn btn-warning btn-sm' href='<?php echo base_url(); ?>administrator/konsumen'>Kembali</a>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#profile' id='profile-tab' role='tab' data-toggle='tab' aria-controls='profile' aria-expanded='true'>Data Konsumen </a></li>
                      <li role='presentation' class=''><a href='#keuangan' role='tab' id='keuangan-tab' data-toggle='tab' aria-controls='keuangan' aria-expanded='false'>History Transaksi Belanja</a></li>
                      <li role='presentation' class=''><a href='#tebak' role='tab' id='tebak-tab' data-toggle='tab' aria-controls='tebak' aria-expanded='false'>Tebak Angka</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='profile' aria-labelledby='profile-tab'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <?php 
                              if (trim($rows['foto'])==''){ $foto_user = 'blank.png'; }else{ $foto_user = $rows['foto']; } ?>
                              <tr bgcolor='#e3e3e3'><th rowspan='14' width='110px'><center><?php echo "<img style='border:1px solid #cecece; height:85px; width:85px' src='".base_url()."asset/foto_user/$foto_user' class='img-circle img-thumbnail'>"; ?></center></th></tr>
                              <tr><th width='130px' scope='row'>Username</th> <td><?php echo $rows['username']?></td></tr>
                              <tr><th scope='row'>Password</th> <td>xxxxxxxxxxxxxxx</td></tr>
                              <tr><th scope='row'>Nama Lengkap</th> <td><?php echo $rows['nama_lengkap']?></td></tr>
                              <tr><th scope='row'>Alamat Email</th> <td><?php echo $rows['email']?></td></tr>
                              <tr><th scope='row'>No Hp</th> <td><?php echo $rows['no_hp']?></td></tr>
                              <tr><th scope='row'>Jenis Kelamin</th> <td><?php echo $rows['jenis_kelamin']?></td></tr>
                              <tr><th scope='row'>Tanggal Lahir</th> <td><?php echo tgl_indo($rows['tanggal_lahir']); ?></td></tr>
                              <tr><th scope='row'>Alamat</th> <td><?php echo $rows['alamat_lengkap']?></td></tr>
                              <tr><th scope='row'>Kecamatan</th> <td><?php echo $rows['kecamatan']?></td></tr>
                              <tr><th scope='row'>Propinsi</th> <td><?php echo $rows['propinsi']?></td></tr>
                              <tr><th scope='row'>Kota</th> <td><?php echo $rows['kota']?></td></tr>
                              <tr><th scope='row'>Tanggal Daftar</th> <td><?php echo tgl_indo($rows['tanggal_daftar']); ?></td></tr>
                            </tbody>
                            </table>
                          </div>
                          <div style='clear:both'></div>
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='keuangan' aria-labelledby='keuangan-tab'>
                          <div class='col-md-12'>
                            <table id="example1" class='table table-hover table-condensed'>
                              <thead>
                                <tr>
                                  <th width="20px">No</th>
                                  <th>Kode Transaksi</th>
                                  <th>Nama Reseller</th>
                                  <th>Total Belanja</th>
                                  <th>Status</th>
                                  <th>Waktu Transaksi</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  $no = 1;
                                  foreach ($record->result_array() as $row){
                                  if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; }elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; }else{ $proses = '<i class="text-info">Konfirmasi</i>'; }
                                  $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                                  echo "<tr><td>$no</td>
                                            <td>$row[kode_transaksi]</td>
                                            <td>$row[nama_reseller]</td>
                                            <td style='color:red;'>Rp ".rupiah($total['total'])."</td>
                                            <td>$proses</td>
                                            <td>$row[waktu_transaksi]</td>
                                         </tr>";
                                    $no++;
                                  }
                                ?>
                              </tbody>
                            </table>
                          </div>
                      </div>
                       <div role='tabpanel' class='tab-pane fade' id='tebak' aria-labelledby='tebak-tab'>
                          <div class='col-md-12'>
                           <?php 


                                                         // kadang ada penulisan no hp 0811 239 345
                                 $nohp = str_replace(" ","",$rows['no_hp']);
                                 // kadang ada penulisan no hp (0274) 778787
                                 $nohp = str_replace("(","",$rows['no_hp']);
                                 // kadang ada penulisan no hp (0274) 778787
                                 $nohp = str_replace(")","",$rows['no_hp']);
                                 // kadang ada penulisan no hp 0811.239.345
                                 $nohp = str_replace(".","",$rows['no_hp']);
                             
                                 // cek apakah no hp mengandung karakter + dan 0-9
                                 if(!preg_match('/[^+0-9]/',trim($nohp))){
                                     // cek apakah no hp karakter 1-3 adalah +62
                                     if(substr(trim($nohp), 0, 3)=='62'){
                                         $hp = trim($nohp);
                                     }
                                     // cek apakah no hp karakter 1 adalah 0
                                     elseif(substr(trim($nohp), 0, 1)=='0'){
                                         $hp = '62'.substr(trim($nohp), 1);
                                     }
                                 }

                           ?>
                            <table  class='table table-hover table-responsive'>
                              <thead>
                                <tr>
                                  <th width="100px">Tebak Angka</th>
                                  <th>Tebakan</th>
                                  <th>Tanggal</th>
                                  <th>Jam</th>
                                  <th>Angka</th>
                                  <th>Waktu Tebak</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $no=1; 
                                  foreach($twoangka as $two){ ?>
                                  
                                  <tr>
                                    <td><?= $two['status'];?> Angka </td>
                                    <td><?= $two['tebak']?></td>
                                    <td><?= $two['date']?></td>
                                    <td><?= $two['start'].' - '.$two['end']?></td>
                                    <td><?= $two['angka']?></td>
                                    <td><?= $two['time']?></td>
                                    <td><?php if($two['tebak'] == $two['angka']){?> 
                                     
                                      <span class='label label-success'>Tebakan benar | Whatsapp </span>

                                      <?php }else{echo "<span class='label label-danger'>Tebakan salah</span>";}?></td>
                                    <td>  
                                    <?php if($two['tebak'] == $two['angka']){?>
                                    <a href="https://wa.me/<?=$hp?>" target="blank">

                                     <span class='label label-success'> Whatsapp </span> </a>
                                    <?php }?>
                                  </td>
                                  </tr>
                               
                              <?php $no++; } ?>
                              </tbody>
                            </table>
                         
                          </div>
                      </div>

                    </div>
                  </div>
                </div>
            </div>
    