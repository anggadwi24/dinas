            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Transaksi Penjualan / Orderan Konsumen</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>reseller/tambah_penjualan'>Tambah Penjualan Offline</a>
 
                </div><!-- /.box-header -->

                <div class="box-body">
                   <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#online' id='online-tab' role='tab' data-toggle='tab' aria-controls='online' aria-expanded='true'>Transaksi Online </a></li>
                      <li role='presentation' class=''><a href='#offline' role='tab' id='offline-tab' data-toggle='tab' aria-controls='offline' aria-expanded='false'>Transaksi Offline</a></li>
                    </ul><br>
                    <form action="<?= base_url('reseller/download_pdf_all')?>" method="post">
                  <div class="col-lg-12" style="margin-bottom: 20px">
                  
                    <div class="col-lg-4 col-md-4 col-xs-4">
                    <select class="form-control" name="status">
                      <option value="all">Semua</option>
                      <option value="hari">Hari</option>
                      <option value="bulan">Bulan</option>
                      <option value="tahun">Tahun</option>
                    </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-4">
                    <select class="form-control" name="proses">
                      <option value="all">Semua</option>
                      <option value="0">Pending</option>
                      <option value="1">Proses</option>
                      <option value="2">Konfirmasi</option>
                      <option value="3">Lunas</option>
                      <option value="4">Dalam Perjalan</option>
                      <option value="5">Pesanan Selesai</option>
                    </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-xs-2">
                    <select class="form-control" name="pembelian">
                      <option value="online">Online</option>
                      <option value="offline">Offline</option>
                    
                    </select>
                    </div>
                    <div class="col-lg-2 col-md-4 col-xs-4">
                    <input type="submit" class="btn btn-primary" value="DOWNLOAD">
                    </div>
                  </div>
                  </form>
                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='online' aria-labelledby='online-tab'>
                  
                  <table id="example1" class="table table-bordered table-striped table-condensed table-responsive">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Konsumen</th>
                        <th>Status Pembeli</th>
                        <th>Kurir</th>
                        <th>Status</th>
                        <th>Total + Ongkir</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; $status = 'Proses'; $icon = 'star-empty'; $ubah = 1; }
                    elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; $status = 'Pending'; $icon = 'star text-yellow'; $ubah = 0; }
                    elseif($row['proses']=='2'){ $proses = '<i class="text-info">Konfirmasi</i>'; $status = 'Proses'; $icon = 'star'; $ubah = 1; }
                    elseif($row['proses']=='3'){$proses = '<i class="text-info">Sudah Dibayar</i>';}
                    elseif($row['proses']=='4'){$proses = ' Sedang Dalam Perjalanan';}
                    else{ $proses = 'Pesanan Sampai';}

                    $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                    echo "<tr><td>$no</td>
                              <td>$row[kode_transaksi]</td>
                              <td><a href='".base_url()."reseller/detail_konsumen/$row[id_konsumen]'>$row[nama_lengkap]</a></td>
                              <td>$row[status_pembeli]</a>
                              <td><span style='text-transform:uppercase'>$row[kurir]</span> - $row[service]</td>
                              <td>$proses</td>
                              <td style='color:red;'>Rp ".rupiah($total['total']+$row['ongkir'])."</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url()."reseller/detail_penjualan/$row[id_penjualan]/$row[kode_transaksi]'><span class='glyphicon glyphicon-search'></span> Detail</a>
                                <a class='btn btn-primary btn-xs' title='$status Data' href='".base_url()."reseller/proses_penjualan/$row[id_penjualan]/$ubah' onclick=\"return confirm('Apa anda yakin untuk ubah status jadi $status?')\"><span class='glyphicon glyphicon-$icon'></span></a>
                    ";?>
                    <?php if($row['proses'] <='2' ){echo "
                                <a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url()."reseller/edit_penjualan/$row[id_penjualan]/online'><span class='glyphicon glyphicon-edit'></span></a>
                    ";}?>
                    <?php echo "
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."reseller/delete_penjualan/$row[id_penjualan]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
                </div>
               <div role='tabpanel' class='tab-pane fade' id='offline' aria-labelledby='offline-tab'>
                    <table  class="table table-bordered table-striped table-condensed table-responsive">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Konsumen</th>
                        <th>Status Pembeli</th>
                        <th>Kurir</th>
                        <th>Status</th>
                        <th>Total + Ongkir</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($offline->result_array() as $row){
                    if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; $status = 'Proses'; $icon = 'star-empty'; $ubah = 1; }
                    elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; $status = 'Pending'; $icon = 'star text-yellow'; $ubah = 0; }
                    elseif($row['proses']=='2'){ $proses = '<i class="text-info">Konfirmasi</i>'; $status = 'Proses'; $icon = 'star'; $ubah = 1; }
                    elseif($row['proses']=='3'){$proses = '<i class="text-info">Sudah Dibayar</i>';}
                    elseif($row['proses']=='4'){$proses = ' Sedang Dalam Perjalanan';}
                    else{ $proses = 'Pesanan Sampai';}

                    $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                    echo "<tr><td>$no</td>
                              <td>$row[kode_transaksi]</td>
                              <td>$row[nama_lengkap]</td>
                              <td>$row[status_pembeli]</a>
                              <td><span style='text-transform:uppercase'>$row[kurir]</span> - $row[service]</td>
                              <td>$proses</td>
                              <td style='color:red;'>Rp ".rupiah($total['total']+$row['ongkir'])."</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url()."reseller/detail_penjualan_offline/$row[id_penjualan]/$row[kode_transaksi]'><span class='glyphicon glyphicon-search'></span> Detail</a>
                              ";?>

                              <?php if($row['proses']<='2'){echo "
                                <a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url()."reseller/edit_penjualan/$row[id_penjualan]/offline'><span class='glyphicon glyphicon-edit'></span></a>
                                ";}?>
                              <?php echo "
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."reseller/delete_penjualan/$row[id_penjualan]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
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
              