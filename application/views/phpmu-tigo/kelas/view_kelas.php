<style>
    img {
    pointer-events: none;
    cursor: default;
}
</style>
<div class="row justify-content-between mx-2" id="dataKelas">
    
</div>
<div class="modal fade dialogbox" id="addDialog" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Join Class</h5>
                    </div>
                    <form id="formJoin">
                        <div class="modal-body text-left mb-2">
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="kode">Kode Kelas</label>
                                    <input type="text" class="form-control" name="kode" id="kode" placeholder="Masukan Kode Kelas">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                            </div>

                          
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <button type="button" class="btn btn-text-secondary" data-dismiss="modal">CLOSE</button>
                                <button  class="btn btn-text-primary" >JOIN</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<script>
    $base = '<?= base_url('kelas') ?>/';
    $(document).on('click','.detail',function(){
        var id = $(this).data('id');
        window.location = $base+'detail?id='+id;
       
    })
    $(document).on('click','#closeSearch',function(){
       data();
    })
    $(document).on('click','.notice',function(){
        $('#modalInfo').modal('show');
        $('#textInfo').html('Kelas masih dalam pengajuan');
    })
    $(document).on('keyup','#key',function(){
        var key = $(this).val();
        
        $.ajax({
            url: $base+'dataSearch',
            type: 'post',
            data: {key:key},
            dataType: 'json',
            success: function(data){
                $('#dataKelas').html(data);
            }
        })
       
    })
    $(document).on('submit','#formJoin',function(e){
        e.preventDefault();
        var formData = new FormData(this);
      
        $.ajax({
             type:'POST',
             url:$base+'join',
             data: formData,
             contentType: false,
             cache: false,
             processData:false,
             dataType :'json',
             beforeSend:function(){
                $('#loading').css('display','');
             },success:function(resp){
                if(resp.status == true)  {
                    data();
                    $('#modalSuccess').modal('show');
                    $('#textSuccess').html(resp.msg);
                    
                }else{
                    $('#modalError').modal('show');
                    $('#textError').html(resp.msg);
                   
                }
               
             },complete:function(){
                $('#loading').css('display','none');

             }
        })
    })
    data();
    function data(){
        $.ajax({
        url:$base+'dataKelas',
        type:'POST',
        dataType:'JSON',
        success:function(resp){
            
                $('#dataKelas').html(resp);
            
        }
    })
    }
   
</script>