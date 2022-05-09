<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login || Madam Cha</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="<?= base_url('asset/login') ?>/images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/login') ?>/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/login') ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/login') ?>/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/login') ?>/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/login') ?>/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/login') ?>/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/login') ?>/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/login') ?>/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/login') ?>/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/login') ?>/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!--===============================================================================================-->
</head>
<body>
  
  <div class="limiter">
    <div class="container-login100" style="background-image: url('<?= base_url('asset/login') ?>/images/bg-01.jpg');">
      <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
       
        <form class="login100-form validate-form" action="<?= base_url('auth/lupa_password')?>" method="POST">
          <span class="login100-form-title p-b-49">
            Lupa Kata Sandi
          </span>
          
          <div class="wrap-input100 validate-input m-b-23" data-validate = "Format email salah!">
            <span class="label-input100">Email</span>
            <input class="input100" type="email" name="a" placeholder="Masukan email anda!">
            <span class="focus-input100" data-symbol="📩"></span>
          </div>

         
          
         
          
          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn" name="kirim">
                Kirim
              </button>


             
            </div>
          </div>
           </form>

         
      <div class="flex-col-c p-t-10">
            

            <a href="<?= base_url('auth/login') ?>" class="txt2">
              KEMBALI
            </a>
          </div>
          

          
       
      </div>
    </div>
  </div>



<!--===============================================================================================-->
  <script src="<?= base_url('asset/login') ?>/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="<?= base_url('asset/login') ?>/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="<?= base_url('asset/login') ?>/vendor/bootstrap/js/popper.js"></script>
  <script src="<?= base_url('asset/login') ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="<?= base_url('asset/login') ?>/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="<?= base_url('asset/login') ?>/vendor/daterangepicker/moment.min.js"></script>
  <script src="<?= base_url('asset/login') ?>/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="<?= base_url('asset/login') ?>/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="<?= base_url('asset/login') ?>/js/main.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

<?php if($this->session->flashdata('message')){ ?>



<script type="text/javascript">
       Swal.fire({
  type: 'error',
  title: 'Peringatan',
  text: '<?php echo $this->session->flashdata('message'); ?>',
   customClass: 'swal-wide',
  
})
</script>


<?php } ?>
</body>
</html>