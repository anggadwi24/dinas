  
                   

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Jam Kerja</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?= base_url('administrator/updateWorkingHours')?>">
                        

                            <div class="row">
                              <div class="col-md-12"><h2>Data Jam Kerja</h2></div>
                                <?php 

                                    foreach($record as $row){
                                     

                                    ?>
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?= $row['hari'] ?></label>
                                        <div class="row">
                                        <div class="col-md-6">
                                        <input type="time" name="shift_masuk[]" class="form-control" value="<?= $row['shift_masuk']?>">
                                        </div>
                                        <div class="col-md-6">
                                         <input type="time" name="shift_keluar[]" class="form-control" value="<?= $row['shift_keluar']?>">
                                        </div>
                                        <input type="hidden" name="id[]" value="<?= $row['id_wh']?>">
                                        </div>
                                    </div>
                                  
                                     </div>
                                    <?php 
                                    }
                                 ?>
                              <div class="col-md-12">
                                <input type="submit" name="submit" value="Update" class="btn btn-primary float-right">
                              </div>
                           
                          </div>
                         
                        </div>
                  


<script type="text/javascript">
   function processForm(id) { 
     $.ajax( {
        type: 'POST',
        url: '<?= base_url('administrator/updateWorkingHours')?>',
        data: { status : $('input:radio:checked').val(),id:id},

        success: function(data) {
            $('#message').html(data);
        }
    } );
}
</script>

    
</script>
