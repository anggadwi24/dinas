<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title><?= $title ?></title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="<?= base_url()?>asset/images/favicon.ico" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url()?>asset/images/apple-touch-icon.png">
    <link rel="stylesheet" href="<?= template()?>/css/style.css">
    <link rel="manifest" href="<?= template()?>__manifest.json">
</head>

<body class="bg-white">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"></div>
        <div class="right">
            <a href="<?= base_url('auth/login')?>" class="headerButton">
                Login
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="login-form">
            <div class="section">
                <h1>Daftar</h1>
                <h4>Lengkapi data dibawah ini</h4>
            </div>
            <div class="section mt-2 mb-5">
                <form id='formAct'>
                <div class='custom-file-upload'>
                    
                    <input type='file' name='file' id='fileuploadInput' accept='.png, .jpg, .jpeg'>
                    <label for='fileuploadInput'>
                         <span>
                            <strong>
                                <ion-icon name='cloud-upload-outline' role='img' class='md hydrated' aria-label='cloud upload outline'></ion-icon>
                                    <i>Tap to Upload</i>
                            </strong>
                        </span>
                    </label>
                </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="name1" placeholder="Nama Lengkap" required name="nama_lengkap">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="email" class="form-control" id="email1" placeholder="Email" required name="email">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="number" class="form-control" id="nohp1" placeholder="No Hp" required name="no_hp">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <select name="kelas" id="kelas" class="form-control" required>
                                <option>Kelas</option>
                                <option value='I'>I</option>
                                <option value='II'>II</option>
                                <option value='III'>III</option>
                                <option value='IV'>IV</option>
                                <option value='V'>V</option>
                                <option value='VI'>VI</option>

                                
                            </select>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="nohp21" placeholder="Asal Sekolah" required name="nama_sekolah">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="nohp21" placeholder="Nama Wali" required name="nama_wali">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="password" class="form-control" id="password1" placeholder="Password" name="password">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    

                    <div class=" mt-1 text-left">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customChecka1" required>
                            <label class="custom-control-label text-muted" for="customChecka1">I Agree <a
                                    href="javascript:;">Terms & Conditions</a></label>
                        </div>

                    </div>

                    <div class="form-button-group">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Register</button>
                    </div>

                </form>
            </div>
        </div>



    </div>
    <!-- * App Capsule -->



    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
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
           
        url: "<?= base_url('auth/doRegister')?>",
        type: "POST",
        beforeSend: function(){
            $('formAct *').prop('disabled', true);
             
            },
        data: new FormData(this),  

        contentType: false,
        cache: false,
        processData:false,
        dataType:'json',
        success: function(res) {
           if(res.status == false){
            Swal.fire({

            title: 'Gagal!',
            text: resp.msg,
            customClass: 'swal-wide',
            type:'error',

            })
           }else{
            window.location = '<?= base_url('main')?>';
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
  type: 'error',
  title: 'Peringatan',
  text: '<?php echo $this->session->flashdata('message'); ?>',
   customClass: 'swal-wide',
  
})
</script>
<?php }?>
</body>

</html>