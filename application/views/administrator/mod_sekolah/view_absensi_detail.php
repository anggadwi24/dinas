<?php


                  $foto_peg = $row['foto'];

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
  $foto_keluar = " <img src='".$rows['foto_keluar']."'' class='img-fluid'>";
}
if($rows['foto_masuk'] == "")
{
  $foto_masuk = "<h4>Tidak ada Foto</h4>";
}else{
  $foto_masuk = " <img src='".$rows['foto_masuk']."'' class='img-fluid'>";
}
if($rows['absen_keluar'] == NULL){
    $absen_keluar = "-- : --";
}else{
  $absen_keluar =date('H:i',strtotime($rows['absen_keluar']));
}

?>





                  <p class="mb-4"><a href="<?= base_url('administrator/absen')?>" class="btn btn-primary">Kembali</a></p>

                  <!-- DataTales Example -->
                  <div class="row">
                    <div class="col-md-4">
                      <div class="card" >
                        <img class="card-img-top" src="<?= $foto_peg?>" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title"><?= $row['nama_guru']?></h5>
                           <h6 class="card-subtitle mb-2 text-muted">No NIP : <?= $row['nip']?></h6>
                          <p class="card-text float-right"><?= $row['email']?></p>
                       
                        </div>
                        <div class="card-footer">
                          <?php 
                           $id = $this->session->id_session;
                         $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/hapusabsen'")->num_rows();
                          $u= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/editabsen'")->num_rows();
                    ?>
                    <?php if($u > 0){?>
                          <a href="<?= base_url('administrator/absen/edit?id=').encode($rows[id_absensi])?>" class="card-link m-2 float-left">Edit Absen</a>
                        <?php }?>
                        <?php if($d > 0){?>
                           <a href="<?= base_url('administrator/absen/hapus?id=').encode($rows[id_absensi])?>" class="card-link m-2 float-right">Hapus Absen</a>
                         <?php }?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Detail Absen</h6>
                            </div>
                            <div class="card-body">
                                 
                               
                                   <div class="row">
                                   
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <h3><?= date('H:i',strtotime($rows['absen_masuk']))?></h3>
                                               <label>Absen Masuk</label>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <h3><?= $absen_keluar?></h3>
                                               <label>Absen Keluar</label>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <h3><?= format_indo($rows['tanggal'])?></h3>
                                               <label>Tanggal Absen</label>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <h3><?= ucfirst($rows['ket'])?></h3>
                                               <label>Keterangan</label>
                                           </div>
                                       </div>
                                        <div class="col-md-6">
                                           <div class="form-group">
                                               <h3><?= $telat?></h3>
                                               <label>Datang</label>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <h3><?= $pulang?></h3>
                                               <label>Pulang</label>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                         <div class="form-group">
                                           <h6>Foto Masuk</h6>
                                           <?= $foto_masuk?>
                                         </div>
                                       </div>
                                       <div class="col-md-6">
                                         <div class="form-group">
                                           <h6>Foto Keluar</h6>
                                            <?= $foto_keluar ?>
                                         </div>
                                       </div>
                                       <div class="col-md-12">

                                        <?php

                                            $lat_in = $rows['latitude_in'];
                                            $long_in = $rows['longitude_in'];

                                           

                                              $lat_out = $rows['latitude_out'];
                                            $long_out = $rows['longitude_out'];

                                         
                                         ?>
                                         <script>    

                                            var marker;
                                            function initialize() {  
                                                // Variabel untuk menyimpan informasi (desc)
                                                var infoWindow = new google.maps.InfoWindow;
                                                //  Variabel untuk menyimpan peta Roadmap
                                                var mapOptions = {
                                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                                } 
                                                // Pembuatan petanya
                                                var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);      
                                                // Variabel untuk menyimpan batas kordinat
                                                var bounds = new google.maps.LatLngBounds();
                                                // Pengambilan data dari database
                                             <?php echo ("addMarker($lat_in, $long_in, 'absen masuk');\n");?>
                                            <?php if($lat_out != "" AND $long_out != ""){?>
                                            <?php echo ("addMarker($lat_out, $long_out, 'absen keluar');\n");?>
                                            <?php }?>

                                                // Proses membuat marker 
                                                function addMarker(lat, lng, info) {
                                                    var lokasi = new google.maps.LatLng(lat, lng);
                                                    bounds.extend(lokasi);
                                                    var marker = new google.maps.Marker({
                                                        map: map,
                                                        position: lokasi
                                                    });       
                                                    map.fitBounds(bounds);
                                                    bindInfoWindow(marker, map, infoWindow, info);
                                                 }        
                                                // Menampilkan informasi pada masing-masing marker yang diklik
                                                function bindInfoWindow(marker, map, infoWindow, html) {
                                                    google.maps.event.addListener(marker, 'click', function() {
                                                    infoWindow.setContent(html);
                                                    infoWindow.open(map, marker);
                                                  });
                                                }
                                            }
                                            google.maps.event.addDomListener(window, 'load', initialize);
                                        </script>
                                       
                                         <div id="map-canvas" class="col-sm-12" style="height:380px;"></div>
                                          
                                       </div>
                                     </div>
                                     
                              

                                   </div>
                              
                            </div>
                        </div>
                     </div>
             

                 