<style type="text/css">
  input[type="range"] {
 -webkit-appearance:none !important;
 width: 20rem;
 height:2px;
 background:#7E6D57;
 border:none;
 outline:none;
}
input[type="range"]::-webkit-slider-thumb {
 -webkit-appearance:none !important;
 width:30px;
 height:30px;
 background:#fcfcfc;
 border:2px solid #7E6D57;
 border-radius:50%;
 cursor:pointer;
}
input[type="range"]::-webkit-slider-thumb:hover {
 background:#7E6D57;
}
</style>
<?php
    
    if($row['persentase'] > 99){
        $status = 'y';
        $btn = 'SELESAI';
    }else if($row['persentase'] <= 99){
        $status = 'n';
        $btn = 'APPROVE';

    }
?>
<section id="about" class="about">
    <div class="container" data-aos="fade-down">
        
         <form id="formAct">
        <div id="dataApp" class="row ">
            <?php if($row['id_parent'] != NULL AND $row['id_sub_parent'] == NULL){?>
            <div class="col-12">
                <label>Bidang</label>
               
                    <?php $bidang = $this->model_app->view_where('alokasi_dana_desa',array('id_add'=>$row['id_parent']))->row_array();
                         echo "<h6>".$bidang['uraian']."</h6>" ;
                    ?>
                    
                
            </div>
            <?php } else if($row['id_parent'] != NULL AND $row['id_sub_parent'] != NULL){?>
                <div class="col-12">
                <label>Bidang</label>
              
                    <?php $bidang = $this->model_app->view_where('alokasi_dana_desa',array('id_add'=>$row['id_parent']))->row_array();
                         echo "<h6>".$bidang['uraian']."</h6>" ;
                    ?>
                    
               
            </div>
                <div class="col-12">
                <label>Sub Bidang</label>
               
                    <?php $sub = $this->model_app->view_where('alokasi_dana_desa',array('id_add'=>$row['id_sub_parent']))->row_array();
                           echo "<h6>".$sub['uraian']."</h6>" ;
                    ?>
                    
                
            </div>
            <?php }?>
             <div class="col-12">
                <label>Uraian </label>
                <h6><?= $row['uraian'] ?></h6>
               
            </div>
            <div class="col-12">
                <label>Uraian Output</label>
                <h6><?= $row['uraian_output'] ?></h6>
               
            </div>
            <div class="col-6">
        
                
                  <label class="d-block">Persentase</label>
                  <h2><?= $row['persentase']?>%</h2>
               
            </div>
            <?= $row['reali']?>
              <?php if($row['reali'] != NULL){?>
                <div class="col-12 mt-3">
                <label>Realisasi</label>
                <h6><?= rupiah1($row['reali'])?></h6>
               
                
            </div>
            <?php }?>
             <div class="col-12">
                <label>Keterangan</label>
                <h6><?= $row['keterangan_p'] ?></h6>
               
            </div>
             <?php if($row['output'] != NULL){?>
                <div class="col-12 mt-3">
                <label>Output</label>
                <h6><?= $row['output']?></h6>
            </div>
            <?php }?>
            <?php if($row['foto_laporan'] != NULL){?>
                <div class="col-12 mt-3">
                <label class="d-block">Foto Laporan</label>
                <img src="<?= base_url('asset/foto_proses/').$row['foto_laporan']?>" class="img-fluid lazyload" >
            </div>
            <?php }?>
          

            
            <div class="col-12 mt-3">
                 <input type="hidden" name="realisasi" value="<?= $row['reali']?>">
                <input type="hidden" name="id_add" value="<?= $row['id_add']?>">
                <input type="hidden" name="id_pa" value="<?= $row['id_pa']?>">
                <input type="hidden" name="status" value="<?= $status?>">
                <input type="hidden" name="persentase" value="<?= $row['persentase']?>">
                
                <input type="hidden" name="output" value="<?= $row['output']?>">




                <?php if($row['app_pengawas'] == NULL){?>
                <button class="btn btn-outline-primary w-100"><?= $btn ?></button>
                <button class="btn btn-outline-danger mt-3 w-100 cancel" data-id='<?= $row['id_pa']?>' type="button">TOLAK</button>
                <?php }?>
            </div>
        </div>
        </form>
    </div>
</section>
<script type="text/javascript">
        var persentage = $('#persentase').val();
    $('#rangeValue').html($('#persentase').val()+'%');
     $(document).on('input', '#persentase', function() {
          var per = $('#persentase').val();
          $('#rangeValue').html(per+'%');
      });
      $(document).on('change', '#persentase', function() {
          var per = $('#persentase').val();
          if(per == 100){
            $('#frmOutput').css('display','block');
            $('#output').prop('required',true);
            $('#exampleCheck1').attr('checked',true);
          }else{
            $('#frmOutput').css('display','none');
            $('#output').prop('required',false);
            $('#exampleCheck1').attr('checked',false);

          }
          $('#rangeValue').html(per+'%');
      });
       $('#exampleCheck1').change(function () {
        if ($(this).is(':checked')) {
            $('#persentase').val(100);
            $('#rangeValue').html('100%');
            $('#frmOutput').css('display','block');
            $('#output').prop('required',true)
        } else {
            $('#persentase').val(persentage);
            $('#rangeValue').html(persentage+'%');
            $('#frmOutput').css('display','none');
            $('#output').prop('required',false)

        }
      });

         $("#formAct").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url: '<?= base_url('pengawas/appPersentaseADD')?>',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
           
         
            beforeSend: function(){
                
                $('#loader').css('display','block');
                $('#btnAdd').prop('disabled',true);
   
            },
             error:function(){
             
                 Swal.fire({

                  title: '404',
                  text: 'Something error!',
                   customClass: 'swal-wide',
                   type:'error',
                  
                })
               
            },
          
            success: function(resp){
               
              window.location = resp;
               
            }, 
             complete: function() {
                $('#loader').css('display','none');
              
                $('#btnAdd').prop('disabled',false);
            },
        });
    });
      $(".cancel").click(function(){
        var id = $(this).attr("data-id");
       

        
       swal({
  title: 'Anda akan menolak capaian alokasi dana ini',
  text: '',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#DD6B55',
  confirmButtonText: 'Yes!',
  cancelButtonText: 'No.'
}).then(result => {
  if (result.value) {
    // handle confirm
    swal({
                  title: 'Berhasil',
                  text: "Data  Berhasil ditolak",
                  type: 'success',
                }).then(function (result) {
                  if (true) {
                     $.ajax({
          
            type: 'POST',
            url: '<?= base_url('pengawas/cancelPersentase')?>',
            data: {id:id},
           
           
         
            beforeSend: function(){
                
                $('#loader').css('display','block');
                $('button').prop('disabled',true);
   
            },
             error:function(){
             
                 Swal.fire({

                  title: '404',
                  text: 'Something error!',
                   customClass: 'swal-wide',
                   type:'error',
                  
                })
               
            },
          
            success: function(resp){
               
              window.location = resp;
               
            }, 
             complete: function() {
                $('#loader').css('display','none');
              
                $('button').prop('disabled',false);
            },
            });
                  }
                })
  } else {
    // handle dismiss, result.dismiss can be 'cancel', 'overlay', 'close', and 'timer'
    
  }
})
     
    });
</script>
 <script type="text/javascript">
    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah.value = formatRupiah(this.value);
    });
 
    /* Fungsi formatRupiah */
    function formatRupiah(angka){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
 
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return  rupiah;
    }
  </script>