
 <section id="about" class="about">
      <div class="container" data-aos="fade-up">

       
        <div id="load_data" class="row" >

            
        </div>
                
        <div id="load_data_message" class="text-center"></div>
        
      </div>
  </section>


  <script type="text/javascript">
    
     $(document).ready(function(){
        $.ajax({
          type:'POST',
          url:'<?= base_url('pegawai/dataTahap') ?>',
          beforeSend: function(){
               
                $('#loader').css('display','block');
                 
          },
          success:function(data){
            $('#load_data').html(data);
          },
          complete: function(){
                  $('#loader').css('display','none');
                 

                   
                   
                   
          },
          error: function(){
                 
                  Swal.fire({
                     type: 'error',
                     title: 'Oops...',
                     text: 'Terjadi Suatu Kesalahan!',
                     showConfirmButton: true
                  });
          }
        })
     });
       $(document).on('click', '.tahap', function() {
        var id = $(this).attr('data-id');
     
      
        $.ajax({
            type:'POST',
            url:'<?= base_url('pegawai/cekTahap')?>',
            data:{id:id},
            beforeSend: function(){
               
                $('#loader').css('display','block');
                 
            },
            success:function(resp){
                if(resp == false){
                  Swal.fire({
                     type: 'error',
                     title: 'Oops...',
                     text: 'Terjadi Suatu Kesalahan!',
                     showConfirmButton: true
                  });
                }else{
                  window.location = resp;

                }
               
            },

            complete: function(){
                              $('#loader').css('display','none');
                             

                               
                               
                               
            },
            error: function(){
                 
                  Swal.fire({
                     type: 'error',
                     title: 'Oops...',
                     text: 'Terjadi Suatu Kesalahan!',
                     showConfirmButton: true
                  });
          }
        })

    });
  </script>