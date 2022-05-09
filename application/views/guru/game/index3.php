<div class="container-fluid">
    <div class="row">

    <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full mx-auto bergetar">
        <a href="<?=  base_url('tigaangka/tebak')?>" style="text-decoration: none;">
        <div class="d-flex justify-content-center font-aur-h1">
        <h1>3</h1>
        </div>
        <div class="d-flex justify-content-center font-aur">
        <h2>TEBAK ANGKA</h2>
        </div>
        </a>
      </div>
    </div>
    
  </div>
  <div class="container-fluid">
    <div class="row">

      <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full mx-auto">
     
        <div class="d-flex justify-content-center font-aur">
        <h1>PENGUGUMAN</h1>
        </div>

            <?php foreach($angka->result_array() as $row){?>
             <?php 
              $time = date('H:i:s');
              $tgl = date('Y-m-d');
              $date = $row['date'].' '.$row['end'];
              $date1 = $tgl.' '.$time;
             ?>
        <div class="d-flex justify-content-center font-aur" >
        <h4>ANGKA YANG NAIK PADA <br> <?= strtoupper( date('d, F ', strtotime($row['date'])).' |  '.date('H:i ', strtotime($row['start'])).' - '.date('H:i ', strtotime($row['end'])))?></h4>
        </div>
        
            <?php if($date <= $date1){?>
              <div class="d-flex justify-content-center font-aur">
              <h1><?php echo $row['angka'];?></h1>
               </div>
               <div class="d-flex justify-content-around font-aur"><span >Tebakan Anda</span></div>

            <?php }else{?>
            <?php  $count = $row['date'].' '.$row['end'];
                    $angka = $row['angka'];
                     $angka1 = substr($angka,0,1);
                    $angka2 = substr($angka,1,1);
                    $angka3 = substr($angka,2);
                    $stat = 0;
                   
                    $this->session->set_flashdata('num1', $angka1);
                    $this->session->set_flashdata('num2', $angka2);
                    $this->session->set_flashdata('num3', $angka3);


                   

                    

               ?>
               <div class="d-flex justify-content-center font-aur">
               <span id="demo" ></span>
               
               <br>
               <h1 id="number1" style="display: none">0</h1><h1 id="number2" style="display: none">0</h1><h1 id="number3" style="display: none">0</h1>

               </div>
               
               
            <?php }?>
              <div class="d-flex justify-content-around font-aur"  >
              
               <?php $benar = 0;$salah=0;?>
         <?php  foreach($his->result_array() as $h){?>
                    <?php if($row['id_angka'] == $h['id_angka'] AND $date <= $date1){?>
                    
                    <?php if($row['angka'] == $h['tebak']){?>
                          <?php $benar = 1;?>
                          <h1 style="color: green;margin-right: 10px;" title="Tebakan Anda Benar"><?= $h['tebak']?></h1>
                      <?php }else{?>
                        <?php $salah = 1;?>
                         <del style="color: red"><h1 style="color: red;margin-right: 10px;" title="Tebakan Anda Salah"><?= $h['tebak']?></h1></del>
                      <?php }?>
                     
                    <?php }?>
          <?php }?>    
            
              
           </div> 
            <?php if($benar>0){?>
            <div class="d-flex justify-content-around font-aur"  style="background-color: #28a745">
              <span>SELAMAT ANDA MENANG PADA SESI INI</span>
            </div>
           <?php }elseif($salah>0){?>
            <div class="d-flex justify-content-around font-aur"  style="background-color:#dc3545">
              <span>TEBAKAN ANDA SALAH</span>
            </div>
           <?php }?>
             <hr style="width:80%;color: white;border-top: 5px solid white;">
          <?php }?>  
        </div>
        
       </div>
     </div>
   </div>

  <input type="hidden" name="sesi" id="sesi" value="<?= $count ?>">
  <input type="hidden" name="time" id="time" value="<?= $date1 ?>">
 <script type="text/javascript">
  var start = 0;
  var num = ['0','1','2','3','4','5','6','7','8','9'];
  var number1 = document.getElementById("number1");
  var number2 = document.getElementById("number2");
  var number3 = document.getElementById("number3");

  var number1fixed = "<?= $this->session->flashdata('num1')?>";
  var number2fixed = "<?= $this->session->flashdata('num2')?>";
  var number3fixed = "<?= $this->session->flashdata('num3')?>";


  const random1 = Math.floor(Math.random() * num.length);
  const random2 = Math.floor(Math.random() * num.length);
  const random3 = Math.floor(Math.random() * num.length);

  function rand(id){
    var cls = document.getElementById(id);
    const random = Math.floor(Math.random() * num.length);
    if(start == 1)
    {
      cls.innerHTML = random;
      setTimeout(function(){
        rand(id);
      },500);

    }else if(start == 0 && eval(id+"fixed")!= ""){
      cls.innerHTML = eval(id+"fixed");
    }
  }
  function toggle(){
    if(start == 0){
      start = 1;
      setTimeout(rand("number1"), 500);
      
      setTimeout(rand("number2"), 1000);
      
     

    }else{
      start = 0;
    }
  }
</script>


  <?php if(isset($count)){?>
<script>
// Set the date we're counting down to
function convertDateForIos(date) {
    var arr = date.split(/[- :]/);
    date = new Date(arr[0], arr[1]-1, arr[2], arr[3], arr[4], arr[5]);
    return date;
}
var start = 0;
var date = '<?php echo $count; ?>';
var countDownDate = convertDateForIos(date);

 //


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
  document.getElementById("demo").innerHTML ="HITUNG MUNDUR : " +  hours + " : "
  + minutes + " : " + seconds;

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").remove();
    document.getElementById("number1").style.display="block";
    document.getElementById("number2").style.display="block";
    document.getElementById("number3").style.display="block";
    audio.load()
    audio.addEventListener("load", function() { 
      audio.play(); 
    }, true);
    audio.src = source;
      if(start == 0){
     
       start = 1;
      rand("number1");
      
      rand("number2");
      rand("number3");

      
      setTimeout(function(){
       start=0;audio.pause();
      },120000);

     
     

      
      
     

    }else{
      start = 0;
    }


    

  }

 
}, 1000);



</script>
<?php }?>
