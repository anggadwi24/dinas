<style type="text/css">
  .agenda { 
  color: white;
 }

/* Dates */
.agenda .agenda-date { width: 170px; }
.agenda .agenda-date .dayofmonth {
  width: 40px;
  color: white;
  font-size: 36px;
  line-height: 36px;
  float: left;
  text-align: right;
  margin-right: 10px; 
  text-align: left;
}
.agenda .agenda-date .shortdate {
  font-size: 0.75em; 
  text-align: left;
  padding-left: 60px;
  color: whitel
}


/* Times */
.agenda .agenda-time { width: 140px; } 
.agenda .dayofweek {
  color: white;
text-align: left;
padding-left: 60px;
margin-top: -10px;
}


/* Events */
.agenda .agenda-events {  } 
.agenda .agenda-events .agenda-event {  } 
 .sbm-1{
    background:rgba(255,255,255, 0.2);
  font-size: 50px;
  width: 800px;
  height: 150px;
  border:none;
  border-radius: 50px;
  font-family: Aurach;
  color: white;
  margin-bottom: 50px;

 }


</style>
<div class="container-fluid">
    <div class="row">

      <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full mx-auto">
        
        <div class="d-flex justify-content-center font-aur">
        <h2>KUIS</h2>
        </div>
        <div class="d-flex justify-content-center font-aur-h1">
        <form action="<?= base_url('kuis/start')?>" METHOD="POST">
          <input type="hidden" name="status" value="<?= $this->uri->segment('3')?>">
      <input type="submit" name="sbm" value="MULAI KUIS" class="sbm-1 bergetar">
       </form>
        </div>
        <div class="d-flex justify-content-center font-aur" style="margin-top: 50px;margin-bottom: 30px;">
           
            <div class="d-flex p-2">
              <center style=""><a  id="announce" style="text-decoration: none;color: white;" title="Info"><i class="fa fa-bullhorn fa-lg announce" style="font-size: 30px;"></i><br><span style="font-size: 30px!important;">PENGUGUMAN</span></a>
            </center>
          </div>
         

          </div>
      </div>

 
    </div>
    
  </div>
  <div class="container-fluid">
    <div class="row">

      <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full mx-auto">
        
        <div class="d-flex justify-content-center font-aur">
        <h2>SEJARAH ANDA</h2>
        </div>

        <div class="d-flex justify-content-center agenda font-aur" style="margin-bottom: 30px;position: relative;">
          <?php if($cek > 0){?>
             <table class="table table-condensed " style="color: white;">
                <thead>
                    <tr>
                        <th width="30%">Date</th>
                        <th>Benar</th>
                        <th>Salah</th>
                        <th>Poin</th>
                        <th>Status</th>
                        <th></th>

                       
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                      foreach($kuis->result_array() as $q)
                      {
                    ?>
                      <tr>
                          <td class="agenda-date" class="active">
                            <div class="dayofmonth"><?= date('d',strtotime($q['qp_date']))?></div>
                            <div class="dayofweek"><?= date('l',strtotime($q['qp_date']))?></div>
                            <div class="shortdate "><?= date('F, Y',strtotime($q['qp_date']))?></div>
                          </td>
                          <td><?= $q['qp_benar']?></td>
                          <td><?= $q['qp_salah']?></td>
                          <td><?= $q['qp_poin']?></td>
                          <td><?php if($q['qp_finish'] != NULL){echo "Selesai";}else{echo "Belum Selesai";}?></td>
                          <td><?php if($q['qp_tambahan']=='y'){echo "Poin Tambahan";}?></td>
                        </tr>
                    <?php     
                      }
                    ?>
                </tbody>
            </table>
        <?php }else{ echo "<h2>Tidak Ada History Kuis</h2>";}?>
                
        </div>
        
      </div>
      
    </div>
    
  </div>
  <div class="container-fluid">
    <div class="row">

      <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full mx-auto">
        
        <div class="d-flex justify-content-center font-aur">
        <h2>PERINGKAT 100 BESAR</h2>
        </div>

        <div class="d-flex justify-content-center agenda font-aur" style="margin-bottom: 30px;position: relative;">

             <table class="table table-condensed " style="color: white;">
                <thead>
                    <tr>
                        <th width="30%">Peringkat</th>
                        <th>Nama</th>
                        <th>Total Kuis</th>
                        <th>Total Poin</th>
                        <th>Hadiah</th>
                       

                       
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no=1;
                      foreach($board->result_array() as $b)
                      {
                      if($b['qp_status']=='50'){
                        if($b['rank'] == 1)
                        {
                          $hadiah ='500.000,-';
                        }
                        elseif($b['rank'] == 2 )
                        {
                          $hadiah ='200.000,-';
                        }elseif($b['rank'] >= 3 AND $b['rank'] <= 5){
                          $hadiah ='100.000,-';
                        }else{
                          $hadiah ='-';
                        }
                      }elseif($b['qp_status']=='80'){

                          if($b['rank'] == 1 )
                          {
                            $hadiah ='750.000,-';
                          }
                          elseif($b['rank'] == 2 )
                          {
                            $hadiah ='300.000,-';
                          }elseif($b['rank'] == 3 ){
                          
                            $hadiah ='200.000,-';
                          }elseif($b['rank'] >= 4 AND $b['rank'] <= 5 ){
                            $hadiah ='100.000,-';
                          }else{
                            $hadiah ='-';
                          }
                      }else{

                         if($b['rank'] == 1 )
                        {
                          $hadiah ='1.000.000,-';
                        }
                        elseif($b['rank'] == 2 )
                        {
                          $hadiah ='400.000,-';
                        }elseif($b['rank'] >= 3 AND $b['rank'] <= 5 ){
                          $hadiah ='200.000,-';
                        }else{
                          $hadiah ='-';
                        }
                    }
                    ?>
                      <tr>
                         <?php if( $this->session->id_konsumen == $b['id_konsumen']){?>
                          <td><b><?= $b['rank'];?></b></td>
                          <td><b><?= $b['nama_lengkap']?> (Anda)</b></td>
                          <td><b><?= $b['kuis_tot']?></b></td>
                          <td><b><?= $b['totalp']?></b></td>
                          <td><b><?= $hadiah;?></b></td>
                          <?php }else{ $tdk=1; ?>
                          <td><?= $b['rank'];?></td>
                          <td><?= $b['nama_lengkap']?></td>
                          <td><?= $b['kuis_tot']?></td>
                          <td><?= $b['totalp']?></td>
                          <td><?= $hadiah;?></td>
                        <?php }?>
                        </tr>
                        
                    <?php     
                     $no++; }
                    ?>
                    <?php if($tdk>0){ ?>
                          <tr>
                          <td><b><?= $rank?></b></td>
                          <td><b><?= $nama_lengkap?> (Anda)</b></td>
                          <td><b><?= $tot_kuis?></b></td>
                          <td><b><?= $poin?></b></td>
                          <td></td>
                          
                          </tr>
                        <?php }?>
                </tbody>
            </table>
      
                
        </div>
        
      </div>
      
    </div>
    
  </div>

  <div class="container-fluid" id="announceresult">
    <div class="row">

      <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full mx-auto">
        
        <div class="d-flex justify-content-center font-aur">
        <h3>PENGUGUMAN BULAN <?= strtoupper(bulan($an));?></h3>
        </div>

        <div class="d-flex justify-content-center agenda font-aur" style="margin-bottom: 30px;position: relative;">

             <table class="table table-condensed " style="color: white;">
                <thead>
                    <tr>
                        <th width="30%">Peringkat</th>
                        <th>Nama</th>
                        <th>Total Kuis</th>
                        <th>Total Poin</th>
                        <th>Hadiah</th>
                       

                       
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no=1;
                      foreach($announce->result_array() as $b)
                      {
                      if($b['qp_status']=='50'){
                        if($b['rank'] == 1)
                        {
                          $hadiah ='500.000,-';
                        }
                        elseif($b['rank'] == 2 )
                        {
                          $hadiah ='200.000,-';
                        }elseif($b['rank'] >= 3 AND $b['rank'] <= 5){
                          $hadiah ='100.000,-';
                        }else{
                          $hadiah ='-';
                        }
                      }elseif($b['qp_status']=='80'){

                          if($b['rank'] == 1 )
                          {
                            $hadiah ='750.000,-';
                          }
                          elseif($b['rank'] == 2 )
                          {
                            $hadiah ='300.000,-';
                          }elseif($b['rank'] == 3 ){
                          
                            $hadiah ='200.000,-';
                          }elseif($b['rank'] >= 4 AND $b['rank'] <= 5 ){
                            $hadiah ='100.000,-';
                          }else{
                            $hadiah ='-';
                          }
                      }else{

                         if($b['rank'] == 1 )
                        {
                          $hadiah ='1.000.000,-';
                        }
                        elseif($b['rank'] == 2 )
                        {
                          $hadiah ='400.000,-';
                        }elseif($b['rank'] >= 3 AND $b['rank'] <= 5 ){
                          $hadiah ='200.000,-';
                        }else{
                          $hadiah ='-';
                        }
                    }
                    ?>
                      <tr>
                         <?php if( $this->session->id_konsumen == $b['id_konsumen']){?>
                          <td><b><?= $b['rank'];?></b></td>
                          <td><b><?= $b['nama_lengkap']?> (Anda)</b></td>
                          <td><b><?= $b['kuis_tot']?></b></td>
                          <td><b><?= $b['totalp']?></b></td>
                          <td><b><?= $hadiah;?></b></td>
                          <?php }else{ $tdk=1; ?>
                          <td><?= $b['rank'];?></td>
                          <td><?= $b['nama_lengkap']?></td>
                          <td><?= $b['kuis_tot']?></td>
                          <td><?= $b['totalp']?></td>
                          <td><?= $hadiah;?></td>
                        <?php }?>
                        </tr>
                        
                    <?php     
                     $no++; }
                    ?>
                    
                </tbody>
            </table>
      
                
        </div>
        
      </div>
      
    </div>
    
  </div>
  <div class="overlay"></div>

  
<script>
  $(window).load(function() {
    $('#overlay').hide();
  });
</script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

<?php if($this->session->flashdata('message')){ ?>



<script type="text/javascript">
       Swal.fire({
  icon: '<i class="fas fas-stop" ></i>',
  title: 'Peringatan',
  text: '<?php echo $this->session->flashdata('message'); ?>',
   customClass: 'swal-wide',
   type: 'error',
  
})
</script>


<?php } ?>
