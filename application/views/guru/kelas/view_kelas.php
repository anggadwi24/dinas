<section class="about">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
            <div class="col-12">
                 <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i></button>
                 <button type="button" class="btn btn-outline-danger ml-2" data-toggle="modal" data-target="#searchModal"><i class="fa fa-search"></i></button>
            </div>
            <div class="col-12 mt-2" id="searchKey">
             
            </div>
            <div class="col-12 mt-4">
                <div class="row" id="data"></div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buat Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formAdd">
      <div class="modal-body">
        <div class="row">
            <div class="col-12 form-group">
                <label for="">Judul Kelas</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            <div class="col-12 form-group">
                <label for="">Deskripsi Kelas</label>
                <input type="text" name="deskripsi" class="form-control" style="height:80px;">
            </div>
            <div class="col-6 form-group">
                <label for="">Kelas</label>
                <select name="kelas" id="kelas" class="form-control">
                    <option selected disabled></option>
                <?php 
                    if($jenis == 'sd'){
                        echo "<option value='I'>I</option><option value='II'>II</option><option value='III'>III</option><option value='IV'>IV</option><option value='V'>V</option><option value='VI'>VI</option>";
                    }else if($jenis == 'smp'){
                        echo "<option value='VII'>VII</option><option value='VIII'>VIII</option><option value='IX'>IX</option>";
                    }else if($jenis == 'sma'){
                        echo "<option value='X'>X</option><option value='XI'>XI</option><option value='XII'>XII</option>";

                    }
                ?>
                </select>
            </div>
            <div class="col-6 form-group">
                <label for="">Mata Pelajaran</label>
                <select name="mapel" id="mapel" class="form-control">
                <option selected disabled></option>

                </select>
            </div>
            <div class="col-12 form-group">
                <label for="">Icon Kelas</label>
                <input type="file" class="form-control" accept="image/*" name="file">
            </div>
            <div class="col-12 form-group">
                <label for="">Kode Kelas</label>
                <div class="row">
                    <div class="col-8">
                        <input type="text" name="kode" class="form-control" id="kode" required>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary btn-xs" type="button" id="btnGenerate">Generate</button>
                    </div>
                </div>
            </div>
            <div class="col-12 form-group">
                <label for="">Persetujuan join kelas</label>
                <select name="acc" id="acc" class="form-control" required>
                    <option value="y">Perlu</option>
                    <option value="n">Tidak Perlu</option>
                </select>
                
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button  class="btn btn-primary">Simpan</button>
      </div>
    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formSearch">
      <div class="modal-body">
        <div class="row">
            <div class="col-12 form-group">
                <label for="">Keyword</label>
                <input type="text" name="keyword" id="keyword" class="form-control" >
            </div>
           
           
        </div>
      </div>
      <div class="modal-footer">
      
        <button  class="btn btn-primary">Cari</button>
      </div>
    </form>
    </div>
  </div>
</div>
<script>
    dataKelas();
    function dataKelas(){
        $.ajax({
            type:'POST',
            url:'<?=base_url('guru/dataKelas')?>',
            dataType:'json',
            beforeSend:function(){
                $('#loader').css('display','');
            },success:function(resp){
              
                if(resp.status == true){
                    $('#data').html(resp.output);
                }
            },complete:function(){
                $('#loader').css('display','none');

            }
        })
    }
     $(document).on('change','#kelas',function(){
        $.ajax({
            type:'POST',
            url:'<?= base_url('administrator/getMapel') ?>',
            data:{kelas:$(this).val()},
            dataType:'json',
            success:function(resp){
                $('#mapel').html(resp);
            }
        })
    })
    $(document).on('click','#btnGenerate',function(){
        $.ajax({
            type:'POST',
            url:'<?= base_url('administrator/generateCodeClass')?>',
            dataType:'JSON',
            success:function(resp){
                $('#kode').val(resp);
            }
        })
    })
    $(document).on('click','.detail',function(){
        var href= $(this).attr('data-href');
        window.location = href;
    })
    $("#formSearch").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('guru/searchKelas') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formSearch input').prop('disabled',true);
               

                $('#formSearch button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formSearch button').prop('disabled',true);
   
            },
             error:function(){
             
                 swal({

                  title: '404',
                  text: 'Something error!',
                   customClass: 'swal-wide',
                   type:'error',
                  
                })
               
            },
          
            success: function(resp){
               
              if(resp.status == true){
                $("#data").html(resp.output);
                
                $('#searchModal').modal('hide');
                
               
              }else{
                swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
              }
               
            }, 
             complete: function() {
                 var key= $('#keyword').val();
                 
                 var html = '<span>'+key+'</span> <span id="cancelSearch" class=" text-danger"><i class="fas fa-times"></i></span>';
                 $('#searchKey').html(html);
                 $('#searchKey').addClass('text-right');
               $('#formSearch input').prop('disabled',false);
                

               $('#formSearch button').html('Cari');
                $('#formSearch button').prop('disabled',false);
            },
        });
    });
    $(document).on('click','#cancelSearch',function(){
        $('#searchKey').html('');
        $('#keyword').val('');
        
        dataKelas();
    
    })
   
    
    $("#formAdd").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('guru/storeClass') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formAdd input').prop('disabled',true);
                $('select').prop('disabled',true);

                $('#btnAdd').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formAdd button').prop('disabled',true);
   
            },
             error:function(){
             
                 swal({

                  title: '404',
                  text: 'Something error!',
                   customClass: 'swal-wide',
                   type:'error',
                  
                })
               
            },
          
            success: function(resp){
               
              if(resp.status == true){
                dataKelas();
                $('#formAdd input').val('');
                $('#formAdd textarea').val('');
                
                swal({
                    title:'Berhasil',
                    text:resp.msg,
                    type:'success',
                }).then(function() {
                    window.location = resp.redirect;
                });
               
              }else{
                swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
              }
               
            }, 
             complete: function() {
               $('#formAdd input').prop('disabled',false);
                $('select').prop('disabled',false);

               $('#btnAdd').html('Simpan');
                $('#formAdd button').prop('disabled',false);
            },
        });
    });
</script>