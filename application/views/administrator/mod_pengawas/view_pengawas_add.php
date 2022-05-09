  
                    <p class="mb-4"><a href="<?= base_url('administrator/pengawas')?>" class="btn btn-primary">Kembali</a></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Pengawas</h6>
                        </div>
                        <div class="card-body">
                               <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
                            <form action="<?= base_url('administrator/pengawas/add')?>" method="post" enctype='multipart/form-data'>
                               <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>NIP</label>
                                           <input type="number" name="nip" class="form-control" required>
                                       </div>
                                   </div>
                                   <div class="col-md-8">
                                       <div class="form-group">
                                           <label>Nama Lengkap</label>
                                           <input type="text" name="nama_lengkap" class="form-control" required>
                                       </div>
                                   </div>
                                  <div class="col-md-8">
                                       <div class="form-group">
                                           <label>Jabatan</label>
                                          <select name="jabatan" class="form-control" required id="jabatan">
                                              <option>-- Pilih Jabatan  --</option>
                                              <option value="admin">Admin</option>
                                              <option value="pengawas">Pengawas</option>
                                              
                                          </select>
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                      <label >Dinas</label>
                        
                                      <select name="id_sd" class="form-control"  id="cabang" required>
                                          
                                               <?php 
                                                  if($status == 'all' OR $status == 'dinas' OR $status == 'pusat'){
                                   

                                     $subdomain = $this->model_app->view_where_ordering('subdomain',array('status'=>'dinas'),'nama_cabang','ASC')->result_array();
                                    }
                       
                                                 foreach ($subdomain as $sd) {
                                                            if ($sd['id_sd']==$cabang){
                                                            echo "<option value='$sd[id_sd]' selected>$sd[nama_cabang]</option>";
                                                             }else{
                                                             echo "<option value='$sd[id_sd]'>$sd[nama_cabang]</option>";
                                                             }
                                                      }

                                                      ?>
                                        </select>
                                    
                                 </div>
                                    <div class="col-md-6" id="selBag">
                                       <div class="form-group" >
                                           <label>Bagian</label>
                                           <select name="bagian" class="form-control" required id="bagian">
                                              <option>-- Pilih Bagian --</option>
                                              <?php foreach($bagian->result_array() as $div){?>
                                                    <option value="<?= $div[id_bagian]?>"><?= ucfirst($div['nama_bagian'])?></option>
                                              <?php }?>
                                          </select>
                                       </div>
                                   </div>
                                     <div class="col-md-6" id="selSubBag">
                                       <div class="form-group">
                                           <label>Sub Bagian</label>
                                          <select name="sub_bagian" class="form-control"  id="sub">
                                              <option>-- Pilih Sub Bagian --</option>
                                              
                                          </select>
                                       </div>
                                   </div>
                                  <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Username</label>
                                           <input type="text" name="username" class="form-control" >
                                       </div>
                                   </div>
                                  
                                    <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Password</label>
                                           <input type="password" name="password" class="form-control" required>
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label>No HP</label>
                                           <input type="number" name="nohp" class="form-control" required>
                                       </div>
                                   </div>
                                   
                                  
                                   
                                 

                                   <div class="col-md-12 mt-5">
                                       <input type="submit" name="submit" value="TAMBAH" class="btn btn-primary w-100">
                                   </div>
                               </div>
                            </form>
                        </div>
                    </div>
<script type="text/javascript">
     $(document).ready(function(){
       $("#selBag").hide();
        $("#selSubBag").hide();
        $('#jabatan').change(function(){
            if(this.value === 'admin')
            {
             $("#selBag").css('display','none');
            $("#selSubBag").css('display','none');
            }else{
              $("#selBag").css('display','block');
            $("#selSubBag").css('display','block');
            }
          })
        })
</script>