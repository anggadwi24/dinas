  
                    <p class="mb-4"><a href="<?= base_url('administrator/pengawas')?>" class="btn btn-primary">Kembali</a></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Pengawas</h6>
                        </div>
                        <div class="card-body">
                               <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
                            <form action="<?= base_url('administrator/pengawas/edit')?>" method="post" enctype='multipart/form-data'>
                               <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>NIP</label>
                                           <input type="number" name="nip" class="form-control" value = "<?= $row[nip]?>" required>
                                       </div>
                                   </div>
                                   <div class="col-md-8">
                                       <div class="form-group">
                                           <label>Nama Lengkap</label>
                                           <input type="text" name="nama_lengkap" class="form-control" value = "<?= $row[nama_lengkap]?>" required>
                                       </div>
                                   </div>
                                  <div class="col-md-8">
                                       <div class="form-group">
                                           <label>Jabatan</label>
                                          <select name="jabatan" class="form-control" required id="jabatan">
                                              <option>-- Pilih Jabatan  --</option>
                                              <option value="admin" <?php if($row['jabatan']=='admin'){echo "selected";}?>>Admin</option>
                                              <option value="pengawas" <?php if($row['jabatan']=='pengawas'){echo "selected";}?>>Pengawas</option>
                                              
                                          </select>
                                       </div>
                                   </div>
                                     <div class="col-12">
                                      <label >Dinas</label>
                        
                                      <select name="id_sd" class="form-control"  id="cabang2">
                                          
                                               <?php 
                                                if($status == 'all' OR $status == 'dinas' OR $status == 'pusat'){
                                                

                                                 $subdomain = $this->model_app->view_where_ordering('subdomain',array('status'=>'dinas'),'nama_cabang','ASC')->result_array();
                                                }
                    
                       
                                                 foreach ($subdomain as $sd) {
                                                            if ($sd['id_sd']==$row['id_sd']){
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
                                              <?php 
                                              $bag = $this->model_app->view_where('bagian',array('id_sd'=>$row['id_sd']));
                                              foreach($bag->result_array() as $div){?>
                                                  <?php if($div[id_bagian] == $row[bagian]){?>
                                                     <option value="<?= $div[id_bagian]?>" selected><?= ucfirst($div['nama_bagian'])?></option>
                                                    <?php }else{?>
                                                    <option value="<?= $div[id_bagian]?>"><?= ucfirst($div['nama_bagian'])?></option>
                                                     <?php }?>
                                              <?php }?>
                                          </select>
                                       </div>
                                   </div>
                                     <div class="col-md-6" id="selSubBag">
                                       <div class="form-group">
                                           <label>Sub Bagian</label>
                                          <select name="sub_bagian" class="form-control"  id="sub">
                                              <option>-- Pilih Sub Bagian --</option>
                                               <?php   $sub = $this->model_app->view_where_ordering('sub_bagian',array('id_bagian'=>$row['bagian']),'id_sub_bagian','DESC');
                                                foreach ($sub->result_array() as $s) {
                                                if ($row['sub_bagian']==$s['id_sub_bagian']){
                                                echo "<option value='$s[id_sub_bagian]' selected>$s[nama_sub_bagian]</option>";
                                                 }else{
                                                 echo "<option value='$s[id_sub_bagian]'>$s[nama_sub_bagian]</option>";
                                                 }
                                                }?> 
                                          </select>
                                       </div>
                                   </div>
                                  <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Username</label>
                                           <input type="text" name="username" class="form-control"  value="<?= $row[username]?>" >
                                       </div>
                                   </div>
                                     <div class="col-md-12">
                                       <div class="form-group">
                                           <label>No HP</label>
                                           <input type="number" name="nohp" class="form-control" required value="<?= $row['no_hp']?>">
                                       </div>
                                   </div>
                                 
                                    <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Password</label>
                                           <input type="password" name="password" class="form-control" >
                                       </div>
                                   </div>
                                  
                                   
                                 

                                   <div class="col-md-12">
                                       <input type="submit" name="submit" value="UBAH" class="btn btn-primary">
                                       <input type="hidden" name="id" value="<?= $row[id_pengawas]?>">
                                        <input type="hidden" name="pwd" value="<?= $row[password]?>">
                                   </div>
                               </div>
                            </form>
                        </div>
                    </div>
<script type="text/javascript">
     $(document).ready(function(){

      <?php if($row['jabatan']=='pengawas'){?>
         $("#selBag").show();
            $("#selSubBag").show();
      <?php }else{?>
       $("#selBag").hide();
        $("#selSubBag").hide();
      <?php }?>
        $('#jabatan').change(function(){
            if(this.value === 'admin')
            {
             $("#selBag").hide();
            $("#selSubBag").hide();
            }else{
              $("#selBag").show();
            $("#selSubBag").show();
            }
          })
        })
</script>