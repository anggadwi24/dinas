<section id="about" class="about">
	<div class="container" data-aos="fade-up">
		<div class="row justfiy-content-center text-center">
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
				<label>Keperluan</label>
				<h6><?= $row['keperluan']?></h6>
			</div>
			<div class="col-12">
				 <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
			</div>
			<div class="col-12 mb-2">
				<div class="section-title">
				<h4>USAHA</h4>
				</div>
			</div>
			<div class="col-12 form-group">
				<label>Nama Usaha</label>
				<h6><?= $row['nama_usaha']?></h6>
			</div>
			<div class="col-12 form-group">
				<label>Jenis Usaha</label>
				<h6><?= $row['jenis_usaha']?></h6>
			</div>
			<div class="col-12 form-group">
				<label>Jenis Usaha</label>
				<h6><?= $row['jenis_usaha']?></h6>
			</div>
			<div class="col-12 form-group">
				<label>Alamat Usaha</label>
				<h6><?= $row['alamat_usaha']?></h6>
			</div>
			<div class="col-12 form-group">
				<label>Tanggal Beridirinya Usaha</label>
				<h6><?= date('d/m/Y',strtotime($row['tanggal_berdiri']))?></h6>
			</div>
			<div class="col-12 form-group">
				<label>Tanggal Berhenti</label>
				<h6><?= date('d/m/Y',strtotime($row['tanggal_berhenti']))?></h6>
			</div>
			<div class="col-6 text-right "><a href="<?= base_url('pegawai/approve_usaha/usaha_tidak/').$row['id_ut'].'/id_ut/'.$row['id_usaha']?>" class="text-success"><i class="ri-check-line" style="font-size: 30px"></i></a></div>
			 <div class="col-6 text-left"><a href="<?= base_url('pegawai/disapprove_usaha/usaha_tidak/').$row['id_ut'].'/id_ut'?>" class="text-danger"><i class="ri-close-line" style="font-size: 30px"></i></a></div>
		</div>
	</div>
</section>