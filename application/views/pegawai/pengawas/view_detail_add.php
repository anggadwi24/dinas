<style type="text/css">
  div.dropdown-menu.open { width: 100%; } ul.dropdown-menu.inner>li>a { white-space: initial; }
</style>
<?php 
        if($row['kode_rekening'] == NULL){
            $korek = "";
        }else{
            $korek = $row['kode_rekening'].'. ' ;
        }
        $thp = $this->model_app->view_where('tahap_add',array('id_tahap'=>$row['id_tahap']))->row_array();
?>
<section id="about" class="about">
    <div class="container" data-aos="fade-down">
        
         <form id="formAct">
        <div id="dataApp" class="row ">
            <div class="col-12 mb-3">
                <h3 class="text-center">TAHAP <?= $thp['tahap']?> TAHUN <?= $thp['tahun']?></h3>
            </div>
            <?php if($row['id_parent'] != NULL AND $row['id_sub_parent'] == NULL){?>
            <div class="col-12">
                <label>Bidang</label>
               
                    <?php $bidang = $this->model_app->view_where('alokasi_dana_desa',array('id_add'=>$row['id_parent']))->row_array();
                    if($bidang['kode_rekening'] == NULL){
                             $korekb = "";
                            }else{
                                $korekb = $bidang['kode_rekening'].'. ' ;
                            }
                         echo "<h6>".$korekb."".$bidang['uraian']."</h6>" ;
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
                <label>Uraian</label>
                <h6><?= $korek ?><?= $row['uraian']?></h6>
               
            </div>
             <?php if($row['volume_output'] != NULL){?>
            <div class="col-12">
                <label>Uraian Output</label>
                <h6><?= $row['uraian_output']?></h6>
               
            </div>
            <?php }?>
            <?php if($row['volume_output'] != NULL){?>
            <div class="col-12 mt-3">
                <label>Volume Output</label>
                 <h6><?= $row['volume_output']?></h6>
            </div>
            <?php } ?>
            <?php if($row['cara_pengadaan'] != NULL){?>
            <div class="col-12 mt-3">
                <label>Cara Pengadaan</label>
                 <h6><?= $row['cara_pengadaan']?></h6>
            </div>
            <?php } ?>
             <?php if($row['anggaran'] != NULL){?>
            <div class="col-4 mt-3">
                <label>Anggaran</label>
                 <h6><?= rupiah1($row['anggaran'])?></h6>
            </div>
            <?php } ?>
            <?php if($row['realisasi'] != NULL){?>
            <div class="col-4 mt-3">
                <label>Realisasi</label>
                 <h6><?= rupiah1($row['realisasi'])?></h6>
            </div>
            <?php } ?>
            <?php if($row['realisasi'] != NULL AND $row['anggaran'] != NULL){?>
            <div class="col-4 mt-3">
                <label>Sisa</label>
                 <h6><?= rupiah1($row['anggaran']-$row['realisasi'])?></h6>
            </div>
            <?php } ?>
             <?php if($row['kegiatan'] != 'parent'){?>
            <div class="col-4 mt-3">
                <label>Kegiatan</label>
                 <h6><?= strtoupper($row['kegiatan'])?></h6>
            </div>
            <div class="col-4 mt-3">
                <label>Persentase</label>
                 <h6><?= $row['capaian_output']?>%</h6>
            </div>
            <div class="col-12 mt-3">
                <label>Keterangan</label>
                 <h6><?= $row['keterangan']?></h6>
            </div>
            <div class="col-12 mt-2">
                <label>Proses Pencapaian</label>
            </div>
            <?php 
                $proses = $this->model_app->view_where_ordering('persentase_add',array('id_add'=>$row['id_add']),'id_pa','ASC');
                if($proses->num_rows() > 0){
                    foreach($proses->result_array() as $pRow){
                        if($pRow['status_laporan'] == 'y'){
                            echo "<div class='col-12 mt-2 detailPA' data-id='".$pRow['id_pa']."'>
                                        <div class='row'>
                                            <div class='col-2'><h3 class='text-success'>".$pRow['persentase']."%</h3></div>
                                            <div class='col-8'><h6 class='text-success'>".$pRow['keterangan']."</h6></div>
                                            <div class='col-2'><h3 class='text-success'><i class='ri-check-double-line'></i></h3></div>



                                        </div>
                                  </div>";
                        }elseif($pRow['status_laporan'] == 'p'){
                             echo "<div class='col-12 mt-2 detailPA' data-id='".$pRow['id_pa']."'>
                                        <div class='row'>
                                            <div class='col-2'><h3 class='text-warning'>".$pRow['persentase']."%</h3></div>
                                            <div class='col-8'><h6 class='text-warning'>".$pRow['keterangan']."</h6></div>
                                            <div class='col-2'><h3 class='text-warning'><i class='ri-time-line'></i></h3></div>



                                        </div>
                                  </div>";
                        }else{
                              echo "<div class='col-12 mt-2 detailPA' data-id='".$pRow['id_pa']."'>
                                        <div class='row'>
                                            <div class='col-2'><h3 class='text-danger'>".$pRow['persentase']."%</h3></div>
                                            <div class='col-8'><h6 class='text-danger'>".$pRow['keterangan']."</h6></div>
                                            <div class='col-2'><h3 class='text-danger'><i class='ri-close-line'></i></h3></div>



                                        </div>
                                  </div>";
                        }
                    }
                }else{
                     echo "<div class='col-12 mt-2' ><h6>Belum Ada Proses</h6></div>";
                }
            ?>
            <?php } ?>
           
            
            
           
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
      $(document).on('click', '.detailPA', function() {
          $('#loader').css('display','block');
          var id =  $(this).attr('data-id');
          
          window.location.href='<?= base_url('pengawas/detailPersentase?id=')?>'+id;
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