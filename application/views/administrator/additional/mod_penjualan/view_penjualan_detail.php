 <?php $detail = $this->db->query("SELECT * FROM rb_penjualan where id_penjualan='".$this->uri->segment(3)."'")->row_array(); ?>

            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Detail Transaksi Penjualan</h3>
                  <a class='pull-right btn btn-default btn-sm' href='<?php echo base_url(); ?>administrator/penjualan'>Kembali</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='140px' scope='row'>Kode Pembelian</th>  <td><?php echo "$rows[kode_transaksi]"; ?></td></tr>
                    <tr><th scope='row'>Nama Reseller</th>                 <td><?php echo "$rows[nama_reseller]"; ?></td></tr>
                    <tr><th scope='row'>Waktu Transaksi</th>               <td><?php echo "$rows[waktu_transaksi]"; ?></td></tr>
                    <tr><th scope='row'>Proses</th>                        <td>
                      <?php
                         if ($rows['proses']=='0'){ 
                      $proses = '<i class="text-danger">Pending</i>'; 
                      $status = 'Proses'; 
                      $icon = 'star-empty'; $ubah = 1; 
                    }elseif ($rows['proses']=='1'){
                      $proses = '<i class="text-success">Proses</i>'; 
                      $status = 'Pending Proses'; $icon = 'star text-yellow'; 
                      $ubah = 0; 
                    }elseif ($rows['proses']=='2'){
                      $proses = '<i class="text-info">Konfirmasi</i>'; 
                      $status = 'Konfirmasi Proses '; $icon = 'star text-yellow'; 
                      $ubah = 0; 
                    }elseif($rows['proses']=='3'){
                       $proses = '<i class="text-info">Sudah Bayar</i>'; 
                    }elseif($rows['proses']=='4'){
                       $proses = '<i class="text-info">Dalam Dalam Perjalanan</i>'; 
                    }else{
                      $proses = '<i class="text-info">Pesanan Selesai</i>';
                    }
                        echo "$proses"; 
                      ?>
                    </td></tr>
                    <tr><th scope="row">Action</th>
                      <td>
                        <?php if($rows['proses']=='2'){
                        ?>
                        <a class="btn btn-primary btn-xs" href="<?php echo base_url('administrator/proses_penjualan_detail'). '/'.$rows['id_penjualan'].'/3'?>">Sudah Bayar</a>

                        <?php  
                        }elseif($rows['proses']=='3'){?>
                          <form action="<?= base_url('administrator/input_resi')?>" method="post">
                            <input type="hidden" name="id_penjualan" value="<?= $rows['id_penjualan'] ?>">
                            Masukan No Resi <input type="text" name="noresi">
                          </form>
                        <?php }elseif($rows['proses']=='4'){ echo "Pesanan dalam perjalanan"; ?>
                        <br>
                         <a class="btn btn-primary btn-xs" href="<?php echo base_url('administrator/proses_penjualan_detail'). '/'.$rows['id_penjualan'].'/5'?>">Pesanan Sampai</a>
                        <?php }elseif($rows['proses']=='5'){?>
                            Pesanan Selesai
                        <?php }?>
                      </td>

                    </tr>
                  </tbody> 
                  </table>
                  <hr>
                  <table class="table table-condensed table-bordered">
                    <tbody>



                      <?php $res = $this->db->query("SELECT a.*, b.nama_kota, c.nama_provinsi FROM rb_reseller a JOIN rb_kota b ON a.kota_id=b.kota_id 
                JOIN rb_provinsi c ON b.provinsi_id=c.provinsi_id
                  where a.id_reseller='$rows[id_pembeli]'")->row_array(); ?>

                      <tr><th style="width: 150px;">Nama Reseller</th><td><?= $rows['nama_reseller']?></td></tr>
                      <tr><th style="width: 150px;">No Telpon</th><td><?= $rows['no_telpon']?></td></tr>
                      <tr><th style="width: 150px;">Alamat</th><td><?= $rows['alamat_lengkap'].' / '.$res['nama_provinsi'].' / '.$res['nama_kota']?></td></tr>

                    </tbody>
                  </table>
                  <hr>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Nama Produk</th>
                        <th>Harga Jual</th>
                        <th>Diskon</th>
                        <th>Jumlah Jual</th>
                        <th>Satuan</th>
                        <th>Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    $sub_total = ($row['harga_jual']*$row['jumlah'])-$row['diskon'];
                    echo "<tr><td>$no</td>
                              <td>$row[nama_produk]</td>
                              <td>Rp ".rupiah($row['harga_jual'])."</td>
                              <td>Rp ".rupiah($row['diskon'])."</td>
                              <td>$row[jumlah]</td>
                              <td>$row[satuan]</td>
                              <td>Rp ".rupiah($sub_total)."</td>
                          </tr>";
                      $no++;
                    }
                     $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='".$this->uri->segment(3)."'")->row_array();
                    echo "<tr class='warning'>
                            <td colspan='6'><b>Ongkir</b></td>
                            <td><b>Rp ".rupiah($detail['ongkir'])."</b></td>
                          </tr>
                          <tr class='warning'>
                            <td colspan='6'><b>Belanja</b></td>
                            <td><b>Rp ".rupiah($total['total'])."</b></td>
                          </tr>
                          <tr class='success'>
                            <td colspan='6'><b>Total</b></td>
                            <td><b>Rp ".rupiah($total['total']+$detail['ongkir'])."</b></td>
                          </tr>";
                  ?>
                  </tbody>
                </table>
                   <br>
                <a href="<?php echo base_url('administrator/cetakdata').'/'.$rows[id_penjualan]?>" class="pull-right"><span class="glyphicon glyphicon-print"></span></a>
              </div>