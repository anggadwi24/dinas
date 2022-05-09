      <div class='col-md-12'>
              <dixv class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Dropshipper</h3>
                  <a class='pull-right btn btn-warning btn-sm' href='<?php echo base_url(); ?>administrator/Dropshipper'>Kembali</a>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#profile' id='profile-tab' role='tab' data-toggle='tab' aria-controls='profile' aria-expanded='true'>Data Konsumen </a></li>
                      <li role='presentation' class=''><a href='#keuangan' role='tab' id='keuangan-tab' data-toggle='tab' aria-controls='keuangan' aria-expanded='false'>History Transaksi Belanja</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='profile' aria-labelledby='profile-tab'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              
                              
                              <?php foreach ($rows as $rows){}?>
                              <?php $dropship = $this->db->query("SELECT b.nama_kota, a.nama_provinsi FROM rb_provinsi a JOIN rb_kota b ON a.provinsi_id=b.provinsi_id where b.kota_id='".$rows['kota_id']."'")->row_array(); ?>
                              <tr><th width='130px' scope='row'>Nama Dropshipper</th> <td><?php echo $rows['nama_dropshipper']?></td></tr>
                     
                           
                              <tr><th scope='row'>No Hp</th> <td><?php echo $rows['no_hp']?></td></tr>
                      
                              <tr><th scope='row'>Alamat</th> <td><?php echo $rows['alamat']?></td></tr>
                              <tr><th scope='row'>Kecamatan</th> <td><?php echo $rows['kecamatan']?></td></tr>
                              <tr><th scope='row'>Propinsi</th> <td><?php echo $dropship['nama_provinsi']?></td></tr>
                              <tr><th scope='row'>Kota</th> <td><?php echo $dropship['nama_kota']?></td></tr>
                           <tr><th scope='row'>No KTP</th> <td><?php echo $rows['no_ktp']?></td></tr>
                            <tr><th scope='row'>No Rekening</th> <td><?php echo $rows['no_rekening']?></td></tr>
                            
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
                               
                                  <th>Total Belanja</th>
                                  <th>Status</th>
                                  <th>Waktu Transaksi</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  $no = 1;
                                  foreach ($histori->result_array() as $row){
                                  if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; }elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; }else{ $proses = '<i class="text-info">Konfirmasi</i>'; }
                                  $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                                  echo "<tr><td>$no</td>
                                            <td>$row[kode_transaksi]</td>
                                         
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

                    </div>
                  </div>
                </div>
            </div>
        </div>