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
				<h6><?= $warga['alamat']?></h6>
			</div>
			<div class="col-12 form-group">
				<label>Maksud</label>
				<h6><?= $row['untuk']?></h6>
			</div>
			<div class="col-6 text-right "><a href="<?= base_url('pegawai/approve/jampersal/').$row['id_jampersal'].'/id_jampersal'?>" class="text-success"><i class="ri-check-line" style="font-size: 30px"></i></a></div>
			 <div class="col-6 text-left"><a href="<?= base_url('pegawai/disapprove/jampersal/').$row['id_jampersal'].'/id_jampersal'?>" class="text-danger"><i class="ri-close-line" style="font-size: 30px"></i></a></div>
		</div>
	</div>
</section>