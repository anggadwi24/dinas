 <?php $detail = $this->db->query("SELECT * FROM rb_penjualan where id_penjualan='".$this->uri->segment(3)."'")->row_array(); ?>
 <?php $res = $this->db->query("SELECT a.*, b.nama_kota, c.nama_provinsi FROM rb_reseller a JOIN rb_kota b ON a.kota_id=b.kota_id 
                JOIN rb_provinsi c ON b.provinsi_id=c.provinsi_id
                  where a.id_reseller='$rows[id_reseller]'")->row_array(); ?>


  <?php $disk = $this->db->query("SELECT * FROM rb_produk_diskon where id_produk='$row[id_produk]'")->row_array();
    $diskon = rupiah(($disk['diskon']/$row['harga_konsumen'])*100,0)."%";
    ?>


     <?php $adm = $this->db->query("SELECT * FROM users WHERE id_session = '".$this->session->id_session ."'")->row_array(); ?>


    <style type="text/css">
      hr {
     border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);
}
    </style>

<h1 style="text-align: right;color: #87ceeb ">Invoice</h1>
<table align="right" class="table1" style="margin-left: 10px;margin-right: 10px;">
  
  <tr>
    <th  align="right">Kode Transaksi </th>
    <td style="width:250px;" align="right"> <?= $rows['kode_transaksi']?></td>

  </tr>
  <tr>
    <th align="right" >Tanggal</th>
    <td align="right" ><?= date('d/m/Y',strtotime($rows['waktu_transaksi']))?></td>
  </tr>
</table>
<br>
<br>
<br>
<br>
<br>
<br>
<table width="100%">
  <tr>
    <td width="40%">Info Perusahan</td>
    <td width="20%"></td>
    <td width="40%">Tagihan Untuk</td>
  </tr>
  <tr>
    <td><hr></td>
    <td></td>
    <td><hr></td>
  </tr>
  <tr>
    <td><b><?= $adm['nama_lengkap']?> </b>( <?= $adm['no_telp']?> )</td>
    <td></td>
    <td><b><?= $res['nama_reseller'];?> </b>( <?= $res['no_telpon']?> )</td>
  </tr>


  <tr>
    <td> Jalan Gunung Karang II B <br>Denpasar Barat, Denpasar, Bali, Indonesia</td>
    <td></td>
    <td><?= $res['alamat_lengkap']?><br><?= $res['nama_kota'].', '.$res['nama_provinsi']?></td>
  </tr>

</table>
<br><br><br>
<style type="text/css">
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

<table width="100%" class="tableproduk" style="border-collapse: collapse;width: 100%">
  <tr style="background-color: #0B1450;color: white;text-align: left;">
    <th  width="30%">Produk</th>
    <th width="10%">Kuantitas</th>
    <th width="20%">Harga</th>
    <th width="20%">Diskon</th>
    <th width="20%">Total</th>
  </tr>
  <?php  foreach ($record as $row){

          $sub_total = ($row['harga_jual']*$row['jumlah'])-$row['diskon'];
  ?>
  <tr>
    <td><b><?= $row['nama_produk']?></b></td>
    <td align="center"><?= $row['jumlah']?></td>
    <td>Rp. <?= rupiah($row['harga_jual']);?></td>
    <td><?php  if($diskon>0){echo $diskon;}else{echo "0%"; }?></td>
    <td>Rp. <?= rupiah($sub_total);?></td>
  </tr>

<?php }
?>

</table>
<?php     $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_penjualan='".$row['id_penjualan']."'")->row_array();
?>
<br>
<table width="100%">
    <tr>
    <td colspan="2" width="25%"></td>
    <td>Berat</td>
    <td colspan="">(<?= terbilang($total['total_berat']).' Gram'?>)</td>
    <td><?= $total['total_berat']?> Gram</td>
  </tr>
   <tr>
    <td colspan="2"></td>
    <td><?= strtoupper($detail['kurir'].' - '.$detail['service']);?></td>
    <td colspan="">(<?= terbilang($detail['ongkir'])?>)</td>
    <td>Rp. <?= rupiah($detail['ongkir']);?> </td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td>Diskon</td>
    <td colspan="">(<?= terbilang($row['diskon'])?>)</td>
    <td>Rp. <?= rupiah($row['diskon']);?> </td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td>Total</td>
    <td colspan="">(<?= terbilang($total['total'])?> Rupiah )</td>
    <td>Rp. <?= rupiah($total['total']);?> </td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td>Sub Total</td>
    <td colspan="">(<?= terbilang($total['total']+$detail['ongkir']);?> Rupiah)</td>
    <td>Rp. <?= rupiah($total['total']+$detail['ongkir']);?> </td>
  </tr>
</table>
<br>

<?php  if ($rows['proses']=='0'){ $proses = 'Pending'; $status = 'Proses'; }
          elseif($rows['proses']=='1'){ $proses = 'Proses'; }
          elseif($rows['proses']=='2'){ $proses = 'Belum Lunas'; }
          else{ $proses= 'Lunas';}
          ?>
<table width="100%">
  
  <tr align="left">
    <td width="60%"><h3>Keterangan</h3></td>
    <td width="10%"></td>
    <td width="30%"><h3><?= date('d M, Y',strtotime($rows['waktu_transaksi']))?></h3></td>
  </tr>
  <tr>
    <td><hr><br><?= $proses ?></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td style="height: 100px">Finance</td>
  </tr>
</table>



<!--  -->