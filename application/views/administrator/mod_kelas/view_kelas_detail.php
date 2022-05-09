<?php 
    $mapel = $this->model_app->view_where('mata_pelajaran',array('mapel_id'=>$row['rk_mapel']))->row_array();
    $sekolah = $this->model_app->view_where('subdomain',array('id_sd'=>$row['rk_id_sd']))->row_array();
    $id = $this->session->id_session;
 $link = 'administrator/createMeeting';
    $guru = $this->model_app->view_where('guru',array('id_guru'=>$row['rk_id_guru']))->row_array();
  $m =$this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/dataMateri'")->num_rows(); 
  $cM =$this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/createMateri'")->num_rows(); 

  $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
  $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/deleteMeeting'")->num_rows();


?>
<input type="hidden" name="id" id="idrk" value="<?= encode($row['rk_id'])?>">
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= strtoupper($sekolah['nama_cabang'])?></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mx-auto text-center">
                        <img src="<?= $row['rk_icon'] ?>" class="img-fluid rounded-circle" style="height:100px;width:100px;" alt="">
                    </div>
                    <div class="col-md-12 form-group mt-3 text-center">
                        <h5 title="Judul Kelas" class="mb-0 text-center"><?= $row['rk_title'] ?></h5>
                        <p title="Deskripsi Kelas"><?= $row['rk_desc'] ?></p>
                    </div>
                    <div class="col-md-12 form-group">
                        <h5 class="text-center" title="Mapel & Kelas"><?= $mapel['mapel']?> / <?= $row['rk_kelas'] ?></h5>
                    </div>
                    <div class="col-md-12 form-group">
                    <h5 title="Guru Kelas" class="mb-0 text-center"><?= $guru['nama_guru'] ?></h5>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title">Kelas Meeting</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php 
                        if($c > 0){

                        
                    ?>
                    <div class="col-12 mt-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                                    Buat Meeting
                            </button>
                    </div>
                    <?php }?>
                    <div class="col-12 mt-2" id="meeting">
                        
                    </div>
                </div>
            </div>
        </div>
        <?php if($m > 0){?>
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title">Kelas Materi</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php 
                        if($cM > 0){

                        
                    ?>
                    <div class="col-12 mt-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createMateri">
                                    Upload Materi
                            </button>
                    </div>
                    <?php }?>
                    <div class="col-12 mt-2" id="materi">
                        
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>
<div class="modal fade" id="createMateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Materi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formActMateri">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="">Title</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            <div class="col-md-12 form-group">
                <label for="">Deskripsi</label>
                <input type="text" name="deskripsi" class="form-control" >
            </div>
            <div class="col-md-12 form-group">
                <label for="">Materi</label>
                <input type="file" class="form-control" name="file" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf, image/*" required>
            </div>
            
            <input type="hidden" name="id" id="id" value="<?= encode($row['rk_id'])?>">
        </div>
      </div>
      <div class="modal-footer">
       
        <button  class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="updateMateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Materi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formUptMateri">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="">Title</label>
                <input type="text" name="judul" id="titleMateri" class="form-control" required>
            </div>
            <div class="col-md-12 form-group">
                <label for="">Deskripsi</label>
                <input type="text" name="deskripsi" id="descMateri" class="form-control" >
            </div>
            <div class="col-md-12 form-group">
                <label for="">Materi</label>
                <input type="file" class="form-control" name="file" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf, image/*" >
            </div>
            
            <input type="hidden" name="id" id="id" value="<?= encode($row['rk_id'])?>">
            <input type="hidden" name="rke" id="rke" >

        </div>
      </div>
      <div class="modal-footer">
       
        <button  class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buat Meeting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formCreate">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="">Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            <div class="col-md-12 form-group">
                <label for="">Deskripsi</label>
                <input type="text" name="deskripsi" class="form-control" >
            </div>
            <div class="col-md-4 form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control" name="date" value="<?= date('Y-m-d')?>" required>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Start</label>
                <input type="time" class="form-control" name="start" value="<?= date('H:i',strtotime('07:00'))?>" required>
            </div>
            <div class="col-md-4 form-group">
                <label for="">End</label>
                <input type="time" class="form-control" name="end" value="<?= date('H:i',strtotime('10:00'))?>" required>
            </div>
            <div class="col-md-12 form-group">
                <label for="">URL</label>
                <input type="text" name="url"  class="form-control" >
            </div>
            <input type="hidden" name="id" id="id" value="<?= encode($row['rk_id'])?>">
        </div>
      </div>
      <div class="modal-footer">
       
        <button  class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Meeting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formUpdate">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="">Judul</label>
                <input type="text" name="judul" class="form-control" id="judul" required>
            </div>
            <div class="col-md-12 form-group">
                <label for="">Deskripsi</label>
                <input type="text" name="deskripsi" id="deskripsi" class="form-control" >
            </div>
            <div class="col-md-4 form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control" name="date" value="<?= date('Y-m-d')?>" id="date" required>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Start</label>
                <input type="time" class="form-control" name="start" value="<?= date('H:i',strtotime('07:00'))?>" id="start" required>
            </div>
            <div class="col-md-4 form-group">
                <label for="">End</label>
                <input type="time" class="form-control" name="end" value="<?= date('H:i',strtotime('10:00'))?>"  id="end" required>
            </div>
            <div class="col-md-12 form-group">
                <label for="">URL</label>
                <input type="text" name="url" id="url" class="form-control" >
            </div>
            
            <input type="hidden" name="id" id="id" value="<?= encode($row['rk_id'])?>">
            <input type="hidden" name="meet_id" id="meet_id">
        </div>
      </div>
      <div class="modal-footer">
       
        <button  class="btn btn-primary" name="submit">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
    dataMeeting();
    function dataMeeting(){
        var id = $('#id').val();
      
        $.ajax({
            url : "<?= base_url('administrator/dataMeeting')?>",
            type : "POST",
            data : {id:$('#idrk').val()},
            dataType : "JSON",
            success : function(resp){
                if(resp.status == true){
                    $('#meeting').html(resp.output);
                    $('#tableData').DataTable({
                        responsive: true
                    });
                }
            }
        })
        
    }
    $(document).on('click','.delete',function(){
        var id = $(this).attr('data-id');	
        swal({
            title: 'Anda akan menghapus meeting ini',
            text: 'apakah anda yakin?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
          }).then(result => {
            $.ajax({
                url : "<?= base_url('administrator/deleteMeeting')?>",
                type : "POST",
                data : {id:id},
                dataType : "JSON",
                success : function(resp){
                    if(resp.status == true){
                        dataMeeting();
                    }else{
                        swal({
                            title: 'Peringatan',
                            text: resp.msg,
                            type: 'error',
                            
                        })
                    }
                }
            })
          });
       
    });
    $(document).on('click','.deleteMateri',function(){
        var id = $(this).attr('data-id');	
        swal({
            title: 'Anda akan menghapus materi ini',
            text: 'apakah anda yakin?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
          }).then(result => {
            $.ajax({
                url : "<?= base_url('administrator/deleteMateri')?>",
                type : "POST",
                data : {id:id},
                dataType : "JSON",
                success : function(resp){
                    if(resp.status == true){
                        dataMateri();
                    }else{
                        swal({
                            title: 'Peringatan',
                            text: resp.msg,
                            type: 'error',
                            
                        })
                    }
                }
            })
          });
       
    });
    $(document).on('click','.editMateri',function(){
        var id = $(this).attr('data-id');	
       
        $.ajax({
            url : "<?= base_url('administrator/detailMateri')?>",
            type : "POST",
            data : {id:id},
            dataType : "JSON",
            success : function(resp){
                if(resp.status == true){
                    $('#titleMateri').val(resp.arr.title);
                    $('#descMateri').val(resp.arr.desc);
                    $('#rke').val(resp.arr.id);

                    $('#updateMateri').modal('show');
                }else{
                    swal({
                      title: 'Peringatan',
                      text: resp.msg,
                      type: 'error',
                     
                    })
                }
            }
        })
    })
    $(document).on('click','.edit',function(){
        var id = $(this).attr('data-id');	
       
        $.ajax({
            url : "<?= base_url('administrator/editMeeting')?>",
            type : "POST",
            data : {id:id},
            dataType : "JSON",
            success : function(resp){
                if(resp.status == true){
                    $('#judul').val(resp.data.rkm_title);
                    $('#deskripsi').val(resp.data.rkm_desc);
                    $('#date').val(resp.data.rkm_date);
                    $('#start').val(resp.data.rkm_start);
                    $('#end').val(resp.data.rkm_end);
                    $('#url').val(resp.data.rkm_url);
                    
                    $('#meet_id').val(resp.data.rkm_id);
                    $('#editModal').modal('show');
                }else{
                    swal({
                      title: 'Peringatan',
                      text: resp.msg,
                      type: 'error',
                     
                    })
                }
            }
        })
    })
     $("#formUpdate").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/updateMeeting') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formUpdate input').prop('disabled',true);
                $('select').prop('disabled',true);

                $('#formUpdate button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formUpdate button').prop('disabled',true);
   
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
                    title:'Berhasil',
                    text:resp.msg,
                    type:'success',
                })
                $('#editModal').modal('hide');
                dataMeeting();
              }else{
                swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
              }
               
            }, 
             complete: function() {
               $('#formUpdate input').prop('disabled',false);
                $('#formUpdate select').prop('disabled',false);

               $('#formUpdate button').html('Simpan');
                $('#formUpdate button').prop('disabled',false);
            },
        });
    });
    <?php 
        if($c > 0 ){
    ?>
    $("#formCreate").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/createMeeting') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formCreate input').prop('disabled',true);
                $('select').prop('disabled',true);

                $('#formCreate button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formCreate button').prop('disabled',true);
   
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
                
                // $('#formCreate input[type=text]').val('');
                // $('#formCreate textarea').val('');
                swal({
                    title:'Berhasil',
                    text:resp.msg,
                    type:'success',
                })
                $('#createModal').modal('hide');
                dataMeeting();
              }else{
                swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
              }
               
            }, 
             complete: function() {
               $('#formCreate input').prop('disabled',false);
                $('#formCreate select').prop('disabled',false);

               $('#formCreate button').html('Simpan');
                $('#formCreate button').prop('disabled',false);
            },
        });
    });
    <?php
        }
    ?>
    <?php if($m > 0){ ?>
        dataMateri();
        function dataMateri(){
            var id = $('#id').val();
        
            $.ajax({
                url : "<?= base_url('administrator/dataMateri')?>",
                type : "POST",
                data : {id:$('#idrk').val()},
                dataType : "JSON",
                success : function(resp){
                    if(resp.status == true){
                        $('#materi').html(resp.output);
                        $('#tableData1').DataTable({
                            responsive: true
                        });
                    }
                }
            })
            
        }
    <?php }?>
    <?php 
        if($cM > 0 ){
    ?>
    $("#formActMateri").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/createMateri') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formActMateri input').prop('disabled',true);
                $('select').prop('disabled',true);

                $('#formActMateri button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formActMateri button').prop('disabled',true);
   
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
                    title:'Berhasil',
                    text:resp.msg,
                    type:'success',
                })
                $('#createMateri').modal('hide');
                dataMateri();
              }else{
                swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
              }
               
            }, 
             complete: function() {
               $('#formActMateri input').prop('disabled',false);
                $('#formActMateri select').prop('disabled',false);

               $('#formActMateri button').html('Simpan');
                $('#formActMateri button').prop('disabled',false);
            },
        });
    });
    $("#formUptMateri").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/updateMateri') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formUptMateri input').prop('disabled',true);
                $('select').prop('disabled',true);

                $('#formUptMateri button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formUptMateri button').prop('disabled',true);
   
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
                    title:'Berhasil',
                    text:resp.msg,
                    type:'success',
                })
                $('#updateMateri').modal('hide');
                dataMateri();
              }else{
                swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
              }
               
            }, 
             complete: function() {
               $('#formUptMateri input').prop('disabled',false);
                $('#formUptMateri select').prop('disabled',false);

               $('#formUptMateri button').html('Simpan');
                $('#formActMateri button').prop('disabled',false);
            },
        });
    });
    <?php
        }
    ?>
</script>