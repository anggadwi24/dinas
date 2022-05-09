


 <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Data Absen</h2>
          <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
          
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

    function load_data(limit, start)
    {
       
      $.ajax({
        url:"<?php echo base_url(); ?>pegawai/fetch_absen",
        method:"POST",
        data:{limit:limit, start:start},
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
      load_data(limit, start);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
        lazzy_loader(limit);
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_data(limit, start);
        }, 1000);
      }
    });

  });
</script>

