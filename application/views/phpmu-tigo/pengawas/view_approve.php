<section id="about" class="about">
    <div class="container" data-aos="fade-down">
        <div class="mb-3 ">
          <button class="btn btn-outline-primary"  data-toggle="modal" data-target="#modalFilter"><i class="ri-file-search-line"></i> FILTER</button>
        </div> 
        <div id="dataApp" class="row justify-content-center">
          
        </div>
    </div>
</section>
<div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Filter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formFilter">
          <div class="row">
            <div class="col-12">
                <label>Keyword</label>
                <input type="text" name="keyword" class="form-control">
            </div>
            <div class="col-12">
                <label>Persetujuan</label>
                <select name="status" class="form-control" >
                  <option value="all">Semua</option>
                  <option value="alokasi">Alokasi Dana</option>
                  <option value="persentase">Pencapaian Alokasi Dana</option>


                </select>
            </div>
            <div class="col-12">
                <label>Tahap</label>
                <select name="tahap" class="form-control" >
                  <option value="all">Semua</option>
                  <?php
                      $tahap = $this->model_app->view_where('tahap_add',array('id_sd'=>$id_sd));
                      foreach($tahap->result_array() as $thp){
                        echo "<option value='".$thp['id_tahap']."'>TAHAP ".$thp['tahap']." TAHUN ".$thp['tahun']."</option>";
                      }
                  ?>


                </select>
            </div>
            <div class="col-12 mt-3">
              <button class="btn btn-outline-primary w-25 float-right"><i class="ri-search-2-line"></i></button>
            </div>

          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<script type="text/javascript">
  dataApprove();
   function dataApprove(){
      var keyword = '';
      var status = 'all';
      var tahap = 'all';
      $.ajax({
          type:'POST',
          url:'<?= base_url('pengawas/dataTahap') ?>',
          data:{keyword:keyword,status:status,tahap:tahap},
          beforeSend: function(){
               
                $('#loader').css('display','block');
                 
          },
          success:function(data){
            $('#dataApp').html(data);
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
    }
     $("#formFilter").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
              url:'<?= base_url('pengawas/dataTahap') ?>',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
           
         
            beforeSend: function(){
                
                $('#loader').css('display','block');
                $('#btnAdd').prop('disabled',true);
                $('#modalFilter').modal('hide');
                $('.modal-backdrop').remove();
            },
             error:function(){
             
                 Swal.fire({

                  title: '404',
                  text: 'Something error!',
                   customClass: 'swal-wide',
                   type:'error',
                  
                })
               
            },
          
            success: function(resp){
              $('#dataApp').html(resp);
            }, 
             complete: function() {
                $('#loader').css('display','none');
                
                $('#btnAdd').prop('disabled',false);
            },
        });
    });
      $(document).on('click', '.detailADD', function() {
          $('#loader').css('display','block');
       
          var id =  $(this).attr('data-id');

         
          window.location.href='<?= base_url('pengawas/detailAlokasiDesa?id=')?>'+id;
      });
      $(document).on('click', '.detailPersentase', function() {
          $('#loader').css('display','block');
       
          var id =  $(this).attr('data-id');

         
          window.location.href='<?= base_url('pengawas/detailPersentase?id=')?>'+id;
      });
</script>