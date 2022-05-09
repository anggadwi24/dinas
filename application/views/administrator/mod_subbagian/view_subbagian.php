  
    <?php 
 $id = $this->session->id_session;
 $konten = '  <p class="mb-4"><a href="'.base_url("administrator/sub_bagian/add").'" class="btn btn-primary">Tambah Sub Bagian</a></p>';
 echo cek_session_konten('administrator/sub_bagian/add',$id,$konten);
  ?>
                   

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Sub Bidang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Bagian </th>
                                            <th>Sub Bagian</th>
                                            <th>Kepala Sub Bagian</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Bagian</th>
                                            <th>Sub Bagian</th>
                                            <th>Kepala Sub Bagian</th>
                                             <th>Action</th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1; foreach($record->result_array() as $row){?>

                                            <tr id="<?= $row[id_sub_bagian]?>">
                                                <td><?=$no;?></td>
                                                <td><?= ucfirst($row['nama_bagian']);?></td>
                                                 <td><?= ucfirst($row['nama_sub_bagian']);?></td>
                                                 <td><?= ucfirst($row['kepala_sub_bagian']);?> <small>(<?= $row['nip']?>)</small></td>
                                                <td>

                                                    <?= cek_session_konten('administrator/sub_bagian/edit',$id,' <a href="'.base_url('administrator/sub_bagian/edit/').$row['id_sub_bagian'].' " class="mr-1 btn btn-warning">EDIT</a>')?>
                                                 <?= cek_session_konten('administrator/sub_bagian/hapus',$id,' <button type="submit" class="btn btn-danger remove"> Hapus</button>')?>
                                              

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
                  text: "Data Sub Bagian Berhasil Dihapus",
                  type: 'success',
                }).then(function (result) {
                  if (true) {
                    window.location = "<?= base_url('administrator/sub_bagian/hapus/')?>"+id;
                  }
                })
  } else {
    // handle dismiss, result.dismiss can be 'cancel', 'overlay', 'close', and 'timer'
      swal(
                      'Cancel',
                      'Data Sub Bagian ini tidak terhapus',
                      'error'
                    )    
  }
})
     
    });
    
</script>