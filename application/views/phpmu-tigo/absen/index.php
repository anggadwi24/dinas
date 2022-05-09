
<section class="features-icons bg-light text-center absen">
    
<div class="container">

<h2>Absensi</h2>
    <p class="lead">
        Absen tiap jamnya untuk mendapatkan hadiah uang tunai
    </p>
    <?php if($this->session->flashdata('message')){ ?>
    <div class="alert alert-warning">
        <h4>Warning</h4>
        <p><?= $this->session->flashdata('message'); ?></p>
    </div>
   <?php }?>

    <?php   
   
    $now = date('H:i:s');
    $count = date('Y-m-d').' '.$now;

    ?> 

    <?php if(!isset($check) OR $check['next'] <= $count  ){ ?>
    <form action="<?= base_url('absen/absen_in') ?>" methd="post">
    <center><button class="btn btn-primary btn-lg">Absen</button></center>
    </form>
    <?php }else{?>
      <span>Absen Selanjutnya : <p id="demo"></p></span>
    <?php }?>
    <hr />

   <style type="text/css">
     .agenda {  }

/* Dates */
.agenda .agenda-date { width: 170px; }
.agenda .agenda-date .dayofmonth {
  width: 40px;
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
}


/* Times */
.agenda .agenda-time { width: 140px; } 
.agenda .dayofweek {
text-align: left;
padding-left: 60px;
margin-top: -10px;
}


/* Events */
.agenda .agenda-events {  } 
.agenda .agenda-events .agenda-event {  } 

@media (max-width: 767px) {
    
}
   </style>

   <div class="agenda">
        <div class="table-responsive">
            <table class="table table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tanggal->result_array() as $tgl){ ?>

                        <tr>
                          <td class="agenda-date" class="active" rowspan="<?= $tgl['jumlah'];?>">
                            <div class="dayofmonth"><?= date('d',strtotime($tgl['date']))?></div>
                            <div class="dayofweek"><?= date('l',strtotime($tgl['date']))?></div>
                            <div class="shortdate text-muted"><?= date('F, Y',strtotime($tgl['date']))?></div>
                          </td>
                          <td class="agenda-time"><?= $tgl['absen']?></td>
                        </tr>
                        <?php if($tgl['jumlah']>0){ ?>
                          <?php foreach($absensi->result_array() as $abs)
                          { 
                            if($tgl['absen'] != $abs['absen_in'] AND $tgl['date'] == $abs['date']){
                          ?>
                           <tr>
                              <td class="agenda-time">
                                  <?= $abs['absen_in']?>
                              </td>
                             
                          </tr>
                          <?php     

                            }

                          }


                          ?>
                        <?php }?>
                    <?php }?>
                    <!-- Single event in a single day -->
                  
                </tbody>
            </table>
        </div>
    </div>
</div>
</section>
<script>
// Set the date we're counting down to
function convertDateForIos(date) {
    var arr = date.split(/[- :]/);
    date = new Date(arr[0], arr[1]-1, arr[2], arr[3], arr[4], arr[5]);
    return date;
}
var date = '<?php echo $check['next']; ?>';
var countDownDate = convertDateForIos(date);

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML =  hours + " : "
  + minutes + " : " + seconds;

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "Tunggu Sebentar";
    location.reload();
  }

 
}, 1000);



</script>