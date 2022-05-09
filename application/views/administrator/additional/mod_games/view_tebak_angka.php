      <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'><?= $judul;?></h3>
                  
                </div>
                <div class='box-body'>

                  
                          <form action="<?= base_url('administrator/tebakangka/').$link?>" METHOD="POST">
                          <div class="row">
                            <div class="col-md-10">
                              <input type="hidden" name="status" value="2">
                              <select name="tebak" class="form-control">
                                
                                <?php foreach($duaangka->result_array() as $da){ ?>
                                <option value="<?= $da[id_angka]?>">ANGKA : <?= $da['angka'].' | '. date('d, F ', strtotime($da['date'])).' |  '.date('H:i ', strtotime($da['start'])).' - '.date('H:i ', strtotime($da['end']))?></option>
                                <?php }?>
                              </select>
                            </div>
                            <div class="col-md-1"><input type="submit" name="cari" value="SEARCH" class="btn btn-primary"></div>
                          </div>
                          </form>
                          <br>
                          <div class='col-md-12'>

                            <table id="example1" class='table table-condensed table-bordered'>
                               <thead>
                                <tr>
                                  <th colspan="7"><center>SESI : <?= $date.'  '.$start.' - '.$end?></center></th>
                                </tr>
                                <tr>

                                  <th width="20px">No</th>
                                  <th>Nama</th>
                                  <th>No HP</th>
                                  <th>Tebak</th>
                                  <th>Status</th>
                                  <th>Waktu Tebak</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                            <tbody>
                              
                              
                              <?php 
                                  $no=1;
                                  foreach($tebak->result_array() as $t):

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
                                <td><?= $t['no_hp']?></td>
                                <td><?= $t['tebak']?></td>
                                <td>
                                <?php if($t['tebak'] == $angka){  
                                ?>
                                  <span class="label label-success">Tebakan Benar</span>
                                <?php 
                                }else{ echo "<span class='label label-danger'>Tebakan Salah</span>";} ?>
                                  
                                </td>
                                <td><?= $t['time']?></td>
                                <td><?php if($t['tebak'] == $angka){?>
                                    <a href="https://wa.me/<?=$hp?>" target="blank">

                                     <span class='label label-success'> Whatsapp </span> </a>
                                    <?php }?></td>
                              </tr>
                              <?php $no++; endforeach;?>
                            </tbody>
                            </table>
                          </div>
                          <div style='clear:both'></div>
                      </div>
</div>
</div>
    