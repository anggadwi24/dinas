
                    <p class='mb-4'><a href='<?=  base_url('administrator/manajemensubmodul') ?>' class='btn btn-primary'>Kembali</a></p>
<div class='card shadow mb-4'>
    <div class='card-header py-3'>
        <h6 class='m-0 font-weight-bold text-primary'>Edit Submodul</h6>
    </div>
    <div class='card-body'>
        <form action="<?= base_url('administrator/edit_manajemensubmodul') ?>" METHOD="POST">
        <div class="row">
        <div class="col-12 form-group">
            <label>Modul</label>
            <select class="form-control" name="modul" required>
                <option></option>
                <?php 
                    foreach($modul as $mod){
                        if($mod['id_modul'] == $row['id_modul']){
                        echo "<option value='".$mod['id_modul']."' selected>".$mod['nama_modul']."</option>";

                        }else{
                        echo "<option value='".$mod['id_modul']."'>".$mod['nama_modul']."</option>";

                        }
                    }
                ?>
            </select>
        </div>
        
      
        <div class="col-12 form-group">
            <label>Submodul</label>
            <input type="text" name="submodul" required class="form-control" value="<?= $row['submodul'] ?>" >
        </div>
        <div class="col-12 form-group">
            <label>Link</label>
            <input type="text" name="link" required class="form-control" value="<?= $row['link']?>" >
        </div>
        <div class="col-12 form-group">
            <h6>Publish</h6>
            <select class="form-control" name="publish" required>
                <option value="y" <?php if($row['publish'] == 'y'){echo "selected";}?> >Tampil</option>
                <option value="n" <?php if($row['publish'] == 'n'){echo "selected";}?>>Tidak Tampil</option>
            </select>
        </div>
        <div class="col-12">
            <input type="hidden" name="id_sm" value="<?= $row['id_sm']?>">
            <input type="submit" name="submit" value="UPDATE" class="btn btn-primary w-100">
        </div>
    </div>
</form>
    </div>

</div>
