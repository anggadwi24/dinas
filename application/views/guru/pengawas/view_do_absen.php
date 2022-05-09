 <section id="about" class="about" style="padding: 0px !important">
      <div class="container-fluid" data-aos="fade-up" style="padding: 0px !important;">
         <?php $abs = $absen->row_array()?>
                 
                  <?php if($absen->num_rows() <= 0){
                  ?>
                   <form method="post" action="<?= base_url('pegawai/do_absen')?>" enctype="multipart/form-data" onsubmit="$('#loader').show();">
                     <div class="form-group">
                       
                          <script>    


                                                
                                                     
                                                       var marker;
                                                       
                                                      function initialize() {  
                                                        
                                                        var lat =   document.getElementById("lat").value;
                                                          if(!lat){
                                                          lat = <?= $lat?>;
                                                           document.getElementById("lat").value = <?= $lat?>;
                                                         }
                                                         var long = document.getElementById("long").value;
                                                         if(!long)
                                                         {
                                                          long = <?= $long?>;
                                                          document.getElementById("long").value = <?= $long?>;

                                                         }
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
                                                           addMarker(lat, long, 'Lokasi anda');

                                                          // Proses membuat marker 
                                                          function addMarker(lat, long, info) {
                                                              var lokasi = new google.maps.LatLng(lat, long);
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
                                                <div id="map-canvas" class="col-12" style="height:200px;"></div>
                      </div>
                      <div class="form-group p-2 mt-4">
                        <label>Foto</label>
                        <div class="custom-file">
                          <input type="hidden" name="status" value="masuk">
                          <input type="file" name="foto" class="custom-file-input" id="validatedCustomFile" required accept="image/*" capture>
                          <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                          <input type="hidden" name="lat" id="lat"  >
                          <input type="hidden" name="long" id="long"  >
                          
                        </div>
                       
                      </div>
                      <div class="form-group p-2 mt-4">
                        <label class="sr-only" for="inlineFormInputGroup">Username</label>
                           <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ket" id="inlineRadio1" value="absen" checked>
                        <label class="form-check-label" for="inlineRadio1">Absen</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ket" id="inlineRadio2" value="dinas">
                        <label class="form-check-label" for="inlineRadio2">DL</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ket" id="inlineRadio3" value="tugas" >
                        <label class="form-check-label" for="inlineRadio3">TL</label>
                      </div>
                      </div>
                     

                     <div class="form-group p-2 mt-4">
                          <button type="submit" class="btn btn-warning text-light col-12 mt-2">MASUK</button>
                      </div>
                    </form>
                      <?php
              }elseif($absen->num_rows() > 0 AND $abs['absen_keluar']==""){
              ?>
                <form method="post" action="<?= base_url('pegawai/do_absen')?>" enctype="multipart/form-data"  >
                
               
                  <script>    


                                        
                                             
                                               var marker;
                                               
                                              function initialize() {  
                                                
                                                var lat1 =   document.getElementById("lat1").value;
                                                  if(!lat1){
                                                  lat1 = <?= $lat?>;
                                                  document.getElementById("lat1").value = <?= $lat?>
                                                 }
                                                 var long1 = document.getElementById("long1").value;
                                                 if(!long1)
                                                 {
                                                  long1 = <?= $long?>;
                                                  document.getElementById("long1").value = <?= $long?>
                                                 }
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
                                                   addMarker(lat1, long1, 'Lokasi anda');

                                                  // Proses membuat marker 
                                                  function addMarker(lat1, long1, info) {
                                                      var lokasi = new google.maps.LatLng(lat1, long1);
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
                                        <div id="map-canvas" class="col-12" style="height:200px;wi"></div>
              </div>
              <div class="form-group p-2 mt-4">
                <label>Foto</label>
                <div class="custom-file">
                  <?php $abs = $absen->row_array()?>
                  <input type="hidden" name="status" value="pulang">
                  <input type="hidden" name="id_absen" value="<?= $abs['id_absensi']?>">
                  <input type="file" name="foto" class="custom-file-input" id="validatedCustomFile" required accept="image/*" capture>
                  <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                 <input type="hidden" name="lat" id="lat1" >
                  <input type="hidden" name="long" id="long1" >
                </div>
               
              </div>
              
             <div class="form-group p-2 mt-4">
                  <button type="submit" class="btn btn-warning text-light col-12 mt-2">KELUAR</button>
              </div>
            </form>
             <?php
          }
         ?>
        
      
        
      </div>
  </section>
