
<?php 
    if($row['foto'] == '' ){
        $foto= base_url('asset/foto_siswa/profle.svg');
    }else{
        $foto= $row['foto'];
        
    }
?>
<div class="row mt-4">
    <div class="col-9 ">
   
            <h3 class="subtitle mb-0">Halo,</h3>
            
            <h2 class="title"><?= ucfirst($row['nama_lengkap'])?></h2>
    </div>
    <div class="col-3">
            <img src='<?= $foto?>' class='rounded-circle float-right' style='width:60px;height:60px;border:1px solid white'>
    </div>
    <!-- <div class="col-12 mt-2">
                    
                    <div class="custom-control custom-switch float-right" style='padding-left:0rem !important'>
                     
                        <input type="checkbox" class="custom-control-input dark-mode-switch" id="darkmodeswitch">
                        <label class="custom-control-label" for="darkmodeswitch"> </label>
                        <label for="" class="d-block">Tema</label>
                    </div>

    </div>  -->

    <div class="col-lg-12 mt-3 mb-3">
            <div class="card" style='border-radius:30px'>
                <img src="<?= template() ?>/img/quiz.png" class="card-img-top p-2" alt="image">
                <div class="card-body">
                    
                    <h5 class="card-title ">Kuis Beasiswa</h5>
                    
                    <button  class="btn btn-outline-light float-right w-50" id="btnStart">
                        <ion-icon name="happy-sharp"></ion-icon>
                        Mulai
                    </button>
                </div>
            </div>
        </div>
        <?php
            $id_siswa= $this->encrypt->decode($this->session->id_siswa,keys());
            $his = $this->db->query("SELECT * FROM quiz_partisipasi a JOIN quiz_date b ON a.qp_date = b.id_qd WHERE id_siswa= '".$id_siswa."' AND MONTH(b.tanggal) = '".date('m')."' ");
            
            if($his->num_rows() > 0){
        ?>
        
        <div class="col-12  mt-3 mb-3">
            <h3 for="">Riwayat Kuis</h3>
            <div class="carousel-multiple owl-carousel owl-theme">
                <?php foreach($his->result_array() as $h){?>
                <?php if($h['qp_poin'] <= 100 AND $h['qp_poin'] >= 75){?> 
                <div class="item">
                    
                    <div class='text-right' style='margin-bottom:-20px;z-index:99;font-size:30px;color:#206e34'>
                        <ion-icon name="happy"></ion-icon>
                    </div>
                    <div class="card card-success" style="z-index:-9">
                        
                        <div class="card-body pt-2">
                            
                            <h1 class="text-center text-white"><?= $h['qp_poin']?></h1>
                            <h5 class="text-center  text-white mb-0"><?= format_indo_1($h['tanggal']) ?></h5>
                        </div>
                    </div>
                </div>
                <?php }else if($h['qp_poin'] <= 74 AND $h['qp_poin'] >= 50 ){?>
                
                <div class="item">
                    
                    <div class='text-right' style='margin-bottom:-20px;z-index:99;font-size:30px;color:#664c28'>
                        <ion-icon name="happy"></ion-icon>
                    </div>
                    <div class="card card-warning" style="z-index:-9">
                        
                        <div class="card-body pt-2">
                            
                            <h1 class="text-center text-white"><?= $h['qp_poin']?></h1>
                            <h5 class="text-center  text-white mb-0"><?= format_indo_1($h['tanggal']) ?></h5>
                        </div>
                    </div>
                </div>
                <?php }else if($h['qp_poin'] <= 49){?>

                <div class="item">
                    
                    <div class='text-right' style='margin-bottom:-20px;z-index:99;font-size:30px;color:#872d24'>
                        <ion-icon name="sad"></ion-icon>
                    </div>
                    <div class="card card-danger" style="z-index:-9">
                        
                        <div class="card-body pt-2">
                            
                            <h1 class="text-center text-white"><?= $h['qp_poin']?></h1>
                            <h5 class="text-center  text-white mb-0"><?= format_indo_1($h['tanggal']) ?></h5>
                        </div>
                    </div>
                </div>
                <?php }?>
                <?php } ?>
                

            </div>
            <?php }?>

        </div>

</div>
       
<script>
$(document).on('click', '#btnNotif', function() {
    console.log('helo');
    var id = $(this).attr('data-id');
    window.location = "<?php echo base_url('kuis/getKuis?id='); ?>"+id;
});
$(document).on('click', '#btnCancel', function() {
    var id = $('#btnNotif').attr('data-id');
    $('#btnStart').attr('data-access','proses');
     $('#btnStart').attr('data-id',id);


     $('#btnStart').html('<ion-icon name="happy-sharp"></ion-icon>Lanjutkan');
    $('#btnStart').prop('disabled',false); 
});
$(document).on('click', '#btnStart', function() {
    $('#btnStart').html('<span class="spinner-border spinner-border-sm mr-05" role="status" aria-hidden="true"></span>Loading...');
    $('#btnStart').prop('disabled',true);
    var status = $(this).attr('data-status');
    var access = $(this).attr('data-access');
    var id = $(this).attr('data-id');
    if(status == 'yes'){
        if(access == 'start'){
            $.ajax({
            type:"POST",
            url:"<?php echo base_url('main/startKuis'); ?>",
            dataType:'json',
            success: function(resp){
              if(resp.status == true){
                  if(resp.access == 'y'){
                    window.location = resp.message;
                  }else{
                    $('#iconError').html('<ion-icon name="alert-circle-outline"></ion-icon>');
                    $('#titleError').html('Peringatan');
                    $('#dialogError').html(resp.message);
                    $('#DialogIconedDanger').modal('show');
                  }
              }else{
                $('#iconError').html('<ion-icon name="close-circle"></ion-icon>');
                $('#titleError').html('Peringatan');
                $('#dialogError').html('Tidak Ada Quiz Untuk Hari Ini!');
                $('#DialogIconedDanger').modal('show');
              }
             

            }
          })
        }else if(access == 'finish'){
            $('#iconError').html('<ion-icon name="alert-circle-outline"></ion-icon>');
            $('#titleError').html('Peringatan');
            $('#dialogError').html('Anda Sudah Menyelesaikan Quiz Hari ini!');
            $('#DialogIconedDanger').modal('show');
        }else if(access == 'not'){
            $('#iconError').html('<ion-icon name="close-circle"></ion-icon>');
            $('#titleError').html('Peringatan');
            $('#dialogError').html('Tidak Ada Quiz Untuk Hari Ini!');
            $('#DialogIconedDanger').modal('show');
        }else if(access == 'proses'){
         
            $('#titleNotif').html('Peringatan');
            $('#dialogNotif').html('Anda Ingin Melanjutkan Kuis ?');
            $('#btnNotif').html('LANJUT');
            $('#btnNotif').attr('data-id',id);
            $('#btnNotif').attr('data-status','kuis');
            $('#DialogBasic').modal('show');
        }
    }else{
        $('#iconError').html('<ion-icon name="close-circle"></ion-icon>');
        $('#titleError').html('Peringatan');
        $('#dialogError').html('Tidak Ada Quiz Untuk Hari Ini!');
        $('#DialogIconedDanger').modal('show');
    }

});
$(document).ready(function() 
{
    
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('main/cekKuisToday') ?>",
            dataType:'json',
           
         
           
         
            beforeSend: function(){
                
             

                $('#btnStart').html('<span class="spinner-border spinner-border-sm mr-05" role="status" aria-hidden="true"></span>Loading...');
                $('#btnStart').prop('disabled',true);
   
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
               
              if(resp.status == true){
                $('#btnStart').attr('data-status','yes');

                if(resp.access == 'y'){
                    $('#btnStart').attr('data-access','start');

                    $('#btnStart').html('<ion-icon name="happy-sharp"></ion-icon>Mulai');
                    $('#btnStart').prop('disabled',false); 
                }else if(resp.access == 'n'){
                    $('#btnStart').attr('data-access','not');

                    $('#btnStart').html('<ion-icon name="sad-sharp"></ion-icon>Tidak ada Kuis');
                    $('#btnStart').prop('disabled',true); 
                }else if(resp.access == 'f'){
                    $('#btnStart').attr('data-access','finish');

                    $('#btnStart').html('<ion-icon name="happy-sharp"></ion-icon>Finish');
                    $('#btnStart').prop('disabled',true); 
                }else if(resp.access == 'p'){
                    $('#btnStart').attr('data-access','proses');
                    $('#btnStart').attr('data-id',resp.id_qp);


                    $('#btnStart').html('<ion-icon name="happy-sharp"></ion-icon>Lanjutkan');
                    $('#btnStart').prop('disabled',false); 
                }
                else if(resp.access == 'd'){
                    $('#btnStart').attr('data-access','not');
                    


                    $('#btnStart').html('<ion-icon name="happy-sharp"></ion-icon>Sesi kuis sudah selesai');
                    $('#btnStart').prop('disabled',true); 
                } else if(resp.access == 's'){
                    $('#btnStart').attr('data-access','not');
                    


                    $('#btnStart').html('<ion-icon name="happy-sharp"></ion-icon>Sesi kuis belum dimulai');
                    $('#btnStart').prop('disabled',true); 
                }
               
                
              }else{
                $('#btnStart').attr('data-status','no');
                $('#btnStart').html('<ion-icon name="sad-sharp"></ion-icon>Mulai');
                $('#btnStart').prop('disabled',true);
              }
               
            }, 
             complete: function() {
               $('#formAdd input').prop('disabled',false);
                $('textarea').prop('disabled',false);

               
            },
        });
    });
</script>