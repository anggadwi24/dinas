<?php 

                             $id = $this->session->id_session;
                             $u= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/editSoal'")->num_rows();
                              $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/hapusSoal'")->num_rows();
                             $link = 'administrator/addSoal';
                              $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();
?>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Daftar Soal</h3>
                  <?php if($c>0){?>
                  <a class='float-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/addSoal'>Tambahkan Soal</a>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="card-body">
                 <div class="table-responsive">
                                <table class="table table-bordered" id="default-datatable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Soal</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                       
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    $s= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/setSoal'")->num_rows();

                    foreach ($record as $row){
                      if($row['status'] == 'n'){
                        $bg = 'style="background-color:#ffacac;color:white"';
                        
                        if($s> 0){
                          $btn = "<button class='btn btn-warning btn-xs btnStatus ml-1' data-status='y' data-id='".$this->encrypt->encode($row['id_quiz'],keys())."'  title='Tampilkan Soal' ><span class='feather icon-eye' style='font-size:13px;'></span></button> ";
                        }
                        
                      }elseif($row['status']=='y'){
                        $bg = '';
                        if($s> 0){
                          $btn = "<button class='btn btn-warning btn-xs btnStatus ml-1' data-status='n' data-id='".$this->encrypt->encode($row['id_quiz'],keys())."'  title='Sembunyikan Soal' ><span class='feather icon-eye-off' style='font-size:13px;'></span></button> ";
                        }
                      }
                      $mapel = $this->model_app->view_where('mata_pelajaran',array('mapel_id'=>$row['mapel_id']))->row_array();
                      echo "<tr ".$bg.">

                          <td>$no</td>
                          <td>$row[quiz]</td>
                          <td>$row[kelas]</td>
                          <td>$mapel[mapel]</td>
                           <td><center>
                              ";
                              if($u>0){
                                echo "
                                <button class='btn btn-success btn-xs btnEdit' data-id='".$this->encrypt->encode($row['id_quiz'],keys())."'  title='Edit Data' ><span class='feather icon-edit' style='font-size:13px;'></span></button> ";
                            }
                            if($d >0){
                                echo "

                                <button class='btn btn-danger btn-xs btnHapus' data-id='".$this->encrypt->encode($row['id_quiz'],keys())."' title='Delete Data' ><span class='feather icon-trash' style='font-size:13px;'></span></button>

                                ";
                                }
                                echo $btn;
                                echo "
                              </center></td>

                      </tr>";
                    $no++;
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              </div>
            </div>

<script type="text/javascript">
    $(document).on('click', '.btnEdit', function() {
          $('#loader').css('display','block');
           var id = $(this).attr('data-id');
    
            window.location.href='<?= base_url('administrator/editSoal?id=') ?>'+id;
      });
     $(document).on('click', '.btnStatus', function() {
          $('#loader').css('display','block');
           var id = $(this).attr('data-id');
           var status = $(this).attr('data-status');
    
            window.location.href='<?= base_url('administrator/setSoal?id=') ?>'+id+'&status='+status;
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
                          url:'<?= base_url('administrator/hapusSoal')?>',
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
                                  location.reload();
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