 <div class="col-12 mt-3">
   <a href="<?= base_url('home/tutorial') ?>"><i class="ri-arrow-go-back-line text-dark" style="font-size:30px;"></i></a>
 </div>
 <?php

                         $adm = $this->model_app->view_where('users',array('username'=>$row['created_by']))->row_array();
                         $nama = $adm['nama_lengkap'];
                         $pp = $adm['foto'];
                          $lvl = $adm['level'];
                
                         if (!file_exists("asset/foto_user/$pp") OR $pp==''){
                             $foto = "blank.png";
                          }else{
                            $foto = $pp;
                          }
  ?>
 <section id="about-video" class="about-video" >
      <div class="container">
        
        <div  class="row">
          
          <div class="col-12 mb-2 embed-responsive embed-responsive-21by9" >
                                     <video
                                                                id="my-video"
                                                                class="video-js vjs-theme-forest embed-responsive-item"
                                                                controls
                                                               
                                                                width="800"
                                                                height="auto"
                                                                poster="<?= base_url("asset/tutorial_reseller/thumbnail.jpg") ?>"
                                                                data-setup="{}"
                                                                autoplay="true"
                                                              >
                                                                <source src="<?= base_url("asset/tutorial/").$row["file"] ?>" type="video/mp4" />
                                                                   
                                                              </video>
                                </div>
                                
                                <div class="col-12" ><h6 class="text-dark"><?= $row["judul"] ?></h6> <label class="text-muted" style="font-size:13px;"> <?= $row["view"]?> Views · <?= time_elapsed_string($row["created_at"])?></label></div> 
                                <div class="col-12 "><hr style="background-color:#c5c5c5"></div>
                                 <div class="col-2"> <img src="<?= base_url("asset/foto_user/").$foto ?>" class="lazyload rounded-circle" style="width:50px;height:50px"></div>
                                 <div class="col-10"><h6 class="text-dark"><?= ucfirst($nama)?> · <?= ucfirst($lvl)?></h6></div>
                                 <div class="col-12 "><hr style="background-color:#c5c5c5"></div>
                                 <div class="col-12 form-group">
                                   <label class="text-muted">Deskripsi</label>
                                   <p class="text-dark"><?=$row['deskripsi']?></p>
                                 </div>
        </div>
             

      </div>
    </section><!-- End About Video Section -->
