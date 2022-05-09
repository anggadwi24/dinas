<?php

                  $foto_peg = $rows['foto'];
        
if($rows['telat']=='n'){
  $telat = "Datang Tepat Waktu";
}else{
  $telat = "Telat Datang";
}
 if($rows['pulang_awal']=='n'){
  $pulang = "Pulang Tepat Waktu";
}else{
  $pulang = "Pulang Lebih Awal";
}


if($rows['foto_keluar'] == "")
{
  $foto_keluar = "<h4>Tidak ada Foto</h4>";
}else{
  $foto_keluar = " <img src='".base_url('asset/foto_absen/').$rows['foto_keluar']."'' class='img-fluid'>";
}

if($rows['absen_keluar'] == NULL){
    $absen_keluar = "-- : --";
}else{
  $absen_keluar =date('H:i',strtotime($rows['absen_keluar']));
}

$absen_masuk =date('H:i',strtotime($rows['absen_masuk']));

?>





                  <p class="mb-4"><a href="<?= base_url('administrator/absen')?>" class="btn btn-primary">Kembali</a></p>

                  <!-- DataTales Example -->
                  <div class="row">
                    <div class="col-md-4">
                      <div class="card" >
                        <img class="card-img-top" src="<?= $foto_peg?>" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title"><?= $rows['nama_guru']?></h5>
                           <h6 class="card-subtitle mb-2 text-muted">No KTP : <?= $rows['nip']?></h6>
                          <p class="card-text float-right"><?= $rows['email']?></p>
                       
                        </div>
                         
                      </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Detail Absen</h6>
                            </div>
                            <div class="card-body">
                                  <form method="POST" action="<?= base_url('administrator/absen/edit')?>">
                               
                                   <div class="row">
                                        <input type="hidden" name="id" value="<?= $rows['id_absensi']?>">
                                         <input type="hidden" name="id_peg" value="<?= $rows['id_pegawai']?>">
                                       <div class="col-md-6">
                                           <div class="form-group">
                                             <input type="time" name="absen_masuk" value="<?= $absen_masuk?>" class="form-control" required>
                                               <label>Absen Masuk</label>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <input type="time" name="absen_keluar" value="<?= $absen_keluar?>" class="form-control" required>
                                               <label>Absen Keluar</label>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <input type="date" name="tgl" value="<?= $rows[tanggal]?>" class="form-control" readonly>
                                               <label>Tanggal Absen</label>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <select name="ket" class="form-control">
                                                  <option value="absen" <?php if($rows['ket']=='absen'){echo "selected";}?>>Absen</option>
                                                  <option value="dinas" <?php if($rows['ket']=='dinas'){echo "selected";}?>>Dinas</option>
                                                  <option value="tugas" <?php if($rows['ket']=='tugas'){echo "selected";}?>>Tugas</option>
                                               </select>
                                               <label>Keterangan</label>
                                           </div>
                                       </div>
                                      <div class="col-md-12 float-right">
                                        <input type="submit" name="submit" class="btn btn-primary float-right" value="UBAH">
                                      </div>
                                     </div>
                                     
                              </form>

                                   </div>
                              
                            </div>
                        </div>
                     </div>
             

                 