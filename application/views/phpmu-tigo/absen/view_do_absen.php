
 <section id="about" class="about" style="padding: 0px !important">
      <div class="container-fluid" data-aos="fade-up" style="padding: 0px !important;">
         <?php $abs = $absen->row_array()?>
                 
                  <?php if($absen->num_rows() <= 0){
                  ?>
                   <form method="post" action="<?= base_url('pegawai/do_absen')?>" enctype="multipart/form-data" onsubmit="$('#loader').show();">
                     <div class="form-group">
                       
                          <script>    
                           $(document).ready(function() {
                                             
                            navigator.geolocation.getCurrentPosition(function(position) {  

                              var point = new google.maps.LatLng(position.coords.latitude, 
                                                                 position.coords.longitude);
                            
                              // console.log(position.coords.longitude);
                             
                             
                              $("#lat").val(position.coords.latitude);
                              $("#long").val(position.coords.longitude);

                              // Initialize the Google Maps API v3
                              var map = new google.maps.Map(document.getElementById('map'), {
                                 zoom: 15,
                                center: point,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                              });

                              // Place a marker
                              new google.maps.Marker({
                                position: point,
                                map: map
                              });
                            }, function (e) {
                                  Swal.fire({

                                      title: 'Alert',
                                      text: 'Anda Tidak Mengaktifkan Lokasi!',
                                       customClass: 'swal-wide',
                                       type:'error',
                                      
                                    }).then(function() {
                              window.location = "<?= base_url('pegawai/absensi')?>";
                          });
                              }, {
                                  enableHighAccuracy: true
                              });
                            });
                                               </script>
                                                <div id="map" class="col-12" style="height:200px;"></div>

                      </div>
                      <div class="form-group p-2 mt-4">
                        <div id="result"></div>
                        <label>Foto</label>
                        <div class="custom-file">
                          <input type="hidden" name="status" value="masuk">
                          <input type="file" name="foto" class="custom-file-input" id="validatedCustomFile" required accept="image/*" capture>
                          <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                          <input type="text" name="lat" id="lat" class="lat" >
                          <input type="text" name="long" id="long"  class="long" >
                       

                          
                        </div>
                       
                      </div>
                      <div class="form-group p-2 mt-4">
                        <label class="sr-only" for="inlineFormInputGroup">Username</label>
                           <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ket" id="inlineRadio1" value="absen" required>
                        <label class="form-check-label" for="inlineRadio1">Absen</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ket" id="inlineRadio2" value="dinas" required>
                        <label class="form-check-label" for="inlineRadio2">DL</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ket" id="inlineRadio3" value="tugas" required >
                        <label class="form-check-label" for="inlineRadio3">TL</label>
                      </div>
                       <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ket" id="inlineRadio4" value="wfh" required >
                        <label class="form-check-label" for="inlineRadio4">WFH</label>
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


                                        
                                             
                                            $(document).ready(function() {
                                             
                            navigator.geolocation.getCurrentPosition(function(position) {  

                              var point = new google.maps.LatLng(position.coords.latitude, 
                                                                 position.coords.longitude);
                              $("#lat1").val(position.coords.latitude);
                              $("#long1").val(position.coords.longitude);
                               var targetlat = <?= $target_lat?>;
                              var targetlong = <?= $target_long?>;
                            // console.log(getDistanceFromLatLonInKm(targetlat,targetlong,position.coords.latitude,position.coords.longitude))
                              if(getDistanceFromLatLonInKm(targetlat,targetlong,position.coords.latitude,position.coords.longitude) > 100){
                               Swal.fire({

                                      title: 'Alert',
                                      text: 'Lokasi anda terlalu jauh',
                                       customClass: 'swal-wide',
                                       type:'error',
                                      
                                    }).then(function() {
                              window.location = "<?= base_url('pegawai/absensi')?>";
                          });
                              }else{
                                console.log('bisa absen');
                              }

                              function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
                                  var R = 6371; // Radius of the earth in km
                                  var dLat = deg2rad(lat2-lat1);  // deg2rad below
                                  var dLon = deg2rad(lon2-lon1); 
                                  var a = 
                                    Math.sin(dLat/2) * Math.sin(dLat/2) +
                                    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
                                    Math.sin(dLon/2) * Math.sin(dLon/2)
                                    ; 
                                  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
                                  var d = R * c; // Distance in km
                                  return d*1000;
                                }

                                function deg2rad(deg) {
                                  return deg * (Math.PI/180)
                                }

                              // Initialize the Google Maps API v3
                              var map = new google.maps.Map(document.getElementById('map-canvas'), {
                                 zoom: 15,
                                center: point,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                              });

                              // Place a marker
                              new google.maps.Marker({
                                position: point,
                                map: map
                              });
                            }, function (e) {
                                  Swal.fire({

                                      title: 'Alert',
                                      text: 'Anda Tidak Mengaktifkan Lokasi!',
                                       customClass: 'swal-wide',
                                       type:'error',
                                      
                                    }).then(function() {
                              window.location = "<?= base_url('pegawai/absensi')?>";
                          });
                              }, {
                                  enableHighAccuracy: true
                              });
                            });
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
                 <input type="text" name="lat" id="lat1" >
                  <input type="text" name="long" id="long1" >
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

<script type="text/javascript">
  $('.lat').hide();
  $('.long').hide();
  $('#lat1').hide();
  $('#long1').hide();

  $('input[type=radio][name=ket]').change(function() {
    if (this.value == 'absen') {
         navigator.geolocation.getCurrentPosition(function(position) {  

                              var point = new google.maps.LatLng(position.coords.latitude, 
                                                                 position.coords.longitude);
                              $("#lat1").val(position.coords.latitude);
                              $("#long1").val(position.coords.longitude);
         
                               var targetlat = <?= $target_lat?>;
                               var targetlong = <?= $target_long?>;
                               var lokasi = new google.maps.LatLng(targetlat,targetlong);
                              // console.log(position.coords.latitude);
 console.log(getDistanceFromLatLonInKm(targetlat,targetlong,position.coords.latitude,position.coords.longitude));
                              if(getDistanceFromLatLonInKm(targetlat,targetlong,position.coords.latitude,position.coords.longitude) > 100){
                               Swal.fire({

                                      title: 'Alert',
                                      text: 'Lokasi anda terlalu jauh',
                                       customClass: 'swal-wide',
                                       type:'error',
                                      
                                    }).then(function() {
                              window.location = "<?= base_url('pegawai/absensi')?>";
                          });
                              }else{
                                console.log('bisa absen');
                              }
                            
                              function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
                                  var R = 6371; // Radius of the earth in km
                                  var dLat = deg2rad(lat2-lat1);  // deg2rad below
                                  var dLon = deg2rad(lon2-lon1); 
                                  var a = 
                                    Math.sin(dLat/2) * Math.sin(dLat/2) +
                                    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
                                    Math.sin(dLon/2) * Math.sin(dLon/2)
                                    ; 
                                  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
                                                                    var d = R * c; // Distance in km
                                  return d*1000;
                                }

                                function deg2rad(deg) {
                                  return deg * (Math.PI/180)
                                }
                                 }, function (e) {
                                  Swal.fire({

                                      title: 'Alert',
                                      text: 'Anda Tidak Mengaktifkan Lokasi!',
                                       customClass: 'swal-wide',
                                       type:'error',
                                      
                                    }).then(function() {
                              window.location = "<?= base_url('pegawai/absensi')?>";
                          });
                              }, {
                                  enableHighAccuracy: true
                              });
    }
    
});
</script>