<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title><?= $title ?></title>
    <meta name="description" content="Kuis beasiswa">
    <meta name="keywords" content="sdn Polewali kuis beasiswa" />
    <link rel="icon" type="image/png" href="<?= base_url()?>asset/images/favicon.ico" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url()?>asset/images/apple-touch-icon.png">
    <link rel="stylesheet" href="<?= template()?>/css/style.css">
    <link rel="manifest" href="<?= template()?>/__manifest.json">
    <script src="<?= template()?>/js/lib/jquery-3.4.1.min.js"></script>
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-danger" role="status"></div>
    </div>
    <div id="loading" style="display:none;">
        <div class="spinner-border text-danger" role="status"></div>
    </div>
	

    <div class="appHeader">
        <div class="left">
            <a href="<?= base_url('chat')?>" class="headerButton">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"><?= $page ?></div>
        <div class="right">
            
        </div>
    </div>
    
    <!-- * loader -->

    <!-- App Header -->
    
    <!-- * App Header -->

    <!-- Search Component -->
  
    <!-- * Search Component -->

    <!-- App Capsule -->
	<style>
		#appCapsule{
			padding: 56px 0 !important;
		}
		body{
			background:#F9F9F9 !important;
		}
	</style>
    <div id="appCapsule" >
        
        

        


        

        <div class="message-divider">
            Friday, Sep 20, 10:40 AM
        </div>

        <div class="message-item">
            <img src="<?= template()?>/img/sample/avatar/avatar1.jpg" alt="avatar" class="avatar">
            <div class="content">
                <div class="title">John</div>
                <div class="bubble">
                    Hi everyone, how are you?
                </div>
                <div class="footer">8:40 AM</div>
            </div>
        </div>

        <div class="message-item">
            <img src="<?= template()?>/img/sample/avatar/avatar2.jpg" alt="avatar" class="avatar">
            <div class="content">
                <div class="title">Marry</div>
                <div class="bubble">
                    I'm fine, how are you today john, do you feel good?
                </div>
                <div class="footer">10:40 AM</div>
            </div>
        </div>

        <div class="message-item user">
            <div class="content">
                <div class="bubble">
                    Would you please repost the photo you sent yesterday?
                </div>
                <div class="footer">10:40 AM</div>
            </div>
        </div>

        <div class="message-divider">
            Friday, Sep 20, 10:40 AM
        </div>

        <div class="message-item">
            <img src="<?= template()?>/img/sample/avatar/avatar2.jpg" alt="avatar" class="avatar">
            <div class="content">
                <div class="title">Marry</div>
                <div class="bubble">
                    <img src="<?= template()?>/img/sample/photo/1.jpg" alt="photo" class="imaged w160">
                </div>
                <div class="footer">10:40 AM</div>
            </div>
        </div>

        <div class="message-item">
            <img src="<?= template()?>/img/sample/avatar/avatar4.jpg" alt="avatar" class="avatar">
            <div class="content">
                <div class="title">Katie</div>
                <div class="bubble">
                    Nice photo !
                </div>
                <div class="footer">10:40 AM</div>
            </div>
        </div>

        <div class="message-item">
            <img src="<?= template()?>/img/sample/avatar/avatar2.jpg" alt="avatar" class="avatar">
            <div class="content">
                <div class="title">Marry</div>
                <div class="bubble">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vitae nisl et nibh iaculis
                    sagittis. In hac habitasse platea dictumst. Sed eu massa lacinia, interdum ex et, sollicitudin elit.
                </div>
                <div class="footer">10:40 AM</div>
            </div>
        </div>

        <div class="message-item user">
            <div class="content">
                <div class="bubble">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vitae nisl et nibh iaculis
                    sagittis. In hac habitasse platea dictumst. Sed eu massa lacinia, interdum ex et, sollicitudin elit.
                </div>
                <div class="footer">10:40 AM</div>
            </div>
        </div>


       
    </div>
    <!-- * App Capsule -->
    <div class="modal fade action-sheet inset" id="addActionSheet" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Share</h5>
                </div>
                <div class="modal-body">
                    <ul class="action-button-list">
                        <li id='sendByCamera'>
                            <a href="#" class="btn btn-list" data-dismiss="modal">
                                <span>
                                    <ion-icon name="camera-outline"></ion-icon>
                                    Kamera
                                </span>
                            </a>
                        </li>
                        
                        <li id="sendByImg">
                            <a href="#" class="btn btn-list" data-dismiss="modal">
                                <span>
                                    <ion-icon name="image-outline"></ion-icon>
                                    Pepustakaan & Galeri
                                </span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- * Share Action Sheet -->

    <!-- chat footer -->
    <div class="chatFooter">
        <form id='formSend'>
        <input type='hidden' name='siswa' id='siswa' value='<?= $this->encrypt->encode($row['id_siswa'],keys())?>'>
            <a href="javascript:;" class="btn btn-icon btn-secondary rounded" data-toggle="modal" data-target="#addActionSheet">
                <ion-icon name="add"></ion-icon>
            </a>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="text" name='text' class="form-control" placeholder="Type a message...">
                    <i class="clear-input">
                        <ion-icon name="close-circle"></ion-icon>
                    </i>
                </div>
            </div>
            <button type="submit" class="btn btn-icon btn-danger rounded">
                <ion-icon name="send"></ion-icon>
            </button>
        </form>
    </div>
    <input type="file" name='file' id='file' accept="image/*" style='display:none'>

    <!-- App Bottom Menu -->

    <!-- * App Bottom Menu -->

    <!-- App Sidebar -->
  
    <!-- * App Sidebar -->

    <!-- welcome notification  -->
   
    

    
        <div class="modal fade dialogbox" id="DialogIconedSuccess" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-icon text-success">
                        <ion-icon name="checkmark-circle"></ion-icon>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title">Success</h5>
                    </div>
                    <div class="modal-body" id="dialogLanjut">
                       
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <button class="btn btn-text-success" id="btnLanjut">LANJUT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="modal fade dialogbox" id="DialogIconedDanger" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-icon text-danger" id='iconError'>
                        
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleError"></h5>
                    </div>
                    <div class="modal-body" id="dialogError">
                       
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                           <button class="btn btn-text-secondary" id="btnClose">CLOSE</button>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade dialogbox" id="modalImg"  tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <img src="<?= template() ?>/img/sample/photo/1.jpg" class='img-fluid' id='imgModal' alt="">
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn btn-text-secondary" data-dismiss="modal">CLOSE</a>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            
$(document).ready(function(){
  
 
    function scrollToBottom() {
            $("#appCapsule").animate({ scrollTop: $("#appCapsule")[0].scrollHeight }, 1000);
    }
    $(document).on('click', '#sendByCamera', function(e) {
        $('#file').attr('capture','user');
        $('#file').click();
    });
    $(document).on('click', '#sendByImg', function(e) {
       
        $('#file').click();
    });
    $(document).on('change', '#file', function(e) {

        e.preventDefault();
        var file_data = $('#file').prop('files')[0];
        var siswa = $('#siswa').val();
        var form_data = new FormData();
        $('#files').replaceWith($('#files').val('').clone(true));

        form_data.append('file', file_data);
        form_data.append('siswa', siswa);


                $.ajax({
                    url: '<?php echo base_url("chat/sendImage") ?>', // point to server-side PHP script
                    dataType: 'json',  // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    dataType:'json',
                    beforeSend: function(){
                
               
                        $('#loading').css('display','');

                        $('#formSend button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> ');
                        $('#formSend button').prop('disabled',true);
        
                    },
                    success: function(data){
                        //alert(php_script_response); // display response from the PHP script, if any
                        if (data == true) {
                            $('#file').val('');
                            dataChat();
                            
                        }else{
                        
                            

                        }
                    },
                    complete: function() {
               
             
                        $('#loading').css('display','none');
                        $('input[name=file]').val('');
                        $('#formSend button').html(' <ion-icon name="send"></ion-icon>');
                        $('#formSend button').prop('disabled',false);
                    },
                });
    });
    $(document).on('submit', '#formSend', function(e) {
        e.preventDefault();
        var txt = $('input[name=text]').val();
        if(txt != ''){
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('chat/sendText') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType:'json',
           
         
            beforeSend: function(){
                
               
                $('#loading').css('display','');

                $('#formSend button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> ');
                $('#formSend button').prop('disabled',true);
   
            },
             error:function(){
             
                
               
            },
          
            success: function(resp){
               
               if(resp == true){
                dataChat();
                $('input[name=text]').val('');
               }else{
                   $('input[name=text]').focus();
               }
               
                
             
                
               
            }, 
             complete: function() {
               
             
                $('#loading').css('display','none');
                $('input[name=teks]').val('');
                $('#formSend button').html(' <ion-icon name="send"></ion-icon>');
                $('#formSend button').prop('disabled',false);
            },
        });
        }else{
            $('input[name=text]').focus();
        }
    
    });
    
    dataChat();
    var old = 0;
    function dataChat(){
      
        var siswa = $('#siswa').val();
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('chat/dataChat'); ?>",
            data:{siswa:siswa},
            dataType:'json',
          
             beforeSend: function(){
                
                
                $('#loading').css('display','');
                flag = true;
               
   
            },
            success: function(resp){
                
              $('#appCapsule').html(resp.output);
              old = resp.count;
              
              
            },
            complete: function() {
              
                scrollToBottom();
                 
                $('#loading').css('display','none');
            },
        });
     }
     setInterval( function() { setRefresh(old); }, 10000 );
     function setRefresh(old){
        var siswa = $('#siswa').val();
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('chat/countChat'); ?>",
            data:{siswa:siswa},
            dataType:'json',
          
            success: function(resp){
                
                if(resp > old){
                    dataChat();
                    old = resp;
                }
             
               
   
            },
        }) 
    }
});
        </script>
    <!-- * welcome notification -->

    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    
    <!-- Bootstrap-->
    <script src="<?= template()?>/js/lib/popper.min.js"></script>
    <script src="<?= template()?>/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="<?= template()?>/js/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- jQuery Circle Progress -->
    <script src="<?= template()?>/js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
    <!-- Base Js File -->
    <script src="<?= template()?>/js/base.js"></script>


    <script>
        setTimeout(() => {
            notification('notification-welcome', 5000);
        }, 2000);
    </script>

</body>

</html>