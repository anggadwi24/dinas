<?php 

		$loc = $this->db->query("SELECT *,a.nama as nama_prov, b.nama as nama_kab, c.nama as nama_kec, d.nama as nama_kel FROM provinsi a JOIN kabupaten b ON a.id_prov = b.id_prov JOIN kecamatan c ON b.id_kab = c.id_kab JOIN kelurahan d ON c.id_kec = d.id_kec WHERE d.id_kel = '".$warga['kelurahan']."'")->row_array();
?>
<section id="about" class="about">
	<div class="container" data-aos="fade-up">
		<div class="row justfiy-content-center">
			<div class="col-12 mb-2">
				<div class="section-title">
				<h4><?= $judul ?></h4>
			</div>
			</div>
			<div class="col-12 form-group">
				<label>Nama</label>
				<h6><?= $warga['nama_lengkap']?></h6>
			</div>
			<div class="col-12 form-group">
				<label>Jenis Kelamin</label>
				<h6><?= $warga['jenis_kelamin']?></h6>
			</div>
			<div class="col-12 form-group">
				<label>Tempat Tanggal Lahir</label>
				<h6><?= $warga['tempat_lahir']?>, <?= date('d-m-Y',strtotime($warga['tanggal_lahir']))?></h6>
			</div>
			<div class="col-12 form-group">
				<label>Kewarganegaraan</label>
				<h6><?= $warga['kewarganegaraan']?></h6>
			</div>
			<div class="col-12 form-group">
				<label>Status Kawin</label>
				<h6><?= $warga['status_perkawinan']?></h6>
			</div>
			<div class="col-12 form-group">
				<label>Agama</label>
				<h6><?= $warga['agama']?></h6>
			</div>
			<div class="col-12 form-group">
				<label>Pekerjaan</label>
				<h6><?= $pekerjaan?></h6>
			</div>
			<div class="col-12 form-group">
				<label>Alamat</label>
				<h6><?= $warga['alamat']?>. Kel. <?= $loc['nama_kel'] ?>, Kec. <?= $loc['nama_kec']?>, Kab. <?= $loc['nama_kab']?>, Prov. <?= $loc['nama_prov'] ?></h6>
			</div>
			
			<div class="col-6 text-right "><a href="<?= base_url('pegawai/approve/keterangan_domisili/').$row['id_kd'].'/id_kd'?>" class="text-success"><i class="ri-check-line" style="font-size: 30px"></i></a></div>
			 <div class="col-6 text-left"><a href="<?= base_url('pegawai/disapprove/keterangan_domisili/').$row['id_kd'].'/id_kd'?>" class="text-danger"><i class="ri-close-line" style="font-size: 30px"></i></a></div>
		</div>
	</div>
</section>