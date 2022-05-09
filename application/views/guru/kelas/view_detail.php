<style>
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #bd554e;
    }
    .nav-link{
        color: white;
    }
    .nav-pills .nav-link {
        border-radius:0px;
    }
    
</style>
<section class="about" style="padding-top:0">
    <div class="container">
        <div class="row">
            <div class="col-12 " style="background: #a93734;">
                <ul class="nav nav-pills " id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="meeting" data-toggle="pill" href="#pMeeting" role="tab" aria-controls="pMeeting" aria-selected="true">Meeting</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="materi" data-toggle="pill" href="#pMateri" role="tab" aria-controls="pMateri" aria-selected="false">Materi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="siswa" data-toggle="pill" href="#pSiswa" role="tab" aria-controls="pSiswa" aria-selected="false">Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="setting" data-toggle="pill" href="#pSetting" role="tab" aria-controls="pSetting" aria-selected="false">Setting</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 mt-2">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pMeeting" role="tabpanel" aria-labelledby="meeting">...</div>
                    <div class="tab-pane fade" id="pMateri" role="tabpanel" aria-labelledby="materi">...</div>
                    <div class="tab-pane fade" id="pSiswa" role="tabpanel" aria-labelledby="siswa">...</div>
                    <div class="tab-pane fade" id="pSetting" role="tabpanel" aria-labelledby="setting">...</div>

                </div>
            </div>
        </div>
    </div>
</section>
<div id="modal"></div>
<script>
    $(document).on('click','.meetDetail',function() {
        window.location = $(this).attr('data-href');
    })
    $(document).on('submit','#formMeeting',function(e){


        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('guru/storeMeeting') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formMeeting input').prop('disabled',true);
                $('#formMeeting select').prop('disabled',true);
               

                $('#formMeeting button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formMeeting button').prop('disabled',true);
   
            },
             error:function(){
             
                 swal({

                  title: '404',
                  text: 'Something error!',
                   customClass: 'swal-wide',
                   type:'error',
                  
                })
               
            },
          
            success: function(resp){
               
              if(resp.status == true){
                meeting();
                $('#modalMeeting').modal('hide');
               
                
               
              }else{
                swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
              }
               
            }, 
             complete: function() {
                
               $('#formMeeting input').prop('disabled',false);
               $('#formMeeting select').prop('disabled',false);
                

               $('#formMeeting button').html('Buat');
                $('#formMeeting button').prop('disabled',false);
            },
        });
    });
    $(document).on('submit','#formSiswa',function(e){


    e.preventDefault();
    $.ajax({

        type: 'POST',
        url:"<?= base_url('guru/storeSiswa') ?>",


        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType :'json',


        beforeSend: function(){
            
            $('#formSiswa input').prop('disabled',true);
           
        

            $('#formSiswa button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
            $('#formSiswa button').prop('disabled',true);

        },
        error:function(){
        
            swal({

            title: '404',
            text: 'Something error!',
            customClass: 'swal-wide',
            type:'error',
            
            })
        
        },

        success: function(resp){
        
        if(resp.status == true){
            siswa();
            
            
            
        
        }else{
            swal({
                title: 'Gagal',
                text: resp.msg,
                type: 'error',
                
                })
        }
        
        }, 
        complete: function() {
            
        $('#formSiswa input').prop('disabled',false);
        
            

        $('#formSiswa button').html('Undang');
            $('#formSiswa button').prop('disabled',false);
        },
    });
    });
    $(document).on('submit','#formMateri',function(e){


        e.preventDefault();
        $.ajax({
        
            type: 'POST',
            url:"<?= base_url('guru/storeMateri') ?>",

        
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
        
        
            beforeSend: function(){
                
                $('#formMateri input').prop('disabled',true);
                $('#formMateri select').prop('disabled',true);
            

                $('#formMateri button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formMateri button').prop('disabled',true);

            },
            error:function(){
            
                swal({

                title: '404',
                text: 'Something error!',
                customClass: 'swal-wide',
                type:'error',
                
                })
            
            },
        
            success: function(resp){
            
            if(resp.status == true){
                materi();
                $('#modalMateri').modal('hide');
                
                
            
            }else{
                swal({
                    title: 'Gagal',
                    text: resp.msg,
                    type: 'error',
                    
                    })
            }
            
            }, 
            complete: function() {
                
            $('#formMateri input').prop('disabled',false);
            $('#formMateri select').prop('disabled',false);
                

            $('#formMateri button').html('Simpan');
                $('#formMateri button').prop('disabled',false);
            },
        });
        });
        $(document).on('submit','#formEdit',function(e){


e.preventDefault();
$.ajax({

    type: 'POST',
    url:"<?= base_url('guru/updateKelas') ?>",


    data: new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    dataType :'json',


    beforeSend: function(){
        
        $('#formEdit input').prop('disabled',true);
        $('#formEdit select').prop('disabled',true);
    

        $('#formEdit button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
        $('#formEdit button').prop('disabled',true);

    },
    error:function(){
    
        swal({

        title: '404',
        text: 'Something error!',
        customClass: 'swal-wide',
        type:'error',
        
        })
    
    },

    success: function(resp){
    
    if(resp.status == true){
        swal({
            title: 'Successs',
            text: resp.msg,
            type: 'success',
            
            }).then(function() {
                   location.reload();
                });
        
    
    }else{
        swal({
            title: 'Gagal',
            text: resp.msg,
            type: 'error',
            
            })
    }
    
    }, 
    complete: function() {
        
    $('#formEdit input').prop('disabled',false);
    $('#formEdit select').prop('disabled',false);
        

    $('#formEdit button').html('Simpan');
        $('#formEdit button').prop('disabled',false);
    },
});
});
$(document).on('click','.removeKelas',function(){
        var id = $(this).attr('data-id');
        var href ='<?= base_url('guru/removeKelas')?>';
        swal({
            title: 'Apakah anda yakin?',
            text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    type:'POST',
                    url:href,
                    data:{id:id},
                    dataType:'JSON',
                    success:function(resp){
                        if(resp.status == true){
                            swal({
                                title: 'Berhasil',
                                text: resp.msg,
                                type: 'success',
                                timer:2000
                            }).then(function() {
                                location.reload();
                             });
                            
                        }else{
                            swal({
                                title: 'Gagal',
                                text: resp.msg,
                                type: 'error',
                                timer:2000
                            })
                        }
                    }
                })
            }
          })
    })
    $(document).on('click','#meeting',function(){
       meeting();
    });
    $(document).on('click','#materi',function(){
       materi();
    });
    $(document).on('click','#siswa',function(){
       siswa();
    });
    $(document).on('click','#setting',function(){
       setting();
    });
    $(document).on('click','.btnAdd',function(){
        var type = $(this).attr('data-type');
        var id = '<?= encode($row['rk_id']) ?>';
        $.ajax({
            type:'POST',
            url:'<?= base_url('guru/modal') ?>',
            data:{type:type,id:id},
            dataType:'json',
            success:function(resp){
                if(resp.status == true){
                    $('#modal').html(resp.output);
                    if(type == 'meeting'){
                        $('#modalMeeting').modal('show');
                    }else if(type == 'materi'){
                        $('#modalMateri').modal('show');
                    }else if(type == 'edit'){
                        $('#modalEdit').modal('show');
                        
                        
                    }
                }else{
                    swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
                }
               
            }



        })
    })
    $(document).on('click','.approved',function(){
        var id = $(this).attr('data-id');
        var acc = $(this).attr('data-acc');
        $.ajax({
            url: "<?= base_url('guru/acceptSiswa') ?>",
            type: "POST",
            data: {id:id,acc:acc},
            dataType:'json',
            success: function(resp) {
                if(resp.status == true){
                    siswa();
                    swal({
                      title: 'Success',
                      text: resp.msg,
                      type: 'success',
                     
                    })

                }else{
                    swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
                }
               
            }
        });
    })
    $(document).on('click','#btnSiswa',function(){
        
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $('#frmSiswa').html('');
        }else{
            $(this).addClass('active');
            $.ajax({
                url: "<?= base_url('guru/formSiswa') ?>",
                type: "POST",
                data: {id: "<?= encode($row['rk_id']) ?>"},
                dataType:'json',
                success: function(resp) {
                    if(resp.status == true){
                        $('#frmSiswa').html(resp.output);
                        $('#siswaSel').select2();
                    }
                
                }
            });
        }
        
    })
    $(document).on('click','.downloadMateri',function(){
      
        var base = '<?= base_url('asset/upload_kelas/')?>'+$(this).attr('data-file');
      
            var a = document.createElement('a');
            
            a.href = base;
            a.download = $(this).attr('data-file');
            document.body.append(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(base);
     
    })
    meeting();
    function meeting(){
        $.ajax({
            url: "<?= base_url('guru/meetingKelas') ?>",
            type: "POST",
            data: {id: "<?= encode($row['rk_id']) ?>"},
            dataType:'json',
            success: function(resp) {
                if(resp.status == true){
                    $('#pMeeting').html(resp.output);
                }
               
            }
        });
    }
    function materi(){
        $.ajax({
            url: "<?= base_url('guru/materiKelas') ?>",
            type: "POST",
            data: {id: "<?= encode($row['rk_id']) ?>"},
            dataType:'json',
            success: function(resp) {
                if(resp.status == true){
                    $('#pMateri').html(resp.output);
                }
               
            }
        });
    }
    function siswa(){
        $.ajax({
            url: "<?= base_url('guru/siswaKelas') ?>",
            type: "POST",
            data: {id: "<?= encode($row['rk_id']) ?>"},
            dataType:'json',
            success: function(resp) {
                if(resp.status == true){
                    $('#pSiswa').html(resp.output);
                }
               
            }
        });
    }
    function setting(){
        $.ajax({
            url: "<?= base_url('guru/settingKelas') ?>",
            type: "POST",
            data: {id: "<?= encode($row['rk_id']) ?>"},
            dataType:'json',
            success: function(resp) {
                if(resp.status == true){
                    $('#pSetting').html(resp.output);
                }
               
            }
        });
    }
</script>