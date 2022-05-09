<div class="container-fluid">
    <div class="row justify-content-center">
        <?php 
        
                if($record->num_rows() > 0){
                    foreach($record->result_array() as $row){
                        echo "  <div class='col-11 my-3 border border-danger py-3'>
                                    <div class='row'>
                                        <div class='col-3'><img src='".$row['foto']."' class='rounded-circle ' style='width: 50px;height: 50px;' src='set'></div>
                                        <div class='col-7'><h5 class='my-0'>".$row['nama_guru']."</h5><label> ".$row['nip']."</label></div>
                                        <div class='col-2 detail' data-id='".encode($row['id_guru'])."'><span class='ri-arrow-right-s-line mt-3' style='font-size:30px;'></span></div>
                                    </div>
                                </div>";
                    }
                }else{
                    echo "<div class='col-11 my-2'><i>Tidak ada data guru<i></div>";
                }
        ?>
    </div>
</div>
<script>
    $(document).on('click','.detail',function(){
        var id = $(this).attr('data-id');
        window.location = '<?= base_url('kepsek/detailGuru?id=')?>'+id;
    })
</script>