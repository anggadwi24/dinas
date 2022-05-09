<?php
ob_start();
?>
<style type="text/css">
  tr    { page-break-inside:avoid; page-break-after:auto }
</style>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<?php  $bag = $this->db->query("SELECT * FROM bagian a JOIN sub_bagian b ON a.id_bagian = b.id_bagian WHERE id_sub_bagian = $row[sub_bagian]")->row_array();?>
<table width="100%">
  <tr>
    <td  width="25%" valign="top"><img src="./asset/images/logo.png" style="height: 150px"></td>
    <td width="75%" align="center"> 
      <h3>PEMERINTAH PROVINSI SULAWESI BARAT</h3>
       <h2><b>SEKRETARIAT DAERAH</b></h2>
       <p>Jalan H. Abd. Malik Pattana Endeng - Rangas - Mamuju 91511</p>
       <p>e-mail : tupgubsulbar@gmail.com , Website : http://www.sulbarprov.go.id/</p>
    </td>
  </tr>
  <tr><td colspan="2"><hr></td></tr>
  

</table>
    
<table border="0" width="100%">
  <tr>
   
    <td colspan="4" align="center">SURAT TUGAS</td>
  </tr>
  <tr>
     <td colspan="4" align="center">Nomor</td>
  </tr>
    <tr>
    <td><br></td>
  </tr>
  <tr valign="top">
    <td rowspan="4" width="10%">Dasar</td>
    <td rowspan="4" width="10%">:</td>
    <td width="10%">1. </td>
    <td width="70%">Peraturan Daerah Provinsi Sulawesi Barat Nomor  1 Tahun 2021 tentang Anggaran Pendapatan dan Belanja Daerah Provinsi Sulawesi Barat Tahun Anggaran 2021;</td>
  </tr>
   <tr>
   
    <td>2. </td>
    <td>Peraturan Gubernur Provinsi Sulawesi Barat Nomor 1 Tahun 2020 tentang Penjabaran Anggaran Pendapatan dan Belanja Daerah Provinsi Sulawesi Barat Tahun Anggaran 2021;   </td>
  </tr>
   <tr>
   
    <td>3. </td>
    <td>Peraturan Gubernur Provinsi Sulawesi Barat Nomor 31 Tahun 2020 tentang Standar Harga Satuan Tahun Anggaran 2021; </td>
  </tr>
   <tr>
   
    <td>4. </td>
    <td>Berdasarkan Surat Sekretaris Daerah Provinsi Sulawesi Barat Nomor : 001.02/879/IV/2021 tentang Kunjungan Kerja melalui Safari Ramadhan di 6 (enam) Kabupaten. </td>
  </tr>
  <tr>
    <td><br></td>
  </tr>
   <tr>
     <td colspan="4" align="center">Memberi Tugas</td>
  </tr>
    <tr>
    <td><br></td>
  </tr>
  <tr valign="top">
    <td rowspan="4">Kepada</td>
    <td rowspan="4">:</td>
    <td>Nama  </td>
    <td><?= $row['nama_lengkap']?></td>
  </tr>
  <tr>
    <td>No. KTP</td>
    <td><?= $row['no_ktp']?></td>
  </tr>
  <tr>
    <td>Bagian </td>
    <td><?= $bag['nama_bagian']?></td>
  </tr>
   <tr>
    <td>Sub Bagian </td>
    <td><?= $bag['nama_sub_bagian']?></td>
  </tr>
    <tr>
    <td><br></td>
  </tr>
  <tr valign="top">
    <td>Untuk</td>
    <td>:</td>
    <td colspan="2"><?= $row['keterangan']?></td>
  </tr>
  <tr>
    <td colspan="4" align="right">Ditetapkan Di Mamuju<br>Pada Tanggal <?= format_indo_w($row['date']) ?></td>
  </tr>
   <tr>
    <td colspan="4" align="right">Sekretaris Daerah,</td>
  </tr>
  <tr>
    <td><br><br></td>
  </tr>
  <tr>
    <td colspan="4" align="right"><u>Dr. Muhammad Idris, M.Si </u><br>Pangkat   : Pembina Utama / IV.e <br>Nip : 19641115 199303 1 001        

    </td>
  </tr>

</table>
</body>
</html>