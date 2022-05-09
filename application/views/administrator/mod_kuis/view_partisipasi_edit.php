<script type="text/javascript">
    $(document).ready(function(){
        $('#buland').change(function(){
        
          var bulan = $('#buland').val();
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('administrator/getBulanDate'); ?>",
            data:"bulan="+bulan,
            success: function(response){
              console.log(response);
              $('#app').html(response);

            }
          })
        })

      });
    function getval(sel,id){
       var val = sel.value;

       if(val == 'y'){
          $('#start'+id).show();
          $('#end'+id).show();
          $('#alasan'+id).css('display','none');

       }else if(val == 'n'){
         $('#start'+id).hide();
          $('#end'+id).hide();
          $('#alasan'+id).css('display','block');
       }
       }
</script>

  <div class="card">
    <div class="card-header with-border">
         <h6 class="box-title">Tambah Tanggal Kuis </h6>

        
    </div>
    <div class="card-body">
      
      <form id='formAdd'>
        <div class="row mt-3">
            <div class="col-lg-8 form-group">
                    <label>Tanggal</label>
                     <input type="text"  class='form-control' disabled  name='tanggal' id='tanggal' required value='<?= date('Y-m-d',strtotime($tanggal['tanggal']))?>' >
             </div>
             <div class="col-lg-10 form-group">
                <label for="">Siswa</label>
                <input type="text" class='form-control' value='<?= $siswa['nama_lengkap']?>' disabled>
             </div>
             <div class='col-lg-4 form-group'>
                 <label>Benar</label>
                 <input type="number" name='benar' id='benar' class='form-control' value=<?= $row['qp_correct']?>>
                 <small class='text-danger' id='alertB'></small>
             </div>
             <div class='col-lg-4 form-group'>
                 <label>Salah</label>
                 <input type="number" name='salah' id='salah' class='form-control' value=<?= $row['qp_wrong'] ?>>
                 <small class='text-danger' id='alertS'></small>
             </div>
             <div class='col-lg-4 form-group'>
                 <label>Poin</label>
                 <input type="number" name='poin' id='poin' class='form-control' value=<?= $row['qp_poin']?>>
                 <small class='text-danger' id='alertP'></small>
             </div>
             <input type="hidden" name='id' value='<?= $this->encrypt->encode($row['id_qp'],keys())?>'>
             
             
             <div class='col-12 form-group'>
                    <a href="<?= base_url('administrator/quiz')?>" class='btn btn-outline-light'>CANCEL</a>
                    <button class='btn btn-outline-primary float-right' id='btnAdd'>SIMPAN</button>
             </div>
             
           
          </div>
        </form>
    </div>
</div>

<script>
    $("#formAdd").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/doEditPartisipasi') ?>",

           
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
               
              if(resp == true){
                
                
                


                     swal({
                      title: 'Data Berhasil Diubah',
                      text: 'Tetap dihalaman ini atau kembali?',
                      type: 'success',
                      showCancelButton: true,
                      confirmButtonColor: '#DD6B55',
                      confirmButtonText: 'Kembali',
                      cancelButtonText: 'Tetap'
                    }).then(result => {
                     
                        // handle confirm
                        window.location ='<?= base_url('administrator/quiz') ?>';
                      
                    });
              }else{
                swal({
                      title: 'Gagal',
                      text: 'Something Wrong!',
                      type: 'error',
                     
                    }).then(result => {
                     
                     // handle confirm
                     window.location ='<?= base_url('administrator/quiz') ?>';
                   
                 });
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
     $(".date")
        .datepicker({
            onSelect: function(dateText) {
               
                getSiswa(dateText)
		        $(this).change();
		    }
		})
        .on("change", function() {
            getSiswa($(this).val())
            
        });
        $("#benar").bind('keyup mouseup', function () {
            if($(this).val() > 50){
                $('#alertB').html('Maximal 50!');
                $('#benar').val(50);
                $('#salah').val(0);
                $('#poin').val(100);

            }else{
                var soal = 50 - $(this).val();
                $('#salah').val(soal);
                var total = $(this).val()*2;
                $('#poin').val(total);
                $('#alertB').html('');
            }
            
        });
        $("#salah").bind('keyup mouseup', function () {
            if($(this).val() > 50){
                $('#alertS').html('Maximal 50!');
                $('#benar').val(0);
                $('#poin').val(0);

            }else{
                var soal = 50 - $(this).val();
                $('#benar').val(soal);
                var total = soal*2;
                $('#poin').val(total);
                $('#alertS').html('');
            }
            
        });
        $("#poin").bind('keyup mouseup', function () {
            if($(this).val() > 100){
                $('#alertP').html('Maximal 100!');
                $('#benar').val(50);
                $('#salah').val(0);

                $('#poin').val(100);

            }else{
                var benar = $(this).val()/2;
                $('#benar').val(benar);
                var soal = 50-benar;
               
                $('#salah').val(soal);
                $('#alertP').html('');
            }
            
        });
    function getSiswa(tanggal){
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('administrator/getPartisipasi'); ?>",
            data:{tanggal:tanggal},
          
          
             beforeSend: function(){
                
                
                $('#siswa').html('');
              
               
   
            },
            success: function(resp){
            
              $('#siswa').html(resp);
            
             
              
              
            },
            complete: function() {
              
                
                 
                
            },
        });
    }
</script>
