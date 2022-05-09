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
 <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <form id="formAdd">
        <div id="load_data" class="row" >
            <?php 
              if($row['status'] == 'p'){
            ?>

              <?php 
               $last = $this->db->query("SELECT * FROM persentase_add WHERE id_add = '".$row['id_add']."' AND status_laporan = 'y' ORDER BY id_pa DESC LIMIT 1 ");
                  if($last->num_rows() > 0){
                    $lRow = $last->row_array();
                    $val = $lRow['persentase'];
                  }else{
                    $val = 0;
                  }
                  $add = $this->model_app->view_where('alokasi_dana_desa',array('id_add'=>$this->encrypt->decode($id,$key)))->row_array();
                if($row['kegiatan'] == 'fisik'){
                 
                
                ?>
                <div class="col-12">
                  <label>Keterangan</label>
                  <input type="text" name="keterangan" class="form-control" >
                </div>
                <div class="col-12 mt-2">
                  <label>Foto Laporan</label>
                  <input type="file" name="file" class="form-control" required accept="image/*" >
                </div>
                <div class="col-12 mt-2">
                  <label class="d-block">Persentase</label>
                  <input type="range" id="persentase" name="persentase" step="1" value="<?= $val?>" min="1" max="100" class="form-range">
                  <div id="rangeValue" class="float-right"></div>
                </div>
                <?php if($add['realisasi'] == NULL){?>
                 <div class="col-12 mt-3">
                  <label>Realisasi</label>
                  <input type="text" name="realisasi" class="form-control " id="rupiah" value="" >
                  <small>*Kosongkan jika belum ada</small>
                </div>
                <?php }?>
                <div class="col-12 mt-5">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" value="y">
                      <label class="form-check-label" for="exampleCheck1">Selesai</label>
                    </div>

                </div>
                <div class="col-12 mt-3"  style="display: none;" id="frmOutput">
                  <label>Output (qty) </label>
                  <input type="text" name="output" class="form-control" value="" >
                </div>
                <input type="hidden" name="kegiatan" value="fisik">
                <?php     
                }elseif($row['kegiatan'] == 'nonfisik'){

                  if($lRow['persentase'] < 30){
                    $bg = 'progress-bar-danger';
                    $persn = 30;
                    $ket = 'Penyelesaian kertas kerja/kerangka acuan kerja yang memuat latar belakang, tujuan, lokasi, target/sasaran, dan anggaran';
                     $req = "";
                     $text = "";
                  }else if($lRow['persentase'] >= 30 AND $lRow['persentase'] < 50 ){
                    $bg = 'progress-bar-warning';
                    $persn = 50;
                    $ket = 'Undangan pelaksanaan kegiatan, daftar peserta pelatihan dan konfirmasi pengajar';
                     $req = "";

                  }else if($lRow['persentase'] >= 50 AND $lRow['persentase'] < 80 ){
                    $bg = 'progress-bar-info';
                    $persn = 80;
                    $ket = 'Kegiatan telah terlaksana';
                    $req = "";
                     $text = "";



                  }else if($lRow['persentase'] >= 80  ){
                    $bg = 'progress-bar-success';
                    $persn = 100;
                    $ket = 'aporan pelaksanaan kegiatan dan foto';
                    $req = "required";
                    $text = '  <div class="col-12 mt-3">
                  <label>Output (qty) </label>
                  <input type="text" name="output" class="form-control" value="" >
                </div>';


                  }
                ?>
                <div class="col-12 ">
                  <div class="progress">
                    <div class="progress-bar <?= $bg ?> progress-bar-striped active" role="progressbar" aria-valuenow="<?= $lRow['persentase'] ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $lRow['persentase'] ?>%">
                     <?= $lRow['persentase'] ?>
                    </div>
                  </div>
                </div>
                <div class="col-12 mt-3">
                  <label>Keterangan</label>
                  <input type="text" name="keterangan" class="form-control" value="<?= $ket ?>" >
                </div>
                <div class="col-12 mt-2">
                  <label>Foto Laporan</label>
                  <input type="file" name="file" class="form-control" <?= $req ?> accept="image/*" >
                </div>
                <?php if($add['realisasi'] == NULL){?>
                 <div class="col-12 mt-3">
                  <label>Realisasi</label>
                  <input type="text" name="realisasi" class="form-control " id="rupiah" value="" >
                  <small>*Kosongkan jika belum ada</small>
                </div>
                <?php }?>
                <input type="hidden" name="kegiatan" value="nonfisik">

                <input type="hidden" name="persentase" value="<?= $persn?>">
                <?= $text ?>
                <?php 
                }
                
                ?>
                <input type="hidden" name="id_add" value="<?= $id?>">
                <div class="col-12 mt-3">
                  <button class="btn btn-outline-info w-100" id="btnAdd">PROSES</button>
                </div>
            <?php 
              }elseif($row['status'] =='y'){

              }
            ?>
        </div>
        </form>
                
        <div id="dataProses" class="row mt-4"></div>
        
      </div>
  </section>
  <script type="text/javascript">
    dataProses();
     function dataProses(){
      var id_add = '<?= $id?>';

       $.ajax({
          
            type: 'POST',
            url: '<?= base_url('pegawai/dataProses')?>',
            data:{id_add:id_add},
            success: function(resp){
             
              $('#dataProses').html(resp);
             
            }

          });
    }
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
      $("#formAdd").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url: '<?= base_url('pegawai/doAddProses')?>',
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
                  Swal.fire({

                  title: 'Berhasil',
                  text: 'Proses Alokasi Dana Desa Berhasil Diajukan!',
                   customClass: 'swal-wide',
                   type:'success',
                  
                }).then(function() {
                    window.location = "<?= base_url('pegawai/detailAlokasiDanaDesa?tahap=').$tahap?>";
                });

              }else{
                 Swal.fire({

                  title: 'Gagal',
                  text: 'Foto Gagal diupload',
                   customClass: 'swal-wide',
                   type:'error',
                  
                })
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