
                    <p class="mb-4"><a href="<?= base_url('administrator/roomClass')?>" class="btn btn-primary">Kembali</a></p>
                    <form id="formAdd">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                        </div>
                        <div class="card-body">
                               <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
                           
                               <div class="row">
                                <?php   if($status == 'all' OR $status == 'dinas' OR $status == 'pusat'){?>
                                <div class="col-md-12 form-group">
                                        <label >Sekolah</label>
                            
                                        <select name="id_sd" class="form-control"  id="cabang">
                                            
                                                <?php 
                                      
                                        echo "  <option></option>";

                                        $subdomain = $this->model_app->view_where_ordering('subdomain',array('status'=>'sekolah'),'nama_cabang','ASC')->result_array();
                                      
                                        
                                        
                        
                        
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
                                    <?php }else{echo "<input type='hidden' name='id_sd' value='".$cabang."'>";}?>
                                   
                                 
                                   <div class="col-md-6 form-group">
                                       <label for="">Kelas</label>
                                       
                                           <?php 
                                           if($status == 'sekolah'){
                                                echo '<select name="kelas" id="kelas" class="form-control">';
                                                if($jenis == 'sd'){
                                                    echo "<option value='I'>I</option><option value='II'>II</option><option value='III'>III</option><option value='IV'>IV</option><option value='V'>V</option><option value='VI'>VI</option>";
                                                }else if($jenis == 'smp'){
                                                    echo "<option value='VII'>VII</option><option value='VIII'>VIII</option><option value='IX'>IX</option>";
                                                }else if($jenis == 'sma'){
                                                    echo "<option value='X'>X</option><option value='XI'>XI</option><option value='XII'>XII</option>";

                                                }
                                                echo '</select>';
                                           }else{
                                               echo "<select name='kelas' id='kelas' class='form-control'></select>";
                                           }
                                          
                                           ?>
                                         
                                       
                                   </div>
                                   <div class="col-md-6 form-group">
                                       <label for="">Mata Pelajaran</label>
                                       <select name="mapel" id="mapel" class="form-control"></select>
                                   </div>
                                   <div class="col-md-12 form-group">
                                       <label for="">Judul Kelas</label>
                                        <input type="text" name="judul" class="form-control" placeholder="Judul Kelas">
                                        
                                   </div>
                                   <div class="col-md-12 form-group">
                                       <label for="">Deskripsi Kelas</label>
                                        <textarea name="deskripsi" class="form-control" placeholder="Deskripsi Kelas"></textarea>
                                   </div>
                                   <div class="col-md-12 form-group">
                                       <label for="">Guru</label>
                                       <?php 
                                            if($status == 'sekolah'){
                                                ?>
                                        <select name="guru" class="form-control">
                                           <?php 
                                                $guru = $this->model_app->view_where_ordering('guru',array('id_sd'=>$cabang),'nama_guru','ASC');
                                                if($guru->num_rows() > 0){
                                                    foreach ($guru->result_array() as $gur){
                                                        echo "<option value='".encode($gur['id_guru'])."'>$gur[nama_guru]</option>";
                                                    }
                                                }
                                        ?>
                                         </select>
                                        <?php
                                            }else{
                                                ?>
                                                <select name="guru" id="guru" class="form-control">


                                                </select>
                                                <?php 
                                            }
                                            
                                            ?>
                                       

                                   </div>
                                   <div class="col-md-6 form-group">
                                       <label for="">Icon</label>
                                        <input type="file" name="icon" class="form-control" accept="image/*">
                                   </div>
                                   <div class="col-md-6 form-group">
                                       <label for="">Persetujuan Join Kelas</label>
                                        <select name="accept" id="accept" class="form-control">
                                            <option value="n">Tidak</option>
                                            <option value="y">Ya</option>
                                        </select>
                                   </div>
                                   <div class="col-md-8 form-group">
                                       
                                       <input type="text" class="form-control" id="kode" name="code" placeholder="Kode Kelas" required>
                                   </div>
                                   <div class="col-md-4 form-group">
                                       <button class="btn btn-primary " id="btnGenerate" type="button">Generate</button>
                                   </div>
                                </div>
                                   
                    <button class="btn btn-primary float-right my-3">SIMPAN</button>
    </form>
<script>
    $(document).on('click','#btnGenerate',function(){
        $.ajax({
            type:'POST',
            url:'<?= base_url('administrator/generateCodeClass')?>',
            dataType:'JSON',
            success:function(resp){
                $('#kode').val(resp);
            }
        })
    })
    $(document).on('change','#kelas',function(){
        $.ajax({
            type:'POST',
            url:'<?= base_url('administrator/getMapel') ?>',
            data:{kelas:$(this).val()},
            dataType:'json',
            success:function(resp){
                $('#mapel').html(resp);
            }
        })
    })
    $(document).on('change','#cabang',function(){
        $.ajax({
            type:'POST',
            url:'<?= base_url('administrator/getKelas') ?>',
            data:{id:$(this).val()},
            // dataType:'json',
            success:function(resp){
                $('#kelas').html(resp);
            }
        })
        $.ajax({
            type:'POST',
            url:'<?= base_url('administrator/getGuru') ?>',
            data:{id:$(this).val()},
            dataType:'json',
            success:function(resp){
                $('#guru').html(resp);
            }
        })
    })
    $("#formAdd").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/storeClass') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formAdd input').prop('disabled',true);
                $('select').prop('disabled',true);

                $('#btnAdd').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
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
               
              if(resp.status == true){
                
                $('#formAdd input').val('');
                $('#formAdd textarea').val('');
                swal({
                    title:'Berhasil',
                    text:resp.msg,
                    type:'success',
                })
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
                $('select').prop('disabled',false);

               $('#btnAdd').html('Simpan');
                $('#formAdd button').prop('disabled',false);
            },
        });
    });
</script>