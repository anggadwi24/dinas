<section id="about" class="about">
	<div class="container" data-aos="fade-up">
		<div class="row justfiy-content-center">
			<div class="col-12 mb-2">
				<div class="section-title">
				<h4><?= $judul ?></h4>
			</div>
			</div>
			
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
				<label>Umur</label>
				<h6><?= date('Y') - date('Y',strtotime($warga['tanggal_lahir']))?> Tahun</h6>
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
			<div class="col-12 form-group text-center">
				
				<h6>TELAH MENINGGAL DUNIA PADA:</h6>
			</div>
			<div class="col-12 form-group text-center">
				<label>Tanggal</label>
				<h6><?= format_indo($row['tanggal']) ?></h6>
			</div>
			<div class="col-12 form-group text-center">
				<label>Di</label>
				<h6><?= $row['di']?></h6>
			</div>
			<div class="col-12 form-group text-center">
				<label>Karena</label>
				<h6><?= $row['karena']?></h6>
			</div>
		
			
			<div class="col-12 text-center">
				<h2>PELAPOR</h2> <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
			</div>
				<?php   $nik_wali= $row['pelapor'];
				      
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
							<label>Hubungan dengan almarhum</label>
							<h6><?= $row['hubungan']?></h6>
						</div>
			
	
			<div class="col-6 text-right "><a href="<?= base_url('pegawai/approve/surat_kematian/').$row['id_sk'].'/id_sk'?>" class="text-success"><i class="ri-check-line" style="font-size: 30px"></i></a></div>
			 <div class="col-6 text-left"><a href="<?= base_url('pegawai/disapprove/surat_kematian/').$row['id_sk'].'/id_sk'?>" class="text-danger"><i class="ri-close-line" style="font-size: 30px"></i></a></div>
		</div>
	</div>
</section>