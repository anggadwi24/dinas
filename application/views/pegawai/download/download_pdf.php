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
  <?php 
    $foto = $row['foto_profile'];
     if (!file_exists("asset/foto_user/$foto") OR $foto==''){
      $pp = './asset/foto_user/blank.png';
     }else{
      $pp = './asset/foto_user/'.$row['foto_profile'];
     }
  ?>
<center>
  <h3>LEMBAR KINERJA HARIAN NON ASN </h3>
  <h5>BIRU UMUM SEKRETARIAT PROVINSI SULAWESI BARAT</h5>
</center>
    
<table border="0" width="100%">
    <tr>
      <td><b>A</b></td>
      <td colspan="2"><b>Biodata Pribadi</b></td>
      <td></td>
      <td></td>
      <td></td>
      
      <td rowspan="9"><img src="<?= $pp ?>" style="height: 150px"></td>
    </tr>
    <tr>
      <td></td>
      <td width="3%">1</td>
      <td width="30%">Nama Lengkap</td>
      <td>:</td>
      <td><b><?= ucfirst($row['nama_lengkap'])?></b></td>
    </tr>
    <tr>
      <td></td>
      <td>2</td>
      <td>Nama Panggilan</td>
      <td>:</td>
      <td><?= ucfirst($row['nama_panggilan'])?></td>
    </tr>
     <tr>
      <td></td>
      <td>3</td>
      <td>Tempat Tanggal Lahir</td>
      <td>:</td>
      <td><?= $row['tempat_lahir']?>, <?= format_indo_w($row['tanggal_lahir']) ?></td>
    </tr> <tr>
      <td></td>
      <td>4</td>
      <td>Status</td>
      <td>:</td>
      <td><?= ucfirst($row['status'])?></td>
    </tr> 
    <tr>
      <td></td>
      <td>5</td>
      <td>Agama</td>
      <td>:</td>
      <td><?= ucfirst($row['agama'])?></td>
    </tr> 
    <tr>
      <td></td>
      <td>6</td>
      <td>Alamat</td>
      <td>:</td>
      <td><?= ucfirst($row['alamat'])?></td>
    </tr>
    <tr>
      <td></td>
      <td>7</td>
      <td>No HP/WA</td>
      <td>:</td>
      <td><?= $row['no_hp']?></td>
    </tr> 
    <tr>
      <td></td>
      <td>8</td>
      <td>Email</td>
      <td>:</td>
      <td><a href="mailto:<?= $row[email]?>"><?= $row[email]?></a></td>
    </tr>
     <tr> 
      <td></td>
      <td>9</td>
      <td>Pendidikan Terakhir</td>
      <td>:</td>
      <td><?= ucfirst($row['pendidikan_terakhir'])?></td>
    </tr>
     <tr>
      <td></td>
      <td>10</td>
      <td>Tugas Pokok</td>
      <td>:</td>
      <td><?= ucfirst($row['tugas_pokok'])?></td>
    </tr>
    <tr>
      <td></td>
      <td>11</td>
      <td>Gaji Pokok</td>
      <td>:</td>
      <td>Rp. <?= rupiah($row['gaji_pokok'])?></td>
    </tr>
    <tr>
      <td></td>
      <td>12</td>
      <td>Nama Sub Bagian</td>
      <td>:</td>
      <td><?= ucfirst($row['nama_sub_bagian'])?></td>
    </tr>
    <tr>
      <td></td>
      <td>13</td>
      <td>Nama Kasubag</td>
      <td>:</td>
      <td><?= ucfirst($row['kepala_sub_bagian'])?></td>
    </tr>
    <tr>
      <td></td>
      <td>14</td>
      <td>Nama Kabag</td>
      <td>:</td>
      <td><?= ucfirst($row['kepala_bagian'])?></td>
    </tr>



<?php 
  $tanggal =date('Y-m-d');
  $abs = $this->model_app->view_where('absensi',array('id_pegawai'=>$row['id_pegawai'],'tanggal'=>$tanggal));
  $h = hari_ini(date('w'));
  $shift = $this->model_app->view_where('shift',array('hari'=>$h))->row_array();
  if($abs->num_rows() > 0){
    $absensi = $abs->row_array();
 
?>

  <tr>
      <td><b>B</b></td>
      <td colspan="2"><b>Kehadiran</b></td>
      <td></td>
      <td></td>
  </tr>
  <tr>
    <td></td>
    <td>a</td>
    <td>Absen Masuk</td>
    <td>:</td>
    <td><?= date('H:i',strtotime($absensi['absen_masuk']))?> WITA</td>
  </tr>
   <tr>
    <td></td>
    <td></td>
    <td>Jam Masuk</td>
    <td>:</td>
    <td><?= date('H:i',strtotime($shift['shift_masuk']))?> WITA</td>
  </tr>
   <tr valign="top">
    <td></td>
    <td></td>
    <td>Dokumentasi</td>
    <td>:</td>
    <td><img src="./asset/foto_absen/<?= $absensi['foto_masuk']?>" style="height: 150px"></td>
  </tr>
  <?php if($absensi['absen_keluar'] != NULL ){
    ?>
   <tr>
    <td></td>
    <td>b</td>
    <td>Absen Keluar</td>
    <td>:</td>
    <td><?= date('H:i',strtotime($absensi['absen_keluar']))?> WITA</td>
  </tr>
   <tr>
    <td></td>
    <td></td>
    <td>Jam Keluar</td>
    <td>:</td>
    <td><?= date('H:i',strtotime($shift['shift_keluar']))?> WITA</td>
  </tr>

   <tr valign="top">
    <td></td>
    <td></td>
    <td>Dokumentasi</td>
    <td>:</td>
    <td><img src="./asset/foto_absen/<?= $absensi['foto_keluar']?>" style="height: 150px"></td>
  </tr>
  <?php }else{ ?>
     <tr>
    <td></td>
    <td>b</td>
    <td>Absen Keluar</td>
    <td>:</td>
    <td>-</td>
  </tr>
   <tr>
    <td></td>
    <td></td>
    <td>Jam Keluar</td>
    <td>:</td>
    <td>-</td>
  </tr>

   <tr valign="top">
    <td></td>
    <td></td>
    <td>Dokumentasi</td>
    <td>:</td>
    <td>-</td>
  </tr>
<?php } ?>

  <?php }else{

  ?>
   <tr>
      <td><b>B</b></td>
      <td colspan="2"><b>Kehadiran</b></td>
      <td></td>
      <td></td>
  </tr>
  <tr>
    <td></td>
    <td>a</td>
    <td>Absen Masuk</td>
    <td>:</td>
    <td>-</td>
  </tr>
   <tr>
    <td></td>
    <td></td>
    <td>Jam Masuk</td>
    <td>:</td>
    <td>-</td>
  </tr>
   <tr valign="top">
    <td></td>
    <td></td>
    <td>Dokumentasi</td>
    <td>:</td>
    <td>-</td>
  </tr>
  
   <tr>
    <td></td>
    <td>b</td>
    <td>Absen Keluar</td>
    <td>:</td>
    <td>-</td>
  </tr>
   <tr>
    <td></td>
    <td></td>
    <td>Jam Keluar</td>
    <td>:</td>
    <td>-</td>
  </tr>

   <tr valign="top">
    <td></td>
    <td></td>
    <td>Dokumentasi</td>
    <td>:</td>
    <td>-</td>
  </tr>
  <?php 
  }
  ?>


   <tr>
      <td><b>C</b></td>
      <td colspan="2"><b>Rekaptulasi Pekerjaan Harian</b></td>
      <td></td>
      <td></td>
  </tr>
  <?php $rek = $this->db->query("SELECT *, SUM(jam_kerja) as tot_jam, COUNT(id_report) as tot FROM report WHERE id_pegawai = $row[id_pegawai] AND `date` = '$tanggal' GROUP BY `date`");
    $j = explode(".", $rekap['tot_jam']);
    $hours = $j[0];
    $second = $j[1];

    if($second >= 60){
      $menit =$second % 60;

      $jam = $hours + ($second - $menit)/60;
     
    }else{
      $jam = $hours;
      $menit = $second;
    }

    if($rek->num_rows() > 0){

      $rekap = $rek->row_array();
  ?>
  <tr>
    <td></td>
    <td>a</td>
    <td>Jumlah Pekerjaan</td>
    <td>:</td>
    <td><?= $rekap['tot']?></td>
  </tr>
   <tr>
    <td></td>
    <td>b</td>
    <td>Tanggal</td>
    <td>:</td>
    <td><?= format_indo_w($rekap['date'])?></td>
  </tr>
  <tr>
    <td></td>
    <td>c</td>
    <td>Jumlah Jam Kerja</td>
    <td>:</td>
    <td><?= $jam?> Jam <?= $menit?> Menit</td>
  </tr>

  <?php $report = $this->model_app->view_where('report',array('id_pegawai'=>$row['id_pegawai'],'date'=>$tanggal))->result_array();
        $no =1;
        foreach($report as $r){
  ?>
  <tr>
    <td></td>
    <td><?=$no?></td>
    <td>Nama Pekerjaan</td>
    <td>:</td>
    <td><?= ucfirst($r['judul_report'])?></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>Lama Pekerjaan</td>
    <td>:</td>
    <td><?= date('H:i',strtotime($r['start'])).' - '.date('H:i',strtotime($r['end'])) ?> (<?= $r['jam_kerja']?> Jam)</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td valign="top">Dokumentasi</td>
    <td valign="top">:</td>
    <td>
        
       <?php 
    $fotomsk = $r['foto_masuk'];
     if ( $fotomsk==''){
      $ftMsk = './asset/foto_report/no-image.jpg';
     }else{
      $ftMsk = './asset/foto_report/'.$fotomsk;
     }
  ?>

      <img src="<?= $ftMsk?>" style="height: 150px;">

    <?php 
    $fotoKlr = $r['foto_keluar'];
     if ( $fotoKlr==''){
      $ftKlr = './asset/foto_report/no-image.jpg';
     }else{
      $ftKlr = './asset/foto_report/'.$fotoKlr;
     }

  ?> 
    <img src="<?= $ftKlr?>" style="height: 150px;">     
    </td>
  </tr>

  <?php $no++; }?>

  <?php }else{?>
    <tr>
    <td></td>
    <td>a</td>
    <td>Jumlah Pekerjaan</td>
    <td>:</td>
    <td>-</td>
  </tr>
   <tr>
    <td></td>
    <td>b</td>
    <td>Tanggal</td>
    <td>:</td>
    <td>-</td>
  </tr>
  <tr>
    <td></td>
    <td>c</td>
    <td>Jumlah Jam Kerja</td>
    <td>:</td>
    <td>-</td>
  </tr>
   <tr>
    <td></td>
    <td><?=$no?></td>
    <td>Nama Pekerjaan</td>
    <td>:</td>
    <td>-</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>Lama Pekerjaan</td>
    <td>:</td>
    <td>-</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td valign="top">Dokumentasi</td>
    <td valign="top">:</td>
    <td> - </td>
  </tr>
<?php }?>
</table>
</body>
</html>