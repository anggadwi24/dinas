            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Transaksi Penjualan + History Proses eksekusi</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_penjualan'>Tambah Penjualan</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form action="<?= base_url('administrator/download_pdf_all')?>" method="post">
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
                    <div class="col-lg-4 col-md-4 col-xs-4">
                    <input type="submit" class="btn btn-primary" value="DOWNLOAD">
                    </div>
                  </div>
                  </form>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Reseller</th>
                        <th>Waktu Transaksi</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Proses / Keterangan</th>
                        <th style='width:130px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    if ($row['proses']=='0'){ 
                      $proses = '<i class="text-danger">Pending</i>'; 
                      $status = 'Proses'; 
                      $icon = 'star-empty'; $ubah = 1; 
                    }elseif ($row['proses']=='1'){
                      $proses = '<i class="text-success">Proses</i>'; 
                      $status = 'Pending Proses'; $icon = 'star text-yellow'; 
                      $ubah = 0; 
                    }elseif ($row['proses']=='2'){
                      $proses = '<i class="text-info">Konfirmasi</i>'; 
                      $status = 'Konfirmasi Proses '; $icon = 'star text-yellow'; 
                      $ubah = 0; 
                    }elseif($row['proses']=='3'){
                       $proses = '<i class="text-info">Sudah Bayar</i>'; 
                    }elseif($row['proses']=='4'){
                       $proses = '<i class="text-info">Dalam Dalam Perjalanan</i>'; 
                    }else{
                      $proses = '<i class="text-info">Pesanan Selesai</i>';
                    }

                    if ($row['service']==''){ $service = "<i style='color:green'>Pembelian ke Pusat</i>"; }else{ $service = "<i style='color:blue'>$row[service]</i>"; }
                    $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                    echo "<tr><td>$no</td>
                              <td>$row[kode_transaksi]</td>
                              <td>$row[nama_reseller]</td>
                              <td>$row[waktu_transaksi]</td>
                              <td>$proses</td>
                              <td style='color:red;'>Rp ".rupiah($total['total'])."</td>
                              <td>$service</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url()."administrator/detail_penjualan/$row[id_penjualan]'><span class='glyphicon glyphicon-search'></span> Detail</a>";
                                if ($row['proses']=='0'){
                                  echo "<a style='margin:0px 3px' class='btn btn-primary btn-xs' title='$status Data' href='".base_url()."administrator/proses_penjualan/$row[id_penjualan]/1' onclick=\"return confirm('Apa anda yakin untuk ubah status jadi Proses dan stok Reseller (Pembeli) akan otomatis bertambah sesuai dengan orderannya ini?')\"><span class='glyphicon glyphicon-$icon'></span></a>";
                                }elseif ($row['proses']=='1'){
                                  echo "<a style='margin:0px 3px' class='btn btn-default btn-xs' title='Data sudah diproses' href='#' onclick=\"return confirm('Maaf, Data ini sudah di proses,..')\"><span class='glyphicon glyphicon-$icon'></span></a>";
                                }elseif ($row['proses']=='2'){
                                  echo "<a style='margin:0px 3px' class='btn btn-primary btn-xs' title='$status Data' href='".base_url()."administrator/proses_penjualan/$row[id_penjualan]/1' onclick=\"return confirm('Apa anda yakin untuk ubah status jadi Proses dan stok Reseller (Pembeli) akan otomatis bertambah sesuai dengan orderannya ini?')\"><span class='glyphicon glyphicon-$icon'></span></a>";
                                }
                                echo "<a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url()."administrator/edit_penjualan/$row[id_penjualan]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_penjualan/$row[id_penjualan]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
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
              