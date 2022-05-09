

 <section id="about" class="about">
      <div class="container" data-aos="fade-down">
        
        <div class="section-title">
          <h2>Data Report</h2>
          <hr style="width: 50%;border-top: 3px solid #e53f00; ">
          
        </div>
         <div class="col-12 d-flex justify-content-around mb-4">
         
         <div class="p-2 text-center <?php if($tanggal == date('d',strtotime("-2 Days")) ){echo "active";}?>" id="searchReport" class="searchRep" data-tanggal='<?= date('d',strtotime("-2 Days"))?>' data-bulan ="<?= date('m',strtotime("-2 Days"))?>" data-tahun="<?= date('Y',strtotime("-2 Days"))?>">
          <h6><?= strtoupper(hari_ini(date('w',strtotime("-2 Days"))))?></h6>
          <span><?= date('d',strtotime("-2 Days"))?></span>
        
        </div>

         <div class="p-2 text-center <?php if($tanggal == date('d',strtotime("-1 Days")) ){echo "active";}?>" id="searchReport" class="searchRep" data-tanggal='<?= date('d',strtotime("-1 Days"))?>' data-bulan ="<?= date('m',strtotime("-1 Days"))?>" data-tahun="<?= date('Y',strtotime("-1 Days"))?>">
          <h6><?= strtoupper(hari_ini(date('w',strtotime("-1 Days"))))?></h6>
          <span><?= date('d',strtotime("-1 Days"))?></span>
          </div>

         <div class="p-2 text-center <?php if($tanggal == date('d') ){echo "active";}?>" id="searchReport" class="searchRep" data-tanggal='<?= date('d')?>' data-bulan ="<?= date('m')?>" data-tahun="<?= date('Y')?>">
           <h6><?= strtoupper(hari_ini(date('w')))?></h6>
          <span><?= date('d')?></span>
          </div>


         <div class="p-2 text-center <?php if($tanggal == date('d',strtotime("+1 Days")) ){echo "active";}?>" id="searchReport" class="searchRep" data-tanggal='<?= date('d',strtotime("+1 Days"))?>' data-bulan ="<?= date('m',strtotime("+1 Days"))?>" data-tahun="<?= date('Y',strtotime("+1 Days"))?>">
          <h6><?= strtoupper(hari_ini(date('w',strtotime("+1 Days"))))?></h6>
          <span><?= date('d',strtotime("+1 Days"))?></span>
          </div>

          <div class="p-2 text-center <?php if($tanggal == date('d',strtotime("+2 Days")) ){echo "active";}?>" id="searchReport" class="searchRep" data-tanggal='<?= date('d',strtotime("+2 Days"))?>' data-bulan ="<?= date('m',strtotime("+2 Days"))?>" data-tahun="<?= date('Y',strtotime("+2 Days"))?>">
          <h6><?= strtoupper(hari_ini(date('w',strtotime("+2 Days"))))?></h6>
          <span><?= date('d',strtotime("+2 Days"))?></span>
        
        </div>
       </div>
        <div id="load_data" class="row" >
   
          
        </div>
                
        <div id="load_data_message" class="text-center"></div>
        
      </div>
  </section>






<script>
  $(document).ready(function(){

    var limit = 3;
    var start = 0;
    
    var date = '<?= $tahun.'-'.$bulan.'-'.$tanggal?>';
  

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

    function load_data(limit, start,date)
    {
       
      $.ajax({
        url:"<?php echo base_url(); ?>pegawai/fetch_report",
        method:"POST",
        data:{limit:limit, start:start,date:date},
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
      load_data(limit, start,date);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
        lazzy_loader(limit);
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_data(limit, start,date);
        }, 1000);
      }
    });

  });
</script>
