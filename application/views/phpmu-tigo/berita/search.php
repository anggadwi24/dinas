
   <div class="container-fluid">
 	<div class="row">
 		
 		<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-berita mx-auto">
 			<div class="float-left" style="max-width: 400px;">
	 			<?php if($this->uri->segment('3') == 'kategori'){ ?>
	 			<h2 style="color: white;">Kategori : <?= $this->uri->segment('4')?></h2>

	 			<?php }elseif($this->uri->segment('3') == 'tag'){ ?>
	 			<h2 style="color: white;">Tag : <?= $this->uri->segment('4')?></h2>

	 			<?php }elseif($this->uri->segment('3') == 'keyword'){?>
				 <h2 style="color: white;">Keyword : <?= $this->input->get('key')?></h2>
	 			<?php } ?>
	        
 		</div>
	 		<div class="float-right" style="max-width: 500px;">
	 			<form action="<?= base_url('berita/search/keyword')?>" method="GET" class="form-inline">
	
					 <div class="form-group mx-sm-3 mb-2">
					    <label for="inputPassword2" ><h2 style="margin-right: 40px;color: white;">Search : </h2></label>
					    <input type="text" class="form-control" id="inputPassword2" name="key" placeholder="Cari berita">
					  </div>
					  <button type="submit" class="btn btn-primary mb-2">SEARCH</button>

	 			</form>
	 		</div>
	 			
	        
 		</div>
 	</div>
 	
 </div>
<?php
	foreach ($berita->result_array() as $r) {	
			  $baca = $r['dibaca']+1;	
			  $isi_berita =(strip_tags($r['isi_berita'])); 
			  $isi = substr($isi_berita,0,150); 
			  $isi = substr($isi_berita,0,strrpos($isi," ")); 
			  $judul = substr($r['judul'],0,33); 
			  $total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r['id_berita']))->num_rows();
?>
  <div class="container-fluid">
    <div class="row">

      <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-berita mx-auto">
        <a href="<?= base_url('berita/detail/').$r['judul_seo'] ?>" class="hover-effect">
       <div class="d-flex flex-row bd-highlight mb-3">
		  <div class="p-2 bd-highlight">
		  	<?php if($r['gambar'] == ''){ ?>
		  	<img src="<?= base_url('asset/foto_berita/no-image.jpg')?>" style="width: 150px;height: 150px;">

		  	<?php }else{ ?>
		  	<img src="<?= base_url('asset/foto_berita/').$r['gambar']?>" style="width: 150px;height: 150px;">
		  	
		  	<?php }?>
		  </div>
		  <div class="p-2 bd-highlight">
		  	<h2><?= $judul.'...'?></h2>
		  	
		  	<span class='meta'>
				<span class='icon-text'><i class="fa fa-user"></i></span> <?= $r['nama_lengkap'] ?>
				<span class='icon-text'><i class="fa fa-clock"></i></span> <?= $r[jam] .", ".tgl_indo($r['tanggal']) ?>
				<span class='icon-text'><i class="fa fa-comments"></i></span> <?= $total_komentar ?>
			</span>
				<p><?= getSearchTermToBold($isi,$this->input->post('kata'))." . . .";?></p>
				<span class='meta'>
					<a href=" <?= base_url('berita/').$r[judul_seo] ?>" class='more'>Read Full Article<span class='icon-text'>&#9656;</span></a>
				</span>
		  </div>
		</div>


  	</a>
    </div>
    
  </div>
 <?php } ?>
 <?php if($total > 5){?>
 <div class="container-fluid">
 	<div class="row">
 		<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-berita mx-auto float-right">
 		<nav aria-label="Page navigation"><?php echo $this->pagination->create_links(); ?></nav>
		
 		</div>
 	</div>
 	
 </div>
<?php }?>

  <div class="container-fluid">
 	<div class="row">
 		<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-berita mx-auto float-right">
	 		<div class="d-flex justify-content-center font-aur">
	        <h2>KATEGORI</h2>
	        </div>
	        <div class="kategori">
	        
	        <?php foreach($kategori->result_array() as $kat) {?>
	        <?php $random = array('btn btn-primary','btn btn-secondary','btn btn-success','btn btn-danger','btn btn-warning','btn btn-info','btn btn-light','btn btn-dark');
	        $btn = $random[rand(0,7)];
	        	

	        ?>
	       <a href="<?= base_url('berita/search/kategori/').$kat['kategori_seo']?>"><button type="button" class="<?= $btn ?>"><?= strtoupper($kat['nama_kategori']) ?></button></a>
	      <?php } ?>

	        	


	        </div>
 		</div>
 	</div>
 	
 </div>
  <div class="container-fluid">
 	<div class="row">
 		<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-berita mx-auto float-right">
	 		<div class="d-flex justify-content-center font-aur">
	        <h2>TAG</h2>
	        </div>
	        <div class="kategori">
	        
	        <?php foreach($tag->result_array() as $t) {?>
	        	<?php $random = array('btn btn-primary','btn btn-secondary','btn btn-success','btn btn-danger','btn btn-warning','btn btn-info','btn btn-light','btn btn-dark');
	        	$btn = $random[rand(0,7)];
	        	

	        ?>
	       <a href="<?= base_url('berita/search/tag/').$t['tag_seo']?>"><button type="button" class="<?= $btn ?>"><?= strtoupper($t['nama_tag']) ?></button></a>
	      <?php } ?>

	        	


	        </div>
 		</div>
 	</div>
 	
 </div>