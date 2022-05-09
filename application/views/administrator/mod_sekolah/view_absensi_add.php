  
                    <p class="mb-4"><a href="<?= base_url('administrator/absen')?>" class="btn btn-primary">Kembali</a></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Absen</h6>
    </div>
    <div class="card-body">
           <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
         <form method="post" action="<?= base_url('administrator/absen/add')?>" enctype="multipart/form-data">
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
                    echo "<option value='".encode($sd[id_sd])."' selected>$sd[nama_cabang]</option>";
                     }else{
                     echo "<option value='".encode($sd[id_sd])."'>$sd[nama_cabang]</option>";
                     }
                 }


                      ?>
                    </select>
                   </div>
                
               </div>
                <?php }else{
                    echo "<input type='hidden' name='cabang' value='".encode($cabang)."'>";
                }?>
               <div class="col-md-6 form-group">
                   <label for="">Tanggal</label>
                   <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d')?>" disabled>
               </div>
            <div class="col-md-12">
                   <div class="form-group">
                       <label>Pegawai</label>
                       <select name="peg" class="form-control selectpicker" data-live-search="true" id="pegCab">
                           <option selected disabled></option>
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
                       <label>Absen Masuk</label>
                       <input type="time" name="absen_masuk" class="form-control" required value="00:00">
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="form-group">
                       <label>Absen Keluar</label>
                       <input type="time" name="absen_keluar" class="form-control" required value="00:00">
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="form-group">
                       <label>Foto Absen Masuk</label>
                       <input type="file" name="foto_in"  class="form-control" >
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="form-group">
                       <label>Foto Absen Keluar</label>
                       <input type="file" name="foto_out" class="form-control" >
                   </div>
               </div>
                <div class="col-md-6">
                   <div class="form-group">
                       <label>Keterangan</label>
                      <select name="ket" class="form-control">
                        <option value="absen">Absen</option>
                        <option value="dinas">Dinas</option>
                        <option value="tugas">Tugas</option>
                        <option value="wfh">Wfh</option>
                      </select>
                   </div>
               </div>
      

               <div class="col-md-12">
                   <input type="submit" name="submit" value="TAMBAH" class="btn btn-primary">
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
            url:'<?= base_url('administrator/seeGuru') ?>',
            data:{sekolah:sekolah},
            success:function(resp){
                $('#pegCab').html(resp);
            }
        })
    })
</script>
