<section id="about" class="about">
	<div class="container" data-aos="fade-up">
		<div class="row justfiy-content-center">
			<div class="col-12 mb-2">
				<div class="section-title">
				<h4><?= $judul ?></h4>
			</div>
			</div>
			
			<div class="col-12">
				<div class="row">
					<?php  
				        $nik_suami = $row['ayah'];

				        $su = explode("_", $nik_suami);
				          if(isset($su[1])){
				              $suami = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$su[0]))->row_array();
				            
				              $pekerjaan_suami = $suami['pekerjaan'];
				          }else{
				              $suami = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$nik_suami."'  ")->row_array();
				            
				              $per2 = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$suami['jenis_pekerjaan']." ")->row_array();
				              $pekerjaan_suami = $per2['pekerjaan'];
				           }

				              $nik_istri= $row['ibu'];
				      
				        $is = explode("_", $nik_istri);
				          if(isset($is[1])){
				              $istri = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$is[0]))->row_array();
				            
				              $pekerjaan_istri = $istri['pekerjaan'];
				          }else{
				              $istri = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$nik_istri."'  ")->row_array();
				            
				              $per3 = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$istri['jenis_pekerjaan']." ")->row_array();
				              $pekerjaan_istri = $per3['pekerjaan'];
				          }?>
					<div class="col-6 text-center">
						<div class="col-12 text-center"><h6>AYAH</h6> <hr style="width: 50%;border-top: 3px solid #f9ad4a; "></div>
						<div class="col-12 form-group text-center">
							<label>Nama</label>
							<h6><?= $suami['nama_lengkap']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Jenis Kelamin</label>
							<h6><?= $suami['jenis_kelamin']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Tempat Tanggal Lahir</label>
							<h6><?= $suami['tempat_lahir']?>, <?= date('d-m-Y',strtotime($suami['tanggal_lahir']))?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Kewarganegaraan</label>
							<h6><?= $suami['kewarganegaraan']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Status Kawin</label>
							<h6><?= $suami['status_perkawinan']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Agama</label>
							<h6><?= $suami['agama']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Pekerjaan</label>
							<h6><?= $pekerjaan_suami?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Alamat</label>
							<h6><?= $warga['alamat']?></h6>
						</div>
					</div>
					<div class="col-6 text-center">
						<div class="col-12 text-center"><h6>IBU</h6> <hr style="width: 50%;border-top: 3px solid #f9ad4a; "></div>
						<div class="col-12 form-group text-center">
							<label>Nama</label>
							<h6><?= $istri['nama_lengkap']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Jenis Kelamin</label>
							<h6><?= $istri['jenis_kelamin']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Tempat Tanggal Lahir</label>
							<h6><?= $istri['tempat_lahir']?>, <?= date('d-m-Y',strtotime($istri['tanggal_lahir']))?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Kewarganegaraan</label>
							<h6><?= $istri['kewarganegaraan']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Status Kawin</label>
							<h6><?= $istri['status_perkawinan']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Agama</label>
							<h6><?= $istri['agama']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Pekerjaan</label>
							<h6><?= $pekerjaan_istri?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Alamat</label>
							<h6><?= $istri['alamat']?></h6>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 text-center"><h6>MELAHIRKAN SEORANG <?= strtoupper($row['jenis_kelamin'])?></h6> <hr style="width: 50%;border-top: 3px solid #f9ad4a; "></div>
			<div class="col-12 text-center form-group">
				<label>Nama Anak</label>
				<h6><?= ucfirst($row['nama'])?></h6>
			</div>
			<div class="col-12 text-center form-group">
				<label>Anak Ke</label>
				<h6><?= $row['anak']?> ( <?= terbilang1($row['anak']) ?> ) </h6>
			</div>
			<div class="col-12 text-center form-group">
				<label>Tanggal</label>
				<h6><?= date('d/m/Y',strtotime($row['tanggal']))?></h6>
			</div>
			<div class="col-12 text-center form-group">
				<label>Di</label>
				<h6><?= $row['alamat']?></h6>
			</div>
			<div class="col-6 text-right "><a href="<?= base_url('pegawai/approve/surat_kelahiran/').$row['id_sk'].'/id_sk'?>" class="text-success"><i class="ri-check-line" style="font-size: 30px"></i></a></div>
			 <div class="col-6 text-left"><a href="<?= base_url('pegawai/disapprove/surat_kelahiran/').$row['id_sk'].'/id_sk'?>" class="text-danger"><i class="ri-close-line" style="font-size: 30px"></i></a></div>
		</div>
	</div>
</section>