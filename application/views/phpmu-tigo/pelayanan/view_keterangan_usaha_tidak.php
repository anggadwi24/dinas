
<div class="row justfiy-content-center">
<div class="col-12">
	<div class="section-title">
	<h4><?= $judul ?></h4>
</div>
</div>


			<div class="col-12">

			<?php
					$no = 1;
					foreach($record->result_array() as $row):
						   	  $n = $row['nik'];
						      $nik = explode("_", $n);
						      if(isset($nik[1])){

						        $war = $this->model_app->view_where('anggota_keluarga_temp',array('nik'=>$nik[0]))->row_array();
						      }else{
						        
						        $war = $this->db->query("SELECT * FROM kartukeluarga a JOIN anggota_keluarga b ON a.no_kk = b.no_kk WHERE b.nik = '".$n."'  ")->row_array();
						      }
			 ?>
			 
			 <?php if($no%2 == 0){?>
			 <div class="row bg-white p-2">
			 <?php }else{?>
			 	<div class="row  bg-light p-2">
			 <?php }?>
			 		<div class="col-1"><a href="<?= base_url('pegawai/detail_keterangan_usaha_tidak/').$row['id_ut']?>"><h6><?= $no;?>.</h6></a></div>
			 		<div class="col-10"><a href="<?= base_url('pegawai/detail_keterangan_usaha_tidak/').$row['id_ut']?>"><h6><?= ucfirst($war['nik'])?></h6></a></div>
			 		<div class="col-12"><a href="<?= base_url('pegawai/detail_keterangan_usaha_tidak/').$row['id_ut']?>"><h6><?= ucfirst($war['nama_lengkap'])?></h6></a></div>
			 		<div class="col-8 text-left"><a href="<?= base_url('home/detail_keterangan_usaha_tidak/').$row['id_ut']?>"><h6><?= date('Y/m/d H:i:s',strtotime($row['created_at']))?></h6></a></div>
			 		<div class="col-2 "><a href="<?= base_url('pegawai/approve_usaha/usaha/').$row['id_ut'].'/id_ut/'.$row['id_usaha']?>" class="text-success"><i class="ri-check-line"></i></a></div>
			 		<div class="col-2"><a href="<?= base_url('pegawai/disapprove_usaha/usaha/').$row['id_ut'].'/id_ut'?>" class="text-danger"><i class="ri-close-line"></i></a></div>
			 		
			 		
			 </div>
			
			 <?php $no++; endforeach;?>
			 </div>
	
</div>
</div>