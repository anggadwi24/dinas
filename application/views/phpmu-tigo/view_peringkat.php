<style>
    .btnKet{
        font-size:10px !important;
    }
</style>
<div class="row mb-4 mt-0 " >
    <div class="col-12  card" style='margin:0 !important;boder-radius:0px !important;min-height:23rem;border-bottom-right-radius:100px;border-bottom-left-radius:20px;'>

        <div class='row' >
            
            <div class='col-12 mt-5'>
                <h3 id='page' class='text-center text-white'>Peringkat</h3>
            </div>
            
            <div class='col-12 mt-1 px-3' >
                <div class='d-flex justify-content-center bg-alami' style='border-radius:30px' >
                    <div class=' m-1 card w-25  '><button class='btnKet btn  card text-white text-center  btn-active'  data-status ='today'>Hari Ini</button></div>
                    <div class=' m-1 card w-25 ' ><button class='btnKet btn  card text-white text-center '  data-status ='week'>Minggu Ini</button></div>
                    <div class='m-1 card w-25 ' ><button class='btnKet btn  card text-white text-center '  data-status ='month'>Bulan Ini</button></div>
                </div>
            </div>
            <div class='col-12'>
                <div class='d-flex justify-content-center'>
                    <div class='mt-3 mr-3' style='z-index:0' id='formRank2'>
                        <h2 class='text-center text-white mb-0'>2</h2>
                        <img src="<?= template()?>/img/sample/avatar/avatar1.jpg" alt="" class='mx-auto d-block img-fluid rounded-circle border' id='rank2' style="width:6rem;height:6rem">
                        <h4 class='d-block text-center mb-0 mt-1 text-white' id='poin2'>Poin 1</h4>
                        <h4 class='d-block text-center font-8 my-0 text-white' id='sekolah2'>Sekolah 1</h4>
                        <h4 class='d-block text-center font-12 text-white' id='nama2'>User 1</h4>

                       
                    </div>
                    <div class='mt-1' style='z-index:999' id="formRank1">
                        <h2 class='text-center text-white mb-0'><ion-icon name="ribbon-outline"></ion-icon></h2>
                        
                        <img src="<?= template()?>/img/sample/avatar/avatar1.jpg" alt="" class='mx-auto d-block img-fluid rounded-circle border' id='rank1' style="width:7rem;height:7rem">
                        <h4 class='d-block text-center mt-1 mb-0 text-white' id='poin1'>Poin 1</h4>
                        <h4 class='d-block text-center font-8 my-0 text-white' id='sekolah1'>Sekolah 1</h4>
                        <h4 class='d-block text-center  font-12 text-white' id='nama1'>User 1</h4>

                        

                    </div>
                    <div class='mt-5 ml-2' style='z-index:0' id='formRank3'>
                            <h2 class='text-center text-white mb-0'>3</h2>

                            <img src="<?= template()?>/img/sample/avatar/avatar1.jpg" alt="" class='mx-auto d-block img-fluid rounded-circle border' id='rank3' style="width:5rem;height:5rem">
                            <h4 class='d-block text-center mt-1 mb-0 text-white' id='poin3'>Poin 1</h4>
                            <h4 class='d-block text-center font-8 my-0 text-white' id='sekolah3'>Sekolah 1</h4>
                            <h4 class='d-block text-center  font-12 text-white' id='nama3'>User 1</h4>
                        
                    </div>

                </div>
            </div>
        </div>
        
    </div>
    <div class='col-12 mt-4 px-4 '>
        <div class='row' id='rankAll'>
            <div class='col-12 mb-2 card-white p-1'>
                <div class='row'>
                    <div class='col-1 '>
                        <h3 class='pt-3'>4. </h3>
                    </div>
                    <div class='col-3'>
                        <img src="<?= template()?>/img/sample/avatar/avatar1.jpg" alt="" class='mr-2 img-fluid rounded-circle border' id='rank3' style="width:4rem;height:4rem">
                    </div>
                    <div class='col-6'>
                        <h3 class='pt-3'>USER 4 </h3>
                    </div>
                    <div class='col-2 '>
                        <h5 class='pt-3'>99 POIN </h5>
                    </div>
                    
                </div>
            </div>
            <div class='col-12 mb-2 card-white p-1'>
                <div class='row'>
                    <div class='col-1 '>
                        <h3 class='pt-3'>5. </h3>
                    </div>
                    <div class='col-3'>
                        <img src="<?= template()?>/img/sample/avatar/avatar1.jpg" alt="" class='mr-2 img-fluid rounded-circle border' id='rank3' style="width:4rem;height:4rem">
                    </div>
                    <div class='col-6'>
                        <h3 class='pt-3'>USER 5 </h3>
                    </div>
                    <div class='col-2 '>
                        <h5 class='pt-3'>99 POIN </h5>
                    </div>
                    
                </div>
            </div>
            <div class='col-12 mb-2 card-white p-1'>
                <div class='row'>
                    <div class='col-1 '>
                        <h3 class='pt-3'>6. </h3>
                    </div>
                    <div class='col-3'>
                        <img src="<?= template()?>/img/sample/avatar/avatar1.jpg" alt="" class='mr-2 img-fluid rounded-circle border' id='rank3' style="width:4rem;height:4rem">
                    </div>
                    <div class='col-6'>
                        <h3 class='pt-3'>USER 6 </h3>
                    </div>
                    <div class='col-2 '>
                        <h5 class='pt-3'>99 POIN </h5>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
</div>
<script>
$(document).ready(function(){
    $('#appCapsule').removeClass('container');
    $('#appCapsule').css('padding-top','0');
    var status = 'today';
    dataRank(status);
    function dataRank(status){
        console.log(status);
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('peringkat/getRank'); ?>",
            data:{status:status},
            dataType:'json',
             beforeSend: function(){
                
                
                $('#loading').css('display','');

               
   
            },
            success: function(resp){
              
                var base = "<?= base_url('asset/foto_siswa/') ?>";
                if(resp.rankone){
                    $('#formRank1').show();
                    $('#rank1').attr('src',resp.rankone.foto);
                    $('#nama1').html(resp.rankone.nama_lengkap);
                    $('#poin1').html(resp.rankone.qp_poin);
                    $('#sekolah1').html(resp.rankone.nama_cabang);



                }else{
                    $('#formRank1').hide();
                    
                }
                if(resp.ranktwo){
                   $('#formRank1').show();
                   $('#formRank2').show();
                  


                    $('#rank2').attr('src',resp.ranktwo.foto);
                    $('#nama2').html(resp.ranktwo.nama_lengkap);
                    $('#poin2').html(resp.ranktwo.qp_poin);
                    $('#sekolah2').html(resp.ranktwo.nama_cabang);




                }else{
                    $('#formRank2').hide();
                   
                }
                if(resp.ranktri){
                    $('#formRank1').show();
                     $('#formRank2').show();
                    $('#formRank3').show();
                    $('#rank3').attr('src',resp.ranktri.foto);
                    $('#nama3').html(resp.ranktri.nama_lengkap);
                    $('#poin3').html(resp.ranktri.qp_poin);
                    $('#sekolah3').html(resp.ranktri.nama_cabang);



                }else{
                    $('#formRank3').hide();
                   
                }

                if(resp.all != ''){
                    $('#rankAll').html(resp.all);
                }else{
                    $('#rankAll').hide();
                }
            },
            complete: function() {
                
                $('#loading').css('display','none');
            },
        });
    }
    $('.btnKet').on('click', function(){
      
      $('.btnKet').removeClass('btn-active');
      status = $(this).attr('data-status');
      $(this).addClass('btn-active');
      dataRank(status);
         
   });
});

</script>