<?php 
    echo "
                    <p class='mb-4'><a href='". base_url('administrator/manajemencabang'). "' class='btn btn-primary'>Kembali</a></p>


          <div class='card shadow mb-4'>
                        <div class='card-header py-3'>
                            <h6 class='m-0 font-weight-bold text-primary'>Tambah Sekolah</h6>
                        </div>
                        <div class='card-body'>";
                        
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/tambah_manajemencabang',$attributes); 

              ?>
              <div class="row">
                <div class="col-12 form-group">
                    <label>Nama Sekolah</label>
                    <input type="text" name="nama_cabang" required class="form-control" >
                  
                </div>

                <div class="col-12 form-group">
                    <label>Link</label>
                    <input type="text" name="sub_domain" required class="form-control">
                  
                </div>

                <div class="col-12 form-group">
                  <label>Status</label>
                  <select class="form-control" name="status" required id="statusUser">
                        <option></option>
                        <option value="dinas">Dinas</option>
                        <option value="sekolah">Sekolah</option>
                      
                        <option value="pusat">Pusat</option>
                  </select>
                    
                    
                  
                </div>
                <div class="col-12 form-group" id="jenisForm">
                  <label for="">Jenis Sekolah</label>
                  <select name="jenis_sekolah" id="jenis_sekolah" class="form-control">
                    <option value="sd">SD</option>  
                    <option value="smp">SMP</option>
                    <option value="sma">SMA/SMK</option>
                  </select>
                </div>
                <div class="col-12">
                    <label>Icon</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
                <div class="col-12 mt-4">  <button type='submit' name='submit' class='btn btn-info  w-100'>Simpan</button></div>

              </div>
                <?php 
            echo form_close();
          ?>

          <script>
            $('#jenisForm').hide();
            $(document).on('change','#statusUser',function(){
              var stat = $(this).val();
              if(stat == 'sekolah'){
                $('#jenisForm').show();
              }else{
                $('#jenisForm').hide();
              }
            })
          </script>