      <div class='col-md-12'>
              <dixv class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data User</h3>
                  <a class='pull-right btn btn-warning btn-sm' href='<?php echo base_url(); ?>administrator/konsumen'>Kembali</a>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#profile' id='profile-tab' role='tab' data-toggle='tab' aria-controls='profile' aria-expanded='true'>Data User </a></li>
                
                      <li role='presentation' class=''><a href='#tebak' role='tab' id='tebak-tab' data-toggle='tab' aria-controls='tebak' aria-expanded='false'>Tebak Angka</a></li>

                      <li role='presentation' class=''><a href='#kuis' role='tab' id='kuis-tab' data-toggle='tab' aria-controls='kuis' aria-expanded='false'>Kuis</a></li>

                       <li role='presentation' class=''><a href='#absen' role='tab' id='absen-tab' data-toggle='tab' aria-controls='absen' aria-expanded='false'>Absensi</a></li>
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
                             
                              <tr><th scope='row'>Tanggal Daftar</th> <td><?php echo tgl_indo($rows['tanggal_daftar']); ?></td></tr>
                            </tbody>
                            </table>
                          </div>
                          <div style='clear:both'></div>
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
                      <div role='tabpanel' class='tab-pane fade' id='kuis' aria-labelledby='kuis-tab'>
                          <div class="col-md-12" style="margin-bottom: 10px;"><button class="btn btn-primary col-lg-12" data-toggle="modal" data-target="#myModal">TAMBAH POIN</button></div> 
                          <div class='col-md-12'>
                            
                            <table  class='table table-hover table-responsive' id="example1">
                           <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Benar</th>
                        <th>Salah</th>
                        <th>Poin</th>
                        <th>Jumlah</th>
                        <th>Waktu Selesai</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($kuis as $k){
                      if($k['qp_selesai'] == 'n' )
                      {
                        $selesai = 'Belum Selesai';
                      }else{
                        $selesai = $k['qp_finish'];
                      }
                    echo "<tr><td>$no</td>
                              <td>$k[nama_lengkap]</td>
                              <td>$k[qp_date]</td>
                              <td>$k[qp_benar]</td>
                              <td>$k[qp_salah]</td>
                              <td>$k[qp_poin]</td>
                              <td>$k[qp_status] Soal</td>
                              <td>$selesai</td>
                              
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                            </table>
                         
                          </div>
                      </div>
                             <div role='tabpanel' class='tab-pane fade' id='absen' aria-labelledby='absen-tab'>
                          <div class="col-md-12" style="margin-bottom: 10px;"><button class="btn btn-primary col-lg-12" data-toggle="modal" data-target="#myModalabsen">TAMBAH POIN ABSEN</button></div>
                          <div class="col-md-12"> <h1>TOTAL POIN : <?= $absen->num_rows()?></h1></div>

                          <div class='col-md-12'>
                            
                            <table  class='table table-hover table-responsive' id="example1">
                           <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                       
                        
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($absen->result_array() as $a){
                   
                    echo "<tr><td>$no</td>
                              <td>$a[date]</td>
                              <td>$a[absen_in]</td>
                          
                              
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                            </table>
                         
                          </div>
                      </div>

                    </div>
                  </div>
                </div>
            </div>
    
    <div id="myModal" class="modal fade" role="dialog">
      <form action="<?= base_url('administrator/tambah_poin_user') ?>" METHOD="POST">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Poin</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Poin</label>
          <input type="number" name="poin" class="form-control">
        </div>
        <div class="form-group">
          <label>Soal</label>
          <select name="status" class="form-control">
            <option value="50">50 Soal</option>
            <option value="80">80 Soal</option>
            <option value="100">100 Soal</option>
          </select>
          <input type="hidden" name="id_konsumen" value="<?= $rows[id_konsumen]?>">
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" name="submit" class="btn btn-primary float-left" value="TAMBAH">
        <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
  </form>
</div>

<div id="myModalabsen" class="modal fade" role="dialog">
      <form action="<?= base_url('administrator/tambah_poin_absen') ?>" METHOD="POST">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Poin</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Poin</label>
          <input type="number" name="poin" class="form-control">
        </div>
         <input type="hidden" name="id_konsumen" value="<?= $rows[id_konsumen]?>">
      </div>
      <div class="modal-footer">
        <input type="submit" name="submit" class="btn btn-primary float-left" value="TAMBAH">
        <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
  </form>
</div>