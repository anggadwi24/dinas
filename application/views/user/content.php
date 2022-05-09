 <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>LAYANAN KAMI</h2>
          <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
          
        </div>
        <div class="row justify-content-between" >
            <?php 

            $menu = $this->model_app->view_ordering('menu','id_menu','ASC');
            foreach($menu as $row):
                $link = base_url().'home/'.$row['link'];
              ?>
            <div class="col-6 mb-3" onclick="menu('<?= $link?>')">
                <center><img src="<?= base_url('asset/menu/').$row['icon']?>" class="rounded-circle border border-dark " style="width: 100px;height: 100px;">
                <label class="d-block" style="color: #f9ad4a"><?= strtoupper($row['menu'])?></label></center>
            </div> 
          <?php endforeach;?>
        </div>
                
      
        
      </div>
  </section>