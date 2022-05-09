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
    $foto = lastExplode($row['foto']);
     if (!file_exists("asset/foto_user/$foto") OR $foto==''){
      $pp = './asset/foto_user/blank.png';
     }else{
      $pp = './asset/foto_user/'.$foto;
     }
  ?>
<center>
  <h3>LEMBAR KINERJA HARIAN GURU </h3>
  <h5><?= strtoupper($row['nama_cabang'])?></h5>
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
      <td><b><?= ucfirst($row['nama_guru'])?></b></td>
    </tr>
    <tr>
      <td></td>
      <td>2</td>
      <td>NIP</td>
      <td>:</td>
      <td><?= ucfirst($row['nip'])?></td>
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
      <td><?= ucfirst($row['status_kepegawaian'].' - '.$row['jenis_ptk'])?></td>
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
      <td><?= $row['hp']?></td>
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
      <td>Tugas Tambahan</td>
      <td>:</td>
      <td><?= ucfirst($row['tugas_tambahan'])?></td>
    </tr>
   




  <tr>
      <td><b>B</b></td>
      <td colspan="2"><b>Rekapitulasi Kinerja Bulanan</b></td>
      <td></td>
      <td></td>
  </tr>
  <tr>
    <td></td>
    <td>1</td>
    <td>Dari Tanggal</td>
    <td>:</td>
    <td><?= format_indo_w(date('Y-m-01'))?></td>
  </tr>
   <tr>
    <td></td>
    <td>2</td>
    <td>Sampai Tanggal</td>
    <td>:</td>
    <td><?= format_indo_w(date('Y-m-d'))?></td>
  </tr>
  <tr>
    <td></td>
    <td>3</td>
    <td>Bulan</td>
    <td>:</td>
    <td><?= bulan(date('m')).' '.date('Y')?></td>
  </tr>
   <tr>
    <td></td>
    <td>4</td>
    <td>Persentase Kehadiran</td>
    <td>:</td>
    <td><b><?= $persentase?>%</b></td>
  </tr>
  
   <tr>
    <td></td>
    <td>5</td>
    <td>Persentase Kinerja</td>
    <td>:</td>
    <td><b><?= $kinerja?>%</b></td>
  </tr>
   <tr>
    <td></td>
    <td>6</td>
    <td>Keterangan</td>
    <td>:</td>
    <td><b><?= $status?></b></td>
  </tr>

    <tr>
    <td></td>
    <td>7</td>
    <td>Jumlah Telat Datang</td>
    <td>:</td>
    <td><?= $telat?></td>
  </tr>
    <tr>
    <td></td>
    <td>8</td>
    <td>Jumlah Cepat Pulang</td>
    <td>:</td>
    <td><?= $pulang?></td>
  </tr>
    <tr>
    <td></td>
    <td>9</td>
    <td>Jumlah Alpa</td>
    <td>:</td>
    <td><?= $alpha?></td>
  </tr>
    <tr>
    <td></td>
    <td>10</td>
    <td>Jumlah Izin</td>
    <td>:</td>
    <td><?= $izin?></td>
  </tr>

  <tr>
    <td></td>
    <td>11</td>
    <td>Jumlah Sakit</td>
    <td>:</td>
    <td><?= $sakit?></td>
  </tr>
    <tr>
    <td></td>
    <td>12</td>
    <td>Jumlah Pekerjaan</td>
    <td>:</td>
    <td><?= $jumlah_kerja?></td>
  </tr>
   <tr>
    <td></td>
    <td>13</td>
    <td>Lama Pekerjaan</td>
    <td>:</td>
    <td><?= $lama_kerja?> Jam</td>
  </tr>





   <tr>
      <td><b>C</b></td>
      <td colspan="2"><b>Dokumentasi Pekerjaan</b></td>
      <td></td>
      <td></td>
  </tr>


  <?php $report = $this->model_app->view_where('report',array('id_pegawai'=>$row['id_guru'],'MONTH(date)'=>$month,'YEAR(date)'=>$year,'status_report'=>'guru'))->result_array();
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
    $fotomsk = lastExplode($r['foto_masuk']);
     if ( $fotomsk==''){
      $ftMsk = './asset/foto_report/no-image.jpg';
     }else{
      $ftMsk = './asset/foto_report/'.$fotomsk;
     }
  ?>

      <img src="<?= $ftMsk?>" style="height: 150px;">

    <?php 
    $fotoKlr = lastExplode($r['foto_keluar']);
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
</table>
</body>
</html>