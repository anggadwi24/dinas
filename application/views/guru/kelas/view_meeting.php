<section class="about">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
            <div class="col-12">
                
           
                <button class="btn btn-danger mx-1" type="button" data-toggle="collapse" data-target="#deskripsi" aria-expanded="false" aria-controls="collapseExample">
                    Deskripsi
                </button>
                <button class="btn btn-danger mx-1" type="button" data-toggle="collapse" data-target="#absensi" aria-expanded="false" aria-controls="collapseExample">Absensi</button>
      
                <button class="btn btn-danger mx-1" type="button" data-toggle="collapse" data-target="#hadir" aria-expanded="false" aria-controls="collapseExample">
                    Hadir
                </button>
            
                <button class="btn btn-danger mx-1" type="button" data-toggle="collapse" data-target="#alpha" aria-expanded="false" aria-controls="collapseExample">
                    Alpha
                </button>
            </div>
        </div>
        <div class="collapse show  multi-collapse" id="deskripsi">
            <div class="row my-3">
                <div class="col-12 form-group">
                    <h3>Deskripsi</h3>
                </div>
                <div class="col-12 form-group">
                    <label for="">Judul Pertemuan</label>
                    <h6><?= $row['rkm_title']?></h6>
                </div> 
                <div class="col-12 form-group">
                    <label for="">Deskripsi Pertemuan</label>
                    <h6><?= $row['rkm_desc']?></h6>
                </div> 
                <div class="col-6 form-group">
                    <label for="">Tanggal </label>
                    <h6><?= format_indo_1($row['rkm_date']) ?></h6>
                </div>
                <div class="col-6 form-group">
                    <label for="">Waktu</label>
                    <h6><?= date('H:i',strtotime($row['rkm_start']))." - ".date('H:i',strtotime($row['rkm_end'])) ?></h6>
                </div>
                <div class="col-12 form-group">
                    <?php if($row['rkm_url'] != ''){  ?>
                    <label for="">URL</label>
                    <a href="<?=$row['rkm_url'] ?>" target="_BLANK"><?= $row['rkm_url'] ?></a>
                    <?php }?>
                </div>
                
            </div>
        </div>
        <div class="collapse  multi-collapse mt-5" id="absensi">
            <form id="formAct">
                <div class="row">
                    <div class="col-12 form-group my-3"><h3>Absensi</h3></div>
                    <?php
                        $siswa = $this->model_app->join_where_order('ruang_kelas_siswa','siswa','rks_id_siswa','id_siswa',array('rks_rk_id'=>$row['rk_id'],'rks_approved'=>'y'),'nama_lengkap','ASC');
                        if($siswa->num_rows() > 0){
                            foreach($siswa->result_array() as $sis){
                                $cek = $this->model_app->view_where('ruang_kelas_meeting_partisipasi',array('rkmp_rkm_id'=>$row['rkm_id'],'rkmp_id_siswa'=>$sis['id_siswa']));
                                if($cek->num_rows() == 0){
                                    $checkY = '';
                                    $checkX = 'checked';
                                }else{
                                    $checkY = 'checked';
                                    $checkX = '';
                                }
                                    echo "<div class='col-12 form-group border'>
                                            <div class='row'>
                                                <div class='col-8'>
                                                    <label>Nama</label>
                                                    <h6>".$sis['nama_lengkap']."</h6>
                                                    <input type='hidden' name='siswa[]' value='".encode($sis['id_siswa'])."'>
                                                </div>
                                                <div class='col-2'>
                                                    <label  for='hadirY'>
                                                        Hadir
                                                    </label>
                                                    <input  type='radio' name='kehadiran-".$sis['id_siswa']."' id='hadirY' value='y' ".$checkY.">
                                                </div>
                                                <div class='col-2'>
                                                    <label for='hadirX'>
                                                        Tidak
                                                    </label>
                                                    <input type='radio' name='kehadiran-".$sis['id_siswa']."' id='hadirX' value='n' ".$checkX.">
                                                </div>
                                            </div>
                                        </div>";
                                
                               
                            }
                            echo "<input type='hidden' name='id' value='".encode($row['rkm_id'])."'>";
                            echo "<div class='col-12 form-group mt-3'><button class='btn btn-danger w-100'>SIMPAN</button></div>";
                           
                        }else{
                            echo "<div class='col-12 form-group'><h6>Belum ada siswa</h6></div>";
                        }
                    ?>
                    
                </div>
            </form>
        </div>
        <div class="collapse  multi-collapse" id="hadir">
            <div class="row my-3">
                <div class="col-12 form-group my-3"><h3>Siswa Hadir</h3></div>
               <?php 
                    $siswaH = $this->model_app->join_where_order('ruang_kelas_meeting_partisipasi','siswa','rkmp_id_siswa','id_siswa',array('rkmp_rkm_id'=>$row['rkm_id']),'nama_lengkap','ASC');

                    if($siswaH->num_rows() > 0){
                        foreach($siswaH->result_array() as $hdr){
                            echo "<div class='col-12 py-2 form-group border'><h6>".$hdr['nama_lengkap']."</h6></div>";

                        }
                    }else{
                        echo "<div class='col-12 form-group'><h6>Tidak ada siswa yang hadir</h6></div>";
                    }
               ?>
                
            </div>
        </div>
        <div class="collapse  multi-collapse" id="alpha">
            <div class="row my-3">
                <div class="col-12 form-group my-3"><h3>Siswa Tidak Hadir</h3></div>
               <?php 
                     $siswa = $this->model_app->join_where_order('ruang_kelas_siswa','siswa','rks_id_siswa','id_siswa',array('rks_rk_id'=>$row['rk_id'],'rks_approved'=>'y'),'nama_lengkap','ASC');
                     if($siswa->num_rows() > 0){
                         foreach($siswa->result_array() as $sis){
                             $cek = $this->model_app->view_where('ruang_kelas_meeting_partisipasi',array('rkmp_rkm_id'=>$row['rkm_id'],'rkmp_id_siswa'=>$sis['id_siswa']));
                             if($cek->num_rows() == 0){
                                    echo "<div class='col-12 py-2 form-group border'><h6>".$sis['nama_lengkap']."</h6></div>";
                             }
                        }
                    }else{
                        echo "<div class='form-group col-12'><h6>Tidak ada siswa</h6></div>";
                    }
               ?>
                
            </div>
        </div>
       
    </div>
</section>
<script>
    $(document).on('submit','#formAct',function(e){


e.preventDefault();
$.ajax({
  
    type: 'POST',
    url:"<?= base_url('guru/updatePartisipasiMeeting') ?>",

   
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    dataType :'json',
   
 
    beforeSend: function(){
        
        $('#formAct input').prop('disabled',true);
      
       

        $('#formAct button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
        $('#formAct button').prop('disabled',true);

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
        swal({
              title: 'Success',
              text: resp.msg,
              type: 'success',
             
            }).then(function() {
                   location.reload();
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
        
       $('#formAct input').prop('disabled',false);
       

       $('#formAct button').html('Simpan');
        $('#formAct button').prop('disabled',false);
    },
});
});
</script>