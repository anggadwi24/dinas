  
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Hari Kerja</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?= base_url('administrator/harikerja')?>">
                          <div class="row">
                         
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Bulan</label>
                                <select name="bulan" class="form-control">

                                 <option value="<?= date('Y-01-d')?>" <?php if($m == date('Y-01-d')){echo"selected";}?>>Januari <?= date('Y') ?></option>
                                 <option value="<?= date('Y-02-d')?>" <?php if($m == date('Y-02-d')){echo"selected";}?>>Februari <?= date('Y') ?></option>
                                 <option value="<?= date('Y-03-d')?>" <?php if($m == date('Y-03-d')){echo"selected";}?>>Maret <?= date('Y') ?></option>
                                 <option value="<?= date('Y-04-d')?>" <?php if($m == date('Y-04-d')){echo"selected";}?>>April <?= date('Y') ?></option>
                                 <option value="<?= date('Y-05-d')?>" <?php if($m == date('Y-05-d')){echo"selected";}?>>Mei <?= date('Y') ?></option>
                                 <option value="<?= date('Y-06-d')?>" <?php if($m == date('Y-06-d')){echo"selected";}?>>Juni <?= date('Y') ?></option>
                                 <option value="<?= date('Y-07-d')?>" <?php if($m == date('Y-07-d')){echo"selected";}?>>Juli <?= date('Y') ?></option>
                                 <option value="<?= date('Y-08-d')?>" <?php if($m == date('Y-08-d')){echo"selected";}?>>Agustus <?= date('Y') ?></option>
                                 <option value="<?= date('Y-09-d')?>" <?php if($m == date('Y-09-d')){echo"selected";}?>>September <?= date('Y') ?></option>
                                 <option value="<?= date('Y-10-d')?>" <?php if($m == date('Y-10-d')){echo"selected";}?>>Oktober <?= date('Y') ?></option>
                                 <option value="<?= date('Y-11-d')?>" <?php if($m == date('Y-11-d')){echo"selected";}?>>November <?= date('Y') ?></option>
                                 <option value="<?= date('Y-12-d')?>" <?php if($m == date('Y-12-d')){echo"selected";}?>>Desember <?= date('Y') ?></option>
                                </select>

                              </div>

                            </div>
                           <div class="col-md-12 ">
                                       <input type="submit" name="submit" value="Input" class="btn btn-primary float-right">
                            </div>
                          </div>
                            </form>

                            <div class="row">
                              <div class="col-md-12"><h2>Data Hari Kerja</h2></div>
                                <?php 

                                    foreach($record as $row){
                                      $date = $row[tahun].'-'.$row[bulan].'-'.$row[tanggal];
                                      $hari = format_indo($date);

                                    ?>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?= $hari ?></label>
                                        <div class="form-check">
                                          <input class="form-check-input" id="kerja<?=$row[id_harikerja]?>" type="radio" name="status<?=$row[id_harikerja]?>" onClick="processForm1(<?=$row[id_harikerja]?>)" value="kerja" <?php if($row['status']=='kerja'){echo"checked";}?>>
                                          <label class="form-check-label" for="kerja<?=$row[id_harikerja]?>">
                                           Kerja
                                          </label>
                                        
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" id="libur<?=$row[id_harikerja]?>" type="radio" name="status<?=$row[id_harikerja]?>" onClick="processForm(<?=$row[id_harikerja]?>)" value="libur" data-id='<?= $row[id_harikerja]?>'  <?php if($row['status']=='libur'){echo"checked";}?> >
                                          <label class="form-check-label" for="libur<?=$row[id_harikerja]?>">
                                           Libur
                                          </label>
                                        </div>
                                    </div>
                                  
                                     </div>
                                    <?php 
                                    }
                                 ?>

                           
                          </div>
                         
                        </div>
                  


<script type="text/javascript">
   function processForm1(id) { 
    var status = 'kerja';
    console.log(status);
     $.ajax( {
        type: 'POST',
        url: '<?= base_url('administrator/update_harikerja')?>',
        data: { status :status ,id:id},

        success: function(data) {
            $('#message').html(data);
        }
    } );
}
</script>
<script type="text/javascript">
   function processForm(id) { 
    var status = 'libur';
    console.log(status);
     $.ajax( {
        type: 'POST',
        url: '<?= base_url('administrator/update_harikerja')?>',
        data: { status :status ,id:id},

        success: function(data) {
            $('#message').html(data);
        }
    } );
}
</script>

    
</script>
