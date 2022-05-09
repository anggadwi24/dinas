      <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Data Tebak Angka</h3>
                  <a class='pull-right btn btn-warning btn-sm' href='<?php echo base_url(); ?>administrator/konsumen'>Kembali</a>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#dua' id='dua-tab' role='tab' data-toggle='tab' aria-controls='dua' aria-expanded='true'>2 Angka </a></li>
                      <li role='presentation' class=''><a href='#tiga' role='tab' id='tiga-tab' data-toggle='tab' aria-controls='tiga' aria-expanded='false'>3 Angka</a></li>
                      <li role='presentation' class=''><a href='#empat' role='tab' id='empat-tab' data-toggle='tab' aria-controls='empat' aria-expanded='false'>4 Angka</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='dua' aria-labelledby='dua-tab'>
                          <div class='col-md-12'>
                            <table id="example1" class='table table-condensed table-bordered'>
                               <thead>
                                <tr>
                                  <th colspan="6"><center>SESI : <?= $dua['date'].'  '.$dua['start'].' - '.$dua['end']?></center></th>
                                </tr>
                                <tr>

                                  <th width="20px">No</th>
                                  <th>Nama</th>
                                  <th>Tebak</th>
                                  <th>Status</th>
                                  <th>Waktu Tebak</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                            <tbody>
                              
                              <?php $two = $this->db->query("SELECT * FROM `angka` LEFT JOIN `tebak_angka` ON `angka`.`id_angka`=`tebak_angka`.`id_angka` JOIN `rb_konsumen` ON `rb_konsumen`.`id_konsumen` = `tebak_angka`.`id_konsumen` WHERE `angka`.`id_angka` = '".$dua['id_angka']."' ORDER BY `id_ta` ASC"); ?>
                              <?php 
                                  $no=1;
                                  foreach($two->result_array() as $t){

                               ?>
                                <?php 


                                                         // kadang ada penulisan no hp 0811 239 345
                                 $nohp = str_replace(" ","",$t['no_hp']);
                                 // kadang ada penulisan no hp (0274) 778787
                                 $nohp = str_replace("(","",$t['no_hp']);
                                 // kadang ada penulisan no hp (0274) 778787
                                 $nohp = str_replace(")","",$t['no_hp']);
                                 // kadang ada penulisan no hp 0811.239.345
                                 $nohp = str_replace(".","",$t['no_hp']);
                             
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
                              <tr>
                                <td><?= $no;?></td>
                                <td><?= $t['nama_lengkap']?></td>
                                <td><?= $t['tebak']?></td>
                                <td>
                                <?php if($dua['angka'] == $t['tebak']){  
                                ?>
                                  <span class="label label-success">Tebakan Benar</span>
                                <?php 
                                }else{ echo "<span class='label label-danger'>Tebakan Salah</span>";} ?>
                                  
                                </td>
                                <td><?= $t['time']?></td>
                                <td><?php if($t['tebak'] == $dua['angka']){?>
                                    <a href="https://wa.me/<?=$hp?>" target="blank">

                                     <span class='label label-success'> Whatsapp </span> </a>
                                    <?php }?></td>
                              </tr>
                              <?php $no++; }?>
                            </tbody>
                            </table>
                          </div>
                          <div style='clear:both'></div>
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='tiga' aria-labelledby='tiga-tab'>
                          <div class='col-md-12'>
                            <table id="example2" class='table table-condensed table-bordered'>
                               <thead>
                                <tr>
                                  <th colspan="6"><center>SESI : <?= $tiga['date'].'  '.$tiga['start'].' - '.$tiga['end']?></center></th>
                                </tr>
                                <tr>

                                  <th width="20px">No</th>
                                  <th>Nama</th>
                                  <th>Tebak</th>
                                  <th>Status</th>
                                  <th>Waktu Tebak</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                            <tbody>
                              
                              <?php $tigaangka = $this->db->query("SELECT * FROM `angka` LEFT JOIN `tebak_angka` ON `angka`.`id_angka`=`tebak_angka`.`id_angka` JOIN `rb_konsumen` ON `rb_konsumen`.`id_konsumen` = `tebak_angka`.`id_konsumen` WHERE `angka`.`id_angka` = '".$tiga['id_angka']."' ORDER BY `id_ta` ASC"); ?>
                              <?php 
                                  $no=1;
                                  foreach($tigaangka->result_array() as $tg){

                               ?>
                                <?php 


                                                         // kadang ada penulisan no hp 0811 239 345
                                 $nohp = str_replace(" ","",$tg['no_hp']);
                                 // kadang ada penulisan no hp (0274) 778787
                                 $nohp = str_replace("(","",$tg['no_hp']);
                                 // kadang ada penulisan no hp (0274) 778787
                                 $nohp = str_replace(")","",$tg['no_hp']);
                                 // kadang ada penulisan no hp 0811.239.345
                                 $nohp = str_replace(".","",$tg['no_hp']);
                             
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
                              <tr>
                                <td><?= $no;?></td>
                                <td><?= $tg['nama_lengkap']?></td>
                                <td><?= $tg['tebak']?></td>
                                <td>
                                <?php if($tiga['angka'] == $tg['tebak']){  
                                ?>
                                  <span class="label label-success">Tebakan Benar</span>
                                <?php 
                                }else{ echo "<span class='label label-danger'>Tebakan Salah</span>";} ?>
                                  
                                </td>
                                <td><?= $tg['time']?></td>
                                <td><?php if($tg['tebak'] == $tiga['angka']){?>
                                    <a href="https://wa.me/<?=$hp?>" target="blank">

                                     <span class='label label-success'> Whatsapp </span> </a>
                                    <?php }?></td>
                              </tr>
                              <?php $no++; }?>
                            </tbody>
                            </table>
                          </div>
                          <div style='clear:both'></div>
                      </div>
                    <div role='tabpanel' class='tab-pane fade' id='empat' aria-labelledby='empat-tab'>
                          <div class='col-md-12'>
                            <table id="example3" class='table table-condensed table-bordered'>
                               <thead>
                                <tr>
                                  <th colspan="6"><center>SESI : <?= $empat['date'].'  '.$empat['start'].' - '.$empat['end']?></center></th>
                                </tr>
                                <tr>

                                  <th width="20px">No</th>
                                  <th>Nama</th>
                                  <th>Tebak</th>
                                  <th>Status</th>
                                  <th>Waktu Tebak</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                            <tbody>
                              
                              <?php $four = $this->db->query("SELECT * FROM `angka` LEFT JOIN `tebak_angka` ON `angka`.`id_angka`=`tebak_angka`.`id_angka` JOIN `rb_konsumen` ON `rb_konsumen`.`id_konsumen` = `tebak_angka`.`id_konsumen` WHERE `angka`.`id_angka` = '".$empat['id_angka']."' ORDER BY `id_ta` ASC"); ?>
                              <?php 
                                  $no=1;
                                  foreach($four->result_array() as $f){

                               ?>
                                <?php 


                                                         // kadang ada penulisan no hp 0811 239 345
                                 $nohp = str_replace(" ","",$f['no_hp']);
                                 // kadang ada penulisan no hp (0274) 778787
                                 $nohp = str_replace("(","",$f['no_hp']);
                                 // kadang ada penulisan no hp (0274) 778787
                                 $nohp = str_replace(")","",$f['no_hp']);
                                 // kadang ada penulisan no hp 0811.239.345
                                 $nohp = str_replace(".","",$f['no_hp']);
                             
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
                              <tr>
                                <td><?= $no;?></td>
                                <td><?= $f['nama_lengkap']?></td>
                                <td><?= $f['tebak']?></td>
                                <td>
                                <?php if($empat['angka'] == $f['tebak']){  
                                ?>
                                  <span class="label label-success">Tebakan Benar</span>
                                <?php 
                                }else{ echo "<span class='label label-danger'>Tebakan Salah</span>";} ?>
                                  
                                </td>
                                <td><?= $t['time']?></td>
                                <td><?php if($f['tebak'] == $dua['angka']){?>
                                    <a href="https://wa.me/<?=$hp?>" target="blank">

                                     <span class='label label-success'> Whatsapp </span> </a>
                                    <?php }?></td>
                              </tr>
                              <?php $no++; }?>
                            </tbody>
                            </table>
                          </div>
                          <div style='clear:both'></div>
                      </div>

                    </div>
                  </div>
                </div>
            </div>
    