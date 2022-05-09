<?php 

                             $id = $this->session->id_session;
                             $u= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/editPartisipasi'")->num_rows();
                              $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/hapusPartisipasi'")->num_rows();
                             $link = 'administrator/addPartisipasi';
                              $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
?>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Partisipasi Quiz Siswa</h3>
                  <div class='row'>
                      <div class='col-6'>
                                <button type="button " class="btn btn-round btn-outline-secondary mt-3"  data-toggle="modal" data-target="#modalFilter" data-backdrop="static" data-keyboard="false"><i class="feather icon-search"></i></button>
                                <button type="button " class="btn btn-round btn-outline-secondary mt-3 ml-2" onClick=refresh()  ><i class="feather icon-refresh-cw"></i></button>

                      </div>
                      <div class='col-6'><?php if($c>0){?>
                  <a class='float-right btn mt-3 btn-outline-secondary' href='<?php echo base_url(); ?>administrator/addPartisipasi'><i class='feather icon-plus'></i> Tambah Partisipasi</a>
                <?php }?></div>
                  </div>
                  
                </div><!-- /.box-header -->
                <div class="card-body">
                 <div class="table-responsive" id='dataTable1'>
                 <div class="d-flex align-items-center"><strong>Loading...</strong><div class="spinner-border ml-auto" role="status" aria-hidden="true"></div></div>
                
                
              </div>
              </div>
            </div>

<div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id='formFilter'>
                    <div class='row'>
                        <div class='col-6 form-group'>
                            <label for="">Start Date</label>
                            <input type="date"  name='start' id='start' class="form-control" value='<?= date('Y-m-d') ?>'>
                        </div>
                        <div class='col-6 form-group'>
                            <label for="">End Date</label>
                            <input type="date"  name='end' id='end' class="form-control" value='<?= date('Y-m-d') ?>'>
                        </div>
                         <?php if($cabang == 'all'){?>
                        <div class="col-6 form-group">
                            <label for="">Sekolah</label>
                            <select name="cabang" id="cabang" class="form-control">
                                <option value="all">Semua</option>
                               <?php $sekolah = $this->model_app->view_where('subdomain',array('status'=>'sekolah'));
                                if($sekolah->num_rows() > 0){
                                    foreach($sekolah->result_array() as $skh){
                                        echo "<option value='".encode($skh['id_sd'])."'>".$skh['nama_cabang']."</option>";
                                    } 
                                }
                               ?>
                            </select>
                        </div> 
                        <?php }else{
                            echo "<input type='hidden' id='cabang' name='cabang' value='".encode($cabang)."'>";
                            }?>
                        <div class='col-6 form-group'>
                            <label for="">Kelas</label>
                            <select name="kelas" id="kelas" class='form-control'>
                                <option value="all">Semua</option>
                                <?php if($jenis == 'sekolah'){
                                    $get = $this->model_app->view_where('subdomain',array('id_sd'=>$cabang))->row_array();
                                    $jenis = $get['jenis_sekolah'];
                                    if($jenis == 'sd'){
                                        echo  "<option value='I'>I</option><option value='II'>II</option><option value='III'>III</option><option value='IV'>IV</option><option value='V'>V</option><option value='VI'>VI</option>";
                                    }else if($jenis == 'smp'){
                                        echo  "<option value='VII'>VII</option><option value='VII'>VII</option><option value='IX'>IX</option>";
                                    }else if($jenis == 'sma'){
                                        echo  "<option value='X'>X</option><option value='XI'>XI</option><option value='XII'>XII</option>";
                      
                                    }
                                }?>
                               

                            </select>
                        </div>
                        <div class='col-12 mt-2'>
                            <label for="">Siswa</label>
                            <select name="siswa" id="siswa" class='select2 form-control'>
                                <option value="all">Semua</option>
                                <?php 
                                $siswa = $this->model_app->view_where('siswa',array('active'=>'y'));
                                foreach($siswa->result_array() as $sis){
                                    echo "<option value='".$this->encrypt->encode($sis['id_siswa'],keys())."'>".nama($sis['nama_lengkap'])."</option>";
                                }

                                ?>
                                

                            </select>
                        </div>
                        <div class='col-12 mt-2 '>
                        <button type="button" class="btn btn-secondary float-right mx-2 " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary float-right">Filter </button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).on('change','#cabang',function(){
        var id = $(this).val();
        $.ajax({
            type:'POST',
            url:'<?= base_url('administrator/seeKelas') ?>',
            data:{id:id},
            success:function(resp){
                $('#kelas').html(resp);
            }
        })
    })
    $(document).on('change','#kelas',function(){
        var kelas = $(this).val();
        var sekolah = $('#cabang').val();
        console.log(kelas);
        console.log(sekolah);
            $.ajax({
                type:'POST',
                url:'<?= base_url('administrator/seeSiswa') ?>',
                data:{kelas:kelas,sekolah:sekolah},
                success:function(resp){
                    $('#siswa').html(resp);
                }
            })
        
        
    })
    var start = $('#start').val();
    var end = $('#end').val();
    var kelas = $('#kelas').val();
    var siswa = $('#siswa').val();
    var sekolah = $('#cabang').val();
    dataSiswa(start,end,kelas,siswa,sekolah);
    function refresh(){
        var start = $('#start').val();
        var end = $('#end').val();
        var kelas = $('#kelas').val();
        var siswa = $('#siswa').val();
    var sekolah = $('#cabang').val();

        dataSiswa(start,end,kelas,siswa,sekolah);
    }
    function dataSiswa(start,end,kelas,siswa,sekolah){
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('administrator/dataPartisipasi'); ?>",
            data:{start:start,end:end,kelas:kelas,siswa:siswa,sekolah:sekolah},
          
          
             beforeSend: function(){
                
                
                $('#dataTable1').html('<div class="d-flex align-items-center"><strong>Loading...</strong><div class="spinner-border ml-auto" role="status" aria-hidden="true"></div></div>');
              
               
   
            },
            success: function(resp){
            
              $('#dataTable1').html(resp);
              $('#table').DataTable({
                responsive: true
            });
             
              
              
            },
            complete: function() {
              
                
                 
                
            },
        });
    }
    $(document).on('submit', '#formFilter', function(e) {
         e.preventDefault();
         var start = $('#start').val();
        var end = $('#end').val();
        var kelas = $('#kelas').val();
        var siswa = $('#siswa').val();
        var sekolah = $('#cabang').val();

                dataSiswa(start,end,kelas,siswa,sekolah);

        $('#modalFilter').modal('hide');
      });
    $(document).on('click', '.btnEdit', function() {
          $('#loader').css('display','block');
           var id = $(this).attr('data-id');
    
            window.location.href='<?= base_url('administrator/editPartisipasi?id=') ?>'+id;
      });
    
       $(document).on('click', '.btnHapus', function() {
          $('#loader').css('display','block');
           var id = $(this).attr('data-id');
    
           swal({
                      title: 'Hapus Data',
                      text: 'Yakin menghapus data ini?',
                      type: 'success',
                      showCancelButton: true,
                      confirmButtonColor: '#DD6B55',
                      confirmButtonText: 'Hapus',
                      cancelButtonText: 'Tidak'
                    }).then(result => {
                     
                         $.ajax({
                          type:"POST",
                          url:'<?= base_url('administrator/hapusPartisipasi')?>',
                          data:"id="+id,
                          dataType:'json',
                          success: function(resp){
                              if(resp == true){
                                swal({

                                  title: 'Berhasil',
                                  text: 'Soal Berhasil Dihapus!',
                                   customClass: 'swal-wide',
                                   type:'succces',
                                  
                                }).then(function() {
                                     refresh()
                                });
                              }else{
                                swal({

                                  title: '404',
                                  text: 'Something error!',
                                   customClass: 'swal-wide',
                                   type:'error',
                                  
                                })
                              }
                          }
                        })
                     
          });
      });
</script>