<div class="container-fluid">
    <div class="row justify-content-center my-3" >
        <div class="col-8 form-group">
            <input type="date" class="form-control" id="date" value="<?= date('Y-m-d')?>">
        </div>
        <div class="col-4">
            <button class="btn btn-primary "  id="btnFilter">FILTER</button>
        </div>
        <div class="col-12 my-3">
            <h6 >Tanggal :  <span id="tanggal"><?= date('Y-m-d') ?></span></h6>
        </div>
        <div class="col-12">
            <div class="row justify-content-center" id="data"></div>
        </div>
    </div>
</div>
<script>
    $(document).on('click','.detail',function(){
        var id = $(this).attr('data-id');
        window.location = '<?= base_url('kepsek/detailKehadiran?id=')?>'+id;
    })
    kehadiran('<?= date('Y-m-d')?>');
    $(document).on('click','#btnFilter',function(){
        var date = $('#date').val();
        kehadiran(date);
    })
    function kehadiran(date){
        $.ajax({
            type:'POST',
            url:'<?= base_url('kepsek/dataKehadiran')?>',
            data:{date:date},
            dataType:'json',
            success:function(resp){
                $('#tanggal').html(resp.tanggal);
                $('#data').html(resp.output);
            }
        })
    }
</script>