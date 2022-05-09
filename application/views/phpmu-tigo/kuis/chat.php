<style type="text/css">
#loader1 {
  position: fixed;
  top: 100px;
  z-index: 9999;
  overflow: hidden;
  background:transparent;
}


#loader1:before {
  content: "";
  position: fixed;
  top: calc(33% - 30px);
  left: calc(50% - 30px);
  border: 2px solid #808183;
  border-top-color: #fff;
  border-bottom-color: #fff;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  -webkit-animation: animate-loader 1s linear infinite;
  animation: animate-loader 1s linear infinite;
}

@-webkit-keyframes animate-loader {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes animate-loader {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}


.colChat{
  height: 110vh;
}
body{
  background-color: white !important ;
  overflow: hidden !important;
}
main{
    overflow: hidden;
}
.colInput{
  position: fixed;
  bottom: 0px;
 
  left: 0px;
  right: 0px;
}

</style>
<style type="text/css">

.incoming_msg_img {
  display: inline-block;
  width: 10%;
}

.incoming_msg_img img {
  width: 100%;
}

.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 88%;
}

.received_withd_msg p {
  background: #fff none repeat scroll 0 0;
  border-radius: 0 15px 15px 15px;
  color: #646464;
  font-size: 25px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}

.time_date {
  color: #fff;
  display: block;
  font-size: 20px;
  margin: 8px 0 0;
}

.received_withd_msg {
  width: 70%;
}

.mesgs{
  float: left;
  padding: 30px 15px 0 25px;
  width:70%;
}

.sent_msg p {
  background:#f2e6ff;
  border-radius: 12px 15px 15px 0;
  font-size: 25px;
  margin: 0;
  color: #000;
  padding: 5px 10px 5px 12px;
  width: 100%;
}

.outgoing_msg {
  overflow: hidden;
  margin: 26px 10px 26px;
}

.sent_msg {
  float: right;
  width: 70%;
}

.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
  outline:none;
}

.type_msg {
  border-top: 1px solid #c4c4c4;
  position: relative;
}

.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border:none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 15px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}

.messaging {
  padding: 0 0 50px 0;
}

.msg_history {
  height: 85vh;
  overflow-y: auto;
  overflow-x: hidden;
}
@media only screen and (max-width: 320px) {
  .colChat {
     height: 115vh;
  }
  .msg_history{
    height: 115vh;
  }
}
.nameObr{
  position: fixed;
  padding-bottom: 10px;
  top: 40px;
  left: 5px;
  right: 5px;
}

</style>
 <style type="text/css">
    .bronze { 

        border-style: solid;
       border-width: 5px;
       border-color: #E5BD96;
       padding: 0px;
      
     }
      .silver { 

        border-style: solid;
       border-width: 5px;
       border-color: #D7D7D7;
       padding: 0px;
      
     }
      .gold { 

        border-style: solid;
       border-width: 5px;
       border-color: #C9B037;
       padding: 0px;
      
     }
    .crown{
      position: relative;
       top: -40px;
       bottom: 0px;
       left: 15px;
       right: 0px;

       -webkit-text-stroke: 1px #F7DEC4;
       color: white;
 
    }
    #myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: fixed;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
.btnSend{
  background-color: transparent;
  border: none;
  
}
</style>

      <div class="container-fluid" style="margin: 0;padding:0;overflow: hidden;" >

    <div class="col-12 fixed-top py-3 " style="background-color:#4f56ff" id="navbarTop">
      <a href="<?= base_url('kuis/index/50')?>"><i class="fas fa-arrow-left text-light mr-2" style="font-size:50px" ></i><span class="text-light" style="font-size:40px">Kembali</span></a>
    </div>
    <div class="row " style="    margin-top: 7rem!important;" >
        <div id="loader1" style="display: none;"></div>
        <div class="col-12 ">
          <div class=" mt-2 mx-1 "  >
              
              
    <div class="msg_history"  id="dataChat">
  
    </div>
       
          </div>
        </div>
       
        
        </div>
         
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 colInput fixed-bottom" style="background-color: #4f56ff;height:100px; " id="navbarBot">
            <div class="row">
                   <div class="col-12 border-top  "></div>
                   <div class="col-12   mt-2 mb-2">
                            <div class="d-flex">
                              <div class="p-2 mt-3" style="width:10%">
                                 <span id="fileup"><i class="fas fa-paperclip" style="color:#ffffff;font-size: 40px;"></i></span>
                                   <input type="file" id="gambar" style="display:none" accept="image/*">
                              </div>
                              <div class="p-2 w-75"><input type="text" name="teks" id="teks" class="form-control" style="background-color: #ffffffc7;border-radius: 15px;height: 70px;font-size: 25px;" placeholder="Buat Pesan" > </div>
                              <input type="hidden" id="to" value="admin">
                              
                              <div class="p-2 mt-2" style="width:10%">
                                <button class="btnSend" id="btnSend"  style=""><i class="fas fa-paper-plane " style="color:#fff;font-size: 45px;"></i></button> 
                                <button class="btnSend" id="btnLoad" disabled ><i class="fas fa-spinner fa-spin text-white" style="color:#fff;font-size: 45px;"></i></button>
                              </div>
                           </div>
                      </div>
                     <div class="col-12 border-bottom "></div>
            </div>
          
        </div>
        </div>
      </div>

  <div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>

<script>


function zoomImg(src){
  var modal = $('#myModal');
  $('#navbarTop').hide();
  $('#navbarBot').hide();

var modalImg = $('#img01');
    modal.css("display", "block");
    modalImg.attr('src',src);
}


// Get the <span> element that closes the modal
var span = $(".close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
   var modal = $('#myModal');


    modal.css("display", "none");


}

</script>
  <script type="text/javascript">
var flag = true;
 
 function scrollToBottom() {
     $("#dataChat").animate({ scrollTop: $("#dataChat")[0].scrollHeight }, 1000);
}
  $('#btnLoad').hide();
     $( "#btnSend" ).click(function() {

        var teks = $('#teks').val();
        var to = $('#to').val();

        if(teks == ""){
          $('#teks').focus();
        }else{
          $.ajax({
                type : 'POST',
                beforeSend: function(){
                  $('#loader1').css("display", "block");
                  $('#teks').attr('readonly',true);
                  $('#btnLoad').show();
                  $('#btnSend').hide();
                },
                url : '<?= base_url("kuis/sendChatAdmin")?>',
                data: {teks:teks,to:to},
                success : function(data){
                
                   detailChat();
                   scrollToBottom();
                },
                complete: function(){
                   $('#teks').val('');
                   $('#teks').attr('readonly',false);
                   $('#btnLoad').hide();
                   $('#btnSend').show();
                    $('#loader1').css("display", "none");
                }
            });
        }

     });
    $("#teks").on("keydown",function search(e) {
    if(e.keyCode == 13) {
         var teks = $(this).val();
          var to = $('#to').val();
        if(teks == ""){
          $(this).focus();
        }else{
          $.ajax({
                type : 'POST',
                beforeSend: function(){
                  $('#loader1').css("display", "block");
                  $('#teks').attr('readonly',true);
                  $('#btnLoad').show();
                  $('#btnSend').hide();
                },
                url : '<?= base_url("kuis/sendChatAdmin")?>',
                data: {teks:teks,to:to},
                success : function(data){
                
                   detailChat();
                   scrollToBottom();
                },
                complete: function(){
                   $('#teks').val('');
                   $('#teks').attr('readonly',false);
                   $('#btnLoad').hide();
                   $('#btnSend').show();
                    $('#loader1').css("display", "none");
                }
            });
        }

    }
});
    detailChat();
    function detailChat(){
      var customer = 'admin'
       $.ajax({
        type : 'POST',
        
        url : '<?= base_url("kuis/displayChatAdmin")?>',
        data:{customer:customer},
        success : function(data){

          $('#dataChat').html(data);
          if(flag)
          {
             scrollToBottom();
             flag = false;
          }
          
        },
        
      });
    };
      $(document).ready(function() {
    setInterval(detailChat, 10000);
});
      $(document).on('click','#fileup',function(e){
   $('#gambar').click();

$('#gambar').change(function () {
   e.preventDefault();
   var file_data = $('#gambar').prop('files')[0];
   var form_data = new FormData();

    var to = $('#to').val();

   $('#gambar').replaceWith($('#gambar').val('').clone(true));
     form_data.append('to', to);

     form_data.append('file', file_data);

            $.ajax({
                url: '<?php echo base_url("kuis/addImageChatAdmin") ?>', // point to server-side PHP script
                dataType: 'json',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                beforeSend: function(){
                  $('#loader1').css("display", "block");
                  $('#teks').attr('readonly',true);
                  $('#btnLoad').show();
                  $('#btnSend').hide();
                },
                success: function(data,status){
                    //alert(php_script_response); // display response from the PHP script, if any
                    if (data.status!='error') {
                        $('#gambar').val('');
                         detailChat();
                         scrollToBottom();
                    }
                },
                complete: function(){
                   $('#teks').val('');
                   $('#teks').attr('readonly',false);
                   $('#btnLoad').hide();
                   $('#btnSend').show();
                    $('#loader1').css("display", "none");
                }
            });
          });
        
});


  </script>