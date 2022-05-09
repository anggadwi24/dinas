<script>


</script>
<div class="container">
    <div class="row">
        <div class="col-12 form-group mt-4" >
            <label for="">Sekolah</label>
            <select name="sekolah" id="sekolah" class="form-control">
                <option disabled selected ></option>
                <?php if($record->num_rows() > 0){
                    $no = 1;
                    foreach($record->result_array() as $row){
                        
                            echo "<option value=".encode($row['id_sd'])." >".strtoupper($row['nama_cabang'])."</option>";
                            
                        
                        $no++;
                    }
                        }?>
            </select>
        </div>
        <div class="col-12 my-5" id="content"></div>
    </div>
</div>

<script>
    
 // executes when complete page is fully loaded, including all frames, objects and images
    // $("#sekolah option:first").change();
 



    $(document).on('change','#sekolah',function(){
        var id = $(this).val();
        $.ajax({
            type:'POST',
            url:'<?= base_url('pengawas/getSekolah') ?>',
            data:{id:id},
            dataType:'json',
            beforeSend:function(){
                $('#loader').css('display','');
            },success:function(resp){
                if(resp.status ==  true){
                    $('#content').html(resp.output);
                }
            },complete:function(){
                $('#loader').css('display','none');

            }
        })
    })
</script>