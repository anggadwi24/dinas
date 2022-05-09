    
   <style type="text/css">
      hr {
     border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);
}
 .tableprduk  {
  border-collapse: collapse;
  width: 100%;
}

.tableproduk th, td {

  padding: 8px;
}

.tableproduk tr:nth-child(even){background-color: #f2f2f2}

.tableproduk th {
  background-color: #0B1450;
  color: white;
}
    </style>

     <?php $usr = $this->db->query("SELECT a.*, b.nama_kota, c.nama_provinsi FROM rb_reseller a JOIN rb_kota b ON a.kota_id=b.kota_id 
                JOIN rb_provinsi c ON b.provinsi_id=c.provinsi_id
                  where a.id_reseller='".$this->session->id_reseller."'")->row_array(); ?>
<h1 style="text-align: right;color: #87ceeb ">Report</h1>
<table align="right" class="table1" style="margin-left: 10px;margin-right: 10px;">
  
  <tr>
    <th  align="right">Tanggal  :  </th>
    <td style="width:250px;" align="right"> <?= $status;?></td>

  </tr>
  <tr>
    <th align="right" >Proses </th>
    <td align="right" ><?= $proses;?></td>
  </tr>
   <tr>
    <th align="right" >Transaksi </th>
    <td align="right" ><?= $pembelian;?></td>
  </tr>


</table>
<br><br><br><br><br><br><br>
<table width="100%">
  <tr>
    <td width="40%">Info Perusahan</td>
    <td width="20%"></td>
    <td width="40%"></td>
  </tr>
  <tr>
    <td><hr></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td><b><?= $usr['nama_reseller']?> </b>( <?= $usr['no_telpon']?> )</td>
    <td></td>
    <td><b></td>
  </tr>


  <tr>
    <td> <?= $usr['alamat_lengkap']?><br><?= $usr['nama_provinsi'].', '.$usr['nama_kota']?></td>
    <td></td>
    <td></td>
  </tr>

</table>
     <br>
     <br>
     <br>
     <br>
     <table class="tableproduk" style="border-collapse: collapse;width: 100%">
                    
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Konsumen</th>
                        <th>Status Pembeli</th>
                        <th>Kurir</th>
                        <th>Status</th>
                        <th>Total + Ongkir</th>
                   
                      </tr>
                  
                  <?php 
                    $no = 1;
                    $totalpembelian = 0;
                    $ongkir = 0;
                    $all =0;
                    foreach ($record->result_array() as $row){
                    if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; $status = 'Proses'; $icon = 'star-empty'; $ubah = 1; }
                    elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; $status = 'Pending'; $icon = 'star text-yellow'; $ubah = 0; }
                    elseif($row['proses']=='2'){ $proses = '<i class="text-info">Konfirmasi</i>'; $status = 'Proses'; $icon = 'star'; $ubah = 1; }
                    elseif($row['proses']=='3'){$proses = '<i class="text-info">Sudah Dibayar</i>';}
                    elseif($row['proses']=='4'){$proses = ' Sedang Dalam Perjalanan';}
                    else{ $proses = 'Pesanan Sampai';}

                    $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                    echo "<tr align='center'><td>$no</td>
                              <td>$row[kode_transaksi]</td>
                              <td> $row[nama_lengkap]</td>
                              <td>".ucfirst($row[status_pembeli])."</a>
                              <td><span style='text-transform:uppercase'>$row[kurir]</span> - $row[service]</td>
                              <td>$proses</td>
                              <td style='color:red;'>Rp ".rupiah($total['total']+$row['ongkir'])."</td>
                              
                          </tr>";

                      $ongkir += $row['ongkir'];
                      $totalpembelian = $totalpembelian + $total['total'];
                      $no++;
                    }
                  ?>
                  <tr>
                    <td colspan="4"></td>
                    <td colspan="2">Total Pembelian</td>
                    <td colspan="2"><?php echo  "Rp. ".rupiah($totalpembelian)?></td>
                  </tr>
                  <tr>
                    <td colspan="4"></td>
                    <td colspan="2">Total Ongkir</td>
                    <td colspan="2"><?php echo  "Rp. ".rupiah($ongkir)?></td>
                  </tr>
                  <tr>
                    <td colspan="4"></td>
                    <td colspan="2">Total Keseluruhan </td>
                    <td colspan="2"><?php echo  "Rp. ".rupiah($totalpembelian+$ongkir)?></td>
                  </tr>
                
                </table>