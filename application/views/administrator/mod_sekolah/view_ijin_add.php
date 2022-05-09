  
                    <p class="mb-4"><a href="<?= base_url('administrator/form')?>" class="btn btn-primary">Kembali</a></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Ijin</h6>
    </div>
    <div class="card-body">
           <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
         <form method="post" action="<?= base_url('administrator/form/add')?>" enctype="multipart/form-data">
           <div class="row">
           <?php  if($status == 'all' OR $status == 'dinas' OR $status == 'pusat'){?>
            <div class="col-md-6">
                   <div class="form-group">
                       <label>Sekolah</label>
                      <select name="cabang" class="form-control"  id="cabangPeg">
          
               <?php 
            
                echo "<option disabled selected></option>";

                 $subdomain = $this->model_app->view_where_ordering('subdomain',array('status'=>'sekolah'),'nama_cabang','ASC')->result_array();
            


                 foreach ($subdomain as $sd) {
                    if ($sd['id_sd']==$cabang){
                    echo "<option value='".encode($sd['id_sd'])."' selected>$sd[nama_cabang]</option>";
                     }else{
                     echo "<option value='".encode($sd['id_sd'])."'>$sd[nama_cabang]</option>";
                     }
                 }


                      ?>
                    </select>
                   </div>
                
               </div>
                <?php }else{
                    echo "<input type='hidden' name='cabang' value='".encode($cabang)."'>";
                }?>
            <div class="col-md-12">
                   <div class="form-group">
                       <label>Guru</label>
                       <select name="peg" class="form-control" id="pegCab"> 
                         
                       <?php 
                            if($status == 'sekolah'){
                                $guru = $this->model_app->view_where('guru',array('id_sd'=>$cabang));
                                if($guru->num_rows() > 0){
                                    foreach($guru->result_array() as $gur){
                                        echo "<option value=".encode($gur['id_guru']).">".$gur['nama_guru']."</option>";
                                    }
                                }
                            }

                        ?>
                       </select>
                   </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                    <label>Dari</label>
                    <input type="date" name="dari" class="form-control" required value="<?= date('Y-m-d')?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Sampai</label>
                    <input type="date" name="sampai" class="form-control" required value="<?= date('Y-m-d',strtotime("+1 Days"))?>">
                  </div>
                </div>
                
                 <div class="col-md-12">
                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" required></textarea>
                  </div>
                </div>
                <div class="col-md-12 my-3">
                 
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="Izin" checked>
                      <label class="form-check-label" for="exampleRadios1">
                        Ijin
                      </label>
                     
                  </div>
                   <div class="form-check form-check-inline">
                   <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="Sakit" >
                      <label class="form-check-label" for="exampleRadios2">
                        Sakit
                      </label>

                    </div>
                  </div>
               
                <div class="col-md-12">
                <div class="form-group">
                  <label>Foto</label>
                 
                   
                    <input type="file"  class="form-control"  required accept="image/*"  name='files[]' capture multiple>
                   
                   
                  </div>
                 
               
                </div>
              <div class="col-md-12">
               <div class="form-group">
                   <input type="submit" name="submit" value="Tambah" class="btn btn-primary">
                </div>
                </div>
           </div>
        </form>
    </div>
</div>
<script>
    $(document).on('change','#cabangPeg',function(){
        var sekolah = $(this).val();
        $.ajax({
            type:'POST',
            url:'<?= base_url('administrator/seeGuru1') ?>',
            data:{sekolah:sekolah},
            success:function(resp){
                $('#pegCab').html(resp);
            }
        })
    })
</script>
