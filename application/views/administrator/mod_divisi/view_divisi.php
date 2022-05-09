   <?php 
 $id = $this->session->id_session;
 $konten = '  <p class="mb-4"><a href="'.base_url("administrator/bagian/add").'" class="btn btn-primary">Tambah Bidang</a></p>';

  ?>
  
  <?=  cek_session_konten('administrator/bagian/add',$id,$konten);?>
                  

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Bidang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Bagian</th>
                                            <th>Kepala Bagian</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Bagian</th>
                                            <th>Kepala Bagian</th>
                                             <th>Action</th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1; foreach($bagian->result_array() as $row){?>

                                            <tr id="<?= $row[id_bagian]?>">
                                                <td><?=$no;?></td>
                                                 <td><?= ucfirst($row['nama_bagian']);?></td>
                                                 <td><?= ucfirst($row['kepala_bagian']);?> <small>( <?= $row['nip']?> )</small></td>
                                               <td>
                                                <?= cek_session_konten('administrator/bagian/edit',$id,' <a href="'.base_url('administrator/bagian/edit/').$row['id_bagian'].' " class="mr-1 btn btn-warning">EDIT</a>')?>
                                                 <?= cek_session_konten('administrator/bagian/hapus',$id,' <button type="submit" class="btn btn-danger remove"> Hapus</button>')?>
                                              

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
  title: 'Apakah Anda Yakin??',
  text: 'Jika anda menghapus data bagian ini, maka sub bagian ikut terhapus!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#DD6B55',
  confirmButtonText: 'Yes!',
  cancelButtonText: 'No.'
}).then(result => {
  if (result) {
    // handle confirm
    swal({
                  title: 'Berhasil',
                  text: "Data Bagian Berhasil Dihapus",
                  type: 'success',
                }).then(function (result) {
                  if (true) {
                    window.location = "<?= base_url('administrator/bagian/hapus/')?>"+id;
                  }
                })
  } else {
    // handle dismiss, result.dismiss can be 'cancel', 'overlay', 'close', and 'timer'
      swal(
                      'Cancel',
                      'Data bagian ini tidak terhapus',
                      'error'
                    )    
  }
})
     
    });
    
</script>