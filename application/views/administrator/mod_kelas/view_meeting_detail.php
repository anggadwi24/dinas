<?php 
    $mapel = $this->model_app->view_where('mata_pelajaran',array('mapel_id'=>$row['rk_mapel']))->row_array();
    $sekolah = $this->model_app->view_where('subdomain',array('id_sd'=>$row['rk_id_sd']))->row_array();
    $id = $this->session->id_session;
 $link = 'administrator/createMeeting';
    $guru = $this->model_app->view_where('guru',array('id_guru'=>$row['rk_id_guru']))->row_array();
  $c= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='$link'")->num_rows();

?>
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= strtoupper($row['rkm_title'])?></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mx-auto text-center">
                        <img src="<?= $row['rk_icon'] ?>" class="img-fluid rounded-circle" style="height:100px;width:100px;" alt="">
                    </div>
                    <div class="col-md-12 form-group mt-3 text-center">
                        <h5 title="Judul Kelas" class="mb-0 text-center"><?= $row['rk_title'] ?></h5>
                        <p title="Deskripsi Kelas"><?= $row['rk_desc'] ?></p>
                    </div>
                    <div class="col-md-12 form-group mt-3 text-center">
                        <h5 title="Judul Pertemuan" class="mb-0 text-center"><?= $row['rkm_title'] ?></h5>
                        <p title="Deskripsi Pertemuan"><?= $row['rkm_desc'] ?></p>
                    </div>
                    <div class="col-md-12 form-group mt-3 text-center">
                        <h5 title="Tanggal Pertemuan" class="mb-0 text-center"><?= format_indo_1($row['rkm_date']) ?></h5>
                        <p title="Jam Pertemuan"><?= date('H:i',strtotime($row['rkm_start'])) ?> - <?= date('H:i',strtotime($row['rkm_end'])) ?> </p>
                    </div>
                    <div class="col-md-12 form-group">
                        <h5 class="text-center" title="Mapel & Kelas & Gyry"><?= $mapel['mapel']?> / <?= $row['rk_kelas'] ?> - <?= $guru['nama_guru'] ?></h5>
                    </div>
                    <div class="col-md-12 form-group">
                        <?php if($row['rkm_url'] != ''){
                            echo "<h6>URL : </h6><a href='".$row['rkm_url']."' target='_BLANK'>".$row['rkm_url']."</a>";
                           }?>
                    </div>
                 
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Partisipasi Siswa</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="15%">No </th>
                                    <th>Siswa</th>
                                    <th>Jam Bergabung</th>
                                    <th>Jam Selesai</th>
                                   
                                    
                                    
                                </tr>
                            </thead>
                            
                            <tbody>
                    <?php $partisipasi = $this->model_app->view_where_ordering('ruang_kelas_meeting_partisipasi',array('rkmp_rkm_id'=>$row['rkm_id']),'rkmp_id','DESC');
                        if($partisipasi->num_rows() > 0){
                            $no =1;
                                foreach($partisipasi->result_array() as $rows){
                                    $sis = $this->model_app->view_where('siswa',array('id_siswa'=>$rows['rkmp_id_siswa']))->row_array();
                                    echo "<tr>
                                            <td>".$no."</td>
                                            <td>".$sis['nama_lengkap']."</td>
                                            <td>".date('H:i:s',strtotime($rows['rkmp_join_at']))."</td>
                                            <td>".date('H:i:s',strtotime($rows['rkmp_end_at']))."</td>

                                        </tr>";
                                    $no++;
                                }
                        }
                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>