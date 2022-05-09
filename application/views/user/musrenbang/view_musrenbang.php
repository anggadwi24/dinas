 
<style type="text/css">
  #overlay{ 
  
  top: 30px;
  position: fixed;
  z-index: 100;
  width: 100%;
  height:100%;
  display: none;
  background: rgba(0,0,0,0.0);
}
.cv-spinner {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;  
}
.spinner {
  width: 40px;
  height: 40px;
  border: 4px #ddd solid;
  border-top: 4px #2e93e6 solid;
  border-radius: 50%;
  animation: sp-anime 0.8s infinite linear;
}
@keyframes sp-anime {
  100% { 
    transform: rotate(360deg); 
  }
}
.is-hide{
  display:none;
}
</style>
 <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2><?= $judul ?></h2>
          <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
          
        </div>
     
        <div class="row justify-content-center" >
           
            <div class="form-group col-lg-4 col-12" >
              
              <select class="form-control" name="skpd" id="skpd">
                <option disabled >SKPD</option>
                  <option value="all" <?php  if($skpd == 'all'){echo "selected"; }?> >Semua</option>
                <?php foreach ($skpdd->result_array() as $row):
                  if($skd == $row['id_skpd']){
                    echo "<option value='".$row['id_skpd']."' selected>".$row['skpd']."</option>";
                  }else{
                    echo "<option value='".$row['id_skpd']."'>".$row['skpd']."</option>";
                  }
                  
                 ?>
                  
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group col-lg-3 col-12" >
              
              <select class="form-control" name="kecamatan" id="kec">
                  <option disabled>Kecamatan</option>
                  <option value="all" <?php  if($kecamatan == 'all'){echo "selected"; }?>>Semua</option>
                <?php foreach ($kec->result_array() as $row): 
                  if($kecamatan == $row['id_kec']){
                     echo "<option value='".$row['id_kec']."' selected>".$row['nama']."</option>";
                  }else{
                     echo "<option value='".$row['id_kec']."'>".$row['nama']."</option>";
                  }
                 
                  ?>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group col-lg-3 col-12" >
            
              <select class="form-control" name="kecamatan" id="kel">
                  <option disabled>Kelurahan</option>
                  <option value="all" <?php  if($kelurahan == 'all'){echo "selected"; }?>>Semua</option>
                 <?php if($kecamatan != 'all'){
                                  $kel = $this->model_app->view_where_ordering('kelurahan',array('id_kec'=>$kecamatan),'nama','ASC');
                                  foreach($kel->result_array() as $row){
                                    if($row['id_kel'] == $kelurahan){
                                       echo "<option value='".$row['id_kel']."' selected>".$row['nama']."</option>";
                                    }else{
                                       echo "<option value='".$row['id_kel']."' >".$row['nama']."</option>";
                                    }
                                  }

                              }?>
              </select>
            </div>

           
            <div class="col-lg-2 col-12 form-group ">
             
              <input type="submit" name="filter" class="btn btn-primary w-100" value="Filter" id="filter">
            </div>

        </div>
         <div id="overlay">
          <div class="cv-spinner">
            <span class="spinner"></span>
          </div>
        </div>
        <div class="row">
        <div class="col-12" id="load_data">

        </div>
        
        </div>
       
                
      
        
      </div>
  </section>

  <script type="text/javascript">
    jQuery(function($){
 
    
  $('#filter').click(function(){
     $(document).ajaxSend(function() {
    $("#overlay").fadeIn(300);　
  });
        var skpd = $('#skpd').val();
        var kec = $('#kec').val();
        var kel  = $('#kel').val();
        $.ajax({
        url:"<?php echo base_url(); ?>home/getMusrenbang",
        method:"POST",
        data:{skpd:skpd,kec:kec,kel:kel},
        
        success:function(data)
        {
            $('#load_data').html(data);
        }
    }).done(function() {
      setTimeout(function(){
        $("#overlay").fadeOut(300);
      },500);
    });
  }); 
});
  </script>