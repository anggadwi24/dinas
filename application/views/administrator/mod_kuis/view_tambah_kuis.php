<script type="text/javascript">
    $(document).ready(function(){
        $('#btnSubmit').click(function(){
        
          var start = $('#start').val();
          var end = $('#end').val();
        
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('administrator/getBulanDate'); ?>",
            data:{start:start,end:end},
            success: function(response){
              
              $('#app').html(response);

            }
          })
        })

      });
    function getval(sel,id){
       var val = sel.value;

       if(val == 'y'){
          $('#start'+id).show();
          $('#end'+id).show();
          $('#alasan'+id).css('display','none');

       }else if(val == 'n'){
         $('#start'+id).hide();
          $('#end'+id).hide();
          $('#alasan'+id).css('display','block');
       }
       }
      $(document).on('submit','.formDate',function(e){
        e.preventDefault();
        $.ajax({
          
          type: 'POST',
          url:"<?= base_url('administrator/updateDate') ?>",

         
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData:false,
         
       
          beforeSend: function(){
              
            swal({
            title: 'Tunggu Sebentar',
          
            html:
                '<div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">'
                +'<span class="sr-only">Loading...</span>'
                +'</div>',
            showConfirmButton: false
        
          })
 
          },
           error:function(){
           
               swal({

                title: '404',
                text: 'Something error!',
                 customClass: 'swal-wide',
                 type:'error',
                
              })
             
          },
        
          success: function(resp){
             
            if(resp == true){
              
              swal.close();
            }
             
          }, 
           complete: function() {
            swal.close();
          },
      });
      })
</script>

  <div class="card">
    <div class="card-header with-border">
         <h6 class="box-title">Tambah Tanggal Kuis </h6>

        
    </div>
  
      
      
      <div class="card-body">
        <div class="row mt-3">
            <div class="col-lg-5 form-group">
                    
                    <input type="date" class="form-control" name="start" id="start" value="<?= date('Y-m-d', strtotime( 'monday this week' ) );?>">

                     
             </div>
             <div class="col-lg-5 form-group">
                    
                    <input type="date" class="form-control" name="end" id="end" value="<?= date('Y-m-d', strtotime( 'sunday this week' ) );?>">

                     
             </div>
             <div class="col-lg-2 ">
                   <label for="">&nbsp;</label>
                   <button class="btn btn-primary " id="btnSubmit">Submit</button>
             </div>
             </div>
             
           
           
             
         
        </form>
    </div>
</div>
<div class="" id="app"></div>


