<!DOCTYPE html>
<html lang="en">
<head>
  <title>Daftar | Madam Cha</title>
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
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<!--===============================================================================================-->
</head>
<body>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#state').change(function(){
          var state_id = $(this).val();
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('auth/city'); ?>",
            data:"stat_id="+state_id,
            success: function(response){
              $('#city').html(response);
            }
          })
        })
      })
  </script>
  
  <div class="limiter">
    <div class="container-login100" style="background-image: url('<?= base_url('asset/login') ?>/images/bg-01.jpg');">
      <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
        <?php 
                echo $this->session->flashdata('message'); 
                $this->session->unset_userdata('message');
            ?>

            <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
        <form class="login100-form validate-form" action="<?= base_url('auth/register')?>" method="POST">
          <span class="login100-form-title p-b-49">
            Daftar
          </span>
          
          <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
            <span class="label-input100">Username</span>
            <input class="input100" type="text" name="a" placeholder="">
            <span class="focus-input100" data-symbol="&#xf206;"></span>
          </div>

          <div class="wrap-input100 validate-input m-b-23" data-validate="Password is required">
            <span class="label-input100">Kata Sandi</span>
            <input class="input100" type="password" name="b" placeholder="">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
          </div>

          <div class="wrap-input100 validate-input m-b-23" data-validate="Nama Lengkap tidak boleh kosong!">
            <span class="label-input100">Nama Lengkap</span>
            <input class="input100" type="text" name="c" placeholder="">
            <span class="focus-input100" data-symbol="&#xf206;"></span>
          </div>

           <div class="wrap-input100 validate-input m-b-23" data-validate="Email tidak boleh kosong!">
            <span class="label-input100">Email</span>
            <input class="input100" type="email" name="d" placeholder="">
            <span class="focus-input100" data-symbol="&#xf206;"></span>
          </div>

          
          <div class="wrap-input100 validate-input m-b-23" data-validate="No HP tidak boleh kosong">
            <span class="label-input100">No Hp</span>
            <input class="input100" type="number" name="e" placeholder="">
            <span class="focus-input100" data-symbol="&#xf2bc;"></span>
          </div>



          
          <div class="text-right p-t-8 p-b-31">
           
          </div>
          
          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn" name="submit1">
                Daftar
              </button>
             
            </div>
          </div>
     
         

          <div class="flex-col-c p-t-10">
            

            <a href="<?= base_url('auth/login') ?>" class="txt2">
            JIKA SUDAH PUNYA AKUN SILAHKAN LOGIN
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  
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

</body>
</html>