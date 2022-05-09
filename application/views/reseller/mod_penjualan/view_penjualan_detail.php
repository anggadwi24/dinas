<?php $detail = $this->db->query("SELECT * FROM rb_penjualan where id_penjualan='".$this->uri->segment(3)."'")->row_array(); ?>

            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Detail Transaksi Penjualan</h3>
                  <a class='pull-right btn btn-default btn-sm' href='<?php echo base_url().$this->uri->segment(1); ?>/penjualan'>Kembali</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='140px' scope='row'>Kode Pembelian</th>  <td><?php echo "$rows[kode_transaksi]"; ?></td></tr>
                    <tr><th scope='row'>Nama Konsumen</th>                 <td><?php echo "<a href='".base_url().$this->uri->segment(1)."/detail_konsumen/$rows[id_konsumen]'>$rows[nama_lengkap]</a>"; ?></td></tr>
                    <tr><th scope='row'>Waktu Transaksi</th>               <td><?php echo "$rows[waktu_transaksi]"; ?></td></tr>
                    <tr><th scope='row'>Kurir</th>               <td><?php echo "<span style='text-transform:uppercase'>$detail[kurir]</span> - $detail[service]"; ?></td></tr>
                    <tr><th scope='row'>Status</th>                        <td>

                      <?php
                        if ($rows['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; $status = 'Proses'; $icon = 'star-empty'; $ubah = 1; }
                        elseif($rows['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; $status = 'Pending'; $icon = 'star text-yellow'; $ubah = 0;}
                        elseif($rows['proses']=='3'){$status = 'Pembayaran Masuk'; $proses = '<i class="text-success">Pembayaran Masuk</i>';}
                        elseif($rows['proses']=='4'){ $proses = 'Pesanan dalam perjaanan';}

                          elseif($rows['proses']=='2'){ $proses = '<i class="text-info">Konfirmasi</i>'; $status = 'Proses'; $icon = 'star'; $ubah = 1; } 
                          else{
                          $proses='Pesanan Selesai';
                        }
                        echo "$proses <a class='btn btn-primary btn-xs' style='margin-left:5px' title='$status Data' href='".base_url().$this->uri->segment(1)."/proses_penjualan_detail/$rows[id_penjualan]/$ubah/$rows[kode_transaksi]' onclick=\"return confirm('Apa anda yakin untuk ubah status jadi $status?')\"><span class='glyphicon glyphicon-$icon'></span> Ubah Status</a>";  
                        
                      ?>
                    </td></tr>
                    <tr><th scope="row">Action</th><td><?php if($rows['proses']==2){?><a href="<?= base_url('reseller/proses_penjualan_detail').'/'.$rows[id_penjualan].'/3' ?>" class="btn btn-primary btn-xs">Sudah Dibayar</a><?php }elseif($rows['proses']==3){?> 
                        <form action="<?php echo base_url('reseller/input_no_resi')?>" method="post">
                        Masukan No Resi : <input type="text" name="noresi" class="form-control"> <input type="hidden" name="id_penjualan" value="<?= $rows[id_penjualan]?>">

                        </form>
                      <?php }elseif($rows['proses']=='4'){ ?><i class="text-success"><?= $rows['no_resi']?></i><br><a href="<?= base_url('reseller/proses_penjualan_detail').'/'.$rows[id_penjualan].'/5/'.$rows[kode_transaksi] ?>" class="btn btn-success btn-xs">SAMPAI</a><?php }else{ echo $rows['no_resi'];}?></td></tr>
                  </tbody>
                  </table>
                  <hr>
                  <?php if($dropshipper->num_rows() == 0){?>
                  <table class="table table-condensed table-bordered">
                    <tbody>



                      <?php $res = $this->db->query("SELECT a.*, b.nama_kota, c.nama_provinsi FROM rb_konsumen a JOIN rb_kota b ON a.kota_id=b.kota_id 
                JOIN rb_provinsi c ON b.provinsi_id=c.provinsi_id
                  where a.id_konsumen='$rows[id_konsumen]'")->row_array(); ?>

                      <tr><th style="width: 150px;">Nama Penerima</th><td><?= $rows['nama_lengkap']?></td></tr>
                      <tr><th style="width: 150px;">No HP</th><td><?= $rows['no_hp']?></td></tr>
                      <tr><th style="width: 150px;">Alamat</th><td><?= $rows['alamat_lengkap'].' / '.$res['nama_provinsi'].' / '.$res['nama_kota'].' / '.$rows['kecamatan']?></td></tr>

                    </tbody>
                  </table>
                <?php }else{?>
                    <table class="table table-condensed table-bordered">
                    <tbody>

                      <?php foreach($dropshipper->result_array() as $drs ){}?>

                      <?php $res = $this->db->query("SELECT a.*, b.nama_kota, c.nama_provinsi FROM rb_dropshipper_history a JOIN rb_kota b ON a.kota_id=b.kota_id 
                JOIN rb_provinsi c ON b.provinsi_id=c.provinsi_id
                  where a.kode_transaksi='$rows[kode_transaksi]'")->row_array(); ?>

                      <tr><th style="width: 150px;">Nama Penerima</th><td><?= $drs['nama_penerima']?></td></tr>
                      <tr><th style="width: 150px;">No HP</th><td><?= $drs['no_hp']?></td></tr>
                      <tr><th style="width: 150px;">Alamat</th><td><?= $drs['alamat'].' / '.$res['nama_provinsi'].' / '.$res['nama_kota'].' / '.$drs['kecamatan']?></td></tr>

                    </tbody>
                  </table>
                <?php }?>
                  <hr>
                  <table class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Nama Produk</th>
                        <th>Harga Jual</th>
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
                              <td>$row[jumlah]</td>
                              <td>$row[satuan]</td>
                              <td>Rp ".rupiah($sub_total)."</td>
                          </tr>";
                      $no++;
                    }
                    $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='".$this->uri->segment(3)."'")->row_array();
                    echo "<tr class='warning'>
                            <td colspan='5'><b>Ongkir</b></td>
                            <td><b>Rp ".rupiah($detail['ongkir'])."</b></td>
                          </tr>
                          <tr class='warning'>
                            <td colspan='5'><b>Belanja</b></td>
                            <td><b>Rp ".rupiah($total['total'])."</b></td>
                          </tr>
                          <tr class='success'>
                            <td colspan='5'><b>Total</b></td>
                            <td><b>Rp ".rupiah($total['total']+$detail['ongkir'])."</b></td>
                          </tr>";
                  ?>
                  </tbody>
                </table>
                <br>
                <a href="<?php echo base_url('reseller/cetakdata').'/'.$rows[id_penjualan].'/'.$rows['kode_transaksi']?>" class="pull-right"><span class="glyphicon glyphicon-print"></span></a>
              </div>

