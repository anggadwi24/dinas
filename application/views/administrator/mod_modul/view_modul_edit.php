<?php 
    echo "
                    <p class='mb-4'><a href='". base_url('administrator/manajemenmodul'). "' class='btn btn-primary'>Kembali</a></p>


          <div class='card shadow mb-4'>
                        <div class='card-header py-3'>
                            <h6 class='m-0 font-weight-bold text-primary'>Tambah Modul</h6>
                        </div>
                        <div class='card-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_manajemenmodul',$attributes); 

              ?>
              <div class="row">
                <div class="col-12 form-group">
                    <label>Nama Modul</label>
                    <input type="text" name="modul" required class="form-control" value="<?= $row['nama_modul']?>">
                  
                </div>
                <div class="col-12 form-group">
                  <label>Icon</label>
                     
                  <input type="text" class="form-control" id="inlineFormInputGroup"  name="icon" value="<?= $row['icon']?>">
                  <small class="text-danger">Example : users , more example <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2" target="_BLANK">Fontawesome</a></small>
                    
                  
                </div>
                 <div class="col-12 form-group">
                  <label>Urutan</label>
                     
                  <input type="number" class="form-control" id="inlineFormInputGroup"  name="urutan" value="<?= $row['urutan']?>">
                
                    
                  <input type="hidden" name="id" value="<?= $row['id_modul']?>">
                </div>
                <div class="col-12 form-group" id="formSub">
                  <label>Link</label>
                     
                  <input type="text" class="form-control" id="inlineFormInputGroup"  name="link" value="<?= $row['link']?>">
                  <small class="text-danger">*Kosongkan jika memiliki sub domain</small>
                    
                  
                </div>
                <div class="col-12">  <button type='submit' name='submit' class='btn btn-info  w-100'>UPDATE</button></div>

              </div>
                <?php 
            echo form_close();
          ?>