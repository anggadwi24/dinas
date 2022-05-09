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
			<?php $child = $this->model_app->view_where('bpjs',array('id_parent'=>$row['id_bpjs'])); 
			if($child->num_rows() > 0){?>
			<div class="col-12 form-group">
				<label>Anggota Keluarga</label>
				<table class="table table-responsive table-stripped">
					<thead>
						<th>No</th>
						<th>Nama</th>
						<th>Tempat Tanggal Lahir</th>
						<th>Jk</th>
						<th>Pekerjaan</th>
						<th>Ket</th>
					</thead>
					<tbody>
				<?php 
				$no=1;
				foreach($child->result_array() as $chl){
					 $n = $chl['nik'];
			        $nik = explode("_", $n);
			          if(isset($nik[1])){
			              $chld = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
			             
			              $peker_chld = $chld['pekerjaan'];
			          }else{
			              $chld = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
			         
			              $per = $this->db->query("SELECT *, nama as pekerjaan FROM jenis_pekerjaan WHERE id_pekerjaan = ".$warga['jenis_pekerjaan']." ")->row_array();
			              $peker_chld = $per['pekerjaan'];
			          }
			    ?>	
			   	<tr>
			    	<td ><?= $no;?></td>
			    	<td ><?= $chld['nama_lengkap']?></td>
			    	<td ><?= $chld['tempat_lahir']?>, <?= date('d-m-Y',strtotime($chld['tanggal_lahir']))?></td>
			    	<td><?= $chld['jenis_kelamin']?></td>
			    	<td><?= $peker_chld?></td>
			    	<td><?= ucfirst($chld['status_hubungan'])?></td>
			   </tr>
			    <?php 
			    $no++;
				}

				?>
				</tbody>
			</table>
			</div>
			<?php }?>
			<div class="col-6 text-right "><a href="<?= base_url('pegawai/approve_child/bpjs/').$row['id_bpjs'].'/id_bpjs'?>" class="text-success"><i class="ri-check-line" style="font-size: 30px"></i></a></div>
			 <div class="col-6 text-left"><a href="<?= base_url('pegawai/disapprove_child/bpjs/').$row['id_bpjs'].'/id_bpjs'?>" class="text-danger"><i class="ri-close-line" style="font-size: 30px"></i></a></div>
		</div>
	</div>
</section>