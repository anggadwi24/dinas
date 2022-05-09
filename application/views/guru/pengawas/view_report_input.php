 <section id="about" class="about">
  <?php if($jabatan == 'admin'){?>
    <?php $bag = $this->model_app->view('bagian');
    ?>
      <div class="container" >
         <form action="<?= base_url('pengawas/inputReport') ?>" method="post" onsubmit="$('#loader').show();">
        <div class="row">
         
        <div class="col-12 mt-1" data-aos="fade-left">
          <select class="form-control" name="bagian" id="bagian">
            <option value="all">All</option>
          <?php foreach($bag->result_array() as $div){?>
                  <?php if($div[id_bagian] == $bagian){?>
                   <option value="<?= $div[id_bagian]?>" selected><?= ucfirst($div['nama_bagian'])?></option>
                      <?php }else{?>
                    <option value="<?= $div[id_bagian]?>"><?= ucfirst($div['nama_bagian'])?></option>
                      <?php }?>
           <?php }?>
          </select>
        </div>
        <div class="col-12 mt-1 " data-aos="fade-left">
          <select class="form-control" name="sub" id="sub">
            <option value="all">All</option>
       
                                            <?php   $sub_bag = $this->model_app->view_where('sub_bagian',array('id_bagian'=>$bagian));?>
                                <?php 
                                if($sub_bagian != 'all'){
                                foreach($sub_bag->result_array() as $sub){?>
                                      <?php if($sub[id_sub_bagian] == $sub_bagian){?>
                                       <option value="<?= $sub[id_sub_bagian]?>" selected><?= ucfirst($sub['nama_sub_bagian'])?></option>
                                          <?php }else{?>
                                        <option value="<?= $sub[id_sub_bagian]?>"><?= ucfirst($sub['nama_sub_bagian'])?></option>
                                          <?php }?>
                               <?php }} ?>

          </select>
        </div>
        <div class="col-12 mt-1" data-aos="fade-right">
          <input type="submit" name="submit" class="btn btn-warning text-light w-100 " value="Cari">
        </div>
       
        </div>
 </form>
      </div>
  <?php }else{
      if($this->session->sub_bagian == 0){
        $sub_bag = $this->model_app->view_where('sub_bagian',array('id_bagian'=>$this->session->bagian));
      ?>
      <div class="container" >
         <form action="<?= base_url('pengawas/inputReport') ?>" method="post" onsubmit="$('#loader').show();">
        <div class="row">
       
        <div class="col-12 mt-1" data-aos="fade-left">
          <select class="form-control" name="sub" >
            <option value="all">All</option>
            <?php foreach($sub_bag->result_array() as $sub){?>
                  <?php if($sub[id_sub_bagian] == $sub_bagian){?>
                   <option value="<?= $sub[id_sub_bagian]?>" selected><?= ucfirst($sub['nama_sub_bagian'])?></option>
                      <?php }else{?>
                    <option value="<?= $sub[id_sub_bagian]?>"><?= ucfirst($sub['nama_sub_bagian'])?></option>
                      <?php }?>
           <?php }?>
          </select>
        </div>
        <div class="col-12 mt-1" data-aos="fade-right">
          <input type="submit" name="submit" class="btn btn-warning text-light" value="Cari">
        </div>
       
        </div>
 </form>
      </div>
  <?php
      }else{
       $sub_bag = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$this->session->sub_bagian))->row_array();
  ?>
         
          <div class="container" >
           
            <div class="row">
           
            <div class="col-12 text-center" data-aos="fade-up">
             <h5><?= $sub_bag['nama_sub_bagian']?></h5>
            </div>
         
           
            </div>
    
          </div>

  <?php
      }
    } ?>

      <div class="container-fluid mt-4" data-aos="fade-up" >

<form method="post" action="<?= base_url('pengawas/do_report')?>" enctype="multipart/form-data" onsubmit="$('#loader').show();">
          
              <div class="row">
                 <div class="col-md-12">
                <div class="form-group">
                  <label>Pegawai</label>
                  <select name="id_pegawai" class="form-control" required="">
                    <option></option>
                    <?php foreach($peg->result_array() as $row):

                        echo " <option value='".$row['id_pegawai']."'>".$row['nama_lengkap']."</option>";
                    endforeach;?>
                  </select>
                </div>
              </div>
                <div class="col-md-12">
                <div class="form-group">
                  <label>Judul</label>
                  <input type="text" name="judul_report" class="form-control" required value="">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Tanggal</label>
                  <input type="date" name="date" class="form-control" required value="<?= date('Y-m-d')?>">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Dari</label>
                  <input type="time" name="start" class="form-control" required value="<?= date('H:i')?>">
                </div>
              </div>
             
               <div class="col-md-12">
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea class="form-control" name="report" required></textarea>
                </div>

              </div>
                <div class="col-md-12">
                <div class="form-group">
                  <label>Foto</label>
                <input type="file"  class="form-control"  required accept="image/*"  name='files[]' capture multiple>
                </div>

              </div>
             
             
             
             
            <div class="col-md-12">
             <div class="form-group">
                  <button type="submit" class="btn btn-warning col-12 my-3 text-light">TAMBAH REPORT</button>
              </div>
              </div>
              </div>
            </form>

          </div>
        </section>