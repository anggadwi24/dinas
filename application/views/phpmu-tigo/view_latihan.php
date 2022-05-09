<style>
    .btnModal{
        position: fixed;
        top:20px
    }
    .card-red{
        z-index: 999;
    border: 0;
    border-radius: 6px;
    box-shadow: 0 3px 6px 0 rgb(0 0 0 / 10%), 0 1px 3px 0 rgb(0 0 0 / 8%);
    background: #f03535  !important;
    color: #ffffff;
    }
</style>

<div class="section  card">
<div class='container-fluid'>
    <div class='row my-3' >
        
        <div class='col-6  text-left'>
            <h3  class='text-left text-white mb-0'>Mata Pelajaran </h3>
            <span id='mapel' class="text-center text-white"></span>
        </div>
        <div class='col-6 text-right'>
            <h3 id='' class='text-right text-white mb-0'>Kelas </h3>
            <span id='kelas' class="text-center text-white"></span>
        </div>
    </div>
</div>
        
</div>
<form id="formAnswer">
<div class="section mt-3 mx-3 card-red" style="" >
<div class='container'>
    <div class='row justify-content-center' id="dataSoal" >
       


    </div>
    
       <input type='hidden' name="ql_id" id="ql_id" value="<?= $ql_id?>">
       <input type='hidden' name="id_quiz" id="id_quiz  " value="<?= $id_quiz?>">
       <input type='hidden' name="mapel" id="mapelVal">

</div>

</div>
<div class="section full mb-2 mt-5 mx-4">
            
            <div class="wide-block p-0" style="background:transparent">

                <div class="input-list">
                    <div class="custom-control custom-radio mb-1 card-red text-white" style='border-radius:10px;box-shadow: 0 3px 6px 0 rgb(0 0 0 / 10%), 0 1px 3px 0 rgb(0 0 0 / 8%);'>
                        <input type="radio" id="customRadio11" name="answer" class="custom-control-input" value="A">
                        <label class="custom-control-label" for="customRadio11" id='answer_a' style="color:white">A</label>
                    </div>
                    <div class="custom-control custom-radio mb-1 card-red text-white" style='border-radius:10px;box-shadow: 0 3px 6px 0 rgb(0 0 0 / 10%), 0 1px 3px 0 rgb(0 0 0 / 8%);'>
                        <input type="radio" id="customRadio12" name="answer" class="custom-control-input" value="B">
                        <label class="custom-control-label" for="customRadio12" id='answer_b ' style="color:white">B</label>
                    </div>
                    <div class="custom-control custom-radio mb-1 card-red text-white" style='border-radius:10px;box-shadow: 0 3px 6px 0 rgb(0 0 0 / 10%), 0 1px 3px 0 rgb(0 0 0 / 8%);'>
                        <input type="radio" id="customRadio13" name="answer" class="custom-control-input" value="C">
                        <label class="custom-control-label" for="customRadio13" id='answer_c' style="color:white">C</label>
                    </div>
                    <div class="custom-control custom-radio mb-1 card-red text-white" style='border-radius:10px;box-shadow: 0 3px 6px 0 rgb(0 0 0 / 10%), 0 1px 3px 0 rgb(0 0 0 / 8%);'>
                        <input type="radio" id="customRadio14" name="answer" class="custom-control-input" value="D">
                        <label class="custom-control-label" for="customRadio14" id='answer_d' style="color:white">D</label>
                    </div>
                </div>

            </div>
        </div>
        
</div>
<div class="mb-2 mt-2 mx-4">
    <div class='row' id='btnData'></div>
   
</div>
</form>
<?php 

    $user = $this->model_app->view_where('siswa',array('id_siswa'=>decode($this->session->id_siswa)))->row_array();
?>
<div class="modal fade modalbox" id="modalMapel" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Mata Pelajaran</h5>
                        
                    </div>
                    <div class="modal-body">
                        <div class="login-form">
                            
                            <div class="section mt-4 mb-5">
                                <form id="formMapel">
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="email1">Mata Pelajaran</label>
                                            <select name="mapel" id="mapelSel" class="form-control">
                                                <?php 
                                                    $mapel = $this->model_app->view_where('mata_pelajaran',array('mapel_kelas'=>$user['kelas']));
                                                    if($mapel->num_rows() > 0){
                                                        foreach($mapel->result_array() as $mp){
                                                            echo "<option value='".encode($mp['mapel_id'])."'>".$mp['mapel']."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                  
                                    
                                    <div class="mt-2">
                                        <button  class="btn btn-primary btn-block btn-lg"
                                            >Pilih</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<script>
    tampil();
    function tampil(){
        $('#modalMapel').modal('show');
        
    }
    $(document).on('submit','#formMapel',function(e){
        e.preventDefault();
        var mapel = $('#mapelSel').val();
        console.log(mapel);
        $('#mapelVal').val(mapel);
        generateSoal($('#mapelSel').val());
        $('#modalMapel').modal('hide');
        
    })
    function generateSoal(mapel){
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('latihan/generateSoal'); ?>",
            data:{mapel:mapel},
            dataType:'json',
             beforeSend: function(){
                
                
                $('#loading').css('display','');

               
   
            },
            success: function(resp){
                $('#ql_id').val(resp.ql_id);
                $('#id_quiz').val(resp.id_quiz);
                getSoal(resp.id_quiz);
            },
            complete:function(){
                $('#loading').css('display','');
            }
        });
        
    }
  
    function getSoal(id){
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('latihan/getSoal'); ?>",
            data:{id:id},
            dataType:'json',
             beforeSend: function(){
                
                
                $('#loading').css('display','');

               
   
            },
            success: function(resp){
                if(resp.status == true){
                    $('#dataSoal').html(resp.soal);
                   
                   
                    $('#mapel').html(resp.mapel);
                    $('#kelas').html(resp.kelas);
                    $('#btnData').html(resp.button);
                    $('#answer_a').html(resp.answer_a);
                    $('#answer_b').html(resp.answer_b);
                    $('#answer_c').html(resp.answer_c);
                    $('#answer_d').html(resp.answer_d);
                   
                   
              

                    

                }else{

                }
            },
            complete: function() {
                
                $('#loading').css('display','none');
            },
        });
    }
    $(document).on('click', '#btnAnswer', function() {
      
      $("#formAnswer").submit();
  });
    $(document).on('submit','#formAnswer',function(e){
        e.preventDefault();
        $.ajax({
          
          type: 'POST',
          url:"<?= base_url('latihan/SaveAnswer') ?>",

         
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
            console.log(resp);
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
              $('#formAnswer button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
              $('#formAnswer button').prop('disabled',true);
          },
      });

    })
    $(document).on('click', '#btnLanjut1', function() {
        var mapel = $('#mapelVal').val();
       $.ajax({
           type:'POST',
           url:'<?= base_url('latihan/next')?>',
           data:{mapel:mapel},
           dataType:'json',
           beforeSend: function(){
              
             
              $('#loading').css('display','');

             
 
            },
           success:function(resp){
                $('#ql_id').val(resp.ql_id);
                $('#id_quiz').val(resp.id_quiz);
                getSoal(resp.id_quiz);
           },
           complete:function(){
              $('input[name=answer]').prop('checked',false);

            $('#ModalBasic').modal('hide');
               $('#loading').css('display','none');
           }
       })
        
  });
  $(document).on('click', '#btnLanjut', function() {
    var mapel = $('#mapelVal').val();
       $.ajax({
           type:'POST',
           url:'<?= base_url('latihan/next')?>',
           data:{mapel:mapel},
           dataType:'json',
           beforeSend: function(){
              
             
              $('#loading').css('display','');

             
 
            },
           success:function(resp){
                $('#ql_id').val(resp.ql_id);
                $('#id_quiz').val(resp.id_quiz);
                getSoal(resp.id_quiz);
           },
           complete:function(){
              $('input[name=answer]').prop('checked',false);

            $('#DialogIconedSuccess').modal('hide');
               $('#loading').css('display','none');
           }
       })
        
  });
</script>