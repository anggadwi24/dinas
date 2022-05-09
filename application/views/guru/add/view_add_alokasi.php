<style type="text/css">
  div.dropdown-menu.open { width: 100%; } ul.dropdown-menu.inner>li>a { white-space: initial; }
</style>
<section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>FORM ADD</h2>
          <hr style="width: 50%;border-top: 3px solid #f9ad4a; "> 
        </div>
        <form id="formAdd">
          <div id="load_data" class="row" >
            <?php if($status == 'parent' AND $id_parent == 'null' AND $id_sub_parent == 'null'){?>
              <div class="col-12">
                <label>Kode Rekening</label>
                <select name="kode_rekening" class="form-control selectpicker" data-live-search=true title="Pilih Kode Rekening" id="kode_rekening" >
                 
                </select>
              </div>
              <div class="col-12 mt-3">
                <label>Uraian</label>
                <input type="text" name="uraian" class="form-control" required id="uraian">
                <input type="hidden" name="id_tahap" class="form-control"  value="<?= $tahap ?>">
                <input type="hidden" name="status" class="form-control"  value="<?= $status?>">
                <input type="hidden" name="id_parent" class="form-control"  value="<?= $id_parent?>">




              </div>
             
              <?php }elseif($status=='sub_parent' AND $id_sub_parent == 'null' AND $id_parent != ''){?>
                <div class="col-12">
                <label>Bidang</label>
                <select name="id_parent" class="form-control selectpicker" data-live-search=true title="Pilih Bidang" id="id_parent"  >
                 
                </select>
              </div>
              <div class="col-12 mt-3">
                <label>Kode Rekening</label>
                <select name="kode_rekening" class="form-control selectpicker" data-live-search=true title="Pilih Kode Rekening" id="kode_rekening1"  data-width="100%" data-container="body"> 
                 
                </select>
              </div>
              <div class="col-12 mt-3">
                <label>Uraian</label>
                <input type="text" name="uraian" class="form-control" required id="uraian">
                <input type="hidden" name="id_tahap" class="form-control"  value="<?= $tahap ?>">
                <input type="hidden" name="status" class="form-control"  value="<?= $status?>">
                <input type="hidden" name="id_parent" class="form-control"  value="<?= $id_parent?>">




              </div>
              <div class="col-12" id='formNonSub'>
                <div class="row">
                  <div class="col-12 mt-3">
                    <label>Urauan Output</label>
                    <input type="text" name="uraian_output" class="form-control" >
                  </div>
                  <div class="col-12 mt-3">
                    <label>Volume Output</label>
                    <input type="text" name="volume_output" class="form-control" >
                  </div>
                  <div class="col-12 mt-3">
                    <label>Cara Pengadaan</label>
                    <input type="text" name="cara_pengadaan" class="form-control" >
                  </div>
                  <div class="col-12 mt-3">
                    <label>Anggaran</label>
                    <input type="text" name="anggaran" class="form-control currency" id="rupiah" >
                  </div>
                  <div class="col-12 mt-3">
                    <label>Kegiatan</label>
                    <br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="inlineCheckbox1" value="fisik" name="kegiatan" checked>
                      <label class="form-check-label" for="inlineCheckbox1">Fisik</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="inlineCheckbox2" value="nonfisik" name="kegiatan">
                      <label class="form-check-label" for="inlineCheckbox2">Non Fisik</label>
                    </div>
                  </div>
                </div>
              </div>
              <?php }else{?>
              <div class="col-12">
                <label>Bidang</label>
                <select name="id_parent" class="form-control selectpicker" data-live-search=true title="Pilih Bidang" id="id_parent1"  data-width="100%">
                 
                </select>
              </div>
              <div class="col-12">
                <label>Sub Bidang</label>
                <select name="id_sub_parent" class="form-control selectpicker" data-live-search=true title="Pilih Sub Bidang" id="id_sub_parent"  data-width="100%">
                 
                </select>
              </div>
              <div class="col-12 mt-3">
                <label>Kode Rekening</label>
                <select name="kode_rekening" class="form-control selectpicker" data-live-search=true title="Pilih Kode Rekening" id="kode_rekening2"  data-width="100%" data-container="body"> 
                 
                </select>
              </div>
              <div class="col-12 mt-3">
                <label>Uraian</label>
                <input type="text" name="uraian" class="form-control" required id="uraian">
                <input type="hidden" name="id_tahap" class="form-control"  value="<?= $tahap ?>">
                <input type="hidden" name="status" class="form-control"  value="<?= $status?>">
                <input type="hidden" name="id_parent" class="form-control"  value="<?= $id_parent?>">
                <input type="hidden" name="id_sub_parent" class="form-control"  value="<?= $id_sub_parent?>">





              </div>
              <div class="col-12" >
                <div class="row">
                  <div class="col-12 mt-3">
                    <label>Uraian Output</label> 
                    <input type="text" name="uraian_output" class="form-control" required >
                  </div>
                  <div class="col-12 mt-3">
                    <label>Volume Output</label> 
                    <input type="text" name="volume_output" class="form-control" required >
                  </div>
                  <div class="col-12 mt-3">
                    <label>Cara Pengadaan</label> 
                    <input type="text" name="cara_pengadaan" class="form-control" required>
                  </div>
                  <div class="col-12 mt-3">
                    <label>Anggaran</label>
                    <input type="text" name="anggaran" class="form-control currency" id="rupiah" required>
                  </div>
                  <div class="col-12 mt-3">
                    <label>Kegiatan</label>
                    <br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="inlineCheckbox1" value="fisik" name="kegiatan" checked>
                      <label class="form-check-label" for="inlineCheckbox1">Fisik</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="inlineCheckbox2" value="nonfisik" name="kegiatan">
                      <label class="form-check-label" for="inlineCheckbox2">Non Fisik</label>
                    </div>
                  </div>
                </div>
              </div>
              <?php }?>
               <div class="col-12 mt-3">
                <button class="btn btn-outline-success w-100" id='btnAdd'> <i class="ri-add-line"></i> TAMBAH</button>
              </div>
          </div>
        </form>
        
      </div>
  </section>
  <script type="text/javascript">
    $('#formNonSub').hide();
    $('#id_parent').change(function(){
             var itemSelectorOption = $('#kode_rekening1 option');
            itemSelectorOption.remove(); 
          var id_parent = $('#id_parent :selected').attr('data-kode');
          var id_tahap = '<?= $tahap ?>';
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('pegawai/selectKodeRekening'); ?>",
            data:{id_parent:id_parent,id_tahap:id_tahap},
            success: function(response){
              $('#kode_rekening1').html(response);
               $("#kode_rekening1").selectpicker('refresh');
            }
          })
        })
    $('#id_parent1').change(function(){
             var itemSelectorOption = $('#id_sub_parent option');
            itemSelectorOption.remove(); 
          var id_parent = $('#id_parent1').val();
          var id_sub_parent = '<?=$id_sub_parent?>';

          var id_tahap = '<?= $tahap ?>';
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('pegawai/selectSubParent'); ?>",
            data:{id_parent:id_parent,id_tahap:id_tahap,id_sub_parent:id_sub_parent},
             dataType:'json',
            success: function(resp){
              $('#id_sub_parent').html(resp.output);
              console.log(resp.id_sub_parent);
            
                 $('#id_sub_parent').val(resp.id_sub_parent).change();

              $("#id_sub_parent").selectpicker('refresh');
               $('#id_sub_parent').selectpicker("val", resp.id_sub_parent);
            }
          })
        })
    $('#id_sub_parent').change(function(){
             var itemSelectorOption = $('#kode_rekening2 option');
            itemSelectorOption.remove(); 
          var id_sub_parent = $('#id_sub_parent :selected').attr('data-kode');
          var id_tahap = '<?= $tahap ?>';
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('pegawai/selectKodeRekening1'); ?>",
            data:{id_sub_parent:id_sub_parent,id_tahap:id_tahap},
            success: function(response){
              $('#kode_rekening2').html(response);
               $("#kode_rekening2").selectpicker('refresh');
            }
          })
        })
    dataParent();
    function dataParent(){
      var id_tahap = '<?= $tahap?>';
      var id_parent ='<?= $id_parent ?>';

       $.ajax({
          
            type: 'POST',
            url: '<?= base_url('pegawai/selectParent')?>',
            data:{id_tahap:id_tahap,id_parent:id_parent},
            dataType:'json',
            success: function(resp){
             


              $('#id_parent').html(resp.output);
              $('#id_parent').val(resp.id_parent).change();

              $("#id_parent").selectpicker('refresh');
               $('#id_parent').selectpicker("val", resp.id_parent);

                $('#id_parent1').html(resp.output);
              $('#id_parent1').val(resp.id_parent).change();

              $("#id_parent1").selectpicker('refresh');
               $('#id_parent1').selectpicker("val", resp.id_parent);
            }

          });
    }

     dataBidang();
    function dataBidang(){
      var id_tahap = '<?= $tahap?>';

       $.ajax({
          
            type: 'POST',
            url: '<?= base_url('pegawai/selectBidang')?>',
            data:{id_tahap:id_tahap},
            success: function(resp){
             
              $('#kode_rekening').html(resp);
               $("#kode_rekening").selectpicker('refresh');
            }

          });
    }
    $('#kode_rekening').change(function(){
          var rek = $('#kode_rekening :selected').attr('data-text');
          
          $('#uraian').val(rek);
        })
    $('#kode_rekening2').change(function(){
          var rek = $('#kode_rekening2 :selected').attr('data-text');
          
          $('#uraian').val(rek);
        })
     $('#kode_rekening1').change(function(){
          var val = $(this).val();
          if(val == 'null'){
          $('#uraian').val('');
          $('#formNonSub').show();
             $('#formNonSub input').prop('required',true);

          }else{
             var rek = $('#kode_rekening1 :selected').attr('data-text');
             $('#formNonSub input').prop('required',false);
             $('#formNonSub').hide();
          
            $('#uraian').val(rek);
          }
         
        })
    $("#formAdd").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url: '<?= base_url('pegawai/doAddAlokasiDanaDesa')?>',
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
               
              if(resp == true){
                dataBidang();
                 $('#kode_rekening option:selected').remove();
                 $('#uraian').val('');
                     swal({
                      title: 'Alokasi Dana Desa Berhasil Diinput',
                      text: 'Tetap dihalaman ini atau kembali?',
                      type: 'success',
                      showCancelButton: true,
                      confirmButtonColor: '#DD6B55',
                      confirmButtonText: 'Kembali',
                      cancelButtonText: 'Tetap'
                    }).then(result => {
                      if (result.value) {
                        // handle confirm
                        window.location ='<?= base_url('pegawai/detailAlokasiDanaDesa?tahap=').$tahap ?>'
                      } else {
                        // handle dismiss, result.dismiss can be 'cancel', 'overlay', 'close', and 'timer'
                        
                      }
                    });
              }
               
            }, 
             complete: function() {
                $('#loader').css('display','none');
              
                $('#btnAdd').prop('disabled',false);
            },
        });
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