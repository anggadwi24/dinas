<style type="text/css">
    .dot{
          position:absolute ;
         right: 0.5rem;
         top: 1.8rem;
         border: 1px solid white;
          height: 8px;
          width: 8px;
          background-color: #5be571;
          border-radius: 50%;
          display: inline-block;
    }
    .dot1{
         
         border: 1px solid white;
          height: 10px;
          width: 10px;
          background-color: #5be571;
          border-radius: 50%;
         
    }
</style>
<div class="header-large-title">
    <div class='row'>
        <div class='col-10'><h1 class="title " id='title'>Chat </h1></div>
        <div class='col-2' id='colClose'></div>

    </div>            
</div>
<div class="d-flex flex-row">
    <div class="mx-1 mt-1 position-relative " id='allOnline'>
        <span style="font-size: 38px;margin-top:-10px !important" class='pt-1 mb-0  '><ion-icon name="people-circle-outline" class="md hydrated"></ion-icon></span>
        <span class="position-absolute badge badge-primary " style="top:-1px;left:15px;height:12px;min-width: 12px;" id='countOn' >0</span>
    </div>
   <div class="section full mt-1 " style="overflow:auto;padding-bottom: 0 !important;" >
            
           
                 <div class="d-flex  "  id='data-online' style="overflow: scroll;width: 500px;height: 70px;padding-bottom:0 !important;margin-bottom: 0 !important;">

                
                
                </div>
           

           

    </div> 
</div>

    <ul class="listview image-listview mb-2" id='dataChat'>
            <li>
                <a href="#" class="item">
                    <img src="<?= template()?>/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                    <div class="in">
                        <div style='font-weight:bold'>
                            <header>Sekolah</header>
                            User
                            <footer>Pesan  </footer>
                        </div>
                        <span class="badge badge-primary">3</span>
                    </div>
                </a>
            </li>
           
    </ul>
    <div class="modal fade modalbox" id="modalSiswa" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id='titleSiswa'>0 Siswa Online</h5>
                        <a href="javascript:;" data-dismiss="modal">Close</a>
                    </div>
                    <div class="modal-body p-0">

                        <ul class="listview image-listview flush mb-2" id='dataall'>
                           
                          
                            <li>
                                <div class="item ">
                                    <img src="<?= template() ?>/img/sample/avatar/avatar9.jpg" alt="image" class="image">
                                    
                                    <div class="in">
                                        <div>Regina Pollastro</div>
                                        <span class="dot1"></span>
                                    </div>

                                </div>
                            </li>
                            
                        </ul>


                    </div>
                </div>
            </div>
        </div>
<script>
$(document).ready(function(){

 setInterval( function() { getChat(); }, 30000 );

 setInterval( function() { siswaOnline(); }, 10000 );
    getChat();
    siswaOnline();
    function siswaOnline(){
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('chat/siswaOnline'); ?>",
            dataType:'json',
            
          
           
            success: function(resp){
              $('#countOn').html(resp.count);
              $('#data-online').html(resp.output);
            },
           
        });
    }
    function getChat(){
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('chat/getChat'); ?>",
            
          
             beforeSend: function(){
                
                
                // $('#loading').css('display','');

               
   
            },
            success: function(resp){
              $('#colClose').html('');
              $('#title').html('Chat');
              $('#dataChat').html(resp);
            },
            complete: function() {
                
                // $('#loading').css('display','none');
            },
        });
    }
    $(document).on('click','#allOnline',function(){
         $.ajax({
            type:"POST",
            url:"<?php echo base_url('chat/getOnline'); ?>",
            dataType:'json',
            
          
             beforeSend: function(){
                
                
                $('#loading').css('display','');

               
   
            },
            success: function(resp){
              
              $('#dataall').html(resp.output);
              $('#titleSiswa').html(resp.title);
            },
            complete: function() {
                $('#modalSiswa').modal('show');
                $('#loading').css('display','none');
            },
        });
    })

    $(document).on('click', '#closeSearch', function() {
        getChat();
    });
    $(document).on('click', '.chatDetail', function() {
        var siswa = $(this).attr('data-id');
        
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('chat/doDetail'); ?>",
            data:{siswa:siswa},
            dataType:'json',
            
          
             beforeSend: function(){
                
                
                $('#loading').css('display','');

               
   
            },
            success: function(resp){
              if(resp.status == true){
                 $('#loading').css('display','');

                  window.location = resp.link;
              }else{
                 $('#DialogIconedDanger').modal({backdrop: 'static', keyboard: false})  

                  $('#DialogIconedDanger').modal('show');
                  $('#titleError').html('Gagal!');
                  $('#dialogError').html('Siswa tidak dapat ditemukan');
                 
                  $('#iconError').html('<ion-icon name="close-circle"></ion-icon>');

              }
            },
            complete: function() {
                
                $('#loading').css('display','none');
            },
        });
    });
    $(document).on('click', '.detailchat', function() {
        var siswa = $(this).attr('data-siswa');
        var id = $(this).attr('data-id');
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('chat/doDetail'); ?>",
            data:{siswa:siswa,id:id},
            dataType:'json',
            
          
             beforeSend: function(){
                
                
                $('#loading').css('display','');

               
   
            },
            success: function(resp){
              if(resp.status == true){
                 $('#loading').css('display','');

                  window.location = resp.link;
              }else{
                 $('#DialogIconedDanger').modal({backdrop: 'static', keyboard: false})  

                  $('#DialogIconedDanger').modal('show');
                  $('#titleError').html('Gagal!');
                  $('#dialogError').html('Siswa tidak dapat ditemukan');
                 
                  $('#iconError').html('<ion-icon name="close-circle"></ion-icon>');

              }
            },
            complete: function() {
                
                $('#loading').css('display','none');
            },
        });
    });
    $(document).on('keyup', '#searchs', function(e) {
        var search = $(this).val();
        if (e.key === "Enter"){
            
            $.ajax({
            type:"POST",
            url:"<?php echo base_url('chat/searchUser'); ?>",
            data:{key:search},
          
             beforeSend: function(){
                
                
                $('#loading').css('display','');

               
   
            },
            success: function(resp){
              
              $('#title').html('Pencarian '+search);
              $('#colClose').html('<h2 id="closeSearch" class="mt-2"><ion-icon name="close-circle-outline"></ion-icon></h2>');
              $('#dataChat').html(resp);
            },
            complete: function() {
                
                $('#loading').css('display','none');
            },
            });
        }

        if(search == ''){
            
            getChat();
        }
       
        
  });
  $(document).on('submit', '#formSearch', function(e) {
        e.preventDefault();
        var search = $('#searchs').val();
        
        
  });
});

</script>