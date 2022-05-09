
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
  <input type="hidden" id="id_tahap" value="<?= $this->encrypt->encode($row['id_tahap'],$key)?>">
  <script type="text/javascript">
     $(document).ready(function(){
      var tahap = $('#id_tahap').val();
        $.ajax({
          type:'POST',
          url:'<?= base_url('pegawai/dataAlokasi') ?>',
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
      $(document).on('click', '.btnAdd', function() {
          $('#loader').css('display','block');
           var tahap = $('#id_tahap').val();
          window.location.href='<?= base_url('pegawai/addAlokasiDanaDesa?tahap=')?>'+tahap+'&status=parent&id_parent=null&id_sub_parent=null';
      });
      $(document).on('click', '.btnAddSP', function() {
          $('#loader').css('display','block');
          var parent =  $(this).attr('data-parent');
           var tahap = $('#id_tahap').val();
          window.location.href='<?= base_url('pegawai/addAlokasiDanaDesa?tahap=')?>'+tahap+'&status=sub_parent&id_parent='+parent+'&id_sub_parent=null';
      });
       $(document).on('click', '.btnAddChild', function() {
          $('#loader').css('display','block');
          var parent =  $(this).attr('data-parent');
          var subparent =  $(this).attr('data-subparent');

           var tahap = $('#id_tahap').val();
          window.location.href='<?= base_url('pegawai/addAlokasiDanaDesa?tahap=')?>'+tahap+'&status=child&id_parent='+parent+'&id_sub_parent='+subparent;
      });
        $(document).on('click', '.addProses', function() {
          $('#loader').css('display','block');
          var id =  $(this).attr('data-id');
          var tahap = $(this).attr('data-tahap');
        

         
          window.location.href='<?= base_url('pegawai/detailADD?id=')?>'+id+'&tahap='+tahap;
      });
  </script>