

<div class="header-large-title">
    <div class='row'>
        <div class='col-10'><h1 class="title " id='title'>Diskusi </h1></div>
        <div class='col-2' id='colClose'></div>

    </div>
            

            
</div>
<div class="wide-block pt-2 pb-5" style='background:none !important;border-top:none;border-bottom:none'>

                <!-- comment block -->
                <div class="comment-block" id='data-021932'>
                    <!--item -->
                   
                   
                    <!-- * item -->
                </div>
                <div id='btnS'></div>
                <!-- * comment block -->

            </div>
<div class="fab-button animate bottom-right dropdown" style='bottom:60px !important'>
            <a href="#" class="fab" data-toggle="modal" data-target="#ModalForm">
                <ion-icon name="add-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </a>
            
</div>
<div class="modal fade modalbox" id="ModalForm" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Diskusi</h5>
                        <a href="javascript:;" data-dismiss="modal">Close</a>
                    </div>
                    <div class="modal-body">
                        
                            
                            <div class="mb-5">
                                <form id='formCreate'>
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="email1"></label>
                                            <input type="text" class="form-control" id="title" 
                                                placeholder="Tulis judul diskusi..." name='title'>
                                            <i class="clear-input">
                                                <ion-icon name="close-circle"></ion-icon>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="email1"></label>
                                            <input type="text" class="form-control" id="text" style='height:100px'
                                                placeholder="Tulis diskusi..." name='text'>
                                            <i class="clear-input">
                                                <ion-icon name="close-circle"></ion-icon>
                                            </i>
                                        </div>
                                    </div>
                                    <div class='my-2'>
                                        <ul class="listview image-listview" id='contentFile'>
                                            
                                            
                                        </ul>
                                    </div>
                                    <div class='form-group mt-2' id='lampirFile'>
                                        <span class='font-18'><ion-icon name="attach"></ion-icon></span>
                                        <span class='font-15'>Lampirkan File</span>
                                    </div>
                                    <input type="file" name='files[]' id='fileC' accept="image/*" multiple style='display:none'>

                                    
                                    
                                    <div class="mt-2">
                                        <button  class="btn btn-primary btn-block btn-lg"
                                           ><ion-icon name="paper-plane"></ion-icon> Kirim</button>
                                    </div>

                                </form>
                            </div>
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modalbox" id="modalComment" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Komentar</h5>
                        <a href="javascript:;" data-dismiss="modal">Close</a>
                    </div>
                    <div class="modal-body" >
                        <div class="wide-block pb-5 px-0" style='background:none !important;border-top:none;border-bottom:none'>


                            <div class="comment-block" id='data-4289123' >
                            </div>
                            <div class='comment-block mt-1' id='commentMore'>
                                
                            </div>
                        </div>
                        <div class="chatFooter">
                       
                        
                        <form id='formReply'>
                            
                            <input type="file" name='file' id='fileHere' accept='image/*' style='display:none'>
                            <button type="button" class="btn btn-icon btn-default rounded" id='fileRep'>
                                <ion-icon name="image-outline"></ion-icon>
                            </button>
                            <div class="form-group boxed">
                                <div class="input-wrapper">
                                    <input type="hidden" name='id_diskusi' id='diskusi_id'>
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
                    </div>
                </div>
            </div>
        </div>
<script>
    var limit = 5;
    var start = 0;
    dataDiskusi(0,5);
    $(document).on('click', '#showMore', function() {
        start = start + limit;
        limit = limit+limit;
        dataDiskusi(start,limit)
    });
    function dataDiskusi(start,limit){
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('diskusi/dataDiskusi'); ?>",
            data:{start:start,limit:limit},
            dataType:'json',
          
             beforeSend: function(){
                
                
                $('#showMore').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading... ');
               
   
            },
            success: function(resp){
             
              $('#data-021932').append(resp.output);
              $('#btnS').html(resp.show);
              
              
              
            },
            complete: function() {
              
                $('#showMore').html('LIHAT LAINNYA');

            },
        });
    }
    $(document).on('click', '#fileUp', function() {
        $('#fileUp').click();
    });
    var lim = 5;
        var sta = 0;
    $(document).on('click', '.comment', function() {
        $('#data-4289123').html('');
        lim = 5;
        sta = 0;
        var id = $(this).attr('data-id');
        $('#diskusi_id').val(id);
        dataComment(id,0,5);
        
      
    });
    $(document).on('click', '.detail', function() {
      
        var id = $(this).attr('data-id');
        
        window.location = '<?= base_url('diskusi/detail?id=') ?>'+id;
        
      
    });
    $(document).on('click', '#btnComMore', function() {
        sta = sta+lim;
        lim = lim+lim;
        var id = $(this).attr('data-id');
        
        dataComment(id,sta,lim);
        
      
    });
    function dataComment(id,sta,lim){
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('diskusi/dataComment'); ?>",
            data:{id:id,limit:lim,start:sta},
            dataType:'json',
           
          
             beforeSend: function(){
                
                $('#modalComment').modal('show');
                $('#loading').css('display','');
                
               
   
            },
            success: function(resp){
                
              $('#data-4289123').append(resp.output);
              $('#commentMore').html(resp.btn);
             
              
              
            },
            complete: function() {
              
               
                 
                $('#loading').css('display','none');
            },
        });
    }
    $(document).on('click', '.like', function() {
        var id = $(this).attr('data-id');
        var elem = $(this);
        var html;
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
             $(elem).html(html);
            
             
              
           
              
             
          }, 
          
      });
      $(this).html(html);
    });
    $(document).on('click','#fileRep',function(){
        $('#fileHere').click();
    });
    $(document).on('click','#lampirFile',function(){
        $('#fileC').click();
    });
    $(document).on('change','#fileC',function(){
        $('#contentFile').html('');
        var inp = document.getElementById('fileC')
        var html = '';
        for (var i = 0; i < inp.files.length; ++i) {
        var name = inp.files.item(i).name;
        html += '<li><div class="item"><div class="in"><div>'+name+'</div></div></div></li>';
        }
        $('#contentFile').append(html);
        
       
    })
            
   $(document).on('submit', '#formCreate', function(e) {
        e.preventDefault();
        var txt = $('input[name=title]').val();
        if(txt != ''){
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('diskusi/createDiskusi') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType:'json',
           
         
            beforeSend: function(){
                
               
                $('#loading').css('display','');

                $('#formCreate button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> ');
                $('#formCreate button').prop('disabled',true);
   
            },
             error:function(){
             
                
               
            },
          
            success: function(resp){
                console.log(resp);
               if(resp.status == true){
                    $('#data-021932').prepend(resp.msg);
                    $('input[name=title]').val('');
                    $('input[name=text]').val('');

               }else{
                   $('input[name=title]').focus();
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
        }else{
            $('input[name=title]').focus();
        }
    
    });

    $(document).on('submit', '.formReply', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
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
                    $('#com-'+resp.id).prepend(resp.msg);
                    $('input[name=reply]').val('');
                    

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

    $(document).on('submit', '#formReply', function(e) {
        e.preventDefault();
       
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('diskusi/createReply') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType:'json',
           
         
            beforeSend: function(){
                
                $('#btnReply').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> ');
                $('#formReply button').prop('disabled',true);
                $('#loading').css('display','');

               
   
            },
             error:function(){
             
                
               
            },
          
            success: function(resp){
                console.log(resp);
               if(resp.status == true){
                    $('#data-4289123').prepend(resp.msg);
                    $('input[name=reply]').val('');
                    

               }
               
                
             
                
               
            }, 
             complete: function() {
               
                $('#loading').css('display','none');
                $('input[type=text]').val('');
                $('#fileRep').val('');

                $('#btnReply').html(' <ion-icon name="send"></ion-icon>');
                $('#formReply button').prop('disabled',false);
            },
        });
       
    
    });
</script>