
<?php 
    echo "<p class='mb-4'><a href='". base_url('administrator/manajemenmodul'). "' class='btn btn-primary'>Kembali</a></p>


          <div class='card shadow mb-4'>
                        <div class='card-header py-3'>
                            <h6 class='m-0 font-weight-bold text-primary'>Tambah Modul</h6>
                        </div>
                        <div class='card-body'>";
                        $urutan = $this->db->query("SELECT urutan FROM modul ORDER BY urutan DESC LIMIT 1")->row_array();
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/tambah_manajemenmodul',$attributes); 

              ?>
              <div class="row">
                <div class="col-12 form-group">
                    <label>Nama Modul</label>
                    <input type="text" name="modul" required class="form-control">
                  
                </div>

                <div class="col-12 form-group">
                  <label>Icon</label>
                     
                  <input type="text" class="form-control" id="inlineFormInputGroup"  name="icon">
                  <small class="text-danger">contoh lainnya :  <a href="<?= base_url('administrator/icon') ?>" target="_BLANK">Icon</a></small>
                    
                  
                </div>
                 <div class="col-12 form-group">
                  <label>Urutan</label>
                     
                  <input type="number" class="form-control" id="inlineFormInputGroup"  name="urutan" value="<?= $urutan['urutan']+1 ?>">
                
                    
                  
                </div>
                <div class="col-12 form-group" id="formSub">
                  <label>Link</label>
                     
                  <input type="text" class="form-control" id="inlineFormInputGroup"  name="link">
                  <small class="text-danger">*Kosongkan jika memiliki sub domain</small>
                    
                  
                </div>
                

                <div class="col-12">  <button type='submit' name='submit' class='btn btn-info  w-100'>Tambahkan</button></div>

              </div>
                <?php 
            echo form_close();
          ?>

