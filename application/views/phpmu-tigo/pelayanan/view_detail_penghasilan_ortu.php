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
				<label>Penghasilan Perbulan</label>
				<h6>± Rp. <?= rupiah($row['penghasilan'])?> <i>( <?= terbilang($row['penghasilan'])?> Rupiah ) </i></h6>
			</div>
			<?php 

				$nod = $row['ortu_dari'];
		        $nik = explode("_", $nod);
		          if(isset($nik[1])){
		              $od = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
		           
		          }else{
		              $od = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$nod."'  ")->row_array();
		             
		          }
			?>
			<div class="col-12">
				 <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
				 <h6>Orang Tua dari : </h6>
				 <h6><?= $warga['nama_lengkap']?></h6>
			</div>
			
		
			<div class="col-6 text-right "><a href="<?= base_url('pegawai/approve/penghasilan_ortu/').$row['id_po'].'/id_po'?>" class="text-success"><i class="ri-check-line" style="font-size: 30px"></i></a></div>
			 <div class="col-6 text-left"><a href="<?= base_url('pegawai/disapprove/penghasilan_ortu/').$row['id_po'].'/id_po'?>" class="text-danger"><i class="ri-close-line" style="font-size: 30px"></i></a></div>
		</div>
	</div>
</section>