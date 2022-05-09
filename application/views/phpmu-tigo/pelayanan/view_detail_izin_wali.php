<section id="about" class="about">
	<div class="container" data-aos="fade-up">
		<div class="row justfiy-content-center">
			<div class="col-12 mb-2">
				<div class="section-title">
				<h4><?= $judul ?></h4>
			</div>
			</div>
			<div class="col-12 text-center"><h6>MERTUA</h6> <hr style="width: 50%;border-top: 3px solid #f9ad4a; "></div>
			<div class="col-12 form-group text-center">
				<label>Nama</label>
				<h6><?= $warga['nama_lengkap']?></h6>
			</div>
			<div class="col-12 form-group text-center">
				<label>Jenis Kelamin</label>
				<h6><?= $warga['jenis_kelamin']?></h6>
			</div>
			<div class="col-12 form-group text-center">
				<label>Tempat Tanggal Lahir</label>
				<h6><?= $warga['tempat_lahir']?>, <?= date('d-m-Y',strtotime($warga['tanggal_lahir']))?></h6>
			</div>
			<div class="col-12 form-group text-center">
				<label>Kewarganegaraan</label>
				<h6><?= $warga['kewarganegaraan']?></h6>
			</div>
			<div class="col-12 form-group text-center">
				<label>Status Kawin</label>
				<h6><?= $warga['status_perkawinan']?></h6>
			</div>
			<div class="col-12 form-group text-center">
				<label>Agama</label>
				<h6><?= $warga['agama']?></h6>
			</div>
			<div class="col-12 form-group text-center">
				<label>Pekerjaan</label>
				<h6><?= $pekerjaan?></h6>
			</div>
			<div class="col-12 form-group text-center">
				<label>Alamat</label>
				<h6><?= $warga['alamat']?></h6>
			</div>
		
		
			
			<div class="col-12 text-center">
				<h6>WALI</h6> <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
			</div>
				<?php   $nik_wali= $row['wali'];
				      
				        $wal = explode("_", $nik_wali);
				          if(isset($wal[1])){
				              $wali = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$wal[0]))->row_array();
				            
				              $pekerjaan_wali = $wali['pekerjaan'];
				          }else{
				              $wali = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$nik_wali."'  ")->row_array();
				            
				              $per4 = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$wali['jenis_pekerjaan']." ")->row_array();
				              $pekerjaan_wali = $per4['pekerjaan'];
				          }?>
				        <div class="col-12 form-group text-center text-center">
							<label>NIK</label>
							<h6><?= $wali['nik']?></h6>
						</div>
						<div class="col-12 form-group text-center text-center">
							<label>Nama</label>
							<h6><?= $wali['nama_lengkap']?></h6>
						</div>
						<div class="col-12 form-group text-center text-center">
							<label>Jenis Kelamin</label>
							<h6><?= $wali['jenis_kelamin']?></h6>
						</div>
						<div class="col-12 form-group text-center text-center">
							<label>Tempat Tanggal Lahir</label>
							<h6><?= $wali['tempat_lahir']?>, <?= date('d-m-Y',strtotime($wali['tanggal_lahir']))?></h6>
						</div>
						<div class="col-12 form-group text-center text-center">
							<label>Kewarganegaraan</label>
							<h6><?= $wali['kewarganegaraan']?></h6>
						</div>
						<div class="col-12 form-group text-center text-center">
							<label>Status Kawin</label>
							<h6><?= $wali['status_perkawinan']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Agama</label>
							<h6><?= $wali['agama']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Pekerjaan</label>
							<h6><?= $pekerjaan_wali?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Alamat</label>
							<h6><?= $wali['alamat']?></h6>
						</div>
			
	
			<div class="col-6 text-right "><a href="<?= base_url('pegawai/approve/izin_wali/').$row['id_iw'].'/id_iw'?>" class="text-success"><i class="ri-check-line" style="font-size: 30px"></i></a></div>
			 <div class="col-6 text-left"><a href="<?= base_url('pegawai/disapprove/izin_wali/').$row['id_iw'].'/id_iw'?>" class="text-danger"><i class="ri-close-line" style="font-size: 30px"></i></a></div>
		</div>
	</div>
</section>