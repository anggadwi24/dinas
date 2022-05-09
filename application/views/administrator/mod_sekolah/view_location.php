  


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Absen Location</h6>
    </div>
    <div class="card-body">
           <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
        <form id="formAdd" method="post">
           <div class="row">
                <?php 
                    if($status == 'dinas'){
                        $sekolah = $this->model_app->view_where('subdomain',array('status'=>'sekolah'));

                        echo "<div class='col-12 form-group'>
                        
                                <label>Sekolah</label>
                                <select name='sekolah' id='sekolah' class='form-control'>
                                    <option disabled selected></option>
                                    ";
                                    if($sekolah->num_rows() > 0){
                                        foreach($sekolah->result_array() as $skh){
                                            echo "<option value='".encode($skh['id_sd'])."'>".$skh['nama_cabang']."</option>";
                                        }
                                    }
                                echo "
                                </select>
                        </div>";
                    }else{
                        echo "<input type='hidden' name='sekolah' value='".encode($cabang)."'>";
                    }
                
                ?>
                <div></div>
                 <input type="hidden" name="target_lat" id="target_lat">
               <input type="hidden" name="target_long" id="target_long">
      
               <div class="col-12">
                 <div class="form-group">
  
                    <div id="map" class="col-12" style="height:200px;"></div>
                 </div>
               </div>
              
               <div class="col-md-12">
                   <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
               </div>
           </div>
        </form>
    </div>
</div>
<script>    

$(document).ready(function() {
    $("#formAdd").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('administrator/updateLocation') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
           
         
            beforeSend: function(){
                
                $('#formAdd input').prop('disabled',true);
               

                $('#formAdd button').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#formAdd button').prop('disabled',true);
   
            },
             error:function(){
             
                 swal({

                  title: '404',
                  text: 'Something error!',
                   customClass: 'swal-wide',
                   type:'error',
                  
                })
               
            },
          
            success: function(resp){
               
              if(resp.status == true){
                
             
                


                swal({
                      title: 'Berhasil',
                      text: resp.msg,
                      type: 'success',
                     
                    })
              }else{
                swal({
                      title: 'Gagal',
                      text: resp.msg,
                      type: 'error',
                     
                    })
              }
               
            }, 
             complete: function() {
               $('#formAdd input').prop('disabled',false);
               

               $('#formAdd button').html('Simpan');
                $('#formAdd button').prop('disabled',false);
            },
        });
    });
    <?php 
    if($status == 'sekolah'){
        if($location->num_rows() > 0){
            $loc = $location->row_array();
            $lati = $loc['loc_latitude'];
            $longi = $loc['loc_longitude'];
        }else{
            $lati = '';
            $longi = '';
        }
        echo "map(".$lati.",".$longi.");";
    }
?>
    $(document).on('change','#sekolah',function(){
        var id = $(this).val();
        $.ajax({
            type:'POST',
            url:'<?= base_url('administrator/seeLocation') ?>',
            data:{id:id},
            dataType:'json',
            success:function(resp){
                map(resp.lati,resp.longi);
            }
        })
    })
    function map(lati,longi){
   
    navigator.geolocation.getCurrentPosition(function(position) {  


if(lati == '' && longi == ''){


        var point = new google.maps.LatLng(position.coords.latitude, 
                                        position.coords.longitude);
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        $("#target_lat").val(position.coords.latitude);
        $("#target_long").val(position.coords.longitude);
}else{
        var point = new google.maps.LatLng(lati, 
                                        longi);
        var lat = lati;
        var long = longi;
        $("#target_lat").val(lat);
        $("#target_long").val(long);
 
}
 


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
}
        
        });
                           </script>