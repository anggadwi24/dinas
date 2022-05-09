 <section id="about" class="about" style="padding: 0px !important">
      <div class="container-fluid" data-aos="fade-up" style="padding: 0px !important;">
         <?php $abs = $absen->row_array()?>
                 
                  <?php if($absen->num_rows() <= 0){
                  ?>
                   <form method="post" action="<?= base_url('pegawai/do_absen')?>" enctype="multipart/form-data" onsubmit="$('#loader').show();">
                     <div class="form-group">
                       
                          <script>    
                               $(document).ready(function() {
                      navigator.geolocation.getCurrentPosition(function(position){ 
                          
                             $("#lat").val(position.coords.latitude);
                            $("#long").val(position.coords.longitude);
                          var lat = position.coords.latitude;
                          var long = position.coords.longitude;
                           var point = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
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
                             $("#lat").val(<?= $lat ?>);
                             $("#long").val(<?= $long ?>);
                             var lat = <?= $lat ?>;
                             var long = <?= $long?>;
                             console.log(lat);
                             console.log(long);
                             var point = new google.maps.LatLng(lat,long);
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
                        
                      
                            Swal.fire({

                                title: 'Alert',
                                text: 'Anda Tidak Mengaktifkan Lokasi!',
                                 customClass: 'swal-wide',
                                 type:'error',
                                
                              });
                        }, {
                            enableHighAccuracy: true
                        });

                     
                       
                       
                       });
                           // Initialize the Google Maps API v3
                                                  
                          </script>
                                                <div id="map-canvas" class="col-12" style="height:200px;"></div>
                      </div>
                      <div class="form-group p-2 mt-4">
                        <div id="result"></div>
                        <label>Foto</label>
                        <div class="custom-file">
                          <input type="hidden" name="status" value="masuk">
                          <input type="file" name="foto" class="custom-file-input" id="validatedCustomFile" required accept="image/*" capture>
                          <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                          <input type="text" name="lat" id="lat"  >
                          <input type="text" name="long" id="long" >
                         

                          
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
                               $(document).ready(function() {
                      navigator.geolocation.getCurrentPosition(function(position){ 
                          
                             $("#lat1").val(position.coords.latitude);
                            $("#long1").val(position.coords.longitude);
                          var lat = position.coords.latitude;
                          var long = position.coords.longitude;
                           var point = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
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
                             $("#lat1").val(<?= $lat ?>);
                             $("#long1").val(<?= $long ?>);
                             var lat = <?= $lat ?>;
                             var long = <?= $long?>;
                             console.log(lat);
                             console.log(long);
                             var point = new google.maps.LatLng(lat,long);
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
                        
                      
                            Swal.fire({

                                title: 'Alert',
                                text: 'Anda Tidak Mengaktifkan Lokasi!',
                                 customClass: 'swal-wide',
                                 type:'error',
                                
                              });
                        }, {
                            enableHighAccuracy: true
                        });
                      
                     
                       
                       
                       });
                           // Initialize the Google Maps API v3
                                                  
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
                 <input type="hidden" name="lat" id="lat1"  >
                  <input type="hidden" name="long" id="long1"  >
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
  $('#lat').hide();
  $('#long').hide();
  $('#lat1').hide();
  $('#long1').hide();
</script>