  
<p class="mb-4"><a href="<?= base_url('administrator/mataPelajaran')?>" class="btn btn-primary">Kembali</a></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Mata Pelajaran</h6>
    </div>
    <div class="card-body">
           <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
         <form method="post" action="<?= base_url('administrator/mataPelajaran/edit')?>" enctype="multipart/form-data">
           <div class="row">
           
              
                  <div class="col-md-8">
                  <div class="form-group">
                    <label>Mata Pelajaran</label>
                    <input type="text" name="mata_pelajaran" class="form-control"  required value="<?= $row['mapel']?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Kelas</label>
                        <select name="kelas" id="kelas" class="form-control" required>
                            <option disabled selected></option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                            <option value="VI">VI</option>
                            <option value="VII">VII</option>
                            <option value="VIII">VIII</option>
                            <option value="IX">IX</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            
                            <option value="XII">XII</option>

                        </select>
                  </div>
                </div>
               
      
                <input type="hidden" name="id" value="<?= encode($row['mapel_id'])?>">
               <div class="col-md-12">
                   <input type="submit" name="submit" value="SIMPAN" class="btn btn-primary">
               </div>
           </div>
        </form>
    </div>
</div>
<script>
    $('#kelas').val('<?= $row['mapel_kelas'] ?>').change();
</script>