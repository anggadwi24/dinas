
<?php

	$baca = $rows['dibaca']+1;	
	$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $rows['id_berita']))->num_rows();

?>

 <div class="container-fluid">
 	<div class="row">
 		<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-berita mx-auto float-right">
 			<div class="d-flex flex-row bd-highlight mb-3" style="color: white;">
		  <div class="p-2 bd-highlight">
	        <h1 style="font-size: 48px"><?= $rows[judul]?></h1> <small> <?= $rows[sub_judul]?> </small>
	        <br>	<span class='meta'>
				<span class='icon-text'><i class="fa fa-user"></i></span> <?= $rows['nama_lengkap'] ?>
				<span class='icon-text'><i class="fa fa-clock"></i></span> <?= $rows[jam] .", ".tgl_indo($rows['tanggal']) ?>
				
			</span>
	        </div>
 		</div>
 		<div class="d-flex flex-row bd-highlight mb-3">
 			<div class="p-2 bd-highlight">
 					<?php 
									if ($rows['gambar'] !=''){ echo "<img style='width:100%' src='".base_url()."asset/foto_berita/$rows[gambar]' alt='$rows[judul]' /></a><br><br>"; }
									if ($rows['keterangan_gambar'] !=''){ echo "<center><p><i><b>Keterangan Gambar :</b> $rows[keterangan_gambar]</i></p></center><br>"; }?>
 			</div>
 		</div>
 		<div class="d-flex flex-row bd-highlight mb-3" style="color: white;">
 			<div class="p-2 bd-highlight">
 				<font size="6"><?= $rows['isi_berita']?></font>
 			</div>
 		</div>
 		<div class="d-flex flex-row bd-highlight mb-3" style="color: white;">
 			<div class="p-2 bd-highlight">
 				<?php if ($rows['youtube']!=''){
										echo "<h4>Video Terkait:</h4>";
										if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $rows['youtube'], $match)) {
                                            echo "<iframe width='100%' height='350px' id='ytplayer' type='text/html'
                                                src='https://www.youtube.com/embed/".$match[1]."?rel=0&showinfo=1&color=white&iv_load_policy=3'
                                                frameborder='0' allowfullscreen></iframe><div class='garis'></div><br/>";
                                        } 
									}
				?>
 			</div>
 		</div>
 		<div class="d-flex flex-row bd-highlight mb-3" style="color: white;">
 			<div class="p-2 bd-highlight">
 				<span> <a href="<?= base_url('berita/search/kategori/').$rows['id_kategori']?>"><button class="btn btn-secondary"><?= $rows['nama_kategori']?></button></a></span>
 			</div>
 		</div>
 		<div class="d-flex flex-row bd-highlight mb-3" style="color: white;">
 			<div class="p-2 bd-highlight">
 				<?php
									$tags = (explode(",",$rows['tag']));
									$hitung = count($tags);
									for ($x=0; $x<=$hitung-1; $x++) {
										if ($tags[$x] != ''){
										echo "<a href='".base_url()."berita/search/tag/$tags[$x]'><button class='btn btn-secondary'>$tags[$x]</button></a>   ";
										}
									}
								?>
 			</div>
 			<div class="p-2 bd-highlight ml-auto"><div class="share-block right">
								<div>
									<div class="share-article left">
										
										<strong>Share this article</strong>
									</div>
									<div class="left">
										<script language="javascript">
										document.write("<a href='http://www.facebook.com/share.php?u=" + document.URL + " ' target='_blank' class='custom-soc icon-text'><i class='fab fa-facebook'></i></a> <a href='http://twitter.com/home/?status=" + document.URL + "' target='_blank' class='custom-soc icon-text'><i class='fab fa-twitter'></i></a> <a href='https://plus.google.com/share?url=" + document.URL + "' target='_blank' class='custom-soc icon-text'><i class='fab fa-google-plus'></i></a>");
										</script>
										
									</div>
								</div>
							</div></div>
 		</div>
 	</div>
 	
 </div>
</div>
  <div class="container-fluid">
 	<div class="row">
 		<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-berita mx-auto float-right">
	 		
	       <div class="d-flex flex-row bd-highlight mb-3" style="color: white;">
 			<div class="p-2 bd-highlight">

	        	
				<div id="fb-root"></div>
				<div id="viewcomment" class="block-title">
					<a href="#writecomment" class="right">Write a Facebook Comment</a>
					<h2>Komentar dari Facebook</h2>
				</div>
			</div>
			</div>
	       <div class="d-flex flex-row bd-highlight mb-3" style="color: white;">

			<div class="p-2 bd-highlight">
				<div class="block-content">
					<div class="comment-block">
						<div class="fb-comments" data-href="<?php echo base_url().'/'.$rows['judul_seo']; ?>" data-width="830" data-numposts="5" data-colorscheme="light"></div> 
					</div>
				</div>
			</div>
	        </div>
 		</div>
 	</div>
 	
 </div>
 <?php if ($total_komentar>='1'){ ?>
				
				
		
   <div class="container-fluid">
 	<div class="row">
 		<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-berita mx-auto float-right">
	 		
	       <div class="d-flex flex-row bd-highlight mb-3" style="color: white;">
 			<div class="p-2 bd-highlight">

	        	
				<div id="viewcomment listcomment" class="block-title">
					<a href="#writecomment" class="right">Write a comment</a>
					<h2><?php echo "Ada $total_komentar Komentar untuk Berita Ini"; ?></h2>
				</div>
			</div>
			</div>
	       <div class="d-flex flex-row bd-highlight mb-3" style="color: white;">

			<div class="p-2 bd-highlight">
				<div class="block-content">
					<div class="comment-block">
						<ol class="comments">
							<li>
								<?php
									$no = 1;
									$komentar = $this->model_utama->view_where_ordering_limit('komentar',array('id_berita' => $rows['id_berita'],'aktif' => 'Y'),'id_komentar','ASC',0,100);
			  						foreach ($komentar->result_array() as $kka) {
										$isian=nl2br($kka['isi_komentar']); 
										$komentarku = sensor($isian); 
										
										if(($no % 2)==0){ $warna="#ffffff;"; }else{ $warna="#e3e3e3"; }
										
										echo "
												<strong class='user-nick'>$kka[nama_komentar]</strong>
												<span class='time-stamp'>".tgl_indo($kka['tgl']).", $kka[jam_komentar] WIB</span>
												<div class='comment-text'><p>$komentarku</p></div>
											  </div>";
										$no++;
									}
								?>
							</li>
						</ol>
					</div>
				</div>
			</div>
	        </div>
 		</div>
 	</div>
 	
 </div>
 	<?php } ?>
  <div class="container-fluid">
 	<div class="row">
 		<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-berita mx-auto float-right">
	 		
	       <div class="d-flex flex-row bd-highlight mb-3" style="color: white;">
 			<div class="p-2 bd-highlight">

	        	
				<div class="block-title">
					<a href="#viewcomment" class="right">View all comments</a>
					<h2>Write a comment</h2>
				</div>
			</div>
			</div>
	       <div class="d-flex flex-row bd-highlight mb-3" style="color: white;">

			<div class="p-2 bd-highlight">
				<div class="block-content">
					<div id="writecomment">
						<form action="<?php echo base_url(); ?>berita/kirim_komentar" method="POST" id="form_komentar">
							<input type="hidden" name='a' value='<?php echo "$rows[id_berita]"; ?>'>
							<p class="contact-form-user">
								<label for="c_name">Nickname<span class="required">*</label>
								<input type="text" placeholder="Nickname" value='<?php echo $us['nama_lengkap']; ?>' name='b' class="required form-control" required/>
								
							</p>
							<p class="contact-form-email">
								<label for="c_email">E-mail<span class="required">*</span></label>
								<input type="text" name='e' placeholder="E-mail" value='<?php echo $us['email']; ?>' class="required form-control" required/>
							</p>
							<p class="contact-form-webside">
								<label for="c_webside">Website</label>
								<input type="text" name='c' placeholder="Website" class="required form-control"/>
							</p>
							<p class="contact-form-message">
								<label for="c_message">Comment<span class="required">*</span></label>
								<textarea name='d' placeholder="Your message.." class="required form-control" required></textarea>
							</p>
							
							<p><input type="submit" name="submit" class="btn btn-primary" value="Post a Comment" onclick="return confirm('Haloo, Pesan anda akan tampil setelah kami setujui?')"/></p>
						</form>
						
					</div>
				</div>
	        </div>
 		</div>
 	</div>
 	
 </div>





