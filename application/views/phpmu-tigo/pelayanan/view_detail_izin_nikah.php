<section id="about" class="about">
	<div class="container" data-aos="fade-up">
		<div class="row justfiy-content-center">
			<div class="col-12 mb-2">
				<div class="section-title">
				<h4><?= $judul ?></h4>
			</div>
			</div>
			<div class="col-12 text-center"><h6>YANG MENGAJUKAN</h6> <hr style="width: 50%;border-top: 3px solid #f9ad4a; "></div>
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
			<div class="col-12">
				<div class="row">
					<?php  
				        $nika = $row['ayah'];
				        
				        $nik_a = explode("_", $nika);
				          if(isset($nik_a[1])){
				              $ayah = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik_a[0]))->row_array();
				            
				              $pekerjaan_ayah = $warga['pekerjaan'];
				          }else{
				              $ayah = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$nika."'  ")->row_array();
				            
				              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$ayah['jenis_pekerjaan']." ")->row_array();
				              $pekerjaan_ayah = $per['pekerjaan'];
				           }

				              $nikb = $row['ibu'];
				      
				        $nik_b = explode("_", $nikb);
				          if(isset($nik_a[1])){
				              $ibu = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik_b[0]))->row_array();
				            
				              $pekerjaan_ibu = $warga['pekerjaan'];
				          }else{
				              $ibu = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$nikb."'  ")->row_array();
				            
				              $per1 = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$ibu['jenis_pekerjaan']." ")->row_array();
				              $pekerjaan_ibu = $per1['pekerjaan'];
				          }?>
					<div class="col-6 text-center">
						<div class="col-12 text-center"><h6>AYAH</h6> <hr style="width: 50%;border-top: 3px solid #f9ad4a; "></div>
						<div class="col-12 form-group text-center"><label>Nama Ayah</label><h6><?= $ayah['nama_lengkap']?></h6></div>
						<div class="col-12 form-group text-center"><label>NIK Ayah</label><h6><?= $ayah['nik']?></h6></div>
					</div>
					<div class="col-6 text-center">
						<div class="col-12 text-center"><h6>IBU</h6> <hr style="width: 50%;border-top: 3px solid #f9ad4a; "></div>
						<div class="col-12 form-group text-center"><label>Nama Ibu</label><h6><?= $ibu['nama_lengkap']?></h6></div>
						<div class="col-12 form-group text-center"><label>NIK Ibu</label><h6><?= $ibu['nik']?></h6></div>
					</div>
				</div>
			</div>
				<div class="col-12 text-center"><hr style="width: 80%;border-top: 3px solid #f9ad66; "></div>
			<div class="col-12">
				<div class="row">
					<?php  
				        $nik_suami = $row['suami'];

				        $su = explode("_", $nik_suami);
				          if(isset($su[1])){
				              $suami = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$su[0]))->row_array();
				            
				              $pekerjaan_suami = $suami['pekerjaan'];
				          }else{
				              $suami = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$nik_suami."'  ")->row_array();
				            
				              $per2 = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$suami['jenis_pekerjaan']." ")->row_array();
				              $pekerjaan_suami = $per2['pekerjaan'];
				           }

				              $nik_istri= $row['istri'];
				      
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
						<div class="col-12 text-center"><h6>SUAMI</h6> <hr style="width: 50%;border-top: 3px solid #f9ad4a; "></div>
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
						<div class="col-12 text-center"><h6>ISTRI</h6> <hr style="width: 50%;border-top: 3px solid #f9ad4a; "></div>
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
			<div class="col-12 text-center">
				<label>Waktu Nikah</label>
				<h6><?= date('d/m/Y H:i:s',strtotime($row['waktu_nikah']))?></h6>
			</div>
			<div class="col-12 text-center">
				<label>Tempat Nikah</label>
				<h6><?= $row['tempat_nikah']?></h6>
			</div>
			<div class="col-12 text-center"><h5>IZIN ORANG TUA/WALI</h5></div>
			<?php if($row['izin'] == 'wali'):?>

			<div class="col-12 text-center">
				<h6>WALI</h6> <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
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
			</div>
			<?php elseif($row['izin'] == 'ayah'):?>
					  <div class="col-12 text-center"><h6>AYAH</h6> <hr style="width: 50%;border-top: 3px solid #f9ad4a; "></div>
					  <div class="col-12 form-group text-center">
							<label>NIK</label>
							<h6><?= $ayah['nik']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Nama</label>
							<h6><?= $ayah['nama_lengkap']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Jenis Kelamin</label>
							<h6><?= $ayah['jenis_kelamin']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Tempat Tanggal Lahir</label>
							<h6><?= $ayah['tempat_lahir']?>, <?= date('d-m-Y',strtotime($ayah['tanggal_lahir']))?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Kewarganegaraan</label>
							<h6><?= $ayah['kewarganegaraan']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Status Kawin</label>
							<h6><?= $ayah['status_perkawinan']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Agama</label>
							<h6><?= $ayah['agama']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Pekerjaan</label>
							<h6><?= $pekerjaan_ayah?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Alamat</label>
							<h6><?= $ayah['alamat']?></h6>
						</div>
			<?php elseif($row['izin'] == 'ibu'):?>
				<div class="col-12 text-center"><h6>IBU</h6> <hr style="width: 50%;border-top: 3px solid #f9ad4a; "></div>
					  <div class="col-12 form-group text-center">
							<label>NIK</label>
							<h6><?= $ibu['nik']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Nama</label>
							<h6><?= $ibu['nama_lengkap']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Jenis Kelamin</label>
							<h6><?= $ibu['jenis_kelamin']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Tempat Tanggal Lahir</label>
							<h6><?= $ibu['tempat_lahir']?>, <?= date('d-m-Y',strtotime($ibu['tanggal_lahir']))?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Kewarganegaraan</label>
							<h6><?= $ibu['kewarganegaraan']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Status Kawin</label>
							<h6><?= $ibu['status_perkawinan']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Agama</label>
							<h6><?= $ibu['agama']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Pekerjaan</label>
							<h6><?= $pekerjaan_ibu?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Alamat</label>
							<h6><?= $ibu['alamat']?></h6>
						</div>
				<?php else:?>
					<div class="col-12 text-center"><h6>AYAH</h6> <hr style="width: 50%;border-top: 3px solid #f9ad4a; "></div>
					  <div class="col-12 form-group text-center">
							<label>NIK</label>
							<h6><?= $ayah['nik']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Nama</label>
							<h6><?= $ayah['nama_lengkap']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Jenis Kelamin</label>
							<h6><?= $ayah['jenis_kelamin']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Tempat Tanggal Lahir</label>
							<h6><?= $ayah['tempat_lahir']?>, <?= date('d-m-Y',strtotime($ayah['tanggal_lahir']))?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Kewarganegaraan</label>
							<h6><?= $ayah['kewarganegaraan']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Status Kawin</label>
							<h6><?= $ayah['status_perkawinan']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Agama</label>
							<h6><?= $ayah['agama']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Pekerjaan</label>
							<h6><?= $pekerjaan_ayah?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Alamat</label>
							<h6><?= $ayah['alamat']?></h6>
						</div>
						<div class="col-12 text-center"><h6>IBU</h6> <hr style="width: 50%;border-top: 3px solid #f9ad4a; "></div>
					  <div class="col-12 form-group text-center">
							<label>NIK</label>
							<h6><?= $ibu['nik']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Nama</label>
							<h6><?= $ibu['nama_lengkap']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Jenis Kelamin</label>
							<h6><?= $ibu['jenis_kelamin']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Tempat Tanggal Lahir</label>
							<h6><?= $ibu['tempat_lahir']?>, <?= date('d-m-Y',strtotime($ibu['tanggal_lahir']))?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Kewarganegaraan</label>
							<h6><?= $ibu['kewarganegaraan']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Status Kawin</label>
							<h6><?= $ibu['status_perkawinan']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Agama</label>
							<h6><?= $ibu['agama']?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Pekerjaan</label>
							<h6><?= $pekerjaan_ibu?></h6>
						</div>
						<div class="col-12 form-group text-center">
							<label>Alamat</label>
							<h6><?= $ibu['alamat']?></h6>
						</div>

		<?php endif;?>
			<div class="col-6 text-right "><a href="<?= base_url('pegawai/approve/izin_nikah/').$row['id_in'].'/id_in'?>" class="text-success"><i class="ri-check-line" style="font-size: 30px"></i></a></div>
			 <div class="col-6 text-left"><a href="<?= base_url('pegawai/disapprove/izin_nikah/').$row['id_in'].'/id_in'?>" class="text-danger"><i class="ri-close-line" style="font-size: 30px"></i></a></div>
		</div>
	</div>
</section>