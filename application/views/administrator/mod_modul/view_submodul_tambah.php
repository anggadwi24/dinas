
                    <p class='mb-4'><a href='<?=  base_url('administrator/manajemensubmodul') ?>' class='btn btn-primary'>Kembali</a></p>
<div class='card shadow mb-4'>
    <div class='card-header py-3'>
        <h6 class='m-0 font-weight-bold text-primary'>Tambah Submodul</h6>
    </div>
    <div class='card-body'>
        <form action="<?= base_url('administrator/tambah_manajemensubmodul') ?>" METHOD="POST">
        <div class="row">
        <div class="col-12 form-group">
            <label>Modul</label>
            <select class="form-control" name="modul" required>
                <option></option>
                <?php 
                    foreach($modul as $mod){
                        echo "<option value='".$mod['id_modul']."'>".$mod['nama_modul']."</option>";
                    }
                ?>
            </select>
        </div>
        
      
        <div class="col-12 mt-4 form-inline">
                   <input type="number" name="tot" id="tot" value="1" class="form-control mr-2 w-50">
                                     
                <button type="submit" class="btn btn-primary w-25" id="sbmTot">TAMBAH</button>
        </div>
       
                                   
        <div class="col-md-12 mt-3">
             <div class="row" id="tampilInput"></div>
                                       
        </div>
        <div class="col-12">
            <input type="submit" name="submit" value="SUBMIT" class="btn btn-primary w-100">
        </div>
    </div>
</form>
    </div>

</div>
<script type="text/javascript">

                        jQuery(document).ready(function($) {
                              
                       
                            $("#tot").bind('change', function () {
                               
                                tampil();
                             
                          });
                            $( "#sbmTot" ).click(function(e) {
                                e.preventDefault();
                                    tampil();


                                });
                            tampil();
                            function tampil(){
                                 
                                    
                                    
                                     var tot = $('#tot').val();
                                    
                                    
                                 
                                               
                                             var html = "";
                                           
                                               for (let i = 0; i < tot; i++) {
                                                 html += " <div class='col-12 form-group'><label>Submodul</label><input type='text' name='submodul[]' required class='form-control' ></div><div class='col-12 form-group'><label>Link</label><input type='text' name='link[]' required class='form-control' ></div><div class='col-12 form-group'><h6>Publish</h6><select class='form-control' name='publish[]' required><option value='y'>Tampil</option><option value='n' selected>Tidak Tampil</option></select></div><div class='col-12 form-group'><hr></div>";;
                                                
                                                
                                                    
                                               }
                                             $('#tampilInput').html(html);
                                               
                                           
                                          }
                                       
                        
                            
                              



                  });
</script>