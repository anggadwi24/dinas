<?php
ob_start();
?>
<style type="text/css">
  tr    { page-break-inside:avoid; page-break-after:auto }
  td {
    font-size: 18px;
  }
</style>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<?php  $bag = $this->db->query("SELECT * FROM bagian a JOIN sub_bagian b ON a.id_bagian = b.id_bagian WHERE id_sub_bagian = $row[sub_bagian]")->row_array();
   $tgl1 = strtotime($row['dari']); 
                $tgl2 = strtotime($row['sampai']); 

                $jarak = $tgl2 - $tgl1;

                $hari = $jarak / 60 / 60 / 24+1;
                ?>
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

<table width="100%">
  <tr>
    <td></td>
    <td align="center"><h5>FORM PERMOHON IZIN TIDAK MASUK KERJA</h5></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="3">Saya yang bertanda tangan di bawah ini:</td>
  </tr>
  <tr>
    <td><br></td>
  </tr>
  <tr>
    <td style="padding-left:30px;">Nama</td>
    <td>:</td>
    <td><?= $row['nama_lengkap']?></td>
  </tr>
  <tr>
    <td style="padding-left:30px;">No KTP</td>
    <td>:</td>
    <td><?= $row['no_ktp']?></td>
  </tr>
  <tr>
    <td style="padding-left:30px;">Bagian</td>
    <td>:</td>
    <td><?= $bag['nama_bagian']?></td>
  </tr>
   <tr>
    <td style="padding-left:30px;">Sub Bagian</td>
    <td>:</td>
    <td><?= $bag['nama_sub_bagian']?></td>
  </tr>
  <tr>
    <td style="padding-left:30px;">Tugas Pokok</td>
    <td>:</td>
    <td><?= $row['tugas_pokok']?></td>
  </tr>
  <tr>
    <td><br></td>
  </tr>
  <tr>
    <td colspan="3">Dengan ini mengajukan <b><?= $row['status_ket']?> Tidak Bekerja</b> untuk keperluan:</td>
  </tr>
 
  <tr>
    <td colspan="3"><?= $row['keterangan']?></td>
  </tr>
   <tr>
    <td><br></td>
  </tr>
  <tr>
    <td colspan="3"><?= $row['status_ket']?> tersebut saya ajukan: </td>
  </tr>
  <tr>
    <td><br></td>
  </tr>
  <tr>
    <td style="padding-left:30px;">Untuk selama</td>
    <td>:</td>
    <td><?= $hari ?> Hari kerja</td>
  </tr>
  <tr>
    <td style="padding-left:30px;">Dari tanggal</td>
    <td>:</td>
    <td><?= format_indo($row['dari']) ?> </td>
  </tr>
   <tr>
    <td style="padding-left:30px;">Sampai tanggal</td>
    <td>:</td>
    <td><?= format_indo($row['sampai']) ?> </td>
  </tr>
  <tr>
    <td><br></td>
  </tr>
  <tr>
    <td colspan="3">Dengan permohonan ini saya ajukan</td>
  </tr>
</table>
<table align="center" width="100%">
  <tr>
    <td></td>
    <td align="center">Karyawan <br><br><hr></td>
    <td></td>
  </tr>
    <tr>
     <td align="center">Kepala Bagian <br><br><hr></td>
   <td></td>
   <td align="center">Kepala Sub Bagian <br><br><hr></td>
  </tr>
  
</table>
</body>
</html>