
                    <p class='mb-4'><a href='<?= base_url('administrator/manajemenuser') ?>' class='btn btn-primary'>Kembali</a></p>


          <div class='card shadow mb-4'>
                        <div class='card-header py-3'>
                            <h6 class='m-0 font-weight-bold text-primary'>Edit User</h6>
                        </div>
                        <div class='card-body'>
            <?php 
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_manajemenuser',$attributes); 
              if ($rows['foto']==''){ $foto = 'users.gif'; }else{ $foto = $rows['foto']; }
            ?>
         <div class='table-responsive'>
                <div class="row">
              <div class="col-12 form-group">
                <label>Username</label>
               <input type='text' class='form-control' name='a' value='<?= $rows[username] ?>' readonly='on'>

              </div>
               <div class="col-12 form-group">
                <label>Password</label>
               <input type='password' class='form-control' name='b' onkeyup=\"nospaces(this)\">

              </div>
               <div class="col-12 form-group">
                <label>Nama Lengkap</label>
            <input type='text' class='form-control' name='c' value='<?= $rows[nama_lengkap]?>' required="">

              </div>
               <div class="col-12 form-group">
                <label>Email</label>
               <input type='email' class='form-control' name='d' value='<?= $rows[email] ?>' required="">

              </div>
              <div class="col-12 form-group">
                <label>No Telp</label>
                <input type='number' class='form-control' name='e' value='<?= $rows[no_telp] ?>' required="">

              </div>
              <div class="col-12 form-group">
                <label>Foto</label>
                <input type='file' class='form-control' name='f'>
                <small> <?php if ($rows['foto'] != ''){ echo "<i style='color:red'>Foto Saat ini : </i><a target='_BLANK' href='$rows[foto]'>$rows[foto]</a>"; } ?></small>

              </div>
              <?php  if ($this->session->level == 'admin'){?>
                
              <div class="col-12 form-group">
                <label>Level</label><br>
                <select name="level" class='form-control'>
                  <option value="admin" <?php if($rows['level'] == 'admin'){echo "selected";}?>>Admin</option>
                  <option value="user" <?php if($rows['level'] == 'user'){echo "selected";}?>>User</option>

                </select>  

              </div>
              <div class="col-12 form-group">
                <label for="">Sekolah</label>
                <select name="id_sd" id="id_sd" class="form-control" required>
                  <?php 
                      if($this->session->level == 'admin' AND $cabang_level == 'dinas'){
                          if($sekolah->num_rows() > 0){
                            foreach($sekolah->result_array() as $skh){
                              if($skh['id_sd'] == $rows['id_sd']){
                                echo "<option value='".encode($skh['id_sd'])."' selected>".$skh['nama_cabang']."</option>";

                              }else{
                              echo "<option value='".encode($skh['id_sd'])."'>".$skh['nama_cabang']."</option>";

                              }
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
                <label>Blokir</label><br>
                <input type='radio' name='h' value='Y' <?php if($rows['blokir'] == 'Y'){echo "checked";}?> > Ya &nbsp; <input type='radio' name='h' value='N' <?php if($rows['blokir'] == 'N'){echo "checked";}?> > Tidak

              </div>
                  <div class="col-12 form-group">
                <label>Tambah Modul</label>
                <div class="row">
                  <div class="col-12"> <input type="checkbox" onclick="toggle(this);" /> Check all</div>
                  <?php foreach($record->result_array() as $row){
                      $sub = $this->model_app->view_where('submodul',array('id_modul'=>$row['id_modul']));
                  ?>
                  <div class="col-4 mb-2  border-bottom">

                    <h6><?= $row['nama_modul']?></h6>
                    <?php foreach($sub->result_array() as $sb){
                        $mods = $this->model_app->view_where('users_modul',array('id_sm'=>$sb['id_sm'],'id_session'=>$rows['id_session']));
                        if($mods->num_rows() == 0){
                    ?>
                    <span style='display:block'><input name='modul[]' type='checkbox' value='<?= $sb[id_modul].'-'.$sb['id_sm']?> ' /> <?= $sb[submodul]?></span>
                    <?php } } ?>
                  </div>
                <?php }?>
                </div>
              
              </div>
              <div class="col-12 form-group">
                <label>Akses</label>
                <?php 
                $id = $this->session->id_session;
  $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/delete_akses'")->num_rows();
                   foreach ($akses as $ro){
                                                                                 echo "


                                                                                 <span style='display:block'>

                                                                                 ";
                                                                                 if($d > 0){
                                                                                  echo "<a class='text-danger' href='".base_url()."administrator/delete_akses/$ro[id_umod]/".$this->uri->segment(3)."'><span class='feather icon-trash'></span></a>";
                                                                                 }
                                                                                 echo "

                                                                                  $ro[submodul]</span> ";
                                                                               }
                ?>
              </div>
            <?php }?>
                    <input type='hidden' name='id' value='<?= $rows[username] ?>'>
                    <input type='hidden' name='ids' value='<?= $rows[id_session] ?>'>
           <div class="col-12 form-group">
                <a href='<?= base_url().$this->uri->segment(1).'/manajemenuser' ?>'><button type='button' class='btn btn-default float-left'>Cancel</button></a> <button type='submit' name='submit' class='btn btn-info float-right'>Tambahkan</button>
              </div>
            </div> 
             </div>
                        </div>
                    </div>
            <?php echo form_close(); ?>
                <script type="text/javascript">
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
            </script>