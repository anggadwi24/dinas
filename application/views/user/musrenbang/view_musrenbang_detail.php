<?php 

	$sk = $this->model_app->view_where('skpd',array('id_skpd'=>$row['kode_skpd']))->row_array();
	$ul = $this->model_app->view_where('usulan',array('id_usulan'=>$row['usulan']))->row_array();
	$kab = "Polewali Mandar";
	$kec = $this->model_app->view_where('kecamatan',array('id_kec'=>$row['kecamatan']))->row_array();
	$kel = $this->model_app->view_where('kelurahan',array('id_kel'=>$row['kelurahan']))->row_array();


	if($row['app_kab'] == 'y' AND $row['app_kec'] == 'y' AND $row['app_kel'] == 'y'){
		$status = "Prioritas";
	}else{
		$status = "Proses";
	}
?>

<section id="about" class="about" style="padding-top: 10px !important;">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2><?= $judul ?></h2>
          <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
          <h6>Status : <?= $status?> </h6>
        </div>
        <div class="row ">
        	<div class="form-group col-3">
        		<label>Kode SKPD</label>
        		<h6><?= $sk['kode_skpd']?></h6>
        	</div>
        	<div class="form-group col-9">
        		<label>SKPD</label>
        		<h6><?= $sk['skpd']?></h6>
        	</div>
        	<div class="form-group col-12">
        		<label>Kegiatan</label>
        		<h6><?= $row['kegiatan']?></h6>
        	</div>
        	<div class="form-group col-4">
        		<label>Kabupaten</label>
        		<h6><?= $kab?></h6>
        	</div>
        	<div class="form-group col-4">
        		<label>Kecamatan</label>
        		<h6><?= $kec['nama']?></h6>
        	</div>
        	<div class="form-group col-4">
        		<label>Kelurahan</label>
        		<h6><?= $kel['nama']?></h6>
        	</div>
        	<div class="form-group col-12">
        		<label>Alamat</label>
        		<h6><?= $row['alamat']?></h6>
        	</div>
        	<div class="form-group col-12">
        		<label>Usulan</label>
        		<h6><?= $ul['usulan']?> ( <?= ucfirst($ul['tipe_usulan']) ?> )</h6>
        	</div>
        	<div class="form-group col-6">
        		<label>Realisasi</label>
        		<h6><?= $row['realisasi']?></h6>
        	</div>
        	<div class="form-group col-6">
        		<label>Tanggal Realisasi</label>
        		<h6><?= format_indo($row['tanggal_realisasi'])?></h6>
        	</div>
        </div>
       </div>
</section>