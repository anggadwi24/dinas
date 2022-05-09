

 <section id="about" class="about">
      <div class="container" data-aos="fade-down">
        
        <div class="section-title">
          <h2>Data Report</h2>
          <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
          
        </div>
        <?php if($jabatan == 'admin'){?>
    <?php $bag = $this->model_app->view('bagian');
    ?>
      <div class="container" >
         <form action="<?= base_url('pengawas/report') ?>" method="post" onsubmit="$('#loader').show();">
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
         <form action="<?= base_url('pengawas/report') ?>" method="post" onsubmit="$('#loader').show();">
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

            <div class="row mt-5">
              <div class="col-12"><a href="<?= base_url('pengawas/inputReport')?>" class="btn btn-primary w-100">TAMBAH REPORT</a></div>
            </div>
        
        <div id="load_data" class="row mt-2" >
   
          
        </div>
                
        <div id="load_data_message" class="text-center"></div>
        
      </div>
  </section>






<script>
  $(document).ready(function(){

    var limit = 3;
    var start = 0;
    var bagian = '<?= $bagian ?>';
    var sub = '<?= $sub_bagian ?>';
    
   
  

    var action = 'inactive';

    function lazzy_loader(limit)
    {
      var output = '';
      for(var count=0; count<limit; count++)
      {
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
      }
      $('#load_data_message').html(output);
    }

    lazzy_loader(limit);

    function load_data(limit, start,bagian,sub)
    {
       
      $.ajax({
        url:"<?php echo base_url(); ?>pengawas/fetch_report",
        method:"POST",
        data:{limit:limit, start:start,bagian:bagian,sub:sub},
        cache: false,
        success:function(data)
        {

          if(data == '')
          {
            $('#load_data_message').html('');
            action = 'active';
          }
          else
          {
            $('#load_data').append(data);
            $('#load_data_message').html("");
            action = 'inactive';
          }
        }
      })
    }

    if(action == 'inactive')
    {
      action = 'active';
      load_data(limit, start,bagian,sub);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
        lazzy_loader(limit);
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_data(limit, start,bagian,sub);
        }, 1000);
      }
    });

  });
</script>
