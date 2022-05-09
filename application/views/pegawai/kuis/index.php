<!DOCTYPE HTML>
<html lang = "en">
<head> 
<title><?php echo $title; ?></title>
<script data-ad-client="ca-pub-1374426766822072" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>


<link rel="shortcut icon" href="<?php echo base_url(); ?>asset/images/<?php echo favicon(); ?>" />

  <link href="<?= base_url('')?>asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
<!--   <link href="<?= base_url('')?>asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="<?= base_url('')?>asset/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

  <!-- Custom styles for this template -->
<!--   <link href="<?php echo base_url(); ?>asset/css/landing-page.min.css" rel="stylesheet">
 -->      <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
></script>
 <link href="<?php echo base_url(); ?>asset/css/style.css" rel="stylesheet">
</head>
<body>

<style type="text/css">

    .abs{
      background-color: #992cfd;
        border:none;
        border-radius: 50px;
     
        font-family: Orator;
        text-align: center;

        font-size: 50px;
        outline: none;
        color: white;
        height: 100px;
        width: 800px;
        }
    .modal-header{
      font-size: 43px;
    }
    .modal-content{
      margin-left: -150px;
      font-size: 40px;
      width: 800px !important;
      height: 500px !important;
    }
    .allsoal{
      margin-left: 10px;
      margin-right: 10px;
      max-width: 900px;
      margin-bottom: 30px;
    }
    .num {
  width: 70px;
  height: 70px;
  padding: 10px;
  margin: 10px;
  font-size: 30px;


}
.soal{
  font-size: 30px;
  color: white;
  margin-bottom: 80px;
 margin-right: 5px;
 margin-left: 5px;

}
.radio {
  display: block;
  position: relative;
  padding-left: 50px;
  margin-bottom: 10px;
  cursor: pointer;
  font-size: 32px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.radio input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 25px;
  left: 10px;
  bottom: 10;
  height: 30px;
  width: 30px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.radio:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.radio input:checked ~ .checkmark {
  background-color: #2196F3;

}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.radio input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.radio .checkmark:after {
  top: 10px;
  left: 10px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;
}
</style>
 
   
      <?php   
   
    $now = date('H:i:s');
    $count = date('Y-m-d').' '.$now;

    ?> 

    

    <div class="container-fluid">
        <div class="row">

          <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full mx-auto">
            
            <div class="d-flex justify-content-center font-aur">
            <div class="d-flex p-2 bd-highlight"><h2>KUIS</h2></div>
            </div>
            <div class="allsoal">
          
              <button type="button" id="soal" class="btn btn-secondary btn-lg num" data-id= style="margin-bottom: 3px;">1</button>
           
            </div>
          </div>
            
            
          </div>
          
    </div>
      
  
      <div class="container-fluid">
    <div class="row">

          <?php 
            $page = ($this->uri->segment(3)) + 1 ;
            $links = $this->uri->segment(3);
            $tr = $soal->num_rows();
            $total1 = $tr-1;

            


          ?>

      <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full mx-auto" style="margin-bottom: 50px;">
        
        <div class="d-flex justify-content-center font-aur">
        <h2>SOAL</h2>
        </div>
        <div class="d-flex justify-content-center ">
        
            <img src="<?= base_url('asset/images/2.png')?>" class="img-fluid" style="max-width: 400px;max-height: 400px;">
         
        </div>
        <div class="d-flex justify-content-center soal">
        <p>Apply display utilities to create a flexbox container and transform direct children elements into flex items. Flex containers and items are able to be modified further with additional flex properties.</p>

         
        </div>
        
      </div>
      
    </div>
    
  </div>
    <div class="container-fluid">
    <div class="row">

      <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full-1 mx-auto">
        
        <div class="d-flex  font-aur">
       <label class="radio"><input type="radio" id="answer" name="answer" value="D"><span class="checkmark"></span></label>
        </div>
        
        
      </div>
       <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full-1 mx-auto">
        
        <div class="d-flex  font-aur">
       <label class="radio"><input type="radio" id="answer" name="answer" value="D"><span class="checkmark"></span></label>
        </div>
        
        
      </div>
       <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full-1 mx-auto">
        
        <div class="d-flex  font-aur">
       <label class="radio"><input type="radio" id="answer" name="answer" value="D"><span class="checkmark"></span></label>
        </div>
        
        
      </div>
       <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full-1 mx-auto">
        
        <div class="d-flex">
       <label class="radio"><input type="radio" id="answer" name="answer" value="D"><span class="checkmark"></span></label>
        </div>
        
        
      </div>
      
    </div>
    
  </div>



  
  <div class="container-fluid">
    <div class="row">

      <div class="col-lg-6 col-xs-6 col-sm-6 col-md-6 float-left box-1 mx-auto">
          <div class="d-flex justify-content-center ">
        
            <input type="submit" name="a" class="sbm" value="PREV">
         
        </div>
      </div>
      <div class="col-lg-6 col-xs-6 col-sm-6 col-md-6 float-right box mx-auto">
        <div class="d-flex justify-content-center ">
        
          <input type="submit" name="a" class="sbm" value="PREV">         
        </div>
      </div>
      
    </div>
    
  </div>





    <script src="<?php echo base_url(); ?>asset/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <script type="text/javascript">
      $(document).on({
      ajaxStart: function(){
          $("body").addClass("loading"); 
      },
      ajaxStop: function(){ 
          $("body").removeClass("loading"); 
      }    
  });

  </script>
  <?php if(isset($check['next'])){?>
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
  document.getElementById("demo").value =  hours + " : "
  + minutes + " : " + seconds;
  document.getElementById("demo").disabled = true;

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").value = "Tunggu Sebentar";
    document.getElementById("demo").disabled = false;
    location.reload();
  }

 
}, 1000);



</script>
  <?php }?>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
  <?php 
$absnext = date('H:i', strtotime($check['next']));
if($check['next'] >= $count ){ ?>
<script type="text/javascript">
       Swal.fire({

  title: 'Absen',
  text: 'Silahkan kembali pada <?php echo $absnext;?>, untuk absen selanjutnya!',
   customClass: 'swal-wide',
   type:'info',
})
</script>

<?php } ?>
<?php if($this->session->flashdata('message')){ ?>



<script type="text/javascript">
       Swal.fire({
  icon: '<i class="fas fas-stop" ></i>',
  title: 'Peringatan',
  text: '<?php echo $this->session->flashdata('message'); ?>',
   customClass: 'swal-wide',
   type:'error',
  
})
</script>


<?php } ?>
<script type="text/javascript">
    $("#info").click(function(){
          Swal.fire({
          type: 'info',
          title: 'Petunjuk',
          text: 'Absen tiap jammnya untuk mendapatkan hadiah uang tunai!',
           customClass: 'swal-wide',
        });
        });
  
</script>

</body>
</html>