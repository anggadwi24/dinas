<style type="text/css">
  div.dropdown-menu.open { width: 100%; } ul.dropdown-menu.inner>li>a { white-space: initial; }
</style>
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
                <label>Uraian Output</label>
                <textarea class="form-control" name="uraian" required><?= $row['uraian'] ?></textarea>
               
            </div>
            <div class="col-12">
                <label>Uraian Output</label>
                <textarea class="form-control" name="uraian_output" required><?= $row['uraian_output'] ?></textarea>
               
            </div>
            <div class="col-12 mt-3">
                <label>Volume Output</label>
                <input type="text" name="volume_output" value="<?= $row['volume_output'] ?>" class="form-control" required >
            </div>
            <div class="col-12 mt-3">
                <label>Cara Pengadaan</label>
                <input type="text" name="cara_pengadaan" value="<?= $row['cara_pengadaan'] ?>" class="form-control" required >
            </div>
            <div class="col-12 mt-3">
                <label>Anggaran</label>
                <input type="text" name="anggaran" id="rupiah" value="<?= rupiah1($row['anggaran']) ?>" class="form-control" required >
            </div>
            
            <div class="col-12 mt-3">
                    <label>Kegiatan</label>
                    <br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="inlineCheckbox1" value="fisik"  name="kegiatan" <?php if($row['kegiatan']=='fisik'){echo"checked";}?> >
                      <label class="form-check-label" for="inlineCheckbox1">Fisik</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="inlineCheckbox2" value="nonfisik" name="kegiatan" <?php if($row['kegiatan']=='nonfisik'){echo"checked";}?>>
                      <label class="form-check-label" for="inlineCheckbox2">Non Fisik</label>
                    </div>
            
            </div>
            <div class="col-12 mt-3">
                <input type="hidden" name="id_add" value="<?= $row['id_add']?>">
                <button class="btn btn-outline-primary w-100">APPROVE</button>
                <button class="btn btn-outline-danger mt-3 w-100 cancel" data-id='<?= $row['id_add']?>' type="button">TOLAK</button>

            </div>
        </div>
        </form>
    </div>
</section>
<script type="text/javascript">
    $("#formAct").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url: '<?= base_url('pengawas/appAlokasiDanaDesa')?>',
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
  title: 'Anda akan menolak alokasi dana ini',
  text: 'Data akan terhapus',
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
                  text: "Data  Berhasil Dihapus",
                  type: 'success',
                }).then(function (result) {
                  if (true) {
                     $.ajax({
          
            type: 'POST',
            url: '<?= base_url('pengawas/cancelAlokasiDanaDesa')?>',
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