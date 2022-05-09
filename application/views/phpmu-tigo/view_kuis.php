<style>
    .btnModal{
        position: fixed;
        top:20px
    }
</style>
<button type="button" class="btn btn-text-light btnModal" data-toggle="modal" data-target="#DialogIconedButtonInline" data-backdrop="static" data-keyboard="false">
                <ion-icon name="chevron-back-outline"></ion-icon> Kembali
            </button> 
<div class="section  card" style='margin:0 !important;z-index:-99;boder-radius:0px !important;height:18rem;border-bottom-right-radius:100px;border-bottom-left-radius:20px;'>
<div class='container-fluid'>
    <div class='row' >
        <div class='col-6 mt-2'>
             
        </div>
        <div class='col-6 mt-3'>
            <h3 id='timer' class='float-right text-white'>--:--</h3>
        </div>
        <div class='col-12 mt-5'>
            <h3 id='page' class='text-center text-white'>Soal 1/50</h3>
        </div>
    </div>
</div>
        
</div>
<form id="formAnswer">
<div class="section card-white" style='margin-top:-9rem !important;margin-left:20px !important;margin-right:20px !important' >
<div class='container-fluid'>
    <div class='row justify-content-center' id="dataSoal" >
       


    </div>
    <input type='hidden' name="quiz_duration" id="timerval">
       <input type='hidden' name="id_qa" id="id_qa">
       <input type='hidden' name="qa_soal" id="qa_soal">
</div>

</div>
<div class="section full mb-2 mt-5 mx-4">
            
            <div class="wide-block p-0" style="background:transparent">

                <div class="input-list">
                    <div class="custom-control custom-radio mb-1 card-white " style='border-radius:10px;box-shadow: 0 3px 6px 0 rgb(0 0 0 / 10%), 0 1px 3px 0 rgb(0 0 0 / 8%);'>
                        <input type="radio" id="customRadio11" name="answer" class="custom-control-input" value="A">
                        <label class="custom-control-label" for="customRadio11" id='answer_a'>A</label>
                    </div>
                    <div class="custom-control custom-radio mb-1 card-white" style='border-radius:10px;box-shadow: 0 3px 6px 0 rgb(0 0 0 / 10%), 0 1px 3px 0 rgb(0 0 0 / 8%);'>
                        <input type="radio" id="customRadio12" name="answer" class="custom-control-input" value="B">
                        <label class="custom-control-label" for="customRadio12" id='answer_b'>B</label>
                    </div>
                    <div class="custom-control custom-radio mb-1 card-white" style='border-radius:10px;box-shadow: 0 3px 6px 0 rgb(0 0 0 / 10%), 0 1px 3px 0 rgb(0 0 0 / 8%);'>
                        <input type="radio" id="customRadio13" name="answer" class="custom-control-input" value="C">
                        <label class="custom-control-label" for="customRadio13" id='answer_c'>C</label>
                    </div>
                    <div class="custom-control custom-radio mb-1 card-white" style='border-radius:10px;box-shadow: 0 3px 6px 0 rgb(0 0 0 / 10%), 0 1px 3px 0 rgb(0 0 0 / 8%);'>
                        <input type="radio" id="customRadio14" name="answer" class="custom-control-input" value="D">
                        <label class="custom-control-label" for="customRadio14" id='answer_d'>D</label>
                    </div>
                </div>

            </div>
        </div>
        
</div>
<div class="mb-2 mt-2 mx-4">
    <div class='row' id='btnData'></div>
   
</div>
</form>






<div class="modal fade dialogbox" id="DialogIconedButtonInline" data-backdrop="static" tabindex="-1"
            role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Peringatan</h5>
                    </div>
                    <div class="modal-body">
                        Anda akan keluar dari kuis ini, anda yakin?
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <button class="btn btn-text-secondary" data-dismiss="modal">
                                
                                TIDAK
                            </button>
                            <button  class="btn btn-text-danger" id='btnKeluar'>
                                KELUAR
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>
$(function(){
    var no =<?= $number?>;
    $(document).on('click', '#btnKeluar', function() {
        
    var jam = $('#timerval').val();
       $.ajax({
            type:"POST",
            url:"<?php echo base_url('kuis/updateDuration'); ?>",
            data:{jam:jam},
           
            success: function(resp){
                                
                                
                
                window.location ='<?= base_url('main')?>';
                            
                
            },
        });
    });
    $(document).on('click', '#btnCek', function() {
        $.ajax({
                type:"POST",
                url:"<?php echo base_url('kuis/cekLast'); ?>",
                dataType:'json',

               
                success: function(resp){
                                    
                                    
                                
                  
                   
                   var newUrl = '<?= base_url('kuis?key='.$key.'&number=')?>'+resp;
                   history.pushState({}, null, newUrl);
                   $('#modalCek').modal('show');
                   getSoal(resp);
                                
                    
                },
            });
    });
    $(document).on('click', '.btnDone', function() {
        $.ajax({
                type:"POST",
                url:"<?php echo base_url('kuis/setSave'); ?>",

               
                success: function(resp){
                                    
                                    
                                  
                    window.location ='<?= base_url('main')?>';
                                  
                    
                },
            });
    });
    $(document).on('click', '#btnSave', function() {
        
        $('#btnLanjut1').html('FINISH');
        $('#btnLanjut1').addClass('btnDone');
        $('#btnLanjut').html('FINISH');
        $('#btnLanjut').addClass('btnDone');
          $("#formAnswer").submit();
          
    });
   
    $(document).on('click', '#btnAnswer', function() {
      
        $("#formAnswer").submit();
    });
    $(document).on('click', '#btnBack', function() {
       
        no = parseInt($('#qa_soal').val()) -1;
        var newUrl = '<?= base_url('kuis?key='.$key.'&number=')?>'+no;
        history.pushState({}, null, newUrl);
        getSoal(no);
        
        
    });
    $(document).on('click', '#btnNext', function() {
       
       no = parseInt($('#qa_soal').val()) + 1;
       var newUrl = '<?= base_url('kuis?key='.$key.'&number=')?>'+no;
       history.pushState({}, null, newUrl);
       getSoal(no);
       
       
   });
    $(document).on('click', '#btnLanjut', function() {
        $('#DialogIconedSuccess').modal('hide');
        no = parseInt($('#qa_soal').val()) +1;
        var newUrl = '<?= base_url('kuis?key='.$key.'&number=')?>'+no;
        history.pushState({}, null, newUrl);
        getSoal(no);
        
  });
  $(document).on('click', '#btnLanjut1', function() {
        $('#ModalBasic').modal('hide');
        no = parseInt($('#qa_soal').val()) +1;
        var newUrl = '<?= base_url('kuis?key='.$key.'&number=')?>'+no;
        history.pushState({}, null, newUrl);
        getSoal(no);
        
  });
    $('#formAnswer').on('submit', function(e){
        
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('kuis/SaveAnswer') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType:'json',
           
         
            beforeSend: function(){
                
                $('#formAnswer input[type=radio]').prop('disabled',true);
                $('#loading').css('display','');

                $('#formAnswer button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formAnswer button').prop('disabled',true);
   
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
               
               if(resp.status == true) {
                $('#dialogLanjut').html(resp.msg);
                
                $('#DialogIconedSuccess').modal({backdrop: 'static', keyboard: false})  
                $('#DialogIconedSuccess').modal('show');
                
                
               }else{
                
                $('#dialogWrong').html(resp.msg);
                
                $('#ModalBasic').modal({backdrop: 'static', keyboard: false})  
                $('#ModalBasic').modal('show');
               }
                
             
                
               
            }, 
             complete: function() {
               
                $('#formAnswer input[type=radio]').prop('disabled',false);
                $('#loading').css('display','none');
                $('input[name=answer]').prop('checked',false);
                $('#formAnswer button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formAnswer button').prop('disabled',true);
            },
        });
    });
    
    getSoal(no);
    function getSoal(no){
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('kuis/getSoal'); ?>",
            data:{no:no},
            dataType:'json',
             beforeSend: function(){
                
                
                $('#loading').css('display','');

               
   
            },
            success: function(resp){
                if(resp.status == true){
                    $('#dataSoal').html(resp.soal);
                    $('#page').html(resp.title);
                    if(resp.row.qa_status == 'n'){
                       $('input[type=radio][name=answer]').attr('disabled',false);
                      

                    }else{
                        var keys = resp.row.qa_answer;
                  
                       $('input[name=answer][value='+keys+']').prop('checked',true);
                       $('input[type=radio][name=answer]').attr('disabled',true);

                    }
                    $('#btnData').html(resp.button);
                    $('#answer_a').html(resp.answer_a);
                    $('#answer_b').html(resp.answer_b);
                    $('#answer_c').html(resp.answer_c);
                    $('#answer_d').html(resp.answer_d);
                   
                    $('#id_qa').val(resp.row.id_qa);
                    $('#qa_soal').val(resp.row.qa_soal);

                    

                }else{

                }
            },
            complete: function() {
                
                $('#loading').css('display','none');
            },
        });
    }
    getData();
    function getData(){
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('kuis/getKuisDetail'); ?>",
            dataType:'json',
            success: function(resp){
                if(resp.status == true){
                   
                    var timer2 = resp.row.quiz_duration;
                    var interval = setInterval(function() {


                    var timer = timer2.split(':');
                    //by parsing integer, I avoid all extra string processing
                    var minutes = parseInt(timer[0], 10);
                    var seconds = parseInt(timer[1], 10);
                    --seconds;
                    minutes = (seconds < 0) ? --minutes : minutes;
                    seconds = (seconds < 0) ? 59 : seconds;
                    seconds = (seconds < 10) ? '0' + seconds : seconds;
                    //minutes = (minutes < 10) ?  minutes : minutes;
                    $('#timer').html(minutes + ':' + seconds);
                    $('#timerval').val(minutes + ':' + seconds);
                    if(seconds <= 0){
                        var jam = minutes + ':'+seconds;
                        $.ajax({
                            type:"POST",
                            url:"<?php echo base_url('kuis/updateDuration'); ?>",
                            data:{jam:jam},
                            dataType:'json',
                            success: function(resp){
                                
                                
                              

                            
                
                            },
                        });
                    }
                    if (minutes < 0){
                        clearInterval(interval);
                        setExpired();
                    } 
                    //check if both minutes and seconds are 0
                    if ((seconds <= 0) && (minutes <= 0)){ 
                        clearInterval(interval)
                        setExpired();
                    };
                    timer2 = minutes + ':' + seconds;
                    }, 1000);
                }else{
                    $('#iconError').html('<ion-icon name="close-circle"></ion-icon>');
                    $('#titleError').html('Peringatan');
                    $('#dialogError').html('Sesi Telah Berakhir');
                    var go = '<?= base_url('main/')?>';
                    $('#btnClose').attr('href',go);
                    $('#DialogIconedDanger').modal({backdrop: 'static', keyboard: false})  
                    $('#DialogIconedDanger').modal('show');
                }
            }
        });
    }
    function setExpired(){
        $('#iconError').html('<ion-icon name="close-circle"></ion-icon>');
        $('#titleError').html('Peringatan');
        $('#dialogError').html('Waktu Habis');
        var go = '<?= base_url('kuis/setExpired')?>';
        $('#btnClose').attr('href',go);
        $('#DialogIconedDanger').modal({backdrop: 'static', keyboard: false})  
        $('#DialogIconedDanger').modal('show');
    }
    $(document).on('click', '#btnClose', function() {
        href = $(this).attr('href');
        window.location = href;
    })
     
}); 
</script>