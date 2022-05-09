<?php $me = $this->model_app->view_where('siswa',array('id_siswa'=>$row['id_siswa']))->row_array();?>
<div class="appHeader bg-primary text-light mb-3">
        <div class="left">
            <a href="<?= base_url('diskusi')?>" class="headerButton">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"></div>
        <div class="right">
            
        </div>
    </div>
<div class="blog-post " style='margin-top:5rem'>
            
            <h1 class="title"><?=  $row['diskusi_title']?></h1>

            <div class="post-header">
                <div>
                    <a href="#">
                        <img src="<?=$me['foto']?>" alt="avatar" class="imaged w24 rounded mr-05">
                        <?= $me['nama_lengkap']?>
                    </a>
                </div>
                <?= cek_terakhir($row['tanggal'])?>
            </div>
            <div class="post-body">
                <p>
                    <?= $row['diskusi_deskripsi']?>
                </p>
              
               
                <?php $gambar = $this->model_app->view_where('diskusi_foto',array('id_diskusi'=>$row['id_diskusi']));?>
                <?php if($gambar->num_rows() > 0){?>
                <div class='d-flex justify-content-center'>
                    <?php foreach($gambar->result_array() as $gmr){?>
                    <div class='ml-auto'>
                        <img src="<?= base_url('asset/diskusi_upload/').$gmr['foto'] ?>" class='img-fluid w-100'>
                    </div>
                    <?php }?>
                </div>
                <?php }?>
                <div class='d-flex justify-content-start border-top p-2' id='form'>
                    
                </div>
            </div>
            

        </div>
        <div class="divider mt-1 mb-3"></div>

<div class="section">
    <div class="section-title mb-1">
        <h3 class="mb-0" id='totalComment'>Comments (0)</h3>
    </div>
    <div class="pt-2 pb-2">
        <!-- comment block -->
        <div class="comment-block" id='dataCom'>
           
        </div>
        <div id='commentMore'></div>
        <div class="mt-2 chatFooter position-relative" style='background:none;'>
                       
                        
                        <form id='formReply'>
                            
                            <input type="file" name='file' id='fileHere' accept='image/*' style='display:none'>
                            <button type="button" class="btn btn-icon btn-default rounded" id='fileRep'>
                                <ion-icon name="image-outline"></ion-icon>
                            </button>
                            <div class="form-group boxed">
                                <div class="input-wrapper">
                                    <input type="hidden" name='id_diskusi' id='diskusi_id' value='<?= $this->encrypt->encode($row['id_diskusi'],keys())?>'>
                                    <input type="text" class="form-control" name='reply' placeholder="Type a message...">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                                    </i>
                                </div>
                            </div>
                           
                            <button  class="btn btn-icon btn-primary rounded" id='btnReply'>
                                <ion-icon name="send-outline"></ion-icon>
                            </button>
                        </form>
                         </div>
        <!-- * comment block -->
    </div>
</div>
<input type="hidden" id='idhere' value='<?= $this->encrypt->encode($row['id_diskusi'],keys())?>'>
<script>
    $(document).on('submit', '#formReply', function(e) {
        e.preventDefault();
        var id = $('#idhere').val();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('diskusi/createReply') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType:'json',
           
         
            beforeSend: function(){
                
               
                $('#loading').css('display','');

               
   
            },
             error:function(){
             
                
               
            },
          
            success: function(resp){
                console.log(resp);
               if(resp.status == true){
                detailDiskusi();
                    $('#dataCom').prepend(resp.msg);
                    $('input[name=reply]').val('');
                    $('#filehere').val(0);
                    

               }
               
                
             
                
               
            }, 
             complete: function() {
                $('#contentFile').html('');
                $('#ModalForm').modal('hide');
                $('#loading').css('display','none');
                $('input[type=text]').val('');
                $('#fileC').val('');

                $('#formCreate button').html(' <ion-icon name="send"></ion-icon>');
                $('#formCreate button').prop('disabled',false);
            },
        });
       
    
    });
    $('#menuFoot').css('display','none');
    detailDiskusi();
    function detailDiskusi(){
        var id = $('#idhere').val();
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('diskusi/detailDiskusi'); ?>",
            data:{id:id},
            dataType:'json',
          
           
          
            
            success: function(resp){
                
            
              $('#form').html(resp.output);
              $('#totalComment').html('Comment ('+resp.total+')');

             
              
              
            },
           
        });
    }
    $(document).on('click', '#like', function() {
        var id = $(this).attr('data-id');
       
        $.ajax({
          
          type: 'POST',
          url:"<?= base_url('diskusi/goLike') ?>",
          data: {id:id},
          dataType:'json',
   
          success: function(resp){
             console.log(resp);
             
             if(resp.status == false){
                html = "<ion-icon name='heart-outline'></ion-icon> "+resp.num;

             }else{
                html = "<ion-icon name='heart' class='text-danger md hydrated'></ion-icon> "+resp.num ;
             }
             $('#like').html(html);
            
             
              
           
              
             
          }, 
          
      });
     
    });
    var id = $('#idhere').val();
    var limit = 5;
    var start = 0;
    dataComment(id,start,limit);
    $(document).on('click', '#btnComMore', function() {
        start = start+limit;
        limit = limit+limit;
        var id = $(this).attr('data-id');
        
        dataComment(id,start,limit);
        
      
    });
    function dataComment(id,sta,lim){
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('diskusi/dataComment'); ?>",
            data:{id:id,limit:lim,start:sta},
            dataType:'json',
           
          
             beforeSend: function(){
                
            
                
                
               
   
            },
            success: function(resp){
                
              $('#dataCom').append(resp.output);
              $('#commentMore').html(resp.btn);
             
              
              
            },
            complete: function() {
              
               
                 
               
            },
        });
    }
</script>