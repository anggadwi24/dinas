  
                    <p class="mb-4"><a href="<?= base_url('administrator/sub_kegiatan')?>" class="btn btn-primary">Kembali</a></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Sub Kegiatan</h6>
                        </div>
                        <div class="card-body">
                               <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
                            <form action="<?= base_url('administrator/sub_kegiatan/edit')?>" method="post">
                               <div class="row">
                                <div class="col-md-6">
                                  <?php $sel = $this->db->query("SELECT * FROM bagian a JOIN sub_bagian b ON a.id_bagian = b.id_bagian WHERE b.id_sub_bagian = $rows[id_sub_bagian]")->row_array();?>
                                       <div class="form-group">
                                           <label>Bagian</label>
                                           <select name="bagian" class="form-control" required id="bagian">
                                            <option >-- Pilih Bagian -- </option>
                                            
                                            <?php $sel = $this->db->query("SELECT * FROM bagian a JOIN sub_bagian b ON a.id_bagian = b.id_bagian WHERE b.id_sub_bagian = $rows[id_sub_bagian]")->row_array();?>
                                             <?php foreach($bagian->result_array() as $row){
                                              if($sel['id_bagian'] == $row['id_bagian']){

                                                echo "<option value='".$row['id_bagian']."' selected>".$row['nama_bagian']."</option>";
                                              }
                                              else{
                                                 echo "<option value='".$row['id_bagian']."'>".$row['nama_bagian']."</option>";
                                              }
                                             }?>

                                           </select>
                                       </div>
                                   </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Sub Bagian</label>
                                          <select name="sub_bagian" class="form-control" required id="sub">
                                              <option >-- Pilih Sub Bagian --</option>
                                              <?php $sub = $this->model_app->view_where('sub_bagian',array('id_bagian'=>$sel['id_bagian']));?>
                                               <?php foreach($sub->result_array() as $row){
                                              if($rows['id_sub_bagian'] == $row['id_sub_bagian']){

                                                echo "<option value='".$row['id_sub_bagian']."' selected>".$row['nama_sub_bagian']."</option>";
                                              }
                                              else{
                                                 echo "<option value='".$row['id_sub_bagian']."'>".$row['nama_sub_bagian']."</option>";
                                              }
                                             }?>
                                              
                                          </select>
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Nama  Kegiatan</label>
                                           <input type="text" name="nama_kegiatan" class="form-control" required value="<?= $rows['nama_kegiatan']?>">
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Kepala Biro</label>
                                           <select name="kepalabiro" class="form-control" required >
                                            <option >-- Pilih Kepala Biro -- </option>
                                             <?php foreach($kepalabiro as $row){
                                                if($rows['id_kb'] == $row['id_kb']){
                                                   echo "<option value='".$row['id_kb']."' selected>".$row['nama']."</option>";
                                                }else{
                                                   echo "<option value='".$row['id_kb']."'>".$row['nama']."</option>";
                                                }
                                               
                                             }?>

                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>PPTK</label>
                                           <select name="pptk" class="form-control" required >
                                            <option >-- Pilih PPTK -- </option>
                                             <?php foreach($pptk as $row){
                                               if($rows['id_pptk'] == $row['id_pptk']){
                                                 echo "<option value='".$row['id_pptk']."' selected>".$row['nama']."</option>";
                                               }
                                               else{
                                                 echo "<option value='".$row['id_pptk']."'>".$row['nama']."</option>";
                                               }
                                               
                                             }?>

                                           </select>
                                       </div>
                                   </div>
                                     <input type="hidden" name="target_lat" id="target_lat">
                                   <input type="hidden" name="target_long" id="target_long">
                          
                                   <div class="col-12">
                                     <div class="form-group">
                                       <script>    
                           $(document).ready(function() {
                                             
                            navigator.geolocation.getCurrentPosition(function(position) {  


                              <?php if($rows['target_long'] == "" OR $rows['target_lat'] == ""){?>
                              var point = new google.maps.LatLng(position.coords.latitude, 
                                                                 position.coords.longitude);
                                var lat = position.coords.latitude;
                              var long = position.coords.longitude;
                              $("#target_lat").val(position.coords.latitude);
                              $("#target_long").val(position.coords.longitude);
                              <?php }else{?>
                                 var point = new google.maps.LatLng(<?= $rows['target_lat']?>, 
                                                                 <?= $rows['target_long']?>);
                                var lat = <?= $rows['target_lat']?>;
                                var long =  <?= $rows['target_long']?>;
                                $("#target_lat").val(lat);
                                $("#target_long").val(long);
                               
                              <?php }?>
                               
                            
                              
                              var marker;
                              var infowindow;
                              var mapCanvas = document.getElementById("map");
                              var myCenter=new google.maps.LatLng(lat,long);
                              var mapOptions = {
                                        center: myCenter, zoom: 15,
                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                    };
                              var map = new google.maps.Map(mapCanvas, mapOptions);
                               marker = new google.maps.Marker({
                                            position: point,
                                            map: map,
                                        });
                                        var circle = new google.maps.Circle({
                                          map: map,
                                          radius: 100,    // 10 miles in metres
                                          fillColor: '#AA0000'
                                        });
                                        circle.bindTo('center', marker, 'position');
                              myMap(lat,long);

                              // Initialize the Google Maps API v3


                              

                                function myMap(lat,long) {
                                    
                                    google.maps.event.addListener(map, 'click', function(event) {
                                        placeMarker(map, event.latLng);
                                    });
                                }

                                function placeMarker(map, location) {
                                    if (!marker || !marker.setPosition) {
                                        marker = new google.maps.Marker({
                                            position: location,
                                            map: map,
                                        });
                                        var circle = new google.maps.Circle({
                                          map: map,
                                          radius: 100,    // 10 miles in metres
                                          fillColor: '#AA0000'
                                        });
                                        circle.bindTo('center', marker, 'position');
                                    } else {
                                        marker.setPosition(location);
                                    }
                                    if (!!infowindow && !!infowindow.close) {
                                        infowindow.close();
                                    }
                                    infowindow = new google.maps.InfoWindow({
                                        content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()

                                    }); 
                                    $("#target_lat").val(location.lat());
                                     $("#target_long").val(location.lng());
                                    infowindow.open(map,marker);
                                }


                              // Place a marker
                              
                            }, function (e) {
                                  Swal.fire({

                                      title: 'Alert',
                                      text: 'Anda Tidak Mengaktifkan Lokasi!',
                                       customClass: 'swal-wide',
                                       type:'error',
                                      
                                    }).then(function() {
                              window.location = "<?= base_url('administrator/home')?>";
                          });
                              }, {
                                  enableHighAccuracy: true
                              });
                            });
                                               </script>
                                                <div id="map" class="col-12" style="height:200px;"></div>
                                     </div>
                                   </div>
                                   <input type="hidden" name="id" value="<?= $rows['id_sub_kegiatan']?>">
                                   <div class="col-md-12">
                                       <input type="submit" name="submit" value="UBAH" class="btn btn-primary">
                                   </div>
                               </div>
                            </form>
                        </div>
                    </div>
