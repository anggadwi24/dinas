<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login || <?= title() ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
   
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="<?= base_url()?>asset/images/favicon.ico" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url()?>asset/images/apple-touch-icon.png">
    <link rel="stylesheet" href="<?= template()?>/css/style.css">
    <link rel="manifest" href="<?= template()?>/__manifest.json">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!--===============================================================================================-->
</head>
<body class="bg-white">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->


    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">

        <div class="login-form mt-1">
           
            <div class="section " style="margin-top:200px">
                <h1>Login</h1>
                <h4><?= strtoupper(title())?></h4>
            </div>
            <div class="section mt-1 mb-5">
                <form id="formAct">
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="number" name="nohp" class="form-control" id="email1" placeholder="No. Hp">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="password" class="form-control" id="pass" placeholder="Password" name="pass">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                   
                    

                    <div class="form-button-group">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Log in</button>
                    </div>

                </form>
            </div>
        </div>


    </div>
  
<!--===============================================================================================-->
<script src="<?= template()?>/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="<?= template()?>/js/lib/popper.min.js"></script>
    <script src="<?= template()?>/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="<?= template()?>/js/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- jQuery Circle Progress -->
    <script src="<?= template()?>/js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
    <!-- Base Js File -->
    <script src="<?= template()?>/js/base.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
<script>
    $('#formAct').on('submit', function(e){ 
  
  e.preventDefault();  




        $.ajax({
           
        url: "<?= base_url('auth/doLogin')?>",
        type: "POST",
        beforeSend: function(){
            $('formAct *').prop('disabled', true);
             
            },
        data: new FormData(this),  

        contentType: false,
        cache: false,
        processData:false,
        success: function(res) {
           if(res == 0){
            $('#formAct')[0].reset();
               Swal.fire({

              title: 'Gagal!',
              text: 'User tidak ditemukan',
               customClass: 'swal-wide',
               type:'error',
              
            })
           }else if(res == 1){
                Swal.fire({

              title: 'Gagal!',
              text: 'Password anda salah!',
               customClass: 'swal-wide',
               type:'error',
              
            })
                $('#pass').val('');
           }else if(res== 2){
              $('#formAct')[0].reset();
                Swal.fire({

                title: 'Gagal!',
                text: 'Akun tidak aktif',
                customClass: 'swal-wide',
                type:'error',
                
              })
           }else {
            window.location = res;
           }
        },   
        complete: function(){
               $('formAct *').prop('disabled', false);

               
               
               
        }    
            
         });

  
    
    });
</script>
<?php if($this->session->flashdata('message')){ ?>



<script type="text/javascript">
   Swal.fire({

title: 'Mohon Maaf',
text: '<?php echo $this->session->flashdata('message'); ?>',
 customClass: 'swal-wide',
imageUrl: "<?= base_url('asset/images/iconic.png')?>",
imageClass:'img-responsive ',  

imageWidth:'200px',
imageHeight:'300px',  

})
</script>


<?php } ?>
</body>
</html>