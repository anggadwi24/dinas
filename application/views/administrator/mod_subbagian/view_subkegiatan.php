  
                  
                       <?php 
 $id = $this->session->id_session;
 $konten = '  <p class="mb-4"><a href="'.base_url("administrator/sub_kegiatan/add").'" class="btn btn-primary">Tambah Sub Kegiatan</a></p>';
 echo cek_session_konten('administrator/sub_kegiatan/add',$id,$konten);
  ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Sub Kegiatan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Bagian </th>
                                            <th>Sub Bagian</th>
                                            <th>Sub Kegiatan</th>
                                            <th>Kepala Biro</th>
                                            <th>PPTK</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                             <th width="5%">No</th>
                                            <th>Bagian </th>
                                            <th>Sub Bagian</th>
                                            <th>Sub Kegiatan</th>
                                            <th>Kepala Biro</th>
                                            <th>PPTK</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1; foreach($record->result_array() as $row){?>

                                            <tr id="<?= $row[id_sub_kegiatan]?>">
                                                <td><?=$no;?></td>
                                                <td><?= ucfirst($row['nama_bagian']);?></td>
                                                 <td><?= ucfirst($row['nama_sub_bagian']);?></td>
                                                 <td><?= ucfirst($row['nama_kegiatan']);?></td>
                                                 <td><?= ucfirst($row['nama_kb'])?></td>
                                                 <td><?= ucfirst($row['nama_pptk'])?></td>

                                                <td>
                                                       <?= cek_session_konten('administrator/sub_kegiatan/edit',$id,' <a href="'.base_url('administrator/sub_kegiatan/edit/').$row['id_sub_kegiatan'].' " class="mr-1 btn btn-warning">EDIT</a>')?>
                                                 <?= cek_session_konten('administrator/sub_kegiatan/hapus',$id,' <button type="submit" class="btn btn-danger remove"> Hapus</button>')?>

                                               

                                                 </td>
                                            </tr>
                                        <?php $no++; }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


<script type="text/javascript">
    $(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");
    
       swal({
  title: 'Apakah Anda Yakin?',
  text: 'Data ini akan terhapus permanen !',
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
                  text: "Data Sub Kegiatan Berhasil Dihapus",
                  type: 'success',
                }).then(function (result) {
                  if (true) {
                    window.location = "<?= base_url('administrator/sub_kegiatan/hapus/')?>"+id;
                  }
                })
  } else {
    // handle dismiss, result.dismiss can be 'cancel', 'overlay', 'close', and 'timer'
      swal(
                      'Cancel',
                      'Data Sub Kegiatan ini tidak terhapus',
                      'error'
                    )    
  }
})
     
    });
    
</script>