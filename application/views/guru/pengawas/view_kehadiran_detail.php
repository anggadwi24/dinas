
<?php 
 if($row['ket'] == 'dinas'){
    $ket = 'DL';
   }elseif($row['ket']=='tugas'){
    $ket = 'TL';
   }else{
    $ket ="ABSEN";
   }

   if($row['telat'] == 'y')
   {
    $telat = "Terlambat";
   }else{
    $telat = "Datang Tepat Waktu";
   }

   if($row['pulang_awal'] == 'y'){
    $pulang = "Pulang Mendahului";
   }else{
    $pulang ="Pulang Tepat Waktu";
   }
   if($row['foto_keluar']=="" OR $row['absen_keluar'] == NULL){
    $foto_out =  "Tidak Ada";
    }else{
        $foto_out = "   <img src='". $row['foto_keluar']."'>";
    }  
?>
<div class="container">
    <div class="row justify-content-between my-3">
        <div class="col-11">
            <label for="">Nama Guru</label>
            <h6><?= $row['nama_guru'] ?></h6>
        </div>
        <div class="col-11 my-2">
            <label for="">Tanggal</label>
            <h6><?= date('d-m-Y',strtotime($row['tanggal']))?> </h6>
        </div>
        <div class="col-5 my-2">
            <label for="">Absen Masuk</label>
            <h6><?= date('H:i',strtotime($row['absen_masuk']))?> <small>(<?= $telat ?>)</small></h6>
        </div>
        <div class="col-5 my-2">
            <label for="">Absen Keluar</label>
            <h6>
                <?php 
                if($row['absen_keluar'] != NULL){echo date('H:i',strtotime($row['absen_keluar'])).' <small>('. $pulang.')</small>';}else{ echo "-";}?></h6>
        </div>
        <div class='col-11 my-2'>
            <label for="">Keterangan Absen</label>
            <h6><?= $ket?></h6>
        </div>
        <div class="col-6 form-group my-2">
            <h6>Foto Masuk</h6>
            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Buka</a>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                <img src="<?= $row['foto_masuk']?>">
                </div>
             </div>
        </div>
          <div class="col-6 form-group my-2">
            <h6>Foto Keluar</h6>
             <a data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">Buka</a>
            <div class="collapse" id="collapseExample1">
                <div class="card card-body">
                <?= $foto_out?>
                </div>
            </div>
          
        </div>
        <div class="col-12 form-group">
              <?php

                                              $lat_in = $row['latitude_in'];
                                              $long_in = $row['longitude_in'];

                                             

                                                $lat_out = $row['latitude_out'];
                                                $long_out = $row['longitude_out'];

                                           
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
                                         
                                           <div id="map-canvas" class="col-sm-12" style="height:250px;"></div>
</div>