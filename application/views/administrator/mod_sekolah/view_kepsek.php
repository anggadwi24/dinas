
  <?php 
 $id = $this->session->id_session;
 $link = 'administrator/kepalasekolah/add';
  $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
  if($c > 0){
  ?>
                    <p class="mb-4">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModals">
                            Tambah Kepala Sekolah
                            </button>
</p>

<?php }?>
<?php 
     $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/kepalasekolah/hapus'")->num_rows();
      $u= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/kepalasekolah/edit'")->num_rows();
?>
                    <!-- DataTales Example -->
                    <?php if($status == 'all' OR $status == 'dinas' OR $status == 'pusat'){ ?>
                     <form action="<?= base_url('administrator/guru')?>" method="post">
                   <div class="row pt-3 pb-3">
                     <div class="col-md-4">
                        <label class="sr-only" for="inlineFormInputGroup">Pulang</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                          <div class="input-group-text">Sekolah</div>
                            </div>
                          <select name="cabang" class="form-control"  id="cabang1">
                              
                                  <?php 
                                    echo "  <option value='all'>Semua</option>";

                                     $subdomain = $this->model_app->view_where_ordering('subdomain',array('status'=>'sekolah'),'nama_cabang','ASC');
                                    
           
                                     foreach ($subdomain->result_array() as $sd) {
                                                if ($sd['id_sd']==$cabang){
                                                echo "<option value='$sd[id_sd]' selected>$sd[nama_cabang]</option>";
                                                 }else{
                                                 echo "<option value='$sd[id_sd]'>$sd[nama_cabang]</option>";
                                                 }
                                          }

                                          ?>
                            </select>
                          </div>
                     </div>
                     
                    
                     
                     
                 
                     <div class="col-md-2">
                        <input type="submit" name="filter" value="Filter" class="btn btn-primary btn-xs">
                     </div>
                   </div>
                   </form>
                   <?php }else{
                      echo "<input type='hidden' name='cabang' value='".$cabang."'>";
                     }?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Kepala Sekolah</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No </th>
                                            <th>Nama Kepala Sekolah</th>
                                            <th>Email</th>
                                            <th>No HP</th>
                                            
                                            <th>Sekolah</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $no = 1; foreach($record->result_array() as $row){
                                              $sekolah = $this->model_app->view_where('subdomain',array('id_sd'=>$row['kepsek_id_sd']))->row_array();
                                            ?>

                                            <tr>
                                                <td><?=$no;?></td>
                                                 <td><?= ucfirst($row['kepsek_name']);?></td>
                                                 <td><?= $row['kepsek_email'];?></td>
                                                 <td> <?= $row['kepsek_phone'];?></td>
                                                
                                                 <td> <?= $sekolah['nama_cabang'];?> </td>


                                               
                                                 
                                                 <td>
                                                    <?php if($u > 0){?>
                                               
                                                <button class="btn btn-warning btnEdit" data-id='<?= encode($row['kepsek_id'])?>' >
                                                    <span class="fa fa-edit " ></span>
                                                </button>
                                                <?php }?>
                                                <?php if($d > 0){?>
                                                <a href="<?= base_url('administrator/kepalasekolah/hapus?id=').$this->encrypt->encode($row['kepsek_id'],keys())?>" class="mr-1 btn btn-danger"><span class="fa fa-trash " ></span></a>
                                                <?php }?>

                                                 </td>
                                            </tr>
                                        <?php $no++; }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
<div class="modal fade" id="addModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Keapala Sekolah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formAdd">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Sekolah</label>
            <?php if($status == 'all' OR $status == 'dinas' OR $status == 'pusat'){ ?>
                  
                          <select name="sekolah" class="form-control"  id="cabang1">
                              
                                  <?php 
                                

                                     $subdomain = $this->model_app->view_where_ordering('subdomain',array('status'=>'sekolah'),'nama_cabang','ASC');
                                    
           
                                     foreach ($subdomain->result_array() as $sd) {
                                                if ($sd['id_sd']==$cabang){
                                                echo "<option value='".encode($sd[id_sd])."' selected>$sd[nama_cabang]</option>";
                                                 }else{
                                                 echo "<option value='".encode($sd[id_sd])."'>$sd[nama_cabang]</option>";
                                                 }
                                          }

                                          ?>
                            </select>
                    
                     
                    
                     
                     
                 
                  
                   <?php }else{
                      echo "<input type='hidden' name='sekolah' value='".encode($cabang)."'>";
                     }?>

        </div>
        <div class="form-group">
            <label for="">Nama Kepala Sekolah</label>
            <input type="text" class="form-control" name="kepsek_name" required>
        </div>
        <div class="form-group">
            <label for="">Email Kepala Sekolah</label>
            <input type="email" class="form-control" name="kepsek_email" required>
        </div>
        <div class="form-group">
            <label for="">Phone Kepala Sekolah</label>
            <input type="number" class="form-control" name="kepsek_phone" required>
        </div>
        <div class="form-group">
            <label for="">Password Kepala Sekolah</label>
            <input type="password" class="form-control" name="kepsek_password" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="editModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Keapala Sekolah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formEdit">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Sekolah</label>
            <?php if($status == 'all' OR $status == 'dinas' OR $status == 'pusat'){ ?>
                  
                          <select name="sekolah" class="form-control"  id="cabang1">
                              
                                  <?php 
                                

                                     $subdomain = $this->model_app->view_where_ordering('subdomain',array('status'=>'sekolah'),'nama_cabang','ASC');
                                    
           
                                     foreach ($subdomain->result_array() as $sd) {
                                                if ($sd['id_sd']==$cabang){
                                                echo "<option value='".encode($sd[id_sd])."' selected>$sd[nama_cabang]</option>";
                                                 }else{
                                                 echo "<option value='".encode($sd[id_sd])."'>$sd[nama_cabang]</option>";
                                                 }
                                          }

                                          ?>
                            </select>
                    
                     
                    
                     
                     
                 
                  
                   <?php }else{
                      echo "<input type='hidden' name='sekolah' value='".encode($cabang)."'>";
                     }?>

        </div>
        <div class="form-group">
            <label for="">Nama Kepala Sekolah</label>
            <input type="text" class="form-control" name="kepsek_name" id="name" required>
        </div>
        <div class="form-group">
            <label for="">Email Kepala Sekolah</label>
            <input type="email" class="form-control" name="kepsek_email" id="email" required>
        </div>
        <div class="form-group">
            <label for="">Phone Kepala Sekolah</label>
            <input type="number" class="form-control" name="kepsek_phone" id="phone" required>
        </div>
        <div class="form-group">
            <label for="">Password Kepala Sekolah</label>
            <input type="password" class="form-control" name="kepsek_password" >
        </div>
      </div>
      <input type="hidden" id="id" name="id">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
    $(document).on('click','.btnEdit',function(){
        console.log('asd');
        var id = $(this).attr('data-id');
        $.ajax({
            type:'POST',
            url:'<?= base_url('administrator/kepalasekolah/detail')?>',
            data:{id:id},
            dataType:'json',
            success:function(resp){
                if(resp.status == true){
                    $('#editModals').modal('show');
                    $('#name').val(resp.arr.kepsek_name);
                    $('#email').val(resp.arr.kepsek_email);
                    $('#phone').val(resp.arr.kepsek_phone);
                    $('#id').val(resp.arr.id);
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
    $("#formAdd").on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        // formData.append('id', $('#id').val());
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/kepalasekolah/add') ?>",

           
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formAdd input').prop('disabled',true);
                $('#formAdd select').prop('disabled',true);

                $('#formAdd button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formAdd button').prop('disabled',true);
   
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
               
              if(resp == true){
                
              
                    location.reload();
              }else{
                swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
              }
               
            }, 
             complete: function() {
               $('#formAdd input').prop('disabled',false);
                $('#formAdd select').prop('disabled',false);

               $('#formAdd button').html('Simpan');
                $('#formAdd button').prop('disabled',false);
            },
        });
    });
    $("#formEdit").on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        // formData.append('id', $('#id').val());
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/kepalasekolah/edit') ?>",

           
            data: formData,
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
                
              
                    location.reload();
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
</script>