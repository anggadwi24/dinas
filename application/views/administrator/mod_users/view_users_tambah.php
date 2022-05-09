
                    <p class='mb-4'><a href='<?=  base_url('administrator/manajemenuser') ?>' class='btn btn-primary'>Kembali</a></p>


          <div class='card shadow mb-4'>
                        <div class='card-header py-3'>
                            <h6 class='m-0 font-weight-bold text-primary'>Tambah User</h6>
                        </div>
                        <div class='card-body'>
                          <?php 
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/tambah_manajemenuser',$attributes); 
              ?>
          <div class='table-responsive'>
            <div class="row">
              <div class="col-12 form-group">
                <label>Username</label>
                <input type='text' class='form-control' name='a' onkeyup=\"nospaces(this)\" required>

              </div>
               <div class="col-12 form-group">
                <label>Password</label>
                <input type='password' class='form-control' name='b' onkeyup=\"nospaces(this)\" required>

              </div>
               <div class="col-12 form-group">
                <label>Nama Lengkap</label>
                <input type='text' class='form-control' name='c' required>

              </div>
               <div class="col-12 form-group">
                <label>Email</label>
                <input type='email' class='form-control' name='d' required>

              </div>
              <div class="col-12 form-group">
                <label>No Telp</label>
                <input type='text' class='form-control' name='e' required>

              </div>
              <div class="col-12 form-group">
                <label>Foto</label>
                <input type='file' class='form-control' name='f'>

              </div>
              <div class="col-12 form-group">
                <label> Level </label>
                <select name="level" class='form-control' required>
                  <option value="user">User</option>
                  <option value="admin">Admin</option>
                </select>
              </div>
              <div class="col-12 form-group">
                <label for="">Sekolah</label>
                <select name="id_sd" id="id_sd" class="form-control" required>
                  <?php 
                      if($this->session->level == 'admin' AND $cabang_level == 'dinas'){
                          if($sekolah->num_rows() > 0){
                            foreach($sekolah->result_array() as $skh){
                              echo "<option value='".encode($skh['id_sd'])."'>".$skh['nama_cabang']."</option>";
                            }
                          }
                      }else if($cabang_level == 'sekolah'){
                          $seko = $this->model_app->view_where('subdomain',array('id_sd'=>$cabang))->row_array();
                          echo "<option value='".encode($skh['id_sd'])."'>".$skh['nama_cabang']."</option>";
                      }
                  ?>
              
                </select>
              </div>
             
              <div class="col-12 form-group">
                <label>Modul</label>
                <div class="row">
                  <div class="col-12"> <input type="checkbox" onclick="toggle(this);" /> Check all</div>
                  <?php foreach($record->result_array() as $row){
                      $sub = $this->model_app->view_where('submodul',array('id_modul'=>$row['id_modul']));
                  ?>
                  <div class="col-4 mb-2  border-bottom">

                    <h6><?= $row['nama_modul']?></h6>
                    <?php foreach($sub->result_array() as $sb){?>
                    <span style='display:block'><input name='modul[]' type='checkbox' value='<?= $sb[id_modul].'-'.$sb['id_sm']?> ' /> <?= $sb[submodul]?></span>
                    <?php }?>
                  </div>
                <?php }?>
                </div>
              
              </div>
              <div class="col-12 form-group">
                <a href='<?= base_url().$this->uri->segment(1).'/manajemenuser' ?>'><button type='button' class='btn btn-default float-left'>Cancel</button></a> <button type='submit' name='submit' class='btn btn-info float-right'>Tambahkan</button>
              </div>
            </div>
               </div>
                        </div>
                    </div>
                    <?php 
            echo form_close();?>

            <script type="text/javascript">
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
            </script>