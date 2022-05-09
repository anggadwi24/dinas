 <style type="text/css">
  .container{max-width:1170px; margin:auto;}
img{ max-width:100%;}
.inbox_people {
  background: white none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 100%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%;
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 600px; overflow-y: scroll;}

.active_chat{ background:#6d9cf68a;color: white!important}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 100%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.msg_file_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 40px;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 550px;
  overflow-y: auto;
}
</style>
 <div class="col-lg-12 mt-5 mb-5"><button class="btn btn-primary w-100" data-toggle="modal" data-target="#broadModal">BROADCAST PESAN</button></div>
<div class="col-lg-12">
   <div class="border border-primary messaging">
                                  <div class="inbox_msg">
                                    <div class="row">
                                    <div class="col-lg-6">
                                  
                                    <div class="inbox_people">
                                      <div class="headind_srch">
                                        <div class="recent_heading">
                                          <h4>Obrolan</h4>
                                        </div>
                                       <div class="srch_bar">
                                          <div class="stylish-input-group">
                                            <input type="text" class="search-bar" id="searchCol" placeholder="Search" >
                                            <!-- <span class="input-group-addon">
                                            <button type="button" id="btnSearch"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                                            </span> --> </div>
                                        </div>
                                      </div>
                                      <div class="inbox_chat">
                                      


                                      </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                    <div class="mesgs">
                                      <div class="msg_history">
                                            
                                                   <div id="load_data" >

                                                        
                                                    </div>
                                      </div>
                                      <div class="type_msg">
                                        <div class="input_msg_write" id="formTeks">
                                          <input type="text" class="write_msg" placeholder="Type a message" id="chat" />
                                          <input type="hidden" id="peg_id">

                                          <button class="msg_file_btn" type="button"><i class="fa fa-paperclip" aria-hidden="true" id="sendFile"></i></button>
                                          <input type="file" id="gambar" style="display:none" accept="image/*">
                                          <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane" aria-hidden="true" id="sendMsg"></i></button>

                                        </div>
                                      </div>
                                    </div>
                                </div>
                                  </div>
                                    </div>
                              </div>
  </div>

 <div class="modal fade" id="broadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Broadcast Chat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="<?= base_url('administrator/broadcast') ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                
                                <div class="col-lg-12">
                                    <label>Reseller</label>
                                    <select name="konsumen[]" class="form-control selectpicker" data-live-search="true" title="Pilih " required multiple id="customer" data-actions-box="true">
                                        
                                     
                                        <?php 
                                            $konsumen = $this->model_app->view_ordering('rb_konsumen','nama_lengkap','ASC');
                                            foreach($konsumen as $kon){
                                                echo "<option value='".$kon['id_konsumen']."'>".$kon['nama_lengkap']."</option>";
                                            }

                                        ?>
                                  
                                    </select>
                                </div>
                                
                                <div class="col-lg-12 form-group">
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="statusBrd" id="inlineRadio1" value="teks" checked>
                                      <label class="form-check-label" for="inlineRadio1">Teks</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="statusBrd" id="inlineRadio2" value="file">
                                      <label class="form-check-label" for="inlineRadio2">File</label>
                                    </div>
                                   
                                </div>
                                <div class="col-lg-12 form-group" id="colTeks">
                                    <label> Teks</label>
                                    <textarea name="teks" class="form-control"></textarea>
                                </div>
                                <div class="col-lg-12" id="colFile">
                                    <label> File</label>
                                    <input type="file" name="file" class="form-control">
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <input type="submit" name="submit" class="btn btn-primary w-100" value="B R O A D C A S T">
                                </div>
                            </div>
                            </form>
                          </div>
                          
                        </div>
                      </div>
                    </div>
 <script type="text/javascript">
        function selAll(){
               $('#kodecustomer1 option').attr("selected","selected");
        $('#kodecustomer1').selectpicker('refresh');
        }
        $('#colTeks').show();
                $('#colFile').hide();
        $("input[name='statusBrd']").change(function(){
            if($(this).val() == 'teks'){
                $('#colTeks').show();
                $('#colFile').hide();
            }else{
                $('#colTeks').hide();
                $('#colFile').show();
            }
});
    </script>
<script>
  $(document).ready(function(){   
        // tampil_notif();
        // data_notif();
       
        // tampil_chat();
        // data_chat()
        chat_data();

           $(document).ready(function() {
                    setInterval(tampil_chat, 5000);
                });

            $(document).ready(function() {
                setInterval(data_chat, 5000);
            });
            $('#formTeks').hide();
          
        //  function tampil_chat(){
                       
        //          $.ajax({
        //         type: 'POST',
        //         url: '<?php echo base_url(); ?>administrator/datachat/',
                
             
        //         dataType: 'json',
          
        //         success: function(response){
        //            // console.log(response);
                   
                   
                    
        //             $("#pesan").html(response);
                   
        //         }
 
        //     });
        // }

        // //Menampilkan Data di tabel
        // function tampil_notif(){
                       
        //          $.ajax({
        //         type: 'POST',
        //         url: '<?php echo base_url(); ?>administrator/datanotif/',
                
             
        //         dataType: 'json',
          
        //         success: function(response){
        //            // console.log(response);
                   
                   
                    
        //             $("#notif").html(response);
                   
        //         }
 
        //     });
        // }
          $('#sendMsg').click(function(){

              var chat = $("#chat").val();
              var id_peg = $("#peg_id").val();
          
              if(id_peg == ""){
                alert('Anda Belum Memilih Customer');
              }else if(chat ==  ""){
                $('#chat').focus();
              }else{

              $.ajax
              ({ 
                  url: '<?= base_url('administrator/sendchat')?>',
                  data: {"chat": chat,"id_peg":id_peg},
                  type: 'post',
                  success: function(result)
                  { 
                        fetch_chat(id_peg);
                       $("#chat").val(" ");
                  }
              });
            }
          });
          function fetch_chat(id_peg){
             $.ajax({
        url:"<?php echo base_url(); ?>administrator/fetch_chat",
        type:"POST",
         data: {id:id_peg},
      
        success:function(response)
        {

                 
                     
                     
                       
               
                    $("#load_data").html(response);
                     $('.msg_history').scrollTop($('.msg_history')[0].scrollHeight);
        }
      });
          }
        //     function data_chat(){
                       
        //           $.ajax({
        //         type: 'POST',
        //         url: '<?php echo base_url(); ?>administrator/detailChatShow',
                
             
                    
          
        //         success: function(response){

                 
                    
        //             $("#data-chat").html(response);
        //         }
 
        //     });
        // }
           $(document).on('click', '#detailChatShow', function(e) {
              e.preventDefault();
            // code to read selected table row cell data (values).
            $('#formTeks').show();
            
            var $h3s = $('.chat_list');
               $(this).addClass('active_chat');
             $h3s.click(function(){
                $h3s.removeClass('active_chat');
                $(this).addClass('active_chat');
            });
           
            $('html, body').animate({ scrollTop: $('#load_data').offset().top }, 'slow');
               var id = $(this).attr('data-id');
              
              
                $("#peg_id").val(id);
               $.ajax( {
                type: 'POST',
                url: '<?= base_url('administrator/updateChat')?>',
                data: {id:id},

                success: function(data) {
                        fetch_chat(id);
                       
                      
                }
            } );

        
          
            
          });
        function chat_data(){
                       
                  $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>administrator/detailChatShow',
                
             
               
          
                success: function(response){
                   // console.log(response);
                   
                    $(".inbox_chat").html(response);
                }
 
            });
        }
        function data_notif(){
                       
                  $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>administrator/data_peng',
                
             
                dataType: 'json',
          
                success: function(response){
                   // console.log(response);
                    var i;
                    
                    var html = "";
                    for(i=0;i < response.length ; i++){
                       
                  
                        html = html + '<a class="dropdown-item d-flex align-items-center" href="<?= base_url('administrator/history_det/')?>'+response[i].id_hc+'">'
                                    + '<div class="mr-3">'
                                       + '<div class="icon-circle bg-primary">'
                                          +'<i class="fas fa-file-alt text-white"></i>'
                                       +'</div>'
                                    +'</div>'
                                   
                                    + ' <div><div class="small text-gray-500">' + response[i].created_at
                                    + ' </div><span class="font-weight-bold"> ' +response[i].nama
                                    +  '</span></div>'     
                                     +'</a>';
                    }
                    $("#data-notif").html(html);
                }
 
            });
        }
    $(document).on('click','#sendFile',function(e){
           e.preventDefault();
        $('#gambar').click();
    });
    $('#gambar').change(function () {

   var file_data = $('#gambar').prop('files')[0];
   var form_data = new FormData();
    $('#gambar').replaceWith($('#gambar').val('').clone(true));
    var to = $('#peg_id').val();
 


 
     form_data.append('to', to);
      

     form_data.append('file', file_data);

     if(to !== ''){



            $.ajax({
                url: '<?php echo base_url("administrator/addImageChatAdmin") ?>', // point to server-side PHP script
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
                  console.log(data.status);
                    //alert(php_script_response); // display response from the PHP script, if any
                    if (data.status!='error') {
                        fetch_chat(to);
                        $('#gambar').val('');
                        
                    }
                },
               
            });
        }else
        {}
          });
  $("#searchCol").keyup(function(e){ 
    var code = e.key; // recommended to use e.key, it's normalized across devices and languages
    if(code==="Enter") e.preventDefault();
    if(code===" " || code==="Enter" || code===","|| code===";"){
        var search = $(this).val();
        if(search == ""){
            chat_data();
        }else{
           $.ajax( {
                type: 'POST',
                url: '<?= base_url('administrator/searchCus')?>',
                data: {search:search},

                success: function(data) {
                    $('.inbox_chat').html(data);
                }
            } );
        }
    } // missing closing if brace
});
        
          $("#btnSearch").click(function(){
    var search = $('#searchCol').val();
        if(search == ""){
            chat_data();
        }else{
              $.ajax( {
                type: 'POST',
                url: '<?= base_url('administrator/searchCus')?>',
                data: {search:search},

                success: function(data) {
                    $('.inbox_chat').html(data);
                }
            } );
          }
          });
    });

$(document).ready(function () {
      $('.select').selectize({
          sortField: 'text'
      });
 $('.selectpicker').selectpicker({
   
  });
     
  });


</script>