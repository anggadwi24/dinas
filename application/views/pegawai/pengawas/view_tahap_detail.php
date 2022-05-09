
 <section id="about" class="about">
      <div class="col-5 my-2" data-aos="fade-up">
        <a href="<?=base_url('add/downloadAlokasi?id_sd=').$id_sd.'&tahap='.$row['tahap'].'&tahun='.$row['tahun']?>" class='btn btn-outline-info btn-xs'><i class="ri-file-excel-line"></i> DOWNLOAD</a>
      </div>
      <div class="container" data-aos="fade-up">

        
        <div id="load_data" class="row" >

            
        </div>
                
        <div id="load_data_message" class="text-center"></div>
        
      </div>
  </section>
  <input type="hidden" id="id_tahap" value="<?= $row['id_tahap']  ?>">
  <script type="text/javascript">
     $(document).ready(function(){
      var tahap = $('#id_tahap').val();
        $.ajax({
          type:'POST',
          url:'<?= base_url('pengawas/dataAlokasi') ?>',
          data:{tahap:tahap},
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
      $(document).on('click', '.detail', function() {
          $('#loader').css('display','block');
           var id = $(this).attr('data-id');
          window.location.href='<?= base_url('pengawas/detailAlokasiDanaDesa?id=')?>'+id;
      });
     
  </script>