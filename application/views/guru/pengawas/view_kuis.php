<section class="about">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-6">
                <input type="date" class="form-control" name="date" id="date" value="<?= date('Y-m-d')?>">
            </div>
            <div class="col-6">
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
            <div class="col-12 mt-3">
                <button class="btn btn-primary w-100" id="btnFilter">FILTER</button>
            </div>
            <div class="col-12 mt-3">
                <span id="title"></span>
            </div>
            <div class="col-4 mt-3 text-center">
                <h6 class="text-center" id="siswa"></h6>
                <label for="">Siswa</label>
            </div>
            <div class="col-4 mt-3 text-center">
                <h6 class="text-center" id="partisipasi"></h6>
                <label for="">Partisipasi</label>
            </div>
            <div class="col-4 mt-3 text-center">
                <h6 class="text-center" id="tidak"></h6>
                <label for="">Tidak </label>
            </div>
           
        </div>
        <div class="row justify-content-center mt-3" id="load_data"></div>
    </div>
</section>
<script>

    $(document).on('click','#btnFilter',function(){
        var kelas = $('#kelas').val();
        var date = $('#date').val();
      
        data(date,kelas);
    })
    data('<?= date('Y-m-d')?>','all'); 
    function data(date,kelas){
      $.ajax({
        type:'POST',
        data:{date:date,kelas:kelas},
        url:'<?= base_url('kepsek/dataKuis')?>',
        dataType:'json',
        success:function(resp){
            $('#load_data').html(resp.output);
            $('#title').html(resp.title);
            $('#siswa').html(resp.siswa);
            $('#partisipasi').html(resp.partisipasi);
            $('#tidak').html(resp.tidak);
            
        }
      })
    }
</script>
<?php 
            
           
    ?>