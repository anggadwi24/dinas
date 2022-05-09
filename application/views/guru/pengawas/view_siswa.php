<section class="about">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">
                <select name="kelas" id="kelas" class="form-control">
                    <option value="all">Semua</option>
                    <?php 
                        if($jenis == 'sd'){
                            echo "<option value='I'>I</option><option value='II'>II</option><option value='III'>III</option><option value='IV'>IV</option><option value='V'>V</option><option value='VI'>VI</option>";
                        }else if($jenis == 'smp'){
                            echo "<option value='VII'>VII</option><option value='VII'>VII</option><option value='IX'>IX</option>";
                        }else if($jenis == 'sma'){
                            echo "<option value='X'>X</option><option value='XI'>XI</option><option value='XII'>XII</option>";

                        }
                    ?>
                </select>
            </div>
            <div class="col-4">
                <button class="btn btn-primary" id="btnFilter">FILTER</button>
            </div>
           
        </div>
        <div class="row justify-content-center" id="load_data"></div>
    </div>
</section>
<script>
    $(document).on('click','.detail',function(){
        var id = $(this).attr('data-id');
        window.location = '<?= base_url('kepsek/detailSiswa?id=')?>'+id;
    })
    $(document).on('click','#btnFilter',function(){
        var kelas = $('#kelas').val();
      
        data(kelas);
    })
    data('all'); 
    function data(kelas){
      $.ajax({
        type:'POST',
        data:{kelas:kelas},
        url:'<?= base_url('kepsek/dataSiswa')?>',
        dataType:'json',
        success:function(resp){
            $('#load_data').html(resp.output);
            $('#title').html(resp.title);
            
        }
      })
    }
</script>
<?php 
            
           
    ?>